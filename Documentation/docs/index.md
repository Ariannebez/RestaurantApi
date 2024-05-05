# Restaurant API

For full documentation visit [mkdocs.org](https://www.mkdocs.org).

## Overview

* `get` - Retrieves data from the database, either all records, by ID, or by name.
* `create` - Creates a new row in the database using `POST`.
* `update` - Updates either a whole row using `PUT` or a specific column of a row using `PATCH`.
* `delete` - Deletes a row from the database by ID.

<br />

## Clients 
<br />
### Getting all clietns

This endpoint retrieves a list of clients from the database.

### Endpoint

`GET / clients` `http://localhost:8888/RestaurantApi/api/clients/getClients.php` 

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
                "roleId": "456"
            },
            {
                "id": "2",
                "email": "example2@example.com",
                 "password": "********", // Actual password is not shown
                "name": "Jane",
                "surname": "Doe",
                "dob": "1992-05-10",
                "addressId": "789",
                "roleId": "456"
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

<br />

### Single Client Endpoint 
This endpoint retrieves information about a single client based on their ID.

### Endpoint

`GET /clientById` `http://localhost:8888/RestaurantApi/api/clients/getClientById.php?id=22`

### Variables

- `id`: The unique identifier of the client. (Required)

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

<br />

### Create Client 
This endpoint allows the creation of a new client along with their address.

### Endpoint

`POST /clients` `http://localhost:8888/RestaurantApi/api/clients/createClient.php`

### Variables

* email
* password
* name
* surname
* dob
* doorNo
* street 
* townId

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
    "error": "Client not created."
    }
    ```

<br />

### Update All Client Details

This endpoint updates all the details of an existing client.

### Endpoint

`PUT / UpdateAll` `http://localhost:8888/RestaurantApi/api/clients/updateAllClient.php`

### Variables

All varbiables are required

* email
* password
* name
* surname
* dob

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

- **Code:** 400 Bad Request
- **Content:** 
    ```json
    {
        "message": "ID not good. No such client with this id."
    }
    ```
    ```json
    {
        "message": "Client Not updated."
    }
    ```
<br />

### Update Client Details

This endpoint updates  the email, name and surname of an existing client.

### Endpoint

`PUT / update` `http://localhost:8888/RestaurantApi/api/clients/updateClient.php`

### Variables

All varbiables are required

* email
* name
* surname

#### Body

```json
{
    "id": "client_id",
    "email": "updated@example.com",
    "name": "Updated Name",
    "surname": "Updated Surname"
}

### Success Response

- **Code:** 200 OK
- **Content:** 
    ```json
    {
    "message": "Client details updated successfully."
    }
    ```

### Error Response

- **Code:** 400 Bad Request
- **Content:** 
    ```json
    {
    "message": "ID not good. No such client with this id."
    }
    ```
    ```json
    {
        "message": "Client Not updated."
    }
    ```

<br />

## Staff 
<br />

   




   
