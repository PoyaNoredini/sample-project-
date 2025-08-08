# 🚀 Laravel API with Clean Architecture

A robust Laravel 12 REST API built with clean architecture principles, implementing the Repository pattern and SOLID principles for scalable and maintainable code.

## 📋 Table of Contents

- [Overview](#overview)
- [Architecture](#architecture)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [API Documentation](#api-documentation)
- [Project Structure](#project-structure)
- [Design Patterns](#design-patterns)
- [Testing](#testing)
- [Contributing](#contributing)

## 🎯 Overview

This project demonstrates professional backend development practices with a clear separation of concerns.
The architecture ensures maintainability, testability, and scalability, following best practices like the Repository and Service layers, SOLID principles, and proper dependency management.

### Key Highlights
- ✅ **Clean Architecture** with Repository & Service patterns
- ✅ **SOLID Principles** implementation
- ✅ **JWT Authentication** with secure token management
- ✅ **OTP Verification** system
- ✅ **Request Validation** with custom form requests
- ✅ **Standardized API Responses** 
- ✅ **Code Quality Tools** (PHPStan, PHP-CS-Fixer)

## 🏗️ Architecture

This project implements a **3-layer architecture**:

```
┌─────────────────┐
│   Controllers   │ ← HTTP Request Handling
├─────────────────┤
│    Services     │ ← Business Logic
├─────────────────┤
│  Repositories   │ ← Data Access Layer
└─────────────────┘
```
This separation makes the system easier to extend, maintain, and test.

### SOLID Principles Applied

Single Responsibility – Each class has one job

Open/Closed – Extend functionality via interfaces without changing core code

Dependency Inversion – High-level code depends on abstractions, not concrete classes

## ✨ Features

### Authentication & Security
- JWT-based authentication
- OTP verification system
- Password reset functionality
- Secure token generation
- Request validation

### User Management
- User registration with phone verification
- User profile management
- Invite code system
- Following/follower system

### API Features
- RESTful API design
- Standardized JSON responses
- Error handling middleware
- Resource transformations

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **PHP:** ^8.2
- **Authentication:** JWT (tymon/jwt-auth)
- **Database:** MySQL/SQLite
- **Code Quality:** PHPStan, PHP-CS-Fixer
- **Testing:** PHPUnit
- **Development:** Laravel Sail, Vite



## 📚 API Documentation

### Authentication Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/register` | User registration with OTP |
| POST | `/api/login` | User authentication |
| POST | `/api/send-otp` | Send OTP to phone number |
| POST | `/api/forgot-password` | Password reset request |

### User Management

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/users` | List all users |
| GET | `/api/users/{id}` | Get user details |
| POST | `/api/users/complete-profile` | Complete user profile |
| DELETE | `/api/users/{id}` | Delete user |

### Example Request/Response

**POST** `/api/login`
```json
{
  "phone_number": "1234567890",
  "password": "password123"
}
```

**Response**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "phone_number": "1234567890",
      "user_name": "johndoe"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
  }
}
```

## 📁 Project Structure

```
app/
├── Contracts/
│   ├── Repositories/        # Repository interfaces & implementations
│   │   ├── Interface/       # Repository contracts
│   │   ├── Auth/           # Auth repository
│   │   └── User/           # User repository
│   └── Services/           # Service interfaces & implementations
│       └── Contracts/      # Service contracts
├── Http/
│   ├── Controllers/Api/    # API controllers
│   ├── Middleware/         # Custom middleware
│   ├── Requests/          # Form request validators
│   └── Resources/         # API resource transformers
├── Models/                # Eloquent models
├── Traits/               # Reusable traits
└── Helpers/              # Helper classes
```

## 🎨 Design Patterns

### Repository Pattern
```php
// Interface
interface IUserRepository extends BaseRepositoryInterface
{
    public function findByPhone(string $phone);
}

// Implementation
class UserRepository extends BaseRepository implements IUserRepository
{
    public function findByPhone(string $phone)
    {
        return $this->model->where('phone_number', $phone)->first();
    }
}
```

### Service Layer
```php
class AuthService implements IAuthService
{
    public function __construct(
        private IAuthRepository $authRepository,
        private IOtpService $otpService
    ) {}

    public function login(array $credentials)
    {
        // Business logic implementation
    }
}
```

### Dependency Injection
```php
class AuthController extends ApiResponseController
{
    public function __construct(
        private IAuthService $authService,
        private IOtpService $otpService
    ) {}
}
```

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
composer test

# Run with coverage
php artisan test --coverage

# Static analysis
composer phpstan

# Code formatting
composer cs-fix
```

## 🔧 Development Tools

- **PHPStan** - Static analysis for PHP
- **PHP-CS-Fixer** - Code style fixer
- **Laravel Pint** - Code style fixer for Laravel
- **Collision** - Beautiful error reporting

## 🚀 Deployment

The project is ready for deployment with:
- Environment-based configuration
- Optimized autoloader
- Production-ready error handling
- Security best practices

## 📈 Performance Features

- Query optimization through repositories
- Resource transformation for API responses
- Efficient JWT token handling
- Database connection optimization

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## 👨‍💻 About the Developer

This project demonstrates advanced Laravel development skills including:

- **Clean Architecture** implementation
- **SOLID Principles** application
- **Design Patterns** (Repository, Service Layer, Dependency Injection)
- **API Development** best practices
- **Security** implementation (JWT, OTP, Validation)
- **Code Quality** tools and standards
- **Testing** methodologies

Perfect for showcasing backend development expertise in modern PHP/Laravel applications.

---

*Built with ❤️ using Laravel 12 and clean architecture principles*
