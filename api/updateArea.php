<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of town
$area = new area($db);

$data = json_decode(file_get_contents('php://input'));

$area->id = $data->id;
$area->tableNo = $data->tableNo;
$area->location = $data->location;

if(!$area->exists()) {
    echo json_encode(array('message' => 'ID not good. No such table with this id.'));
} else {
    // Updating table
    if($area->update()){
        echo json_encode(array('message' => 'Table updated.'));
    } else {
        echo json_encode(array('Table Not updated.'));
    }
}