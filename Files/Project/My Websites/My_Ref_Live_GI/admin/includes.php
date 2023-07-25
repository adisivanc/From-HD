<?php
// tables include
require_once("../includes/Config.tbl.inc.php");
// configuration
require_once("../config/db_config.php");
// load basic support methods
require_once("../includes/functions.php");
require_once("../includes/payment_functions.php");
require_once("../includes/mail_functions.php");
require_once("../includes/view_functions.php");
// database connection
require_once("../classes/DatabaseConnection.php");
require_once("../classes/dB.php");
//classes
require_once("../classes/Users.php");
require_once("../classes/Leads.php");
require_once("../config/config.php");
session_start();
ob_start();
?>