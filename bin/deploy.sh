#!/bin/bash

set -e

if [ ! -f .env ]; then
    cp .env.example .env
fi

php artisan key:generate --force --quiet

php artisan migrate --force --quiet

if [ ! -f /var/www/html/storage/.seed ]; then
    php artisan db:seed --force --quiet
    touch /var/www/html/storage/.seed
fi

php artisan config:cache --quiet
php artisan route:cache --quiet
php artisan view:cache --quiet

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
