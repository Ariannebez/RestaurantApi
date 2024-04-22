<?php
//THESE ARE RTHE END POINTS 
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of address
$address = new address($db);

$data = json_decode(file_get_contents('php://input'));

$address->id = $data->id;
$address->doorNo = $data->doorNo;
$address->street = $data->street;
$address->townId = $data->townId;


if($address->update()){
    echo json_encode(array('message' => 'Address updated.'));
}
else{
    echo json_encode(array('message' => 'Address not updated.'));
}