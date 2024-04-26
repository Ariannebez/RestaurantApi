<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$staff = new staff($db);

// Attempt to set the client ID from the GET request, or end execution if not provided
$staff->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'Client ID not provided.']));

$found = $staff->read_single();

if (!$found) {
    // If no client was found
    echo json_encode(['message' => 'Client not found.']);
    exit;
}

if ($staff->roleId == 2) {
    // If staff found and roleId is 2, output their information
    $staff_info = array(
        'id' => $staff->id,
        'email' => $staff->email,
        'password' => $staff->password,
        'name' => $staff->name,
        'surname' => $staff->surname,
        'dob' => $staff->dob,
        'addressId' => $staff->addressId,
        'roleId' => $staff->roleId
    );
    echo json_encode($staff_info);
} else {
    // roleId is not 2 (and is 1), show error message
    echo json_encode(['message' => 'Error: Access denied because this Id has a diffrent role.']);
}