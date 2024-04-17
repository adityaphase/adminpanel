FROM php:8.3.3-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Enable Apache modules
RUN a2enmod rewrite

# Restart Apache
RUN service apache2 restart