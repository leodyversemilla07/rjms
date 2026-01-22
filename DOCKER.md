# Docker Deployment Guide for RJMS

## Table of Contents
1. [Overview](#overview)
2. [Prerequisites](#prerequisites)
3. [Quick Start](#quick-start)
4. [Architecture](#architecture)
5. [Configuration](#configuration)
6. [Development Setup](#development-setup)
7. [Production Deployment](#production-deployment)
8. [Common Tasks](#common-tasks)
9. [Troubleshooting](#troubleshooting)
10. [Security Considerations](#security-considerations)

---

## Overview

RJMS uses a multi-container Docker setup with the following services:
- **PHP-FPM 8.3** - Application runtime
- **Nginx** - Web server
- **MySQL 8.0** - Database
- **PHPMyAdmin** - Database management interface

### Benefits of Docker Deployment
✅ Consistent environment across development and production  
✅ Easy setup - no manual PHP/MySQL installation  
✅ Isolated services with proper networking  
✅ Portable and reproducible deployments  
✅ Easy scaling and maintenance  

---

## Prerequisites

### Required Software
- **Docker Desktop** (Windows/Mac) or **Docker Engine** (Linux)
  - Windows: [Download Docker Desktop](https://www.docker.com/products/docker-desktop)
  - Mac: [Download Docker Desktop](https://www.docker.com/products/docker-desktop)
  - Linux: [Install Docker Engine](https://docs.docker.com/engine/install/)
- **Docker Compose** (included with Docker Desktop)

### System Requirements
- **RAM**: Minimum 4GB, Recommended 8GB+
- **Disk Space**: Minimum 5GB free space
- **CPU**: 2+ cores recommended

### Verify Installation
```bash
docker --version
docker-compose --version
```

---

## Quick Start

### Development Mode (Windows)
```cmd
docker-start-dev.bat
```

### Development Mode (Linux/Mac)
```bash
chmod +x docker-start-dev.sh
./docker-start-dev.sh
```

The application will be available at:
- **Main App**: http://localhost:8080
- **PHPMyAdmin**: http://localhost:8081

### Default Credentials
| Role | Username | Password |
|------|----------|----------|
| Admin | admin | admin123 |
| Editor | editor | editor123 |
| Reviewer | reviewer | reviewer123 |
| Author | author | author123 |

⚠️ **Change these passwords immediately after first login!**

---

## Architecture

### Container Structure
```
┌─────────────────────────────────────────┐
│           Docker Network                │
│          (rjms-network)                 │
│                                         │
│  ┌─────────┐    ┌──────────┐          │
│  │  Nginx  │───▶│ PHP-FPM  │          │
│  │  :80    │    │  :9000   │          │
│  └────┬────┘    └────┬─────┘          │
│       │              │                 │
│       │         ┌────▼─────┐          │
│       │         │  MySQL   │          │
│       │         │  :3306   │          │
│       │         └──────────┘          │
│       │                                │
│  ┌────▼────────┐                      │
│  │ PHPMyAdmin  │                      │
│  │   :8081     │                      │
│  └─────────────┘                      │
└─────────────────────────────────────────┘
```

### Volume Mappings
```yaml
uploads/           → Persistent file uploads
logs/              → Application logs
mysql-data/        → Database data (Docker volume)
.env               → Environment configuration
```

### Port Mappings
| Service | Container Port | Host Port |
|---------|---------------|-----------|
| Nginx | 80 | 8080 |
| MySQL | 3306 | 3307 |
| PHPMyAdmin | 80 | 8081 |

---

## Configuration

### Environment Variables

#### Development (.env.docker)
```env
DB_HOST=mysql
DB_PORT=3306
DB_NAME=rjdb
DB_USER=rjms
DB_PASSWORD=rjmspassword
APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost:8080
```

#### Production (.env.docker.prod)
```env
DB_HOST=mysql
DB_PORT=3306
DB_NAME=rjdb
DB_USER=rjms
DB_PASSWORD=CHANGE_THIS_TO_A_SECURE_PASSWORD
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
APP_KEY=CHANGE_THIS_TO_A_RANDOM_32_CHARACTER_STRING
SESSION_SECURE=true
```

### Generate APP_KEY
```bash
# Linux/Mac
openssl rand -base64 32

# Windows (PowerShell)
[Convert]::ToBase64String((1..32 | ForEach-Object { Get-Random -Maximum 256 }))
```

---

## Development Setup

### 1. Clone Repository
```bash
git clone https://github.com/leodyversemilla07/rjms.git
cd rjms
```

### 2. Run Setup Script
**Windows:**
```cmd
docker-start-dev.bat
```

**Linux/Mac:**
```bash
chmod +x docker-start-dev.sh
./docker-start-dev.sh
```

### 3. Access Application
Open http://localhost:8080 in your browser

### Development Features
✅ **Hot Reloading** - Code changes reflect immediately (no rebuild needed)  
✅ **Xdebug** - Debug PHP code from VS Code/PHPStorm  
✅ **Dev Dependencies** - PHPUnit, PHPStan included  
✅ **Error Display** - Full error messages in browser  

### Xdebug Configuration (VS Code)
Add to `.vscode/launch.json`:
```json
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for Xdebug",
            "type": "php",
            "request": "launch",
            "port": 9003,
            "pathMappings": {
                "/var/www/html": "${workspaceFolder}"
            }
        }
    ]
}
```

---

## Production Deployment

### 1. Prepare Environment
```bash
# Copy production environment template
cp .env.docker.prod .env

# Edit .env and set:
# - Secure DB_PASSWORD
# - Secure DB_ROOT_PASSWORD
# - Random APP_KEY (32 characters)
# - Your domain in APP_URL
nano .env
```

### 2. Run Production Setup
**Windows:**
```cmd
docker-start-prod.bat
```

**Linux/Mac:**
```bash
chmod +x docker-start-prod.sh
./docker-start-prod.sh
```

### 3. Post-Deployment Checklist
- [ ] Change all default user passwords
- [ ] Configure SSL/TLS certificates
- [ ] Set up automated backups
- [ ] Configure firewall rules
- [ ] Set up monitoring
- [ ] Review and adjust MySQL configuration
- [ ] Enable log rotation
- [ ] Test file upload functionality

### SSL/HTTPS Setup
1. Obtain SSL certificate (Let's Encrypt recommended)
2. Update `docker/nginx/nginx.conf`:
```nginx
server {
    listen 443 ssl http2;
    ssl_certificate /etc/nginx/ssl/cert.pem;
    ssl_certificate_key /etc/nginx/ssl/key.pem;
    # ... rest of config
}
```
3. Mount certificates in `docker-compose.yml`:
```yaml
nginx:
  volumes:
    - ./ssl:/etc/nginx/ssl:ro
```

---

## Common Tasks

### Start Containers
```bash
# Development
docker-compose -f docker-compose.dev.yml up -d

# Production
docker-compose up -d
```

### Stop Containers
```bash
# Development
docker-compose -f docker-compose.dev.yml down

# Production
docker-compose down
```

### View Logs
```bash
# All services
docker-compose logs -f

# Specific service
docker-compose logs -f php
docker-compose logs -f nginx
docker-compose logs -f mysql
```

### Access Container Shell
```bash
# PHP container
docker-compose exec php sh

# MySQL container
docker-compose exec mysql bash

# Nginx container
docker-compose exec nginx sh
```

### Run Composer Commands
```bash
# Install dependencies
docker-compose exec php composer install

# Update dependencies
docker-compose exec php composer update

# Run tests
docker-compose exec php ./vendor/bin/phpunit

# Run static analysis
docker-compose exec php ./vendor/bin/phpstan analyse
```

### Database Operations

#### Backup Database
```bash
# Create backup
docker-compose exec mysql mysqldump -urjms -prjmspassword rjdb > backup_$(date +%Y%m%d).sql

# With gzip compression
docker-compose exec mysql mysqldump -urjms -prjmspassword rjdb | gzip > backup_$(date +%Y%m%d).sql.gz
```

#### Restore Database
```bash
# From SQL file
docker-compose exec -T mysql mysql -urjms -prjmspassword rjdb < backup.sql

# From compressed file
gunzip < backup.sql.gz | docker-compose exec -T mysql mysql -urjms -prjmspassword rjdb
```

#### Run Migrations
```bash
docker-compose exec php php database/migrate.php migrate
```

#### Reset Database
```bash
docker-compose exec php php database/migrate.php reset
docker-compose exec php php database/migrate.php migrate
```

### Rebuild Containers
```bash
# Rebuild all
docker-compose build --no-cache

# Rebuild specific service
docker-compose build --no-cache php

# Rebuild and restart
docker-compose up -d --build
```

### Clean Up
```bash
# Remove containers and volumes
docker-compose down -v

# Remove all Docker resources (careful!)
docker system prune -a --volumes
```

---

## Troubleshooting

### Issue: Cannot connect to database

**Solution:**
```bash
# Check if MySQL is running
docker-compose ps

# Check MySQL logs
docker-compose logs mysql

# Verify database credentials in .env
cat .env | grep DB_

# Test connection
docker-compose exec mysql mysql -urjms -prjmspassword -e "SHOW DATABASES;"
```

### Issue: Permission denied on uploads/logs

**Solution:**
```bash
# Fix permissions (Linux/Mac)
sudo chown -R $USER:$USER uploads logs
chmod -R 775 uploads logs

# Windows: Run as Administrator
icacls uploads /grant Users:F /T
icacls logs /grant Users:F /T
```

### Issue: Port already in use

**Solution:**
```bash
# Check what's using the port
netstat -ano | findstr :8080

# Change port in docker-compose.yml
ports:
  - "8090:80"  # Change 8080 to 8090
```

### Issue: CSS not loading

**Solution:**
```bash
# Rebuild with fresh assets
docker-compose down
docker-compose build --no-cache
docker-compose up -d

# Or manually build CSS
npm install
npm run build
```

### Issue: Xdebug not working

**Solution:**
1. Verify Xdebug is installed:
```bash
docker-compose exec php php -v
# Should show "with Xdebug"
```

2. Check Xdebug configuration:
```bash
docker-compose exec php php -i | grep xdebug
```

3. Ensure IDE is listening on port 9003

### Issue: MySQL crashes on startup

**Solution:**
```bash
# Check available memory
docker stats

# Reduce MySQL memory in docker/mysql/conf.d/custom.cnf
innodb_buffer_pool_size=256M  # Reduce from 512M

# Restart
docker-compose restart mysql
```

### Issue: "Database not found" error

**Solution:**
```bash
# Recreate database with initialization
docker-compose down -v
cp database/schema.sql docker/mysql/init/
docker-compose up -d

# Or manually create
docker-compose exec mysql mysql -uroot -prootpassword -e "CREATE DATABASE IF NOT EXISTS rjdb;"
docker-compose exec mysql mysql -uroot -prootpassword rjdb < docker/mysql/init/schema.sql
```

---

## Security Considerations

### Production Security Checklist

#### 1. Environment Variables
- [ ] Change `DB_PASSWORD` to strong password (16+ characters)
- [ ] Change `DB_ROOT_PASSWORD` to strong password
- [ ] Generate secure `APP_KEY` (32 random characters)
- [ ] Set `APP_DEBUG=false`
- [ ] Set `SESSION_SECURE=true` (with HTTPS)

#### 2. Default Credentials
- [ ] Change admin password
- [ ] Change editor password
- [ ] Change reviewer password
- [ ] Change author password
- [ ] Remove test accounts if any

#### 3. File Permissions
```bash
# Restrict .env file
chmod 600 .env

# Secure uploads and logs
chmod 750 uploads logs
```

#### 4. Docker Security
- [ ] Don't expose MySQL port (3307) in production
- [ ] Remove PHPMyAdmin in production
- [ ] Use non-root user in containers
- [ ] Enable Docker content trust
- [ ] Keep Docker and images updated

#### 5. Network Security
- [ ] Configure firewall (only allow 80/443)
- [ ] Use HTTPS with valid SSL certificate
- [ ] Enable fail2ban or similar
- [ ] Set up rate limiting in Nginx

#### 6. Backup Strategy
- [ ] Automated daily database backups
- [ ] Backup uploads directory
- [ ] Store backups off-site
- [ ] Test restore procedure

#### 7. Monitoring
- [ ] Set up log aggregation
- [ ] Monitor disk space
- [ ] Monitor container health
- [ ] Set up alerting

### Recommended Security Tools
- **Fail2ban** - Intrusion prevention
- **ModSecurity** - Web application firewall
- **OSSEC** - Host intrusion detection
- **Docker Bench** - Security auditing

---

## Performance Optimization

### MySQL Tuning
Edit `docker/mysql/conf.d/custom.cnf`:
```ini
innodb_buffer_pool_size=1G  # 70% of available RAM
max_connections=200
query_cache_size=64M
```

### PHP Optimization
Edit `Dockerfile`:
```dockerfile
# Enable OPcache (already configured)
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
```

### Nginx Caching
Add to `docker/nginx/nginx.conf`:
```nginx
location ~* \.(jpg|jpeg|png|gif|ico|css|js)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

---

## Maintenance

### Regular Updates
```bash
# Update Docker images
docker-compose pull

# Rebuild containers
docker-compose up -d --build

# Update application dependencies
docker-compose exec php composer update
```

### Log Rotation
Logs are automatically rotated by Monolog (30 days).

### Database Maintenance
```bash
# Optimize tables
docker-compose exec mysql mysqlcheck -urjms -prjmspassword --optimize rjdb

# Check for corruption
docker-compose exec mysql mysqlcheck -urjms -prjmspassword --check rjdb
```

---

## Additional Resources

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Reference](https://docs.docker.com/compose/compose-file/)
- [Nginx Configuration Guide](https://nginx.org/en/docs/)
- [MySQL Optimization](https://dev.mysql.com/doc/refman/8.0/en/optimization.html)
- [PHP-FPM Configuration](https://www.php.net/manual/en/install.fpm.configuration.php)

---

## Support

For issues related to Docker deployment:
1. Check logs: `docker-compose logs -f`
2. Review this documentation
3. Check GitHub Issues
4. Contact system administrator

---

**Last Updated**: November 2025  
**Version**: 1.0.0
