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

- **Code:** 404 Not Found
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

- **Code:** 404 Not Found
- **Content:**
```json
    {
    "message": "Address not found."
    }
```

- **Code:** 400 Bad Request
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

- **Code:** 404 Not Found
- **Content:**
```json
    {
    "message": "ID not good. No such address with this id."
    }
```

- **Code:** 400 Bad Request
- **Content:**
```json
    {
    "Address Not updated."
    }
```
