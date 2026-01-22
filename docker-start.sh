#!/bin/bash
# RJMS Docker Startup Script (Development)
# This script initializes the Docker environment for RJMS

set -e

echo "=========================================="
echo "RJMS Docker Setup - Development Mode"
echo "=========================================="
echo ""

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "Error: Docker is not running. Please start Docker and try again."
    exit 1
fi

# Check if .env file exists
if [ ! -f .env ]; then
    echo "Creating .env file from .env.docker..."
    cp .env.docker .env
    echo "✓ .env file created"
    echo ""
    echo "⚠️  IMPORTANT: Please edit .env file and set APP_KEY to a random 32-character string"
    echo "   You can generate one using: openssl rand -base64 32"
    echo ""
else
    echo "✓ .env file already exists"
fi

# Copy schema to Docker init directory
echo "Copying database schema..."
mkdir -p docker/mysql/init
cp database/schema.sql docker/mysql/init/schema.sql
echo "✓ Schema copied to docker/mysql/init/"
echo ""

# Stop and remove existing containers
echo "Stopping existing containers (if any)..."
docker-compose -f docker-compose.dev.yml down -v 2>/dev/null || true
echo "✓ Cleaned up existing containers"
echo ""

# Build and start containers
echo "Building Docker images..."
docker-compose -f docker-compose.dev.yml build --no-cache
echo "✓ Images built successfully"
echo ""

echo "Starting containers..."
docker-compose -f docker-compose.dev.yml up -d
echo "✓ Containers started"
echo ""

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
sleep 10

# Check if database is initialized
echo "Checking database status..."
docker-compose -f docker-compose.dev.yml exec -T mysql mysql -uroot -prootpassword -e "USE rjdb; SHOW TABLES;" > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✓ Database initialized successfully"
else
    echo "⚠️  Database initialization may have failed. Check logs with: docker-compose -f docker-compose.dev.yml logs mysql"
fi
echo ""

# Create necessary directories if they don't exist
mkdir -p uploads/submissions
mkdir -p logs
chmod -R 775 uploads logs

echo "=========================================="
echo "RJMS Docker Setup Complete!"
echo "=========================================="
echo ""
echo "Application is now running at:"
echo "  • Main App:    http://localhost:8080"
echo "  • PHPMyAdmin:  http://localhost:8081"
echo ""
echo "Default Login Credentials:"
echo "  • Admin:    admin / admin123"
echo "  • Editor:   editor / editor123"
echo "  • Reviewer: reviewer / reviewer123"
echo "  • Author:   author / author123"
echo ""
echo "⚠️  SECURITY WARNING: Change default passwords immediately!"
echo ""
echo "Useful Commands:"
echo "  • View logs:        docker-compose -f docker-compose.dev.yml logs -f"
echo "  • Stop containers:  docker-compose -f docker-compose.dev.yml down"
echo "  • Restart:          docker-compose -f docker-compose.dev.yml restart"
echo "  • Shell access:     docker-compose -f docker-compose.dev.yml exec php sh"
echo ""
