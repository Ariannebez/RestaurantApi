# Bookings

<br>

## Get All Bookings

This endpoint retrieves a list of all bookings from the database.

### Endpoint

`GET /bookings` `http://localhost:8888/RestaurantApi/api/bookings/getAllBookings.php`

### Success Response

- **Content:** 

```json
{
    "data": [
        {
            "id": "1",
            "numberOfpeople": "4",
            "date": "2024-05-15",
            "time": "19:00:00",
            "userId": "123",
            "name": "John Doe",
            "bookingIdStatus": "456",
            "bookingStatus": "confirmed"
        },
        {
            "id": "2",
            "numberOfpeople": "2",
            "date": "2024-05-16",
            "time": "20:00:00",
            "userId": "456",
            "name": "Jane Doe",
            "bookingIdStatus": "789",
            "bookingStatus": "pending"
        }
    ]
}
```

### Error Response

- **Content:** 
```json
{
    "message": "No Bookings found"
}
```

<br>

## Get Booking by Name

This endpoint retrieves information about a single booking based on its name.

### Endpoint

`GET /bookingsByName` `http://localhost:8888/RestaurantApi/api/bookings/getBookingByName.php`

### Variables

* `name` : The name of the booking. (Required)

### Success Response

- **Content:** 

```json
{
    "id": "1",
    "numberOfpeople": "4",
    "date": "2024-05-15",
    "time": "19:00:00",
    "userId": "123",
    "bookingIdStatus": "456",
    "bookingStatus": "confirmed",
    "name": "John Doe"
}
```

<br>

## Get Booking by ID

This endpoint retrieves information about a single booking based on its ID.

##### Endpoint

`GET /bookingsById` `http://localhost:8888/RestaurantApi/api/bookings/getBookingById.php?id={id}`

#### Variables

- `id`: The unique identifier of the booking. (Required)

### Success Response

- **Content:** 

```json
{
    "id": "1",
    "numberOfpeople": "4",
    "date": "2024-05-15",
    "time": "19:00:00",
    "userId": "123",
    "bookingIdStatus": "456",
    "bookingStatus": "confirmed",
    "name": "John Doe"
}
```

### Error Responses

- **Content:** 
```json
    {
    "message": "No booking found with this id."
    }
```

- **Content:** 
```json
    {
    "message": "Booking ID not provided."
    }
```

<br>

## Get All Booking Status

This endpoint retrieves a list of all booking statuses from the database.

### Endpoint

`GET /bookingStatus` `http://localhost:8888/RestaurantApi/api/bookings/getAllBookingStatus.php`

### Success Response

- **Content:** 

```json
{
    "data": [
        {
            "id": "1",
            "name": "Confirmed"
        },
        {
            "id": "2",
            "name": "Pending"
        }
    ]
}
```

### Error Response

- **Content:** 

```json
{
    "message": "No Status found"
}
```

<br>

## Create Booking with Note

This endpoint allows creating a new booking along with a note.

### Endpoint

`POST /createBookings` `http://localhost:8888/RestaurantApi/api/bookings/createBooking.php`

### Variables

All variables are requires.

- `numberOfpeople` : The number of people for the booking.
- `date` : The date of the booking.
- `time` : The time of the booking.
- `userId` : The ID of the user making the booking.
- `bookingIdStatus` : The ID of the booking status.
- `note` : The note associated with the booking.

### Body

```json
{
    "numberOfpeople": "4",
    "date": "2024-05-15",
    "time": "19:00:00",
    "userId": "123",
    "bookingIdStatus": "456",
    "note": "This is a note for the booking."
}
```

### Success Response

- **Content:** 

```json
{
    "message": "Booking and note created successfully."
}
```

### Error Responses

- **Content:** 
```json
    {
        "message": "Failed to create booking."
    }
```
- **Content:** 
```json
    {
        "message": "Failed to create note."
    }
```
<br>

## Create Booking Status

This endpoint allows creating a new booking status.

### Endpoint

`POST /bookingStatus` `http://localhost:8888/RestaurantApi/api/booking/createBookingStatus.php`

### Variables

- `name` : The name of the booking status.

### Body

```json
{
    "name": "Aporoved"
}
```

### Success Response

- **Content:** 

```json
{
    "message": "Status created."
}
```

### Error Response

- **Content:** 

```json
{
    "message": "Status not created."
}
```

<br>

## Update Booking Details

This endpoint allows updating the details of an existing booking.

### Endpoint

`PATCH /bookings` `http://localhost:8888/RestaurantApi/api/bookings/updateBooking.php`

### Variables

All variables are required.

- `id` : The ID can't be updated, it's just the unique identifier of the of the booking.
- `numberOfpeople` : The updated number of people for the booking.
- `date` : The updated date of the booking.
- `time` : The updated time of the booking.
- `bookingIdStatus` : The updated ID of the booking status.

### Body

```json
{
    "id": "booking_id",
    "numberOfpeople": "updated_number_of_people",
    "date": "updated_date",
    "time": "updated_time",
    "bookingIdStatus": "updated_booking_status_id"
}
```

### Success Response

- **Content:** 

```json
{
    "message": "Number of people, time, date, and Status Id are updated."
}
```

### Error Response

- **Content:** 

```json
{
    "message": "ID not good. No such booking with this id."
}
```

```json
{
    "message": "Number of people, time, date, and Status Id are Not updated."
}
```

<br>

## Update Booking Date

This endpoint allows updating the date of an existing booking.

### Endpoint

`PATCH /updateBookingDate` `http://localhost:8888/RestaurantApi/api/bookings/updateBookingDate.php`

### Variables

- `id` : The ID of the booking to be updated. (Required)
- `date` : The updated date of the booking. (Required)

### Body

```json
{
    "id": "booking_id",
    "date": "updated_date"
}
```

### Success Response

- **Content:** 

```json
{
    "message": "Date is updated."
}
```

### Error Response

- **Content:** 

```json
{
    "message": "ID not good. No such booking with this id."
}
```

- **Content:** 

```json
{
    "message": "Date is Not updated."
}
```

<br>

## Update Booking Time

This endpoint allows updating the time of an existing booking.

### Endpoint

`PATCH /updateBookingTime` `http://localhost:8888/RestaurantApi/api/bookings/updateBookingTime.php`

### Variables

- `id`: The ID of the booking to be updated. (Required)
- `date`: The updated time of the booking. (Required)

### Body

```json
{
    "id": "booking_id",
    "date": "updated_time"
}
```

### Success Response

- **Content:** 

```json
{
    "message": "Time is updated."
}
```

### Error Response

- **Content:** 

```json
{
    "message": "ID not good. No such booking with this id."
}
```

- **Content:** 

```json
{
    "message": "Time is Not updated."
}
```

<br>

## Update Note 

This endpoint allows updating a note.

### Endpoint
`PATCH /updateBookingNote` `http://localhost:8888/RestaurantApi/api/bookings/updateBookingNote.php`


### Variables

  - `id` : The unique identifier of the note. (Required)
  - `note` : The updated note content.

### Body

```json
{
    "id": "note_id",
    "note": "Updated note content."
}
```

### Success Response

- **Content:** 

```json
{
    "message": "Note is updated."
}
```

### Error Responses

  - **Content:** 

```json
{
    "message": "ID not good. No such note with this id."
}
```

  - **Content:** 

```json
{
    "message": "Note is Not updated."
}
```

<br>

## Update Status 

This endpoint allows updating details of an existing booking status.

### Endpoint
`PATCH /updateBookingStatus` `http://localhost:8888/RestaurantApi/api/bookings/updateBookingStatus.php`


### Variables

  - `id` : The unique identifier of the status. (Required)
  - `name` : The updated name of the booking status.

### Body

```json
{
    "id": "status_id",
    "name": "Updated Status Name"
}
```

#### Success Response

- **Content:** 

```json
  {
      "message": "Status updated."
  }
```

### Error Responses

  - **Content:** 

```json
{
    "message": "ID not good. No such status with this id."
}
```

  - **Content:** 

```json
{
    "message": "Status Not updated."
}
```

<br>

## Delete Booking

This endpoint allows deleting a booking base on it's ID, using a DELETE request.

### Endpoint

`DELETE / deleteBooking` `http://localhost:8888/RestaurantApi/api/bookings/deleteBooking.php?id=90`

### Variables
- `id` : The unique identifier of the booking. (Required)

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

#### Success Response

- **Content:** Indicates that the booking was successfully deleted.

```json
    {
        "message": "Booking deleted."
    }
```

#### Error Responses

- **Content:** Indicates that no booking ID was provided.

```json
    {
        "message": "No ID provided."
    }
```

 - **Content:** Indicates that the provided booking ID does not correspond to any existing booking.
    
```json
    {
        "message": "Booking not found."
    }
```

- **Content:** 

```json
    {
        "message": "Failed to delete booking."
    }
```

<br>

## Delete Booking Status

This endpoint deletes a booking status based on its ID.

### Endpoint

`DELETE / deleteBookingStatus` `http://localhost:8888/RestaurantApi/api/bookings/deleteBookingStatus.php?id=90`

### Variables
- `id` : The unique identifier of the booking staus. (Required)

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

#### Success Response

  - **Content:** Indicates that the booking status was successfully deleted.

```json
    {
        "message": "Booking Status deleted."
    }
```

#### Error Responses

- **Content:** Indicates that no booking status ID was provided.

```json
    {
        "message": "No ID provided."
    }
```

- **Content:** Indicates that the provided booking status ID does not correspond to any existing booking.
    
```json
    {
        "message": "Booking Staatus not found."
    }
```

- **Content:** 

```json
    {
        "message": "Failed to delete Sttaus Booking."
    }
```

<br>

## Delete Note

This endpoint deletes a note based on its ID.

### Endpoint

`DELETE / deleteNote` `http://localhost:8888/RestaurantApi/api/bookings/deleteNote.php?id=90`

### Variables
- `id` : The unique identifier of the note. (Required)

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

#### Success Response

- **Content:** Indicates that the booking status was successfully deleted.

```json
    {
        "message": "Note Deleted."
    }
```

#### Error Responses

- **Content:** Indicates that no booking status ID was provided.

```json
    {
        "message": "No ID provided."
    }
```

- **Content:** Indicates that the provided note ID does not correspond to any existing notes.
    
```json
    {
        "message": "ID not good. No such note with this id."
    }
```

- **Content:** 

```json
    {
        "message": "Note Not Deleted."
    }
```