<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of item
$items = new items($db);

$data = json_decode(file_get_contents('php://input'));

$items->id = $data->id;
$items->name = $data->name;
$items->des = $data->des;
$items->categoryId = $data->categoryId;

if(!$items->exists()) {
    echo json_encode(array('message' => 'ID not good. No such Item with this id.'));
} else {
    // Updating item
    if($items->update()){
        echo json_encode(array('message' => 'Name, des and category are updated.'));
    } else {
        echo json_encode(array('message' => 'Name, des and category are Not updated.'));
    }
}