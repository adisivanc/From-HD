<?php

// tables include
require_once("includes/Config.tbl.inc.php");
// configuration
require_once("config/config.php");

// load basic support methods
require_once("includes/functions.php");

// database connection
require_once("classes/DatabaseConnection.php");

// database connection
require_once("classes/FileUpload.php");
require_once("classes/dB.php");
require_once("classes/Table.php");

require_once("classes/Registration.php");

// load  additional helper functions
require_once("includes/Session.php");

session_start();
ob_start();?>