<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
// initialize API
include_once('../core/initialize.php');
 
// Create instance of item
$bookings = new bookings($db);
$note = new note($db);
 
$data = json_decode(file_get_contents('php://input'));
 
$bookings->numberOfpeople = $data->numberOfpeople;
$bookings->date = $data->date;
$bookings->time = $data->time;
$bookings->userId = $data->userId;
$bookings->bookingIdStatus = $data->bookingIdStatus;

$note->note = $data->note;

// Start a transaction
$db->beginTransaction();

// Create booking
if ($bookings->create()) {
    // Retrieve the ID of the last inserted booking
    $bookingId = $db->lastInsertId();

    // Create the booking note with the associated bookingId
    if ($note->createNote($bookingId)) {
        echo json_encode(array('message' => 'Booking and note created successfully.'));
        $db->commit(); // Commit the transaction
    } else {
        echo json_encode(array('message' => 'Failed to create note.'));
        $db->rollBack(); // Rollback the transaction if note creation fails
    }
} else {
    echo json_encode(array('message' => 'Failed to create booking.'));
}
