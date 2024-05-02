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
$reviews = new reviews($db);

$data = json_decode(file_get_contents('php://input'));

$reviews->id = $data->id;
$reviews->des = $data->des;

if(!$reviews->exists()) {
    echo json_encode(array('message' => 'ID not good. No such review with this id.'));
} else {
    // Updating item
    if($reviews->update()){
        echo json_encode(array('message' => 'Review updated.'));
    } else {
        echo json_encode(array('Review Not updated.'));
    }
}