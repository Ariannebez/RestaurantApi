<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Set allowed HTTP methods
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../../core/initialize.php');

// Create instance of address
$address = new address($db);

// Decode JSON data from request body
$data = json_decode(file_get_contents('php://input'));

// Set properties from decoded JSON data
$address->id = $data->id;
$address->doorNo = $data->doorNo;
$address->street = $data->street;
$address->townId = $data->townId;

// Check if the address exists
if (!$address->exists()) {
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message' => 'ID not found. No such address with this ID.'));
} else {
    // Updating item
    if ($address->update()) {
        http_response_code(200); // Set HTTP status code to 200 OK
        echo json_encode(array('message' => 'Address updated.'));
    } else {
        http_response_code(500); // Set HTTP status code to 500 Internal Server Error
        echo json_encode(array('message' => 'Address not updated.'));
    }
}

