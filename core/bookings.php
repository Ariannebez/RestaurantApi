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
    
    // Booking constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting all bookings from database 
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

    //creating booking
    public function create(){
        $query = "INSERT INTO booking (numberOfpeople, date, time, userId, bookingIdStatus) 
                      VALUES (:numberOfpeople, :date, :time, :userId, :bookingIdStatus)";

        $stmt = $this->conn->prepare($query);

        // Cleaning data
        $this->numberOfpeople = htmlspecialchars(strip_tags($this->numberOfpeople));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->bookingIdStatus = htmlspecialchars(strip_tags($this->bookingIdStatus));

       // Binding the parameters
       $stmt->bindParam(':numberOfpeople', $this->numberOfpeople);
       $stmt->bindParam(':date', $this->date);
       $stmt->bindParam(':time', $this->time);
       $stmt->bindParam(':userId', $this->userId);
       $stmt->bindParam(':bookingIdStatus', $this->bookingIdStatus);

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    //Updating number of people, date, time and booking id status using the PATCH
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET numberOfpeople = :numberOfpeople,
        date = :date,
        time = :time,
        bookingIdStatus = :bookingIdStatus
        WHERE id = :id ;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->numberOfpeople = htmlspecialchars(strip_tags($this->numberOfpeople));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->bookingIdStatus = htmlspecialchars(strip_tags($this->bookingIdStatus));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':numberOfpeople', $this->numberOfpeople);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':bookingIdStatus', $this->bookingIdStatus);
    
        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    

    //update date
    public function updateDate(){
        $query = 'UPDATE '.$this->table.'
        SET date = :date
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->date = htmlspecialchars(strip_tags($this->date));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':date', $this->date);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

     //update time
     public function updateTime(){
        $query = 'UPDATE '.$this->table.'
        SET time = :time
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->time = htmlspecialchars(strip_tags($this->time));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':time', $this->time);

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