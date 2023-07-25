<?php
$DB_SERVER ='localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = 'mysql';
$DB_DATABASE = 'test_img';
$db_connect = mysql_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD);
$db_select = mysql_select_db($DB_DATABASE,$db_connect);

?>