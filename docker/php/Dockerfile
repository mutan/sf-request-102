ARG PHP_VERSION
ARG PHP_TYPE
ARG COMPOSER_VERSION

# Composer - just for COPY inside PHP image
FROM composer:${COMPOSER_VERSION} AS app-composer


FROM php:${PHP_VERSION}-${PHP_TYPE}-buster as dev

# Install composer
COPY --from=app-composer /usr/bin/composer /usr/local/bin/composer

# Install php extentions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions zip gd exif intl memcached opcache pcntl pdo_pgsql pgsql pdo_mysql xdebug && \
    composer --version && \
    php -v

# Install packages
RUN apt-get update && apt-get install -y --no-install-recommends git wget sudo unzip \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libicu-dev \
        libpng-dev \
        libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Add User
ARG PUID
ARG PGID
ARG USER=dev

RUN set -xe; \
    groupadd -g ${PGID} dev && \
    useradd -l -u ${PUID} -g dev -m ${USER} -G sudo && \
    usermod ${USER} -s /bin/bash

RUN echo "${USER} ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

USER ${USER}

# Gihub token
#ARG GITHUB_TOKEN
#RUN composer config --global --auth github-oauth.github.com ${GITHUB_TOKEN}

# Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | sudo bash && sudo mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# PHP settings
COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/php/conf.d/ /usr/local/etc/php/conf.d

EXPOSE 9000

WORKDIR /srv
