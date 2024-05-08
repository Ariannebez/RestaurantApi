# Restaurant Location

## Get Location

This endpoint retrieves the locations of restaurants.

### Endpoint

`GET /getResLocation` `http://localhost:8888/RestaurantApi/api/location/getResLocation.php`

### Success Response

- **Code:** 200 OK
- **Content:** 

```json
{
    "data": [
        {
            "id": "1",
            "address": "123 Main St"
        },
        {
            "id": "2",
            "address": "456 Elm St"
        }
    ]
}
```

### Error Response

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
    "message": "No location found"
    }
```

<br>

## Create Location

This endpoint allows creating a new restaurant location.

### Endpoint

`POST /createResLocation` `http://localhost:8888/RestaurantApi/api/location/createResLocation.php`

### Variables

- `address`: The address of the restaurant. (Required)

### Body

```json
{
    "address": "789 Oak St"
}
```

### Success Response
- **Code:** 200 OK
- **Content:**

```json
    {
    "message": "Restaurant location created."
    }
```

### Error Response
- **Code:** 400 Bad Request
- **Content:**

```json
{
    "message": "Restaurant location not created."
}
```

<br>

## Update Location

This endpoint allows updating the address of an existing restaurant location.

### Endpoint

`PUT /updateLocation` `http://localhost:8888/RestaurantApi/api/location/updateLocation.php`

### Variables

- `id`: The ID of the location to be updated. (Required)
- `address`: The updated address of the restaurant. (Required)

### Body

```json
{
    "id": "location_id",
    "address": "updated_address"
}
```

### Success Response
- **Code:** 200 OK
- **Content:**

```json
    {
    "message": "Location updated."
    }
```

### Error Response
- **Code:** 404 Not Found
- **Content:**

```json
{
    "message": "ID not good. No such location with this id."
}
```

<br>

## Delete Location

This endpoint allows deleting a restaurant location based on its ID.

### Endpoint

`DELETE /deleteResLocation` `http://localhost:8888/RestaurantApi/api/location/deleteResLocation.php?id={location_id}`

### Variables

- `id`: The ID of the location to be deleted. (Required)

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

### Success Response

- **Code:** 200 OK
- **Content:** Indicates that the location was successfully deleted.

```json
{
    "message": "Location Deleted."
}
```

### Error Response
- **Code:** 404 Not Found
- **Content:**

```json
{
    "message": "ID not good. No such location with this id."
}
```

- **Code:** 400 Bad Request
- **Content:** Indicates that no location ID was provided.

```json
{
    "message": "No ID provided."
}
```