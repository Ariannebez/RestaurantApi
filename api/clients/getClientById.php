<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$clients = new clients($db);

// Attempt to set the client ID from the GET request, or end execution if not provided
$clients->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'Client ID not provided.']));

$found = $clients->read_single();

if (!$found) {
    // If no client was found
    echo json_encode(['message' => 'Client not found.']);
    exit;
}

if ($clients->roleId == 1) {
    // Client found and roleId is 1, output their information
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
    echo json_encode(['message' => 'Error: Access denied because this Id has a diffrent role.']);
}