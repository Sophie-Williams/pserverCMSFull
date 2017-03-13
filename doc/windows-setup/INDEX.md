# How to install the PServerCMS on Windows

This guide requires `Visual Studio 2015`, if you use a older version please check [PHP5.6](https://github.com/kokspflanze/pserverCMSFull/blob/42adaf1ed09d893345aec783b5ceb1fb4f4a9b7f/README.md)
There should be also no other webserver running on port 80 and no other PHP should be installed. If there are conflicts please delete the old parts or edit the configs.

## Setup a WebServer + PHP + different extensions

requires `Visual Studio 2015` and above

## DownloadList

- [PHP 7.1.2](http://windows.php.net/downloads/releases/php-7.1.2-Win32-VC14-x64.zip) OR [PHP 7.1.2 Archive](http://windows.php.net/downloads/releases/archives/php-7.1.2-Win32-VC14-x64.zip), use the archive version if the first link not work or download the latest 7.1.X VC14 x64 Thread Safe
- [Apache](http://www.apachehaus.com/cgi-bin/download.plx?dli=QTuBXWVBTQz0kentmWYZlSKVlUGR1Uwh2YUZVM)
- [Visual C++ Redistributable](https://www.microsoft.com/en-us/download/details.aspx?id=48145)
- [ODBC Driver 11](https://www.microsoft.com/en-us/download/details.aspx?id=36434), ONLY FOR MsSQL
- [mssql-extenmsion](https://github.com/Microsoft/msphpsql/releases/download/4.1.5-Windows/7.1.zip), ONLY FOR MsSQL

![DownloadList](https://raw.github.com/kokspflanze/pserverCMSFull/master/doc/images/download.png)

## Install dependencies 

Please install `vc_redist.x64.exe` or `vc_redist.x86.exe` and  `msodbcsql.msi` (if you want to use a MsSQL connection)

Continue with [Apache + PHP Setup](https://github.com/kokspflanze/pserverCMSFull/blob/master/doc/windows-setup/APACHE.md)
