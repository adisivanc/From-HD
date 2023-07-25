<?php

require_once("config/config.php");

require_once("includes/functions.php");

//require_once("classes/FileUpload.php");
require_once("classes/dB.php");
require_once("classes/DatabaseConnection.php");
require_once("classes/Table.php");
//require_once("classes/Newsletter.php");
//require_once("classes/Faculty.php");
require_once("classes/Users.php");
//require_once("classes/Coupon.php");
//require_once("classes/Registration.php");
//require_once("classes/Sponsor.php");
//require_once("classes/SponsorTypes.php");
//require_once("classes/Schedule.php");
//require_once("classes/Group.php");

require_once("includes/Session.php");
require_once("includes/Paging.php");
require_once("includes/config.globals.php");
require_once("includes/Config.tbl.inc.php");

//require_once('phpMailer/class.phpmailer.php');

session_start();
ob_start();
?>