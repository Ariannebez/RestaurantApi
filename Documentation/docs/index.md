# Restaurant API

For full documentation visit [mkdocs.org](https://www.mkdocs.org).

## Overview

* `get` - Retrieves data from the database, either all records, by ID, or by name.
* `create` - Creates a new row in the database using `POST`.
* `update` - Updates either a whole row using `PUT` or a specific column of a row using `PATCH`.
* `delete` - Deletes a row from the database by ID.
* All successful code status is `200 ok` while if url is written wrong status code will be `404 not found`.

<br>

### Clients 

<br>

## Getting all clietns

This endpoint retrieves a list of clients from the database where roleId is 1.

### Endpoint

`GET / clients` `http://localhost:8888/RestaurantApi/api/clients/getClients.php` 

### Success Response

- **Code:** 200 OK
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
                "roleId": "1"
            },
            {
                "id": "2",
                "email": "example2@example.com",
                 "password": "********", // Actual password is not shown
                "name": "Jane",
                "surname": "Doe",
                "dob": "1992-05-10",
                "addressId": "789",
                "roleId": "1"
            }
        ]
    }
```

### Error Response

- **Code:** 404 Not Found
- **Content:** 
```json
    {
        "message": "No Clients found"
    }
```

<br>

## Single Client 
This endpoint retrieves information about a single client based on their ID.

### Endpoint

`GET /clientById` `http://localhost:8888/RestaurantApi/api/clients/getClientById.php?id=22`

### Variables

- `id`: The unique identifier of the client. (Required)

### Success Response

- **Code:** 200 OK
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
        "roleId": "1"
    }
```

### Error Response

- **Code:** 404 Not Found
- **Content:** 
```json
    {
        "message": "Client not found."
    }
```

- **Code:** 400 Bad Request
- **Content:** 
```json
    {
        "message": "Client ID not provided."
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

## Create Client 
This endpoint allows the creation of a new client along with their address.

### Endpoint

`POST /clients` `http://localhost:8888/RestaurantApi/api/clients/createClient.php`

### Variables

* `email`
* `password`
* `name`
* `surname`
* `dob`
* `doorNo`
* `street` 
* `townId`

Below is an exmaple on how to create a new client (all variables are required)

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

- **Code:** 200 OK
- **Content:** 
```json
    {
        "message": "Client created."
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

- **Code:** 400 Bad Request
- **Content:** 
```json
    {
    "error": "Invalid email format."
    }
```

- **Code:** 400 Bad Request
- **Content:** 
```json
    {
    "error": "Invalid date format for dob."
    }
```

- **Code:** 500 Internal Server Error
- **Content:** 
```json
    {
    "error": "Address not created."
    }
```

- **Code:** 500 Internal Server Error
- **Content:** 
```json
    {
    "error": "Client not created."
    }
```

<br>

## Update All Client Details

This endpoint updates all the details of an existing client.

### Endpoint

`PUT / UpdateAll` `http://localhost:8888/RestaurantApi/api/clients/updateAllClient.php`

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
    "id": "client_id", // Id has to be of an existing client 
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
        "message": "Client updated."
    }
```

### Error Response

- **Code:** 404 Not Found  
- **Content:** 
```json
    {
        "message": "ID not good. No such client with this id."
    }
```

- **Code:** 403 Forbidden 
```json
    {
        "message": "Failed to update client details. Role ID must be 1."
    }
```

- **Code:** 200 OK
```json
    {
        "message": "Client Not updated."
    }
```

<br>

## Update Client Details

This endpoint updates  the email, name and surname of an existing client.

### Endpoint

`PATCH / update` `http://localhost:8888/RestaurantApi/api/clients/updateClient.php`

### Variables

All varbiables are required

* `id`
* `email`
* `name`
* `surname`

#### Body

```json
{
    "id": "client_id",
    "email": "updated@example.com",
    "name": "Updated Name",
    "surname": "Updated Surname"
}
```

### Response

 **200 OK:** If the client details are updated successfully.
- **400 Bad Request:** If the provided ID is invalid or the client does not exist.
- **422 Unprocessable Entity:** If the role ID of the client is not 1.

### Success Response

- **Code:** 200 OK
- **Content:** 
```json
    {
    "message": "Client details updated successfully."
    }
```

### Error Response

- **Code:** 404 Not Found
- **Content:** 
```json
    {
    "message": "ID not good. No such client with this id."
    }
```

- **Code:** 403 Forbidden
```json
    {
        "message": "Failed to update client details. Role ID must be 1."
    }
```

<br>

## Update Password

This endpoint allows updating a client's password using a PATCH request.

### Endpoint

`PATCH / updatePassword` `http://localhost:8888/RestaurantApi/api/clients/updateClientPassword.php`

### Variables

Varbiable is required

* `id`
* `password`

#### Body

```json
{
    "id": "client_id",
    "password": "updated_password"
    
}
```

### Response

### Success Response

- **Code:** 200 OK
- **Content:** 
```json
    {
    "message": "Password updated successfully."
    }
```

### Error Response

- **Code:** 404 Not Found
- **Content:** 
```json
    {
    "message": "ID not valid. No such client with this ID."
    }
```

- **Code:** 403 Forbidden
```json
    {
        "message": "Failed to update password. Role ID must be 1."
    }
```

<br>

## Delete Client 

This endpoint allows deleting a client using a DELETE request.

### Endpoint

`DELETE / deleteClient` `http://localhost:8888/RestaurantApi/api/clients/deleteClient.php?id=90`

### Variables

Id varbiables is required

* `id`

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

- **200 OK:** If the client is deleted successfully.
- **400 Bad Request:** If no ID is provided.
- **404 Not Found:** If the provided ID does not correspond to any existing client.

### Success Response

- **Code:** 200 OK
- **Content:** 

```json
    {
    "message": "Client Deleted."
    }
```

### Error Response

- **Content:** 

- **Code:** 404 Not Found
```json
    {
    "message": "ID not good. No such client."
    }
```

- **Content:**

- **Code:** 400 Bad Request
```json
    {
        "message": "No ID provided"
    }
```


   




   
