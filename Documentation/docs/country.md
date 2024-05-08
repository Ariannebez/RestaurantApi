# Countries

<br>

## Getting All Countries
This endpoint retrieves a list of all countries from the database.

### Endpoint

`GET / getCountry` `http://localhost:8888/RestaurantApi/api/country/getCountry.php`

### Success Response

- **Code:** 200 OK
- **Content :** 

```json
  {
      "data": [
          {
              "id": "1",
              "name": "Country1"
          },
          {
              "id": "2",
              "name": "Country2"
          }
      ]
  }
```

### Error Response

- **Code:** 404 Not Found
- **Content :** 

```json
  {
      "message": "No Country found"
  }
```

<br>

## Get Country by Id

This endpoint retrieves information about a single country based on it's ID.

### Endpoint

`GET / getCountryById` `http://localhost:8888/RestaurantApi/api/country/getCountryById.php?id=1`

### Variables

- `id` : The ID of the country. (Required)

### Success Response

- **Code:** 200 OK
- **Content :** 

```json
  {
      "id": "1",
      "name": "Country1"
  }
```

### Error Responses

### Code: 404 Not Found

- **Content:** 
- **Body:**
```json
  {
      "message": "No Country found with this id."
  }
```

### Code: 400 Bad Request

- **Content:**
- **Body:**
```json
  {
      "message": "ID not provided."
  }
```

<br>

## Get Country by Name

This endpoint retrieves information about a single country based on its name.

### Endpoint

`GET / countryByName` `http://localhost:8888/RestaurantApi/api/country/getCountryByName.php`

### Variables

- `name` : The name of the country. (Required)

### Success Response

- **Code:** 200 OK
- **Content :** 

```json
  {
      "id": "1",
      "name": "Country1"
  }
```

### Error Responses

- **Code:** 404 Not Found
- **Content:** 

```json
  {
      "message": "No Country found with this name."
  }
```

- **Code:** 400 Bad Request
- **Content :** 
- **Body:**
```json
  {
    "message": "Country ID not provided."
  }
```

<br>

## Create Country

This endpoint allows creating a new country.

### Endpoint

 `POST /createCountry` ` http://localhost:8888/RestaurantApi/api/country/createCountry.php`

### Variables

- `name`: The name of the new country. (Required)

### Body

- **Content :** 
```json
  {
      "name": "NewCountry"
  }
```

### Success Response

- **Code:** 200 OK
- **Content :** 

```json
  {
      "message": "Country created."
  }
```

### Error Response

- **Code:** 400 Bad Request
  - **Content :** 

```json
    {
        "message": "Country not created."
    }
```

<br>

## Update Country

This endpoint allows updating the details of an existing country.

### Endpoint

`PUT /updateCountry`  `http://localhost:8888/RestaurantApi/api/country/updateCountry.php`

### Variables

- `id` : The ID of the country to be updated. (Required)
- `name` : The updated name of the country. (Required)

### Body

- **Content :** 

```json
  {
      "id": "country_id",
      "name": "UpdatedCountryName"
  }
```

### Success Response

- **Code:** 200 OK
- **Content:** 
  
```json
    {
        "message": "Country updated."
    }
```

### Error Responses

- **Code:** 400 Bad Request
- **Content:** 
  
```json
    {
        "message": "ID not good. No such country with this id."
    }
```

- **Code:** 400 Bad Request
- **Content:** 
  
```json
    {
       "message": "Country Not updated."
    }
```

<br>

## Delete Country

This endpoint allows deleting a country based on its ID.

### Endpoint

`DELETE /deleteCountry` `http://localhost:8888/RestaurantApi/api/country/deleteCountry.php?id=1`

### Variables

- **id**: The ID of the country to be deleted. (Required)

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

### Success Response

- **Code:** 200 OK
- **Content :** 

```json
    {
        "message": "Country Deleted."
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
        "message": "ID not good. No such Country."
    }
```

- **Code:** 400 Bad Request
- **Content :** 
 
```json
    {
        "message": "Country Not Deleted."
    }
```