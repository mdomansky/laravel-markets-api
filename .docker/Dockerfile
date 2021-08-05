FROM php:7.4-alpine AS prebuild
WORKDIR /app
COPY . /app
COPY ./.docker/supervisor.conf /etc/supervisor/supervisord.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
	&& docker-php-ext-install pdo_mysql \
	&& apk add --no-cache git \
	&& apk add --update busybox-suid supervisor autoconf \
	&& chown -R 1000:1000 /app
RUN apk --update add bash gcc make g++ zlib-dev curl-dev openssl-dev \
    && /bin/bash -lc "pecl install mongodb" \
    && docker-php-ext-enable mongodb
RUN chmod 777 -R /app/storage
USER 1000

FROM prebuild
USER root
RUN cp .env.example .env \
	&& composer i --no-dev -a --no-progress \
	&& composer clear-cache \
	&& php artisan key:generate
USER 1000
EXPOSE 8000/tcp
CMD composer install -vvv --no-cache --no-interaction
CMD /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
