<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../core/initialize.php');

// Create instance of item
$gallery = new gallery($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$gallery->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'ID not provided.']));

$found = $gallery->read_single();

if (!$found) {
    // If no client was found
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