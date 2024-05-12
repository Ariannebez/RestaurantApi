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
$table = new table($db);

$data = json_decode(file_get_contents('php://input'));

$table->id = $data->id;
$table->bookingStatusId = $data->bookingStatusId;
$table->areaId = $data->areaId;

if(!$table->exists()) {
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message' => 'ID not good. No such table with this id.'));
} else {
    // Updating item
    if($table->update()){
        echo json_encode(array('message' => 'Table updated.'));
    } else {
        echo json_encode(array('Table Not updated.'));
    }
}