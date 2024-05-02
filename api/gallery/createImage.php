<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of User
$gallery = new gallery($db);
 
$data = json_decode(file_get_contents('php://input'));
 

$gallery->img = $data->img;
$gallery->des = $data->des;
 
if($gallery->create()){
    echo json_encode(array('message' => 'Image created.'));
}
else{
    echo json_encode(array('message' => 'Image not created.'));
}
