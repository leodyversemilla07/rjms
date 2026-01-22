# Research Journal Management System

<div align="center">

[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=flat&logo=docker&logoColor=white)](DOCKER-DEV-GUIDE.md)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat)](LICENSE)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat)](CONTRIBUTING.md)

**Modern, enterprise-grade platform for managing academic research journals and publications**

[Features](#features) • [Quick Start](#quick-start) • [Documentation](#documentation) • [Contributing](#contributing)

---

### Official Research Journal Platform for [Mindoro State University](https://minsu.edu.ph)

_Built with a custom MVC framework, modern security practices, and Docker support_

</div>

## Overview

RJMS is a comprehensive web-based system designed for managing the complete lifecycle of academic research journals—from submission to publication. Built from the ground up with clean architecture principles and enterprise-grade security.

**What makes RJMS different:**

- **Custom MVC Framework** - No bloated dependencies, full control
- **Security First** - CSRF, XSS protection, secure sessions, input validation
- **Docker Ready** - One-command setup for development and production
- **Role-Based Access** - Separate dashboards for Authors, Reviewers, Editors, and Admins
- **Modern PHP** - PHP 8.3+ with strict types, ORM-style models, PSR-4 autoloading

## Features

<table>
<tr>
<td width="50%">

### Journal Management

- **Multi-role system** with granular permissions
- **Complete submission workflow** from draft to publication
- **Peer review system** with reviewer assignment
- **Document management** (PDF/DOC) with validation
- **Category organization** for research topics
- **Advanced search** with filters
- **Issue management** for journal publications

</td>
<td width="50%">

### Role-Based Dashboards

- **Authors** - Submit, track, and manage articles
- **Reviewers** - Review submissions and provide feedback
- **Editors** - Manage workflow and make decisions
- **Admins** - Full system control and analytics

</td>
</tr>
<tr>
<td width="50%">

### Technical Excellence

- Custom **MVC framework** (Router, ORM, Controllers)
- **PSR-4 autoloading** with Composer
- **RESTful routing** with dynamic parameters
- **Service layer** architecture
- Modern PHP 8.3+ features

</td>
<td width="50%">

### Enterprise Security

- **CSRF** & **XSS protection**
- **SQL injection prevention** (PDO)
- **Bcrypt password** hashing
- **Session hardening**
- **Input validation** & sanitization
- **File upload security**
- **Activity logging** (Monolog)

</td>
</tr>
</table>

## Tech Stack

| Layer            | Technologies                                          |
| ---------------- | ----------------------------------------------------- |
| **Backend**      | PHP 8.3+, MySQL 8.0+, PDO, Composer                   |
| **Frontend**     | Bootstrap 5, Font Awesome 7, jQuery 3, Tailwind CSS 4 |
| **Dependencies** | Monolog 3.9, PHPDotEnv 5.6, PHPMailer 7.0             |
| **Dev Tools**    | PHPUnit 9.6, PHPStan 1.12, Docker, Git                |
| **Server**       | Apache/Nginx, mod_rewrite, SSL (production)           |

## Quick Start

### Prerequisites

Choose your installation method:

<details open>
<summary><b>Docker (Recommended)</b> - One-command setup</summary>

**Requirements:**

- Docker Desktop 4.0+ (Windows/Mac) or Docker Engine 20.10+ (Linux)
- 4GB RAM, 5GB disk space

**Quick Start:**

```bash
# Clone the repository
git clone https://github.com/yourusername/rjms.git
cd rjms

# Windows - Run setup script
setup-docker.bat

# Linux/Mac - Run setup script
chmod +x setup-docker.sh && ./setup-docker.sh

# Or use Makefile
make setup
```

**That's it!** The application will be available at:

- **App:** http://localhost:8080
- **PHPMyAdmin:** http://localhost:8081
- **MySQL:** localhost:3307
- **Redis:** localhost:6379

**Default Login Credentials:**
| Role | Username | Password |
|------|----------|----------|
| Admin | `admin` | `admin123` |
| Editor | `editor` | `editor123` |
| Reviewer | `reviewer` | `reviewer123` |
| Author | `author` | `author123` |

**Docker Documentation:**

- [Development Guide](DOCKER-DEV-GUIDE.md) - Full development workflow
- [Quick Reference](DOCKER-QUICKREF.md) - Common commands
- [Optimization Summary](DOCKER-OPTIMIZATION-SUMMARY.md) - Performance tips

</details>

<details>
<summary><b>Manual Installation</b> - Traditional LAMP/LEMP stack</summary>

**Requirements:**

- PHP 8.3+ with extensions: `pdo_mysql`, `mbstring`, `xml`, `curl`, `gd`, `zip`
- MySQL 8.0+
- Composer 2.x
- Apache 2.4+ (with `mod_rewrite`) or Nginx 1.18+

**Step 1: Clone and Install Dependencies**

```bash
git clone https://github.com/yourusername/rjms.git
cd rjms
composer install
```

**Step 2: Environment Configuration**

```bash
# Copy environment file
cp .env.example .env

# Edit configuration (use your favorite editor)
nano .env
```

Update these critical values in `.env`:

```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=rjdb
DB_USER=root
DB_PASSWORD=your_secure_password
APP_URL=http://rjms.local
APP_ENV=production
APP_DEBUG=false
```

**Step 3: Database Setup**

```bash
# Create database
mysql -u root -p -e "CREATE DATABASE rjdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Import schema
mysql -u root -p rjdb < database/schema.sql
```

**Step 4: Set Permissions**

```bash
# Linux/Mac
chmod -R 775 uploads logs storage
chown -R www-data:www-data uploads logs storage

# Windows (Run as Administrator)
icacls uploads /grant "IIS_IUSRS:(OI)(CI)F" /T
icacls logs /grant "IIS_IUSRS:(OI)(CI)F" /T
```

**Step 5: Web Server Configuration**

<details>
<summary>Apache Configuration</summary>

Create `/etc/apache2/sites-available/rjms.conf`:

```apache
<VirtualHost *:80>
    ServerName rjms.local
    DocumentRoot /var/www/rjms/public

    <Directory /var/www/rjms/public>
        AllowOverride All
        Require all granted
        Options -Indexes +FollowSymLinks
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/rjms-error.log
    CustomLog ${APACHE_LOG_DIR}/rjms-access.log combined
</VirtualHost>
```

Enable site:

```bash
sudo a2ensite rjms
sudo a2enmod rewrite
sudo systemctl restart apache2
```

</details>

<details>
<summary>Nginx Configuration</summary>

Create `/etc/nginx/sites-available/rjms`:

```nginx
server {
    listen 80;
    server_name rjms.local;
    root /var/www/rjms/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\. {
        deny all;
    }
}
```

Enable site:

```bash
sudo ln -s /etc/nginx/sites-available/rjms /etc/nginx/sites-enabled/
sudo systemctl restart nginx
```

</details>

**Step 6: Update Hosts File**

```bash
# Linux/Mac
echo "127.0.0.1 rjms.local" | sudo tee -a /etc/hosts

# Windows (Edit C:\Windows\System32\drivers\etc\hosts as Administrator)
127.0.0.1 rjms.local
```

**Step 7: Access Application**
Navigate to http://rjms.local and login with default credentials above.

</details>

### Post-Installation

After installation, verify everything works:

```bash
# Test database connection
php -r "require 'vendor/autoload.php'; \$db = new \App\Core\Database(); echo 'Connected!';"

# Run tests
composer test

# Check code quality
composer analyse

# Build CSS (if using Tailwind)
npm run build
```

## Project Structure

```
rjms/
├── 📂 public/              # Web root (document root points here)
│   ├── index.php          # Front controller (single entry point)
│   ├── .htaccess          # Apache URL rewriting rules
│   └── css/               # Compiled stylesheets
│
├── 📂 src/                 # Application source code (PSR-4: App\)
│   ├── 📂 Core/           # Framework components
│   │   ├── Router.php     # URL routing & parameter binding
│   │   ├── Controller.php # Base controller (auth, views, validation)
│   │   ├── Model.php      # Base model (ORM/Query Builder)
│   │   ├── Database.php   # PDO wrapper with connection pooling
│   │   ├── Session.php    # Secure session management
│   │   └── CSRF.php       # CSRF token generation & validation
│   │
│   ├── 📂 Controllers/    # Business logic controllers
│   │   ├── AuthController.php    # Login/Register/Logout
│   │   ├── AdminController.php   # User & category management
│   │   ├── AuthorController.php  # Submission workflow
│   │   ├── EditorController.php  # Review assignment
│   │   └── ReviewerController.php # Peer reviews
│   │
│   ├── 📂 Models/         # Data models
│   │   ├── User.php       # User authentication & roles
│   │   ├── Submission.php # Article submissions
│   │   ├── Review.php     # Peer reviews
│   │   └── Category.php   # Research categories
│   │
│   ├── 📂 Services/       # Business logic layer
│   │   └── AuthService.php # Authentication service
│   │
│   ├── bootstrap.php      # Application bootstrap
│   └── helpers.php        # Global helper functions
│
├── 📂 resources/           # Application resources
│   ├── 📂 views/          # Blade-style templates
│   │   ├── layouts/       # Master layouts
│   │   ├── components/    # Reusable UI components
│   │   ├── auth/          # Login & registration
│   │   └── [role]/        # Role-specific dashboards
│   └── css/               # Source stylesheets
│
├── 📂 routes/              # Route definitions
│   └── web.php            # HTTP routes
│
├── 📂 database/            # Database management
│   ├── schema.sql         # Full database schema
│   └── migrations/        # Database migrations
│
├── 📂 tests/               # Test suite
│   └── Unit/              # Unit tests (PHPUnit)
│
├── 📂 uploads/             # User-uploaded files
│   └── submissions/       # Research article files
│
├── 📂 logs/                # Application logs
│   └── app.log            # Main log file (Monolog)
│
├── .env                    # Environment configuration (gitignored)
├── .env.example            # Environment template
├── composer.json           # PHP dependencies
├── package.json            # Node.js dependencies (CSS build)
└── Dockerfile              # Docker image definition
```

### Key Architecture Patterns

- **MVC Pattern**: Clean separation of concerns (Model-View-Controller)
- **Front Controller**: Single entry point (`public/index.php`) handles all requests
- **PSR-4 Autoloading**: `App\` namespace maps to `src/` directory
- **Service Layer**: Complex business logic isolated in Services
- **Repository Pattern**: Models act as data repositories
- **Dependency Injection**: Dependencies passed via constructors

## Development Guide

### Creating Your First Feature

#### 1. Define Routes

```php
// routes/web.php
$router->get('/articles', ['ArticleController', 'index']);
$router->post('/articles', ['ArticleController', 'store']);
$router->get('/articles/{id}', ['ArticleController', 'show']);
```

#### 2. Create Controller

```php
<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    private Article $article;

    public function __construct()
    {
        $this->article = new Article();
    }

    public function index()
    {
        $articles = $this->article->all();
        $this->view('articles/index', ['articles' => $articles]);
    }

    public function store()
    {
        // Validation with built-in validator
        $data = $this->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:100',
            'category_id' => 'required|numeric'
        ]);

        $id = $this->article->create($data);

        $this->flash('success', 'Article created successfully!');
        $this->redirect('/articles/' . $id);
    }

    public function show(int $id)
    {
        $article = $this->article->find($id);

        if (!$article) {
            $this->notFound('Article not found');
        }

        $this->view('articles/show', ['article' => $article]);
    }
}
```

#### 3. Create Model

```php
<?php
namespace App\Models;

use App\Core\Model;

class Article extends Model
{
    protected string $table = 'articles';

    protected array $fillable = [
        'title', 'content', 'author_id', 'category_id', 'status'
    ];

    protected array $hidden = ['deleted_at'];

    // Custom query methods
    public function getPublished()
    {
        return $this->where('status', 'published')
                    ->orderBy('created_at', 'DESC');
    }

    public function getByAuthor(int $authorId)
    {
        return $this->where('author_id', $authorId);
    }

    // Relationships (manual eager loading)
    public function withAuthor($id)
    {
        $article = $this->find($id);
        $article->author = (new User())->find($article->author_id);
        return $article;
    }
}
```

#### 4. Create View

```php
<!-- resources/views/articles/show.php -->
<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <article>
        <h1><?= e($article->title) ?></h1>
        <p class="text-muted">
            By <?= e($article->author_name) ?>
            on <?= e(date('F j, Y', strtotime($article->created_at))) ?>
        </p>
        <div class="content">
            <?= nl2br(e($article->content)) ?>
        </div>
    </article>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
```

### Available Helper Functions

```php
// Output Escaping
e($string)                    // Escape HTML entities (XSS protection)
old('field_name', 'default')  // Get old input value (form validation)

// Authentication
auth()                        // Get current authenticated user
isLoggedIn()                  // Check if user is logged in
hasRole('admin')              // Check user role

// URL & Routing
url('/path')                  // Generate full URL
asset('/css/style.css')       // Generate asset URL
redirect('/dashboard')        // Redirect to URL

// Flash Messages
flash('success', 'Saved!')    // Set flash message
getFlash('success')           // Get flash message
hasFlash('error')             // Check if flash exists

// CSRF Protection
csrf_field()                  // Generate CSRF hidden input
csrf_token()                  // Get CSRF token value

// Validation
validate($rules)              // Validate request data
hasError('field')             // Check validation error
getError('field')             // Get validation error
```

### Built-in Validation Rules

```php
$data = $this->validate([
    'email' => 'required|email|unique:users,email',
    'password' => 'required|min:8|max:255',
    'age' => 'numeric|min:18|max:120',
    'website' => 'url',
    'terms' => 'accepted',
    'file' => 'file|max:2048|mimes:pdf,doc,docx',
]);
```

**Available rules:** `required`, `email`, `numeric`, `url`, `min`, `max`, `unique`, `confirmed`, `accepted`, `file`, `mimes`

### Security Best Practices

```php
// ✅ Always escape output
<?= e($userInput) ?>

// ✅ Use CSRF protection in forms
<form method="POST">
    <?= csrf_field() ?>
    <!-- form fields -->
</form>

// ✅ Validate all user input
$data = $this->validate([
    'email' => 'required|email',
    'password' => 'required|min:6'
]);

// ✅ Require authentication
public function dashboard()
{
    $this->requireAuth();
    $this->requireRole('admin'); // Optional: specific role
    // ... controller logic
}

// ✅ Use parameterized queries (automatic in Model)
$users = $this->user->where('email', $email); // ✅ Safe
// Never: "SELECT * FROM users WHERE email = '$email'" // ❌ SQL Injection!
```

## Testing & Quality

### Running Tests

```bash
# Run all tests
composer test

# Run specific test file
./vendor/bin/phpunit tests/Unit/UserTest.php

# Run with coverage report
./vendor/bin/phpunit --coverage-html coverage/

# Watch mode (requires phpunit-watcher)
./vendor/bin/phpunit-watcher watch
```

### Static Analysis

```bash
# Run PHPStan (Level 5)
composer analyse

# Check specific directory
./vendor/bin/phpstan analyse src/Controllers

# Generate baseline (ignore existing issues)
./vendor/bin/phpstan analyse --generate-baseline
```

### Code Quality Tools

```bash
# PHP CodeSniffer (PSR-12)
./vendor/bin/phpcs src/ --standard=PSR12

# PHP CS Fixer (auto-fix)
./vendor/bin/php-cs-fixer fix src/

# Check security vulnerabilities
composer audit
```

## Troubleshooting

<details>
<summary><b>404 Error on All Routes</b></summary>

**Cause:** Apache mod_rewrite not enabled or .htaccess not working

**Solution:**

```bash
# Enable mod_rewrite
sudo a2enmod rewrite
sudo systemctl restart apache2

# Verify .htaccess files exist
ls -la .htaccess public/.htaccess

# Check Apache config allows .htaccess
# /etc/apache2/apache2.conf should have:
<Directory /var/www/>
    AllowOverride All  # Must be "All", not "None"
</Directory>
```

</details>

<details>
<summary><b>Database Connection Failed</b></summary>

**Solution:**

```bash
# 1. Verify .env configuration
cat .env | grep DB_

# 2. Test MySQL connection
mysql -h localhost -u root -p -e "SHOW DATABASES;"

# 3. Check if database exists
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS rjdb;"

# 4. Verify PHP PDO extension
php -m | grep pdo_mysql
```

</details>

<details>
<summary><b>Permission Denied Errors</b></summary>

**Solution:**

```bash
# Set correct ownership (Linux/Mac)
sudo chown -R www-data:www-data uploads/ logs/ storage/

# Set correct permissions
chmod -R 775 uploads/ logs/ storage/

# For development (not production!)
chmod -R 777 uploads/ logs/ storage/
```

</details>

<details>
<summary><b>CSRF Token Mismatch</b></summary>

**Causes:**

- Session not started
- Cookie domain mismatch
- Browser blocking cookies

**Solution:**

```php
// Check session is started in bootstrap.php
session_start();

// Clear browser cache and cookies
// Check .env session settings:
SESSION_SECURE=false    # Set to false for local development
SESSION_HTTP_ONLY=true
```

</details>

<details>
<summary><b>Composer Install Fails</b></summary>

**Solution:**

```bash
# Update Composer
composer self-update

# Clear cache
composer clear-cache

# Install with verbose output
composer install -vvv

# Skip platform requirements (not recommended)
composer install --ignore-platform-reqs
```

</details>

## Database Schema

### Entity Relationship Overview

```
┌─────────────┐         ┌──────────────┐         ┌─────────────┐
│    users    │────1:N──│  submissions │──N:M────│ categories  │
│             │         │              │         │             │
│ - id        │         │ - id         │         │ - id        │
│ - username  │         │ - title      │         │ - name      │
│ - email     │         │ - abstract   │         │ - slug      │
│ - password  │         │ - file_path  │         └─────────────┘
│ - role      │         │ - status     │
│ - created_at│         │ - author_id  │
└─────────────┘         │ - created_at │
       │                └──────────────┘
       │                       │
       │                      1:N
       │                       │
       │                ┌──────────────┐
       └────────N:1─────│   reviews    │
                        │              │
                        │ - id         │
                        │ - submission │
                        │ - reviewer   │
                        │ - rating     │
                        │ - comments   │
                        └──────────────┘
```

### Core Tables

**users** - User accounts and authentication

- Roles: `admin`, `editor`, `reviewer`, `author`
- Password hashing: Bcrypt (cost factor 12)
- Indexes: email (unique), role

**submissions** - Research article submissions

- Statuses: `draft`, `submitted`, `under_review`, `accepted`, `rejected`, `published`
- File storage: `uploads/submissions/`
- Indexes: author_id, status, created_at

**reviews** - Peer review records

- Ratings: 1-5 scale
- Recommendations: `accept`, `minor_revision`, `major_revision`, `reject`
- Indexes: submission_id, reviewer_id

**categories** - Research article categories

- Hierarchical structure support
- URL-friendly slugs
- Indexes: slug (unique)

See [`database/schema.sql`](database/schema.sql) for complete schema.

## Contributing

We welcome contributions! Whether it's bug reports, feature requests, or code contributions, your help makes RJMS better.

### How to Contribute

1. **Fork** the repository
2. **Create** a feature branch
   ```bash
   git checkout -b feature/amazing-feature
   ```
3. **Make** your changes
4. **Test** your changes
   ```bash
   composer test
   composer analyse
   ```
5. **Commit** with clear messages
   ```bash
   git commit -m "feat: add amazing feature"
   ```
6. **Push** to your fork
   ```bash
   git push origin feature/amazing-feature
   ```
7. **Open** a Pull Request

### Contribution Guidelines

**Code Standards:**

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding style
- Write meaningful variable and function names
- Add PHPDoc comments for public methods
- Keep functions small and focused (single responsibility)

**Commit Messages:**
Follow [Conventional Commits](https://www.conventionalcommits.org/):

- `feat:` New features
- `fix:` Bug fixes
- `docs:` Documentation changes
- `refactor:` Code refactoring
- `test:` Test additions/changes
- `chore:` Maintenance tasks

**Testing:**

- Add unit tests for new features
- Ensure all tests pass before submitting PR
- Aim for >80% code coverage on new code

**Documentation:**

- Update README.md if adding features
- Add inline comments for complex logic
- Update relevant documentation files

### Development Workflow

```bash
# 1. Setup development environment
git clone https://github.com/yourusername/rjms.git
cd rjms
composer install
cp .env.example .env

# 2. Create feature branch
git checkout -b feature/my-feature

# 3. Make changes and test
composer test        # Run tests
composer analyse     # Static analysis

# 4. Commit and push
git add .
git commit -m "feat: description of changes"
git push origin feature/my-feature
```

### Reporting Bugs

**Before submitting:**

- Check if the issue already exists
- Test on the latest version
- Gather relevant information (logs, screenshots, environment)

**Include in your report:**

- Clear description of the bug
- Steps to reproduce
- Expected vs actual behavior
- Environment details (PHP version, OS, browser)
- Error messages or logs

**Create an issue:** [GitHub Issues](https://github.com/yourusername/rjms/issues)

### Feature Requests

We love hearing your ideas! Please:

- Check if the feature has been requested
- Describe the use case and benefits
- Suggest implementation approach (optional)
- Consider if it fits the project scope

## License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

**What this means:**

- Commercial use allowed
- Modification allowed
- Distribution allowed
- Private use allowed
- No liability or warranty

## Support & Contact

**Need help?**

- **Documentation:** Start with this README
- **Bug Reports:** [Open an issue](https://github.com/yourusername/rjms/issues)
- **Questions:** [GitHub Discussions](https://github.com/yourusername/rjms/discussions)
- **Email:** [leodyversemilla07@gmail.com](mailto:leodyversemilla07@gmail.com)

**Response times:**

- Bug reports: 24-48 hours
- Feature requests: 1-2 weeks
- General questions: 1-3 days

## Authors & Maintainers

**Leodyver Semilla** - _Lead Developer & System Architect_

- Framework design and implementation
- Security architecture
- Database design
- Email: [leodyversemilla07@gmail.com](mailto:leodyversemilla07@gmail.com)
- GitHub: [@leodyversemilla07](https://github.com/leodyversemilla07)

## Project Statistics

```
📁 Total Files:        100+
💻 PHP Code:           ~10,000 lines
🎮 Controllers:        6 (50+ methods)
📦 Models:             4 with ORM
🎨 Views:              28 templates
🛣️ Routes:             45+ RESTful endpoints
🔧 Helper Functions:   20+
🗄️ Database Tables:    7
🧪 Test Coverage:      Growing
⏱️ Development Time:   Complete modernization cycle
```

## Roadmap

### Completed (v2.0)

- [x] Custom MVC framework
- [x] Docker development environment
- [x] Complete security implementation
- [x] Multi-role dashboard system
- [x] Peer review workflow
- [x] File upload system
- [x] Testing & CI setup

### In Progress (v2.1)

- [ ] Email notification system (80% complete)
- [ ] Advanced analytics dashboard
- [ ] Export to PDF/LaTeX
- [ ] RESTful API with JWT authentication

### Future (v3.0+)

- [ ] Real-time notifications (WebSockets)
- [ ] Multi-language support (i18n)
- [ ] Mobile application (React Native)
- [ ] Full-text search with Elasticsearch
- [ ] Redis caching layer
- [ ] GraphQL API
- [ ] Microservices architecture (optional)

**Want to contribute?** Check our [Contributing Guide](#contributing)

---

<div align="center">

## Show Your Support

If RJMS helps your research institution, please consider:

- Starring this repository
- Reporting bugs or suggesting features
- Improving documentation
- Contributing code

---

**Built for Academic Excellence**

_Advancing Knowledge Through Scientific Research_

---

**[Back to Top](#research-journal-management-system)**

**© 2025 Research Journal Management System | [MIT License](LICENSE)**

</div>
