<?php

class menuCategory{
    //properties for database stuff
    private $conn;
    private $table = 'menuCategory';
    
    
    //properties of menu categories
    public $id;
    public $category;
    
    // user constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all categories from database
    public function read(){
        //Reading query
        $query = 'SELECT * FROM '.$this->table.';';
        
        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Reading single category by ID
    public function read_single(){
        $query = 'SELECT * FROM '.$this->table.' WHERE id = ? LIMIT 1;';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->category = $row['category'];
        
            return true; // Indicating a record was found
        }
        return false; // No record found
    } 

    //Reading single category by name
    public function read_singleName(){
        $query = 'SELECT * FROM '.$this->table.' WHERE name = ? LIMIT 1;';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->category = $row['category'];
            
            return true; // Indicating a record was found
        }
        return false; // No record found
    }

    //creating menu category
    public function create(){
        $query = "INSERT INTO menuCategory (category) 
                      VALUES (:category)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->category = htmlspecialchars(strip_tags($this->category));

       // Binding the parameters
       $stmt->bindParam(':category', $this->category);
      

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Updating all Category details using 'PUT'
    public function updateAll(){
        $query = 'UPDATE '.$this->table.'
        SET category = :category
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);
    
        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }


    //Deleting client by id 
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