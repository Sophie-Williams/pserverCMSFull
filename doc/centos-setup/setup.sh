#!/usr/bin/env bash

# firewall setup allow 80 and 443
for s in http https
do
    firewall-cmd --permanent --add-service=$s
done
firewall-cmd --reload

rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
rpm -Uvh https://rpms.remirepo.net/enterprise/remi-release-7.rpm

# stay up to date
yum -y update

# php && httpd
yum -y install php73 php73-php php73-php-opcache php73-php-bcmath php73-php-cli php73-php-common php73-php-gd php73-php-intl php73-php-json php73-php-mbstring php73-php-pdo php73-php-pdo-dblib php73-php-pear php73-php-pecl-mcrypt php73-php-xmlrpc php73-php-xml php73-php-mysql php73-php-soap php73-php-pecl-zip httpd


# helpful tools
yum -y install epel-release curl crontabs git

systemctl enable httpd crond

echo "expose_php = Off" > /etc/opt/remi/php73/php.d/50-custome.ini

ln -s /bin/php73 /bin/php

echo "ServerTokens prod
ServerSignature Off

<VirtualHost *:80>
	DocumentRoot /var/www/page/public
	<Directory /var/www/page/public>
			Options -Indexes +FollowSymLinks +MultiViews
			AllowOverride All
			Order allow,deny
			allow from all
	</Directory>

	ErrorLog /var/log/httpd/page-error.log
	CustomLog /var/log/httpd/page-access.log combined
</VirtualHost>
" > /etc/httpd/conf.d/v-host.conf

git clone https://github.com/kokspflanze/pserverCMSFull.git /var/www/page

cd /var/www/page

php composer.phar selfupdate
php composer.phar update -o

# selinux
setsebool -P httpd_can_network_connect on
chcon -t httpd_sys_rw_content_t /var/www/page/data -R

# cache directory
chown apache:apache -R /var/www/page/data

#setup crons
echo "* * * * * apache php /var/www/page/public/index.php player-history
*/5 * * * * apache php /var/www/page/public/index.php user-codes-cleanup
" > /etc/cron.d/pservercms

systemctl start httpd crond
