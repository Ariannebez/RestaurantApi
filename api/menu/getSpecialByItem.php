<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$special = new special($db);


// Attempt to set the item from the GET request, or end execution if not provided
if (!isset($_GET['item']) || empty($_GET['item'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Item name not provided.']);
    exit;
}

$special->item = $_GET['item'];

$found = $special->read_single();

if (!$found) {
    // If no item was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'No special items found with this name.']);
    exit;
}

if ($special) {
    $special_info = array(
        'id' => $special->id,
        'img' => $special->img,
        'item' => $special->item,
        'des' => $special->des,
        'category' => $special->category,
    );
    echo json_encode($special_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}