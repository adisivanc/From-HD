<?

$dev_server = TRUE;
define("LOCAL", true);
session_start();

if ($dev_server) {

	// Dev Database credentials
	define("BA_DBHOST", "localhost");
	define("BA_DBUSER", "root");
	define("BA_DBPASSWORD", "mysql");
	define("BA_DBNAME", "lightronics");
	
	//Constants
	define ('BASE_URL', 'http://192.168.1.126/training/light/');
	define ('BASE_ADMIN_URL', 'http://192.168.1.126/training/light/admin/');
	define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/sp/email_templates/');
	define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "training/light/");

} else { /*

	define("BA_DBHOST", "Localhost");
	define("BA_DBUSER", "isvirtwo_isvir14");
	define("BA_DBPASSWORD", "IpE3.x5!tk-!");
	define("BA_DBNAME", "isvirtwo_isvir2014");  

    //Constants
	define ('BASE_URL', 'http://www.stemiindia2014.com/');
	define ('BASE_ADMIN_URL', 'http://www.stemiindia2014.com/admin');
	define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/sp/email_templates/');
	define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "/") ; 
	*/

} // End if dev server 

?>