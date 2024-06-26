<?php

class tableStatus {
    //properties for database stuff
    private $conn;
    private $table = 'tableStatus'; // Properly escaped using backticks

    //properties of table
    public $id;
    public $status;
    public $tableNo;
    public $tableId;

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
            $this->status = $row['status'];
            $this->tableNo = $row['tableNo'];
            $this->tableId = $row['tableId'];
            
            return true; // Indicating a record was found
        }
        return false; // No record found
    }

    //creating item
    public function create(){
        $query = "INSERT INTO tableStatus (status, tableNo, tableId) 
                      VALUES (:status, :tableNo, :tableId)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->tableNo = htmlspecialchars(strip_tags($this->tableNo));
        $this->tableId = htmlspecialchars(strip_tags($this->tableId));

       // Binding the parameters
       $stmt->bindParam(':status', $this->status);
       $stmt->bindParam(':tableNo', $this->tableNo);
       $stmt->bindParam(':tableId', $this->tableId);

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

    