# Makefile for RJMS Docker Management
# Usage: make [target]

.PHONY: help start stop restart logs shell build clean backup test

# Default target
help:
	@echo "RJMS Docker Management Commands"
	@echo "================================"
	@echo ""
	@echo "Environment:"
	@echo "  make start       - Start development environment"
	@echo "  make stop        - Stop development environment"
	@echo "  make restart     - Restart all containers"
	@echo "  make logs        - View all logs"
	@echo ""
	@echo "Container Access:"
	@echo "  make shell       - Access PHP container shell"
	@echo "  make mysql       - Access MySQL shell"
	@echo ""
	@echo "Build & Clean:"
	@echo "  make build       - Rebuild all images"
	@echo "  make clean       - Remove all containers and volumes"
	@echo ""
	@echo "Database:"
	@echo "  make backup      - Backup database"
	@echo "  make restore     - Restore database from backup.sql"
	@echo "  make migrate     - Run database migrations"
	@echo ""
	@echo "Development Tools:"
	@echo "  make test        - Run PHPUnit tests"
	@echo "  make analyse     - Run PHPStan analysis"
	@echo "  make composer    - Run composer commands (CMD=install)"
	@echo "  make install     - Install PHP dependencies"
	@echo "  make css         - Build CSS assets"
	@echo "  make status      - Check container status"
	@echo ""

# Start development environment
start:
	@echo "Starting development environment..."
	@cp -n .env.docker .env 2>/dev/null || true
	@mkdir -p docker/mysql/init
	@cp database/schema.sql docker/mysql/init/schema.sql
	@docker-compose up -d
	@echo "✓ Development environment started!"
	@echo ""
	@echo "Access points:"
	@echo "  Main App:    http://localhost:8080"
	@echo "  PHPMyAdmin:  http://localhost:8081"
# Stop and cleanup
stop:
	@docker-compose down

restart:
	@docker-compose restart

logs:
	@docker-compose logs -f

shell:
	@docker-compose exec php sh

mysql:
	@docker-compose exec mysql mysql -urjms -prjmspassword rjdb

build:
	@echo "Rebuilding all images..."
	@docker-compose build --no-cache
	@echo "✓ Build complete!"

clean:
	@echo "⚠️  This will remove all containers, volumes, and data!"
	@read -p "Are you sure? (y/N): " confirm && [ "$$confirm" = "y" ]
	@docker-compose down -v
	@echo "✓ Cleaned up!"

# Database operations
backup:
	@mkdir -p backups
	@docker-compose exec -T mysql mysqldump -urjms -prjmspassword rjdb | gzip > backups/backup_$$(date +%Y%m%d_%H%M%S).sql.gz
	@echo "✓ Database backed up to backups/"

restore:
	@if [ ! -f backup.sql ]; then \
		echo "Error: backup.sql not found"; \
		exit 1; \
	fi
	@docker-compose exec -T mysql mysql -urjms -prjmspassword rjdb < backup.sql
	@echo "✓ Database restored from backup.sql"

migrate:
	@docker-compose exec php php database/migrate.php migrate
	@echo "✓ Migrations completed!"

# Development tools
test:
	@docker-compose exec php ./vendor/bin/phpunit

analyse:
	@docker-compose exec php ./vendor/bin/phpstan analyse

composer:
	@docker-compose exec php composer $(CMD)

# Install dependencies
install:
	@docker-compose exec php composer install
	@echo "✓ Dependencies installed!"

update:
	@docker-compose exec php composer update
	@echo "✓ Dependencies updated!"

# CSS build
css:
	@docker-compose exec php npm run build
	@echo "✓ CSS compiled!"

# Status check
status:
	@docker-compose ps

# View resource usage
stats:
	@docker stats --no-stream
