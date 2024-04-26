<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../core/initialize.php');

// Create instance of User
$area = new area($db);


$area->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'Area id not provided.']));

$found = $area->read_single();

if (!$found) {
    // If no client was found
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