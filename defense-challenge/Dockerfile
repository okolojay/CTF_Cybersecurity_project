FROM php:7.4-apache

# Install MySQL extension
RUN docker-php-ext-install mysqli

# Copy website files
COPY web/ /var/www/html/

# Enable Apache rewrite module
RUN a2enmod rewrite
