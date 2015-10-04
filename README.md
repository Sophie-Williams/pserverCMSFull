# How to install the PServerCMS

The following tut is in progress

## SYSTEM REQUIREMENTS

requires PHP 5.5 or later; we recommend using the latest PHP version whenever possible.

## Step 0 Setup a WebServer + PHP + different extensions

 requires `Windows Vista` and above
 the tutorial for linux will soon added

### DownloadList

- http://windows.php.net/downloads/releases/archives/php-5.6.9-Win32-VC11-x86.zip
- http://www.apachehaus.com/cgi-bin/download.plx?dli=ZJjUv1UaZFjTUN2LRVlTtlkVOpkVFd1aidFaK10d
- For MSVCR110.dll Error, you have to download and install following http://www.microsoft.com/en-us/download/details.aspx?id=30679 [use 
the 86x Version]
- [ONLY FOR MsSQL] https://www.microsoft.com/en-us/download/details.aspx?id=20098 [Download Version 3.2]

### Setup basic Apache with default PHP

 Use the CommandlineTool and go to the apache/bin directory and type `httpd -k install` as administrator. than you can start the 
 ApacheMonitor to check if the Apache24 is listed and can be start.
 
 Now you have to add the following lines in your Apache `httpd.conf` (you can find it in the `conf` directory).
 
 ```ini
 LoadModule php5_module "c:/PHP/php5apache2_4.dll"
 <FilesMatch \.php$>
       SetHandler application/x-httpd-php
  </FilesMatch>
 
 # configure the path to php.ini
 PHPIniDir "C:/PHP"
 ```
 
 You you have to restart your Apache, to test if the PHP works.
 
### Enable PHP extensions
 
 Rename the `php.ini-production` in `php.ini` in your PHP-Directory.
 
 Add the following things in your `php.ini` file.
 
 ```ini
 extension_dir = "c:\PHP\ext"
 extension=php_curl.dll
 extension=php_gd2.dll
 extension=php_intl.dll
 extension=php_openssl.dll
 extension=php_pdo_mysql.dll ; if you work with a mysql DB
 extension=php_sockets.dll
 extension=php_pdo_sqlsrv_56_ts.dll ; if you work with a mssql DB 
 ```
 
 If you work with a MsSQL DB you have to copy the `php_pdo_sqlsrv_56_ts.dll` from the download above, to the `ext` directory from your PHP.
 You also have to install https://www.microsoft.com/de-de/download/details.aspx?id=36434 for MsSQL.
 
### DateTime settings
 
 You have to set a valid DateTimeZone, search in your `php.ini` the config entry `date.timezone` and 
 set it to your favorite timezone [Timezone-List](http://php.net/manual/en/timezones.php). Please check that before the config is no `;`.
 
### PHP-Path in Environment Variables
 
 In Control Panel -> Search -> Advanced System Settings and use the button Environment Variables. 
 Under System Variables find Path add the `c:/PHP` folder (or whatever path) and restart Apache.
 
 IMPORTANT:
  - you have to use a `;` as delimiter
  - restart your computer or close the Apache2 and the ApacheMonitor and start it again 
 
## Step 1 Git-Client Install

### DownloadList

 - http://git-scm.com/download/win

### Basics

 Install the downloaded Git-Client

## Step 2 download the page

### Clone the repository

 Open the Git-Bash [installed in Step 1] and change the directory to the place, where the page should be stay, the command is something 
 like `cd /c/Apache24/htdocs`.
 Than type `git clone https://github.com/kokspflanze/pserverCMSFull.git`, if you later want to update the Full-System, you can easy type 
 `git pull` [That only work in the pserverCMS-Directory, `cd /c/Apache24/htdocs/pserverCMSFull`].
 
### Download all other parts with composer
 
 Go wit the Git-Bash or WindowsCommandLine to the cloned page like `cd /c/Apache24/htdocs/pserverCMSFull` and type the following commands
  
  ```shell
  php composer.phar self-update
  php composer.phar update
  ```
  
  That can take some minutes.
  
## Step 3 Configuration for Apache

 Add the following things in your `httpd.conf` file.

 ```ini
 LoadModule rewrite_module modules/mod_rewrite.so
 LoadModule vhost_alias_module modules/mod_vhost_alias.so
 
 # Virtual hosts
 Include conf/extra/httpd-vhosts.conf
 ```
 
 Change `DocumentRoot "c:/Apache24/htdocs"` to `DocumentRoot "c:/Apache24/htdocs/default"` and create the `default` directory in `htdocs`.
 
 Also you have change
 
 ```ìni
<IfModule dir_module>
	DirectoryIndex index.html
</IfModule>
 ```
 
 to
 
 ```ìni
<IfModule dir_module>
	DirectoryIndex index.html index.php
</IfModule>
 ```
 
 Remove everything in `httpd-vhosts.conf` and add the following, in the `conf/extra` directory.
  
 ```ini
<VirtualHost *:80>
	DocumentRoot "${SRVROOT}/htdocs/pserverCMSFull/public"
	
	<Directory "${SRVROOT}/htdocs/pserverCMSFull/public">
		Options Indexes FollowSymLinks MultiViews
		AllowOverride All
	</Directory>
</VirtualHost>
 ```

## Step 4 PServerCMS basic configuration

 Go to the `config/autoload` directory and create `[GAME].local.php` with the content of `[GAME].example.php`. Now you have to edit the 
 configuration with the sql connect´s and other parts like mail and and and, you can find some other parts in [PServerCMS-Config](https://github.com/kokspflanze/PServerCMS/blob/master/config/module.config.php)
 
 For other games you can also use the `*.example.php`, but you have to change `gamebackend_dataservice`, if you only want to test you can
  use the Mocking-Class.
 
## Step 5 Start with the PServerCMS todo

 Follow the link to the ToDo-List and start with `Generate the Database`.
 [ToDo-List](https://github.com/kokspflanze/PServerCMS/blob/master/README.md#generate-the-database)

# Customize

## How to change the layout?

Go to `module/Customize/view`, create a `layout` directory and in this directory you have to create a file like `layout.twig` with the content of [default-design](https://github.com/kokspflanze/PServerCMS/blob/master/view/layout/layout.twig).
These file that you create will be your custom design, so there you can everything you need=).
Now you have to register your custom layout in the config, for that you have to go to `module/Customize/config/module.config.php`, there you have to add `'layout/layout' => __DIR__ . '/../view/layout/layout.twig',`.
So the file will look like 
 
 ```php
<?php
return [
    'view_manager' => [
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.twig',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
 ```
 
These workflow will also work with other layout parts, check the PServerCMS [config](https://github.com/kokspflanze/PServerCMS/blob/master/config/module.config.php#L135) at the part `template_map`.

Hint: it works also with the `module/controller/action` name if there is no alias set for a layout page.
example: `'p-server-cms/index/index' => __DIR__ . '/../view/customize/index/news.twig',`