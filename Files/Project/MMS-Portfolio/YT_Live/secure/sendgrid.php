<?

ini_set('display_errors',0);

include_once "/home/yelloa3s/public_html/Unirest/lib/Unirest.php";
include_once "/home/yelloa3s/public_html/sendgrid/lib/SendGrid.php";
SendGrid::register_autoloader();

try {
	$sendgrid = new SendGrid('kavitharjn', 'Kavitha2004');
	$mail = new SendGrid\Email(); 
	
	$From       = "communications@yellowtrainschool.com";
	$fromName  = "YT Communications Team";
	$mail->addTo($emailAddress)->
	setFromName($fromName)->
		   setFrom($From)->
		   setSubject($Subject)->
		   setHtml($MailContent);
	
	if(is_array($attachmentFile)) {
		foreach($attachmentFile as $vv){
			$mail->addAttachment($vv);
		}
	} elseif($attachmentFile!='') {
		$mail->addAttachment($attachmentFile);
	}
	if($additionalEmailAddress!='') $mail->addTo($additionalEmailAddress);
		
	$result = $sendgrid->web->send($mail);
	
	//print_r($result);
	
} catch(Exception $e) {
	print_r($e);
}
?>