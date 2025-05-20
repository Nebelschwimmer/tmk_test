#!/bin/bash
set -e

echo "Initializing..."

if [ ! -d "vendor" ]; then
  echo "Installing dependencies..."
  composer install --no-interaction --prefer-dist --no-scripts
else
  echo "Dependencies already installed"
fi

echo "Waiting for database to be ready..."
until php bin/console doctrine:query:sql "SELECT 1" > /dev/null 2>&1; do
  sleep 1
done

echo "Running migrations..."
if [ -z "$(ls -A Infrastructure/Persistance/Migrations 2>/dev/null)" ]; then
    echo "Migration folder is empty — generating initial migration..."
    php bin/console doctrine:migrations:diff --no-interaction
else
    echo "Migration folder not empty — skipping diff"
fi
php bin/console doctrine:migrations:migrate --no-interaction

echo "Launching Apache..."
exec apache2-foreground
