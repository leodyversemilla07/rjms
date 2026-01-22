# 🎯 Docker Quick Reference

## 🚀 Essential Commands

```bash
# Start/Stop
make up          # Start all services
make down        # Stop all services  
make restart     # Restart services
make rebuild     # Rebuild from scratch

# Development
make shell       # PHP container shell
make mysql       # MySQL CLI
make redis       # Redis CLI
make logs        # Follow all logs

# Install/Update
make install     # Install all dependencies
make composer CMD='require pkg'  # Add package

# Database
make db-backup   # Backup to backups/
make db-restore  # Restore from backup.sql
make db-reset    # Fresh database (⚠️ deletes data)

# Testing
make test        # PHPUnit tests
make analyse     # PHPStan analysis

# Maintenance
make status      # Container status
make stats       # Resource usage
make clean-cache # Clear caches
make clean       # Remove everything (⚠️)
```

## 🌐 Access Points

- **App**: http://localhost:8080
- **PHPMyAdmin**: http://localhost:8081
- **MySQL**: localhost:3307 (user: rjms, pass: rjmspassword)
- **Redis**: localhost:6379

## 🐛 VS Code Xdebug

`.vscode/launch.json`:
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

## 📁 Project Structure

```
rjms/
├── docker/
│   ├── php/php.ini           # PHP config
│   ├── mysql/conf.d/         # MySQL config
│   └── nginx/nginx.conf      # Nginx config
├── docker-compose.yml        # Main compose file
├── docker-compose.override.yml.example
├── Dockerfile                # PHP container
├── .env.docker               # Docker env template
├── Makefile                  # Dev commands
├── DOCKER-DEV-GUIDE.md       # Full guide
└── DOCKER-OPTIMIZATION-SUMMARY.md
```

## ⚡ Performance Tips

1. **Keep containers running** - code changes auto-reload
2. **Use cached volumes** - already configured
3. **Exclude vendor/node_modules** - already configured  
4. **Enable Redis sessions** - edit `.env`: `SESSION_DRIVER=redis`

## 🔧 Troubleshooting

| Problem | Solution |
|---------|----------|
| Port in use | Change `APP_PORT` in `.env` |
| Slow on Windows | Enable WSL 2 backend |
| Can't connect | Check `make status` |
| Permission error | `make shell` then `chmod -R 777 storage uploads` |
| Xdebug not working | Verify port 9003 open, check VS Code extension |
| Clean slate | `make clean && make up && make install` |

## 📝 Configuration Files

### `.env` (Copy from `.env.docker`)
```env
APP_PORT=8080
DB_HOST=mysql
DB_USER=rjms
DB_PASSWORD=rjmspassword
SESSION_DRIVER=file  # or 'redis' for better perf
XDEBUG_MODE=develop,debug,coverage
```

### `docker-compose.override.yml` (Optional)
For local customizations - see `.example` file

## 🎨 CSS Development

CSS auto-compiles when you save files in `resources/css/`:
- Watcher: Node service (always running)
- Output: `public/css/tailwind.css`
- Manual build: `docker-compose exec node npm run build`

## 💾 Data Persistence

| Volume | Purpose | Persists? |
|--------|---------|-----------|
| mysql-data | Database | ✅ Yes |
| redis-data | Redis | ✅ Yes |
| composer-cache | Composer | ✅ Yes |
| npm-cache | NPM | ✅ Yes |
| vendor/ | PHP packages | ✅ Yes (anonymous) |
| node_modules/ | Node packages | ✅ Yes (anonymous) |

## 🔐 Default Credentials

**MySQL**:
- Root: root / rootpassword
- User: rjms / rjmspassword
- Database: rjdb

**PHPMyAdmin**:
- Use MySQL credentials above

**Redis**:
- No password (localhost only)

⚠️ **Never use these in production!**

## 🚑 Emergency Commands

```bash
# Nuclear option - start completely fresh
make clean
make up
make install

# Just clear caches
make clean-cache

# Rebuild single service
docker-compose build php --no-cache
docker-compose up -d php

# View service logs
docker-compose logs -f php
docker-compose logs -f mysql
docker-compose logs -f node
```

## 📚 Documentation

- **Full Guide**: `DOCKER-DEV-GUIDE.md`
- **What Changed**: `DOCKER-OPTIMIZATION-SUMMARY.md`
- **Docker Basics**: `DOCKER.md`
- **Quick Start**: `DOCKER-QUICKREF.md`

---

**Keep this handy! 📌**
