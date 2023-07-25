<?
global $config;

define("LOCAL", true) ;
define("SUBDIR", LOCAL?"stemi2014/":"stemi2014/") ;
define("HOST_NAME", LOCAL?"192.168.1.126/":"http://www.stemiindia2014.com/");
define("SITENAME", LOCAL?"192.168.1.126/stemi2014/":"http://www.stemiindia2014.com/");
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]."/");
define("SITE_DOCUMENT_ROOT", DOCUMENT_ROOT . SUBDIR );

define("SERVER_NAME", $_SERVER["SERVER_NAME"]);
define("REQUEST_URI", $_SERVER["REQUEST_URI"]);


?>