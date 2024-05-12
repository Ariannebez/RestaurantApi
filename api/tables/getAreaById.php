<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$area = new area($db);


// Attempt to set the area ID from the GET request, or end execution if not provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Area ID not provided.']);
    exit;
}

$area->id = $_GET['id'];

$found = $area->read_single();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'No area found with this number.']);
    exit;
}

if ($area) {
    $area_info = array(
            'id' => $area->id,
            'tableNo' => $area->tableNo,
            'location' => $area->location,
            
    );
    echo json_encode($area_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}