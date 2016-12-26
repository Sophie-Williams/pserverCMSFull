# How to install the PServerCMS on CentOS7

This guide is a little setup script which provide you how to setup the PServerCMS.
There should be a clean system with no webserver and no php. If there are conflicts please delete the old parts. or install it manuel.
We also recommend a centos7.minimal image. 

## Install script

this should be run as root/sudo

this setup script works with SELinux, firewall-cmd and will setup the default crons

```
curl -L -O https://raw.githubusercontent.com/kokspflanze/pserverCMSFull/master/doc/centos-setup/setup.sh
chmod +x setup.sh
./setup.sh
```

## PServerCMS-DB

For the PServerCMS you need a DBMS as example mysql or mssql, we recommend to use mysql (mariaDB).
A install guide you can find here [digitalocean](https://www.digitalocean.com/community/tutorials/how-to-install-mariadb-on-centos-7).

As mysql client you can use [heidisql](http://www.heidisql.com/) with this [guide](http://www.heidisql.com/help.php) for the connection.
 
## Configuration

```
cd /var/www/page
```

than you can continue with [config](https://github.com/kokspflanze/pserverCMSFull/blob/master/doc/general-setup/CONFIG.md)