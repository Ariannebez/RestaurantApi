<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of item
$special = new special($db);

$data = json_decode(file_get_contents('php://input'));

$special->id = $data->id;
$special->img = $data->img;
$special->item = $data->item;
$special->des = $data->des;
$special->price = $data->price;
$special->categoryId = $data->categoryId;

if(!$special->exists()) {
    echo json_encode(array('message' => 'ID not good. No such Item with this id.'));
} else {
    // Updating item
    if($special->updateAll()){
        echo json_encode(array('message' => 'All details updated.'));
    } else {
        echo json_encode(array('message' => 'Details Not updated.'));
    }
}