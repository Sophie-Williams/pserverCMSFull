#!/usr/bin/env bash

# firewall setup allow 80 and 443
for s in http https
do
    firewall-cmd --permanent --add-service=$s
done
firewall-cmd --reload

rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm

# stay up to date
yum -y update

# php && httpd
yum -y install mod_php71w php71w-opcache php71w-cli php71w-common php71w-gd php71w-intl php71w-mbstring php71w-mcrypt php71w-mysql php71w-mssql php71w-pdo php71w-pear php71w-xml php71w-xmlrpc httpd

# helpful tools
yum -y install epel-release curl crontabs git

systemctl enable httpd crond

echo "expose_php = Off" > /etc/php.d/custome.ini

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
php composer.phar update

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