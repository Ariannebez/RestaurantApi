<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of User
$staff = new staff($db);

$data = json_decode(file_get_contents('php://input'));

$staff->id = $data->id;
$staff->email = $data->email;
$staff->password = password_hash($data->password, PASSWORD_DEFAULT);
$staff->name = $data->name;
$staff->surname = $data->surname;
$staff->dob = $data->dob;

// Check if client exists and roleId is 1
if (!$staff->exists()) {
    echo json_encode(array('message' => 'ID not valid. No such staff with this ID.'));
} elseif ($staff->getRoleId() != 2) {
    echo json_encode(array('message' => 'Failed to update staff details. Role ID must be 2.'));
} else {
    // Updating item
    if ($staff->updateAll()) {
        echo json_encode(array('message' => 'Staff details updated successfully.'));
    } else {
        echo json_encode(array('message' => 'Failed to update staff details.'));
    }
}
  