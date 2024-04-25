<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../core/initialize.php');

// Create instance of User
$location = new location($db);

//calling a function from clients instance
$result = $location->read();

$num = $result->rowCount();

if($num > 0){
    $location_list=array();
    $location_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $location_item = array(
            'id' => $id,
            'adddress' => $address,
        );
        //add current roles into list 
        array_push($location_list['data'], $location_item);
    }

    echo json_encode($location_list);
}
else{
    echo json_encode(array('message'=>'No items found'));
}