<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

// Create instance of User
$role = new role($db);

//calling a function from clients instance
$result = $role->read();

$num = $result->rowCount();

if($num > 0){
    $role_list=array();
    $role_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $role_item = array(
            'id' => $id,
            'name' => $name 
        );
        //add current roles into list 
        array_push($role_list['data'], $role_item);
    }

    echo json_encode($role_list);
}
else{
    echo json_encode(array('message'=>'No role found'));
}