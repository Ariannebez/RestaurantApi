<?php

class address{
    //properties for database stuff
    private $conn;
    private $table = 'address';

    //properties of user
    public $id;
    public $street;
    public $townId;
   
    

    // address constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //create Address
    public function create(){
        $query = "INSERT INTO users (id, street, townId) 
                      VALUES (:id, street, townId)";

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->street = htmlspecialchars(strip_tags($this->street)); // Consider hashing
        $this->townId = htmlspecialchars(strip_tags($this->townId));
        
       // Bind the parameters, including addressId and roleId
       $stmt->bindParam(':id', $this->id);
       $stmt->bindParam(':street', $this->password); // Ensure password is securely hashed
       $stmt->bindParam(':townId', $this->townId);
       

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

}