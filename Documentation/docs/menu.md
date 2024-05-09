# Menu

## Get all items

This endpoint retrieves all items in the menu.

### Endpoint

`GET /getItems` `http://localhost:8888/RestaurantApi/api/menu/gettems.php`

### Response

The endpoint returns a JSON response containing an array of items.

### Success Response

- **Content:** An array of items.

```json
{
    "data": [
        {
            "id": "1",
            "name": "Item 1",
            "des": "Description of Item 1",
            "price": "10.99",
            "categoryId": "1",
            "category": "Category A"
        },
        {
            "id": "2",
            "name": "Item 2",
            "des": "Description of Item 2",
            "price": "8.99",
            "categoryId": "1",
            "category": "Category A"
        },
        ...
    ]
}
```

### Error Response

- **Content:** Indicates that no items were found.
```json
{
    "message": "No items found"
}
```

## Get item by ID

This endpoint retrieves an item from the menu based on its ID.

### Endpoint

`GET /getItemsById` `http://localhost:8888/RestaurantApi/api/menu/getItemsById.php?id={23}`

### Variables
`id` : The ID of the item to retrieve. (Required)

### Response
The endpoint returns a JSON response containing the details of the item.

### Success Response

-**Content:** Details of the item.

```json
{
    "id": "1",
    "name": "Item 1",
    "des": "Description of Item 1",
    "categoryId": "1"
}
```

### Error Response

-**Content:** Indicates that no item ID was provided.
```json
{
    "message": "Item ID not provided."
}
```

## Get item by Name

This endpoint retrieves an item from the menu based on its name.

### Endpoint
`GET /getItemsByName` `http://localhost:8888/RestaurantApi/api/menu/getItemsByName.php?name={item_name}`

### Variables

`name` : The name of the item to retrieve. (Required)

### Response
The endpoint returns a JSON response containing the details of the item.

### Success Response

- **Content:** Details of the item.
```json
{
    "id": "1",
    "name": "Item 1",
    "des": "Description of Item 1",
    "categoryId": "1"
}
```
### Error Response

- **Content:** Indicates that no item name was provided.

```json
{
    "message": "Item name not provided."
}
```

<br>

## Create Item

This endpoint allows creating a new menu item.

### Endpoint

`POST /createItem` `http://localhost:8888/RestaurantApi/api/menu/createItem.php`

### Variables

- `name`: The name of the menu item.
- `des`: The description of the menu item.
- `price`: The price of the menu item.
- `categoryId`: The ID of the category to which the menu item belongs.

### Body Example

```json
{
    "name": "Item Name",
    "des": "Description of Item",
    "price": "9.99",
    "categoryId": "1"
}
```

### Success Response

- **Content:** Indicates that the menu item was successfully created.
```json
{
    "message": "Item created."
}
```

### Error Response

- **Content:** Indicates that the menu item was not created.
```json
{
    "message": "Item not created."
}
```

<br>

## Update All Item

This endpoint allows updating all the details of a menu item.

### Endpoint

`PUT /updateAllItem` `http://localhost:8888/RestaurantApi/api/menu/updateAllItem.php`

### Variables

- `id` : The ID of the menu item to be updated.
- `name` : The updated name of the menu item.
- `des`: The updated description of the menu item.
- `price` : The updated price of the menu item.
- `categoryId` : The updated ID of the category to which the menu item belongs.

### Body Example

```json
{
    "id": "item_id",
    "name": "Updated Item Name",
    "des": "Updated Description of Item",
    "price": "12.99",
    "categoryId": "2"
}
```

### Response
The endpoint returns a JSON response indicating the status of the operation.

### Success Response

- **Content:** Indicates that the details of the menu item were successfully updated.

```json
{
    "message": "All details updated."
}
```

### Error Response

- **Content:** Indicates that the menu item ID provided is invalid or does not exist.

```json
{
    "message": "ID not good. No such Item with this id."
}
```

<br>

## Update A Patch Of An Item 

This endpoint allows updating specific details of a menu item.

### Endpoint

`PATCH /updateItem` `http://localhost:8888/RestaurantApi/api/menu/updateItem.php`

### Variables

- `id` : The ID of the menu item to be updated.
- `name` : The updated name of the menu item.
- `des` : The updated description of the menu item.
- `categoryId` : The updated ID of the category to which the menu item belongs.

### Body Example

```json
{
    "id": "item_id",
    "name": "Updated Item Name",
    "des": "Updated Description of Item",
    "categoryId": "2"
}
```

### Success Response

- **Content:** Indicates that the specified details of the menu item were successfully updated.
```json
{
    "message": "Name, des, and category are updated."
}
```

### Error Response

- **Content:** Indicates that the menu item ID provided is invalid or does not exist.

```json
{
    "message": "ID not good. No such Item with this id."
}
```

<br>

## Update Item Price

This endpoint allows updating the price of a menu item.

### Endpoint

`PATCH /updateItemPrice` `http://localhost:8888/RestaurantApi/api/menu/updateItemPrice.php`

### Variables

- `id` : The ID of the menu item to update.
- `price` : The updated price of the menu item.

### Body Example

```json
{
    "id": "item_id",
    "price": "10.99"
}
```

### Response
The endpoint returns a JSON response indicating the status of the operation.

### Success Response

- **Content:** Indicates that the price of the menu item was successfully updated.

```json
{
    "message": "Price updated."
}
```

### Error Response

- **Content:** Indicates that the menu item ID provided is invalid or does not exist.

```json
{
    "message": "ID not good. No such Item with this id."
}
```

<br>

## Delete Item

This endpoint allows deleting a menu item based on its ID.

### Endpoint

`DELETE /deleteItem` `http://localhost:8888/RestaurantApi/api/menu/deleteItem.php?id={2}`

### Vriables

- `id`: The ID of the menu item to be deleted. (Required)

### Response

The endpoint returns a JSON response indicating the status of the delete operation.

### Success Response

- **Content:** Indicates that the menu item was successfully deleted.

```json
{
    "message": "Item Deleted."
}
```

### Error Response

- **Content:** Indicates that no item ID was provided.

```json
{
    "message": "No ID provided."
}
```

<br>

# Specials

## Get all specials

This endpoint retrieves all special items.

### Endpoint

`GET /getAllSpecials` `http://localhost:8888/RestaurantApi/api/special/getAllSpecials.php`

### Response

The endpoint returns a JSON response containing an array of special items.

### Success Response

- **Content:** An array of special items.

```json
{
    "data": [
        {
            "id": "1",
            "img": "special_image_url",
            "item": "Special Item 1",
            "des": "Description of Special Item 1",
            "price": "12.99",
            "category": "Special Category A"
        },
        {
            "id": "2",
            "img": "special_image_url",
            "item": "Special Item 2",
            "des": "Description of Special Item 2",
            "price": "14.99",
            "category": "Special Category B"
        },
        ...
    ]
}
```

### Error Response

- **Content:** Indicates that no special items were found.
```json
{
    "message": "No special items found"
}
```

<br>

## Get Special by Name

This endpoint retrieves a special item by its name.

### Endpoint

`GET /getSpecialByName` `http://localhost:8888/RestaurantApi/api/special/getSpecialByName.php`

### Variables

- `item` (required): The name of the special item.

### Response

The endpoint returns a JSON response containing the details of the special item.

### Success Response

- **Content:** Details of the special item.

```json
{
    "id": "1",
    "img": "special_image_url",
    "item": "Special Item 1",
    "des": "Description of Special Item 1",
    "category": "Special Category A"
}
```

### Error Response

- **Content:** Indicates that no special items were found with the provided name.

```json
{
    "message": "No special items found with this name."
}
```

<br>

## Create Special

This endpoint allows creating a new special menu item.

### Endpoint

`POST /createSpecial` `http://localhost:8888/RestaurantApi/api/menu/createSpecial.php`

### Variables

- `img` : The image URL of the special menu item.
- `item` : The name of the special menu item.
- `des` : The description of the special menu item.
- `price` : The price of the special menu item.
- `categoryId` : The ID of the category to which the special menu item belongs.

### Body Example

```json
{
    "img": "special_image_url",
    "item": "Special Item 1",
    "des": "Description of Special Item 1",
    "price": "19.99",
    "categoryId": "1"
}
```

### Response
The endpoint returns a JSON response indicating the status of the operation.

### Success Response

- **Content:** Indicates that the special menu item was successfully created.
```json
{
    "message": "Special menu created."
}
```

### Error Response

- **Content:** Indicates that the special menu item was not created.
```json
{
    "message": "Special menu not created."
}
```

<br>

## Update Special Item

This endpoint allows updating all details of a special menu item.

### Endpoint

`PUT /updateSpecialItem` `http://localhost:8888/RestaurantApi/api/special/updateSpecialItem.php`

### Variables

- `id`  : The ID of the special item to be updated. (Required)
- `img` : The updated image URL of the special item.
- `item` : The updated name of the special item.
- `des` : The updated description of the special item.
- `price` : The updated price of the special item.
- `categoryId` : The updated category ID of the special item.

### Body

```json
{
    "id": "item_id",
    "img": "updated_image_url",
    "item": "updated_item_name",
    "des": "updated_item_description",
    "price": "updated_item_price",
    "categoryId": "updated_category_id"
}
```

### Response
The endpoint returns a JSON response indicating the status of the update operation.

### Success Response

- **Content:** Indicates that all details of the special item were successfully updated.
```json
{
    "message": "All details updated."
}
```

### Error Response

- **Content:** Indicates that no item with the provided ID was found.

```json
{
    "message": "ID not good. No such Item with this id."
}
```

<br>

## Update Special Item Price

This endpoint allows updating the price of a special item.

### Endpoint

`PATCH /updateSpecialPrice` `http://localhost:8888/RestaurantApi/api/menu/updateSpecialPrice.php`

### Variables

- `id` : The ID of the special item to update.
- `price` : The updated price of the special item.

### Body Example

```json
{
    "id": "special_id",
    "price": "10.99"
}
```

### Response
The endpoint returns a JSON response indicating the status of the operation.

### Success Response

- **Content:** Indicates that the price of the special item was successfully updated.

```json
{
    "message": "Price updated."
}
```

### Error Response

- **Content:** Indicates that the special item ID provided is invalid or does not exist.

```json
{
    "message": "ID not good. No such special item with this id."
}
```

<br>

## Delete Special Item

This endpoint allows deleting a special item based on its ID.

### Endpoint

`DELETE /deleteSpecial` `http://localhost:8888/RestaurantApi/api/menu/deleteSpecial.php?id={2}`

### Vriables

- `id`: The ID of the special item to be deleted. (Required)

### Response

The endpoint returns a JSON response indicating the status of the delete operation.

### Success Response

- **Content:** Indicates that the special item was successfully deleted.

```json
{
    "message": "Item Deleted."
}
```

### Error Response

- **Content:** Indicates that no special item ID was provided.

```json
{
    "message": "No ID provided."
}
```

<br>

# Categories

<br>

## Get All Menu Categories

This endpoint retrieves all menu categories available.

### Endpoint

`GET / getCategories` `http://localhost:8888/RestaurantApi/api/menu/getCategories.php`

### Response

The endpoint returns a JSON response containing an array of menu categories.

### Success Response

- **Content:** Indicates that menu categories were found.

```json
{
    "data": [
        {
            "id": "category_id_1",
            "category": "category_name_1"
        },
        {
            "id": "category_id_2",
            "category": "category_name_2"
        },
        ...
    ]
}
```

### Error Response

- **Content:** Indicates that no menu categories were found.

```json
{
    "message": "No Country found"
}
```

<br>

## Get Menu Category by ID

This endpoint retrieves a specific menu category by its ID.

### Endpoint

`GET / getCategoryById` `http://localhost:8888/RestaurantApi/api/menu/getCategoryById.php?id={4}`

### Variables

- `id` : The ID of the menu category to retrieve. (Required)

### Response

The endpoint returns a JSON response containing the details of the requested menu category.

### Success Response

- **Content:** Indicates that the menu category was found.

```json
{
    "id": "category_id",
    "category": "category_name"
}
```

### Error Response: No Category Found

This error response indicates that no menu category was found with the provided ID.

### Response

The endpoint returns a JSON response indicating that no menu category was found with the provided ID.

- `Content:` Indicates that no menu category was found with the provided ID.

```json
{
    "message": "No Category found with this id."
}
```

<br>

## Get Starter Items 

This endpoint retrieves starter items from the menu by category.

### Endpoint

`GET /getAlllstarters` `http://localhost:8888/RestaurantApi/api/menu/getAllStarters.php`

### Response
The endpoint returns a list of starter items in JSON format.

- **Content:** JSON array containing information about the starter items.

```json
{
    "data": [
        {
            "id": "1",
            "name": "Starter Item 1",
            "des": "Description of starter item 1",
            "price": "9.99",
            "category": "Starters"
        },
        {
            "id": "2",
            "name": "Starter Item 2",
            "des": "Description of starter item 2",
            "price": "8.99",
            "category": "Starters"
        },
        ...
    ]
}
```

### Error Response
If no starter items are found, the endpoint returns a JSON response indicating that no items were found.

- **Content:** Indicates that no items were found.

```json
{
    "message": "No items found"
}
```

<br>

## Get Pasta Items 

This endpoint retrieves pasta items from the menu by category.

### Endpoint

`GET /getAlllPasta` `http://localhost:8888/RestaurantApi/api/menu/getAllPasta.php`

### Response
The endpoint returns a list of pasta items in JSON format.

- **Content:** JSON array containing information about the starter items.

```json
{
    "data": [
        {
            "id": "1",
            "name": "pasta Item 1",
            "des": "Description of pasta item 1",
            "price": "9.99",
            "category": "pasta"
        },
        {
            "id": "2",
            "name": "pasta Item 2",
            "des": "Description of pasta item 2",
            "price": "8.99",
            "category": "pasta"
        },
        ...
    ]
}
```

### Error Response
If no pasta items are found, the endpoint returns a JSON response indicating that no items were found.

- **Content:** Indicates that no items were found.

```json
{
    "message": "No items found"
}
```

<br>

## Get Meat Items 

This endpoint retrieves meat items from the menu by category.

### Endpoint

`GET /getAlllMeat` `http://localhost:8888/RestaurantApi/api/menu/getAllMeat.php`

### Response
The endpoint returns a list of meat items in JSON format.

- **Content:** JSON array containing information about the starter items.

```json
{
    "data": [
        {
            "id": "1",
            "name": "meat Item 1",
            "des": "Description of meat item 1",
            "price": "9.99",
            "category": "meat"
        },
        {
            "id": "2",
            "name": "meat Item 2",
            "des": "Description of meat item 2",
            "price": "8.99",
            "category": "meat"
        },
        ...
    ]
}
```

### Error Response
If no meat items are found, the endpoint returns a JSON response indicating that no items were found.

- **Content:** Indicates that no items were found.

```json
{
    "message": "No items found"
}
```

<br>

## Get Fish Items 

This endpoint retrieves fish items from the menu by category.

### Endpoint

`GET /getAlllFish` `http://localhost:8888/RestaurantApi/api/menu/getAllFish.php`

### Response
The endpoint returns a list of fish items in JSON format.

- **Content:** JSON array containing information about the fish items.

```json
{
    "data": [
        {
            "id": "1",
            "name": "fish Item 1",
            "des": "Description of fish item 1",
            "price": "9.99",
            "category": "fish"
        },
        {
            "id": "2",
            "name": "fish Item 2",
            "des": "Description of fish item 2",
            "price": "8.99",
            "category": "fish"
        },
        ...
    ]
}
```

### Error Response
If no kids items are found, the endpoint returns a JSON response indicating that no items were found.

- **Content:** Indicates that no items were found.

```json
{
    "message": "No items found"
}
```

<br>

## Get Kids Items 

This endpoint retrieves kids items from the menu by category.

### Endpoint

`GET /getAlllKids` `http://localhost:8888/RestaurantApi/api/menu/getAllKids.php`

### Response
The endpoint returns a list of kids items in JSON format.

- **Content:** JSON array containing information about the kids items.

```json
{
    "data": [
        {
            "id": "1",
            "name": "kids Item 1",
            "des": "Description of kids item 1",
            "price": "9.99",
            "category": "kids"
        },
        {
            "id": "2",
            "name": "kids Item 2",
            "des": "Description of kids item 2",
            "price": "8.99",
            "category": "kids"
        },
        ...
    ]
}
```

### Error Response
If no kids items are found, the endpoint returns a JSON response indicating that no items were found.

- **Content:** Indicates that no items were found.

```json
{
    "message": "No items found"
}
```

<br>

## Get Desserts

This endpoint retrieves dessert items from the menu by category.

### Endpoint

`GET /getAlllDesserts` `http://localhost:8888/RestaurantApi/api/menu/getAllDesserts.php`

### Response
The endpoint returns a list of dessert items in JSON format.

- **Content:** JSON array containing information about the dessert items.

```json
{
    "data": [
        {
            "id": "1",
            "name": "dessert Item 1",
            "des": "Description of dessert item 1",
            "price": "9.99",
            "category": "dessert"
        },
        {
            "id": "2",
            "name": "dessert Item 2",
            "des": "Description of dessert item 2",
            "price": "8.99",
            "category": "dessert"
        },
        ...
    ]
}
```

### Error Response
If no dessert items are found, the endpoint returns a JSON response indicating that no items were found.

- **Content:** Indicates that no items were found.

```json
{
    "message": "No items found"
}
```

<br>

## Get Drinks

This endpoint retrieves drink items from the menu by category.

### Endpoint

`GET /getAlllDrinks` `http://localhost:8888/RestaurantApi/api/menu/getAllDrinks.php`

### Success Response
The endpoint returns a list of drinks in JSON format.

- **Content:** JSON array containing information about the drink.

```json
{
    "data": [
        {
            "id": "1",
            "name": "drink Item 1",
            "des": "Description of drink item 1",
            "price": "9.99",
            "category": "drink"
        },
        {
            "id": "2",
            "name": "drink Item 2",
            "des": "Description of drink item 2",
            "price": "8.99",
            "category": "drink"
        },
        ...
    ]
}
```

### Error Response
If no drink are found, the endpoint returns a JSON response indicating that no items were found.

- **Content:** Indicates that no drink were found.

```json
{
    "message": "No items found"
}
```

<br>

## Update Menu Category

This endpoint allows updating the details of a menu category.

### Endpoint

`PUT /updateCategory` `http://localhost:8888/RestaurantApi/api/menu/updateCategory.php`

### Variables

- `id` : (required): The ID of the menu category to be updated.
- `category` : (required): The updated category name.


### Body

```json
{
    "id": "category_id",
    "category": "updated_category"
}
```

### Success Response

- **Content:** If the menu category is successfully updated

```json
{
    "message": "Category updated."    
}
```

### Error Response

- **Content:** If the provided category ID does not exist

```json
{
    "message": "ID not good. No such client with this id."
}
```

<br>

## Delete Category

This endpoint allows deleting a menu item based on its ID.

### Endpoint

`DELETE /deleteCategory` `http://localhost:8888/RestaurantApi/api/menu/deleteCategory.php?id={2}`

### Vriables

- `id`: The ID of the category to be deleted. (Required)

### Response

The endpoint returns a JSON response indicating the status of the delete operation.

### Success Response

- **Content:** Indicates that the category was successfully deleted.

```json
{
    "message": "Category Deleted."
}
```

### Error Response

- **Content:** Indicates that no category ID was provided.

```json
{
    "message": "No ID provided."
}
```

- **Content:** Category was not deleted

```json
{
    "message": "Category Not Deleted"
}
```