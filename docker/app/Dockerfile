FROM php:7-fpm-alpine

# Installing packages
# RUN apk --update add \

# Installing PHP extensions with helper script
RUN docker-php-ext-install iconv \ 
    && docker-php-ext-install ctype \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql

# Creating app dir
RUN mkdir /var/app

# Setting workdir
WORKDIR /var/app
