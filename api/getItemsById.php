<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../core/initialize.php');

// Create instance of User
$items = new items($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$items->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'Item ID not provided.']));

$found = $items->read_singleId();

if (!$found) {
    // If no client was found
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