<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of User
$special = new special($db);

$data = json_decode(file_get_contents('php://input'));

$special->id = $data->id;
$special->price = $data->price;


if(!$special->exists()) {
    echo json_encode(array('message' => 'ID not good. No such Special Item with this id.'));
} else {
    // Updating price
    if($special->updatePrice()){
        echo json_encode(array('message' => 'Price updated.'));
    } else {
        echo json_encode(array('message' => 'Price Not updated.'));
    }
}


