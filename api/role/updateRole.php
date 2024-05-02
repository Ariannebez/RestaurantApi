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
$role = new role($db);

$data = json_decode(file_get_contents('php://input'));

$role->id = $data->id;
$role->name = $data->name;

if(!$role->exists()) {
    echo json_encode(array('message' => 'ID not good. No such role with this id.'));
} else {
    // Updating item
    if($role->update()){
        echo json_encode(array('message' => 'Role updated.'));
    } else {
        echo json_encode(array('Role Not updated.'));
    }
}