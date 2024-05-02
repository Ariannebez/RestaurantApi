<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of town
$location = new location($db);

$data = json_decode(file_get_contents('php://input'));

$location->id = $data->id;
$location->address = $data->address;

if(!$location->exists()) {
    echo json_encode(array('message' => 'ID not good. No such location with this id.'));
} else {
    // Updating item
    if($location->update()){
        echo json_encode(array('message' => 'Location updated.'));
    } else {
        echo json_encode(array('Location Not updated.'));
    }
}