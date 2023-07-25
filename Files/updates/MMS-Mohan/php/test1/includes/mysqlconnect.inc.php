<?php
/******************************************
* Filename: mysqlconnect.inc.php
* Author: David Rubinstein
* Copyright: Correlsense, 2011

This file creates a db object.
*******************************************/

// DB connection
@$mysqli_dbconn = new mysqli(DEV_DBHOST,DEV_DBUSER,DEV_DBPASS,DEV_DBNAME);

//Check the connection
if ($mysqli_dbconn->connect_error) {
	$logger->Warning("../ba/includes/mysqlconnect.inc.php - MySQL connection error: $mysqli_dbconn->connect_errno - $mysqli_dbconn->connect_error");
}
?>
