@echo off
REM RJMS Docker Development Setup Script for Windows
REM This script helps you get started quickly

echo.
echo ================================================
echo   RJMS Docker Development Setup
echo   Optimized for Development Workflow
echo ================================================
echo.

REM Check if Docker is running
docker info >nul 2>&1
if errorlevel 1 (
    echo [ERROR] Docker is not running. Please start Docker Desktop first.
    pause
    exit /b 1
)

echo [OK] Docker is running
echo.

REM Check if .env exists
if not exist .env (
    echo Creating .env from .env.docker...
    copy .env.docker .env >nul
    echo [OK] .env created
) else (
    echo [WARN] .env already exists, skipping...
)
echo.

REM Create necessary directories
echo Creating required directories...
if not exist storage\sessions mkdir storage\sessions
if not exist storage\logs mkdir storage\logs
if not exist uploads mkdir uploads
if not exist backups mkdir backups
echo [OK] Directories created
echo.

REM Check if containers are already running
docker-compose ps 2>nul | findstr /i "Up" >nul
if not errorlevel 1 (
    echo [WARN] Containers are already running
    set /p rebuild="Do you want to rebuild? (y/N): "
    if /i "%rebuild%"=="y" (
        echo Stopping containers...
        docker-compose down
        echo Rebuilding containers...
        docker-compose build --no-cache
    )
) else (
    echo Building Docker containers...
    docker-compose build
)
echo.

REM Start containers
echo Starting containers...
docker-compose up -d
echo.

REM Wait for services
echo Waiting for services to be ready...
timeout /t 10 /nobreak >nul
echo.

REM Check service health
echo Checking service health...
docker-compose ps
echo.

REM Install PHP dependencies
echo Installing PHP dependencies...
docker-compose exec -T php composer install --no-interaction
if errorlevel 1 (
    echo [WARN] Could not install PHP dependencies
) else (
    echo [OK] PHP dependencies installed
)
echo.

REM Install Node dependencies
echo Installing Node dependencies...
docker-compose exec -T node npm install
if errorlevel 1 (
    echo [WARN] Could not install Node dependencies
) else (
    echo [OK] Node dependencies installed
)
echo.

REM Set permissions
echo Setting permissions...
docker-compose exec -T php chmod -R 777 storage uploads 2>nul
echo [OK] Permissions set
echo.

REM Summary
echo.
echo ================================================
echo   Setup Complete!
echo ================================================
echo.
echo Access Points:
echo   Application:  http://localhost:8080
echo   PHPMyAdmin:   http://localhost:8081
echo   MySQL:        localhost:3307
echo   Redis:        localhost:6379
echo.
echo Quick Commands:
echo   make help        - Show all available commands
echo   make logs        - View container logs
echo   make shell       - Access PHP container
echo   make status      - Check container status
echo.
echo Documentation:
echo   DOCKER-DEV-GUIDE.md      - Comprehensive guide
echo   DOCKER-CHEATSHEET.md     - Quick reference
echo   DOCKER-OPTIMIZATION-SUMMARY.md - What's new
echo.
echo Next Steps:
echo   1. Visit http://localhost:8080 to verify
echo   2. Configure VS Code for Xdebug
echo   3. Start coding! Changes auto-reload.
echo.
echo Happy coding!
echo.
pause
