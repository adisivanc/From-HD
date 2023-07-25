<?
Class Contact{

	function insertContact($name, $email_address, $website, $message)
	{
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		
		$query="INSERT INTO `".TBL_CONTACT."`(`name`,`email_address`,`website`,`message`,`added_date`) VALUES ('$name','$email_address','$website','".addslashes($message)."','$sqlDateTime')";			
		$insertId = dB::insertSql($query);
		
	    if($insertId>0) {
			Contact::sendNotificationEmailtoAdmin($name, $email_address, $website, $message);
			Contact::sendNotificationEmailtoUser($name, $email_address);
			return $insertId; 
		} return 0;
		
	}
	
	function sendNotificationEmailtoAdmin($name, $email_address, $website, $message)
	{
		//MAIL TO ADMIN
		$subject = "[MASTERMIND SOLUTIONS] User Enquiry Detail";
		$message = '		
					<table width="80%" border="0" cellspacing="0" cellpadding="10">
					  <tr>
						<td colspan="2" valign="top">Dear Admin</td>
					  </tr>
					  <tr>
						<td colspan="2" valign="top">A new member has been subscribed successfully. The details are below,</td>
					  </tr>
					  <tr>
						<td valign="top"> Name </td><td valign="top"> : '.$name.'</td>
					  </tr>
					  <tr>
						<td valign="top"> Email Address </td><td valign="top"> : '.$email_address.'</td>
					  </tr>
					  <tr>
						<td valign="top"> Website </td><td valign="top"> : '.$website.'</td>
					  </tr>
					  <tr>
						<td valign="top"> Message </td><td valign="top"> : '.$message.'</td>
					  </tr>
					</table>';
						
		$headers = "From: MASTERMIND SOLUTIONS <info@mastermindsolutionsonline.com>\r\n"; 
		$headers .= "Reply-To: <".$email_address.">\r\n";
		$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
		$headers .= "Organization: VE LOSE\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";
		@mail('mohanmcakasc@gmail.com', $subject, $message, $headers);
	}
	
	
	function sendNotificationEmailtoUser($name, $email_address)
	{
		$Subject = "[MASTERMIND SOLUTIONS] Thank you for your inquiry";
		
		ob_start();
		include 'thankyoumail_user.php';	
		$Message = ob_get_contents();
		ob_clean();
		
		$mail = new PHPMailer();
		$mail->IsHTML(true);
		$mail->From       = "info@mastermindsolutionsonline.com";
		$mail->FromName   = "MASTERMIND SOLUTIONS";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		$mail->AddReplyTo('info@mastermindsolutionsonline.com','MASTERMIND SOLUTIONS');
		$mail->AddAddress('mohanmcakasc@gmail.com', 'mohanmcakasc@gmail.com');
		//$mail->AddAddress($email_address, $email_address); 
		$mail->Send();
	}
	
}



?>