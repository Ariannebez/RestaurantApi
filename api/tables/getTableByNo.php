<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$table = new table($db);


// Attempt to set the table ID from the GET request, or end execution if not provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Table number not provided.']);
    exit;
}

$table->id = $_GET['id'];

$found = $table->read_single();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'No table found with this number.']);
    exit;
}

if ($table) {
    $table_info = array(
        'id' => $table->id,
        'bookingStatusId' => $table->bookingStatusId,
        'name' => $table->name,
        'areaId' => $table->areaId,
        'tableNo' => $table->tableNo,
        'location' => $table->location
    );
    echo json_encode($table_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}