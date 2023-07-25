<?

$dev_server = FALSE;
define("LOCAL", false);
session_start();

if ($dev_server) {

    // Dev Database credentials
    define("BA_DBHOST", "localhost");
    define("BA_DBUSER", "root");
    define("BA_DBPASSWORD", "mysql");
    define("BA_DBNAME", "green_india");

    //Constants
    define ('BASE_URL', 'http://192.168.1.126/GI/');
	define ('BASE_ADMIN_URL', 'http://192.168.1.126/GI/admin/');
    define ('ERROR_EMAIL_ADDRESS', 'kavitharjn@gmail.com');
	define ("SUBDIR", "GI/");

} else {
	
    // Dev Database credentials
    //define("BA_DBHOST", "localhost");
    //define("BA_DBUSER", "root");
    //define("BA_DBPASSWORD", "mysql");
    //define("BA_DBNAME", "green_india");

    //Constants
    define ('BASE_URL', 'http://192.168.1.126/GI/');
	define ('BASE_ADMIN_URL', 'http://192.168.1.126/GI/admin/');
    define ('ERROR_EMAIL_ADDRESS', 'kavitharjn@gmail.com');
	define ("SUBDIR", "GI/");
	

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
define("SITE_HTTPS", BASE_SURL);
?>