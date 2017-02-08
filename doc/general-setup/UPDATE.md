# How to update

if you login and go to the admin panel you see the latest tags of each main module of the CMS.

![ScreenShot](https://github.com/kokspflanze/pserverCMSFull/blob/master/doc/images/ADMIN_OVERVIEW_MODULES.png)

if you see some changes, please go to the command line to the pserver-cms directory.

````bash
php composer.phar selfupdate
php composer.phar update
````

than the update run.

you have to check the change log of the versions too, if you have to change smth else.

like changes in the ACL, or in the db-shema.

for db-shema change you have to call following

````bash
php ./vendor/doctrine/doctrine-module/bin/doctrine-module orm:schema-tool:update  --dump-sql
````

that will give you the queries you have to exec on the db.