<?
global $config;

define("LOCAL", true) ;
define("SUBDIR", LOCAL?"training/light/":"training/light/") ;
define("HOST_NAME", LOCAL?"192.168.1.126/":"http://www.test.com/");
define("SITENAME", LOCAL?"192.168.1.126/training/light/":"http://www.test.com/");
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]."/");
define("SITE_DOCUMENT_ROOT", DOCUMENT_ROOT . SUBDIR );

define("SERVER_NAME", $_SERVER["SERVER_NAME"]);
define("REQUEST_URI", $_SERVER["REQUEST_URI"]);


?>