<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$address = new address($db);

// Check if address ID is provided, otherwise return 400 Bad Request
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Address ID not provided.']);
    exit;
}

// Set the address ID from the GET request
$address->id = $_GET['id'];

// Attempt to retrieve the address details
$found = $address->read_single();

if (!$found) {
    // If no address was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'Address not found.']);
    exit;
}

if ($address) {
    // If address details are found, prepare response
    $address_info = array(
        'id' => $address->id,
        'doorNo' => $address->doorNo,
        'street' => $address->street,
        'townName' => $address->townName,
    );
    echo json_encode($address_info);
} else {
    // If there was an error
    echo json_encode(['message' => 'Error: Access denied.']);
}
