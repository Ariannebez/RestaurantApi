<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of item
$gallery = new gallery($db);


// Attempt to set the gallery ID from the GET request, or end execution if not provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'ID not provided.']);
    exit;
}

$gallery->id = $_GET['id'];

$found = $gallery->read_single();

if (!$found) {
    // If no image is found with is id
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'No Image found with this id.']);
    exit;
}

if ($gallery) {
    $gallery_info = array(
        'id' => $gallery->id,
        'img' => $gallery->img,
        'des' => $gallery->des,

    );
    echo json_encode($gallery_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}