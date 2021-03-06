#!/usr/bin/env bash

chown www-data /var/www/files /var/www/var/log
chmod -R a+rw /var/www/files

NGINX_CONFIG=php

# Avoid to remove a bind mounted nginx config
NGINX_DEFAULT=/etc/nginx/sites-enabled/default
if ! mountpoint -q $NGINX_DEFAULT; then
  echo "Using default nginx config : $NGINX_CONFIG"
  rm $NGINX_DEFAULT
  ln -s /etc/nginx/sites-available/$NGINX_CONFIG.conf $NGINX_DEFAULT
fi

# Disable opcache optimisation for developpement
# Allow files to be reloaded when update without restarting fpm process
if [[ "$PERFORMANCE_OPTIM" = "false" ]]
then
  echo "Disable performance optimisation"
  echo > /etc/php/7.4/fpm/conf.d/99-symfony.ini
fi

composer install

exec /usr/bin/supervisord -n
