<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../core/initialize.php');

// Create instance of User
$tableStatus = new tableStatus($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$tableStatus->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'table status id not provided.']));

$found = $tableStatus->read_single();

if (!$found) {
    // If no client was found
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