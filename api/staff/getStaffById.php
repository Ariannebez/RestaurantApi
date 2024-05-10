<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of User
$staff = new staff($db);

// Attempt to set the client ID from the GET request, or end execution if not provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Client ID not provided.']);
    exit;
}

$staff->id = $_GET['id'];

$found = $staff->read_single();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(['message' => 'Client not found.']);
    exit;
}

if ($staff->roleId == 2) {
    // If staff found and roleId is 2, output their information
    http_response_code(200); // Set HTTP status code to 200 OK
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
    http_response_code(403); // Set HTTP status code to 403 Forbidden
    echo json_encode(['message' => 'Error: Access denied because this Id has a different role.']);
}
?>
