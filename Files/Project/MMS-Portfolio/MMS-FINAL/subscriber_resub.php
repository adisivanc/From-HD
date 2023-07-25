<? 
	ob_start();
	session_start();
	include 'includes.php';
	$PageUrlArr=explode('/',$_SERVER['SCRIPT_NAME']);
	$curpage=$PageUrlArr[2];
	
	if($_REQUEST['type']=='S'){
		
		$rs_unsubscribe = SubscribeNewsletter::updateSubscribeNewsletterByField('status',$_REQUEST['type'],$_REQUEST['id']);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>You have successfully subscribed to this list</title>

<link type="text/css" rel="stylesheet" href="css/style.css" />
<link type="text/css" rel="stylesheet" href="css/responsive.css" />

</head>

<body style="background-color:#dddddd;">

<div class="subrmv_out">
    <div class="subrmv_inner">
    	<p>Thank You</p>
        <p style="background-color:#f5f5f5;">You've successfully re-subscribed to this list and you'll be hearing from us soon.</p>
    </div>
</div>


</body>
</html>