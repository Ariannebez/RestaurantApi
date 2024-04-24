<?php

class items{
    //properties for database stuff
    private $conn;
    private $table = 'items';
    
    
    //properties of user
    public $id;
    public $name;
    public $des;
    public $price;
    public $categoryId;
    public $category;
    
    // user constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all items from database 
    public function read(){
        //Reading query
        $query = 'SELECT i.id, i.name, i.des, i.price, i.categoryId, m.category
        FROM '.$this->table.' i
        JOIN menuCategory m ON m.id = i.categoryId;';
        
        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Getting all items from database where Category is 1 (starters)
    public function readStarters(){
        //Reading query
        $query = 'SELECT i.id, i.name, i.des, i.price, i.categoryId, m.category
        FROM '.$this->table.' i
        JOIN menuCategory m ON m.id = i.categoryId
        WHERE i.categoryId = 1;';
        
        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Getting all items from database where Category is 2 (pasta)
    public function readPasta(){
        //Reading query
        $query = 'SELECT i.id, i.name, i.des, i.price, i.categoryId, m.category
        FROM '.$this->table.' i
        JOIN menuCategory m ON m.id = i.categoryId
        WHERE i.categoryId = 2;';
        
        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Reading single item by id
    public function read_singleId(){
        $query = 'SELECT * FROM '.$this->table.' WHERE id = ? LIMIT 1;';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->name = $row['name'];
            $this->des = $row['des'];
            $this->price = $row['price'];
            $this->categoryId = $row['categoryId'];
            
            return true; // Indicating a record was found
        }
        return false; // No record found
    }

    //Reading single item by name
    public function read_single(){
        $query = 'SELECT * FROM '.$this->table.' WHERE name = ? LIMIT 1;';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->id = $row['id']; // Assuming this property exists
            $this->name = $row['name'];
            $this->des = $row['des'];
            $this->price = $row['price'];
            $this->categoryId = $row['categoryId'];
            
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