<?php

class special{
    //properties for database stuff
    private $conn;
    private $table = 'dailySpecial';
    
    
    //properties of user
    public $id;
    public $img;
    public $item;
    public $des;
    public $price;
    public $categoryId;
    public $category;
    

    // user constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all reviews from database joining with user on name
    public function read(){
        //Reading query
        $query = 'SELECT s.id, s.img, s.item, s.des, s.price, c.category  
        FROM '.$this->table.' s
        JOIN menuCategory c ON c.id = s.categoryId;';


        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Reading single client by name
    public function read_single(){
        $query = 'SELECT s.id, s.img, s.item, s.des, s.price, c.category  
        FROM '.$this->table.' s
        JOIN menuCategory c ON c.id = s.categoryId
        WHERE s.item = ? LIMIT 1;';
        
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->item);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->img = $row['img'];
            $this->item = $row['item'];
            $this->des = $row['des'];
            $this->price = $row['price'];
            $this->category = $row['category'];
            
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