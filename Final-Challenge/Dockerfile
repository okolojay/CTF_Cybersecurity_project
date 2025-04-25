FROM php:7.4-apache

# Install mysqli
RUN docker-php-ext-install mysqli

# Copy website files
COPY . /var/www/html/
COPY submit.php /var/www/html/


# Set working directory
WORKDIR /var/www/html/

