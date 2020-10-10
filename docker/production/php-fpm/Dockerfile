FROM php:7.4-fpm-alpine

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Install mysql and intl extensions
RUN apk add --no-cache icu-dev
RUN docker-php-ext-install pdo_mysql intl

WORKDIR /var/www/ishetkutweer

# Copy compiled code
COPY config/ config/
COPY migrations/ migrations/
COPY public/ public/
COPY src/ src/
COPY templates/ templates/
COPY translations/ translations/
COPY var/ var/
COPY vendor/ vendor/
COPY bin/console bin/console
COPY composer.json composer.json
COPY .env .env
COPY .env.local .env.local

# Install crontab
COPY ./docker/production/php-fpm/crontab /etc/crontabs/root

CMD /usr/sbin/crond -f & php-fpm
