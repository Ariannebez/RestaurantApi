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
$staff->password = $data->password;
$staff->name = $data->name;
$staff->surname = $data->surname;
$staff->dob = $data->dob;
//$Clients->roleId = $data->roleId;

if($staff->updateAll()){
    echo json_encode(array('message' => 'Staff details updated.'));
}
else{
    echo json_encode(array('message' => 'Staff not updated.'));
}