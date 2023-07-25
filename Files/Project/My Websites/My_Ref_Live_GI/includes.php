<?php

// tables include
require_once("includes/Config.tbl.inc.php");
// configuration
require_once("config/config.php");

// database connection
require_once("classes/dB.php");
//require_once("classes/DatabaseConnection.php");
//require_once("classes/Table.php");

require_once('phpMailer/class.phpmailer.php');

// load basic support methods
require_once("includes/functions.php");
require_once("includes/Session.php");
require_once("classes/Contact.php");
//require_once("includes/DateTime.php");


 

ob_start();
session_start();
?>