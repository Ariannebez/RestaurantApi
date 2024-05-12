# Tables

<br>

## Get All Tables

Retrieves a list of all tables from the database.

### Endpoint

`GET /getTables` `http://localhost:8888/RestaurantApi/api/tables/getTable.php`

### Success Response

- **Code:** 200 OK
- **Content:**

```json
{
    "data": [
        {
            "id": 1,
            "bookingStatusId": 1,
            "name": "Table 1",
            "areaId": 1,
            "tableNo": 101,
            "location": "Main Dining Area"
        },
        {
            "id": 2,
            "bookingStatusId": 2,
            "name": "Table 2",
            "areaId": 2,
            "tableNo": 102,
            "location": "Outdoor"
        }
    ]
}
```

### Error Response

- **Code:** 404 Not Found
- **Content:**
```json
{
    "message": "No table found"
}
```

<br>

## Get Table by Number

Retrieves information about a single table based on its number.

### Endpoint

`GET /getTableByNo` `http://localhost:8888/RestaurantApi/api/tables/getTableByNo.php?id=1`

### Variables

- `id`: The table number. (Required)

### Success Response

- **Code:** 200 OK
- **Content:**

```json
{
    "id": 1,
    "bookingStatusId": 1,
    "name": "Table 1",
    "areaId": 1,
    "tableNo": 101,
    "location": "Main Dining Area"
}
```

### Error Response

- **Code:** 404 Not Found
- **Content:**
```json
{
    "message": "No table found with this number."
}
```

- **Code:** 400 Bad Request 
- **Content:**
```json
{
    "message": "No ID Provided."
}
```

## Get Tables by Status

Retrieves information about all tables with their current status.

### Endpoint

`GET /tables/getTableStatus` `http://localhost:8888/RestaurantApi/api/tables/getTableStatus.php`

### Success Response

- **Code:** 200 OK
- **Content:**

```json
{
    "data": [
        {
            "id": 1,
            "status": "Booked",
            "tableNo": 101,
            "tableId": 1
        },
        {
            "id": 2,
            "status": "Not booked",
            "tableNo": 102,
            "tableId": 2
        }
    ]
}
```

### Error Response

This error response indicates that no status information was found.

- **Code:** 404 Not Found
- **Content:**

```json
{
    "message": "No Status found"
}
```

<br>

## Get Table Status by ID

Retrieves information about a single table status based on its ID.

### Endpoint

`GET /getTableStatusById` `http://localhost:8888/RestaurantApi/api/tables/getTableStatusById.php?id=1`

### Variables

- `id`: The ID of the table status. (Required)

### Success Response

- **Code:** 200 OK
- **Content:**

```json
{
    "id": 1,
    "status": "Booked",
    "tableNo": 101,
    "tableId": 1
}
```

### Error Response

- **Code:** 400 Bad Request
- **Content:**
```json
{
    "message": "table status id not provided."
}
```

- **Code:** 404 Not Found
- **Content:**
```json
{
    "message": "No table status found with this number."
}
```

<br>

## Get All Areas

Retrieves information about all areas.

### Endpoint

`GET /getArea` `http://localhost:8888/RestaurantApi/api/tables/getArea.php`

### Success Response

- **Code:** 200 OK
- **Content:**

```json
{
    "data": [
        {
            "id": 1,
            "tableNo": "1",
            "location": "Main Dining Area"
        },
        {
            "id": 2,
            "tableNo": "2",
            "location": "Outdoor"
        }
    ]
}
```

### Error Response

- **Code:** 404 Not Found
- **Content:**

```json
{
    "message": "No Areas found"
}
```

<br>

## Get Area by ID

Retrieves information about a single area based on its ID.

### Endpoint

`GET / getArea` `http://localhost:8888/RestaurantApi/api/tables/getAreaById.php?id=3`

### Variables

- `id`: The ID of the area. (Required)

### Success Response

- **Code:** 200 OK
- **Content:**

```json
{
    "id": 1,
    "tableNo": 101,
    "location": "Main Dining Area"
}
```

### Error Response

- **Code:** 404 Not Found
- **Content:**

```json
{
    "message": "No area found with this ID."
}
```

- **Code:** 400 Bad Request
- **Content:**

```json
{
    "message": "Area id not provided."
}
```

<br>

## Create Table

This endpoint allows creating a new table.

### Endpoint

`POST /createTable` `http://localhost:8888/RestaurantApi/api/tables/createTable.php`

### Variables

- `bookingStatusId` : The ID of the booking status for the table. (Required)
- `areaId` : The ID of the area where the table is located. (Required)

### Body

- **Content :** 

```json
{
    "bookingStatusId": "1",
    "areaId": "2"
}
```

### Success Response

- **Code:** 200 OK
- **Content :** If the table is successfully created

```json
{
    "message": "Table created."
}
```

### Error Response

- **Code:** 200 OK
- **Content :** If the table creation fails

```json
{
    "message": "Table not created."
}
```

<br>

## Create Table Status

This endpoint allows creating a new table status.

### Endpoint

`POST /createTableStatus` `http://localhost:8888/RestaurantApi/api/tables/createTableStatus.php`

### Variables 

- `status`: The status of the table. (Required)
- `tableNo`: The number of the table. (Required)
- `tableId`: The ID of the table. (Required)

### Body

- **Content :** 

```json
{
    "status": "Occupied",
    "tableNo": 101,
    "tableId": 1
}
```

### Success Response

- **Code:** 200 OK
- **Content:** 

```json
{
    "message": "Table status created."
}
```

### Error Response

- **Code:** 200 OK
- **Content:** 

```json
{
    "message": "Table status not created."
}
```

<br>

## Create Table

This endpoint allows creating a new table.

### Endpoint

`POST /createTable` `http://localhost:8888/RestaurantApi/api/area/createTable.php`

### Variables

- `tableNo`: The number of the new table. (Required)
- `location`: The location of the new table. (Required)

### Body

- **Content :** 

```json
{
    "tableNo": "101",
    "location": "Main Dining Area"
}
```

### Success Response

- **Code:** 200 OK
- **Content:** If the table is successfully created
```json
{
    "message": "Table created."
}
```  

### Error Response

- **Code:** 200 OK
- **Content:** If the table creation fails
```json
{
    "message": "Table not created."
}
```
<br>

## Update Table

This endpoint allows updating the booking status and area details of an existing table.


### Endpoint

`PUT /updateTable` `http://localhost:8888/RestaurantApi/api/tables/updateTable.php`

This endpoint allows updating the details of an existing table.

### Endpoint

`PUT /updateTable` `http://localhost:8888/RestaurantApi/api/tables/updateTable.php`

### Variables

- `id`: The ID of the table to be updated. (Required)
- `bookingStatusId`: The updated booking status ID of the table.
- `areaId`: The updated area ID of the table.

### Body

- **Content :** 

```json
{
    "id": "1",
    "bookingStatusId": "2",
    "areaId": "1"
}
```

### Variables

- `id` : The ID of the table to be updated. (Required)
- `bookingStatusId` : The updated booking status ID of the table.
- `areaId` : The updated area ID of the table.

### Body

- **Content :** 

```json
{
    "id": "1",
    "bookingStatusId": "2",
    "areaId": "1"
}
```

### Success Response

- **Code:** 200 OK
- **Content:** 

```json
{
    "message": "Table updated."
}
```

### Error Responses

- **Code:** 404 Not Found
- **Content:** 

```json
{
    "message": "ID not good. No such table with this id."
}
```

- **Code:** 200 OK
- **Content:** 

```json
{
    "message": "Table Not updated."
}
```

<br>

## Update Table Area

Updates information about a table in the restaurant area.

### Endpoint

`PUT /updateArea` `http://localhost:8888/RestaurantApi/api/tables/updateArea.php`

### Variables

- `id`: The ID of the table to be updated.
- `tableNo`: The new table number.
- `location`: The new location of the table.

### Body

- **Content:**

```json
{
    "id": 1,
    "tableNo": 101,
    "location": "Main Dining Area"
}
```

### Success Response

- **Code:** 200 OK
- **Content:** 

```json
{
    "message": "Table updated."
}
```

### Error Responses

- **Code:** 404 Not Found
- **Content:** 

```json
{
    "message": "ID not good. No such table with this id."
}
```

- **Code:** 200 OK
- **Content:** 

```json
{
    "message": "Table Not updated."
}
```

<br>

## Delete Table Status

Deletes the status booking of a table.

### Endpoint

`DELETE /deleteTable` `http://localhost:8888/RestaurantApi/api/tables/deleteTable.php?id=3`

### Parameters

- `id`: The ID of the table status to be deleted. (Required)

### Success Response

- **Code:** 200 OK
- **Content:**

```json
{
    "message": "Table Deleted."
}
```

### Error Responses

- **Code:** 400 Bad Request
- **Content:** No ID Provided

```json
{
    "message": "No ID provided."
}
```

- **Code:** 404 Not Found
- **Content:** If the provided table ID does not exist
```json
{
    "message": "ID not good. No such table with that Id."
}
```

- **Code:** 200 OK
- **Content:** If the table deletion fails
```json
{
      "message": "Table Not Deleted."
}
```

<br>

## Delete Area

Deletes the a table from the restaurant.

### Endpoint

`DELETE /deleteArea` `http://localhost:8888/RestaurantApi/api/tables/deleteArea.php?id=3`

### Parameters

- `id`: The ID of the table to be deleted. (Required)

### Success Response

- **Code:** 200 OK
- **Content:**

```json
{
    "message": "Table Deleted."
}
```

### Error Responses

- **Code:** 400 Bad Request
- **Content:** No ID Provided

```json
{
    "message": "No ID provided."
}
```

- **Code:** 404 Not Found
- **Content:** If the provided table ID does not exist
```json
{
    "message": "ID not good. No such table with that Id."
}
```

- **Code:** 200 OK
- **Content:** If the table deletion fails
```json
{
      "message": "Table Not Deleted."
}
```

