<? 
	ob_start();
	session_start();
	include 'includes.php';
	$PageUrlArr=explode('/',$_SERVER['SCRIPT_NAME']);
	$curpage=$PageUrlArr[2];
	
	if($_REQUEST['type']=='U'){
		
		$rs_unsubscribe = SubscribeNewsletter::updateSubscribeNewsletterByField('status',$_REQUEST['type'],$_REQUEST['id']);
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>You have been successfully removed from this subscriber list</title>

<link type="text/css" rel="stylesheet" href="css/style.css" />
<link type="text/css" rel="stylesheet" href="css/responsive.css" />

</head>

<body style="background-color:#dddddd;">

<div class="subrmv_out">
    <div class="subrmv_inner">
    	<p>Thank You</p>
        <p>You have been successfully removed from this subscriber list. You will no longer hear from us.</p>
        <p><img src="images/ques_mark.png" align="absmiddle" style="margin-right:5px;"/>Did you unsubscribe by accident? 
        <a href="http://192.168.1.126/mms/subscriber_resub.php?type=S&id=<?=$_REQUEST['id']?>" target="_blank"><span>Click here to re-subscribe.</span></a> </p>	
    </div>
</div>


</body>
</html>