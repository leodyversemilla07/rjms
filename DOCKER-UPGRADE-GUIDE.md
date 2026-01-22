# 🔄 Docker Upgrade Guide

If you're upgrading from the previous Docker setup, follow this guide to migrate smoothly.

## 🎯 What's Changed?

### New Services
- **Node.js** - For live CSS compilation
- **Redis** - For optional sessions/caching

### Optimizations
- Multi-stage Dockerfile
- Better volume strategy for Windows
- Enhanced Makefile commands
- Comprehensive documentation

## 📋 Migration Steps

### Step 1: Backup Your Data

```bash
# Backup database (if using old setup)
docker-compose exec -T mysql mysqldump -urjms -prjmspassword rjdb | gzip > backup_$(date +%Y%m%d).sql.gz

# Or use Makefile (if available)
make db-backup
```

### Step 2: Stop and Remove Old Containers

```bash
# Stop everything
docker-compose down

# Optional: Remove volumes (if you want fresh start)
# WARNING: This deletes all data!
# docker-compose down -v
```

### Step 3: Pull Latest Changes

```bash
git pull origin main
# or
git pull
```

### Step 4: Update Environment File

```bash
# Backup your current .env
cp .env .env.backup

# Update from new template
cp .env.docker .env

# Copy your custom settings from .env.backup to .env
# Important settings to preserve:
# - Database credentials (if changed from defaults)
# - Any API keys or custom configs
```

### Step 5: Rebuild Containers

```bash
# Using new setup script (recommended)
# Windows:
setup-docker.bat

# Linux/Mac:
chmod +x setup-docker.sh
./setup-docker.sh

# Or manually:
docker-compose build --no-cache
docker-compose up -d
```

### Step 6: Install Dependencies

```bash
make install

# Or manually:
docker-compose exec php composer install
docker-compose exec node npm install
```

### Step 7: Restore Database (if needed)

```bash
# If you backed up your database
gunzip < backup_YYYYMMDD.sql.gz | docker-compose exec -T mysql mysql -urjms -prjmspassword rjdb

# Or use Makefile
# First extract: gunzip backup_YYYYMMDD.sql.gz
# Then: make db-restore
```

### Step 8: Verify Everything Works

```bash
# Check all services are running
make status

# Check logs
make logs

# Visit the application
# http://localhost:8080
```

## 🔍 Troubleshooting Migration Issues

### "Port already in use"

The new setup uses the same ports. If you have old containers still running:

```bash
# List all containers
docker ps -a

# Remove old containers
docker rm -f rjms-php rjms-nginx rjms-mysql rjms-phpmyadmin

# Remove old network
docker network rm rjms-network 2>/dev/null || true
```

### "Volume mount errors"

Windows users may need to reset Docker volumes:

```bash
# Remove specific volumes
docker volume rm rjms-mysql-data rjms-composer-cache

# Or remove all unused volumes
docker volume prune
```

### "Database connection errors"

Check your `.env` file matches the docker-compose settings:

```env
DB_HOST=mysql  # Must be 'mysql' (service name)
DB_PORT=3306   # Internal port
DB_USER=rjms
DB_PASSWORD=rjmspassword
DB_NAME=rjdb
```

### "CSS not compiling"

The Node service handles this now:

```bash
# Check Node service is running
docker-compose ps node

# Check Node logs
docker-compose logs node

# Restart if needed
docker-compose restart node
```

### "Composer/NPM install fails"

Clear caches and try again:

```bash
make clean-cache
make install
```

## 📝 Configuration Differences

### Old vs New docker-compose.yml

**Old:**
```yaml
services:
  php:
    volumes:
      - ./:/var/www/html  # Simple mount
    # No resource limits in new version
    # No Node.js in PHP container
```

**New:**
```yaml
services:
  php:
    volumes:
      - .:/var/www/html:cached  # Cached for performance
      - /var/www/html/vendor    # Excluded
      - /var/www/html/node_modules  # Excluded
  
  node:  # New dedicated service
    image: node:20-alpine
    command: sh -c "npm install && npm run dev"
  
  redis:  # New optional service
    image: redis:7-alpine
```

### Environment Variables

New variables in `.env.docker`:

```env
# Ports (now configurable)
APP_PORT=8080
PMA_PORT=8081
DB_EXTERNAL_PORT=3307
REDIS_EXTERNAL_PORT=6379

# Redis (new)
SESSION_DRIVER=file  # or 'redis'
REDIS_HOST=redis
REDIS_PORT=6379
CACHE_DRIVER=redis

# Xdebug (enhanced)
XDEBUG_MODE=develop,debug,coverage  # Added coverage
```

## 🆕 New Features to Try

### 1. Live CSS Compilation

Just edit CSS files - they auto-compile!

```bash
# No more manual npm run build!
# The Node service watches for changes

# To check it's working:
docker-compose logs -f node
```

### 2. Redis Sessions (Optional)

For better performance:

```bash
# Edit .env
SESSION_DRIVER=redis

# Restart
make restart
```

### 3. Enhanced Makefile

Try the new commands:

```bash
make help        # See all commands
make redis       # Redis CLI
make db-backup   # Quick backup
make clean-cache # Clear caches
```

### 4. Better Debugging

Xdebug is enhanced with coverage support:

```env
XDEBUG_MODE=develop,debug,coverage
```

## 📚 Updated Documentation

Read the new guides:

1. **DOCKER-DEV-GUIDE.md** - Comprehensive development guide
2. **DOCKER-CHEATSHEET.md** - Quick command reference
3. **DOCKER-OPTIMIZATION-SUMMARY.md** - All improvements explained

## ⚠️ Breaking Changes

### None!

The new setup is **backward compatible**. Your code doesn't need changes.

### Optional Changes (Recommended)

1. **Use `make` commands** instead of `docker-compose` directly
2. **Enable Redis sessions** for better performance
3. **Use setup scripts** for easier onboarding of new team members

## 🎉 Post-Migration

Once migrated successfully:

1. ✅ Delete your `.env.backup` if everything works
2. ✅ Share the new setup with your team
3. ✅ Update your documentation/wiki
4. ✅ Consider enabling Redis for better performance

## 🆘 Still Having Issues?

1. **Clean slate approach:**
   ```bash
   make clean
   make up
   make install
   # Restore database if needed
   ```

2. **Check documentation:**
   - Read DOCKER-DEV-GUIDE.md
   - Check DOCKER-CHEATSHEET.md for commands

3. **Verify Docker:**
   ```bash
   docker --version
   docker-compose --version
   docker info
   ```

4. **Check resources:**
   - Docker Desktop: At least 4GB RAM
   - Disk space: At least 5GB free

## 📞 Need Help?

- Check existing issues on GitHub
- Review troubleshooting in DOCKER-DEV-GUIDE.md
- Ensure Docker Desktop is updated to latest version

---

**Happy coding with the optimized setup! 🚀**
