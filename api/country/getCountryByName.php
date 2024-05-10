<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$country = new country($db);

// Attempt to set the country name from the GET request, or end execution if not provided
if (!isset($_GET['name']) || empty($_GET['name'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Country name not provided.']);
    exit;
}

$country->name = $_GET['name'];

$found = $country->read_singleName();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'No Country not found with this name.']);
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