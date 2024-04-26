<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../../core/initialize.php');
 
// Create instance of User
$staff = new staff($db);
$address = new address($db);
 
$data = json_decode(file_get_contents('php://input'));
 
$staff->email = $data->email;
$staff->password = $data->password;
$staff->name = $data->name;
$staff->surname = $data->surname;
$staff->dob = $data->dob;
$staff->addressId = $data->addressId;
$address->doorNo = $data->doorNo;
$address->street = $data->street;
$address->townId = $data->townId;

 
// Assuming $address->create() inserts the address and returns true on success
if ($address->createAddress()) {
    // Retrieve the ID of the last inserted address
    $addressId = $db->lastInsertId();

    // Assign the addressId to the client
    $staff->addressId = $addressId;

    // Now, create the client with the addressId set
    if($staff->create()){
        echo json_encode(array('message' => 'Staff created.'));
    } else {
        echo json_encode(array('message' => 'Staff not created.'));
    }
} else {
    echo json_encode(array('message' => 'Address not created.'));
}
