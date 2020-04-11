FROM php

RUN apt-get update && apt-get install -y libffi-dev
RUN docker-php-ext-configure ffi --with-ffi
RUN docker-php-ext-install ffi
