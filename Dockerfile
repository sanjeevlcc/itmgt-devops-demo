# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy all app files into the container's web root
COPY . /var/www/html/

# Give proper permissions (optional but good practice)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (we’ll map to 8989 externally)
EXPOSE 80
