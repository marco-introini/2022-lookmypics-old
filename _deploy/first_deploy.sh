#!/bin/bash

# Must be run as root

# Cloned in /var/www/lookmypics.com

cp nginx.conf /etc/nginx/sites-available/lookmypics.com
ln -s /etc/nginx/sites-available/lookmypics.com /etc/nginx/sites-enabled/
service nginx reload

certbot --nginx

chown -R www-data:www-data /var/www/lookmypics.com/

echo "* * * * * www-data cd /var/www/lookmypics.com && php artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab
