<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of item
$bookings = new bookings($db);

$data = json_decode(file_get_contents('php://input'));

$bookings->id = $data->id;
$bookings->time = $data->time;

if(!$bookings->exists()) {
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message' => 'ID not good. No such booking with this id.'));
} else {
    // Updating Time
    if($bookings->updateTime()){
        echo json_encode(array('message' => ' Time is updated.'));
    } else {
        echo json_encode(array('Time is Not updated.'));
    }
}