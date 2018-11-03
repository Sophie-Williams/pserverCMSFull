# How to install the PServerCMS on CentOS7

This guide is a little setup script which provide you how to setup the PServerCMS.
There should be a clean system with no webserver and no php. If there are conflicts please delete the old parts. or install it manuel.
We also recommend a [centos7.minimal](http://isoredirect.centos.org/centos/7/isos/x86_64/CentOS-7-x86_64-Minimal-1611.iso) image. 

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
You can find a install guide @ [digitalocean](https://www.digitalocean.com/community/tutorials/how-to-install-mariadb-on-centos-7).

As mysql client you can use [heidisql](http://www.heidisql.com/), with this [guide](http://www.heidisql.com/help.php) for the connection.
 
## Configuration

```
cd /var/www/page
```

than you can continue with [config](/doc/general-setup/CONFIG.md)