@echo off
REM RJMS Database Setup Script for Windows
REM This script helps set up the database for the Research Journal Management System

echo ================================
echo RJMS Database Setup Utility
echo ================================
echo.

REM Check if we're in the right directory
if not exist "migrate.php" (
    echo ERROR: This script must be run from the database directory
    echo Please navigate to: xampp\htdocs\rjms\database\
    pause
    exit /b 1
)

echo Choose an option:
echo 1. Quick setup (import complete schema)
echo 2. Run migrations step by step
echo 3. Check migration status
echo 4. Reset database (WARNING: Deletes all data!)
echo 5. Create new migration
echo 6. Exit
echo.

set /p choice="Enter your choice (1-6): "

if "%choice%"=="1" goto quick_setup
if "%choice%"=="2" goto run_migrations
if "%choice%"=="3" goto check_status
if "%choice%"=="4" goto reset_db
if "%choice%"=="5" goto create_migration
if "%choice%"=="6" goto exit
goto invalid_choice

:quick_setup
echo.
echo Setting up database using complete schema...
echo.
echo Please ensure:
echo 1. XAMPP MySQL is running
echo 2. You have MySQL root access
echo.
set /p confirm="Continue? (y/n): "
if /i not "%confirm%"=="y" goto exit

echo.
echo Creating database and importing schema...
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS rjdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p rjdb < schema.sql

if %errorlevel% equ 0 (
    echo.
    echo ✓ Database setup completed successfully!
    echo.
    echo Default users created:
    echo - admin/admin123 (Administrator)
    echo - editor/editor123 (Editor)
    echo - reviewer/reviewer123 (Reviewer) 
    echo - author/author123 (Author)
    echo.
    echo ⚠️  IMPORTANT: Change default passwords in production!
) else (
    echo.
    echo ✗ Database setup failed. Please check:
    echo - MySQL server is running
    echo - Correct username/password
    echo - Proper permissions
)
goto end

:run_migrations
echo.
echo Running database migrations...
php migrate.php migrate
goto end

:check_status
echo.
echo Checking migration status...
php migrate.php status
goto end

:reset_db
echo.
echo ⚠️  WARNING: This will delete ALL data in the database!
set /p confirm="Are you sure? Type 'YES' to continue: "
if not "%confirm%"=="YES" (
    echo Reset cancelled.
    goto end
)
php migrate.php reset
goto end

:create_migration
echo.
set /p name="Enter migration name (e.g., add_new_column): "
if "%name%"=="" (
    echo Migration name cannot be empty.
    goto end
)
php migrate.php create %name%
goto end

:invalid_choice
echo.
echo Invalid choice. Please try again.
goto end

:exit
echo.
echo Goodbye!
exit /b 0

:end
echo.
pause
