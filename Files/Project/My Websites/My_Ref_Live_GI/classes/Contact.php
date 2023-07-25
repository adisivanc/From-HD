<?
Class Contact{


	static function sendContactEmailtoAdmin($params=array())  
	{
		if(count($params)>0) foreach($params as $K=>$V){   $$K=$V; }
				
		$Subject = "[GI] Contact Detail";
		
		ob_start();
		$fileName= 'contact_mail.php';
		include "mail_template.php";
		$Message = ob_get_contents();
		
 		ob_clean();
		 
 		$mail = new PHPMailer();
		$mail->IsHTML(true);
	    $mail->From       = 'sales@greenindiaecoproducts.com';
		$mail->FromName   = "Green India Eco Products";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		// $mail->AddAddress('adisivanc@gmail.com','adisivanc@gmail.com');  
		$mail->AddAddress('sales@greenindiaecoproducts.com','sales@greenindiaecoproducts.com');
		$mail->Send();
	}



	static function sendEmailtoDealer($params=array())  
	{
		if(count($params)>0) foreach($params as $K=>$V){   $$K=$V; }
				
		$Subject = "[GI] Dealer Detail";
		
		ob_start();
		$fileName= 'dealer_mail.php';
		include "mail_template.php";
		$Message = ob_get_contents();
		
 		ob_clean();
		 
 		$mail = new PHPMailer();
		$mail->IsHTML(true);
	    $mail->From       = 'sales@greenindiaecoproducts.com';
		$mail->FromName   = "Green India Eco Products";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		// $mail->AddAddress('adisivanc@gmail.com','adisivanc@gmail.com'); 
		$mail->AddAddress('sales@greenindiaecoproducts.com','sales@greenindiaecoproducts.com');
		$mail->Send();
	}




	static function sendEnquiryEmailtoAdmin($params=array())  
	{
		if(count($params)>0) foreach($params as $K=>$V){   $$K=$V; }
				
		$Subject = "[GI] Enquiry Detail";
		
		ob_start();
		$fileName= 'enquiry_mail.php';
		include "mail_template.php";
		$Message = ob_get_contents();
		
 		ob_clean();
		 
 		$mail = new PHPMailer();
		$mail->IsHTML(true);
	    $mail->From       = 'sales@greenindiaecoproducts.com';
		$mail->FromName   = "Green India Eco Products";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		// $mail->AddAddress('adisivanc@gmail.com','adisivanc@gmail.com'); 
		$mail->AddAddress('sales@greenindiaecoproducts.com','sales@greenindiaecoproducts.com'); 
		$mail->Send();
	}








}
?>