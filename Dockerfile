# Gunakan PHP resmi dengan Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install dependencies + PostgreSQL driver
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql pdo_mysql mbstring zip

# Enable mod_rewrite untuk Laravel
RUN a2enmod rewrite

# Set DocumentRoot ke folder public Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copy source code
COPY . .

# Copy file .env
COPY .env .env

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# Set permission folder storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
