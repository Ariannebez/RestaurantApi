<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../core/initialize.php');

// Create instance of User
$town = new town($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$town->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'Town ID not provided.']));

$found = $town->read_single();

if (!$found) {
    // If no client was found
    echo json_encode(['message' => 'Town not found.']);
    exit;
}

if ($town) {
    $town_info = array(
        'id' => $town->id,
        'name' => $town->name,
        'countryName' => $town->countryName,
    );
    echo json_encode($town_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}