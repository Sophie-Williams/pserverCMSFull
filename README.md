# How to install the PServerCMS on Windows

This guide requires `Visual Studio 2015`, if you use a older version please check [PHP5.6](https://github.com/kokspflanze/pserverCMSFull/blob/42adaf1ed09d893345aec783b5ceb1fb4f4a9b7f/README.md)

## SYSTEM REQUIREMENTS

requires PHP 7.0 or later; we recommend using the latest PHP version whenever possible.

## Step 0 Setup a WebServer + PHP + different extensions

 requires `Visual Studio 2015` and above
 the tutorial for linux will soon added

### DownloadList

- http://windows.php.net/downloads/releases/php-7.1.0-Win32-VC14-x64.zip OR http://windows.php.net/downloads/releases/archives/php-7.1.0-Win32-VC14-x64.zip
- http://www.apachehaus.com/cgi-bin/download.plx?dli=QTuBXWVBTQz0kentmWYZlSKVlUGR1Uwh2YUZVM
- https://www.microsoft.com/en-us/download/details.aspx?id=48145
- [ONLY FOR MsSQL] https://www.microsoft.com/en-us/download/details.aspx?id=36434
- [ONLY FOR MsSQL] https://github.com/Microsoft/msphpsql/releases/download/4.1.4-Windows/7.1.zip

![DownloadList](https://raw.github.com/kokspflanze/pserverCMSFull/master/docs/images/download.png)

### Install dependencies 

Please install `vc_redist.x64.exe` or `vc_redist.x86.exe` and  `msodbcsql.msi` (if you want to use a MsSQL connection)

### Setup basic Apache with default PHP

 Use the CommandlineTool and go to the apache/bin directory and type `httpd -k install` as administrator. than you can start the 
 ApacheMonitor to check if the Apache24 is listed and can be start.
 
 ![ApacheInstall](https://raw.github.com/kokspflanze/pserverCMSFull/master/docs/images/apache-install.png)
 
 Now you have to add the following lines in your Apache `httpd.conf` (you can find it in the `conf` directory).
 
 ```ini
 LoadModule php7_module "c:/PHP/php7apache2_4.dll"
 <FilesMatch \.php$>
       SetHandler application/x-httpd-php
  </FilesMatch>
 
 # configure the path to php.ini
 PHPIniDir "C:/PHP"
 ```
 
 You you have to restart your Apache, to test if the PHP works.
 
 ![ApacheSetup](https://raw.github.com/kokspflanze/pserverCMSFull/master/docs/images/apache-setup.gif)
 
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
 extension=php_pdo_sqlsrv_71_ts.dll ; if you work with a mssql DB 
 ```
 
 If you work with a MsSQL DB you have to copy the `php_pdo_sqlsrv_71_ts.dll` from the download above, to the `ext` directory from your PHP.
 
 ![PHPExtensions](https://raw.github.com/kokspflanze/pserverCMSFull/master/docs/images/php-extensions.gif)
 
### DateTime settings
 
 You have to set a valid DateTimeZone, search in your `php.ini` the config entry `date.timezone` and 
 set it to your favorite timezone [Timezone-List](http://php.net/manual/en/timezones.php). Please check that before the config is no `;`.
 
 ![ApacheInstall](https://raw.github.com/kokspflanze/pserverCMSFull/master/docs/images/php-datetime.png)
 
### PHP-Path in Environment Variables
 
 In Control Panel -> Search -> Advanced System Settings and use the button Environment Variables. 
 Under System Variables find Path add the `c:/PHP` folder (or whatever path) and restart Apache.
 
 IMPORTANT:
  - you have to use a `;` as delimiter (only on older windows systems)
  - restart your computer or close the Apache2 and the ApacheMonitor and start it again 
  
 ![PHPPathEnv](https://raw.github.com/kokspflanze/pserverCMSFull/master/docs/images/php-path-env.gif)
 
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
 
 ![GitClone](https://raw.github.com/kokspflanze/pserverCMSFull/master/docs/images/git-clone.gif)
 
### Download all other parts with composer
 
 Go wit the Git-Bash or WindowsCommandLine to the cloned page like `cd /c/Apache24/htdocs/pserverCMSFull` and type the following commands
  
  ```shell
  php composer.phar self-update
  php composer.phar update
  ```
  
  That can take some minutes.
  
#### API rate limit

 If you have a problem like that please create a GitHub account and follow the link after "Head to" in the message.
 If you later input the token, it is hidden, so you dont see a input, that is normal. 
  
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
 configuration with the sql connect´s and other parts like mail and and and, you can find some other parts in [PServerCMS-Config](https://github.com/kokspflanze/PServerCore/blob/master/config/module.config.php)
 
 For other games you can also use the `*.example.php`, but you have to change `gamebackend_dataservice`, if you only want to test you can
  use the Mocking-Class.
 
## Step 5 Start with the PServerCMS todo

 Follow the link to the ToDo-List and start with `Generate the Database`.
 [ToDo-List](https://github.com/kokspflanze/PServerCMS/blob/master/README.md#generate-the-database)

# Customize

## How to change the layout?

Go to `module/Customize/view`, create a `layout` directory and in this directory you have to create a file like `layout.twig` with the content of [default-design](https://github.com/kokspflanze/PServerCore/blob/master/view/layout/layout.twig).
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
 
These workflow will also work with other layout parts, check the PServerCMS [config](https://github.com/kokspflanze/PServerCore/blob/master/config/module.config.php#L154) at the part `template_map`.

Hint: it works also with the `module/controller/action` name if there is no alias set for a layout page.
example: `'p-server-core/index/index' => __DIR__ . '/../view/customize/index/news.twig',`