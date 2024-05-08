# Staff

<br>

## Getting all staff

This endpoint retrieves a list of staff from the database where roleId is 2.

### Endpoint

`GET / staff` `http://localhost:8888/RestaurantApi/api/staff/getStaff.php` 

### Success Response

- **Content:** 
```json
    {
        "data": [
            {
                "id": "1",
                "email": "example1@example.com",
                 "password": "********", // Actual password is not shown
                "name": "John",
                "surname": "Doe",
                "dob": "1990-01-01",
                "addressId": "123",
                "roleId": "2"
            },
            {
                "id": "2",
                "email": "example2@example.com",
                 "password": "********", // Actual password is not shown
                "name": "Jane",
                "surname": "Doe",
                "dob": "1992-05-10",
                "addressId": "789",
                "roleId": "2"
            }
        ]
    }
```

### Error Response

- **Code:** 404 Not Found
- **Content:** 
```json
    {
        "message": "No Staff found"
    }
```

- **Code:** 403 Forbidden
- **Content:**
   
```json
    {
       "Error": "Access denied because this Id has a diffrent role."
    }
```

<br>

## Single Staff
This endpoint retrieves information about a single worker based on their ID.

### Endpoint

`GET /staffById` `http://localhost:8888/RestaurantApi/api/Staff/getStaffById.php?id=20`

### Variables

- `id`: The unique identifier of the worker. (Required)

### Success Response

- **Content:** 
```json
    {
        "id": "1",
        "email": "example@example.com",
        "password": "********", // Actual password is not shown
        "name": "John",
        "surname": "Doe",
        "dob": "1990-01-01",
        "addressId": "123",
        "roleId": "2"
    }
```

### Error Response

- **Code:** 404 Not Found
- **Content:** 
```json
    {
        "message": "Staff not found."
    }
```
    
- **Code:** 400 Bad Request
- **Content:** 
```json
    {
        "message": "Staff ID not provided."
    }
```

- **Code:** 403 Forbidden
- **Content:** 
```json
    {
        "message": "Error: Access denied because this ID has a different role."
    }
```

<br>

## Create staff
This endpoint allows the creation of a new worker along with their address.

### Endpoint

`POST /staff` `http://localhost:8888/RestaurantApi/api/staff/createStaff.php`

### Variables

* `email`
* `password`
* `name`
* `surname`
* `dob`
* `doorNo`
* `street` 
* `townId`

Below is an exmaple on how to create a new worker (all variables are required)

### Body

```json
{
    "email": "example@example.com",
    "password": "password123",
    "name": "John",
    "surname": "Doe",
    "dob": "1990-01-01",
    "addressId": 123, 
    "doorNo": "123",
    "street": "Main Street",
    "townId": 4
}
```
### Success Response

- **Content:** 
```json
    {
        "message": "Staff created."
    }
```

### Error Response

- **Code:** 400 Bad Request
- **Content:** 
```json
    {
    "error": "Field is missing or empty."
    }
```

- **Content:** 
```json
    {
    "error": "Invalid email format."
    }
```

- **Content:** 
```json
    {
    "error": "Invalid date format for dob."
    }
```

- **Content:** 
```json
    {
    "error": "Address not created."
    }
```

- **Content:** 
```json
    {
    "error": "Staff not created."
    }
```

<br>

## Update All Staff Details

This endpoint updates all the details of an existing worker.

### Endpoint

`PUT / UpdateAll` `http://localhost:8888/RestaurantApi/api/staff/updateAllStaff.php`

### Variables

All varbiables are required

* `id`
* `email`
* `password`
* `name`
* `surname`
* `dob`

### Body

```json
{
    "id": "staff_id", // Id has to be of an existing client 
    "email": "updated@example.com",
    "password": "updated_password",
    "name": "Updated Name",
    "surname": "Updated Surname",
    "dob": "1990-01-01"
}
```

### Success Response

- **Code:** 200 OK
- **Content:** 
```json
    {
        "message": "Staff updated."
    }
```

### Error Response

- **Code:** 400 Bad Request
- **Content:** 
```json
    {
        "message": "ID not good. No such staff with this id."
    }
```
    
```json
    {
        "message": "Failed to update staff details. Role ID must be 2."
    }
```

```json
    {
        "message": "Staff Not updated."
    }
```

<br>

## Update Staff Details

This endpoint updates  the email, name and surname of an existing worker.

### Endpoint

`PATCH / update` `http://localhost:8888/RestaurantApi/api/staff/updateStaff.php`

### Variables

All varbiables are required

* `id`
* `email`
* `name`
* `surname`

#### Body

```json
{
    "id": "staff_id",
    "email": "updated@example.com",
    "name": "Updated Name",
    "surname": "Updated Surname"
}
```

### Response

 **200 OK:** If the staff details are updated successfully.
- **400 Bad Request:** If the provided ID is invalid or the staff does not exist.
- **422 Unprocessable Entity:** If the role ID of the staff is not 2.

### Success Response

- **Code:** 200 OK
- **Content:** 
```json
    {
    "message": "Staff details updated successfully."
    }
```

### Error Response

- **Code:** 400 Bad Request
- **Content:** 
```json
    {
    "message": "ID not good. No such staff with this id."
    }
 ```
    
```json
    {
        "message": "Failed to update staff details. Role ID must be 2."
    }
```

<br>

## Update Password

This endpoint allows updating a client's password using a PATCH request.

### Endpoint

`PATCH / updatePassword` `http://localhost:8888/RestaurantApi/api/staff/updateStaffPassword.php`

### Variables

Varbiable is required

* `id`
* password

#### Body

```json
{
    "id": "staff_id",
    "password": "updated_password"
    
}
```

### Response

- **200 OK:** If the password is updated successfully.
- **400 Bad Request:** If the provided ID is invalid or the staff does not exist.
- **422 Unprocessable Entity:** If the role ID of the client is not 2.

### Success Response

- **Code:** 200 OK
- **Content:** 
```json
    {
    "message": "Password updated successfully."
    }
```

### Error Response

- **Code:** 400 Bad Request
- **Content:** 
```json
    {
    "message": "ID not valid. No such staff with this ID."
    }
```
```json
    {
        "message": "Failed to update password. Role ID must be 2."
    }
```

<br>

## Delete Staff 

This endpoint allows deleting a staff using a DELETE request.

### Endpoint

`DELETE / deleteStaff` `http://localhost:8888/RestaurantApi/api/staff/deleteStaff.php?id=90`

### Variables

Id varbiables is required

* `id`

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

- **200 OK:** If the staff is deleted successfully.
- **400 Bad Request:** If no ID is provided.
- **404 Not Found:** If the provided ID does not correspond to any existing staff.

### Success Response

- **Code:** 200 OK
- **Content:** 
```json
    {
    "message": "Staff Deleted."
    }
```

### Error Response

- **Code:** 400 Bad Request
- **Content:** 
```json
    {
    "message": "ID not valid. No such staff with this ID."
    }
```
```json
    {
        "message": "Staff Not Deleted"
    }
 ```