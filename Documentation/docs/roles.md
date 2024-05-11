# Roles

## Getting All Roles

This endpoint retrieves a list of all roles from the database.

### Endpoint

`GET /getRole` `hhttp://localhost:8888/RestaurantApi/api/role/getRole.php`

### Success Response

- **Code:** 200 OK
- **Content:**

```json
{
    "data": [
        {
            "id": "1",
            "name": "Admin"
        },
        {
            "id": "2",
            "name": "User"
        }
    ]
}
```

### Error Response

- **Code:** 404 Not Found
- **Content:**

```json
{
    "message": "No role found"
}
```

<br>

## Get Role by Name

This endpoint retrieves information about a single role based on its name.

### Endpoint

`GET /getRoleByName` `http://localhost:8888/RestaurantApi/api/role/getRoleByName.php?name=staff`

### Variables

- `name`: The name of the role. (Required)

### Success Response

- **Code:** 200 OK
- **Content:**

```json
{
    "id": "2",
    "name": "staff"
}
```

### Error Response

- **Code:** 404 Not Found
- **Content:**

```json
{
    "message": "No role found with this name."
}
```

- **Code:** 400 Bad Request
- **Content:**

```json
{
    "message": "Role name not provided."
}
```

<br>

## Create Role
This endpoint allows creating a new role.

### Endpoint

`POST /createRole` `http://localhost:8888/RestaurantApi/api/role/createRole.php`

### Variables 

- `name`: The name of the new role. (Required)

### Body

- **Content :** 

```json
{
    "name": "Admin"
}
```

### Success Response

- **Content :** 

```json
{
    "message": "Role created."
}
```

### Error Response

- **Content :** 

```json
{
    "message": "Role not created."
}
```

<br>

## Update Role

This endpoint allows updating the details of an existing role.

### Endpoint

`PUT /updateRole` `http://localhost:8888/RestaurantApi/api/role/updateRole.php`

### Variables

- `id` : The ID of the role to be updated. (Required)
- `name` : The updated name of the role. (Required)

### Body

- **Content :** 

```json
{
    "id": "1",
    "name": "Manager"
}
```

### Success Response

- **Code:** 200 OK
- **Content :** 

```json
{
    "message": "Role updated."
}
```

### Error Response

- **Code:** 404 Not Found
- **Content :** 

```json
{
    "message": "ID not good. No such role with this id."
}
```

- **Code:** 200 OK
- **Content :** 

```json
{
    "message": "Role Not updated."
}
```

<br>

## Delete Role

This endpoint allows deleting a role based on its ID.

### Endpoint

`DELETE /deleteRole` `http://localhost:8888/RestaurantApi/api/role/deleteRole.php?id=5`

### Variables

- `id`: The ID of the role to be deleted. (Required)

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

### Success Response

- **Code:** 404 Not Found
- **Content :** 

```json
{
    "message": "Role Deleted."
}
```

### Error Responses

- **Code:** 400 Bad Request
- **Content:** If no ID is provided in the request:

```json
{
    "message": "No ID provided."
}
```

- **Code:** 404 Not Found
- **Content:** If the provided role ID does not exist:

```json
{
    "message": "ID not good. No such Role."
}
```

