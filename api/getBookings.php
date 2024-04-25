<?php
//Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../core/initialize.php');

// Create instance of User
$bookings = new bookings($db);

//calling a function from clients instance
$result = $bookings->read();

$num = $result->rowCount();

if($num > 0){
    $bookings_list=array();
    $bookings_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $bookings_item = array(
            'id' => $id,
            'numberOfpeople' => $numberOfpeople,
            'date' => $date,
            'time' => $time,
            'userId' => $userId,
            'name' => $name,
            'bookingIdStatus' => $bookingIdStatus,
            'bookingStatus' => $bookingStatus

        );
        //add current user into list 
        array_push($bookings_list['data'], $bookings_item);
    }

    echo json_encode($bookings_list);
}
else{
    echo json_encode(array('message'=>'No Booking found'));
}