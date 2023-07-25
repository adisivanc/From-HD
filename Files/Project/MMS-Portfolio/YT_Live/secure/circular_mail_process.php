<?
//$totalCnt = 0;  
//$emailArr=array(); 

if($action_type=="Student") { $emailArr=array(); 
	$rs_student = Student::getStudentById($student_id);
	$student_name = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
	if($rs_student->father_email!="" && $rs_student->f_email_subscription=="Y") $emailArr[]=$rs_student->father_email."~".$rs_student->father_name."~".$rs_student->father_phone."~"."SF"."~".trim($student_name)."~".$rs_student->id."~".$rs_student->grade_id;
	if($rs_student->mother_email!="" && $rs_student->m_email_subscription=="Y") $emailArr[]=$rs_student->mother_email."~".$rs_student->mother_name."~".$rs_student->mother_phone."~"."SM"."~".trim($student_name)."~".$rs_student->id."~".$rs_student->grade_id;
	if($rs_student->father_email=="" && $rs_student->mother_email=="" && $rs_student->e_email_subscription=="Y") 
	$emailArr[]=$rs_student->email_address."~".$rs_student->father_name."~".$rs_student->mobile."~"."SE"."~".trim($student_name)."~".$rs_student->id."~".$rs_student->grade_id;
}

if($action_type=="Teacher") { $emailArr=array(); 
	$rs_teacher = Teacher::getTeachersById($teacher_id);
	$teacher_name = $rs_teacher->first_name." ".$rs_teacher->middle_name." ".$rs_teacher->last_name;
	if($rs_teacher->email_address!="" && $rs_teacher->email_subscription=="Y") $emailArr[]=$rs_teacher->email_address."~".trim($teacher_name)."~".$rs_teacher->mobile."~"."T"."~".""."~".$rs_teacher->id;
}


foreach($circularIds as $ck=>$cv) {
	
	$rs_circular = Circulars::getCircularById($cv);
	$circular_id = $cv;
	
	$totalCnt = count($emailArr); 
	if(!empty($emailArr)>0) {
		foreach($emailArr as $kk=>$vv) { 

				$vvArr = explode("~", $vv);
				$email_address = $vvArr[0];
				$send_to_name = $vvArr[1];
				$contact_number = $vvArr[2];
				$mail_type = $vvArr[3];
				$student_name = $vvArr[4];
				$mail_send_id = $vvArr[5];
				$grade_id = $vvArr[6];
		
				
				if($email_address!="") {
				$From       = FROM_EMAIL;
				$fromName   = FROM_NAME;
				$Subject	= $rs_circular->subject;
				if(is_file(NEWSLETTER_PATH.$rs_circular->ns_file)){
					$attachmentFile = NEWSLETTER_PATH.$rs_circular->ns_file;
				}
				$emailAddress = $email_address;
				
				ob_start();
				include "view_newsletter.php";					
				$MailContent=ob_get_contents();
				ob_clean();
				include "sendgrid.php"; 
			
				if($mail_type=="SF" || $mail_type=="SM" || $mail_type=="SE") $mail_log_type="S"; else $mail_log_type=$mail_type;
				Circulars::insertCircularMailLog($circular_id, $mail_log_type, $send_to_name, $student_name, $emailAddress, $contact_number, 'Y', $grade_id, $mail_send_id);
				
				$newsletter_name = stripslashes($rs_circular->title); 
				//$contact_number='9943032500';
				if($contact_number!="") { 
					
					$sms_text	= "Please note that a new circular has been sent to your email address $email_address regarding $newsletter_name. YT Communications Team."; 
					$fields_string='';
					$fields = array(
						'mno' => $contact_number,
						'msg' => urlencode($sms_text)
					);
					foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
					rtrim($fields_string, '&');
					$fields_string= substr($fields_string,0,-1);
					$url="http://www.nexmoo.com/ytrain/smssent.php";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_POST, count($fields));
					curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result= curl_exec ($ch);
					curl_close ($ch);
				}
			}
			echo  $results = $email_address."...".$contact_number."...".$mail_type."...".$totalCnt;  echo "<br>";
		//ob_clean();
		
		}
	}
}
?>