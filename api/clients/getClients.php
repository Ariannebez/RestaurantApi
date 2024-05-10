<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$clients = new clients($db);

//calling a function from clients instance
$result = $clients->read();

$num = $result->rowCount();

if($num > 0){
    $clients_list=array();
    $clients_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $clients_item = array(
            'id' => $id,
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'surname' => $surname,
            'dob' => $dob,
            'addressId' => $addressId,
            'roleId' => $roleId
            
        );
        //add current user into list 
        array_push($clients_list['data'], $clients_item);
    }

    echo json_encode($clients_list);
}
else{
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message'=>'No Clients found'));
}