<?

include_once "/home/worldoap/public_html/Unirest/lib/Unirest.php";
include_once "/home/worldoap/public_html/sendgrid/lib/SendGrid.php";

SendGrid::register_autoloader();
$sendgrid = new SendGrid('kavitharjn', 'kavitha');
$mail = new SendGridEmail(); 

$From       = "kavitharjn@worldrheniumcongress.com";
$fromName  	= "Online Co-ordinator";
$mail->addTo($emailAddress)->
setFromName($fromName)->
       setFrom($From)->
       setSubject($Subject)->
       setHtml($MailContent);

if(is_array($attachmentFile)) {
	foreach($attachmentFile as $vv){
		$mail->addAttachment($vv);
	}
} elseif($attachmentFile!='' && $attachmentFile!='undefined') {
	$mail->addAttachment($attachmentFile);
}
if($additionalEmailAddress!='')  $mail->addTo($additionalEmailAddress);
	
$sendgrid->web->send($mail);

?>
