<?

$dev_server = TRUE;
define("LOCAL", true);

ini_set('display_errors',1);
//$dev_server = false;
//define("LOCAL", false);
session_start();
if ($dev_server) {

    define("BA_DBHOST", "localhost");
    define("BA_DBUSER", "root");
    define("BA_DBPASSWORD", "mysql");
    define("BA_DBNAME", "int_test");

    //Constants
    define ('BASE_WI_URL', 'http://192.168.1.126/Training/mohan/training/PHP/test1/');
/*	define ('BASE_WI_ADMIN_URL', 'http://192.168.1.126/WI/admin/');
    define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/WI/email_templates/');
    define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "WI/") ;
*/	
} else {
	
/*	define("BA_DBHOST", "118.139.179.50");
	define("BA_DBUSER", "Wimaging");
	define("BA_DBPASSWORD", "Yq8dT@h5U");
	define("BA_DBNAME", "Wimaging");  
	
	//Constants
	define ('BASE_WI_URL', 'http://www.womensimagingindia.com/');
	define ('BASE_WI_ADMIN_URL', 'http://www.womensimagingindia.com/admin');
	define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/sp/email_templates/');
	define ('BASE_WI_URL', 'http://www.womensimagingindia.com/');
	define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "/") ;
*/
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
define("SITE_HTTP", BASE_WI_URL);
define("SITE_HTTPS", BASE_WI_URL);
define("NEWS_IMAGES", BASE_WI_URL.'newsletter/images/');



$confval = ini_get("upload_max_filesize");
$confval = substr($confval,0,strlen($confval)-1);
$max_file_size = $confval * 1024 * 1024; 


	
define("MAX_FILE_SIZE", $max_file_size);
define("MAX_FILE_SIZE_IN_MB", $confval . " MB");
define("SITE_TMP_DIR", SITE_DOCUMENT_ROOT.'uploads/tmp/');
define("HREF_TMP_DIR", SITE_HTTP.'uploads/tmp/');

define("IMPORT_FILE_PATH",  SITE_DOCUMENT_ROOT.'uploads/ImportList/');
define("IMPORT_FILE_HREF",  SITE_HTTP.'uploads/ImportList/');
define("IMPORT_FILE_REL",  'uploads/ImportList/');


define("SPEAKER_PATH",  SITE_DOCUMENT_ROOT.'uploads/speaker/');
define("SPEAKER_HREF",  SITE_HTTP.'uploads/speaker/');
define("SPEAKER_REL",  'uploads/speaker/');


define("FLAG_PATH",  SITE_DOCUMENT_ROOT.'uploads/flags/');
define("FLAG_HREF",  SITE_HTTP.'uploads/flags/');
define("FLAG_REL",  'uploads/flags/');




?>