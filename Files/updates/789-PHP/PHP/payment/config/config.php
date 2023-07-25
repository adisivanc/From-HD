<?

$dev_server = TRUE;
define("LOCAL", true);
session_start();

if ($dev_server) {

    // Dev Database credentials
    define("BA_DBHOST", "localhost");
    define("BA_DBUSER", "root");
    define("BA_DBPASSWORD", "mysql");
    define("BA_DBNAME", "newsletter");

    //Constants
    define ('BASE_URL', 'http://192.168.1.126/payment/');
	define ('BASE_ADMIN_URL', 'http://192.168.1.126/payment/admin/');
    define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/sp/email_templates/');
    define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "payment/") ;

} else {

    define("BA_DBHOST", "localhost");
    define("BA_DBUSER", "isvirone_pa");
    define("BA_DBPASSWORD", "AWEpTx(W&bws");
    define("BA_DBNAME", "isvirone_pa");  

    //Constants
    define ('BASE_URL', 'http://www.previewyourprojects.com/PA/');
	define ('BASE_ADMIN_URL', 'http://www.previewyourprojects.com/PA/admin');
	define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/sp/email_templates/');
    define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "PA/") ;

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
$max_file_size = $confval *100* 1024 * 1024; 
	
define("MAX_FILE_SIZE", $max_file_size);
define("MAX_FILE_SIZE_IN_MB", $confval . " MB");
define("SITE_TMP_DIR", SITE_DOCUMENT_ROOT.'uploads/tmp/');
define("HREF_TMP_DIR", SITE_HTTP.'uploads/tmp/');

define("NEWSLETTER_PATH",  SITE_DOCUMENT_ROOT.'uploads/newsletterfile/');
define("NEWSLETTER_HREF",  SITE_HTTP.'uploads/newsletterfile/');
define("NEWSLETTER_REL",  'uploads/newsletterfile/');

define("FROM_EMAIL", "kavitharjn@worldrheniumcongress.com");
define("TO_EMAIL", "kavitharjn@gmail.com");
define("SITE_EMAIL", "info@worldrheniumcongress.com");


?>