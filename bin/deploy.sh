#!/bin/bash

set -e

cd /var/www/html

echo ">>> Deploy: starting"

if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "None" ]; then
    cp -n .env.example .env 2>/dev/null || true
    php artisan key:generate --force --quiet
fi

mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs
echo ">>> Deploy: dirs created"

php artisan migrate --force --quiet
echo ">>> Deploy: migrated"

if [ ! -f storage/.seed ]; then
    php artisan db:seed --force --quiet
    touch storage/.seed
    echo ">>> Deploy: seeded"
fi

php artisan view:cache
echo ">>> Deploy: views cached"

php artisan config:cache
echo ">>> Deploy: config cached"

php artisan route:cache
echo ">>> Deploy: routes cached"
