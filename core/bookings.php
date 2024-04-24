<?php

class bookings{
    //properties for database stuff
    private $conn;
    private $table = 'booking';
    
    
    //properties of user
    public $id;
    public $numberOfpeople;
    public $date;
    public $time;
    public $userId;
    public $bookingIdStatus;
    public $bookingStatus;
    public $name;
    
    // user constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all items from database 
    public function read(){
        //Reading query
        $query = 'SELECT b.id, b.numberOfpeople, b.date, b.time, b.userId, b.bookingIdStatus, s.name AS bookingStatus, u.name
        FROM '.$this->table.' b
        JOIN bookingStatus s ON s.id = b.bookingIdStatus
        JOIN users u ON u.id = b.userId;';
        
        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Reading single booking by id
    public function read_singleId(){
        $query = 'SELECT b.id, b.numberOfpeople, b.date, b.time, b.userId, b.bookingIdStatus, s.name AS bookingStatus, u.name
        FROM '.$this->table.' b
        JOIN bookingStatus s ON s.id = b.bookingIdStatus
        JOIN users u ON u.id = b.userId
        WHERE b.id = ? LIMIT 1;';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; 
            $this->numberOfpeople = $row['numberOfpeople'];
            $this->date = $row['date'];
            $this->time = $row['time'];
            $this->userId = $row['userId'];
            $this->bookingIdStatus = $row['bookingIdStatus'];
            $this->bookingStatus = $row['bookingStatus'];
            $this->name = $row['name'];
            
            return true; // Indicating a record was found
        }
        return false; // No record found
    }

    //Reading single booking by name
    public function read_singleName(){
        $query = 'SELECT b.id, b.numberOfpeople, b.date, b.time, b.userId, b.bookingIdStatus, s.name AS bookingStatus, u.name
        FROM '.$this->table.' b
        JOIN bookingStatus s ON s.id = b.bookingIdStatus
        JOIN users u ON u.id = b.userId
        WHERE u.name = ? LIMIT 1;';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; 
            $this->numberOfpeople = $row['numberOfpeople'];
            $this->date = $row['date'];
            $this->time = $row['time'];
            $this->userId = $row['userId'];
            $this->bookingIdStatus = $row['bookingIdStatus'];
            $this->bookingStatus = $row['bookingStatus'];
            $this->name = $row['name'];
            
            return true; // Indicating a record was found
        }
        return false; // No record found
    }

    //creating item
    public function create(){
        $query = "INSERT INTO items (name, des, price, categoryId) 
                      VALUES (:name, :des, :price, :categoryId)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->des = htmlspecialchars(strip_tags($this->des));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

       // Binding the parameters
       $stmt->bindParam(':name', $this->name);
       $stmt->bindParam(':des', $this->des);
       $stmt->bindParam(':price', $this->price);
       $stmt->bindParam(':categoryId', $this->categoryId);

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Updating name, des and category id using PATCH
    public function updateAll(){
        $query = 'UPDATE '.$this->table.'
        SET name = :name,
        des = :des,
        price = :price,
        categoryId = :categoryId
        WHERE id = :id ;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->des = htmlspecialchars(strip_tags($this->des));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':des', $this->des);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':categoryId', $this->categoryId);
    
        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    //Updating name, des and category id using PATCH
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET name = :name,
        des = :des,
        categoryId = :categoryId
        WHERE id = :id ;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->des = htmlspecialchars(strip_tags($this->des));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':des', $this->des);
        $stmt->bindParam(':categoryId', $this->categoryId);
    
        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    //update price
    public function updatePrice(){
        $query = 'UPDATE '.$this->table.'
        SET price = :price
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->price = htmlspecialchars(strip_tags($this->price));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':price', $this->price);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    //Deleting item by id 
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