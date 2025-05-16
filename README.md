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
git clone https://github.com/your-username/library-management.git
cd library-management

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

Run the seeders:
php artisan migrate:fresh --seed

## Example API Endpoints

| Method | Endpoint              | Description          |
| ------ | --------------------- | -------------------- |
| GET    | /api/bookshelves      | List all bookshelves |
| POST   | /api/bookshelves      | Create a bookshelf   |
| GET    | /api/bookshelves/{id} | Get single bookshelf |
| PUT    | /api/bookshelves/{id} | Update a bookshelf   |
| DELETE | /api/bookshelves/{id} | Delete a bookshelf   |
| GET    | /api/books            | List all books       |
| GET    | /api/chapters         | List all chapters    |
| GET    | /api/pages            | List all pages       |


