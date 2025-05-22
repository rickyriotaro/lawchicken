FROM php:8.1-apache

# Install extensions
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    && docker-php-ext-install zip pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy Laravel files
COPY . /var/www/html

# Set working dir
WORKDIR /var/www/html

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80
