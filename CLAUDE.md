# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 application for managing a book catalog system with categories, suppliers, and user authentication. The application includes role-based access control with admin/user permissions.

## Development Commands

### Core Laravel Commands
- `php artisan serve` - Start the development server
- `php artisan migrate` - Run database migrations
- `php artisan migrate:fresh --seed` - Reset database with fresh migrations and seeders
- `php artisan db:seed` - Run database seeders
- `php artisan tinker` - Start Laravel Tinker REPL
- `php artisan config:clear` - Clear configuration cache
- `php artisan route:list` - Display all registered routes

### Composer Scripts
- `composer run dev` - Start full development environment (server, queue, logs, vite)
- `composer run test` - Run PHPUnit tests with config clearing
- `composer install` - Install PHP dependencies
- `composer update` - Update PHP dependencies

### Frontend Build Commands
- `npm run dev` - Start Vite development server
- `npm run build` - Build assets for production
- `npm install` - Install Node.js dependencies

### Testing
- `php artisan test` - Run PHPUnit tests
- `vendor/bin/phpunit` - Run tests directly

### Code Quality
- `vendor/bin/pint` - Run Laravel Pint (PHP CS Fixer) for code formatting

## Database Architecture

### Core Models and Relationships
- **Book**: Main entity with title, author, publisher, year, category_id, book_gambar
  - belongsTo Category
  - hasOne Phone
- **Category**: Book categorization (name)
- **Phone**: Contact information linked to books
- **Supplier**: Book suppliers
- **SupplierBook**: Many-to-many relationship between suppliers and books
- **User**: Authentication with role-based access (admin/user roles)

### Key Migration Files
- Users table includes role column for admin/user permissions
- Books table includes book_gambar column for image storage
- Categories, phones, suppliers, and supplier_books tables for relational data

## Authentication & Authorization

### Middleware
- `SimpleAuth` middleware handles authentication and role-based access control
- Routes protected with `simple.auth` and `simple.auth:admin` middleware
- Admin-only routes for certain book management operations

### User Roles
- `admin`: Full access to all features
- `user`: Limited access (default role)

## Route Structure

### Book Management
- GET `/` - Home page (book listing)
- POST `/book/add` - Create new book
- GET `/book` - Admin book listing
- GET `/book/{id}` - Edit book form
- PATCH `/book/{id}` - Update book
- DELETE `/book/{id}` - Delete book

### Authentication
- GET `/login` - Login form
- POST `/login` - Process login
- GET `/register` - Registration form
- POST `/register` - Process registration
- POST `/logout` - Logout

## File Storage

Book images are stored in `storage/app/private/public/images/` directory.

## Frontend Technology

- Vite for asset bundling
- Tailwind CSS 4.0 for styling
- Blade templating engine
- Master layout at `resources/views/layout/master.blade.php`

## Testing Setup

- PHPUnit configured in `phpunit.xml`
- Feature and Unit test directories in `tests/`
- Database factories available for all models

## RESTful API

The application includes a complete RESTful API for all CRUD operations:

### API Base URL
- Local: `http://localhost:8000/api`

### API Features
- **Authentication**: Register, login, logout, get user info
- **Books API**: Full CRUD operations with search and filtering
- **Categories API**: Full CRUD operations with relationship handling
- **Users API**: Admin-only user management with role updates
- **Dashboard API**: Statistics and metrics endpoint
- **Error Handling**: Proper JSON error responses with validation

### API Testing
- **Postman Collection**: `Book_Catalog_API.postman_collection.json` - Ready to import
- **Documentation**: `API_DOCUMENTATION.md` - Complete endpoint documentation
- **Health Check**: `GET /api/health` - API status endpoint

### Key API Endpoints
- `POST /api/auth/register` - User registration
- `POST /api/auth/login` - User login
- `GET /api/books` - List books with pagination/search
- `POST /api/books` - Create new book
- `GET /api/categories` - List categories
- `GET /api/dashboard/stats` - Dashboard statistics

## Development Environment

This project uses XAMPP on Windows (MINGW64 environment) and includes:
- Laravel Pail for log monitoring
- Laravel Sail for Docker support (optional)
- Concurrently for running multiple development processes