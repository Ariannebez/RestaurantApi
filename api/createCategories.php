<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of category
$menuCategory = new menuCategory($db);
 
$data = json_decode(file_get_contents('php://input'));
 

$menuCategory->category = $data->category;

 
if($menuCategory->create()){
    echo json_encode(array('message' => 'Category created.'));
}
else{
    echo json_encode(array('message' => 'Category not created.'));
}
