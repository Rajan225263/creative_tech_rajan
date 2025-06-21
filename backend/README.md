# Laravel 12 CRUD API Project

This project is a Laravel 12 backend API with MySQL database for managing **Categories** and **Products** through RESTful CRUD endpoints.

---

## Features

- Categories CRUD API (Create, Read, Update, Delete)
- Products CRUD API (Create, Read, Update, Delete)
- MySQL database
- Postman collection included for easy API testing
- Backend code located in `project-root/backend`

---

## Prerequisites

- PHP >= 8.2
- Composer
- MySQL Server
- Git
- Postman (for API testing)

---

## Setup Instructions (Run Locally)

1. **Clone the repository**

 ```bash
git clone <repository-url>
Navigate to backend directory

cd project-root/backend
Install PHP dependencies

composer install
Copy .env.example to .env

cp .env.example .env
Configure database in .env

Update the following lines in .env with your MySQL credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password
Generate application key

bash
Copy
Edit
php artisan key:generate
Run database migrations

php artisan migrate
Start the Laravel development server

php artisan serve
The API will be accessible at: http://localhost:8000

API Endpoints Overview
Resource	Method	Endpoint	Description
Categories	GET	/api/categories	List all categories
Categories	POST	/api/categories	Create a new category
Categories	GET	/api/categories/{id}	Get category details
Categories	PUT	/api/categories/{id}	Update a category
Categories	DELETE	/api/categories/{id}	Delete a category
Products	GET	/api/products	List all products
Products	POST	/api/products	Create a new product
Products	GET	/api/products/{id}	Get product details
Products	PUT	/api/products/{id}	Update a product
Products	DELETE	/api/products/{id}	Delete a product
