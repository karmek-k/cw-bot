FROM composer:2.0

COPY . /app
WORKDIR /app

RUN composer install

CMD ["php", "index.php"]
