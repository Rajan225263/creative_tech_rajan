# 📚 Laravel 11 Library Management API

This is a simple Library Management API built with **Laravel v11.44.7**.  
It supports managing **Bookshelves, Books, Chapters, and Pages**.

## ✅ Requirements

- PHP 8.2 or higher
- MySQL 8.0 or higher
- Composer
- Laravel CLI

## 🚀 Installation Steps

```bash
# 1. Clone the project
git clone https://github.com/Rajan225263/library-management-rajan.git
cd library-management-rajan

# 2. Install packages
composer install

# 3. Create .env file
cp .env.example .env

# 4. Set your database credentials in the .env file

# 5. Generate app key
php artisan key:generate

# 6. Run migration and seeders
php artisan migrate --seed

##  API Token Authentication
Add this header to all requests:
X-API-TOKEN: your-secret-token

Set this in .env:
API_TOKEN=your-secret-token

## Seeder Information
The app seeds data for 3 Bengali authors:

1. Rabindranath Tagore
2. Kazi Nazrul Islam
3. Jasimuddin

Each with:
10 Bookshelves
10 Books
10 Chapters per book
10 Pages per chapter

## Example API Endpoints:

Method	Endpoint	Description
GET	/api/bookshelves	List bookshelves
POST	/api/bookshelves	Create bookshelf
GET	/api/bookshelves/{id}	Show bookshelf
PUT	/api/bookshelves/{id}	Update bookshelf
DELETE	/api/bookshelves/{id}	Delete bookshelf
GET	/api/books	List books
POST	/api/books	Create book
GET	/api/books/{id}	Show book
PUT	/api/books/{id}	Update book
DELETE	/api/books/{id}	Delete book
GET	/api/books/search	Search books
GET	/api/chapters	List chapters
POST	/api/chapters	Create chapter
GET	/api/chapters/{id}	Show chapter
PUT	/api/chapters/{id}	Update chapter
DELETE	/api/chapters/{id}	Delete chapter
GET	/api/chapters/{id}/full-content	Full content of chapter
GET	/api/pages	List pages
POST	/api/pages	Create page
GET	/api/pages/{id}	Show page
PUT	/api/pages/{id}	Update page
DELETE	/api/pages/{id}	Delete page

## Swagger UI
URL: http://127.0.0.1:8000/api/documentation
Use "Authorize" → X-API-TOKEN → Paste your token


