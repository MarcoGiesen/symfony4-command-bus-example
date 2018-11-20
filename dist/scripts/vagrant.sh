#!/bin/bash

sudo su
###################################################################
# Vagrant specific
###################################################################
sed -i '/tty/!s/mesg n/tty -s \\&\\& mesg n/' /root/.profile

export DEBIAN_FRONTEND=noninteractive

apt-get install -y language-pack-en zip unzip
locale-gen "en_US.UTF-8"
dpkg-reconfigure locales
update-locale LC_ALL="en_US.UTF-8" LANG="en_US.UTF-8" LC_CTYPE="en_US.UTF-8"
export LC_ALL="en_US.UTF-8"
export LANG="en_US.UTF-8"
export LANGUAGE="en_US.UTF-8"
export LC_CTYPE="en_US.UTF-8"

add-apt-repository ppa:ondrej/php -y
add-apt-repository -y 'deb http://archive.ubuntu.com/ubuntu trusty universe'
apt-get update > /dev/null 2>&1
###################################################################
# php
###################################################################
apt-get install -y --no-install-recommends php7.1 php7.1-fpm php7.1-cli php7.1-dev php7.1-xdebug php7.1-curl php7.1-intl php7.1-xml php7.1-zip php7.1-sqlite3 php7.1-mysql php7.1-mbstring
###################################################################
# composer
###################################################################
cd /tmp && curl -O https://getcomposer.org/installer && php installer && mv composer.phar /usr/local/bin/composer
###################################################################
# nginx
###################################################################
apt-get install -y nginx
root -c "echo '127.0.0.1 dev.symfony4-command-bus.de' >> /etc/hosts"

rm /etc/nginx/sites-enabled/*
rm /etc/nginx/nginx.conf

cp /var/www/project/dist/nginx/nginx.conf /etc/nginx/
cp /var/www/project/dist/nginx/dev.symfony4-command-bus.conf /etc/nginx/sites-available/

ln -s /etc/nginx/sites-available/dev.symfony4-command-bus.conf /etc/nginx/sites-enabled/
###################################################################
# xdebug
###################################################################
root -c "echo 'xdebug.remote_port = 9005' >> /etc/php/7.1/mods-available/xdebug.ini"
root -c "echo 'xdebug.remote_enable = 1' >> /etc/php/7.1/mods-available/xdebug.ini"
root -c "echo 'xdebug.remote_connect_back = 1' >> /etc/php/7.1/mods-available/xdebug.ini"
root -c "echo 'xdebug.idekey = "PHPSTORM"' >> /etc/php/7.1/mods-available/xdebug.ini"
###################################################################
# restarting services
###################################################################
apt-get autoremove -y
service nginx restart
service php7.1-fpm restart

