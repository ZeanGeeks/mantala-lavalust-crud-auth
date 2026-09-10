
FROM php:8.2-apache

WORKDIR /var/www/html

COPY . /var/www/html/

# Install PHP database extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache rewrite
RUN a2enmod rewrite

# Set Apache document root to public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Allow LavaLust public directory
RUN printf '%s\n' \
    '<Directory /var/www/html/public>' \
    '    Options Indexes FollowSymLinks' \
    '    AllowOverride All' \
    '    Require all granted' \
    '</Directory>' \
    > /etc/apache2/conf-available/lavalust.conf

RUN a2enconf lavalust

# PHP session configuration
# Session starts manually in the application
RUN printf '%s\n' \
    'session.save_path=/tmp' \
    'session.use_strict_mode=1' \
    'session.cookie_httponly=1' \
    > /usr/local/etc/php/conf.d/session.ini

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
