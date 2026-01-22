#!/bin/bash
# RJMS Docker Development Setup Script
# This script helps you get started quickly

set -e

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${GREEN}"
echo "╔═══════════════════════════════════════════╗"
echo "║  RJMS Docker Development Setup            ║"
echo "║  Optimized for Development Workflow       ║"
echo "╚═══════════════════════════════════════════╝"
echo -e "${NC}"

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo -e "${RED}❌ Docker is not running. Please start Docker Desktop first.${NC}"
    exit 1
fi

echo -e "${GREEN}✓ Docker is running${NC}"

# Check if .env exists
if [ ! -f .env ]; then
    echo -e "${YELLOW}Creating .env from .env.docker...${NC}"
    cp .env.docker .env
    echo -e "${GREEN}✓ .env created${NC}"
else
    echo -e "${YELLOW}⚠️  .env already exists, skipping...${NC}"
fi

# Create necessary directories
echo -e "${YELLOW}Creating required directories...${NC}"
mkdir -p storage/sessions storage/logs uploads backups
echo -e "${GREEN}✓ Directories created${NC}"

# Check if containers are already running
if docker-compose ps | grep -q "Up"; then
    echo -e "${YELLOW}⚠️  Containers are already running${NC}"
    read -p "Do you want to rebuild? (y/N): " rebuild
    if [ "$rebuild" = "y" ] || [ "$rebuild" = "Y" ]; then
        echo -e "${YELLOW}Stopping containers...${NC}"
        docker-compose down
        echo -e "${YELLOW}Rebuilding containers...${NC}"
        docker-compose build --no-cache
    fi
else
    echo -e "${YELLOW}Building Docker containers...${NC}"
    docker-compose build
fi

# Start containers
echo -e "${YELLOW}Starting containers...${NC}"
docker-compose up -d

# Wait for services to be healthy
echo -e "${YELLOW}Waiting for services to be ready...${NC}"
sleep 10

# Check service health
echo -e "${YELLOW}Checking service health...${NC}"
docker-compose ps

# Install PHP dependencies
echo -e "${YELLOW}Installing PHP dependencies...${NC}"
if docker-compose exec -T php test -f composer.json; then
    docker-compose exec -T php composer install --no-interaction
    echo -e "${GREEN}✓ PHP dependencies installed${NC}"
else
    echo -e "${RED}⚠️  composer.json not found${NC}"
fi

# Install Node dependencies
echo -e "${YELLOW}Installing Node dependencies...${NC}"
if docker-compose exec -T node test -f package.json; then
    docker-compose exec -T node npm install
    echo -e "${GREEN}✓ Node dependencies installed${NC}"
else
    echo -e "${RED}⚠️  package.json not found${NC}"
fi

# Set permissions
echo -e "${YELLOW}Setting permissions...${NC}"
docker-compose exec -T php chmod -R 777 storage uploads 2>/dev/null || true
echo -e "${GREEN}✓ Permissions set${NC}"

# Summary
echo ""
echo -e "${GREEN}╔═══════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║  🎉 Setup Complete!                       ║${NC}"
echo -e "${GREEN}╚═══════════════════════════════════════════╝${NC}"
echo ""
echo -e "${GREEN}Access Points:${NC}"
echo -e "  🌐 Application:  ${YELLOW}http://localhost:8080${NC}"
echo -e "  🗄️  PHPMyAdmin:   ${YELLOW}http://localhost:8081${NC}"
echo -e "  💾 MySQL:        ${YELLOW}localhost:3307${NC}"
echo -e "  🔴 Redis:        ${YELLOW}localhost:6379${NC}"
echo ""
echo -e "${GREEN}Quick Commands:${NC}"
echo -e "  make help        - Show all available commands"
echo -e "  make logs        - View container logs"
echo -e "  make shell       - Access PHP container"
echo -e "  make status      - Check container status"
echo ""
echo -e "${GREEN}Documentation:${NC}"
echo -e "  📖 DOCKER-DEV-GUIDE.md      - Comprehensive guide"
echo -e "  🎯 DOCKER-CHEATSHEET.md     - Quick reference"
echo -e "  📊 DOCKER-OPTIMIZATION-SUMMARY.md - What's new"
echo ""
echo -e "${YELLOW}Next Steps:${NC}"
echo -e "  1. Visit http://localhost:8080 to verify it's working"
echo -e "  2. Configure VS Code for Xdebug (see DOCKER-DEV-GUIDE.md)"
echo -e "  3. Start coding! Changes auto-reload."
echo ""
echo -e "${GREEN}Happy coding! 🚀${NC}"
