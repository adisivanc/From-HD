<?

require_once("config/config.php");

require_once("includes/functions.php");
require_once("includes/Session.php");
require_once("includes/Config.tbl.inc.php");

require_once("classes/DatabaseConnection.php");
require_once("classes/FileUpload.php");
require_once("classes/dB.php");
require_once("classes/Registration.php");

require_once("includes/Paging.php");
require_once("includes/config.globals.php");

session_save_path("/tmp"); 
session_start();
ob_start();
session_start();

?>