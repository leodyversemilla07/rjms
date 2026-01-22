@echo off
REM RJMS Docker Startup Script (Development) - Windows
REM This script initializes the Docker environment for RJMS

echo ==========================================
echo RJMS Docker Setup - Development Mode
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
    echo Creating .env file from .env.docker...
    copy /Y .env.docker .env >nul
    echo [OK] .env file created
    echo.
    echo WARNING: Please edit .env file and set APP_KEY to a random 32-character string
    echo.
) else (
    echo [OK] .env file already exists
)

REM Copy schema to Docker init directory
echo Copying database schema...
if not exist docker\mysql\init mkdir docker\mysql\init
copy /Y database\schema.sql docker\mysql\init\schema.sql >nul
echo [OK] Schema copied to docker\mysql\init\
echo.

REM Stop and remove existing containers
echo Stopping existing containers (if any)...
docker-compose -f docker-compose.dev.yml down -v >nul 2>&1
echo [OK] Cleaned up existing containers
echo.

REM Build and start containers
echo Building Docker images...
docker-compose -f docker-compose.dev.yml build --no-cache
echo [OK] Images built successfully
echo.

echo Starting containers...
docker-compose -f docker-compose.dev.yml up -d
echo [OK] Containers started
echo.

REM Wait for MySQL to be ready
echo Waiting for MySQL to be ready...
timeout /t 10 /nobreak >nul

REM Check database status
echo Checking database status...
docker-compose -f docker-compose.dev.yml exec -T mysql mysql -uroot -prootpassword -e "USE rjdb; SHOW TABLES;" >nul 2>&1
if %errorlevel% equ 0 (
    echo [OK] Database initialized successfully
) else (
    echo [WARNING] Database initialization may have failed. Check logs with: docker-compose -f docker-compose.dev.yml logs mysql
)
echo.

REM Create necessary directories
if not exist uploads\submissions mkdir uploads\submissions
if not exist logs mkdir logs

echo ==========================================
echo RJMS Docker Setup Complete!
echo ==========================================
echo.
echo Application is now running at:
echo   * Main App:    http://localhost:8080
echo   * PHPMyAdmin:  http://localhost:8081
echo.
echo Default Login Credentials:
echo   * Admin:    admin / admin123
echo   * Editor:   editor / editor123
echo   * Reviewer: reviewer / reviewer123
echo   * Author:   author / author123
echo.
echo SECURITY WARNING: Change default passwords immediately!
echo.
echo Useful Commands:
echo   * View logs:        docker-compose -f docker-compose.dev.yml logs -f
echo   * Stop containers:  docker-compose -f docker-compose.dev.yml down
echo   * Restart:          docker-compose -f docker-compose.dev.yml restart
echo   * Shell access:     docker-compose -f docker-compose.dev.yml exec php sh
echo.
pause
