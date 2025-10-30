# RJMS Upgrade Guide

## Version 2.0.0 - Modern PHP Architecture

This guide will help you upgrade your RJMS installation to the new modern architecture.

### ⚠️ Prerequisites

Before upgrading, ensure you have:

1. **PHP 7.4 or higher** installed
   ```bash
   sudo apt update
   sudo apt install php8.1 php8.1-cli php8.1-mysql php8.1-mbstring php8.1-xml php8.1-curl
   ```

2. **Composer** installed
   ```bash
   curl -sS https://getcomposer.org/installer | php
   sudo mv composer.phar /usr/local/bin/composer
   ```

3. **Backup your database and files**
   ```bash
   mysqldump -u root -p rjdb > backup_$(date +%Y%m%d).sql
   tar -czf files_backup_$(date +%Y%m%d).tar.gz uploads/
   ```

### 📦 Installation Steps

#### 1. Install Dependencies

```bash
cd /home/leodyversemilla07/rjms
composer install
```

#### 2. Configure Environment

The `.env` file has been created. Review and update if needed:

```bash
nano .env
```

Key settings to check:
- Database credentials (DB_HOST, DB_NAME, DB_USER, DB_PASSWORD)
- APP_ENV (set to 'production' for live environments)
- APP_DEBUG (set to 'false' for production)

#### 3. Set Proper Permissions

```bash
# Make uploads and logs writable
chmod -R 775 uploads logs

# Protect sensitive files
chmod 644 .env
chmod 644 composer.json
```

#### 4. Test the Installation

```bash
# Run tests (requires PHPUnit)
composer test

# Or manually:
./vendor/bin/phpunit
```

### 🔄 Migrating Existing Code

The new architecture is **backward compatible**. Your existing PHP pages will continue to work.

#### For New Development:

1. **Use the new Database class instead of mysqli:**

   **Old way:**
   ```php
   $conn = connectDB();
   $result = $conn->query("SELECT * FROM users");
   ```

   **New way:**
   ```php
   use App\Core\Database;
   
   $users = Database::fetchAll("SELECT * FROM users WHERE id = ?", [$userId]);
   ```

2. **Use AuthService for authentication:**

   **Old way:**
   ```php
   if (!isset($_SESSION['user_id'])) {
       header('Location: login.php');
   }
   ```

   **New way:**
   ```php
   use App\Services\AuthService;
   
   AuthService::requireAuth();
   // or
   if (AuthService::check()) {
       $user = AuthService::user();
   }
   ```

3. **Add CSRF protection to forms:**

   ```php
   <form method="POST">
       <?php echo \App\Core\CSRF::field(); ?>
       <!-- form fields -->
   </form>
   ```

   And verify in the handler:
   ```php
   if (!\App\Core\CSRF::verify()) {
       die('Invalid CSRF token');
   }
   ```

4. **Use helper functions:**

   ```php
   // Instead of $_ENV['DB_NAME']
   $dbName = env('DB_NAME');
   
   // Instead of htmlspecialchars()
   echo e($userInput);
   
   // Instead of isset($_SESSION['user'])
   if (auth()) {
       $user = user();
   }
   ```

### 📝 Updating Existing Pages

To update an existing page to use the new system:

1. Add bootstrap at the top:
   ```php
   <?php
   require_once __DIR__ . '/vendor/autoload.php';
   require_once __DIR__ . '/src/bootstrap.php';
   ```

2. Replace old database connections with new Database class

3. Add CSRF tokens to POST forms

4. Use AuthService for authentication checks

5. Use Logger for important events

### 🚀 New Features Available

#### Logging
```php
use App\Core\Logger;

Logger::info('User submitted paper', ['user_id' => $userId]);
Logger::error('Upload failed', ['file' => $filename]);
```

#### Session Management
```php
use App\Core\Session;

Session::flash('success', 'Paper submitted successfully!');
$message = Session::getFlash('success');
```

#### Helper Functions
```php
// Redirect
redirect('/dashboard.php');

// Check authentication
if (auth()) {
    $user = user();
    $role = userRole();
}

// JSON responses
jsonResponse(['status' => 'success', 'data' => $data]);
```

### 🔍 Testing Your Upgrade

1. **Test authentication:**
   - Login as different user roles
   - Check logout functionality
   - Verify session management

2. **Test database operations:**
   - Create, read, update, delete operations
   - Check query logging

3. **Test file uploads:**
   - Upload submissions
   - Check file storage

4. **Check logs:**
   ```bash
   tail -f logs/app.log
   ```

### 🐛 Troubleshooting

**Issue: Composer not found**
```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

**Issue: PHP extensions missing**
```bash
# Install required extensions
sudo apt install php-mbstring php-xml php-curl
```

**Issue: Permission denied on logs/uploads**
```bash
sudo chown -R www-data:www-data logs uploads
chmod -R 775 logs uploads
```

**Issue: Database connection failed**
- Check .env file has correct credentials
- Verify MySQL is running: `sudo service mysql status`
- Test connection: `mysql -u root -p`

### 📚 Next Steps

1. Read the updated [README.md](README.md)
2. Review new [security features](#security-features)
3. Plan migration of custom code to new architecture
4. Set up automated testing with PHPUnit
5. Configure production environment properly

### 🆘 Getting Help

- Check logs in `logs/app.log`
- Review documentation in `/database/README.md`
- Open an issue on GitHub
- Contact: leodyversemilla07@gmail.com

---

**Note:** Take your time with the upgrade. The system supports both old and new code simultaneously, so you can migrate gradually.
