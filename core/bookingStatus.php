<?php

class bookingStatus{
    //properties for database stuff
    private $conn;
    private $table = 'bookingStatus';
    
    
    //properties of user
    public $id;
    public $name;

    // Booking constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all bookingsStatus from the database 
    public function read(){
        //Reading query
        $query = 'SELECT * FROM '.$this->table.';';
        
        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //creating booking status
    public function create(){
        $query = "INSERT INTO bookingStatus (name) 
                      VALUES (:name)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->name = htmlspecialchars(strip_tags($this->name));
        

       // Binding the parameters
       $stmt->bindParam(':name', $this->name);
       

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Updating name using put
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET name = :name
        WHERE id = :id ;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        
        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    

    //update date
    public function updateDate(){
        $query = 'UPDATE '.$this->table.'
        SET date = :date
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->date = htmlspecialchars(strip_tags($this->date));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':date', $this->date);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

     //update time
     public function updateTime(){
        $query = 'UPDATE '.$this->table.'
        SET time = :time
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->time = htmlspecialchars(strip_tags($this->time));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':time', $this->time);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    //Deleting item by id 
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