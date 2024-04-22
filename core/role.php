<?php

class Role{
    //properties for database stuff
    private $conn;
    private $table = 'role';
    
    
    //properties of user
    public $id;
    public $name;
    

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

    //Reading single client by name
    public function read_single(){
        $query = 'SELECT * FROM '.$this->table.' WHERE name = ? LIMIT 1;';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->name = $row['name'];
            
            return true; // Indicating a record was found
        }
        return false; // No record found
    } 

    //creating client
    public function create(){
        $query = "INSERT INTO users (email, password, name, surname, dob, addressId, roleId) 
                      VALUES (:email, :password, :name, :surname, :dob, :addressId, 1)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->name = htmlspecialchars(strip_tags($this->name));


       // Binding the parameters, including addressId and roleId
       $stmt->bindParam(':name', $this->name);
       

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Updating role using 'PUT'
    public function updateAll(){
        $query = 'UPDATE '.$this->table.'
        SET name = :name
        WHERE id = :id;';

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