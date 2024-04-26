<?php

class area {
    //properties for database stuff
    private $conn;
    private $table = 'area'; // Properly escaped using backticks

    //properties of area
    public $id;
    public $tableNo;
    public $location;

    // address constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting tables
    public function read(){
        $query = 'SELECT * FROM '.$this->table.' ;';

        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

     //Reading single table by number
     public function read_single(){
        $query = 'SELECT * FROM '.$this->table.'  WHERE id = ? LIMIT 1;';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->tableNo = $row['tableNo'];
            $this->location = $row['location'];
            
            return true; // Indicating a record was found
        }
        return false; // No record found
    }

    //creating item
    public function create(){
        $query = "INSERT INTO area (tableNo, location) 
                      VALUES (:tableNo, :location)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->tableNo = htmlspecialchars(strip_tags($this->tableNo));
        $this->location = htmlspecialchars(strip_tags($this->location));

       // Binding the parameters
       $stmt->bindParam(':tableNo', $this->tableNo);
       $stmt->bindParam(':location', $this->location);

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Updating table number and area using 'PUT'
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET tableNo = :tableNo,
        location = :location
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->tableNo = htmlspecialchars(strip_tags($this->tableNo));
        $this->location = htmlspecialchars(strip_tags($this->location));

       // Binding the parameters
       $stmt->bindParam(':id', $this->id);
       $stmt->bindParam(':tableNo', $this->tableNo);
       $stmt->bindParam(':location', $this->location);
    
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

    