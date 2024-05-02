<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$address = new address($db);

//calling a function from clients instance
$result = $address->read();

$num = $result->rowCount();

if($num > 0){
    $address_list=array();
    $address_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $address_item = array(
            'id' => $id,
            'doorNo' => $doorNo,
            'street' => $street,
            'townName' => $townName,
            
            
        );
        //add current user into list 
        array_push($address_list['data'], $address_item);
    }

    echo json_encode($address_list);
}
else{
    echo json_encode(array('message'=>'No Address found'));
}