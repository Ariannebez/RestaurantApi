<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$clients = new clients($db);

// Attempt to set the client ID from the GET request, or end execution if not provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Client ID not provided.']);
    exit;
}

$clients->id = $_GET['id'];

$found = $clients->read_single();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'Client not found.']);
    exit;
}

if ($clients->roleId == 1) {
    // Client found and roleId is 1, output their information
    http_response_code(200); // Set HTTP status code to 200 OK
    $clients_info = array(
        'id' => $clients->id,
        'email' => $clients->email,
        'password' => $clients->password,
        'name' => $clients->name,
        'surname' => $clients->surname,
        'dob' => $clients->dob,
        'addressId' => $clients->addressId,
        'roleId' => $clients->roleId
    );
    echo json_encode($clients_info);
} else {
    // roleId is not 1 (and is 2), show error message
    http_response_code(403); // Set HTTP status code to 403 Forbidden
    echo json_encode(['message' => 'Error: Access denied because this ID has a different role.']);
}
