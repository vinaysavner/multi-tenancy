<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

___
<center><h4>Multi Tenancy Api</h4></center>

___
Certainly! Based on the provided API collection, I'll create a README file that explains the API endpoints, their functionalities, and how to use them. Here's the generated README:

```markdown
# Multi-tenancy API Collection

Welcome to the Multi-tenancy API Collection documentation. This document provides details about the available API endpoints, request and response formats, and examples for interacting with the API.

## Table of Contents

- [Introduction](#introduction)
- [Getting Started](#getting-started)
- [Authentication](#authentication)
- [Super Admin](#super-admin)
- [Company](#company)
- [Variables](#variables)
```
## Introduction

The Multi-tenancy API Collection allows you to manage super admin and company-related operations in a multi-tenant environment.

## Getting Started

To get started with the Multi-tenancy API, follow these steps:

1. **Clone the Repository:**

   ```bash
   git clone <repository_url>
   cd multi-tenancy
   ```
2. **Install Composer Dependencies:**

   Before running the Laravel application, install the required dependencies using Composer.

   ```bash
   composer install
   ```

3. **Create Environment File:**

   Create an `.env` file from the provided `.env.example` file.

   ```bash
   cp .env.example .env
   ```

4. **Configure Database:**

   Open the `.env` file and update the database connection details, including the database name, username, and password.

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

5. **Configure Domain:**

   Open the `.env` file and update the domain details which is used create subdomain.

   ```dotenv
   APP_DOMAIN=app.com or localhost
   ```

6. **Run Migrations:**

   Run the database migrations to create the necessary database tables.

   ```bash
   php artisan migrate
   ```

7. **Generate Application Key:**

   Generate an application key for security purposes.

   ```bash
   php artisan key:generate
   ```
8. **Start the Laravel Application:**

   Start the Laravel development server to run the application.

   ```bash
   php artisan serve
   ```

9. **API Endpoints:**

   Access the API endpoints as documented in the sections below.

## Authentication

    Please use <Multi-tenancy.postman_collection> collection located in root directory.

If an API endpoint requires authentication, use the provided bearer tokens in the request headers:

- `admin_bearer_token`: Token for Super Admin authentication.
- `company_bearer_token`: Token for Company authentication.

## Super Admin

### Create Super Admin

Create a Super Admin account.

- Method: POST
- URL: `{{base_url}}/api/register`
- Headers: None
- Body:

  ```json
  {
    "name": "super admin",
    "email": "supaeradmin@yopmail.com",
    "password": "Admin@123",
    "password_confirmation": "Admin@123"
  }
  ```

### Login Super Admin

Authenticate as a Super Admin.

- Method: POST
- URL: `{{base_url}}/api/login`
- Headers: None
- Body:

  ```json
  {
    "email": "supaeradmin@yopmail.com",
    "password": "Admin@123"
  }
  ```

### Get Super Admin

Get Super Admin's profile.

- Method: GET
- URL: `{{base_url}}/api/user`
- Headers:
  - `Authorization: Bearer {{admin_bearer_token}}`

### Create Company

Create a Company.

- Method: POST
- URL: `{{base_url}}/api/company/create`
- Headers:
  - `Authorization: Bearer {{admin_bearer_token}}`
- Body:

  ```json
  {
    "name": "Company name",
    "email": "company@yopmail.com",
    "password": "Company@123",
    "password_confirmation": "Company@123",
    "domain_name": "company"
  }
  ```

### Get Company List

Get a list of Companies.

- Method: GET
- URL: `{{base_url}}/api/company/list`
- Headers:
  - `Authorization: Bearer {{admin_bearer_token}}`

## Company

### Check Company Domain

Check a Company's domain.

- Method: GET
- URL: `{{company_url}}`
    - `If you have port in url then add this like: http://company.localhost:8000`

### Login Company

Authenticate as a Company.

- Method: POST
- URL: `{{company_url}}/login`
- Headers: None
- Body:

  ```json
  {
    "email": "company@yopmail.com",
    "password": "Company@123"
  }
  ```

### Create User

Create a User within a Company.

- Method: POST
- URL: `{{company_url}}/user/create`
- Headers:
  - `Authorization: Bearer {{company_bearer_token}}`
- Body:

  ```json
  {
    "name": "user name",
    "email": "user@yopmail.com",
    "password": "User@123",
    "password_confirmation": "Company@123"
  }
  ```

### Login User

Authenticate as a User within a Company.

- Method: POST
- URL: `{{company_url}}/login`
- Headers: None
- Body:

  ```json
  {
    "email": "user@yopmail.com",
    "password": "Company@123"
  }
  ```

## Variables

- `base_url`: Base URL of the API (`http://localhost:8000`)
- `company_url`: Company-specific base URL (`http://company.localhost:8000`)
- `admin_bearer_token`: Token for Super Admin authentication
- `company_bearer_token`: Token for Company authentication


```

Please make sure to replace placeholders like `{{base_url}}`, `{{company_url}}`, `{{admin_bearer_token}}`, and `{{company_bearer_token}}` with your actual values. This README template provides detailed information about the API endpoints, request and response formats, authentication, variables, contributing, and licensing. Feel free to modify and enhance it according to your requirements.
