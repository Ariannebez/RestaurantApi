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
$Clients = new Clients($db);

$data = json_decode(file_get_contents('php://input'));

$Clients->id = $data->id;
$Clients->email = $data->email;
$Clients->password = password_hash($data->password, PASSWORD_DEFAULT);
$Clients->name = $data->name;
$Clients->surname = $data->surname;
$Clients->dob = $data->dob;


// Check if client exists and roleId is 1
if (!$Clients->exists()) {
    echo json_encode(array('message' => 'ID not valid. No such client with this ID.'));
} elseif ($Clients->getRoleId() != 1) {
    echo json_encode(array('message' => 'Failed to update client details. Role ID must be 1.'));
} else {
    // Updating item
    if ($Clients->updateAll()) {
        echo json_encode(array('message' => 'Client details updated successfully.'));
    } else {
        echo json_encode(array('message' => 'Failed to update client details.'));
    }
}