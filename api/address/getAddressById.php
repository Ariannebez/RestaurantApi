<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$address = new address($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$address->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'Address ID not provided.']));

$found = $address->read_single();

if (!$found) {
    // If no client was found
    echo json_encode(['message' => 'Address not found.']);
    exit;
}

if ($address) {
    $address_info = array(
        'id' => $address->id,
        'doorNo' => $address->doorNo,
        'street' => $address->street,
        'townName' => $address->townName,
    );
    echo json_encode($address_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}