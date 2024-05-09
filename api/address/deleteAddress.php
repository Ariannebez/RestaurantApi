<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../../core/initialize.php');

// Create instance of address
$address = new address($db);

$data = json_decode(file_get_contents('php://input'));

// Getting ID from the query string
$addressId = isset($_GET['id']) ? $_GET['id'] : null;

if ($addressId === null) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(array('message' => 'No ID provided.'));
    exit; // Stop script execution after sending the response
}

$address->id = $addressId;

// First, check if the client exists
if (!$address->exists()) {
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message' => 'ID not found. No such address.'));
} else {
    // Try to delete the client
    if ($address->delete()) {
        echo json_encode(array('message' => 'Address Deleted.'));
    } else {
        http_response_code(500); // Set HTTP status code to 500 Internal Server Error (or choose appropriate status code)
        echo json_encode(array('message' => 'Address Not Deleted.'));
    }
}
