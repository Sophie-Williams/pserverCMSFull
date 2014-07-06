<?php
$DB_TYPE = 'dblib'; //Type of database<br>
$DB_HOST = '80.86.81.16:5465'; //Host name<br>
$DB_USER = 'sa'; //Host Username<br>
$DB_PASS = 'Betze1989'; //Host Password<br>
$DB_NAME = 'SRO_VT_ACCOUNT'; //Database name<br><br>

$dbh = new PDO("$DB_TYPE:host=$DB_HOST; dbname=$DB_NAME;", $DB_USER, $DB_PASS);