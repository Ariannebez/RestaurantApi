<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of item
$bookingStatus = new bookingStatus($db);

$data = json_decode(file_get_contents('php://input'));

$bookingStatus->id = $data->id;
$bookingStatus->name = $data->name;


if(!$bookingStatus->exists()) {
    echo json_encode(array('message' => 'ID not good. No such status with this id.'));
} else {
    // Updating item
    if($bookingStatus->update()){
        echo json_encode(array('message' => 'Status updated.'));
    } else {
        echo json_encode(array('Status Not updated.'));
    }
}