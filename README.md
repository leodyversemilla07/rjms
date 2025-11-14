# 🎓 Research Journal Management System (RJMS)

[![PHP Version](https://img.shields.io/badge/PHP-8.3.27-blue.svg)](https://www.php.net/)
[![MySQL Version](https://img.shields.io/badge/MySQL-8.0.43-orange.svg)](https://www.mysql.com/)
[![Framework](https://img.shields.io/badge/Framework-Custom%20MVC-green.svg)](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)
[![Status](https://img.shields.io/badge/Status-Production%20Ready-success.svg)]()

A modern, enterprise-grade web-based system for managing academic research journals and publications. Built from the ground up with professional MVC architecture, comprehensive security features, and modern PHP best practices.

**Official Research Journal Platform for Mindoro State University**

> **Migration Complete**: Successfully modernized from legacy flat architecture to professional MVC framework (November 2025)
> 
> **Architecture**: Custom MVC Framework | **Controllers**: 6 | **Models**: 4 | **Views**: 28 | **Routes**: 45+

---

## 🌟 Features

### 📚 Core Journal Management
- ✅ **Multi-Role System** - Admin, Editor, Reviewer, and Author roles with granular permissions
- ✅ **Submission Workflow** - Complete manuscript submission and tracking system
- ✅ **Peer Review System** - Comprehensive review workflow with recommendations
- ✅ **Document Management** - Secure PDF/DOC upload with validation
- ✅ **Publication Pipeline** - From submission to published article management
- ✅ **Category Management** - Organize articles by research categories
- ✅ **Advanced Search** - Full-text search with multi-criteria filtering
- ✅ **Current Issues** - Browse and display published journal issues

### 🎯 Role-Specific Dashboards

**Author Dashboard**
- Submit new research articles
- Track submission status
- View reviews and feedback
- Manage published articles
- Submission history

**Reviewer Dashboard**
- View assigned submissions
- Submit peer reviews
- Track review history
- Manage review deadlines
- Access review guidelines

**Editor Dashboard**
- Manage all submissions
- Assign reviewers
- Make publication decisions
- Track review progress
- Editorial workflow management

**Admin Dashboard**
- User management (CRUD operations)
- System-wide submission overview
- Category management
- Publishing controls
- System statistics and analytics

### 🏗️ Modern Architecture
- ✅ **Custom MVC Framework** - Built-from-scratch professional architecture
- ✅ **Smart Router** - RESTful routing with dynamic parameters (`{id}`, `{slug}`)
- ✅ **Base Controller** - Shared functionality (auth, validation, views, redirects)
- ✅ **Base Model** - Eloquent-inspired ORM with query builder
- ✅ **PSR-4 Autoloading** - Standards-compliant namespace autoloading
- ✅ **Environment Config** - `.env` file for secure configuration management
- ✅ **Front Controller** - Single entry point (`public/index.php`)
- ✅ **Service Layer** - Business logic separation (AuthService)
- ✅ **Middleware Ready** - Extensible middleware architecture

### 🔒 Enterprise Security
- ✅ **CSRF Protection** - Token-based form security on all POST requests
- ✅ **SQL Injection Prevention** - PDO prepared statements throughout
- ✅ **XSS Protection** - Output escaping helper functions
- ✅ **Password Security** - Bcrypt hashing with work factor
- ✅ **Session Hardening** - HTTPOnly, Secure, SameSite cookie flags
- ✅ **File Upload Security** - Type, size, and content validation
- ✅ **Input Validation** - Server-side validation with 10+ rules
- ✅ **Activity Logging** - Monolog-based audit trail
- ✅ **Role-based Access** - Controller-level authorization checks

### 🛠️ Developer Experience
- ✅ **Form Validation** - Built-in validator (required, email, min, max, etc.)
- ✅ **Flash Messages** - Session-based user feedback system
- ✅ **Query Builder** - Fluent interface for database operations
- ✅ **Helper Functions** - 20+ utility functions (e(), auth(), old(), etc.)
- ✅ **Error Handling** - Custom 404 pages and exception handling
- ✅ **Testing Suite** - PHPUnit with unit and feature tests
- ✅ **Static Analysis** - PHPStan for code quality assurance
- ✅ **Logging System** - File-based logging with rotation
- ✅ **View Helpers** - Template helpers for common UI patterns

---

## 🚀 Technical Stack

### Backend
- **PHP** 8.3.27 - Modern PHP with strict types, attributes, and enhanced performance
- **MySQL** 8.0.43 - Robust relational database with JSON support
- **PDO** - Secure database abstraction layer with prepared statements
- **Composer** 2.x - Modern dependency management

### Frontend
- **Bootstrap** 5.3.8 - Mobile-first responsive framework
- **Font Awesome** 7.1.0 - Comprehensive icon library (2000+ icons)
- **jQuery** 3.6.0 - DOM manipulation and AJAX
- **HTML5/CSS3/ES6** - Modern web standards

### Core Dependencies
- **Monolog** 3.9.0 - PSR-3 compliant logging framework
- **PHPDotEnv** 5.6.2 - Environment configuration management
- **Symfony Polyfills** - PHP 7.4+ compatibility layer

### Development & Testing
- **PHPUnit** 9.6.29 - Unit and feature testing framework
- **PHPStan** 1.12.32 - Static analysis tool (Level 5)
- **Composer Scripts** - Automated testing and analysis

### Server Requirements
- **Apache 2.4+** or **Nginx 1.18+**
- **mod_rewrite** (Apache) or URL rewriting enabled (Nginx)
- **SSL Certificate** (recommended for production)

---

## 📁 Project Structure

```
/rjms
├── public/                      # Web root (Document Root)
│   ├── index.php               # Front controller (entry point)
│   └── .htaccess               # Apache URL rewriting
│
├── routes/                      # Application routes
│   └── web.php                 # Route definitions
│
├── src/                         # Application source code
│   ├── Core/                   # Framework core
│   │   ├── Router.php         # HTTP routing engine
│   │   ├── Controller.php     # Base controller class
│   │   ├── Model.php          # Base model (ORM)
│   │   ├── Database.php       # PDO database layer
│   │   ├── Session.php        # Session management
│   │   ├── CSRF.php           # CSRF protection
│   │   └── Logger.php         # Logging system
│   │
│   ├── Controllers/            # Application controllers
│   │   ├── HomeController.php
│   │   ├── AuthController.php
│   │   ├── AuthorController.php
│   │   ├── AdminController.php
│   │   ├── EditorController.php
│   │   └── ReviewerController.php
│   │
│   ├── Models/                 # Data models
│   │   ├── User.php
│   │   ├── Submission.php
│   │   ├── Review.php
│   │   └── Category.php
│   │
│   ├── Services/               # Business logic
│   │   └── AuthService.php
│   │
│   ├── Middleware/             # HTTP middleware
│   ├── Helpers/                # Helper functions
│   ├── bootstrap.php           # Application initialization
│   └── helpers.php             # Global helper functions
│
├── resources/                   # Application resources
│   └── views/                  # View templates
│       ├── layouts/            # Layout templates
│       ├── home/               # Home page views
│       ├── auth/               # Authentication views
│       ├── author/             # Author dashboard views
│       ├── admin/              # Admin dashboard views
│       ├── editor/             # Editor dashboard views
│       ├── reviewer/           # Reviewer dashboard views
│       ├── components/         # Reusable components
│       └── errors/             # Error pages
│
├── database/                    # Database files
│   ├── schema.sql              # Database schema
│   ├── migrations/             # Database migrations
│   └── migrate.php             # Migration runner
│
├── tests/                       # Test files
│   └── Unit/                   # Unit tests
│
├── logs/                        # Application logs
│   └── app.log                 # Main log file
│
├── uploads/                     # User uploads
│   └── submissions/            # Submission files
│
├── vendor/                      # Composer dependencies
│
├── .env                         # Environment configuration
├── .env.example                # Environment template
├── .gitignore                  # Git ignore rules
├── composer.json               # Composer dependencies
├── composer.lock               # Locked dependencies
├── phpunit.xml                 # PHPUnit configuration
└── .htaccess                   # Root URL rewriting
```

---

## ⚡ Quick Start

### Prerequisites

- PHP 8.3+ with extensions:
  - pdo_mysql
  - mbstring
  - xml
  - curl
  - gd
  - zip
  - bcmath
- MySQL 8.0+
- Composer
- Apache/Nginx with mod_rewrite

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/rjms.git
   cd rjms
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   nano .env
   ```
   
   Update database credentials:
   ```env
   DB_HOST=localhost
   DB_PORT=3306
   DB_NAME=rjdb
   DB_USER=root
   DB_PASSWORD=your_password
   ```

4. **Create database and import schema**
   ```bash
   mysql -u root -p -e "CREATE DATABASE rjdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
   mysql -u root -p rjdb < database/schema.sql
   ```

5. **Set permissions**
   ```bash
   chmod -R 775 uploads logs
   chmod 644 .env
   ```

6. **Configure Apache Virtual Host**
   
   Create `/etc/apache2/sites-available/rjms.conf`:
   ```apache
   <VirtualHost *:80>
       ServerName rjms.local
       DocumentRoot /path/to/rjms/public
       
       <Directory /path/to/rjms/public>
           AllowOverride All
           Require all granted
       </Directory>
       
       ErrorLog ${APACHE_LOG_DIR}/rjms-error.log
       CustomLog ${APACHE_LOG_DIR}/rjms-access.log combined
   </VirtualHost>
   ```
   
   Enable site and rewrite module:
   ```bash
   sudo a2ensite rjms
   sudo a2enmod rewrite
   sudo systemctl restart apache2
   ```

7. **Add to hosts file**
   ```bash
   echo "127.0.0.1 rjms.local" | sudo tee -a /etc/hosts
   ```

8. **Access the application**
   ```
   http://rjms.local
   ```

---

## 🎯 Usage

### MVC Framework

#### Creating a Controller

```php
<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    private Article $articleModel;

    public function __construct()
    {
        $this->articleModel = new Article();
    }

    public function index()
    {
        $articles = $this->articleModel->all();
        $this->view('articles/index', ['articles' => $articles]);
    }

    public function store()
    {
        $data = $this->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $id = $this->articleModel->create($data);
        $this->flash('success', 'Article created successfully!');
        $this->redirect('/articles/' . $id);
    }
}
```

#### Creating a Model

```php
<?php

namespace App\Models;

use App\Core\Model;

class Article extends Model
{
    protected string $table = 'articles';
    protected array $fillable = ['title', 'content', 'author_id'];
    protected array $hidden = ['deleted_at'];

    public function getPublished()
    {
        return $this->where('status', 'published');
    }

    public function getByAuthor(int $authorId)
    {
        return $this->where('author_id', $authorId);
    }
}
```

#### Defining Routes

```php
// routes/web.php

$router->get('/articles', ['ArticleController', 'index']);
$router->post('/articles', ['ArticleController', 'store']);
$router->get('/articles/{id}', ['ArticleController', 'show']);
$router->post('/articles/{id}/update', ['ArticleController', 'update']);
$router->post('/articles/{id}/delete', ['ArticleController', 'destroy']);
```

### Available Routes

#### Public Routes
- `GET /` - Homepage
- `GET /about` - About page
- `GET /contact` - Contact page
- `GET /faq` - FAQ page
- `GET /search` - Search articles

#### Authentication
- `GET /login` - Login page
- `POST /login` - Login handler
- `GET /register` - Registration page
- `POST /register` - Registration handler
- `GET /logout` - Logout

#### Author Dashboard
- `GET /author/dashboard` - Author dashboard
- `GET /author/submit` - Submit article form
- `POST /author/submit` - Submit article
- `GET /author/manage` - Manage articles
- `GET /author/article/{id}` - View article
- `POST /author/article/{id}/delete` - Delete article

---

## 🔒 Security

### Implemented Security Features

- **CSRF Protection** - All forms protected with tokens
- **SQL Injection Prevention** - PDO prepared statements
- **XSS Protection** - Output escaping helpers
- **Password Security** - Bcrypt hashing
- **Session Security** - Secure cookie settings
- **Input Validation** - Server-side validation
- **File Upload Security** - Type and size validation
- **Activity Logging** - All critical operations logged

### Security Best Practices

```php
// Always escape output
<?= e($userInput) ?>

// Use CSRF protection in forms
<form method="POST">
    <?= \App\Core\CSRF::field() ?>
    <!-- form fields -->
</form>

// Validate user input
$data = $this->validate([
    'email' => 'required|email',
    'password' => 'required|min:6'
]);

// Use authentication
$this->requireAuth();
$this->requireRole('admin');
```

---

## 🧪 Testing

### Run Tests

```bash
# Run all tests
composer test

# Run with coverage
./vendor/bin/phpunit --coverage-html coverage

# Run specific test
./vendor/bin/phpunit tests/Unit/UserTest.php
```

### Static Analysis

```bash
# Run PHPStan
composer analyse

# Or directly
./vendor/bin/phpstan analyse src tests
```

---

## 📊 Database Schema

### Main Tables

- **users** - User accounts with roles
- **submissions** - Research article submissions
- **reviews** - Peer review records
- **categories** - Article categories
- **submission_categories** - Article-category relationships
- **user_sessions** - Active sessions
- **migrations** - Database migration history

### Database Diagram

See `database/schema.sql` for complete schema definition.

---

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Coding Standards

- Follow PSR-12 coding standard
- Write meaningful commit messages
- Add tests for new features
- Update documentation

---

## 📝 Documentation

All documentation is now consolidated in this README.md file. This comprehensive guide includes:

- **Architecture Overview** - MVC framework structure and components
- **Installation Guide** - Step-by-step setup instructions
- **Usage Examples** - Code samples for controllers, models, and routes
- **Security Guidelines** - Best practices for secure development
- **API Reference** - Helper functions and core classes

### Additional Resources

- **Inline Code Documentation** - PHPDoc comments throughout the codebase
- **Database Schema** - See `database/schema.sql` for complete table definitions
- **Test Examples** - Reference `tests/` directory for testing patterns

---

## 🐛 Troubleshooting

### Common Issues

**Issue: 404 on all routes**
```bash
# Enable Apache rewrite module
sudo a2enmod rewrite
sudo systemctl restart apache2

# Check .htaccess files exist
ls -la public/.htaccess
ls -la .htaccess
```

**Issue: Permission denied errors**
```bash
# Fix permissions
chmod -R 775 uploads logs
chown -R www-data:www-data uploads logs
```

**Issue: Composer not found**
```bash
# Install Composer globally
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

**Issue: Database connection failed**
```bash
# Check .env file
cat .env | grep DB_

# Test MySQL connection
mysql -u root -p -e "SHOW DATABASES;"
```

---

## 📈 Performance

### Optimization Tips

- Enable OPcache in production
- Use query result caching
- Implement lazy loading for relationships
- Minify CSS/JS assets
- Enable Gzip compression
- Use CDN for static assets

---

## 🔄 Changelog

### Version 2.0.0 (November 2025) - MVC Migration Complete ✅
**Major Architecture Overhaul - Legacy to Modern MVC**

#### Framework & Architecture
- ✅ **Custom MVC Framework** - Built Router, Controller, Model base classes from scratch
- ✅ **PSR-4 Autoloading** - Composer autoloading with App\ namespace
- ✅ **Front Controller Pattern** - Single entry point (public/index.php)
- ✅ **Service Layer** - Separated business logic (AuthService)
- ✅ **Middleware Architecture** - Extensible middleware support

#### Controllers Implemented (6)
- ✅ **HomeController** - Public pages (index, about, contact, FAQ, search, current-issues)
- ✅ **AuthController** - Authentication (login, register, logout)
- ✅ **AuthorController** - Author dashboard and submission management
- ✅ **AdminController** - Admin panel (users, categories, publishing)
- ✅ **EditorController** - Editor workflow and reviewer assignment
- ✅ **ReviewerController** - Reviewer dashboard and review submission

#### Models Created (4)
- ✅ **User** - User authentication and role management
- ✅ **Submission** - Article submission handling
- ✅ **Review** - Peer review system
- ✅ **Category** - Article categorization

#### Views Migrated (28)
- ✅ **Layouts** - main.php master layout
- ✅ **Components** - header.php, navigation.php, footer.php
- ✅ **Home** - 6 public pages
- ✅ **Auth** - login.php, register.php
- ✅ **Author** - 4 dashboard views
- ✅ **Admin** - 4 management views
- ✅ **Editor** - 3 editorial views
- ✅ **Reviewer** - 4 reviewer views
- ✅ **Errors** - 404.php

#### Routing System
- ✅ **50+ RESTful Routes** - Defined in routes/web.php
- ✅ **Dynamic Parameters** - Support for {id}, {slug} in URLs
- ✅ **Clean URLs** - Apache mod_rewrite configuration

#### Security Enhancements
- ✅ **CSRF Protection** - Token-based form security
- ✅ **SQL Injection Prevention** - PDO prepared statements
- ✅ **XSS Protection** - Output escaping helpers
- ✅ **Password Hashing** - Bcrypt with cost factor 12
- ✅ **Session Hardening** - Secure cookie configuration
- ✅ **File Upload Security** - MIME type and size validation
- ✅ **Role-based Access Control** - Authorization in controllers

#### Developer Tools & Quality
- ✅ **Composer Integration** - Modern dependency management
- ✅ **Monolog Logging** - PSR-3 compliant logging
- ✅ **PHPUnit Testing** - Unit and feature test framework
- ✅ **PHPStan Analysis** - Static code analysis (Level 5)
- ✅ **Helper Functions** - 20+ utility functions
- ✅ **Form Validation** - Built-in validator with 10+ rules
- ✅ **Flash Messages** - Session-based user feedback

#### Database
- ✅ **6 Tables** - users, submissions, reviews, categories, submission_categories, user_sessions
- ✅ **Migration System** - Version-controlled schema changes
- ✅ **Optimized Indexes** - Performance-tuned queries

#### Features Completed
- ✅ **Multi-role Dashboard** - Admin, Editor, Reviewer, Author
- ✅ **Submission Workflow** - Complete article submission pipeline
- ✅ **Peer Review System** - Assignment and review management
- ✅ **Publication Management** - Publish/unpublish articles
- ✅ **User Management** - CRUD operations for users
- ✅ **Category Management** - Organize articles by category
- ✅ **Search System** - Full-text search functionality

#### Migration Process
- ✅ **Legacy Code Removed** - Deleted _legacy directory after migration
- ✅ **Documentation Updated** - Comprehensive README.md
- ✅ **Code Organization** - Proper MVC structure with namespaces
- ✅ **Testing** - All features tested and working

**Total Files Migrated**: 50+ PHP files  
**Lines of Code**: 10,000+ lines  
**Migration Duration**: Complete modernization cycle  
**Breaking Changes**: Yes (complete rewrite)

---

### Version 1.0.0 (2024) - Initial Release (Legacy)
- Basic journal management functionality
- Flat file architecture
- Role-based access
- Submission workflow
- ⚠️ **Deprecated** - Replaced by Version 2.0.0

---

## 👥 Authors

- **Leodyver Semilla** - *Lead Developer & System Architect*
  - Complete MVC framework implementation and migration
  - Email: [leodyversemilla07@gmail.com](mailto:leodyversemilla07@gmail.com)
  - Role: Full-stack development, security implementation, database design

---

## 🙏 Acknowledgments

- **Mindoro State University** - For the opportunity and project support
- **PHP Community** - For excellent tools, libraries, and best practices
- **Bootstrap Team** - For the responsive UI framework
- **Monolog Contributors** - For robust logging capabilities
- **PHPUnit & PHPStan Teams** - For testing and static analysis tools
- All contributors, testers, and users of the RJMS platform

---

## 📧 Support

For support, questions, or feedback:

- **Email**: [leodyversemilla07@gmail.com](mailto:leodyversemilla07@gmail.com)
- **Issues**: Open an issue in the repository
- **Documentation**: Refer to this README and inline code documentation

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 🌟 Project Statistics

- **Total Files**: 100+
- **PHP Code**: 10,000+ lines
- **Controllers**: 6 (50+ methods)
- **Models**: 4 (with ORM)
- **Views**: 28 templates
- **Routes**: 45+ RESTful endpoints
- **Helper Functions**: 20+
- **Database Tables**: 7
- **Test Coverage**: Growing
- **Development Time**: Complete modernization cycle

---

## 🎯 Future Roadmap

### Planned Features
- [ ] RESTful API with JWT authentication
- [ ] Real-time notifications
- [ ] Email notification system
- [ ] Advanced analytics dashboard
- [ ] Export to PDF/LaTeX
- [ ] Multi-language support (i18n)
- [ ] Docker containerization
- [ ] Mobile application

### Technical Improvements
- [ ] Redis caching layer
- [ ] Full-text search with Elasticsearch
- [ ] Asset bundling with Webpack
- [ ] CI/CD pipeline
- [ ] Performance monitoring

---

**Built with ❤️ for Academic Excellence**

*Advancing Knowledge Through Scientific Research*

---

**© 2025 Research Journal Management System | Mindoro State University**
