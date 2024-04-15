FROM mariadb
RUN apt-get update
RUN apt-get install --yes --force-yes cron g++ gettext libicu-dev openssl libc-client-dev libkrb5-dev libxml2-dev libfreetype6-dev libgd-dev libmcrypt-dev bzip2 libbz2-dev libtidy-dev libcurl4-openssl-dev libz-dev libmemcached-dev libxslt-dev

RUN docker-php-ext-install pdo pdo_mysql  gd
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
COPY 50-server.cnf /etc/mysql/mariadb.conf.d/50-server.cnf
