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
$gallery = new gallery($db);

$data = json_decode(file_get_contents('php://input'));

$gallery->id = $data->id;
$gallery->img = $data->img;
$gallery->des = $data->des;

if(!$gallery->exists()) {
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message' => 'ID not good. No such image with this id.'));
} else {
    // Updating item
    if($gallery->update()){
        echo json_encode(array('message' => 'Image details updated.'));
    } else {
        echo json_encode(array('Image Not updated.'));
    }
}