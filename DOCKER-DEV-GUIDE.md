# 🚀 Docker Development Guide

This guide covers the optimized Docker development setup for RJMS.

## 📋 Quick Start

```bash
# 1. Copy environment file
cp .env.docker .env

# 2. Start all services
make up

# 3. Install dependencies
make install

# 4. Access the application
# App: http://localhost:8080
# PHPMyAdmin: http://localhost:8081
```

## 🎯 What's Included

### Services Running:
- **PHP 8.3-FPM** (with Xdebug)
- **Nginx** web server
- **MySQL 8.0** database
- **Redis 7** for caching/sessions
- **PHPMyAdmin** database management
- **Node.js 20** for live CSS compilation (Tailwind)

## 🔧 Development Features

### 1. **Hot Reloading**
- PHP files: Changes reflected immediately (volume mounted)
- CSS: Automatically rebuilds with `npm run dev` (Node service)
- No container restart needed!

### 2. **Optimized for Windows**
- Uses `:cached` flag for better volume performance
- Excludes `vendor/` and `node_modules/` from sync (separate volumes)
- Faster rebuilds with multi-stage Dockerfile

### 3. **Xdebug Support**
- Pre-configured for VS Code
- Step debugging enabled
- Coverage analysis ready
- Set breakpoints in your IDE!

### 4. **Redis Integration**
- Fast session storage (optional)
- Caching layer for performance
- Easy to enable/disable

## 📝 Common Commands

### Essential Operations
```bash
make help        # Show all available commands
make up          # Start environment
make down        # Stop environment
make restart     # Restart all services
make logs        # Follow logs
make status      # Show container status
```

### Container Access
```bash
make shell       # Access PHP container (run composer, PHP scripts)
make mysql       # Access MySQL CLI
make redis       # Access Redis CLI
```

### Development Tasks
```bash
make install     # Install PHP + Node dependencies
make test        # Run PHPUnit tests
make analyse     # Run PHPStan static analysis
make composer CMD='require vendor/package'  # Run composer commands
```

### Database Management
```bash
make db-backup   # Backup database to backups/
make db-restore  # Restore from backup.sql
make db-reset    # Fresh database (WARNING: deletes data!)
```

### Maintenance
```bash
make rebuild     # Rebuild containers (when Dockerfile changes)
make clean       # Remove containers and volumes
make clean-cache # Clear composer/npm/redis caches
```

## 🐛 Debugging with Xdebug

### VS Code Configuration

Create `.vscode/launch.json`:

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
      },
      "log": true,
      "xdebugSettings": {
        "max_data": 65535,
        "show_hidden": 1,
        "max_children": 100,
        "max_depth": 5
      }
    }
  ]
}
```

### How to Debug:
1. Set breakpoints in your PHP code
2. Start debugging in VS Code (F5)
3. Visit the page in browser
4. Debugger will pause at breakpoints

## 🎨 CSS Development (Tailwind)

The Node service automatically watches for CSS changes:

```bash
# CSS is compiled automatically when you edit files in resources/css/
# Output: public/css/tailwind.css

# To manually rebuild:
docker-compose exec node npm run build
```

## 💾 Using Redis for Sessions

To enable Redis sessions:

1. Edit `.env`:
```env
SESSION_DRIVER=redis
```

2. Update your session handling code to support Redis
3. Restart PHP container: `make restart`

Benefits:
- Faster session access
- Shared sessions across multiple PHP containers
- Better for scaling

## 📊 Performance Tips

### 1. Keep Vendor/Node_Modules External
Don't mount these directories directly. Let Docker use anonymous volumes for better performance.

### 2. Use Build Cache
```bash
# Rebuild with cache (faster)
docker-compose build

# Full rebuild (slower, when needed)
make rebuild
```

### 3. Resource Allocation
Check Docker Desktop settings:
- Memory: At least 4GB recommended
- CPUs: 2+ cores for best performance

### 4. Monitor Resource Usage
```bash
make stats  # View real-time resource usage
```

## 🔒 Security Notes (Dev Environment)

This setup is **optimized for development**, not production:
- Debug mode enabled
- Xdebug overhead
- Relaxed MySQL settings
- No HTTPS
- Default passwords

**Never use this configuration in production!**

## 🐘 Working with Composer

```bash
# Install package
make composer CMD='require vendor/package'

# Update dependencies
make composer CMD='update'

# Dump autoload
make composer CMD='dump-autoload'

# Run any composer command
make composer CMD='your-command-here'
```

## 📦 Volumes Explained

```yaml
Named Volumes (persist data):
- mysql-data         # Database files
- redis-data         # Redis persistence
- composer-cache     # Composer cache (speeds up installs)
- npm-cache          # NPM cache (speeds up installs)

Anonymous Volumes (performance):
- /var/www/html/vendor      # PHP dependencies
- /var/www/html/node_modules # Node dependencies

Bind Mounts (your code):
- ./:/var/www/html:cached   # Your application code
```

## 🔧 Troubleshooting

### Port Already in Use
```bash
# Change ports in .env:
APP_PORT=8090
PMA_PORT=8091
DB_EXTERNAL_PORT=3308
```

### Slow Performance on Windows
- Enable WSL 2 backend in Docker Desktop
- Move project to WSL filesystem for best performance
- Increase Docker resources (CPU/Memory)

### Permission Issues
```bash
# Fix storage permissions
make shell
chmod -R 777 storage uploads
```

### Can't Connect to MySQL
```bash
# Check MySQL is healthy
make status

# View MySQL logs
docker-compose logs mysql

# Restart MySQL
docker-compose restart mysql
```

### Xdebug Not Working
1. Check Xdebug is loaded: `make shell` then `php -m | grep xdebug`
2. Verify port 9003 is not blocked
3. Check VS Code has PHP Debug extension installed
4. Review Xdebug log: `docker-compose exec php cat /var/log/xdebug.log`

### Clean Start
```bash
# Nuclear option - start fresh
make clean
make up
make install
```

## 📚 Additional Resources

- [Docker Documentation](https://docs.docker.com/)
- [Xdebug Documentation](https://xdebug.org/docs/)
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [Composer Documentation](https://getcomposer.org/doc/)

## 💡 Pro Tips

1. **Keep containers running**: Start once, code all day. No restarts needed for code changes.
2. **Use Makefile**: Faster than remembering docker-compose commands.
3. **Monitor logs**: `make logs` in a separate terminal to see errors in real-time.
4. **Backup regularly**: `make db-backup` before major database changes.
5. **Clean caches**: If things act weird, `make clean-cache` often helps.

## 🆘 Getting Help

Check logs first:
```bash
make logs              # All services
docker-compose logs php      # Just PHP
docker-compose logs mysql    # Just MySQL
```

Still stuck? Check:
- Container status: `make status`
- Resource usage: `make stats`
- Docker Desktop dashboard

---

**Happy Coding! 🎉**
