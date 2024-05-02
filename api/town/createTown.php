<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of User
$town = new town($db);
 
$data = json_decode(file_get_contents('php://input'));
 

$town->name = $data->name;
$town->countryId = $data->countryId;

 
if($town->createTown()){
    echo json_encode(array('message' => 'Town created.'));
}
else{
    echo json_encode(array('message' => 'Town not created.'));
}
