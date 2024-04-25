<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../core/initialize.php');

// Create instance of User
$reviews = new reviews($db);

//calling a function from clients instance
$result = $reviews->read();

$num = $result->rowCount();

if($num > 0){
    $reviews_list=array();
    $reviews_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $reviews_item = array(
            'id' => $id,
            'des' => $des,
            'userId' => $userId,
            'name' => $name,
        );
        //add current roles into list 
        array_push($reviews_list['data'], $reviews_item);
    }

    echo json_encode($reviews_list);
}
else{
    echo json_encode(array('message'=>'No reviews found'));
}