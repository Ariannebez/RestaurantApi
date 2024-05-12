<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$tableStatus = new tableStatus($db);

//calling a function from clients instance
$result = $tableStatus->read();

$num = $result->rowCount();

if($num > 0){
    $tableStatus_list=array();
    $tableStatus_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $tableStatus_item = array(
            'id' => $id,
            'status' => $status,
            'tableNo' => $tableNo,
            'tableId' => $tableId,

        );
        //add current user into list 
        array_push($tableStatus_list['data'], $tableStatus_item);
    }

    echo json_encode($tableStatus_list);
}
else{
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message'=>'No Status found'));
}