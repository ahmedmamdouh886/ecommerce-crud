## Introduction

A trivial ecommerce CRUD operations.

## Installation

### Prerequisites

* You must have Docker installed.

### Steps
```bash
git clone https://github.com/ahmedmamdouh886/ecommerce-crud.git
cd ecommerce-crud
cp .env.example .env
docker-compose up --build
docker-compose exec app composer install
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
``` 

## Consumption

### Login process

#### First:
Call http://localhost:9050/api/v1/auth/login with the payload and headers below:

Payload:
Username: admin
Password: passwd

Headers:
Accept: application/json

#### Second:
Hit any endpoint listed in the Endpoints sections with the headers below:
Headers:
Accept: application/json
Authorization: Bearer <your-token> --> <your-token> you have got from the login process section.

## Stateless API Endpoints

### Users Endpoints
* Visit: get http://localhost:9050/api/v1/users -> To list users.
* Visit: post http://localhost:9050/api/v1/users -> To create a new user.
* Visit: patch http://localhost:9050/api/v1/users/{id} -> To update a user.
* Visit: delete http://localhost:9050/api/v1/users/{id} -> To delete a user.

### Products Endpoints
* Visit: get http://localhost:9050/api/v1/products -> To list Products.
* Visit: post http://localhost:9050/api/v1/products -> To create a new product.
* Visit: patch http://localhost:9050/api/v1/products/{id} -> To update a product.
* Visit: delete http://localhost:9050/api/v1/products/{id} -> To delete a product.

## Software metrics
### Maintability complexity metric
![Alt text](maintainability-complexity.png?raw=true "Maintability complexity metric")
### Maintability without comments complexity metric
![Alt text](maintainability-without-comments-complexity.png?raw=true "Maintability without comments complexity metric")
### Cyclomatic complexity metric (which is conditional statements legs count)
![Alt text](cyclomatic-complexity.png?raw=true "Cyclomatic complexity metric which is conditional statements legs.")
### Average bugs per class metrics
![Alt text](average-bugs.png?raw=true "Average bugs per class metric.")

## Files structure
* app/Http/API/Controllers|Requests|Resources/*.php --> It contains the application layers such as controllers, HTTP request validation layer to validate the request payload, resources layer to format response.
* app/services/*.php --> It's a layer for handling and isolating the business/application logic that could be resused often. It contains the Product price discount and user auth handlers.
* app/Models/*.php --> It's an ORM layer to interact with database.
* app/Repositories/*.php --> It's a layer for handling and isolating database queries. PLEASE note that it's Loosely Coupled, that's why I just return array from their methods (I could've used somthing like DTO layer but I haven't done that for the sake of time).
* routes/api.php --> It contains the REST API endpoints.
* ./docker-compose.yml --> the docker compose file.
* ./dockerFile --> the docker file.
* ./docker/* --> Contains the docker services configurations such as nginx and volumes.
* ./database/migrations --> Contains DB schema.
* ./database/factories --> Contains DB factories to help out loading up some data into DB.
* ./database/seeders --> Contains Seeders files to seed some data into DB.
* ./config/product-price-discount.php --> For facilitating implementing OOP in SOLID principles.
* ./app/Exceptions/Handler.php --> For global API Handling exceptions.