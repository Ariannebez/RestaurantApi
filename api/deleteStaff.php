<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of User
$staff = new staff($db);

$data = json_decode(file_get_contents('php://input'));

// Getting ID from the query string
$staffId = isset($_GET['id']) ? $_GET['id'] : null;

if($staffId === null) {
    echo json_encode(array('message' => 'No ID provided.'));
    exit; // Stop script execution after sending the response
}

// Setting client ID
$staff->id = $staffId;

// First, check if the client exists
if(!$staff->exists()) {
    echo json_encode(array('message' => 'ID not good. No such client.'));
} else {
    // Try to delete the client
    if($staff->delete()) {
        echo json_encode(array('message' => 'Staff Deleted.'));
    } else {
        echo json_encode(array('message' => 'Staff Not Deleted.'));
    }
}