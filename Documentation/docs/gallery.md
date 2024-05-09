# Gallery

<br>

## Get All Gallery Images

This endpoint retrieves a list of all images from the gallery.

### Endpoint

 `GET / AllImages` `http://localhost:8888/RestaurantApi/api/gallery/getAllImages.php`

### Success Response

- **Content :** 

```json
  {
      "data": [
          {
              "id": "1",
              "img": "image1.jpg",
              "des": "Description 1"
          },
          {
              "id": "2",
              "img": "image2.jpg",
              "des": "Description 2"
          }
      ]
  }
```

### Error Response

- **Content :** 
  
```json
    {
        "message": "No images found"
    }
```

<br>

## Get Gallery Image by ID

This endpoint retrieves information about a single image from the gallery based on its ID.

### Endpoint

`GET /galleryById` `http://localhost:8888/RestaurantApi/api/gallery/getImageById.php`

### Variables

- `id`: The unique identifier of the image. (Required)

### Success Response

- **Content:** 

```json
{
    "id": "1",
    "img": "image1.jpg",
    "des": "Description 1"
}
```

### Error Response

- **Content:** 

```json
{
    "message": "No Image found with this id."
}
```

<br>

## Create Image

This endpoint allows creating a new image in the gallery.

### Endpoint

`POST /createImage` `http://localhost:8888/RestaurantApi/api/gallery/createImage.php`

### Body

- `img`: The image file. (Required)
- `des`: The description of the image. (Required)

```json
{
    "img": "image.jpg",
    "des": "Description of the image."
}
```

### Success Response

  - **Content :** 

```json
    {
        "message": "Image created."
    }
```

### Error Response

  - **Content :** 

```json
    {
        "message": "Image not created."
    }
```

<br>

## Update Image Details

This endpoint allows updating the details of an existing image in the gallery.

### Endpoint

`PUT /updateImage` `http://localhost:8888/RestaurantApi/api/gallery/updateImage.php`

### Variables

- `id`: The ID of the image to be updated. (Required)
- `img`: The updated image file. (Required)
- `des`: The updated description of the image. (Required)

```json
{
    "id": "image_id",
    "img": "updated_image.jpg",
    "des": "Updated description of the image."
}
```

  - **Content :** 

```json
    {
        "message": "Image details updated."
    }
```

### Error Response

  - **Content :** 

```json
    {
         "message": "Image not updated."
    }
```

<br>

## Delete Image

This endpoint allows deleting an image from the gallery based on its ID.

### Endpoint

`DELETE /deleteImage` `http://localhost:8888/RestaurantApi/api/gallery/deleteImage.php?id={image_id}`

### Variables

- `id`: The unique identifier of the image to be deleted. (Required)

### Response

The endpoint returns a JSON response with a message indicating the status of the delete operation.

#### Success Response

  - **Content:** Indicates that the image was successfully deleted.

```json
{
    "message": "Image Deleted."
}
```

### Error Response

  - **Content :** 

```json
    {
    "message": "No ID provided."
    }
```

  - **Content :** 

```json
    {
    "message": "ID not good. No such image."
    }
```