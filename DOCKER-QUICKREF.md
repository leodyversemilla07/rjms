# Docker Quick Reference - RJMS

## 🚀 Quick Start Commands

### Start Docker Environment
```bash
# Windows
docker-start.bat

# Linux/Mac
./docker-start.sh
```

## 📍 Access Points

| Service | URL | Credentials |
|---------|-----|-------------|
| **Main App** | http://localhost:8080 | See below |
| **PHPMyAdmin** | http://localhost:8081 | DB credentials |

### Default User Accounts
| Role | Username | Password |
|------|----------|----------|
| Admin | `admin` | `admin123` |
| Editor | `editor` | `editor123` |
| Reviewer | `reviewer` | `reviewer123` |
| Author | `author` | `author123` |

⚠️ **Change passwords after first login!**

## 🎯 Essential Commands

### Container Management
```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# Restart containers
docker-compose restart

# View container status
docker-compose ps

# Remove containers and volumes
docker-compose down -v
```

### View Logs
```bash
# All services
docker-compose logs -f

# Specific service
docker-compose logs -f php
docker-compose logs -f nginx
docker-compose logs -f mysql

# Last 100 lines
docker-compose logs --tail=100 php
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

### Database Operations
```bash
# Backup database
docker-compose exec mysql mysqldump -urjms -prjmspassword rjdb > backup.sql

# Restore database
docker-compose exec -T mysql mysql -urjms -prjmspassword rjdb < backup.sql

# Access MySQL CLI
docker-compose exec mysql mysql -urjms -prjmspassword rjdb

# Run migrations
docker-compose exec php php database/migrate.php migrate
```

### PHP Commands
```bash
# Install Composer dependencies
docker-compose exec php composer install

# Update dependencies
docker-compose exec php composer update

# Run tests
docker-compose exec php ./vendor/bin/phpunit

# Run static analysis
docker-compose exec php ./vendor/bin/phpstan analyse
```

### Rebuild & Update
```bash
# Rebuild all containers
docker-compose build --no-cache

# Rebuild and restart
docker-compose up -d --build

# Pull latest images
docker-compose pull

# Update and restart
docker-compose pull && docker-compose up -d --build
```

## 🔧 Troubleshooting

### Container won't start
```bash
# Check logs
docker-compose logs [service-name]

# Check if ports are in use
netstat -ano | findstr :8080
netstat -ano | findstr :3307

# Remove and recreate
docker-compose down -v
docker-compose up -d
```

### Permission issues
```bash
# Linux/Mac
sudo chown -R $USER:$USER uploads logs
chmod -R 775 uploads logs

# Windows (as Administrator)
icacls uploads /grant Users:F /T
icacls logs /grant Users:F /T
```

### Database connection failed
```bash
# Check MySQL status
docker-compose ps mysql

# Check database logs
docker-compose logs mysql

# Verify credentials in .env
cat .env | grep DB_

# Test connection
docker-compose exec mysql mysql -urjms -prjmspassword -e "SHOW DATABASES;"
```

### Reset everything
```bash
# Nuclear option - removes all data!
docker-compose down -v
docker system prune -a --volumes
rm -rf docker/mysql/init/schema.sql

# Then start fresh
./docker-start-dev.sh
```

## 🔐 Security Checklist

### Development Best Practices
- [ ] Copy `.env.docker` to `.env` for Docker
- [ ] Set strong `DB_PASSWORD`
- [ ] Set strong `DB_ROOT_PASSWORD`
- [ ] Change all default user passwords
- [ ] Don't commit `.env` to version control

## 📊 Monitoring

### Container Stats
```bash
# Real-time stats
docker stats

# Disk usage
docker system df

# Container resource usage
docker-compose top
```

### Health Checks
```bash
# Check all container health
docker-compose ps

# Specific service health
docker inspect --format='{{.State.Health.Status}}' rjms-php
docker inspect --format='{{.State.Health.Status}}' rjms-mysql
```

## 🎨 Development Tips

### Live Code Reloading
Code changes in `src/`, `resources/`, and `routes/` are automatically reflected - no rebuild needed!

### Xdebug
Already configured for debugging! Just add VS Code configuration:

```json
{
    "name": "Listen for Xdebug",
    "type": "php",
    "request": "launch",
    "port": 9003,
    "pathMappings": {
        "/var/www/html": "${workspaceFolder}"
    }
}
```

### Build CSS Assets
```bash
# Inside container
docker-compose exec php sh
npm install
npm run build
```

## 📦 Backup Strategy

### Quick Backup
```bash
# Database
docker-compose exec mysql mysqldump -urjms -prjmspassword rjdb | gzip > backup_$(date +%Y%m%d).sql.gz

# Uploads
tar -czf uploads_backup_$(date +%Y%m%d).tar.gz uploads/

# Environment
cp .env env_backup_$(date +%Y%m%d).txt
```

### Automated Backup Script
Create `backup.sh`:
```bash
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="backups/$DATE"
mkdir -p $BACKUP_DIR

# Database
docker-compose exec -T mysql mysqldump -urjms -prjmspassword rjdb | gzip > $BACKUP_DIR/database.sql.gz

# Uploads
tar -czf $BACKUP_DIR/uploads.tar.gz uploads/

# Config
cp .env $BACKUP_DIR/

echo "Backup completed: $BACKUP_DIR"
```

## 📖 Documentation Links

- **Full Docker Guide**: [DOCKER.md](DOCKER.md)
- **Main README**: [README.md](README.md)
- **Conversion Guide**: [CONVERSION_GUIDE.md](CONVERSION_GUIDE.md)

## 🆘 Getting Help

1. Check logs: `docker-compose logs -f`
2. Read [DOCKER.md](DOCKER.md) troubleshooting section
3. Search GitHub Issues
4. Check Docker/container status: `docker-compose ps`
5. Verify configuration: `cat .env`

---

**Last Updated**: November 2025  
**Version**: 1.0.0
