#!/bin/bash

# RJMS Database Setup Script for Unix/Linux/macOS
# This script helps set up the database for the Research Journal Management System

set -e  # Exit on any error

echo "================================"
echo "RJMS Database Setup Utility"
echo "================================"
echo

# Check if we're in the right directory
if [ ! -f "migrate.php" ]; then
    echo "ERROR: This script must be run from the database directory"
    echo "Please navigate to: rjms/database/"
    exit 1
fi

# Function to show menu
show_menu() {
    echo "Choose an option:"
    echo "1. Quick setup (import complete schema)"
    echo "2. Run migrations step by step"
    echo "3. Check migration status"
    echo "4. Reset database (WARNING: Deletes all data!)"
    echo "5. Create new migration"
    echo "6. Exit"
    echo
}

# Function for quick setup
quick_setup() {
    echo
    echo "Setting up database using complete schema..."
    echo
    echo "Please ensure:"
    echo "1. MySQL server is running"
    echo "2. You have MySQL root access"
    echo
    read -p "Continue? (y/n): " confirm
    
    if [[ $confirm != [yY] && $confirm != [yY][eE][sS] ]]; then
        echo "Setup cancelled."
        return
    fi

    echo
    echo "Creating database and importing schema..."
    
    # Create database
    mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS rjdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
    
    # Import schema
    mysql -u root -p rjdb < schema.sql

    if [ $? -eq 0 ]; then
        echo
        echo "✓ Database setup completed successfully!"
        echo
        echo "Default users created:"
        echo "- admin/admin123 (Administrator)"
        echo "- editor/editor123 (Editor)"
        echo "- reviewer/reviewer123 (Reviewer)"
        echo "- author/author123 (Author)"
        echo
        echo "⚠️  IMPORTANT: Change default passwords in production!"
    else
        echo
        echo "✗ Database setup failed. Please check:"
        echo "- MySQL server is running"
        echo "- Correct username/password"
        echo "- Proper permissions"
    fi
}

# Function to run migrations
run_migrations() {
    echo
    echo "Running database migrations..."
    php migrate.php migrate
}

# Function to check status
check_status() {
    echo
    echo "Checking migration status..."
    php migrate.php status
}

# Function to reset database
reset_db() {
    echo
    echo "⚠️  WARNING: This will delete ALL data in the database!"
    read -p "Are you sure? Type 'YES' to continue: " confirm
    
    if [ "$confirm" != "YES" ]; then
        echo "Reset cancelled."
        return
    fi
    
    php migrate.php reset
}

# Function to create migration
create_migration() {
    echo
    read -p "Enter migration name (e.g., add_new_column): " name
    
    if [ -z "$name" ]; then
        echo "Migration name cannot be empty."
        return
    fi
    
    php migrate.php create "$name"
}

# Main menu loop
while true; do
    show_menu
    read -p "Enter your choice (1-6): " choice
    
    case $choice in
        1)
            quick_setup
            ;;
        2)
            run_migrations
            ;;
        3)
            check_status
            ;;
        4)
            reset_db
            ;;
        5)
            create_migration
            ;;
        6)
            echo
            echo "Goodbye!"
            exit 0
            ;;
        *)
            echo
            echo "Invalid choice. Please try again."
            ;;
    esac
    
    echo
    read -p "Press Enter to continue..."
    echo
done
