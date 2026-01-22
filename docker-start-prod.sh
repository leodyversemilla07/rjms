#!/bin/bash
# RJMS Docker Startup Script (Production)
# This script initializes the Docker environment for RJMS in production mode

set -e

echo "=========================================="
echo "RJMS Docker Setup - Production Mode"
echo "=========================================="
echo ""

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "Error: Docker is not running. Please start Docker and try again."
    exit 1
fi

# Check if .env file exists
if [ ! -f .env ]; then
    echo "Error: .env file not found!"
    echo "Please create .env file from .env.docker.prod and configure it properly."
    echo ""
    echo "Steps:"
    echo "  1. cp .env.docker.prod .env"
    echo "  2. Edit .env and set secure passwords and APP_KEY"
    echo "  3. Run this script again"
    exit 1
fi

# Validate critical environment variables
if grep -q "CHANGE_THIS" .env; then
    echo "Error: Please update all placeholder values in .env file!"
    echo "Look for 'CHANGE_THIS' and replace with secure values."
    exit 1
fi

# Copy schema to Docker init directory
echo "Copying database schema..."
mkdir -p docker/mysql/init
cp database/schema.sql docker/mysql/init/schema.sql
echo "✓ Schema copied to docker/mysql/init/"
echo ""

# Build and start containers
echo "Building Docker images for production..."
docker-compose build --no-cache
echo "✓ Images built successfully"
echo ""

echo "Starting containers..."
docker-compose up -d
echo "✓ Containers started"
echo ""

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
sleep 15

# Check if database is initialized
echo "Checking database status..."
docker-compose exec -T mysql mysql -u${DB_USER:-rjms} -p${DB_PASSWORD} -e "USE rjdb; SHOW TABLES;" > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✓ Database initialized successfully"
else
    echo "⚠️  Database initialization may have failed. Check logs with: docker-compose logs mysql"
fi
echo ""

# Create necessary directories if they don't exist
mkdir -p uploads/submissions
mkdir -p logs
chmod -R 775 uploads logs

echo "=========================================="
echo "RJMS Production Deployment Complete!"
echo "=========================================="
echo ""
echo "Application is now running at:"
echo "  • Main App:    http://localhost:8080"
echo "  • PHPMyAdmin:  http://localhost:8081"
echo ""
echo "⚠️  IMPORTANT SECURITY STEPS:"
echo "  1. Change all default user passwords immediately"
echo "  2. Configure SSL/TLS certificates for HTTPS"
echo "  3. Set up firewall rules"
echo "  4. Configure backup strategy"
echo "  5. Set up monitoring and logging"
echo ""
echo "Useful Commands:"
echo "  • View logs:        docker-compose logs -f"
echo "  • Stop containers:  docker-compose down"
echo "  • Restart:          docker-compose restart"
echo "  • Backup DB:        docker-compose exec mysql mysqldump -u[user] -p[pass] rjdb > backup.sql"
echo ""
