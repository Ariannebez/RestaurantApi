<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of item
$items = new items($db);
 
$data = json_decode(file_get_contents('php://input'));
 

$items->name = $data->name;
$items->des = $data->des;
$items->price = $data->price;
$items->categoryId = $data->categoryId;

 
if($items->create()){
    echo json_encode(array('message' => 'Item created.'));
}
else{
    echo json_encode(array('message' => 'Item not created.'));
}
