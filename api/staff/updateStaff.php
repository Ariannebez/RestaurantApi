<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of User
$staff = new staff($db);

$data = json_decode(file_get_contents('php://input'));

$staff->id = $data->id;
$staff->email = $data->email;
$staff->name = $data->name;
$staff->surname = $data->surname;

// Check if staff exists and roleId is 2
if (!$staff->exists()) {
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message' => 'ID not valid. No such staff with this ID.'));
} elseif ($staff->getRoleId() != 2) {
    http_response_code(403); // Set HTTP status code to 403 Forbidden
    echo json_encode(array('message' => 'Failed to update staff details. Role ID must be 2.'));
} else {
    // Updating staff
    if ($staff->update()) {
        echo json_encode(array('message' => 'Staff details updated successfully.'));
    } else {
        echo json_encode(array('message' => 'Failed to update staff details.'));
    }
}