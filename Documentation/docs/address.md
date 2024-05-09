# Address

<br>

## Getting All Addresses

This endpoint retrieves a list of all addresses from the database.

### Endpoint

`GET /address` `http://localhost:8888/RestaurantApi/api/address/getAllAddresses.php`

### Success Response

- **Content:** 
```json
{
    "data": [
        {
            "id": "1",
            "doorNo": "123",
            "street": "Main Street",
            "townName": "Town A"
        },
        {
            "id": "2",
            "doorNo": "456",
            "street": "High Street",
            "townName": "Town B"
        }
    ]
}
```
### Error Response

- **Content:** 
```json
    {
    "message": "No Address found"
    }
```

<br>

## Getting Address by ID

This endpoint retrieves information about a single address based on its ID.

### Endpoint

`GET /addressById` `http://localhost:8888/RestaurantApi/api/address/getAddressById.php?id=20`

### Variables

- `id`: The unique identifier of the address. (Required)

### Success Response

- **Content:** 

```json
{
    "id": "1",
    "doorNo": "123",
    "street": "Main Street",
    "townName": "Town A"
}
```

### Error Response


- **Content:**
```json
    {
    "message": "Address not found."
    }
```

- **Content:**
```json
    {
    "message": "Address ID not provided."
    }
```

<br>

# Updating Address

This endpoint allows updating details of an existing address.

### Endpoint

`PUT /updateAddress` `http://localhost:8888/RestaurantApi/api/address/updateAddress.php`

### Variables

- `id`: The unique identifier of the address. (Required)
- `doorNo`: The door number of the address.
- `street`: The street name of the address.
- `townId`: The ID of the town associated with the address.

### Body

```json
    {
    "id": "address_id",
    "doorNo": "456",
    "street": "Updated Street",
    "townId": 2
    }
```

### Success Response

- **Content:**
```json
    {
    "message": "Address updated."
    }
```

- **Content:**
```json
    {
    "message": "ID not good. No such address with this id."
    }
```

- **Content:**
```json
    {
    "Address Not updated."
    }
```

<br>

## Delete Address

This endpoint allows deleting a address based on its ID.

### Endpoint

`DELETE /deleteAddress` `http://localhost:8888/RestaurantApi/api/address/deleteAddress.php?id=1`

### Variables

- **id**: The ID of the address to be deleted. (Required)

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

### Success Response

- **Content :** 

```json
    {
        "message": "Address Deleted."
    }
```

### Error Responses

- **Code:** 400 Bad Request
- **Content :** 
 
```json
    {
        "message": "No ID provided."
    }
```

- **Code:** 404 Not Found
- **Content :** 
 
```json
    {
        "message": "ID not good. No such address."
    }
```

- **Code:** 500 Internal Server Error
- **Content :** 
 
```json
    {
        "message": "Address Not Deleted."
    }
```