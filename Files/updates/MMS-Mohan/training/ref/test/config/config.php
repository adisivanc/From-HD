<?

$dev_server = TRUE;
define("LOCAL", true);
session_start();
if ($dev_server) {

    define("BA_DBHOST", "localhost");
    define("BA_DBUSER", "root");
    define("BA_DBPASSWORD", "mysql");
    define("BA_DBNAME", "cl");

    define('BASE_URL', 'http://192.168.1.126/CL/');
	define('BASE_ADMIN_URL', 'http://192.168.1.126/CL/admin/');
    define('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "CL/") ;

} 
else
{

	define("BA_DBHOST", "localhost");
	define("BA_DBUSER", "mmsproje_knotes");
	define("BA_DBPASSWORD", "JogRenegePumaKiosks57");
	define("BA_DBNAME", "mmsproje_nn");
	
	define('BASE_URL', 'http://www.mmsprojects.com/CL/');
	define('BASE_ADMIN_URL', 'http://www.mmsprojects.com/CL/admin/');
    define('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "CL/");
}

define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]."/");
define("SITE_DOCUMENT_ROOT", DOCUMENT_ROOT . SUBDIR );
define("HTTP_HOST", $_SERVER["HTTP_HOST"]);
define("REMOTE_ADDR", $_SERVER["REMOTE_ADDR"]);
define("SERVER_ADDR", $_SERVER["SERVER_ADDR"]);
define("SERVER_NAME", $_SERVER["SERVER_NAME"]);
define("REQUEST_URI", $_SERVER["REQUEST_URI"]);
define("SCRIPT_NAME", $_SERVER["SCRIPT_NAME"]);
define("PHP_SELF", $_SERVER["PHP_SELF"]);
define("PATH_ROOT", dirname(PHP_SELF)=='/'?'':dirname(PHP_SELF));
define("FILE_NAME", basename(PHP_SELF));
define("SITE_HTTP", BASE_URL);
define("SITE_HTTPS", BASE_URL);
define("NEWS_IMAGES", BASE_URL.'newsletter/images/');


$confval = ini_get("upload_max_filesize");
$confval = substr($confval,0,strlen($confval)-1);
	
$max_file_size = $confval * 1024 * 1024; 
	
define("MAX_FILE_SIZE", $max_file_size);
define("MAX_FILE_SIZE_IN_MB", $confval . " MB");
	
unset($confval);
unset($max_file_size);


// Get Instant Qoute

$GLOBALS['ProductLaunches'] = array('Media Events','Brand Experiences','Press Conferences');

$GLOBALS['SpecialEvents'] = array('Company Celebrations','Themed Events','Gala Dinners','Charity Events');

$GLOBALS['Conferences'] = array('Conference Organising'=>array('Conference Planning','Registration Management','Call For Papers','Exhibition Management','On-site Management'),'Online Solutions'=>array('Online Registration','Online Abstract Management','Conference and Event Websites','Mobile'),'Marketing Solutions'=>array('Graphic Design','Email Marketing'),'Association Services'=>array('Membership Management','Website / Marketing and Communication','Meeting Admin / Secretariat'));

$GLOBALS['HospitalityOutdoor'] = array('Public Events and Festivals','Sporting Tournaments','Corporate Family Fun Days','Team Building Activities');

$GLOBALS['ExhibitionsTradeshows'] = array('Stand Concept and Construction','Transportation and Installation','Audio Visual Requirements','Furniture and Equipment','Promotional Items');

$GLOBALS['GovernmentEvents'] = array('National Forums','Round Table Meetings','Departmental Road shows');



?>