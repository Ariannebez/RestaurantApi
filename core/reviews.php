<?php

class Reviews{
    //properties for database stuff
    private $conn;
    private $table = 'reviews';
    
    
    //properties of user
    public $id;
    public $des;
    public $userId;
    public $name;
    

    // user constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all reviews from database joining with user on name
    public function read(){
        //Reading query
        $query = 'SELECT r.id, r.des, r.userId, u.name 
        FROM '.$this->table.' r
        JOIN users u ON u.id = r.userId;';


        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Reading single client by name
    public function read_singleName(){
        $query = 'SELECT r.id, r.des, r.userId, u.name 
        FROM '.$this->table.' r
        JOIN users u ON u.id = r.userId
        WHERE u.name = ? LIMIT 1;';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->des = $row['des'];
            $this->userId = $row['userId'];
            
            return true; // Indicating a record was found
        }
        return false; // No record found
    } 

    //creating client
    public function create(){
        $query = "INSERT INTO reviews (des, userId) 
                      VALUES (:des, :userId)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->des = htmlspecialchars(strip_tags($this->des));
        $this->userId = htmlspecialchars(strip_tags($this->userId));


       // Binding the parameters, including addressId and roleId
       $stmt->bindParam(':des', $this->des);
       $stmt->bindParam(':userId', $this->userId);
       
        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Updating role using 'PUT'
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET des = :des
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->des = htmlspecialchars(strip_tags($this->des));
      

        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':des', $this->des);
    
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