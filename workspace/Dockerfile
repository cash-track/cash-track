FROM phusion/baseimage:latest

ARG APP_PRODUCTION=false

RUN DEBIAN_FRONTEND=noninteractive
RUN locale-gen en_US.UTF-8
RUN locale-gen ru_RU.UTF-8

ENV LANGUAGE=en_US.UTF-8
ENV LC_ALL=en_US.UTF-8
ENV LC_CTYPE=en_US.UTF-8
ENV LANG=en_US.UTF-8
ENV TERM xterm

# Add the "PHP 7" ppa
RUN apt-get install -y software-properties-common && \
    add-apt-repository -y ppa:ondrej/php

# Install "PHP Extentions", "libraries", "Software's"
RUN apt-get update && \
    apt-get install -y --allow-downgrades --allow-remove-essential \
        --allow-change-held-packages \
        php7.1-cli \
        php7.1-common \
        php7.1-curl \
        php7.1-json \
        php7.1-xml \
        php7.1-mbstring \
        php7.1-mcrypt \
        php7.1-mysql \
        php7.1-pgsql \
        php7.1-sqlite \
        php7.1-sqlite3 \
        php7.1-zip \
        php7.1-bcmath \
        php7.1-memcached \
        php7.1-gd \
        php7.1-dev \
        pkg-config \
        libcurl4-openssl-dev \
        libedit-dev \
        libssl-dev \
        libxml2-dev \
        xz-utils \
        libsqlite3-dev \
        sqlite3 \
        git \
        curl \
        vim \
        nano \
        postgresql-client \
    && apt-get clean

# Composer:

# Install composer and add its bin to the PATH.
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer

# Source the bash
RUN . ~/.bashrc

# Create non root user
ARG PUID=1000
ARG PGID=1000
ENV PUID ${PUID}
ENV PGID ${PGID}
RUN groupadd -g ${PGID} finance && \
    useradd -u ${PUID} -g finance -m finance && \
    apt-get update -yqq

# Install the PHP SOAP extension
USER root
RUN add-apt-repository -y ppa:ondrej/php && \
    apt-get update -yqq && \
    apt-get -y install libxml2-dev php7.1-soap

# Timezone
RUN ln -snf /usr/share/zoneinfo/UTC /etc/localtime && echo UTC > /etc/timezone

# Composer
# Add the composer.json
COPY ./composer.json /home/finance/.composer/composer.json
# Make sure that ~/.composer belongs to finance
RUN chown -R finance:finance /home/finance/.composer
USER finance
RUN composer global install

# Crontab
USER root
COPY ./crontab /etc/cron.d
RUN chmod -R 644 /etc/cron.d

# User aliases
USER finance
COPY ./aliases.sh /home/finance/aliases.sh
RUN echo "" >> ~/.bashrc && \
    echo "# Load Custom Aliases" >> ~/.bashrc && \
    echo "source /home/finance/aliases.sh" >> ~/.bashrc && \
	echo "" >> ~/.bashrc && \
	sed -i 's/\r//' /home/finance/aliases.sh && \
	sed -i 's/^#! \/bin\/sh/#! \/bin\/bash/' /home/finance/aliases.sh

USER root
RUN echo "" >> ~/.bashrc && \
    echo "# Load Custom Aliases" >> ~/.bashrc && \
    echo "source /home/finance/aliases.sh" >> ~/.bashrc && \
	echo "" >> ~/.bashrc && \
	sed -i 's/\r//' /home/finance/aliases.sh && \
	sed -i 's/^#! \/bin\/sh/#! \/bin\/bash/' /home/finance/aliases.sh

# XDebug
ARG APP_PRODUCTION=false
RUN if [ ${APP_PRODUCTION} = false ]; then \
    # Load the xdebug extension only with phpunit commands
    apt-get update && \
    apt-get install -y --force-yes php7.1-xdebug && \
    sed -i 's/^;//g' /etc/php/7.1/cli/conf.d/20-xdebug.ini && \
    echo "alias phpunit='php -dzend_extension=xdebug.so /var/www/vendor/bin/phpunit'" >> ~/.bashrc \
;fi
# ADD for REMOTE debugging
COPY ./xdebug.ini /etc/php/7.1/cli/conf.d/xdebug.ini

# SSH
ADD insecure_id_rsa /tmp/id_rsa
ADD insecure_id_rsa.pub /tmp/id_rsa.pub
RUN rm -f /etc/service/sshd/down && \
    cat /tmp/id_rsa.pub >> /root/.ssh/authorized_keys \
        && cat /tmp/id_rsa.pub >> /root/.ssh/id_rsa.pub \
        && cat /tmp/id_rsa >> /root/.ssh/id_rsa \
        && rm -f /tmp/id_rsa* \
        && chmod 644 /root/.ssh/authorized_keys /root/.ssh/id_rsa.pub \
    && chmod 400 /root/.ssh/id_rsa

USER finance

# Node / NVM:

# Check if NVM needs to be installed
ARG NODE_VERSION=stable
ENV NODE_VERSION ${NODE_VERSION}
ARG INSTALL_NODE=false
ENV INSTALL_NODE ${INSTALL_NODE}
ENV NVM_DIR /home/finance/.nvm
# Install nvm (A Node Version Manager)
RUN curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.1/install.sh | bash && \
        . $NVM_DIR/nvm.sh && \
        nvm install stable && \
        nvm use stable && \
        nvm alias stable && \
        npm install -g gulp bower vue-cli

# Wouldn't execute when added to the RUN statement in the above block
# Source NVM when loading bash since ~/.profile isn't loaded on non-login shell
RUN echo "" >> ~/.bashrc && \
    echo 'export NVM_DIR="$HOME/.nvm"' >> ~/.bashrc && \
    echo '[ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh"  # This loads nvm' >> ~/.bashrc

# Add NVM binaries to root's .bashrc
USER root

RUN echo "" >> ~/.bashrc && \
    echo 'export NVM_DIR="/home/finance/.nvm"' >> ~/.bashrc && \
    echo '[ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh"  # This loads nvm' >> ~/.bashrc

#####################################
# YARN:
#####################################

USER finance

RUN if [ true ]; then \
    [ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh" && \
    curl -o- -L https://yarnpkg.com/install.sh | bash && \
    echo "" >> ~/.bashrc && \
    echo 'export PATH="$HOME/.yarn/bin:$PATH"' >> ~/.bashrc \
;fi

# Add YARN binaries to root's .bashrc
USER root
RUN echo "" >> ~/.bashrc && \
    echo 'export YARN_DIR="/home/finance/.yarn"' >> ~/.bashrc && \
    echo 'export PATH="$YARN_DIR/bin:$PATH"' >> ~/.bashrc

# Non-root user : PHPUnit path
# add ./vendor/bin to non-root user's bashrc (needed for phpunit)
USER finance
RUN echo "" >> ~/.bashrc && \
    echo 'export PATH="/var/www/vendor/bin:$PATH"' >> ~/.bashrc

# Clean up
USER root
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Set default work directory
WORKDIR /var/www