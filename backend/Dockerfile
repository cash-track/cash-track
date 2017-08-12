FROM php:7.1-fpm

ARG APP_PRODUCTION=false

# Install "curl", "libmemcached-dev", "libpq-dev", "libjpeg-dev",
#         "libpng12-dev", "libfreetype6-dev", "libssl-dev", "libmcrypt-dev",
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        curl \
        libmemcached-dev \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libpng12-dev \
        libfreetype6-dev \
        libssl-dev \
        libmcrypt-dev \
        libxml2-dev \
        php-soap \
        zlib1g-dev \
        libicu-dev \
        g++
    && rm -rf /var/lib/apt/lists/*

# Install the PHP mcrypt extention
RUN docker-php-ext-install mcrypt \
    # Install the PHP pdo_mysql extention
    && docker-php-ext-install pdo_mysql \
    # Install the PHP pdo_pgsql extention
    && docker-php-ext-install pdo_pgsql \
    # Install SOAP
    && docker-php-ext-install soap \
    # Install OPCache
    && docker-php-ext-install opcache \
    # Install MySQLi
    && docker-php-ext-install mysqli \
    # Install Tokenizer
    && docker-php-ext-install tokenizer \
    # Install the PHP gd library
    && docker-php-ext-configure gd \
        --enable-gd-native-ttf \
        --with-jpeg-dir=/usr/lib \
        --with-freetype-dir=/usr/include/freetype2 && \
        docker-php-ext-install gd \
    # Install Intl
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

# XDebug
RUN if [ ${APP_PRODUCTION} = true ]; then \
    # Install the xdebug extension
    pecl install xdebug && \
    docker-php-ext-enable xdebug \
;fi

# Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Finalisation
COPY ./config/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./config/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
ADD ./config/laravel.ini /usr/local/etc/php/conf.d
ADD ./config/laravel.pool.conf /usr/local/etc/php-fpm.d/

RUN usermod -u 1000 www-data

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000