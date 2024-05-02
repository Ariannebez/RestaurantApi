<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$town = new town($db);

//calling a function from clients instance
$result = $town->read();

$num = $result->rowCount();

if($num > 0){
    $town_list=array();
    $town_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $town_item = array(
            'id' => $id,
            'name' => $name,
            'countryName' => $countryName,
            
            
            
        );
        //add current user into list 
        array_push($town_list['data'], $town_item);
    }

    echo json_encode($town_list);
}
else{
    echo json_encode(array('message'=>'No Town found'));
}