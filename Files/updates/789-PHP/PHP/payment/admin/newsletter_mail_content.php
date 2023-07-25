<?php

require('includes.php');

 if($_POST['nid']!=''){
	$newsletter_obj= new Newsletter();
	$newsletter_obj->Id=$_POST['nid'];
	$rs_selNewsletter = $newsletter_obj->getNewsletterDtl();
    if(count($rs_selNewsletter)>0) {
	foreach($rs_selNewsletter as $K=>$V) $$K = $V;			
	}
	
	$key = "rEgIsTrAtIoN";
	$rs_Link = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $ID, MCRYPT_MODE_CBC, md5(md5($key))));
	
	$Content = str_replace('{ISSUE_DATE}',date('M d, Y'),$Content);
	$Content = str_replace('{NEWS_IMAGES}',NEWS_IMAGES,$Content);
	$Content = str_replace('&lt;NEWS_IMAGES&gt;',NEWS_IMAGES,$Content);
	$Content = str_replace('{BASE_URL}',BASE_URL,$Content);
	$Content = str_replace('{ENCID}',$rs_Link,$Content);
	$Content = str_replace('{ID}',$ID,$Content);
	$Content = str_replace('{NAME}',$NAME,$Content);
	$Content = str_replace('{EMAIL}',$EMAIL,$Content);
	if($ADDRESS!='')
	$Content = str_replace('{ADDRESS}',$ADDRESS,$Content);
	if($MOBILE!='')
	$Content = str_replace('{MOBILE}',$MOBILE,$Content);
	$Content = str_replace('{URL}',$url,$Content);
	$Content = str_replace('{URL1}',$url1,$Content);
	$Content = str_replace('{URL2}',$url2,$Content);
	
	$Content = str_replace('&lt;URL&gt;',$url,$Content);
	$Content = str_replace('&lt;URL1&gt;',$url1,$Content);
	$Content = str_replace('&lt;URL2&gt;',$url2,$Content);
	
	$Content = str_replace('{N}',$nz,$Content);
	$Content = str_replace('{NC}',$ncz,$Content);
	$Content = str_replace('{NE}',$nez,$Content);
	$Content = str_replace('{W}',$wz,$Content);
	$Content = str_replace('{SZ}',$sz,$Content);
	
	$Content = str_replace('{USERNAME}',$username,$Content);
	$Content = str_replace('{PASSWORD}',$password,$Content);
	
	$Content = str_replace('{QID}',$QID,$Content);
	
	$Content = str_replace('{UNSUBSCRIBE_URL}',$unsubscribe_details,$Content);
	
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Newsletter</title>
</head>
<body>
<? echo stripslashes($Content); 


?>
</body>
</html>
