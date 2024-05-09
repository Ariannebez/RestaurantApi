# Town

<br>

## Getting All Town's
This endpoint retrieves a list of all town's from the database.

### Endpoint

`GET / getTown` `http://localhost:8888/RestaurantApi/api/town/getTown.php`

### Success Response

- **Content :** 

```json
  {
      "data": [
          {
              "id": "1",
              "name": "town1",
              "countryName": "Gozo"
          },
          {
              "id": "2",
              "name": "town2",
              "countryName": "Malta"
          }
      ]
  }
```

### Error Response

- **Content :** 

```json
  {
      "message": "No Town's found"
  }
```

<br>

## Get Town by Id

This endpoint retrieves information about a single town based on it's ID.

### Endpoint

`GET / getTownById` `http://localhost:8888/RestaurantApi/api/town/getTownById.php?id=1`

### Variables

- `id` : The ID of the town. (Required)

### Success Response

- **Content :** 

```json
  {
    "id": "1",
    "name": "town1",
    "countryName": "Gozo"
  }
```

### Error Responses


- **Content:** 
- **Body:**
```json
  {
      "message": "No Town found with this id."
  }
```

- **Content:**
- **Body:**
```json
  {
      "message": "ID not provided."
  }
```

<br>

## Get Town by Name

This endpoint retrieves information about a single town based on its name.

### Endpoint

`GET / TownByName` `http://localhost:8888/RestaurantApi/api/town/getTownByName.php?name=Xaghra`

### Variables

- `name` : The name of the town. (Required)

### Success Response

- **Content :** 

```json
  {
    "id": 2,
    "name": "Xaghra",
    "countryName": "Gozo"
  }
```

### Error Responses

- **Content:** 

```json
  {
      "message": "No town found with this name."
  }
```

- **Content :** 
- **Body:**
```json
  {
    "message": "Town name not provided."
  }
```

<br>

## Create Town

This endpoint allows creating a new town.

### Endpoint

 `POST /createCountry` `http://localhost:8888/RestaurantApi/api/town/createTown.php`

### Variables

- `name`: The name of the newtown. (Required)
- `countryId`: The country id of the new town. (Required)

### Body

- **Content :** 
```json
  {
    "name":"Xeldi",
    "countryId":"1"
  }
```

### Success Response

- **Content :** 

```json
  {
      "message": "Town created."
  }
```

### Error Response

  - **Content :** 

```json
    {
        "message": "Town not created."
    }
```

<br>

## Update Town

This endpoint allows updating the details of an existing country.

### Endpoint

`PUT /updateCountry`  `http://localhost:8888/RestaurantApi/api/town/updateTown.php`

### Variables

- `id` : The ID of the country to be updated. (Required)
- `name` : The updated name of the town. (Required)
- `countryId` : The updated countryId of the town. (Required)

### Body

- **Content :** 

```json
  {
    "id":"90",
    "name":"Xaghra",
    "countryId":"1"
  }
```

### Success Response

- **Content:** 
  
```json
    {
        "message": "Town updated."
    }
```

### Error Responses

- **Content:** 
  
```json
    {
        "message": "ID not good. No such town with this id."
    }
```

- **Content:** 
  
```json
    {
       "message": "Town Not updated."
    }
```

<br>

## Delete Town

This endpoint allows deleting a town based on its ID.

### Endpoint

`DELETE /deleteCountry` `http://localhost:8888/RestaurantApi/api/town/deleteTown.php?id=1`

### Variables

- **id**: The ID of the town to be deleted. (Required)

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

### Success Response

- **Content :** 

```json
    {
        "message": "Town Deleted."
    }
```

### Error Responses

- **Content :** 
 
```json
    {
        "message": "No ID provided."
    }
```

- **Content :** 
  
```json
    {
        "message": "ID not good. No such Town."
    }
```

- **Content :** 
 
```json
    {
        "message": "Town Not Deleted."
    }
```