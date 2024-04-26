<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of User
$tableStatus = new tableStatus($db);
 
$data = json_decode(file_get_contents('php://input'));
 
$tableStatus->status = $data->status;
$tableStatus->tableNo = $data->tableNo;
$tableStatus->tableId = $data->tableId;


if($tableStatus->create()){
    echo json_encode(array('message' => 'Table status created.'));
}
else{
    echo json_encode(array('message' => 'Table status not created.'));
}

