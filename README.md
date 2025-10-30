# 🎓 Research Journal Management System (RJMS)

[![PHP Version](https://img.shields.io/badge/PHP-8.3.27-blue.svg)](https://www.php.net/)
[![MySQL Version](https://img.shields.io/badge/MySQL-8.0.43-orange.svg)](https://www.mysql.com/)
[![Framework](https://img.shields.io/badge/Framework-MVC-green.svg)](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

A modern, secure, and scalable web-based system for managing academic research journals and publications. Built with professional-grade MVC architecture, comprehensive security features, and modern PHP best practices.

**Official Research Journal Platform for Mindoro State University**

---

## 🌟 Features

### Core Functionality
- ✅ **Multi-Role User Management** - Admin, Editor, Reviewer, and Author roles
- ✅ **Journal Submission Workflow** - Complete submission, review, and publication pipeline
- ✅ **Document Management** - Secure file upload and storage system
- ✅ **Advanced Search** - Full-text search with filtering capabilities
- ✅ **Review System** - Peer review workflow with feedback management
- ✅ **Dashboard Analytics** - Role-based dashboards with statistics
- ✅ **Inbox Messaging** - Internal communication system

### Modern Architecture
- ✅ **MVC Framework** - Clean separation of concerns with Router, Controllers, and Models
- ✅ **ORM-like Database Layer** - Eloquent-style database operations
- ✅ **RESTful Routing** - Clean URLs with parameter support
- ✅ **PSR-4 Autoloading** - Modern PHP standards compliance
- ✅ **Environment Configuration** - Secure `.env` based configuration
- ✅ **Dependency Management** - Composer package manager

### Security Features
- ✅ **CSRF Protection** - Token-based form security
- ✅ **SQL Injection Prevention** - PDO prepared statements throughout
- ✅ **XSS Protection** - Output escaping and input sanitization
- ✅ **Secure Authentication** - Bcrypt password hashing
- ✅ **Session Security** - HTTPOnly, Secure, SameSite cookies
- ✅ **Activity Logging** - Comprehensive audit trail with Monolog

### Developer Features
- ✅ **Form Validation** - Built-in validator with multiple rules
- ✅ **Flash Messages** - User feedback system
- ✅ **Query Builder** - Fluent database interface
- ✅ **Testing Framework** - PHPUnit integration
- ✅ **Static Analysis** - PHPStan for code quality
- ✅ **Helper Functions** - 20+ utility functions

---

## 🚀 Technical Stack

### Backend
- **PHP** 8.3.27 (Modern PHP with type hints and attributes)
- **MySQL** 8.0.43 (Relational database)
- **PDO** (Database abstraction layer)
- **Composer** (Dependency management)

### Frontend
- **Bootstrap** 5.3.8 (Responsive UI framework)
- **Font Awesome** 7.1.0 (Icon library)
- **jQuery** 3.6.0 (DOM manipulation)
- **HTML5/CSS3/JavaScript** (Modern web standards)

### Development Tools
- **Monolog** 3.9.0 (Logging)
- **PHPDotEnv** 5.6.2 (Environment configuration)
- **PHPUnit** 9.6.29 (Testing framework)
- **PHPStan** 1.12.32 (Static analysis)

### Server
- **Apache/Nginx** (Web server)
- **mod_rewrite** (Clean URLs)

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
├── .htaccess                   # Root URL rewriting
│
└── Documentation/
    ├── README.md               # This file
    ├── MVC_FRAMEWORK.md        # MVC framework guide
    ├── IMPROVEMENTS.md         # Technical improvements
    ├── UPGRADE.md              # Migration guide
    ├── SETUP_COMPLETE.md       # Setup documentation
    └── MVC_IMPLEMENTATION_SUMMARY.md
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
- **inbox** - Internal messaging
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

### Available Documentation

- **MVC_FRAMEWORK.md** - Complete MVC framework guide with examples
- **IMPROVEMENTS.md** - Technical improvements and modernization details
- **UPGRADE.md** - Step-by-step migration guide
- **SETUP_COMPLETE.md** - Setup completion guide
- **MVC_IMPLEMENTATION_SUMMARY.md** - Quick implementation reference

### API Documentation

Coming soon - RESTful API documentation with OpenAPI specification.

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

### Version 2.0.0 (2025-10-30)
- ✅ Implemented full MVC framework architecture
- ✅ Added Router with parameter support
- ✅ Created Base Controller and Model classes
- ✅ Built Controllers: Home, Auth, Author
- ✅ Created Models: User, Submission
- ✅ Added comprehensive security features
- ✅ Integrated Composer dependency management
- ✅ Added logging system with Monolog
- ✅ Implemented PSR-4 autoloading
- ✅ Created extensive documentation

### Version 1.0.0
- Initial release
- Basic journal management functionality

---

## 👥 Authors

- **Leodyver Semilla** - *Initial work & MVC Implementation* - [leodyversemilla07@gmail.com](mailto:leodyversemilla07@gmail.com)

---

## 🙏 Acknowledgments

- Mindoro State University - For the opportunity
- PHP Community - For excellent tools and libraries
- Bootstrap Team - For the UI framework
- All contributors and testers

---

## 📧 Support

For support, email [leodyversemilla07@gmail.com](mailto:leodyversemilla07@gmail.com) or open an issue in the repository.

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 🌟 Star History

If you find this project useful, please consider giving it a star ⭐

---

**Built with ❤️ for Academic Excellence**

*Advancing Knowledge Through Scientific Research*
