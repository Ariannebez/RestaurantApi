<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$items = new items($db);

//calling a function from clients instance
$result = $items->readMeat();

$num = $result->rowCount();

if($num > 0){
    $items_list=array();
    $items_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $items_item = array(
            'id' => $id,
            'name' => $name,
            'des' => $des,
            'price' => $price,
            'category' => $category
        );
        //add current roles into list 
        array_push($items_list['data'], $items_item);
    }

    echo json_encode($items_list);
}
else{
    // If no items in the database 404 not status code and no items will be displayed
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message'=>'No items found'));
}