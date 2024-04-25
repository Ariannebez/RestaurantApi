<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../core/initialize.php');

// Create instance of bookings
$bookings = new bookings($db);

// Initialize booking ID variable
$bookingId = null;

// Getting booking ID from the query string
if (isset($_GET['id'])) {
    $bookingId = $_GET['id'];
} else {
    echo json_encode(array('error', 'message' => 'No ID provided.'));
    exit; // Stop script execution after sending the response
}

// Setting booking ID
$bookings->id = $bookingId;

// First, check if the booking exists
if (!$bookings->exists()) {
    echo json_encode(array('message' => 'Booking not found.'));
} else {
    // Try to delete the booking
    if ($bookings->delete()) {
        echo json_encode(array('message' => 'Booking deleted.'));
    } else {
        echo json_encode(array('message' => 'Failed to delete booking.'));
    }
}
