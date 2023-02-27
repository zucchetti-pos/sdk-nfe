FROM  php:8.2-rc-apache

RUN apt-get -y update \
    && apt-get install -y libicu-dev zlib1g-dev libpng-dev libxml2-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure gd \
    && docker-php-ext-install soap \
    && docker-php-ext-install mbstring bcmath curl intl gd sqlite3 bcmath memcached mbstring zip gettext xml \

RUN curl -sS https://getcomposer.org/installer | php -- \
  --install-dir=/usr/bin --filename=composer

COPY . .
WORKDIR .

RUN cp storage/cert.pfx /tmp/cert.pfx

EXPOSE 3013

CMD php -S 0.0.0.0:3013 -t public