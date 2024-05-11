<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of item
$items = new items($db);


// Attempt to set the item ID from the GET request, or end execution if not provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Item ID not provided.']);
    exit;
}

$items->id = $_GET['id'];

$found = $items->read_singleId();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'No items found with this id.']);
    exit;
}

if ($items) {
    $items_info = array(
        'id' => $items->id,
        'name' => $items->name,
        'des' => $items->des,
        'categoryId' => $items->categoryId,
    );
    echo json_encode($items_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}