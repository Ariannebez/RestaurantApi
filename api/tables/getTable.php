<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$table = new table($db);

//calling a function from clients instance
$result = $table->read();

$num = $result->rowCount();

if($num > 0){
    $table_list=array();
    $table_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $table_item = array(
            'id' => $id,
            'bookingStatusId' => $bookingStatusId,
            'name' => $name,
            'areaId' => $areaId,
            'tableNo' => $tableNo,
            'location' => $location
         
        );
        //add current user into list 
        array_push($table_list['data'], $table_item);
    }

    echo json_encode($table_list);
}
else{
    http_response_code(404); // Set HTTP status code to 404 Not Found
    echo json_encode(array('message'=>'No table found'));
}