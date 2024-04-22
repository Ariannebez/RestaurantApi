<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of address
$country = new country($db);

$data = json_decode(file_get_contents('php://input'));

// Getting ID from the query string
$countryId = isset($_GET['id']) ? $_GET['id'] : null;

if($countryId === null) {
    echo json_encode(array('message' => 'No ID provided.'));
    exit; // Stop script execution after sending the response
}

$country->id = $countryId;

// First, check if the client exists
if(!$country->exists()) {
    echo json_encode(array('message' => 'ID not good. No such Country.'));
} else {
    // Try to delete the client
    if($country->delete()) {
        echo json_encode(array('message' => 'Country Deleted.'));
    } else {
        echo json_encode(array('message' => 'Country Not Deleted.'));
    }
}