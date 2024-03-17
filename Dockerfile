FROM serversideup/php:8.4-fpm-nginx AS base

FROM base AS build

RUN install-php-extensions pdo_pgsql

WORKDIR /var/www/html

COPY . .

USER root
RUN mkdir -p public/build \
    && chown -R www-data:www-data storage bootstrap/cache public/build \
    && chmod -R 777 storage bootstrap/cache public/build
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
USER www-data

RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

RUN npm ci && npm run build

FROM base

RUN install-php-extensions pdo_pgsql

WORKDIR /var/www/html

COPY --from=build /var/www/html .

COPY --chmod=755 bin/deploy.sh /etc/cont-init.d/00-deploy

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache
