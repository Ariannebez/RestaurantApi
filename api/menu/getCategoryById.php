<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$menuCategory = new menuCategory($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$menuCategory->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'Category ID not provided.']));

$found = $menuCategory->read_single();

if (!$found) {
    // If no client was found
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

