<?php

class address{
    //properties for database stuff
    private $conn;
    private $table = 'address';

    //properties of address
    public $id;
    public $doorNo;
    public $street;
    public $townId;
   
    

    // address constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //create Address
    public function createAddress(){
        $query = "INSERT INTO address (doorNo, street, townId) 
                      VALUES (:doorNo, :street, :townId)";

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->doorNo = htmlspecialchars(strip_tags($this->doorNo));
        $this->street = htmlspecialchars(strip_tags($this->street)); // Consider hashing
        $this->townId = htmlspecialchars(strip_tags($this->townId));
        
       // Bind the parameters, including addressId and roleId
       $stmt->bindParam(':doorNo', $this->doorNo);
       $stmt->bindParam(':street', $this->street); 
       $stmt->bindParam(':townId', $this->townId);
       

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Update Address details
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET street = :street,
        townId = :townId
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->street = htmlspecialchars(strip_tags($this->street));
        $this->townId = htmlspecialchars(strip_tags($this->townId));
    
        //$this->roleId = htmlspecialchars(strip_tags($this->roleId));

        //bind thr parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':street', $this->street);
       $stmt->bindParam(':townId', $this->townId); 
      

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

}