#!/bin/bash
# Script to copy schema.sql to Docker init directory

echo "Copying schema.sql to Docker initialization directory..."

# Create the init directory if it doesn't exist
mkdir -p docker/mysql/init

# Copy the schema file
cp database/schema.sql docker/mysql/init/schema.sql

echo "Schema file copied successfully!"
echo "Location: docker/mysql/init/schema.sql"
