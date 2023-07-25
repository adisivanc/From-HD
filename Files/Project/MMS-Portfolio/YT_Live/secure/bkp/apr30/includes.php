<?php

// tables include
require_once("../includes/Config1.tbl.inc.php");
// configuration
require_once("../config/config1.php");

// database connection
require_once("../classes1/dB.php");
require_once("../classes1/DatabaseConnection.php");
require_once("../classes1/FileUpload.php");
require_once("../classes1/Table.php");

require_once("../classes1/User.php");
require_once("../classes1/School.php");
require_once("../classes1/Student.php");
require_once("../classes1/Teacher.php");
require_once("../classes1/Grade.php");
require_once("../classes1/Subject.php");
require_once("../classes1/Transportation.php");
require_once("../classes1/Events.php");
require_once("../classes1/EventSession.php");
require_once("../classes1/EventComments.php");
require_once("../classes1/EventPhotos.php");
require_once("../classes1/EventPhotoComments.php");
require_once("../classes1/NewsletterSub.php");
require_once("../classes1/EventRegistration.php");
require_once("../classes1/Circulars.php");
require_once("../classes1/Contact.php");
require_once("../classes1/Blog.php");
require_once("../classes1/Circulars.php");
require_once("../classes1/StudentBusRoute.php");

// load basic support methods
require_once("../includes/functions.php");
require_once("../includes/Session.php");

require_once('../phpMailer/class.phpmailer.php'); 

ob_start();
session_start();
?>