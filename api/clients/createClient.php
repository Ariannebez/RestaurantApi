<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of User
$Clients = new Clients($db);
$address = new address($db);
 
$data = json_decode(file_get_contents('php://input'));
 
$Clients->email = $data->email;
$Clients->password = password_hash($data->password, PASSWORD_DEFAULT);
$Clients->name = $data->name;
$Clients->surname = $data->surname;
$Clients->dob = $data->dob;
$Clients->addressId = $data->addressId;
$address->doorNo = $data->doorNo;
$address->street = $data->street;
$address->townId = $data->townId;

 
// Assuming $address->create() inserts the address and returns true on success
if ($address->createAddress()) {
    // Retrieve the ID of the last inserted address
    $addressId = $db->lastInsertId();

    // Assign the addressId to the client
    $Clients->addressId = $addressId;

    // Now, create the client with the addressId set
    if($Clients->create()){
        echo json_encode(array('message' => 'Client created.'));
    } else {
        echo json_encode(array('message' => 'Client not created.'));
    }
} else {
    echo json_encode(array('message' => 'Address not created.'));
}
