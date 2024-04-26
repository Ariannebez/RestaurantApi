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

    //creating daily special
    public function create(){
        $query = "INSERT INTO dailySpecial (img, item, des, price, categoryId) 
                      VALUES (:img, :item, :des, :price, :categoryId)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->img = htmlspecialchars(strip_tags($this->img));
        $this->item = htmlspecialchars(strip_tags($this->item));
        $this->des = htmlspecialchars(strip_tags($this->des));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));


       // Binding the parameters, including addressId and roleId
       $stmt->bindParam(':img', $this->img);
       $stmt->bindParam(':item', $this->item);
       $stmt->bindParam(':des', $this->des);
       $stmt->bindParam(':price', $this->price);
       $stmt->bindParam(':categoryId', $this->categoryId);
       
       
        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

     //Updating all details using PUT
     public function updateAll(){
        $query = 'UPDATE '.$this->table.'
        SET img = :img,
        item = :item,
        des = :des,
        price = :price,
        categoryId = :categoryId
        WHERE id = :id ;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->img = htmlspecialchars(strip_tags($this->img));
        $this->item = htmlspecialchars(strip_tags($this->item));
        $this->des = htmlspecialchars(strip_tags($this->des));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':img', $this->img);
        $stmt->bindParam(':item', $this->item);
        $stmt->bindParam(':des', $this->des);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':categoryId', $this->categoryId);
    
        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    //Updating price
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