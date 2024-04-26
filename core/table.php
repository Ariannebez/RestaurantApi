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
        $query = "INSERT INTO `table` (bookingStatusId, areaId) 
                      VALUES (:bookingStatusId, :areaId)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->bookingStatusId = htmlspecialchars(strip_tags($this->bookingStatusId));
        $this->areaId = htmlspecialchars(strip_tags($this->areaId));

       // Binding the parameters
       $stmt->bindParam(':bookingStatusId', $this->bookingStatusId);
       $stmt->bindParam(':areaId', $this->areaId);

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Updating table using 'PUT'
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET bookingStatusId = :bookingStatusId,
        areaId = :areaId
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->bookingStatusId = htmlspecialchars(strip_tags($this->bookingStatusId));
        $this->areaId = htmlspecialchars(strip_tags($this->areaId));
      
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':bookingStatusId', $this->bookingStatusId);
        $stmt->bindParam(':areaId', $this->areaId);
    
        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    //Deleting 
    public function delete(){
        $query = 'DELETE FROM '.$this->table.' WHERE id = :id;'; 

        $stmt = $this->conn->prepare($query);

        //clean data sent by user
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;

    }

    //Checking if client exists
    public function exists() {
        $query = 'SELECT COUNT(*) FROM '.$this->table.' WHERE id = :id';
    
        // Preparing statement
        $stmt = $this->conn->prepare($query);
    
        // Binding ID
        $stmt->bindParam(':id', $this->id);
    
        // Execute query
        $stmt->execute();
    
        // Checking if any rows are returned
        if($stmt->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

    