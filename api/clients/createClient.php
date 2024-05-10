<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Set allowed HTTP methods
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$Clients = new Clients($db);
$address = new Address($db);

$data = json_decode(file_get_contents('php://input'));

// Validate input data
$requiredFields = ['email', 'password', 'name', 'surname', 'dob', 'doorNo', 'street', 'townId'];
foreach ($requiredFields as $field) {
    if (!isset($data->$field) || empty($data->$field)) {
        http_response_code(400); // Set HTTP status code to 400 Bad Request
        echo json_encode(array('error' => "Field '$field' is missing or empty."));
        exit;
    }
}

// Validate email format
if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(array('error' => 'Invalid email format.'));
    exit;
}

// Validate date format (assuming dob is a date)
if (!strtotime($data->dob)) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(array('error' => 'Invalid date format for dob.'));
    exit;
}

try {
    $Clients->email = $data->email;
    $Clients->password = password_hash($data->password, PASSWORD_DEFAULT);
    $Clients->name = $data->name;
    $Clients->surname = $data->surname;
    $Clients->dob = $data->dob;

    // Set address properties
    $address->doorNo = $data->doorNo;
    $address->street = $data->street;
    $address->townId = $data->townId;

    // Create address
    if ($address->createAddress()) {
        // Retrieve the ID of the last inserted address
        $addressId = $db->lastInsertId();

        // Assign the addressId to the client
        $Clients->addressId = $addressId;

        // Now, create the client with the addressId set
        if($Clients->create()){
            http_response_code(200); // Set HTTP status code to 200 Created
            echo json_encode(array('message' => 'Client created.'));
        } else {
            http_response_code(500); // Set HTTP status code to 500 Internal Server Error
            echo json_encode(array('message' => 'Client not created.'));
        }
    } else {
        http_response_code(500); // Set HTTP status code to 500 Internal Server Error
        echo json_encode(array('message' => 'Address not created.'));
    }
} catch (PDOException $e) {
    // Handle the exception gracefully
    http_response_code(500); // Set HTTP status code to 500 Internal Server Error
    echo json_encode(array('error' => $e->getMessage()));
}

