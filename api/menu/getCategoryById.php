<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$menuCategory = new menuCategory($db);


// Attempt to set the menu category ID from the GET request, or end execution if not provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Category ID not provided.']);
    exit;
}

$menuCategory->id = $_GET['id'];

$found = $menuCategory->read_single();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'No Category found with this id.']);
    exit;
}

if ($menuCategory) {
    $menuCategory_info = array(
        'id' => $menuCategory->id,
        'category' => $menuCategory->category,
    );
    echo json_encode($menuCategory_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}

