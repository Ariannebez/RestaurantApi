<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../core/initialize.php');

// Create instance of User
$role = new role($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$role->name = isset($_GET['name']) ? $_GET['name'] : die(json_encode(['message' => 'Country ID not provided.']));

$found = $role->read_single();

if (!$found) {
    // If no client was found
    echo json_encode(['message' => 'No role found with this name.']);
    exit;
}

if ($role) {
    $role_info = array(
        'id' => $role->id,
        'name' => $role->name
    );
    echo json_encode($role_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}