<?php

require_once("config/config.php");
require_once("includes/functions.php");

require_once("classes/FileUpload.php");
require_once("classes/dB.php");
require_once("classes/DatabaseConnection.php");
require_once("classes/Contact.php");
require_once("classes/SubscribeNewsletter.php");

require_once("includes/Session.php");
require_once("includes/Paging.php");
require_once("includes/config.globals.php");
require_once("includes/Config.tbl.inc.php");

require_once('phpMailer/class.phpmailer.php');
ob_start();
session_start();
?>