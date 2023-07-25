<?

$dev_server = TRUE;
define("LOCAL", true);
session_start();

if ($dev_server) {

    // Dev Database credentials
    define("BA_DBHOST", "localhost");
    define("BA_DBUSER", "root");
    define("BA_DBPASSWORD", "mysql");
    define("BA_DBNAME", "php_training");

    //Constants
    define ('BASE_URL', 'http://192.168.1.126/PC/');
	define ('BASE_ADMIN_URL', 'http://192.168.1.126/PC/admin/');
    define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/pc/email_templates/');
    define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define ("SUBDIR", "PC/");
	
	// Stripe Key
	define ("JS_STRIPE_KEY", "pk_test_k21sQiy2OCpGJctHwLb9DgHq");
	define ("PHP_STRIPE_KEY", "sk_test_5gyV14GfK4cHunvibjY5NXnj");
	define ("PAYMENT_RECIPIENT_ID", "rp_15O4BwLEoQx8e6N1BY0IDvlV");
	define ("PAYMENT_BANK_ID", "ba_15O4DZLEoQx8e6N1HjTTLUwC");

} else {

    define("BA_DBHOST", "localhost");
    define("BA_DBUSER", "private_car");
    define("BA_DBPASSWORD", "BwaKoE[epwT[");
    define("BA_DBNAME", "private_car");  

    //Constants
    define ('BASE_URL', 'http://www.privatecarapp.com/');
	define ('BASE_SURL', 'https://privatecarapp.com/');
	define ('BASE_ADMIN_URL', 'http://www.privatecarapp.com/admin');
	define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/sp/email_templates/');
    define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define ("SUBDIR", "/");
	
	// Stripe Key
	define ("JS_STRIPE_KEY", "pk_live_S4c1JPccziUyrQlJRJS9LvqP");
	define ("PHP_STRIPE_KEY", "sk_live_Pg8tUfavGR7DVWNeQORq6kvg");
	define ("PAYMENT_RECIPIENT_ID", "SERVER");
	define ("PAYMENT_BANK_ID", "SERVER");

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
define("NEWS_IMAGES", BASE_URL.'newsletter/images/');

$confval = ini_get("upload_max_filesize");
$confval = substr($confval,0,strlen($confval)-1);
$max_file_size = $confval *100* 1024 * 1024; 
	
define("MAX_FILE_SIZE", $max_file_size);
define("MAX_FILE_SIZE_IN_MB", $confval . " MB");
define("SITE_TMP_DIR", SITE_DOCUMENT_ROOT.'uploads/tmp/');
define("HREF_TMP_DIR", SITE_HTTP.'uploads/tmp/');


?>