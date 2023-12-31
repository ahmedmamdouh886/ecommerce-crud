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
POST http://localhost:9050/api/v1/auth/login with the payload and headers below:

Payload: <br>
```bash
{
    "username": "admin",
    "password": "passwd",
}
```

Headers: <br>
```bash
Accept: application/json
```

#### Second:
Hit any endpoint listed in the Stateless API Endpoints section with the headers below:

Accept: application/json <br />
Authorization: Bearer <b>your-token</b> --> Where your-token is the token you have got from the login process section.

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

### Auth Endpoints
* Visit: POST http://localhost:9050/api/v1/auth/login -> To login.
* Visit: POST http://localhost:9050/api/v1/auth/register -> To register.

## Principles, architecture, patterns and common processes used in this task
* MVC (Model View Controller) architecture pattern.
* Dockerization for development environment setup.
* RESTful API.
* Loose coupling.
* Abstraction.
* Dependency injection.
* Replace Type Code with Subclasses.
* Replace Magic Number with Symbolic Constant.
* SOLID principles.
* OCP (especially in the product price discount handler).
* Design by contract.
* DRY (Don't Repeat Yourself)
* YAGNI (You Aren't Gonna Need It).
* Law of Demeter principle.
* Factory design pattern (To bury the Cyclomatic Complexity(linearly-independent paths/Conditional statements) in the low level abstraction).

### Don't know any of the principles above? you can look it up in one of these books
* Head first object-oriented analysis and design.
* Refactoring: Improving the Design of Existing Code.
* Head first design patterns.
* Clean Code: A Handbook of Agile Software Craftsmanship.

## You can run the command below for software metrics

#### This will give you some insights in software metrics and quality such as LCOM, Cyclomatic Complexity and more.
```bash
docker-compose exec app php ./vendor/bin/phpmetrics --report-html=myreport <project-folder-to-analyze>
```

## Files structure
* app/Http/API/Controllers|Requests|Resources/*.php --> It contains the application layers such as controllers, HTTP request validation layer to validate the request payload, resources layer to format response.

* app/services/*.php --> It's a layer for handling and isolating the business/application logic that could be resused often. It contains the Product price discount and user auth handlers.

* app/Models/*.php --> It's an ORM layer to interact with database. Also It has some logic such as mutators/accessors, and I leverge the accessor feature to apply the product price discount on the fly, <b> considering the ORM is the only layer we use for interacting with DB. </b>

* app/Repositories/*.php --> It's a layer for handling and isolating database queries. PLEASE note that it's Loosely Coupled, that's why I just return array from their methods (I could've used something like DTO layer but I haven't done that for the sake of time).

* routes/api.php --> It contains the REST API endpoints.

* docker-compose.yml --> the docker compose file.

* dockerFile --> the docker file.

* docker/* --> Contains the docker services configurations such as nginx and volumes.

* database/migrations --> Contains DB schema.

* database/factories --> Contains DB factories to help out loading up some data into DB.

* database/seeders --> Contains Seeders files to seed some data into DB.

* config/product-price-discount.php --> Product price discount handler paths, for facilitating implementing OCP in SOLID principles.

* app/Exceptions/Handler.php --> For global API Handling exceptions.

* app/Providers/AppServiceProvider.php --> For binding concrete class to its contract(interface).
