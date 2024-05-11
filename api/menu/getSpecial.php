<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$special = new special($db);

//calling a function from clients instance
$result = $special->read();

$num = $result->rowCount();

if($num > 0){
    $special_list=array();
    $special_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $special_item = array(
            'id' => $id,
            'img' => $img,
            'item' => $item,
            'des' => $des,
            'price' => $price,
            'category' => $category,
        );
        //add current roles into list 
        array_push($special_list['data'], $special_item);
    }

    echo json_encode($special_list);
}
else{
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message'=>'No special item found'));
}