<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$reviews = new reviews($db);


// Attempt to set the review name from the GET request, or end execution if not provided
if (!isset($_GET['name']) || empty($_GET['name'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Review name not provided.']);
    exit;
}

$reviews->name = $_GET['name'];


$found = $reviews->read_singleName();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'Review not found.']);
    exit;
}

if ($reviews) {
    $reviews_info = array(
        'id' => $reviews->id,
        'des' => $reviews->des,
        'userId' => $reviews->userId,
        'name' => $reviews->name
    );
    echo json_encode($reviews_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}