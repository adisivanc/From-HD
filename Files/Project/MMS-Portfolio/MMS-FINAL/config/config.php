<?

$dev_server = TRUE;
define("LOCAL", true);
session_start();

if ($dev_server) {

	// Dev Database credentials
	define("BA_DBHOST", "localhost");
	define("BA_DBUSER", "root");
	define("BA_DBPASSWORD", "mysql");
	define("BA_DBNAME", "mms");
	
	//Constants
	define ('BASE_URL', 'http://192.168.1.126/mms/');
	define ('BASE_ADMIN_URL', 'http://192.168.1.126/mms/admin/');
	define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/sp/email_templates/');
	define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "mms/");

} else {

	define("BA_DBHOST", "Localhost");
	define("BA_DBUSER", "isvirtwo_isvir14");
	define("BA_DBPASSWORD", "IpE3.x5!tk-!");
	define("BA_DBNAME", "isvirtwo_isvir2014");  

    //Constants
	define ('BASE_URL', 'http://www.mastermindsolutionsonline.com/');
	define ('BASE_ADMIN_URL', 'http://www.mastermindsolutionsonline.com/admin');
	define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/sp/email_templates/');
	define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "/") ;

} // End if dev server 

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
define("SITE_TMP_DIR", SITE_DOCUMENT_ROOT.'uploads/tmp/');
define("HREF_TMP_DIR", SITE_HTTP.'uploads/tmp/');


?>