<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$special = new special($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$special->item = isset($_GET['item']) ? $_GET['item'] : die(json_encode(['message' => 'Item name not provided.']));

$found = $special->read_single();

if (!$found) {
    // If no client was found
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