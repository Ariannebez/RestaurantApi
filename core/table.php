<?php

class table {
    //properties for database stuff
    private $conn;
    private $table = '`table`'; // Properly escaped using backticks

    //properties of table
    public $id;
    public $bookingStatusId;
    public $areaId;
    public $name;
    public $tableNo;
    public $location;

    // address constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting tables
    public function read(){
        $query = 'SELECT t.id, t.bookingStatusId, s.name, t.areaId, a.tableNo, a.location 
        FROM '.$this->table.' t
        JOIN bookingStatus s ON s.id = t.bookingStatusId
        JOIN area a ON a.id = t.areaId ;';

        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

     //Reading single table by number
     public function read_single(){
        $query = 'SELECT t.id, t.bookingStatusId, s.name, t.areaId, a.tableNo, a.location 
        FROM '.$this->table.' t
        JOIN bookingStatus s ON s.id = t.bookingStatusId
        JOIN area a ON a.id = t.areaId 
        WHERE t.id = ? LIMIT 1;';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->bookingStatusId = $row['bookingStatusId'];
            $this->name = $row['name'];
            $this->areaId = $row['areaId'];
            $this->tableNo = $row['tableNo'];
            $this->location = $row['location'];
            
            return true; // Indicating a record was found
        }
        return false; // No record found
    }

    //creating item
    public function create(){
        $query = "INSERT INTO items (name, des, price, categoryId) 
                      VALUES (:name, :des, :price, :categoryId)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->des = htmlspecialchars(strip_tags($this->des));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

       // Binding the parameters
       $stmt->bindParam(':name', $this->name);
       $stmt->bindParam(':des', $this->des);
       $stmt->bindParam(':price', $this->price);
       $stmt->bindParam(':categoryId', $this->categoryId);

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Delete
}

    