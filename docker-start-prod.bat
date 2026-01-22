@echo off
REM RJMS Docker Startup Script (Production) - Windows
REM This script initializes the Docker environment for RJMS in production mode

echo ==========================================
echo RJMS Docker Setup - Production Mode
echo ==========================================
echo.

REM Check if Docker is running
docker info >nul 2>&1
if %errorlevel% neq 0 (
    echo Error: Docker is not running. Please start Docker Desktop and try again.
    pause
    exit /b 1
)

REM Check if .env file exists
if not exist .env (
    echo Error: .env file not found!
    echo Please create .env file from .env.docker.prod and configure it properly.
    echo.
    echo Steps:
    echo   1. copy .env.docker.prod .env
    echo   2. Edit .env and set secure passwords and APP_KEY
    echo   3. Run this script again
    pause
    exit /b 1
)

REM Validate critical environment variables
findstr /C:"CHANGE_THIS" .env >nul
if %errorlevel% equ 0 (
    echo Error: Please update all placeholder values in .env file!
    echo Look for 'CHANGE_THIS' and replace with secure values.
    pause
    exit /b 1
)

REM Copy schema to Docker init directory
echo Copying database schema...
if not exist docker\mysql\init mkdir docker\mysql\init
copy /Y database\schema.sql docker\mysql\init\schema.sql >nul
echo [OK] Schema copied to docker\mysql\init\
echo.

REM Build and start containers
echo Building Docker images for production...
docker-compose build --no-cache
echo [OK] Images built successfully
echo.

echo Starting containers...
docker-compose up -d
echo [OK] Containers started
echo.

REM Wait for MySQL to be ready
echo Waiting for MySQL to be ready...
timeout /t 15 /nobreak >nul

REM Check database status
echo Checking database status...
docker-compose exec -T mysql mysql -urjms -prjmspassword -e "USE rjdb; SHOW TABLES;" >nul 2>&1
if %errorlevel% equ 0 (
    echo [OK] Database initialized successfully
) else (
    echo [WARNING] Database initialization may have failed. Check logs with: docker-compose logs mysql
)
echo.

REM Create necessary directories
if not exist uploads\submissions mkdir uploads\submissions
if not exist logs mkdir logs

echo ==========================================
echo RJMS Production Deployment Complete!
echo ==========================================
echo.
echo Application is now running at:
echo   * Main App:    http://localhost:8080
echo   * PHPMyAdmin:  http://localhost:8081
echo.
echo IMPORTANT SECURITY STEPS:
echo   1. Change all default user passwords immediately
echo   2. Configure SSL/TLS certificates for HTTPS
echo   3. Set up firewall rules
echo   4. Configure backup strategy
echo   5. Set up monitoring and logging
echo.
echo Useful Commands:
echo   * View logs:        docker-compose logs -f
echo   * Stop containers:  docker-compose down
echo   * Restart:          docker-compose restart
echo   * Backup DB:        docker-compose exec mysql mysqldump -urjms -p[pass] rjdb ^> backup.sql
echo.
pause
