<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of User
$Clients = new Clients($db);
$address = new address($db);
 
$data = json_decode(file_get_contents('php://input'));
 
$Clients->email = $data->email;
$Clients->password = $data->password;
$Clients->name = $data->name;
$Clients->surname = $data->surname;
$Clients->dob = $data->dob;
$address->addressId = $data->addressId;
 
if($Clients->create()){
    echo json_encode(array('message' => 'Clietn created.'));
}
else{
    echo json_encode(array('message' => 'Clietn not created.'));
}