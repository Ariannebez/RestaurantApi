<?php

class note{
    //properties for database stuff
    private $conn;
    private $table = 'bookingNote';
    
    
    //properties of user
    public $id;
    public $note;
    public $bookingId;
    
    // Booking constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    
    //creating booking
    public function createNote($bookingId) {
        $query = "INSERT INTO " . $this->table . " SET note = :note, bookingId = :bookingId";

        $stmt = $this->conn->prepare($query);

        $this->note = htmlspecialchars(strip_tags($this->note));

        $stmt->bindParam(':note', $this->note);
        $stmt->bindParam(':bookingId', $bookingId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //update note by id
    public function updateNote(){
        $query = 'UPDATE '.$this->table.'
        SET note = :note
        WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->note = htmlspecialchars(strip_tags($this->note));
        
        //binding the parameters to request
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':note', $this->note); // Ensure password is securely hashed
        
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