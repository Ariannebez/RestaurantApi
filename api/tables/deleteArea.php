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
$area = new area($db);

$data = json_decode(file_get_contents('php://input'));

// Getting ID from the query string
$areaId = isset($_GET['id']) ? $_GET['id'] : null;

if($areaId === null) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(array('message' => 'No ID provided.'));
    exit; // Stop script execution after sending the response
}

$area->id = $areaId;

// First, check if the client exists
if(!$area->exists()) {
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message' => 'ID not good. No such table with that Id.'));
} else {
    // Try to delete the client
    if($area->delete()) {
        echo json_encode(array('message' => 'Table Deleted.'));
    } else {
        echo json_encode(array('message' => 'Table Not Deleted.'));
    }
}