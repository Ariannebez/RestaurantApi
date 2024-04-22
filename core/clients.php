<?php

class Clients{
    //properties for database stuff
    private $conn;
    private $table = 'users';
    
    
    //properties of user
    public $id;
    public $email;
    public $password;
    public $name;
    public $surname;
    public $dob;
    public $addressId;
    public $roleId;
    

    // user constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all client from database where roleid is 1
    public function read(){
        //Reading query
        $query = 'SELECT * FROM '.$this->table.' u WHERE u.roleId = 1;';
        


        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Reading single client by ID
    public function read_single(){
        $query = 'SELECT * FROM '.$this->table.' WHERE id = ? LIMIT 1;';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($row) {
            $this->roleId = $row['roleId']; // Assuming this property exists
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->name = $row['name'];
            $this->surname = $row['surname'];
            $this->dob = $row['dob'];
            $this->addressId = $row['addressId'];
            $this->roleId = $row['roleId'];
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