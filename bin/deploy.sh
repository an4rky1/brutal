#!/bin/bash

set -e

cd /var/www/html

cp -n .env.example .env 2>/dev/null || true

if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "None" ]; then
    php artisan key:generate --force
fi

mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs

APP_URL=http://localhost php artisan migrate --force

if [ ! -f storage/.seed ]; then
    APP_URL=http://localhost php artisan db:seed --force
    touch storage/.seed
fi

APP_URL=http://localhost php artisan view:cache

php artisan config:cache
php artisan route:cache
