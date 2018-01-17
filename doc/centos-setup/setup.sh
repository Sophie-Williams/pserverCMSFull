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
yum -y install php72 php72-php php72-php-opcache php72-php-bcmath php72-php-cli php72-php-common php72-php-gd php72-php-intl php72-php-json php72-php-mbstring php72-php-pdo php72-php-pdo-dblib php72-php-pear php72-php-pecl-mcrypt php72-php-xmlrpc php72-php-xml php72-php-mysql php72-php-soap php72-php-pecl-zip httpd


# helpful tools
yum -y install epel-release curl crontabs git

systemctl enable httpd crond

echo "expose_php = Off" > /etc/opt/remi/php72/php.d/50-custome.ini

ln -s /bin/php72 /bin/php

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
