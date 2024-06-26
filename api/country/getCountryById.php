<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$country = new country($db);

// Attempt to set the client ID from the GET request, or end execution if not provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'ID not provided.']);
    exit;
}

$country->id = $_GET['id'];

$found = $country->read_single();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'No Country found with this id.']);
    exit;
}

if ($country) {
    $country_info = array(
        'id' => $country->id,
        'name' => $country->name
    );
    echo json_encode($country_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}