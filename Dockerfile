FROM php:8.6.0beta2-apache
COPY src/ /var/www/html/
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
WORKDIR /var/www/html/
