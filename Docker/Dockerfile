FROM node:latest AS node
FROM php:8.1-fpm
# copy node to container
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm
# RUN cat /etc/apt/sources.list
RUN apt-get update -y \
	&& apt-get install -y wget \
	&& wget -O netselect.deb http://http.us.debian.org/debian/pool/main/n/netselect/netselect_0.3.ds1-28+b1_`dpkg --print-architecture`.deb \
	&& dpkg -i netselect.deb \
	&& rm netselect.deb \
	&& sed -r -i -e "s#http://(archive|security)\.ubuntu\.com/ubuntu/?#$(netselect -v -s1 -t20 `wget -q -O- http://mirrors.ubuntu.com/IR.txt | grep -P -B8 "statusUP|statusSIX" | grep -o -P "http://[^\"]*"`|grep -P -o 'http://.+$')#g" /etc/apt/sources.list.d/debian.sources
# RUN sed -i -e 's/http:\/\/archive\.ubuntu\.com\/ubuntu\//mirror:\/\/mirrors\.ubuntu.com\/IR\.txt/' /etc/apt/sources.list
RUN apt-get update && apt-get upgrade -y \
    && apt-get install -y \
    g++ \
    libbz2-dev \
    libc-client-dev \
    libcurl4-gnutls-dev \
    libedit-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libkrb5-dev \
    libldap2-dev \
    libldb-dev \
    libmagickwand-dev \
    libmcrypt-dev \
    libmemcached-dev \
    libpng-dev \
    libpq-dev \
    libsqlite3-dev \
    libssl-dev \
    libreadline-dev \
    libxslt1-dev \
    libzip-dev \
    memcached \
    wget \
    unzip \
    zlib1g-dev \
    && docker-php-ext-install -j$(nproc) \
    bcmath \
    bz2 \
    calendar \
    exif \
    gettext \
    mysqli \
    opcache \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    soap \
    xsl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && PHP_OPENSSL=yes docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install -j$(nproc) imap \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-configure ldap \
    && docker-php-ext-install ldap \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && CFLAGS="$CFLAGS -D_GNU_SOURCE" docker-php-ext-install sockets \
    && pecl install xmlrpc-1.0.0RC3 && docker-php-ext-enable xmlrpc \
    && pecl install xdebug && docker-php-ext-enable xdebug \
    && pecl install memcached && docker-php-ext-enable memcached \
    && pecl install mongodb && docker-php-ext-enable mongodb \
    && pecl install redis && docker-php-ext-enable redis \
    && yes '' | pecl install imagick && docker-php-ext-enable imagick \
    && docker-php-source delete \
    && apt-get remove -y g++ wget \
    && apt-get autoremove --purge -y && apt-get autoclean -y && apt-get clean -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/* /var/tmp/*
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer