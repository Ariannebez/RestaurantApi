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
$reviews = new reviews($db);

$data = json_decode(file_get_contents('php://input'));

// Getting ID from the query string
$reviewsId = isset($_GET['id']) ? $_GET['id'] : null;

if($reviewsId === null) {
    echo json_encode(array('message' => 'No ID provided.'));
    exit; // Stop script execution after sending the response
}

$reviews->id = $reviewsId;

// First, check if the client exists
if(!$reviews->exists()) {
    echo json_encode(array('message' => 'ID not good. No such Review with that Id.'));
} else {
    // Try to delete the client
    if($reviews->delete()) {
        echo json_encode(array('message' => 'Review Deleted.'));
    } else {
        echo json_encode(array('message' => 'Review Not Deleted.'));
    }
}