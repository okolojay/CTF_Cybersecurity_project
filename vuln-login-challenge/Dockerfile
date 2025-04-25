FROM php:7.4-apache

# Copy challenge files to the web application
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

RUN docker-php-ext-install mysqli


# Expose port 80
EXPOSE 80
