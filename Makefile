# Makefile for RJMS Docker Development
# Optimized for development workflow

.PHONY: help up down restart logs shell build clean install test status

# Colors for output
GREEN  := \033[0;32m
YELLOW := \033[1;33m
RED    := \033[0;31m
NC     := \033[0m # No Color

# Default target
help:
	@echo "$(GREEN)RJMS Docker Development Commands$(NC)"
	@echo "===================================="
	@echo ""
	@echo "$(YELLOW)Quick Start:$(NC)"
	@echo "  make up          - Start all services"
	@echo "  make down        - Stop all services"
	@echo "  make install     - Install all dependencies (composer + npm)"
	@echo "  make logs        - Follow all container logs"
	@echo ""
	@echo "$(YELLOW)Development:$(NC)"
	@echo "  make shell       - Access PHP container shell"
	@echo "  make mysql       - Access MySQL shell"
	@echo "  make redis       - Access Redis CLI"
	@echo "  make restart     - Restart all services"
	@echo "  make rebuild     - Rebuild containers from scratch"
	@echo ""
	@echo "$(YELLOW)Database:$(NC)"
	@echo "  make db-backup   - Backup database to backups/"
	@echo "  make db-restore  - Restore from backup.sql"
	@echo "  make db-reset    - Reset database (fresh start)"
	@echo ""
	@echo "$(YELLOW)Testing & QA:$(NC)"
	@echo "  make test        - Run PHPUnit tests"
	@echo "  make analyse     - Run PHPStan static analysis"
	@echo "  make composer CMD='...' - Run composer command"
	@echo ""
	@echo "$(YELLOW)Maintenance:$(NC)"
	@echo "  make status      - Show container status"
	@echo "  make stats       - Show resource usage"
	@echo "  make clean       - Remove containers and volumes"
	@echo "  make clean-cache - Clear all caches"
	@echo ""
	@echo "$(GREEN)Services:$(NC)"
	@echo "  App:        http://localhost:8080"
	@echo "  PHPMyAdmin: http://localhost:8081"
	@echo "  MySQL:      localhost:3307"
	@echo "  Redis:      localhost:6379"
	@echo ""

# Start environment
up:
	@echo "$(GREEN)Starting development environment...$(NC)"
	docker-compose up -d
	@echo "$(GREEN)✓ Environment is running!$(NC)"
	@echo ""
	@echo "Access your app at: http://localhost:8080"

# Stop environment
down:
	@echo "$(YELLOW)Stopping development environment...$(NC)"
	docker-compose down
	@echo "$(GREEN)✓ Environment stopped$(NC)"

# Restart all services
restart:
	@echo "$(YELLOW)Restarting services...$(NC)"
	docker-compose restart
	@echo "$(GREEN)✓ Services restarted$(NC)"

# Rebuild containers
rebuild:
	@echo "$(YELLOW)Rebuilding containers...$(NC)"
	docker-compose down
	docker-compose build --no-cache
	docker-compose up -d
	@echo "$(GREEN)✓ Rebuild complete!$(NC)"

# View logs
logs:
	docker-compose logs -f

# Access PHP container
shell:
	docker-compose exec php sh

# Access MySQL
mysql:
	docker-compose exec mysql mysql -u$${DB_USER:-rjms} -p$${DB_PASSWORD:-rjmspassword} $${DB_NAME:-rjdb}

# Access Redis
redis:
	docker-compose exec redis redis-cli

# Install all dependencies
install:
	@echo "$(GREEN)Installing PHP dependencies...$(NC)"
	docker-compose exec php composer install
	@echo "$(GREEN)Installing Node dependencies...$(NC)"
	docker-compose exec node npm install
	@echo "$(GREEN)✓ All dependencies installed!$(NC)"

# Database backup
db-backup:
	@mkdir -p backups
	@echo "$(GREEN)Creating database backup...$(NC)"
	docker-compose exec -T mysql mysqldump -u$${DB_USER:-rjms} -p$${DB_PASSWORD:-rjmspassword} $${DB_NAME:-rjdb} | gzip > backups/backup_$$(date +%Y%m%d_%H%M%S).sql.gz
	@echo "$(GREEN)✓ Database backed up to backups/$(NC)"

# Database restore
db-restore:
	@if [ ! -f backup.sql ]; then \
		echo "$(RED)Error: backup.sql not found$(NC)"; \
		exit 1; \
	fi
	@echo "$(YELLOW)Restoring database from backup.sql...$(NC)"
	docker-compose exec -T mysql mysql -u$${DB_USER:-rjms} -p$${DB_PASSWORD:-rjmspassword} $${DB_NAME:-rjdb} < backup.sql
	@echo "$(GREEN)✓ Database restored!$(NC)"

# Reset database
db-reset:
	@echo "$(RED)⚠️  This will DROP and recreate the database!$(NC)"
	@read -p "Are you sure? (y/N): " confirm && [ "$$confirm" = "y" ] || exit 1
	docker-compose exec mysql mysql -uroot -p$${DB_ROOT_PASSWORD:-rootpassword} -e "DROP DATABASE IF EXISTS $${DB_NAME:-rjdb}; CREATE DATABASE $${DB_NAME:-rjdb};"
	@if [ -f database/schema.sql ]; then \
		docker-compose exec -T mysql mysql -u$${DB_USER:-rjms} -p$${DB_PASSWORD:-rjmspassword} $${DB_NAME:-rjdb} < database/schema.sql; \
		echo "$(GREEN)✓ Database reset with schema!$(NC)"; \
	else \
		echo "$(GREEN)✓ Database reset (empty)$(NC)"; \
	fi

# Run tests
test:
	@echo "$(GREEN)Running PHPUnit tests...$(NC)"
	docker-compose exec php ./vendor/bin/phpunit

# Run static analysis
analyse:
	@echo "$(GREEN)Running PHPStan analysis...$(NC)"
	docker-compose exec php ./vendor/bin/phpstan analyse

# Run composer command
composer:
	docker-compose exec php composer $(CMD)

# Container status
status:
	@docker-compose ps

# Resource usage
stats:
	@docker stats --no-stream $$(docker-compose ps -q)

# Clean up
clean:
	@echo "$(RED)⚠️  This will remove containers and volumes!$(NC)"
	@read -p "Are you sure? (y/N): " confirm && [ "$$confirm" = "y" ] || exit 1
	docker-compose down -v
	@echo "$(GREEN)✓ Cleaned up!$(NC)"

# Clear caches
clean-cache:
	@echo "$(YELLOW)Clearing caches...$(NC)"
	docker volume rm rjms-composer-cache rjms-npm-cache 2>/dev/null || true
	docker-compose exec php rm -rf storage/cache/* storage/logs/* 2>/dev/null || true
	docker-compose exec redis redis-cli FLUSHALL
	@echo "$(GREEN)✓ Caches cleared!$(NC)"

# Build (alias for rebuild)
build: rebuild
