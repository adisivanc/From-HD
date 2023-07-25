<?php
 
// tables include
require_once("../includes/Config1.tbl.inc.php");
// configuration
require_once("../config/config1.php");

// database connection
require_once("../classes/dB.php");
require_once("../classes/DatabaseConnection.php");
require_once("../classes/FileUpload.php");
require_once("../classes/Table.php");
require_once("../classes/User.php");
require_once("../classes/School.php");
require_once("../classes/Student.php");
require_once("../classes/Teacher.php");
require_once("../classes/Grade.php");
require_once("../classes/Subject.php");
require_once("../classes/Transportation.php");
require_once("../classes/Events.php");
require_once("../classes/EventSession.php");
require_once("../classes/EventComments.php");
require_once("../classes/EventPhotos.php");
require_once("../classes/EventPhotoComments.php");
require_once("../classes/NewsletterSub.php");
require_once("../classes/EventRegistration.php");
require_once("../classes/Circulars.php");
require_once("../classes/Contact.php");
require_once("../classes/Blog.php");
require_once("../classes/Circulars.php");
require_once("../classes/StudentBusRoute.php");
require_once("../classes/UserLog.php");
require_once("../classes/Calendar.php");
require_once("../classes/LeaveDetails.php");
require_once("../classes/Communication.php");
require_once("../classes/Download.php");
require_once("../classes/StudentDiary.php");
// load basic support methods
require_once("../includes/functions.php");
require_once("../includes/Session.php");
require_once("../includes/calendarFunctions.php");
require_once("../includes/DateTime.php");
require_once('../phpMailer/class.phpmailer.php'); 

ob_start();
session_start();
?>