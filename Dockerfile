FROM php:8.1-cli-alpine3.15

WORKDIR /tmp/

# 1. Install SQL Drivers
#    https://docs.microsoft.com/en-us/sql/connect/php/installation-tutorial-linux-mac?view=sql-server-ver15#step-1-install-php-alpine

RUN apk update
RUN apk add --no-cache php8 php8-dev php8-pear php8-pdo php8-openssl 
RUN apk add --no-cache autoconf make g++ gnupg unixodbc-dev

# 2. Install SQL Server ODBC drivers and tools (required for the sqlsrv driver).
#    https://docs.microsoft.com/en-us/sql/connect/php/installation-tutorial-linux-mac?view=sql-server-ver15

# 2.1 Download the desired package(s)
RUN curl -O https://download.microsoft.com/download/b/9/f/b9f3cce4-3925-46d4-9f46-da08869c6486/msodbcsql18_18.0.1.1-1_amd64.apk
RUN curl -O https://download.microsoft.com/download/b/9/f/b9f3cce4-3925-46d4-9f46-da08869c6486/mssql-tools18_18.0.1.1-1_amd64.apk


# 2.2 (Optional) Verify signature, if 'gpg' is missing install it using 'apk add gnupg':
RUN curl -O https://download.microsoft.com/download/b/9/f/b9f3cce4-3925-46d4-9f46-da08869c6486/msodbcsql18_18.0.1.1-1_amd64.sig
RUN curl -O https://download.microsoft.com/download/b/9/f/b9f3cce4-3925-46d4-9f46-da08869c6486/mssql-tools18_18.0.1.1-1_amd64.sig

RUN curl https://packages.microsoft.com/keys/microsoft.asc  | gpg --import -
RUN gpg --verify msodbcsql18_18.0.1.1-1_amd64.sig msodbcsql18_18.0.1.1-1_amd64.apk
RUN gpg --verify mssql-tools18_18.0.1.1-1_amd64.sig mssql-tools18_18.0.1.1-1_amd64.apk

# 2.3 Install the package(s)
RUN yes | apk add --allow-untrusted msodbcsql18_18.0.1.1-1_amd64.apk
RUN yes | apk add --allow-untrusted mssql-tools18_18.0.1.1-1_amd64.apk

# 3. Set php.ini (to development settings)
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
RUN pecl config-set php_ini /usr/local/etc/php/php.ini

# 4. install php drivers for pdo sqlsrv
# RUN pecl install sqlsrv
RUN pecl install pdo_sqlsrv
RUN docker-php-ext-enable pdo_sqlsrv

