<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$bookingStatus = new bookingStatus($db);

//calling a function from clients instance
$result = $bookingStatus->read();

$num = $result->rowCount();

if($num > 0){
    $bookingStatus_list=array();
    $bookingStatus_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $bookingStatus_item = array(
            'id' => $id,
            'name' => $name
        );
        //add current user into list 
        array_push($bookingStatus_list['data'], $bookingStatus_item);
    }

    echo json_encode($bookingStatus_list);
}
else{
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message'=>'No Status found'));
}