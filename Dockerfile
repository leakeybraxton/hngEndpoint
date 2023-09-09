FROM php:8.0-apache
WORKDIR /var/www/html
COPY . /var/www/html
RUN apt-get update && \
    apt-get install -y git && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-interaction --no-dev --optimize-autoloader
CMD ["apache2-foreground"]
docker build -t nginx .
