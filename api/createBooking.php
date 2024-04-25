<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of item
$bookings = new bookings($db);
 
$data = json_decode(file_get_contents('php://input'));
 
$bookings->numberOfpeople = $data->numberOfpeople;
$bookings->date = $data->date;
$bookings->time = $data->time;
$bookings->userId = $data->userId;
$bookings->bookingIdStatus = $data->bookingIdStatus;

 
if($bookings->create()){
    echo json_encode(array('message' => 'Booking created.'));
}
else{
    echo json_encode(array('message' => 'Booking not created.'));
}
