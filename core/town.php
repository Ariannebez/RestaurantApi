<?php

class town{
    //properties for database stuff
    private $conn;
    private $table = 'town';

    //properties of town
    public $id;
    public $name;
    public $countryId;
   
    

    // address constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all addresses from database where roleid is 1
    public function read(){
        //Reading query
        $query = 'SELECT t.id, t.name, c.name AS countryName
         FROM '.$this->table.' t
         JOIN country c ON c.id = t.countryId ;';
        
        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Reading single address by ID
    public function read_single(){
        //$query = 'SELECT * FROM '.$this->table.' WHERE id = ? LIMIT 1;';
        $query = 'SELECT t.id, t.name, c.name AS countryName
         FROM '.$this->table.' t
         JOIN country c ON c.id = t.countryId 
         WHERE t.id = ? LIMIT 1;;';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->name = $row['name'];
            $this->countryName = $row['countryName'];
            return true; // Indicating a record was found
        }
        return false; // No record found
    } 

    //create town
    public function createTown(){
        $query = 'INSERT INTO '.$this->table.'
        ( name, countryId) VALUES (:name, :countryId);';

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->countryId = htmlspecialchars(strip_tags($this->countryId));
        
       // Bind the parameters, including addressId and roleId
       $stmt->bindParam(':name', $this->name);
       $stmt->bindParam(':countryId', $this->countryId); 
      
       

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }


    //Update Address details
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET name = :name,
        countryId = :countryId
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->countryId = htmlspecialchars(strip_tags($this->countryId));
    
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