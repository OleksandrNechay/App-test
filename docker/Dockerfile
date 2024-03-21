# Use an official PHP with Apache base image
FROM php:8.2-apache

# Copy the custom php.ini file to the container
COPY ./php.ini /usr/local/etc/php/conf.d/php.ini

# Set up Apache configuration
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && \
    apt-get install \
    libzip-dev \
    wget \
    git \
    unzip \
    default-mysql-client \
    -y --no-install-recommends

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN docker-php-ext-install zip pdo_mysql

# Change current working directory
WORKDIR /var/www/public

# Enable Apache modules
RUN a2enmod rewrite

# Start Apache server when the container starts
CMD ["apache2-foreground"]