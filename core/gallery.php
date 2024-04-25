<?php

class gallery{
    //properties for database stuff
    private $conn;
    private $table = 'gallery';

    //properties of gallery
    public $id;
    public $img;
    public $des;
    
   
    // address constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all images from database
    public function read(){
        //Reading query
        $query = 'SELECT * FROM '.$this->table.';';
        
        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Reading single img by ID
    public function read_single(){
        $query = 'SELECT * FROM '.$this->table.' WHERE id = ? LIMIT 1;'; 
        
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->img = $row['img'];
            $this->des = $row['des'];
            return true; // Indicating a record was found
        }
        return false; // No record found
    } 

    //create img
    public function create(){
        $query = "INSERT INTO gallery (img, des) 
                      VALUES (:img, :des)";

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->img = htmlspecialchars(strip_tags($this->img));
        $this->des = htmlspecialchars(strip_tags($this->des)); 
        
        
       // Bind the parameters, including addressId and roleId
       $stmt->bindParam(':img', $this->img);
       $stmt->bindParam(':des', $this->des); 
       

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Update img details
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET img = :img,
        des = :des
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->img = htmlspecialchars(strip_tags($this->img));
        $this->des = htmlspecialchars(strip_tags($this->des));
       
        //bind thr parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':img', $this->img);
        $stmt->bindParam(':des', $this->des);
        
      

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