<?
//include "Config.inc.php";
//ini_set("display_errors", 1);
if(!$ConfigIncluded)
{
	include_once "includes.php";
}

function SetUpHtAccess(){

	$siteprefix = LOCAL ? '/GI/' : '/';
	
	$newline="\n";
	
	$SitePages = array('index.php','contact.php','aboutus.php','wallputty.php','dealer.php');
	
	//$strtobewritten = 'AddHandler application/x-httpd-php54s .php'.$newline;
	
	$strtobewritten = 'Options +FollowSymLinks'.$newline.'RewriteEngine On'.$newline.'RewriteBase /'.$newline.$newline ;
	
	//$strtobewritten .= 'php_value upload_max_filesize 10M'.$newline.$newline;
	//$strtobewritten .= 'php_value post_max_size 10M'.$newline.$newline;
	
	foreach($SitePages as $K=>$V){
		$strtobewritten .= "RewriteRule ^".getSeoUrl(array('pn'=>$V, 'np'=>1, 'htaccess'=>1)).'$ '.$siteprefix.$V.'?%{QUERY_STRING} [QSA,L]'.$newline;
	}
	
	/* =====================================================
	  	 ------ Passing Parameters/Type to the page  ---- 
	   =====================================================  */


	//Images & CSS & JS
	
	$strtobewritten .=$newline.$newline;
	
	$strtobewritten .= 'RewriteCond %{REQUEST_FILENAME} !-f'.$newline;
	$strtobewritten .= 'RewriteRule ^'.$siteprefix.'(.+)/css/(.*)$ '.$siteprefix.'css/$2 [QSA,L]'.$newline;
	
	$strtobewritten .= 'RewriteCond %{REQUEST_FILENAME} !-f'.$newline;	
	$strtobewritten .= 'RewriteRule ^'.$siteprefix.'(.+)/secure/images/(.*)$ '.$siteprefix.'secure/images/$2 [QSA,L]'.$newline;	
	
	$strtobewritten .= 'RewriteCond %{REQUEST_FILENAME} !-f'.$newline;	
	$strtobewritten .= 'RewriteRule ^'.$siteprefix.'(.+)/images/(.*)$ '.$siteprefix.'images/$2 [QSA,L]'.$newline;
	
	$strtobewritten .= 'RewriteCond %{REQUEST_FILENAME} !-f'.$newline;
	$strtobewritten .= 'RewriteRule ^'.$siteprefix.'(.+)/js/(.*)$ '.$siteprefix.'js/$2 [QSA,L]'.$newline;
		
	$filename = SITE_DOCUMENT_ROOT.".htaccess";
			
	@chmod($filename, 0777);
			
	if(!$handle=fopen($filename, "w"))
		echo "Not written";
	
	fwrite($handle, $strtobewritten);
	fclose($handle);
	
	@chmod($filename, 0777);

}
SetUpHtAccess();
?>