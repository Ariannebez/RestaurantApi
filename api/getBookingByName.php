<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../core/initialize.php');

// Create instance of item
$bookings = new bookings($db);


// Attempt to set the client ID from the GET request, or end execution if not provided
$bookings->name = isset($_GET['name']) ? $_GET['name'] : die(json_encode(['message' => 'Booking ID not provided.']));

$found = $bookings->read_singleName();

if (!$found) {
    // If no client was found
    echo json_encode(['message' => 'No booking found with this id.']);
    exit;
}

if ($bookings) {
    $bookings_info = array(
        'id' => $bookings->id,
        'numberOfpeople' => $bookings->numberOfpeople,
        'date' => $bookings->date,
        'time' => $bookings->time,
        'userId' => $bookings->userId,
        'bookingIdStatus' => $bookings->bookingIdStatus,
        'bookingStatus' => $bookings->bookingStatus,
        'name' => $bookings->name

    );
    echo json_encode($bookings_info);
} else {
    echo json_encode(['message' => 'Error: Access denied.']);
}