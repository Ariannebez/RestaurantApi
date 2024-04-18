<?php

class country{
    //properties for database stuff
    private $conn;
    private $table = 'country';

    //properties of country
    public $id;
    public $name;
   
    

    // address constructor
    public function __construct($db){
        $this->conn = $db; 
    }

    

}   