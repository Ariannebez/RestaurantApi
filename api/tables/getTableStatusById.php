<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$tableStatus = new tableStatus($db);


// Attempt to set the table status ID from the GET request, or end execution if not provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Table status ID not provided.']);
    exit;
}

$tableStatus->id = $_GET['id'];

$found = $tableStatus->read_single();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'No table status found with this number.']);
    exit;
}

if ($tableStatus) {
    $tableStatus_info = array(
            'id' => $tableStatus->id,
            'status' => $tableStatus->status,
            'tableNo' => $tableStatus->tableNo,
            'tableId' => $tableStatus->tableId,
    );
    echo json_encode($tableStatus_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}