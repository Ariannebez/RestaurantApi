<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of category
$special = new special($db);
 
$data = json_decode(file_get_contents('php://input'));
 
$special->img = $data->img;
$special->item = $data->item;
$special->des = $data->des;
$special->price = $data->price;
$special->categoryId = $data->categoryId;

 
if($special->create()){
    echo json_encode(array('message' => 'Special menu created.'));
}
else{
    echo json_encode(array('message' => 'Special menu not created.'));
}
