FROM node:24-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY vite.config.js ./
COPY public ./public
RUN npm run build

FROM dunglas/frankenphp:1-php8.4-alpine

WORKDIR /app

RUN install-php-extensions gd intl pdo_mysql zip exif

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY . .
COPY --from=assets /app/public/build ./public/build

RUN composer install --no-dev --no-interaction --no-progress --prefer-dist --optimize-autoloader \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache

COPY Caddyfile /etc/caddy/Caddyfile

ENV APP_ENV=production \
    APP_NAME=ZiOneDev \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    CACHE_STORE=array \
    SESSION_DRIVER=cookie \
    QUEUE_CONNECTION=sync \
    DB_CONNECTION=mysql \
    FILESYSTEM_DISK=s3 \
    PORT=80

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
