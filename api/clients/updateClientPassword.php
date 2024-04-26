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
$Clients = new Clients($db);

$data = json_decode(file_get_contents('php://input'));

$Clients->id = $data->id;
$Clients->password = password_hash($data->password, PASSWORD_DEFAULT);


if(!$Clients->exists()) {
    echo json_encode(array('message' => 'ID not good. No client with this id.'));
} else {
    // Updating item
    if($Clients->updatePassword()){
        echo json_encode(array('message' => 'Password updated.'));
    } else {
        echo json_encode(array('Pasword Not updated.'));
    }
}