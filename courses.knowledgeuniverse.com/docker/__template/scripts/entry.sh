#! /bin/bash

# git pull to get code from git using ssh.

# more thing you can do here like move files, copying, and many.

sed -i "s/short_open_tag = .*/short_open_tag = On/" /etc/php/8.1/apache2/php.ini
sed -i "s/short_open_tag = .*/short_open_tag = On/" /etc/php/8.1/cli/php.ini

sed -i "s/display_errors = .*/display_errors = On/" /etc/php/8.1/cli/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php/8.1/apache2/php.ini

sed -i "s/log_errors = .*/log_errors = On/" /etc/php/8.1/cli/php.ini
sed -i "s/log_errors = .*/log_errors = On/" /etc/php/8.1/apache2/php.ini

sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf


/usr/sbin/apache2ctl -D FOREGROUND