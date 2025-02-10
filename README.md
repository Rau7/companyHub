# Company Hub

A RESTful API service built with Laravel and Vue.js for managing companies and their employees.

## Project Timeline & Features

### 1. Initial Setup (ec2c0ef - first commit)

-   Project initialized with Laravel
-   Basic configuration setup

### 2. Admin User Setup (7bf23a5 - AdminSeederAdded)

-   Added admin user functionality
-   Created UserController and UserResource
-   Implemented admin seeder
-   Added is_admin field to Users table
-   admin@example.com password: password (ADMIN CREDENTIALS)

### 3. Database Structure (53ed775 - tablesAdded)

-   Created and migrated companies table
-   Created and migrated employees table
-   Set up database relationships

### 4. Fake Data Generation (aeaa269 - createFakeInfo)

-   Implemented Faker for test data
-   Generated 50+ sample companies
-   Generated 50+ sample employees
-   Set up proper relationships between companies and employees

### 5. Controllers Implementation (9c1b312 - controllersAdded)

-   Added CompanyController
-   Added EmployeeController
-   Implemented basic CRUD operations
-   Set up API endpoints

### 6. Vue.js Integration (edb151f - vueInstalled&PagesAdded)

-   Installed and configured Vue.js
-   Added necessary pages and components
-   Set up routing structure
-   Implemented basic layouts

### 7. Company Management (d8fddce - LogoAndCRUDComp)

-   Implemented company logo handling
-   Added company CRUD operations
-   Set up file storage for logos
-   Created company management interface

### 8. Employee Management (27832fa - employeesCRUD)

-   Implemented employee CRUD operations
-   Created employee listing interface
-   Added employee search functionality
-   Set up company-employee relationships

### 9. Form Validation (e0ae899 - validationsWithRequest)

-   Added request validation classes
-   Implemented form validation
-   Added error handling
-   Enhanced user input security

### 10. Pagination & API Enhancements

-   Added pagination (15 items per page)
-   Separated web and API endpoints
-   Enhanced API responses with proper JSON structure
-   Added pagination support to API responses

## Technologies Used

-   Laravel 10
-   Vue.js 3
-   MySQL
-   Inertia.js
-   Tailwind CSS

## Installation

1. Clone the repository

```bash
git clone [repository-url]
```

2. Install PHP dependencies

```bash
composer install
```

3. Install NPM dependencies

```bash
npm install
```

4. Create and configure .env file

```bash
cp .env.example .env
```

5. Generate application key

```bash
php artisan key:generate
```

6. Run migrations and seeders

```bash
php artisan migrate --seed
```

7. Start the development server

```bash
php artisan serve
npm run dev
```

## Features

-   Admin authentication and authorization
-   Company management (CRUD operations)
-   Employee management (CRUD operations)
-   File upload for company logos
-   Pagination (15 items per page)
-   Form validation
-   Responsive design
-   RESTful API with JSON responses

## API Endpoints

### Companies

```bash
# List all companies (paginated, 15 per page)
GET /api/companies
GET /api/companies?page=2

# Get a specific company
GET /api/companies/{id}

# Create a new company
POST /api/companies
Content-Type: application/json
{
    "name": "Company Name",
    "email": "company@example.com",
    "website": "https://example.com",
    "logo": "file upload"
}

# Update a company
PUT /api/companies/{id}
Content-Type: application/json
{
    "name": "Updated Company Name",
    "email": "updated@example.com",
    "website": "https://updated.com"
}

# Delete a company
DELETE /api/companies/{id}
```

### Employees

```bash
# List all employees (paginated, 15 per page)
GET /api/employees
GET /api/employees?page=2

# Get a specific employee
GET /api/employees/{id}

# Create a new employee
POST /api/employees
Content-Type: application/json
{
    "first_name": "John",
    "last_name": "Doe",
    "company_id": 1,
    "email": "john@example.com",
    "phone": "1234567890"
}

# Update an employee
PUT /api/employees/{id}
Content-Type: application/json
{
    "first_name": "John Updated",
    "last_name": "Doe Updated",
    "company_id": 2,
    "email": "updated@example.com",
    "phone": "0987654321"
}

# Delete an employee
DELETE /api/employees/{id}
```

## API Response Format

### Success Response

```json
{
    "data": [...],
    "current_page": 1,
    "per_page": 15,
    "total": 50,
    "last_page": 4,
    "next_page_url": "http://localhost:8000/api/companies?page=2",
    "prev_page_url": null
}
```

### Error Response

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."],
        "name": ["The name field is required."]
    }
}
```
