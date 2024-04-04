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
    public $roleId; 

    // user constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting users from database 
    public function read(){
        //Reading query
        $query = 'SELECT * FROM '.$this->table.' u WHERE u.roleId = 1;';

        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

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
            return true; // Indicating a record was found
        }
        return false; // No record found
    } 
    

    //Creating User 
    public function create(){
        $query = 'INSERT INTO '.$this->table.'
                    ( username, email, password) VALUES (:username, :email, :password );';

        $stmt = $this->conn->prepare($query);

        //clean data sent by user
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        //bind thr parameters to request
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET username = :username,
        email = :email,
        password = :password
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        //bind thr parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    public function updateEmail(){
        $query = 'UPDATE '.$this->table.'
        SET email = :email
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->email = htmlspecialchars(strip_tags($this->email));
      

        //bind thr parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':email', $this->email);
        

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

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
}