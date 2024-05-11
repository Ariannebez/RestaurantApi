<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$role = new role($db);


// Attempt to set the role name from the GET request, or end execution if not provided
if (!isset($_GET['name']) || empty($_GET['name'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Role name not provided.']);
    exit;
}

$role->name = $_GET['name'];

$found = $role->read_single();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
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