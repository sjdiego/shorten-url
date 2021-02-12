FROM php:8.0-fpm

COPY ./docker/php/php.override.ini /usr/local/etc/php/conf.d

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN apt-get update && apt-get install -y \
    git \
    curl \
    gnupg2 \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    nodejs \
    pkg-config \
    zip \
    unzip

RUN npm -v

RUN addgroup --gid 1000 www
RUN adduser --gid 1000 --shell /bin/sh www

RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd sockets
RUN pecl install mongodb && docker-php-ext-enable mongodb

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer -V

COPY ./ /var/www
COPY --chown=www:www ./ /var/www

WORKDIR /var/www
USER www
