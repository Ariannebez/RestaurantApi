# Restaurant API 

## Introduction

Welcome to the documentation for the Restaurant API. This API provides endpoints for managing various aspects of a restaurant's operations, including users, bookings, menu items, and more.

## Folder Structure

The API is organized into the following main folders:

- **API Folder:** Contains all the endpoints sorted into different folders according to their specific job.
- **Core Folder:** Contains all the classes and the initialization file.
- **Documentation Folder:** Contains the MkDocs for user documentation.
- **Includes Folder:** Contains the configuration file.
- **Collections Folder:** Contains all the Postman endpoint exports.
- **SQL Folder:** Contains the database export.

## Database Tables

The API operates with the following database tables:

- **users:** Stores user information such as email, password, name, surname, date of birth, address ID, and role ID.
- **role:** Defines roles for users, such as clients or staff.
- **address:** Stores user addresses.
- **country:** Lists countries.
- **town:** Lists towns.
- **resLocation:** Stores restaurant locations.
- **reviews:** Stores reviews left by clients.
- **booking:** Manages table bookings.
- **bookingNote:** Stores notes related to bookings.
- **bookingStatus:** Defines booking statuses.
- **table:** Manages table information and availability.
- **table_status:** Defines table statuses.
- **area:** Defines areas where tables are located.
- **items:** Manages menu items.
- **daily_special:** Stores information about daily specials.
- **menu_category:** Defines menu categories.
- **gallery:** Stores photos of food items.

## File Explanation

### Config File

- **Path:** `includes/config.php`
- **Purpose:** This section establishes a connection to the database, providing the necessary credentials for accessing MySQL. It specifies the username and password for authentication and identifies the target database by name, which, in this instance, is referred to as HarmonyHouse

### Initialize File

- **Path:** `core/initialize.php`
- **Purpose:** Defines the root directories and connects the class files. Sets up the environment for the PHP application by defining directory constants and including necessary files to ensure that the application has access to its core functionalities and configurations.

### Class Files

- **Path:** `core/...`
- **Purpose:** Includes all the functions required by each class to interact with the database. Each function is named according to its purpose and is called from different endpoints. Each class file contains the respective variables needed by that specific class and a constructor method that establishes the database connection to the respective database table.

Example:
    Path: `core/clients.php`
    
In the `clients.php` class, various functions are defined, each serving a distinct purpose and invoked from different endpoints.

Example:
- `read()`: The `read()` function, located within the `clients` class, is utilized by the `getClients.php` endpoint. It directs the database to retrieve all available details of clients where the role ID is 1.

Each function within the class constructs a `$query` containing the SQL statements pertinent to that specific database operation. Subsequently, the function prepares and executes the `$stmt` (statement) and forwards the resulting data back to the respective endpoint.
### Endpoint Files

- **Path:** `api/.../...`
- **Purpose:** Contains various folders named after each database table, each containing the respective endpoints related to that particular table. Each endpoint manipulates the database data according to its function. Endpoints are named clearly to facilitate navigation and understanding of their purpose.

## Example

- **Endpoint:** `api/clients/createClient.php`
- **Purpose:** Creates a new row in the users table with the client's details and role ID of 1.

- **Endpoint:** `api/clients/updateClient.php`
- **Purpose:** This endpoint, denoted by its name `updateClient.php`, is responsible for updating a row in the `users` table, specifically modifying client records where the role ID is 1.

