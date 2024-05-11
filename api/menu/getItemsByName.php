<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$items = new items($db);

// Attempt to set the item name from the GET request, or end execution if not provided
if (!isset($_GET['name']) || empty($_GET['name'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Item name not provided.']);
    exit;
}

$items->name = $_GET['name'];

$found = $items->read_single();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'No items found with this name.']);
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