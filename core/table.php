<?php

class table {
    //properties for database stuff
    private $conn;
    private $table = '`table`'; // Properly escaped using backticks

    //properties of table
    public $id;
    public $bookingStatusId;
    public $areaId;
    public $name;
    public $tableNo;
    public $location;

    // address constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    //Getting tables
    public function read(){
        $query = 'SELECT t.id, t.bookingStatusId, s.name, t.areaId, a.tableNo, a.location 
        FROM '.$this->table.' t
        JOIN bookingStatus s ON s.id = t.bookingStatusId
        JOIN area a ON a.id = t.areaId ;';

        //Prepare statement
        $stmt =  $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }
}

    