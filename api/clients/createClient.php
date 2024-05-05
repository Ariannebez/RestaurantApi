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
$address = new Address($db); // Assuming this is the correct class name

$data = json_decode(file_get_contents('php://input'));

// Validate input data
$requiredFields = ['email', 'password', 'name', 'surname', 'dob', 'doorNo', 'street', 'townId'];
foreach ($requiredFields as $field) {
    if (!isset($data->$field) || empty($data->$field)) {
        echo json_encode(array('error' => "Field '$field' is missing or empty."));
        exit;
    }
}

// Validate email format
if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array('error' => 'Invalid email format.'));
    exit;
}

// Validate date format (assuming dob is a date)
if (!strtotime($data->dob)) {
    echo json_encode(array('error' => 'Invalid date format for dob.'));
    exit;
}

try {
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
} catch (PDOException $e) {
    // Handle the exception gracefully
    echo json_encode(array('error' => $e->getMessage()));
}
