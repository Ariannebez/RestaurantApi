<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$menuCategory = new menuCategory($db);

//calling a function from clients instance
$result = $menuCategory->read();

$num = $result->rowCount();

if($num > 0){
    $menuCategory_list=array();
    $menuCategory_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $menuCategory_item = array(
            'id' => $id,
            'category' => $category 
        );
        //add current user into list 
        array_push($menuCategory_list['data'], $menuCategory_item);
    }

    echo json_encode($menuCategory_list);
}
else{
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message'=>'No Category found'));
}