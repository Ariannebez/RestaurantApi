<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$gallery = new gallery($db);

//calling a function from clients instance
$result = $gallery->read();

$num = $result->rowCount();

if($num > 0){
    $gallery_list=array();
    $gallery_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $gallery_item = array(
            'id' => $id,
            'img' => $img,
            'des' => $des,
            
        );
        //add current roles into list 
        array_push($gallery_list['data'], $gallery_item);
    }

    echo json_encode($gallery_list);
}
else{
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message'=>'No images found'));
}