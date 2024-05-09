<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$area = new area($db);

//calling a function from clients instance
$result = $area->read();

$num = $result->rowCount();

if($num > 0){
    $area_list=array();
    $area_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $area_item = array(
            'id' => $id,
            'tableNo' => $tableNo,
            'location' => $location
         
        );
        //add current user into list 
        array_push($area_list['data'], $area_item);
    }

    echo json_encode($area_list);
}
else{
    echo json_encode(array('message'=>'No Area found'));
}