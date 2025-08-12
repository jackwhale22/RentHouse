#!/bin/bash
set -e

# Check if database file exists, if not create and initialize it
if [ ! -f "/app/database/database.sqlite" ]; then
    echo "Database file not found. Creating and initializing database..."
    touch /app/database/database.sqlite
    php artisan migrate --force
    php artisan db:seed --force
    echo "Database initialized successfully."
else
    echo "Database file exists. Skipping initialization."
fi

# Start the Laravel development server
exec php artisan serve --host=0.0.0.0 --port=8000
