# Reviews

## Getting All Reviews

This endpoint retrieves a list of all reviews.

### Endpoint

`GET /reviews` `http://localhost:8888/RestaurantApi/api/reviews/getAllReviews.php`

### Success Response

- **Content:**

```json
{
    "data": [
        {
            "id": "1",
            "des": "Description of the review",
            "userId": "123",
            "name": "John Doe"
        },
        {
            "id": "2",
            "des": "Another review description",
            "userId": "456",
            "name": "Jane Smith"
        }
    ]
}
```

### Error Response
- **Content:**

```json
{
    "message": "No reviews found"
}
```

<br>

## Get Review by Name

This endpoint retrieves information about a single review based on its name.

### Endpoint

`GET /getReviewByName` `http://localhost:8888/RestaurantApi/api/reviews/getReviewByName.php?name=updata`

### Variables

- `name`: The name of the user who made the review. (Required)

#### Success Response

- **Content:**

```json
{
    "id": "1",
    "des": "Description of the review",
    "userId": "123",
    "name": "John Doe"
}
```

### Error Responses

- **Content:**
```json
{
    "message": "Review not found."
}
```

- **Content:**
```json
{
    "message": "Review name not provided."
}
```

<br>

## Create Review

This endpoint allows creating a new review.

### Endpoint

`POST /createReview` `http://localhost:8888/RestaurantApi/api/reviews/createReview.php`

### Variables

- `des`: The description of the review. (Required)
- `userId`: The ID of the user who created the review. (Required)

### Body

- **Content:**

```json
{
    "des": "Description of the review",
    "userId": "123"
}
```

### Success Response

- **Content:**
```json
{
    "message": "Review created."
}
```

### Error Response

- **Content:**
```json
{
    "message": "Review not created."
}
```

<br>

## Update Review

This endpoint allows updating the details of an existing review.

### Endpoint

`PUT /updateReview` `http://localhost:8888/RestaurantApi/api/reviews/updateReview.php`

### Variables

- `id`: The ID of the review to be updated. (Required)
- `des`: The updated description of the review. (Required)

### Body

- **Content:**

```json
{
    "id": "123",
    "des": "Updated description of the review"
}
```

### Success Response

- **Content:**
```json
{
    "message": "Review updated."
}
```

### Error Response

- **Content:**

```json
{
    "message": "Review Not updated."
}
```

- **Content:**

```json
{
    "message": "ID not good. No such review with this id."
}
```

<br>

## Delete Review
This endpoint allows deleting a review based on its ID.

### Endpoint

`DELETE /deleteReview` `http://localhost:8888/RestaurantApi/api/reviews/deleteReview.php?id=24`

### Variables

- `id`: The ID of the review to be deleted. (Required)

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

### Success Response

- **Content:**

```json
{
    "message": "Review Deleted."
}
```

### Error Responses

- **Content:**
```json
{
    "message": "No ID provided."
}
```

- **Content:**

```json
{
    "message": "ID not good. No such Review with that Id."
}
```

- **Content:**

```json
{
    "message": "Review Not Deleted."
}
```