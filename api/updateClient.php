<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of User
$Clients = new Clients($db);

$data = json_decode(file_get_contents('php://input'));

$Clients->id = $data->id;
$Clients->email = $data->email;
$Clients->password = $data->password;
$Clients->name = $data->name;
$Clients->surname = $data->surname;
$Clients->dob = $data->dob;
//$Clients->roleId = $data->roleId;

if($Clients->update()){
    echo json_encode(array('message' => 'User updated.'));
}
else{
    echo json_encode(array('message' => 'User not updated.'));
}