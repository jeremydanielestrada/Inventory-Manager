# Inventory Manager

A simple and modern inventory management system built with Laravel 12, Vue.js 3, and Vuetify. 

## 📋 Overview

This project is a full-stack inventory management application designed to help businesses track and manage their inventory efficiently. It features a modern, responsive UI and robust backend capabilities.

## 🚀 Tech Stack

### Backend
- **Laravel 12** - PHP framework for web artisans
- **PHP 8.2+** - Modern PHP version
- **Laravel Sanctum** - API authentication
- **Laravel Tinker** - Powerful REPL for Laravel

### Frontend
- **Vue.js 3** - Progressive JavaScript framework
- **Inertia.js** - Modern monolith approach
- **Vuetify 3** - Material Design component framework
- **Pinia** - State management for Vue
- **TailwindCSS 3** - Utility-first CSS framework
- **Material Design Icons** - Icon library

### Development Tools
- **Vite** - Next generation frontend tooling
- **Laravel Breeze** - Minimal authentication scaffolding
- **Laravel Pail** - Log viewer
- **Laravel Pint** - PHP code style fixer
- **PHPUnit** - PHP testing framework

## ✨ Features

- **Inventory Tracking** - Manage products, quantities, and stock levels
- **Modern UI** - Responsive design with Material Design components
- **Authentication** - Secure user authentication with Laravel Sanctum
- **Real-time Updates** - Reactive Vue.js interface
- **API Support** - RESTful API with Sanctum authentication

## 📦 Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL/PostgreSQL/SQLite (your preferred database)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/jeremydanielestrada/Inventory-Manager.git
   cd Inventory-Manager
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your database**
   
   Edit the `.env` file and set your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=inventory_manager
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Build frontend assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`

## 🛠️ Development

### Running the Development Environment

For a complete development experience with all services running concurrently:

```bash
composer dev
```

This will start:
- Laravel development server
- Queue worker
- Log viewer (Pail)
- Vite development server

### Individual Commands

```bash
# Start Laravel server
php artisan serve

# Start Vite dev server
npm run dev

# Run queue worker
php artisan queue:listen

# View logs
php artisan pail
```

### Code Style

Format your PHP code using Laravel Pint:
```bash
./vendor/bin/pint
```

### Testing

Run the test suite:
```bash
composer test
# or
php artisan test
```

## 📁 Project Structure

```
├── app/              # Application logic (Controllers, Models, etc.)
├── bootstrap/        # Framework bootstrap files
├── config/           # Configuration files
├── database/         # Migrations, factories, and seeders
├── public/           # Public assets and entry point
├── resources/        # Views, raw assets, and frontend code
│   ├── js/          # Vue.js components and JavaScript
│   └── views/       # Blade templates
├── routes/           # Application routes
├── storage/          # Compiled files, logs, and uploads
└── tests/            # Automated tests
```

## 🔐 Authentication

This application uses Laravel Breeze with Inertia.js for authentication. Available authentication features:

- User registration
- Login/Logout
- Password reset
- Email verification
- API authentication via Sanctum

## 📝 API Documentation

API endpoints are protected using Laravel Sanctum. To authenticate:

1. Obtain an API token through the authentication endpoint
2. Include the token in your requests:
   ```
   Authorization: Bearer YOUR_TOKEN_HERE
   ```

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👤 Author

**Jeremy Daniel Estrada**
- GitHub: [@jeremydanielestrada](https://github.com/jeremydanielestrada)

## 🐛 Issues

Found a bug or have a feature request? Please [open an issue](https://github.com/jeremydanielestrada/Inventory-Manager/issues).

## 📮 Support

If you need help or have questions, please open an issue in the GitHub repository.

---

Made with ❤️ using Laravel and Vue.js