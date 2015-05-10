# How to install the PServerCMS

The following tut is in progress

## SYSTEM REQUIREMENTS

requires PHP 5.4 or later; we recommend using the latest PHP version whenever possible.

## Step 0 Setup a WebServer + PHP + different extensions

 requires `Windows Vista` (x64) and above
 the tutorial for linux will soon added

### DownloadList

- http://windows.php.net/downloads/releases/php-5.6.8-Win32-VC11-x86.zip
- http://www.apachehaus.com/cgi-bin/download.plx?dli=ZJjUv1UaZFjTUN2LRVlTtlkVOpkVFd1aidFaK10d
- For MSVCR110.dll Error, you have to download and install following http://www.microsoft.com/en-us/download/details.aspx?id=30679 [use 
the 86x Version]
- [ONLY FOR MsSQL] https://www.microsoft.com/en-us/download/details.aspx?id=20098 [Download Version 3.2]

### Setup basic Apache with default PHP

 Use the CommandlineTool and go to the apache/bin directory and type `httpd -k install` as administrator. than you can start the 
 ApacheMonitor to check if the Apache24 is listed and can be start.
 
 Now you have to add the following lines in your Apache `https.conf` (you can find it in the `conf` directory).
 
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
  


