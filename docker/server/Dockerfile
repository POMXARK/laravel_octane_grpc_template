FROM ghcr.io/roadrunner-server/roadrunner:2024 as roadrunner

FROM php:8.4-alpine

RUN set -ex && apk --no-cache add libxml2-dev
RUN docker-php-ext-configure pcntl
RUN docker-php-ext-install pcntl

RUN --mount=type=bind,from=mlocati/php-extension-installer:2,source=/usr/bin/install-php-extensions,target=/usr/local/bin/install-php-extensions \
     install-php-extensions @composer-2 opcache zip intl sockets protobuf

COPY --from=roadrunner /usr/bin/rr /usr/local/bin/rr

COPY ./ext/grpc.so /lib/php/20240924/grpc.so

RUN apk add --no-cache bash

# Открытие порта
EXPOSE 9001

ENTRYPOINT ["bash", "-c", "cd /var/www/html && ./rr serve"]

#ENTRYPOINT ["bash", "-c", "cd /var/www/html && ls -l"]
