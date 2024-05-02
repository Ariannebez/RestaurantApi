<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of User
$location = new location($db);
 
$data = json_decode(file_get_contents('php://input'));
 

$location->address = $data->address;


 
if($location->create()){
    echo json_encode(array('message' => 'Restaurant location created.'));
}
else{
    echo json_encode(array('message' => 'Restaurant location  not created.'));
}
