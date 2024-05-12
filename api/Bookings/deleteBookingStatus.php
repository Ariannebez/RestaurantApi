<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of address
$bookingStatus = new bookingStatus($db);

$data = json_decode(file_get_contents('php://input'));

// Getting ID from the query string
$bookingStatusId = isset($_GET['id']) ? $_GET['id'] : null;

if($bookingStatusId === null) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(array('message' => 'No ID provided.'));
    exit; // Stop script execution after sending the response
}

// Setting client ID
$bookingStatus->id = $bookingStatusId;

// First, check if the client exists
if(!$bookingStatus->exists()) {
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message' => 'ID not good. No such status.'));
} else {
    // Try to delete the client
    if($bookingStatus->delete()) {
        echo json_encode(array('message' => 'Status Deleted.'));
    } else {
        echo json_encode(array('message' => 'Status Not Deleted.'));
    }
}