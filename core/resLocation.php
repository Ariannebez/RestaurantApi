<?php

class location{
    //properties for database stuff
    private $conn;
    private $table = 'resLocation';
    
    
    //properties of resLocation
    public $id;
    public $address;
    

    // user constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all client from database where roleid is 1
    public function read(){
        //Reading query
        $query = 'SELECT * FROM '.$this->table.' ;';
        
        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    

    //creating client
    public function create(){
        $query = "INSERT INTO resLocation (address) 
                      VALUES (:address)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->address = htmlspecialchars(strip_tags($this->address));


       // Binding the parameters, including addressId and roleId
       $stmt->bindParam(':address', $this->address);
       

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Updating role using 'PUT'
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET address = :address
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->address = htmlspecialchars(strip_tags($this->address));
      

        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':address', $this->address);
    
        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }


    //Deleting role by id 
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