# Use official PHP image with Node.js included
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql exif pcntl bcmath opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Nginx
RUN apt-get install -y nginx
COPY . /var/www

# Install Node.js for Vue.js
RUN apt-get install -y nodejs npm

# Expose port 8000
EXPOSE 8000

# Start services
CMD php artisan serve --host=0.0.0.0 --port=8000