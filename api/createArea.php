<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of area
$area = new area($db);
 
$data = json_decode(file_get_contents('php://input'));
 
$area->tableNo = $data->tableNo;
$area->location = $data->location;


if($area->create()){
    echo json_encode(array('message' => 'Table created.'));
}
else{
    echo json_encode(array('message' => 'Table not created.'));
}

