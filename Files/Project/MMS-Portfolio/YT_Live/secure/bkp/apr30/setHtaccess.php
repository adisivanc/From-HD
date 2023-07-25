<?
//include "Config.inc.php";
//ini_set("display_errors", 1);
if(!$ConfigIncluded)
{
	include_once "includes.php";
}

function SetUpHtAccess(){

	$siteprefix = LOCAL ? '/YT/' : '/';
	
	$newline="\n";
	
	$SitePages = array('index.php','yt_grade_school.php','curriculum.php','contact.php','free_human_being.php','yt_fundamentals.php','teacher.php','yt_rhythm.php','yt_methodology.php','yt_practices.php','belief.php','press.php','videos.php','faq.php','joinus.php','newsletter/indian_rollers.php','newsletter/drongos.php');
	
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

	$rs_blogs = Blog::getAllBlogPost();
	
	if(count($rs_blogs)>0) {
		foreach($rs_blogs as $ek=>$ev) {
			$strtobewritten .=$newline.$newline;
			$seolink = getSeoUrl(array('pn'=>'blog-details.php','BlogId'=>$ev->id,'htaccess'=>1));
			$strtobewritten .= "RewriteRule ^".$seolink.'$ '.$siteprefix.'blog-details.php?BlogId='.$ev->id.'%{QUERY_STRING} [QSA,L]'.$newline;
		}
	}

	
	//$eventTypes = array('events','gallery','reg');
	$eventTypes = array('events','gallery');
		
	foreach($eventTypes as $K=>$V) {
		$strtobewritten .=$newline.$newline;
		$seolink = getSeoUrl(array('pn'=>'funstop.php','Type'=>$V,'htaccess'=>1));
		$strtobewritten .= "RewriteRule ^".$seolink.'$ '.$siteprefix.'funstop.php?Type='.$V.'%{QUERY_STRING} [QSA,L]'.$newline;
	}
	
	$rs_events = Events::getAllEvents();
	
	if(count($rs_events)>0) {
		foreach($rs_events as $ek=>$ev) {
			$strtobewritten .=$newline.$newline;
			$seolink = getSeoUrl(array('pn'=>'funstop.php','Type'=>'reg','EventId'=>$ev->id,'htaccess'=>1));
			$strtobewritten .= "RewriteRule ^".$seolink.'$ '.$siteprefix.'funstop.php?Type=reg&EventId='.$ev->id.'%{QUERY_STRING} [QSA,L]'.$newline;
		}
	}
	
	$strtobewritten .=$newline.$newline;
	$seolink = getSeoUrl(array('pn'=>'funstop.php','Type'=>'reg','RegStatus'=>"success",'htaccess'=>1));
	$strtobewritten .= "RewriteRule ^".$seolink.'$ '.$siteprefix.'funstop.php?Type=reg&RegStatus=success%{QUERY_STRING} [QSA,L]'.$newline;

	/*$strtobewritten .=$newline.$newline;
	$seolink = getSeoUrl(array('pn'=>'funstop.php','Type'=>'gallery','htaccess'=>1));
	$strtobewritten .= "RewriteRule ^".$seolink.'$ '.$siteprefix.'funstop.php?Type=gallery%{QUERY_STRING} [QSA,L]'.$newline;
	
	$strtobewritten .=$newline.$newline;
	$seolink = getSeoUrl(array('pn'=>'funstop.php','Type'=>'reg','htaccess'=>1));
	$strtobewritten .= "RewriteRule ^".$seolink.'$ '.$siteprefix.'funstop.php?Type=reg%{QUERY_STRING} [QSA,L]'.$newline;


	$strtobewritten .=$newline.$newline;
	$seolink = getSeoUrl(array('pn'=>'funstop.php','Type'=>'reg','EventId'=>'','htaccess'=>1));
	$strtobewritten .= "RewriteRule ^".$seolink.'$ '.$siteprefix.'funstop.php?Type=reg&EventId=%{QUERY_STRING} [QSA,L]'.$newline;*/
	
	
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