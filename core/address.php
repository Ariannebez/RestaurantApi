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
    public $townName;
   
    

    // address constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all addresses from database where roleid is 1
    public function read(){
        //Reading query
        // a is for address and t for town
        $query = 'SELECT a.id, a.doorNo, a.street, t.name AS townName
                    FROM '.$this->table.' a 
                    JOIN town t ON t.id = a.townId;';
        
        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Reading single address by ID
    public function read_single(){
        $query = 'SELECT a.id, a.doorNo, a.street, t.name AS townName
        FROM '.$this->table.' a 
        JOIN town t ON t.id = a.townId 
        WHERE a.id = ? LIMIT 1;';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->doorNo = $row['doorNo'];
            $this->street = $row['street'];
            $this->townName = $row['townName'];
            return true; // Indicating a record was found
        }
        return false; // No record found
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