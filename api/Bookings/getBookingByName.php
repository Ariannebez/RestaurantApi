<?php
// Set endpoint headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize API
include_once('../../core/initialize.php');

// Create instance of item
$bookings = new bookings($db);

// Attempt to set the booking name from the GET request, or end execution if not provided
if (!isset($_GET['name']) || empty($_GET['name'])) {
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(['message' => 'Booking name not provided.']);
    exit;
}

$bookings->name = $_GET['name'];


$found = $bookings->read_singleName();

if (!$found) {
    // If no client was found
    http_response_code(404); // Set HTTP status code to 404 Not Found
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