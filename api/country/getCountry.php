<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$country = new country($db);

//calling a function from clients instance
$result = $country->read();

$num = $result->rowCount();

if($num > 0){
    $country_list=array();
    $country_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $country_item = array(
            'id' => $id,
            'name' => $name 
        );
        //add current user into list 
        array_push($country_list['data'], $country_item);
    }

    echo json_encode($country_list);
}
else{
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message'=>'No Country found'));
}