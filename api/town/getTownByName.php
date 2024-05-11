<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$town = new town($db);


// Attempt to set the town name from the GET request, or end execution if not provided
if (!isset($_GET['name']) || empty($_GET['name'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Town name not provided.']);
    exit;
}

$town->name = $_GET['name'];


$found = $town->read_singleName();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'Town not found.']);
    exit;
}

if ($town) {
    $town_info = array(
        'id' => $town->id,
        'name' => $town->name,
        'countryName' => $town->countryName,
    );
    echo json_encode($town_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}