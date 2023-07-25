<?
global $config;

define("LOCAL", true) ;
define("SUBDIR", LOCAL?"grocialize/":"grocialize/") ;
define("HOST_NAME", LOCAL?"192.168.1.126/":"www.mmsprojects.com/");
define("SITENAME", LOCAL?"192.168.1.126/grocialize/":"www.mmsprojects.com/grocialize/");
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]."/");
define("SITE_DOCUMENT_ROOT", DOCUMENT_ROOT . SUBDIR );

define('HTTP_GOOGLE_API','AIzaSyDHWQE5I-RBc5hU20czBVMSq0dViaDsbRQ');
define('HTTPS_GOOGLE_API','AIzaSyCx_aTv7ZHthpRmBnM9O0Qu0w5uwu6k3VU');
define("SERVER_NAME", $_SERVER["SERVER_NAME"]);
define("REQUEST_URI", $_SERVER["REQUEST_URI"]);




?>