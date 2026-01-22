#!/bin/bash
# MySQL Database Initialization Script for Docker
# This script runs automatically when the MySQL container is first created

set -e

echo "Starting RJMS database initialization..."

# Wait for MySQL to be ready
until mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" -e "SELECT 1" >/dev/null 2>&1; do
    echo "Waiting for MySQL to be ready..."
    sleep 2
done

echo "MySQL is ready. Creating database and importing schema..."

# The database is already created by MySQL environment variables
# Import the schema
if [ -f /docker-entrypoint-initdb.d/schema.sql ]; then
    echo "Importing schema from schema.sql..."
    mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" "${MYSQL_DATABASE}" < /docker-entrypoint-initdb.d/schema.sql
    echo "Schema imported successfully!"
else
    echo "Warning: schema.sql not found. Skipping schema import."
fi

echo "RJMS database initialization completed!"
