<?
include "includes.php";

if($_POST['act']=="sendCircularToStudent") {
	ob_clean();
	
	$circular_id = $_POST['circular_id'];
	$school_id = $_POST['school_id'];
	$grade_id = $_POST['grade_id'];
	$sent_type = $_POST['sendType'];
	$student_id = $_POST['student_id'];
	$to_email = $_POST['toEmail'];
	$subject = $_POST['subject'];
	$message = $_POST['msg'];
	
	if($sent_type=="S" && $student_id!="" && $student_id!="undefined") {
		if($circular_id=="N") {
			$mail_result = Circulars::sendCommonMailToStudent($school_id, $student_id, $to_email, $subject, $message);
			echo $mail_result;
		} 
		else if($circular_id!="" && $circular_id!="undefined" && $circular_id!="N") {
			$rs_circular = Circulars::getCircularById($circular_id);
			$totalCnt = 0;  
			$emailArr=array();
			$rs_student = Student::getStudentById($student_id);
			$student_name = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
			if($rs_student->father_email!="" && $rs_student->f_email_subscription=="Y") $emailArr[]=$rs_student->father_email."~".$rs_student->father_name."~".$rs_student->father_phone."~"."SF"."~".$student_name;
			if($rs_student->mother_email!="" && $rs_student->m_email_subscription=="Y") $emailArr[]=$rs_student->mother_email."~".$rs_student->mother_name."~".$rs_student->mother_phone."~"."SM"."~".$student_name;
			if($rs_student->father_email=="" && $rs_student->mother_email=="" && $rs_student->e_email_subscription=="Y") 
			$emailArr[]=$rs_student->email_address."~".$rs_student->father_name."~".$rs_student->mobile."~"."SE"."~".$student_name;
			
			$totalCnt = count($emailArr); 
			if(!empty($emailArr)>0) {
				foreach($emailArr as $kk=>$vv) { 
					$vvArr = explode("~", $vv);
					$email_address = $vvArr[0];
					$send_to_name = $vvArr[1];
					$contact_number = $vvArr[2];
					$mail_type = $vvArr[3];
					$student_name = $vvArr[4];
					
					if($email_address!="") {
					$From       = FROM_EMAIL;
					$fromName   = FROM_NAME;
					$Subject	= $rs_circular->subject;
					if(is_file(NEWSLETTER_PATH.$rs_circular->ns_file)){
						$attachmentFile = NEWSLETTER_PATH.$rs_circular->ns_file;
					}
					$emailAddress = $email_address;
					ob_clean();
					include "view_newsletter.php";					
					$MailContent=ob_get_contents();
					ob_end_clean();
					//include "sendgrid.php";
					
					if($mail_type=="SF" || $mail_type=="SM" || $mail_type=="SE") $mail_log_type="S"; $mail_log_type=$mail_type;
					Circulars::insertCircularMailLog($_POST['nid'], $mail_log_type, $send_to_name, $student_name, $emailAddress, $contact_number, 'Y');
					
					$newsletter_name = stripslashes($rs_circular->title); 
					$contact_number='9943032500';
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
					
					//ob_clean();
					echo  $results = $email_address."...".$contact_number."...".$mail_type."...".$totalCnt;
					}
				}
			}
			
		}
	} 

	if(($sent_type=="GS")&& $grade_id!="" && $grade_id!="undefined") {
		if($circular_id=="N") {
			$mail_result = Circulars::sendCommonMailToGrade($school_id, $grade_id, $to_email, $subject, $message);
			echo $mail_result;
		} 
		else if($circular_id!="" && $circular_id!="undefined" && $circular_id!="N") {
			$rs_circular = Circulars::getCircularById($circular_id);
			$totalCnt = 0;  
			$emailArr=array();
			if($sent_type=="S") { 
				$qry="SELECT * FROM `".TBL_GRADE_STUDENTS."` where school_id=".$school_id." and grade_id=".$grade_id." group by student_id";
				$rs_SelNLMember=dB::mExecuteSql($qry);
				if(count($rs_SelNLMember)>0) {
					foreach($rs_SelNLMember as $kk=>$vv) {
						$student_obj = new Student();
						$student_obj->id = $vv->student_id;
						$student_obj->fields = "first_name, middle_name, last_name, email_address, father_email, mother_email, father_phone, mother_phone, father_name, mother_name, mobile";
						$rs_student = $student_obj->getAllStudentDtls();
						$student_name = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
						if($rs_student->father_email!="") $emailArr[]=$rs_student->father_email."~".$rs_student->father_name."~".$rs_student->father_phone."~"."SF"."~".$student_name;
						if($rs_student->mother_email!="") $emailArr[]=$rs_student->mother_email."~".$rs_student->mother_name."~".$rs_student->mother_phone."~"."SM"."~".$student_name;
						if($rs_student->father_email=="" && $rs_student->mother_email=="" && $rs_student->email_address!="") $emailArr[]=$rs_student->email_address."~".$rs_student->father_name."~".$rs_student->mobile."~"."SE"."~".$student_name;
					}
				}
			}
			
			$totalCnt = count($emailArr); 
			if(count($emailArr)>0) {
				foreach($emailArr as $kk=>$vv) { 
					$vvArr = explode("~", $vv);
					$email_address = $vvArr[0];
					$send_to_name = $vvArr[1];
					$contact_number = $vvArr[2];
					$mail_type = $vvArr[3];
					$student_name = $vvArr[4];
					
					if($email_address!="") {
					$From       = FROM_EMAIL;
					$fromName   = FROM_NAME;
					$Subject	= $rs_circular->subject;
					if(is_file(NEWSLETTER_PATH.$rs_circular->ns_file)){
						$attachmentFile = NEWSLETTER_PATH.$rs_circular->ns_file;
					}
					$emailAddress = $email_address;
					if($send_unsub=="Y") {
						$unsubscribe_details="";
						$unsubemailaddress = $emailAddress."||".$mail_type;
						$unsubemail = base64_encode($unsubemailaddress);
						$unsubscribe_details = BASE_URL."unsubscribe.php?id=".$unsubemail;
						$fileFrom="Mail";
					}
					ob_clean();
					include "view_newsletter.php";					
					$MailContent=ob_get_contents();
					ob_end_clean();
					//include "sendgrid.php";
					
					if($mail_type=="SF" || $mail_type=="SM" || $mail_type=="SE") $mail_log_type="S"; $mail_log_type=$mail_type;
					Circulars::insertCircularMailLog($_POST['nid'], $mail_log_type, $send_to_name, $student_name, $emailAddress, $contact_number, 'Y');
					
					$newsletter_name = stripslashes($rs_circular->title); 
					$contact_number='9943032500';
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
				
					echo $email_address."...".$contact_number."...".$mail_type."...".$totalCnt.'<br />';
					}
				}
			}
		}
	} 

	exit();
}


$circular_obj = new Circulars();
$circular_obj->sortby="DESC";
$circular_obj->orderby="id";
$circular_obj->status_not_in="'D', 'P'";
$rs_ciruclar = $circular_obj->getCircularDtl();

if(!empty($rs_ciruclar)) $show=1; else $show=0;

//echo "<pre>"; print_r($_POST); echo "</pre>";

if($_POST['send_type']=="GS") $nstype = "S";
/*if(!empty($rs_ciruclar)) {
	foreach($rs_ciruclar as $K=>$V) { 
		$applyArr = unserialize($V->apply_to); 
		//echo "<pre>"; print_r($applyArr); echo "</pre>";
		$listArr = array();
		$listArr = $applyArr[$nstype]["SS:".$schoolId];
		echo "<pre>";  print_r($listArr); echo "</pre>"; 
		if(in_array("SSG:".$gradeId, $listArr)) {
			echo $V->title;
		} else {
			echo "not available";
		}
		echo "<br>";
	}
}
    */            	
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">
	<tr>
        <td>Choose Circular</td>
        <td>
            <select name="send_circular_id" id="send_circular_id" class="listbox" onchange="showNewCircular()">
                <option value="">Choose Circular</option>
                <option value="N">Add New</option>
                <?
                if(!empty($rs_ciruclar)) { $listArr = array();
                    foreach($rs_ciruclar as $K=>$V) { 
					$applyArr = unserialize($V->apply_to); 
					$listArr = $applyArr[$nstype]["SS:".$schoolId];
					if(in_array("SSG:".$gradeId, $listArr)) {
					?>
                    <option value="<?=$V->id?>"><?=$V->title?></option>
                    <?
					}
                    }
                }
                ?>
            </select>
        </td>
    </tr>
    
    <? if($gradeId=="" || $gradeId=="undefined") { ?>
    <tr class="newcircularoption" style="display:none;">
    	<td>To Email</td>
        <td><input type="text" name="std_to_address" id="std_to_address" class="txtbox" value="<?=TO_EMAIL?>" readonly/></td>
    </tr>
    <? } ?>
    
    <tr class="newcircularoption" style="display:none;">
    	<td>Subject</td>
        <td><input type="text" name="std_to_subject" id="std_to_subject" class="txtbox" value="" /></td>
    </tr>
    
    <tr class="newcircularoption" style="display:none;">
    	<td>Message</td>
        <td>
        	<textarea name="std_mail_content" id="std_mail_content" class="msgbox"></textarea>
        </td>
    </tr>
    
    <tr>
    	<td colspan="2" align="right">
        	<div class="fullsize txtwhite txtcenter f18">
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="sendStudentMail()" id="sendbtn"><strong>Send</strong></div>
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="sendingbtn" style="display:none;"><strong>Sending..</strong></div>
            </div>
        </td>
    </tr>

</table>

<script type="text/javascript">

function sendStudentMail() { 
	
	var err=0, cirToAddress='', cirToSubject='', cirToContent='';
	var circular_id = $('#send_circular_id').val();
	var school_id = $('#master_school_id').val();
	var sendType = '<?=$sendType?>';
	var grade_id='<?=$gradeId?>';
	var student_id = '<?=$studentId?>';
	
	if(circular_id=="" || circular_id==undefined) { err=1; $('#send_circular_id').addClass('boxerror'); } else { $('#send_circular_id').removeClass('boxerror'); }
	
	if(circular_id=="N") {
		if($('#std_to_address').val()=='' && (grade_id=="" || grade_id==undefined)) { err=1; $('#std_to_address').addClass('boxerror'); } else { var toEmail = $.trim($('#std_to_address').removeClass('boxerror').val()); }
		if($('#std_to_subject').val()=='') { err=1; $('#std_to_subject').addClass('boxerror'); } else { var subject = $.trim($('#std_to_subject').removeClass('boxerror').val()); }
		if($('#std_mail_content').val()=='') { err=1; $('#std_mail_content').addClass('boxerror'); } else { var msg = $.trim($('#std_mail_content').removeClass('boxerror').val()); }
		msg = msg.replace("&", "and");
	}

	if(err==0) {
		$('#sendbtn').hide();
		$('#sendingbtn').show();
		ajax({
			a:'student_mail_form',
			b:'act=sendCircularToStudent&circular_id='+circular_id+'&grade_id='+grade_id+'&school_id='+school_id+'&toEmail='+toEmail+'&subject='+subject+'&msg='+msg+'&sendType='+sendType+'&student_id='+student_id,		
			c:function(){},
			d:function(data){
				alert(data);
				closePopup();
				$('#sendbtn').show();
				$('#sendingbtn').hide();
			}			
		});
	}
}

function showNewCircular() {
	
	var circular_id = $('#send_circular_id').val();
	$('.newcircularoption').hide();
	if(circular_id=="N") $('.newcircularoption').show();
}


</script>