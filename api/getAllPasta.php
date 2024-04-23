<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../core/initialize.php');

// Create instance of User
$items = new items($db);

//calling a function from clients instance
$result = $items->readPasta();

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
    echo json_encode(array('message'=>'No items found'));
}