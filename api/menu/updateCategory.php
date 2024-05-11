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
$menuCategory = new menuCategory($db);

$data = json_decode(file_get_contents('php://input'));

$menuCategory->id = $data->id;
$menuCategory->category = $data->category;


if(!$menuCategory->exists()) {
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message' => 'ID not good. No such category with this id.'));
} else {
    // Updating item
    if($menuCategory->updateAll()){
        echo json_encode(array('message' => 'Category updated.'));
    } else {
        echo json_encode(array('Category Not updated.'));
    }
}