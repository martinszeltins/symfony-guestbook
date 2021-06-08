#!/bin/sh

while ! $(nc -z guestbook-mysql-server 3306) ; do sleep 1; echo "---> Waiting for MySQL to come up..."; done

echo "Running ---> composer install..."
composer install && \

echo "Running ---> chmod -R 777 /var/www"
chmod -R 777 /var/www && \

echo "Running ---> php-fpm"
php-fpm