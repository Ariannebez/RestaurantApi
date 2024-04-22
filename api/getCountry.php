<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../core/initialize.php');

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
        $town_item = array(
            'id' => $id,
            'name' => $name 
        );
        //add current user into list 
        array_push($country_list['data'], $town_item);
    }

    echo json_encode($country_list);
}
else{
    echo json_encode(array('message'=>'No Country found'));
}