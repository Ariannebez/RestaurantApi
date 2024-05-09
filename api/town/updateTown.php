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
$town = new town($db);

$data = json_decode(file_get_contents('php://input'));

$town->id = $data->id;
$town->name = $data->name;
$town->countryId = $data->countryId;

if(!$town->exists()) {
    echo json_encode(array('message' => 'ID not good. No such town with this id.'));
} else {
    // Updating item
    if($town->update()){
        echo json_encode(array('message' => 'Role updated.'));
    } else {
        echo json_encode(array('Role Not updated.'));
    }
}