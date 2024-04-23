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

    //creating client
    public function create(){
        $query = "INSERT INTO users (email, password, name, surname, dob, addressId, roleId) 
                      VALUES (:email, :password, :name, :surname, :dob, :addressId, 1)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password)); // Consider hashing
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->dob = htmlspecialchars(strip_tags($this->dob));
        $this->addressId = htmlspecialchars(strip_tags($this->addressId));
        //$this->roleId = htmlspecialchars(strip_tags($this->roleId));

       // Binding the parameters, including addressId and roleId
       $stmt->bindParam(':email', $this->email);
       $stmt->bindParam(':password', $this->password); // Ensure password is securely hashed
       $stmt->bindParam(':name', $this->name);
       $stmt->bindParam(':surname', $this->surname);
       $stmt->bindParam(':dob', $this->dob);
       $stmt->bindParam(':addressId', $this->addressId);

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Updating all client's details using 'PUT' (name, surname, email, password, dob)
    public function updateAll(){
        $query = 'UPDATE '.$this->table.'
        SET email = :email,
        password = :password,
        name = :name,
        surname = :surname,
        dob = :dob
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->dob = htmlspecialchars(strip_tags($this->dob));
        //$this->roleId = htmlspecialchars(strip_tags($this->roleId));

        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password); // Ensure password is securely hashed
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':surname', $this->surname);
        $stmt->bindParam(':dob', $this->dob);
        //$stmt->bindParam(':roleId', $this->roleId);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    //Updating client details using 'PATCH' (name, surname, email)
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET email = :email,
        name = :name,
        surname = :surname
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->email = htmlspecialchars(strip_tags($this->email));
        //$this->password = htmlspecialchars(strip_tags($this->password));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        //$this->dob = htmlspecialchars(strip_tags($this->dob));
        //$this->roleId = htmlspecialchars(strip_tags($this->roleId));

        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':email', $this->email);
        //$stmt->bindParam(':password', $this->password); // Ensure password is securely hashed
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':surname', $this->surname);
        //$stmt->bindParam(':dob', $this->dob);
        //$stmt->bindParam(':roleId', $this->roleId);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    //update password
    public function updatePassword(){
        $query = 'UPDATE '.$this->table.'
        SET password = :password
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->password = htmlspecialchars(strip_tags($this->password));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':password', $this->password); // Ensure password is securely hashed
        

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