# Archintel Developer Exam

This project is a Laravel application for managing articles, users, and companies, designed for a writer/editor dashboard.

## Features

- **Writer Dashboard**: Create and edit articles. View articles that are in "For Edit" and "Published" states.
- **Editor Dashboard**: Edit and publish articles. Manage users and companies.
- **CRUD Operations**: Create, read, update, and delete operations for articles, users, and companies.
- **Responsive Design**: The application is designed to be responsive and accessible on various devices.
- **API Integration**: Demonstrates integration with APIs (if applicable).

## Installation

To get started with this project, follow these steps:

### Prerequisites

- PHP (>= 8.0)
- Composer
- Laravel (>= 9.0)
- MySQL or another supported database

### Install Dependencies
 - composer install
 - npm install

### Set Up Environment
 - cp .env.example .env
 - php artisan key:generate

### Database Connection
 - DB_CONNECTION=mysql
 - DB_HOST=127.0.0.1
 - DB_PORT=3306
 - DB_DATABASE=your_database_name
 - DB_USERNAME=your_database_username
 - DB_PASSWORD=your_database_password

### Run Migrations and Seeders
 - php artisan migrate
 - php artisan db:seed

### Run the Application
 - npm run dev
 - php artisan serve

### API Integration
 - use Postman or any API platform
 - use POST method to login by using this link: http://localhost:8000/api/login
 - it should display the token for accessing the API links
 - you should select Bearer Token for Auth Type
 - paste the token you copied after logging in
 - the format should be like this: Authorization: Bearer <token>
 - **API Link Sample**: articles, companies, users
   - Get All Articles: /api/articles (GET)
   - Save Article: /api/articles/store (POST)
   - Show Article: /api/articles/{id} (GET)
   - Update Article: /api/articles/{id}/update (PUT)
   - Publish Article: /api/articles/{id}/publish (PATCH)