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
//$Clients->roleId = $data->roleId;

if(!$Clients->exists()) {
    echo json_encode(array('message' => 'ID not good. No such client with this id.'));
} else {
    // Updating item
    if($Clients->updateAll()){
        echo json_encode(array('message' => 'Password updated.'));
    } else {
        echo json_encode(array('Password Not updated.'));
    }
}