@echo off
REM Script to copy schema.sql to Docker init directory

echo Copying schema.sql to Docker initialization directory...

REM Create the init directory if it doesn't exist
if not exist "docker\mysql\init" mkdir "docker\mysql\init"

REM Copy the schema file
copy /Y "database\schema.sql" "docker\mysql\init\schema.sql"

echo Schema file copied successfully!
echo Location: docker\mysql\init\schema.sql
