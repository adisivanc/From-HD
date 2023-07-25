<?
include "includes.php";
ini_set("display_errors", 1);
ini_set('max_execution_time', 500000000000);

$query="select * from `newsletter_log` where Sent='N'";
$rs_mails = dB::mExecuteSql($query);

if(count($rs_mails)>0) {
	
	$rs_mails = $rs_mails[0];
	
	$newsletter_obj= new Newsletter();
	$newsletter_obj->Id=$rs_mails->NewsletterId;
	$rs_selectnewsletter = $newsletter_obj->getNewsletterDtl();	
	
	$mailIdsArr = explode("~", $rs_mails->Members);
	$totalCnt = count($mailIdsArr);
	foreach($mailIdsArr as $k=>$v) {
		$emailid = explode("-", $v);
		echo $emailid[0]."=".$emailid[1]; echo "<br>";
		
		
		$From       = FROM_EMAIL;
		$fromName   = FROM_NAME;
		$Subject    = $rs_selectnewsletter->Subject;
		$emailAddress = trim($emailid[0]);
		$email_type = trim($emailid[1]);
		
		if(is_file(NEWSLETTER_PATH.$rs_selectnewsletter->File)){
			$attachmentFile = NEWSLETTER_PATH.$rs_selectnewsletter->File;
		}
		
		$unsubscribe_details="";
		$unsubemailaddress = $emailid[0]."||".$email_type;
		$unsubemail = base64_encode($unsubemailaddress);
		$unsubscribe_details = BASE_URL."unsubscribe.php?id=".$unsubemail;
		
		ob_start();
		$_POST['nid'] = $rs_mails->NewsletterId; 
		include "newsletter_mail_content.php";					
		$MailContent=ob_get_contents();
		ob_end_clean();
		
		//$emailAddress = 'kavitharjn@gmail.com';
		include "sendgrid.php";
		//exit();
		echo $emailid[0]."...".$totalCnt;
		echo '<hr />';
		
	}
	
	
	
	Circulars::updateCircularLogStatus($rs_mails->Id, 'Y');
	
	$From       = FROM_EMAIL;
	$fromName   = FROM_NAME;
	$Subject    = "[YT] Cron emails sent for ".$rs_selectnewsletter->Name;
	$MailContent= " The newsletter [".$rs_selectnewsletter->Name."] email sent to the total count of ".$totalCnt." emails";
	
	$emailAddress = 'kavitharjn@gmail.com';
	//include "sendgrid.php";		
	//exit();
		
}


?>