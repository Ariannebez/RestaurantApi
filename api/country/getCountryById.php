<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$country = new country($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$country->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'ID not provided.']));

$found = $country->read_single();

if (!$found) {
    // If no client was found
    echo json_encode(['message' => 'No Country found with this.']);
    exit;
}

if ($country) {
    $country_info = array(
        'id' => $country->id,
        'name' => $country->name
    );
    echo json_encode($country_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}