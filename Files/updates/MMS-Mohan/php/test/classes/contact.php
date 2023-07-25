<?
  class Contact
  {
     
	 var $Name;
	 var $Email;
	 var $ContactNumber;	 
	 var $Subject;
	 var $Reason;

	function insertContact()
	{	
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		
	  $query="INSERT INTO `".TBL_CONTACTUS."`(`Name`,`Email`,`ContactNumber`,`Subject`,`Reason`,`AddedDate`) VALUES ('$this->Name','$this->Email','$this->ContactNumber','$this->Subject','$this->Reason','$sqlDateTime')";			
		$insertId=dB::insertSql($query);
	 
	   if($insertId>0) {
		$this->sendNotificationEmailtoAdmin();
		return $insertId; } return 0;
	}
	
	
	function sendNotificationEmailtoAdmin()
	{
	   $siteEmail="info@womensimagingindia.com";
		$headers = "From: Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n"; 
		$headers .= "Reply-To: Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n";
		$headers .= "Return-Path: Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n";
		$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
		$headers .= "Organization: 	WIO 2013\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
		$headers .= "X-Originating-IP: [69.160.61.146]\r\n";
		$headers .= "X-Sender-IP:  69.160.61.146\r\n";  
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";
		$Subject='[WIO] User Enquiry Details';
	    $Message = '
			Hi Admin,
			A user has registered their enquiry details . The details  are listed below:
			Name :'.$this->Name.'<br/>
			Email:'.$this->Email.'<br/>
			Subject:'.$this->Subject.'<br/>
			Reason:'.$this->Reason.'';
		        $mail             = new PHPMailer();
				$mail->IsHTML(true);
				$mail->From       = $this->Email;
				$mail->FromName   = $this->Email;
				$mail->Subject    = $Subject;
				$mail->MsgHTML($Message);
				$mail->AddReplyTo($this->Email,  $this->Email);
				$mail->AddAddress('testmay88@gmail.com','testmay88@gmail.com');
				$mail->Send();
}
	
	
	
  }
  
?>