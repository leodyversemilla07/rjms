# RJMS Database Migration System

This directory contains the database migration system for the Research Journal Management System (RJMS).

## Overview

The migration system provides a structured way to manage database schema changes and data seeding. It ensures that all developers and deployment environments have the same database structure.

## Files Structure

```
database/
├── Migration.php          # Migration class with core functionality
├── migrate.php           # Command-line interface for migrations
├── schema.sql           # Complete database schema (for quick setup)
├── migrations/          # Individual migration files
│   ├── 2025_09_08_120000_create_users_table.sql
│   ├── 2025_09_08_120100_create_submissions_table.sql
│   ├── 2025_09_08_120200_create_inbox_table.sql
│   ├── 2025_09_08_120300_create_reviews_table.sql
│   ├── 2025_09_08_120400_create_categories_table.sql
│   ├── 2025_09_08_120500_create_submission_categories_table.sql
│   ├── 2025_09_08_120600_create_user_sessions_table.sql
│   └── 2025_09_08_120700_insert_default_data.sql
└── README.md            # This file
```

## Quick Setup (New Installation)

If you're setting up the database for the first time, you can use the complete schema:

```bash
# Option 1: Import the complete schema directly into MySQL
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS rjdb;"
mysql -u root -p rjdb < database/schema.sql

# Option 2: Use phpMyAdmin or MySQL Workbench to import schema.sql
```

## Migration Commands

### Running Migrations

```bash
# Navigate to the database directory
cd database

# Run all pending migrations
php migrate.php migrate

# Check migration status
php migrate.php status

# Get help
php migrate.php help
```

### Creating New Migrations

```bash
# Create a new migration file
php migrate.php create add_new_column_to_users

# This creates a new file: YYYY_MM_DD_HHMMSS_add_new_column_to_users.sql
```

### Reset Database (Development Only)

⚠️ **WARNING**: This will delete all data!

```bash
php migrate.php reset
```

## Database Schema

### Core Tables

1. **users** - User accounts (admin, author, reviewer, editor)
2. **submissions** - Article submissions
3. **reviews** - Peer review records
4. **categories** - Research categories
5. **submission_categories** - Many-to-many relationship
6. **inbox** - Contact form messages
7. **user_sessions** - Session management
8. **migrations** - Migration tracking

### Default Users

The system comes with default users for testing:

| Username | Password | Role | Email |
|----------|----------|------|-------|
| admin | admin123 | admin | admin@rjms.com |
| editor | editor123 | editor | editor@rjms.com |
| reviewer | reviewer123 | reviewer | reviewer@rjms.com |
| author | author123 | author | author@rjms.com |

⚠️ **Security Note**: Change default passwords in production!

### Default Categories

- Computer Science
- Engineering
- Medicine
- Physics
- Mathematics
- Biology
- Chemistry
- Social Sciences
- Business
- Education

## Development Workflow

1. **Making Schema Changes**:
   ```bash
   # Create a new migration
   php migrate.php create your_change_description
   
   # Edit the generated .sql file
   # Add your SQL statements
   
   # Run the migration
   php migrate.php migrate
   ```

2. **Team Collaboration**:
   - Always create migrations for schema changes
   - Never edit existing migration files
   - Run `php migrate.php migrate` after pulling changes
   - Check `php migrate.php status` to see current state

3. **Production Deployment**:
   ```bash
   # Check what will be executed
   php migrate.php status
   
   # Run migrations
   php migrate.php migrate
   ```

## Troubleshooting

### Common Issues

1. **Connection Error**:
   - Check `includes/db_connection.php` settings
   - Ensure MySQL server is running
   - Verify database credentials

2. **Migration Fails**:
   - Check SQL syntax in migration file
   - Ensure foreign key constraints are satisfied
   - Check for duplicate data conflicts

3. **Permission Issues**:
   - Ensure PHP has read/write access to migration files
   - Check MySQL user permissions

### Reset and Restart

If you need to completely reset the database:

```bash
# Reset all tables
php migrate.php reset

# Run migrations again
php migrate.php migrate
```

## Best Practices

1. **Migration Naming**: Use descriptive names
   - ✅ `create_user_profile_table`
   - ✅ `add_email_verification_to_users`
   - ❌ `update_database`

2. **SQL Guidelines**:
   - Use `IF NOT EXISTS` for CREATE statements when appropriate
   - Always specify charset and collation
   - Add proper indexes for performance
   - Use foreign key constraints for data integrity

3. **Backwards Compatibility**:
   - Consider migration rollback scenarios
   - Avoid destructive changes in production
   - Test migrations thoroughly

## Advanced Usage

### Custom Migration Logic

You can extend the Migration class for complex operations:

```php
// In your migration file, you can include PHP logic
// But keep it simple - complex logic should be in separate scripts
```

### Backup Before Migration

```bash
# Create backup before running migrations
mysqldump -u root -p rjdb > backup_$(date +%Y%m%d_%H%M%S).sql

# Run migrations
php migrate.php migrate
```

## Support

For issues or questions:
1. Check this README
2. Review migration logs
3. Check database connection settings
4. Consult the main project documentation
