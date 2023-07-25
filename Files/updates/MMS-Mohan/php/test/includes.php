<?

require_once("config/config.php");

require_once("includes/functions.php");

require_once("classes/DatabaseConnection.php");


require_once("classes/FileUpload.php");
require_once("classes/dB.php");

require_once("classes/Table.php");
require_once("classes/Newsletter.php");
require_once('phpMailer/class.phpmailer.php');
require_once("classes/Admin.php");
require_once("classes/Contacts.php");
require_once("classes/contact.php");
require_once("classes/Speaker.php");
require_once("classes/SessionDtl.php");
require_once("classes/Users.php");


require_once("includes/Session.php");
require_once("includes/Paging.php");

require_once("includes/config.globals.php");
require_once("includes/Config.tbl.inc.php");
session_save_path("/tmp"); session_start();

ob_start();
session_start();
?>