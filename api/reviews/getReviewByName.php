<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$reviews = new reviews($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$reviews->name = isset($_GET['name']) ? $_GET['name'] : die(json_encode(['message' => 'Review ID not provided.']));

$found = $reviews->read_singleName();

if (!$found) {
    // If no client was found
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