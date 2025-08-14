# 📚 Book Catalog API Documentation

## 🚀 Base URL
```
http://localhost:8000/api
```

## 📋 API Overview
This RESTful API provides complete CRUD operations for a book catalog system with authentication, categories, and user management.

---

## 🔐 Authentication Overview

**Authentication Type:** Bearer Token (Laravel Sanctum)  
**Header Format:** `Authorization: Bearer {token}`

All protected endpoints require a valid Bearer token in the Authorization header.

### 🚀 Quick Start Authentication Flow:
1. **Register/Login** → Get token from response
2. **Set Header** → `Authorization: Bearer {token}`
3. **Access APIs** → Use token for all protected endpoints
4. **Logout** → Revoke token when done

## 🔐 Authentication Endpoints

### 1. Health Check (Public)
```http
GET /api/health
```
**Response:**
```json
{
    "status": "OK",
    "message": "API is running",
    "timestamp": "2025-01-14T10:30:00.000000Z",
    "version": "1.0.0"
}
```

### 2. User Registration
```http
POST /api/auth/register
```
**Headers:**
```
Content-Type: application/json
Accept: application/json
```
**Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```
**Response:**
```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "role": "user"
        },
        "token": "1|kJg3...token_here...9Dq8",
        "token_type": "Bearer"
    }
}
```

### 3. User Login
```http
POST /api/auth/login
```
**Body:**
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```
**Response:**
```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "role": "user"
        },
        "token": "1|kJg3...token_here...9Dq8",
        "token_type": "Bearer"
    }
}
```

### 4. Get Current User Info
```http
GET /api/auth/user
```
**Headers:**
```
Accept: application/json
Authorization: Bearer {your-token-here}
```

### 5. Logout
```http
POST /api/auth/logout
```

---

## 📚 Books API

### 1. Get All Books
```http
GET /api/books
```
**Query Parameters:**
- `per_page` (optional): Number of items per page (default: 15)
- `category_id` (optional): Filter by category ID
- `search` (optional): Search in title or author

**Example:**
```http
GET /api/books?per_page=10&category_id=1&search=Laravel
```

### 2. Create New Book
```http
POST /api/books
```
**Body:**
```json
{
    "title": "Laravel Complete Guide",
    "author": "John Smith",
    "publisher": "Tech Publications",
    "year": 2024,
    "category_id": 1,
    "book_gambar": "cover.jpg"
}
```

### 3. Get Single Book
```http
GET /api/books/{id}
```
**Example:** `GET /api/books/1`

### 4. Update Book
```http
PUT /api/books/{id}
```
or
```http
PATCH /api/books/{id}
```
**Body:** (All fields optional for PATCH)
```json
{
    "title": "Updated Title",
    "author": "Updated Author"
}
```

### 5. Delete Book
```http
DELETE /api/books/{id}
```

### 6. Search Books
```http
GET /api/books/search/{query}
```
**Example:** `GET /api/books/search/Laravel`

---

## 🏷️ Categories API

### 1. Get All Categories
```http
GET /api/categories
```
**Query Parameters:**
- `with_books` (optional): Include books in response

### 2. Create Category
```http
POST /api/categories
```
**Body:**
```json
{
    "name": "Programming"
}
```

### 3. Get Single Category
```http
GET /api/categories/{id}
```

### 4. Update Category
```http
PUT /api/categories/{id}
```
**Body:**
```json
{
    "name": "Updated Category Name"
}
```

### 5. Delete Category
```http
DELETE /api/categories/{id}
```
*Note: Cannot delete categories that have books*

---

## 👥 Users API (Admin Only)

### 1. Get All Users
```http
GET /api/users
```
**Query Parameters:**
- `per_page` (optional): Number of items per page
- `role` (optional): Filter by role (admin/user)
- `search` (optional): Search in name or email

### 2. Create User
```http
POST /api/users
```
**Body:**
```json
{
    "name": "Jane Doe",
    "email": "jane@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "role": "user"
}
```

### 3. Get Single User
```http
GET /api/users/{id}
```

### 4. Update User
```http
PUT /api/users/{id}
```
**Body:** (All fields optional)
```json
{
    "name": "Updated Name",
    "email": "updated@example.com",
    "role": "admin"
}
```

### 5. Delete User
```http
DELETE /api/users/{id}
```

### 6. Update User Role
```http
PATCH /api/users/{id}/role
```
**Body:**
```json
{
    "role": "admin"
}
```

---

## 📊 Dashboard API

### Get Dashboard Statistics
```http
GET /api/dashboard/stats
```
**Response:**
```json
{
    "books_count": 25,
    "categories_count": 5,
    "users_count": 10,
    "recent_books": [...]
}
```

---

## 🎯 Postman Testing Guide

### Setting Up Postman Environment

1. **Create Environment Variables:**
   - `base_url`: `http://localhost:8000/api`
   - `token`: (will be set after login)

2. **Add to Headers (for authenticated requests):**
   ```
   Accept: application/json
   Content-Type: application/json
   ```

### Testing Flow for 90-minute Session:

#### Phase 1: Basic Testing (20 minutes)
1. **Health Check** - Test public endpoint
2. **User Registration** - Create new user
3. **User Login** - Get authentication
4. **Get User Info** - Test authenticated endpoint

#### Phase 2: CRUD Operations (40 minutes)
5. **Categories CRUD:**
   - Create 3-4 categories
   - List all categories
   - Update a category
   - Try to delete category (show validation)

6. **Books CRUD:**
   - Create 5-6 books with different categories
   - List all books (show pagination)
   - Search books
   - Update book
   - Delete book

#### Phase 3: Advanced Features (20 minutes)
7. **Advanced Queries:**
   - Filter books by category
   - Search with pagination
   - Get category with books

8. **Admin Functions:**
   - Create admin user (if not exists)
   - Test user management endpoints
   - Show role-based access control

#### Phase 4: Error Handling (10 minutes)
9. **Test Error Cases:**
   - Invalid authentication
   - Validation errors
   - Permission denied
   - Resource not found

---

## 🔍 Common Response Formats

### Success Response:
```json
{
    "success": true,
    "message": "Operation completed successfully",
    "data": { ... }
}
```

### Error Response:
```json
{
    "success": false,
    "message": "Error description",
    "errors": { ... }
}
```

### Validation Error:
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password must be at least 8 characters."]
    }
}
```

---

## 🛠️ Status Codes

- `200 OK` - Success
- `201 Created` - Resource created
- `401 Unauthorized` - Not authenticated
- `403 Forbidden` - Not authorized
- `404 Not Found` - Resource not found
- `422 Unprocessable Entity` - Validation error
- `500 Internal Server Error` - Server error

---

## 📝 Sample Data for Testing

### Categories:
```json
[
    {"name": "Programming"},
    {"name": "Web Development"},
    {"name": "Database"},
    {"name": "Mobile Development"},
    {"name": "DevOps"}
]
```

### Books:
```json
[
    {
        "title": "Laravel 11 Complete Guide",
        "author": "John Smith",
        "publisher": "Tech Books",
        "year": 2024,
        "category_id": 2
    },
    {
        "title": "JavaScript Fundamentals",
        "author": "Jane Doe",
        "publisher": "Web Press",
        "year": 2023,
        "category_id": 2
    }
]
```