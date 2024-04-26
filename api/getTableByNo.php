<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../core/initialize.php');

// Create instance of User
$table = new table($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$table->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'table number not provided.']));

$found = $table->read_single();

if (!$found) {
    // If no client was found
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