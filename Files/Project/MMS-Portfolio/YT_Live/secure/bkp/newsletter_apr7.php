<?
function main(){ 
ini_set('max_execution_time', 500000000000);	
	
if($_POST['act']=="showNewCircular") {
	ob_clean();
		$circularId = $_POST['nsId'];
		$rs_circular = Circulars::getCircularById($circularId);
		if($_POST['Action']=="N" || $_POST['Action']=="E") include "newsletter_add.php";
		else if($_POST['Action']=="V") { 
		?>
        <div class="fullsize lineht2 border_bottom">
            <div class="pull_left padlr10 padtb10 txtbold letterspac f18"><?=stripslashes($rs_circular->title)?></div>
        </div>
        <div class="fullsize lineht2 border_bottom">
        	<? if($rs_circular->status!="S") { ?>
            <div class="pull_right pad10 cursor">
            	<img src="images/sett_icon.png" alt="Update Status" title="Update Status" align="absmiddle" onclick="updateStatus('<?=$rs_circular->id?>', 'U')" />
            </div>
            <? } ?>
            <div class="pull_right pad10 cursor">
            	<img src="images/log_icon.png" alt="Mail Log" title="Mail Log" align="absmiddle" onclick="showEmailLogs('<?=$rs_circular->id?>')" />
            </div>
            <div class="pull_right pad10 cursor">
            	<img src="images/bulk_mail.png" alt="Send Mail" title="Send Mail" align="absmiddle" height="24" onclick="sendCircular('<?=$rs_circular->id?>')" />
            </div>
            <div class="pull_right pad10 cursor">
            	<img src="images/mail_icon.png" alt="Single Mail" title="Single Mail" align="absmiddle" onclick="sendTestCircular('<?=$rs_circular->id?>');" />
            </div>
            <div class="pull_right pad10 cursor">
            	<img src="images/delete_icon.png" alt="Delete" title="Delete" align="absmiddle" onclick="if(confirm('Are you sure want to delete the selected Subject?')) showCircular('D', '<?=$rs_circular->id?>');" />
            </div>
            <div class="pull_right pad10 cursor">
            	<a href="newsletter.php?nsId=<?=$rs_circular->id?>"><img src="images/edit_icon.png" alt="Edit" title="Edit" align="absmiddle" /></a>
            </div>
        </div>
        
        <div class="fullsize margintb10"><? include "view_newsletter.php"; ?></div>
			
        <?
		}
		else if($_POST['Action']=="D") {
			Circulars::deleteCircularById($circularId);
		}
		
	exit();
}

if($_POST['act']=="loadMenuList") {
	ob_clean();
	$circular_obj = new Circulars();
	$circular_obj->sortby="DESC";
	$circular_obj->orderby="id";
	$circular_obj->status=$_POST['type'];
	$rs_ciruclar = $circular_obj->getCircularDtl();
	
	if ($_POST['page'] == '')
		$page = 1;
	else
		$page = $_POST['page'];
	$totalReg = count($rs_ciruclar);
	$PageLimit = ($_POST["page_limit"] == "") ? 5 : $_POST["page_limit"];

	$totalPages = ceil(($totalReg) / ($PageLimit));
	if ($totalPages == 0) $totalPages = 1;
	$StartIndex = ($page - 1) * $PageLimit;
	if (count($rs_ciruclar) > 0) $rs_circularArr = array_slice($rs_ciruclar, $StartIndex, $PageLimit, true);
		
	$arrayCount = count($rs_ciruclar);
	$arraySliceCount = count($rs_circularArr);
			
	if($arrayCount>0 && $totalPages > 1) { 
		$table_val = generateMenuPagination($functionName="circularList", $arrayCount, $arraySliceCount, $pageLimit=$PageLimit, $adjacent=1, $page=$page, $type=$_POST['type']);
	}
		
	if(count($rs_circularArr)>0) {
		$keys = array_keys($rs_circularArr); 
		$lastkey = array_pop($keys);
		$lastvalue = $rs_circularArr[$lastkey]->id;
		foreach($rs_circularArr as $k=>$v) { 
			$ciruclar_name = $v->title; $ciruclar_name = trim($ciruclar_name);
			if($lastvalue!=$v->id) $border_style = "border-bottom:1px dashed #FFF;"; else $border_style = ""; 
		?>
			<li style="<?=$border_style?>"><?=$val?><a onclick="showCircular('V', '<?=$v->id?>');" style="cursor:pointer;"><?=$ciruclar_name?></a></li>
		<? $row++;
		}
		
		if($table_val!='') { ?>
			<li><div><?=$table_val?></div></li>
		<?
		}
	} else {
		?>
			<li><a>No results found..!</a></li>
		<?
	}
	
	//echo "<pre>"; print_r($rs_circularArr); echo "</pre>";
	//echo $PageLimit;
					
	exit();
}

if($_POST['act']=="saveCircular") {
	
	//echo "<pre>"; print_r($_POST); echo "</pre>";
	//echo "<pre>"; print_r($_FILES); echo "</pre>"; 
	
	$ns_type = trim(addslashes($_POST['ns_type']));
	$title = trim(addslashes($_POST['ns_title']));
	$subject = trim(addslashes($_POST['ns_subject']));
	$header_type = trim(addslashes($_POST['ns_header_type']));
	$welcome_note = trim($_POST['welcome_note']);
	$welcome_text = trim(addslashes($_POST['welcome_text']));
	$no_of_inner_image = $_POST['inner_image_types'];
	$welcome_description = trim(addslashes($_POST['welcome_description']));
	$conclusion_text = trim(addslashes($_POST['conclusion_text']));
	$regards_text = trim(addslashes($_POST['regards_text']));
	$regards_from_text = trim(addslashes($_POST['regards_from_text']));
	if($_POST['send_date']!="" && $_POST['send_date']!="0000-00-00") $senddate=date("Y-m-d", strtotime(trim($_POST['send_date']))); else $senddate="";
	$send_date = $senddate;
	$send_date_position = trim($_POST['send_date_position']);
	$status = trim($_POST['ns_submit_action_type']);
	$apply_to = serialize($_POST['ApplyTo']);
	$is_highlight_text = $_POST['highlight_text'];
	$term_calender_position = $_POST['term_calender_position'];
	if($_POST['ns_date']!="" && $_POST['ns_date']!="0000-00-00") $nsdate=date("Y-m-d", strtotime(trim($_POST['ns_date']))); else $nsdate="";
	$ns_date = $nsdate;
	
	if($_POST['newsletter_db_id']!="" && $_POST['newsletter_db_id']!="undefined") {
		$rs_id = $_POST['newsletter_db_id'];
		Circulars::updateCircular($rs_id, $ns_type, $title, $subject, $header_type, $welcome_note, $welcome_text, $no_of_inner_image, $welcome_description, $conclusion_text, $regards_text, $regards_from_text, $send_date, $send_date_position, $status, $apply_to, $is_highlight_text, $term_calender_position, $ns_date);
	} else {
		$rs_id = Circulars::insertCircular($ns_type, $title, $subject, $header_type, $welcome_note, $welcome_text, $no_of_inner_image, $welcome_description, $conclusion_text, $regards_text, $regards_from_text, $send_date, $send_date_position, $status, $apply_to, $is_highlight_text, $term_calender_position, $ns_date);
	}
	
	$headerArr=array();
	if($header_type=="T") {
		$headerArr['Headline1']=trim($_POST['ns_header_text1']);
		$headerArr['Headline2']=trim($_POST['ns_header_text2']);
		$headerArr['HeadlineDesc']=trim($_POST['ns_header_description']);
	} else if($header_type=="I") {
		
		if($_FILES['ns_header_img']['size'] > 0)
		{
			//print_r($_POST);
			$up_fileArr = $_FILES['ns_header_img']; 
			$rExt = array('jpg','jpeg','png','gif');
			$FileObj = new FileUpload();
			$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$up_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>NEWSLETTER_HEADER_PATH));
			if($FileResult['Type']==1)
			{
			$Err[]=$FileResult['Error'];
			$ErrFlag = false;
			if($FileResult['ErrorNo']==1 )
			{
				$Err[] = "Valid file formats are ".implode(',',$rExt);
				$ErrFlag = true;
			}
			}
			elseif($FileResult['Type']==2)
			{
				$header_file_upload = true;
			}
		}
		
		if($header_file_upload){
			//$FileObj->AssignFileName(UniqueIdGen());
			$header_file_name = "header_".$rs_id;
			$FileObj->AssignFileName($header_file_name);
			$filepath_header = $FileObj->Upload();
		}
		if($filepath_header!="") $filepath_header= $filepath_header; else $filepath_header = $_POST['h_ns_header_img'];
		$headerArr['Img']=$filepath_header;
		
	}
	if(!empty($headerArr)) {
		$header_details = addslashes(serialize($headerArr));
		Circulars::updateCircularByField('header_details', $header_details, $rs_id);
	}
	
	$innerImgArr=array();
	for($i=1; $i<=$no_of_inner_image; $i++) {
		
		if($_FILES['inner_image'.$i]['size'] > 0)
		{
			//print_r($_POST);
			$up_fileArr = $_FILES['inner_image'.$i]; 
			$rExt = array('jpg','jpeg','png','gif');
			$FileObj = new FileUpload();
			$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$up_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>NEWSLETTER_WELCOME_PATH));
			if($FileResult['Type']==1)
			{
			$Err[]=$FileResult['Error'];
			$ErrFlag = false;
			if($FileResult['ErrorNo']==1 )
			{
				$Err[] = "Valid file formats are ".implode(',',$rExt);
				$ErrFlag = true;
			}
			}
			elseif($FileResult['Type']==2)
			{
				$inner_file_upload = true;
			}
		}
		if($inner_file_upload){
			//$FileObj->AssignFileName(UniqueIdGen());
			$inner_file_name = "Welcome_".$rs_id."_".($i+1);
			$FileObj->AssignFileName($inner_file_name);
			$filepath_inner_img = $FileObj->Upload();
		}
		if($filepath_inner_img!="") $filepath_inner_img=$filepath_inner_img; else $filepath_inner_img=$_POST['h_inner_image'.$i];
		$innerImgArr['Img'.$i]=$filepath_inner_img;
		
	}
	if(!empty($innerImgArr)) {
		$inner_images = serialize($innerImgArr);
		Circulars::updateCircularByField('inner_images', $inner_images, $rs_id);
	}
	
	if($ns_type=="P" || $ns_type=="DC") {
		$highlightArr=array();
		$highlights = $_POST['HighlightDtl'];
		$highlight_index=0;
		if(count($highlights)>0) {
			foreach($highlights['highlight_title'] as $tk=>$tv) {
				$highlightArr[$tk]['HighlightTitle']=trim($highlights['highlight_title'][$highlight_index]);
				$highlightArr[$tk]['HighlightDesc']=trim($highlights['highlight_desc'][$highlight_index]);
			$highlight_index++;
			}
		}
		$highlight_details = addslashes(serialize($highlightArr));
		Circulars::updateCircularByField('highlight_text_details ', $highlight_details, $rs_id);
	}
	
	if($ns_type=="TE") {
		$modules = $_POST['ModuleDtl'];
		$modulesArr=array();
		$index=0;
		if(count($modules)>0) {
			foreach($modules['module_title'] as $mk=>$mv) { 
				
				$modulesArr[$mk]['MTitle']=trim($modules['module_title'][$index]);
				$modulesArr[$mk]['MSubTitle']=trim($modules['module_sub_title'][$index]);
				$modulesArr[$mk]['MDesc']=trim($modules['module_description'][$index]);
				$modulesArr[$mk]['MHBoxType']=$modules['module_highlight_box'][$index];
				if($modulesArr[$mk]['MHBoxType']=="T") {
					$modulesArr[$mk]['MHBoxDetails']['HeadLine']=trim($modules['module_highlight_text_head'][$index]);
					$modulesArr[$mk]['MHBoxDetails']['Desc']=trim($modules['module_highlight_text_desc'][$index]);
					
				} else if($modulesArr[$mk]['MHBoxType']=="I") {
					
					if($_FILES['module_highlight_img_'.$index]['size'] > 0)
					{
						//print_r($_POST);
						$up_fileArr = $_FILES['module_highlight_img_'.$index]; 
						$rExt = array('jpg','jpeg','png','gif');
						$FileObj = new FileUpload();
						$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$up_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>NEWSLETTER_MODULE_PATH));
						if($FileResult['Type']==1)
						{
						$Err[]=$FileResult['Error'];
						$ErrFlag = false;
						if($FileResult['ErrorNo']==1 )
						{
							$Err[] = "Valid file formats are ".implode(',',$rExt);
							$ErrFlag = true;
						}
						}
						elseif($FileResult['Type']==2)
						{
							$module_file_upload = true;
						}
					}
					
					if($module_file_upload){
						//$FileObj->AssignFileName(UniqueIdGen());
						$module_file_name = "Module_".$rs_id."_".($index+1);
						$FileObj->AssignFileName($module_file_name);
						$filepath_modules = $FileObj->Upload();
					}
					if($filepath_modules!="") $filepath_modules_name=$filepath_modules; else $filepath_modules_name=$_POST['h_module_highlight_img_'.$index];
					$modulesArr[$mk]['MHBoxDetails']['Image']=$filepath_modules_name;
				}
				if($modulesArr[$mk]['MHBoxType']!="N") $modulesArr[$mk]['MHBoxPosition']=$modules['module_highlight_box_position'][$index];
			$index++;
			}
		}
		//echo "<pre>"; print_r($modulesArr); echo "</pre>";  exit();
		$modules_details = addslashes(serialize($modulesArr));
		Circulars::updateCircularByField('modules', $modules_details, $rs_id);
		
		if($term_calender_position=="Y") {
			$termsArr=array();
			$terms = $_POST['TermDtl'];
			$term_index=0;
			if(count($terms)>0) {
				foreach($terms['term_calender_date'] as $tk=>$tv) {
					$termsArr[$tk]['TDate']=date("Y-m-d", strtotime($terms['term_calender_date'][$term_index]));
					$termsArr[$tk]['TName']=trim($terms['term_calender_name'][$term_index]);
				$term_index++;
				}
			}
			$term_calender_details = addslashes(serialize($termsArr));
			Circulars::updateCircularByField('term_calender_details', $term_calender_details, $rs_id);
		}
	}
	
	if($_FILES['ns_file']['size'] > 0)
	{
		$FileArr = $_FILES['ns_file'];	
		$rExt1 = array('jpg','jpeg','png','gif','pdf','xls','doc','docx','xlsx','ppt','pptx');
		$FileObj = new FileUpload();
		$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$FileArr, 'Extension'=>implode(',', $rExt1),'PathPrefix'=>NEWSLETTER_PATH));
		
		if($FileResult['Type']==1)
		{
			$Err['Photo']=$FileResult['Error'];
			$ErrFlag = false;
			if($FileResult['ErrorNo']==1 )
			{
				$Err['Photo'] = "Valid file formats are ".implode(',',$rExt);
				$ErrFlag = true;
			}
		}
		elseif($FileResult['Type']==2)
		{
			$ns_file_upload = true;
		}

	}
	if($ns_file_upload)
	{
		//if($_POST['FileName']==''){ $filename = $rs_id; } else { $filename=$_POST['FileName']; } 
		$search = array('-', ',', ':', ' ', '  ', '&');
		$replace = '_';
		$filename_file = str_replace($search, $replace, $_POST['ns_title']);
		$FileObj->AssignFileName($filename_file);
		$filepath_file = $FileObj->Upload();
		Circulars::updateCircularByField('ns_file', $filepath_file, $rs_id);
	}
	
	if($rs_id!="") {
		if($status=="D") { ?><script type="text/javascript">window.location.href="newsletter.php?nsId=<?=$rs_id?>";</script> <? //header("Location: newsletter.php?nsId=".$rs_id);
		}
		else { 
			?><script type="text/javascript">window.location.href="newsletter.php";</script> <? //header("Location: newsletter.php");
		}
	}
	
}

if($_POST['act']=='showTestCircularEmail'){
	ob_clean();
	$rs_circular = Circulars::getCircularById($_POST['id']);
	?>
    <input type="hidden" name="test_nid" id="test_nid" value="<?=$_POST['id']?>" />
    <table width="500" border="0" style="background:#FFF;" class="popuptbl" cellpadding="0" cellspacing="0">
        <tr>
        	<th align="left"><strong>Circular Single Email</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        
        <tr>
        	<td id="test_circular_td">
                <table>
                    <tr>
                      <td width="40%" height="30" id="td_from_address"><strong>From Address</strong></td>
                      <td><input name="test_from_address" type="text" id="test_from_address" size="40" value="<?=FROM_EMAIL?>" class="txtbox" readonly="readonly"/></td>
                    </tr>
                    <tr>
                      <td width="40%" height="30" id="td_Subject"><strong>Subject</strong></td>
                      <td><input name="test_Subject" type="text" id="test_Subject" size="40" class="txtbox" value="<?=stripslashes($rs_circular->subject);?>"/></td>
                    </tr>
                    
                    <tr>
                      <td width="40%" height="30" id="td_Subject"><strong>Send To</strong></td>
                      <td>
                      	<input type="radio" name="send_option" id="send_option1" value="P" onclick="setOptions(<?=$_POST['id']?>)" /> Student
                        <input type="radio" name="send_option" id="send_option2" value="T" onclick="setOptions(<?=$_POST['id']?>)" /> Teacher
                        <input type="radio" name="send_option" id="send_option3" value="O" onclick="setOptions(<?=$_POST['id']?>)" checked/> Others
                      </td>
                    </tr>
                    
                    <tr class="sendparentoption" style="display:none;">
                      <td  width="40%" height="30" id="td_Subject"><strong>Student Name</strong></td>
                      <td>
                        <input type="text" name="single_student_name" id="single_student_name" size="40" value="" class="txtbox" placeholder="Student Name" />
                        <input type="hidden" name="single_student_name_id" id="single_student_name_id" size="40" value="" class="txtbox" />
                      </td>
                    </tr>
                    
                    <tr class="sendteacheroption" style="display:none;">
                      <td  width="40%" height="30" id="td_Subject"><strong>Teacher Name</strong></td>
                      <td>
                        <input type="text" name="single_teacher_name" id="single_teacher_name" size="40" value="" class="txtbox" placeholder="Teacher Name" />
                        <input type="hidden" name="single_teacher_name_id" id="single_teacher_name_id" size="40" value="" class="txtbox" />
                      </td>
                    </tr>
                    
                    <tr class="sendotheroption" style="display:none;">
                      <td  width="40%" height="30" id="td_Subject"><strong>To Email</strong></td>
                      <td><input name="to_email" type="text" id="to_email" size="40" value="<?=TO_EMAIL?>" class="txtbox" /></td>
                    </tr>
                    
                    <tr class="sendotheroption" style="display:none;">
                      <td  width="40%" height="30" id="td_Subject"><strong>To Mobile</strong></td>
                      <td><input name="to_mobile" type="text" id="to_mobile" size="40" value="<?=TO_MOBILE?>" class="txtbox" /></td>
                    </tr>
                    
                    <tr>
                    	<td colspan="2">
                        <input type="checkbox" name="test_is_unsubscribe" id="test_is_unsubscribe" value="Y" /> Include with unsubscribe
                        </td>
                    </tr>
                    
                    <tr>
                      <td  width="40%" height="30" colspan="2" align="center"><div class="combutton pull_right padlr10 padtb10 txtbold letterspac f18" onclick="testCircularForm()">Send Now</div></td>
                   </tr>
                </table>
             </td>
         </tr>   
    </table>
    <script type="text/javascript">setOptions('<?=$_POST['id']?>');</script>
    <?	
	exit();

}

if($_POST['act']=='sendTestCircularEmail'){
	ob_clean();
	
	$rs_circular = Circulars::getCircularById($_POST['nid']);

	$totalCnt = 0;  
	
	$emailArr=array();
	if($_POST['send_option']=="P") { 
		$rs_student = Student::getStudentById($_POST['student_id']);
		$student_name = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
		if($rs_student->father_email!="" && $rs_student->f_email_subscription=="Y") $emailArr[]=$rs_student->father_email."~".$rs_student->father_name."~".$rs_student->father_phone."~"."S"."~".$student_name;
		if($rs_student->mother_email!="" && $rs_student->m_email_subscription=="Y") $emailArr[]=$rs_student->mother_email."~".$rs_student->mother_name."~".$rs_student->mother_phone."~"."S"."~".$student_name;
		if($rs_student->father_email=="" && $rs_student->mother_email=="" && $rs_student->e_email_subscription=="Y") 
		$emailArr[]=$rs_student->email_address."~".$rs_student->father_name."~".$rs_student->mobile."~"."S"."~".$student_name;
	}
	else if($_POST['send_option']=="T") { 
		$rs_teacher = Teacher::getTeachersById($_POST['teacher_id']);
		$teacher_name = $rs_teacher->first_name." ".$rs_teacher->middle_name." ".$rs_teacher->last_name;
		if($rs_teacher->email_address!="" && $rs_teacher->email_subscription=="Y") $emailArr[]=$rs_teacher->email_address."~".$teacher_name."~".$rs_teacher->mobile."~"."T";
	} 
	else {
		$mail_to_name = "";
		$emailArr[]=$_POST['to_email']."~".$mail_to_name."~".$_POST['test_mobile']."~"."TEST";
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
			$Subject	= $_POST['test_Subject'];
			if(is_file(NEWSLETTER_PATH.$rs_circular->ns_file)){
				$attachmentFile = NEWSLETTER_PATH.$rs_circular->ns_file;
			}
			$emailAddress = $email_address;
			
			ob_clean();
			include "view_newsletter.php";					
			$MailContent=ob_get_contents();
			ob_end_clean();
			
			if($_POST['send_unsub']=="Y") {
				$unsubscribe_details="";
				$unsubemailaddress = $emailAddress."||".$mail_type;
				$unsubemail = base64_encode($unsubemailaddress);
				$unsubscribe_details = BASE_URL."unsubscribe.php?id=".$unsubemail;
				$MailContent .= "<p>Would you like to unsubscribe newsletter. <a href='$unsubscribe_details' target='_blank'>Click here</a></p>";
			}
			
			include "sendgrid.php";
			
			Circulars::insertCircularMailLog($_POST['nid'], $mail_type, $send_to_name, $student_name, $emailAddress, $contact_number, 'Y');
			
			$newsletter_name = stripslashes($rs_circular->title); 
			$contact_number='';
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
		
			echo $email_address."...".$contact_number."...".$totalCnt;
			echo '<br />';
			}
		}
	}

	exit();
}

if($_POST['act']=='showCircularEmail'){
	
	ob_clean();
	$rs_circular = Circulars::getCircularById($_POST['id']);	
	?>
    <style type="text/css">
		.boldtxt{
			font-weight:bold;
		}
		.nrmltxt{
			font-weight:normal;
		}
	</style>
    <input type="hidden" name="nid" id="nid" value="<?=$_POST['id']?>" />
    <table width="100%" border="0" style="background:#FFF;" class="popuptbl" cellpadding="0" cellspacing="0">
        <tr>
        	<th align="left"><strong>Circular Email</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        	</tr>
        </tr>
        
        <tr>
        <td id="circular_td">
        	<table>
        
                <tr>
                  <td width="40%" height="30" id="td_from_address"><strong>From Address</strong></td>
                  <td><input name="from_address" type="text" id="from_address" size="40" value="<?=FROM_EMAIL?>"  readonly="readonly"/></td>
                </tr>
                <tr>
                  <td  width="40%" height="30" id="td_Subject"><strong>Subject</strong></td>
                  <td>
                    <input name="Subject" type="text" id="Subject" size="40" value="<?=stripslashes($rs_circular->subject);?>"/>
                  </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <?
						$rs_ApplyTo = unserialize($rs_circular->apply_to);
						$title=array(); $schlArr=array(); $gradeArr=array();
						?>
                       
                        <?
						if(is_array($rs_ApplyTo)) {
							foreach($rs_ApplyTo as $k1=>$v1) {
								if($k1=="T") $titlename = "Teachers"; else if($k1=="S") $titlename = "Student"; else if($k1=="NS") $titlename = "Subscribers"; 
							?>
                            	<div style="border-bottom:1px dotted #CCCCCC; line-height:30px;">
                                <input type="checkbox" name="circular_group[]" id="circular_group" class="circular_group_<?=$k1?>" value="<?=trim($k1)?>" onclick="uncheckMailList('<?=$k1?>')" checked/> <?=$titlename?> 
                            <?
								if(is_array($v1)) {
									foreach($v1 as $k2=>$v2) { $slname = explode(":", $k2);
										$rs_schl = School::getSchoolById($slname[1]);
									?>
                                		<div style="margin-left:10px;">
                                        <input type="checkbox" name="circular_group[]" id="circular_group" class="circular_sub_group_<?=$k1?>" value="<?=trim($k2)?>" checked/> <?=$rs_schl->school_name?> 
                                	<?
										if(is_array($v2)) {
											foreach($v2 as $k3=>$v3) { $gdname = explode(":", $v3); 
											$rs_grade = Grade::getGradeById($gdname[1]);
											?>
                                            	<div style="margin-left:10px;"><input type="checkbox" name="circular_group[]" id="circular_group" class="circular_sub_group_<?=$k1?>" value="<?=trim($v3)?>:<?=$rs_schl->id?>" checked/> <?=$rs_grade->grade_name?></div>
                                            <?
											}
										}
									?> 
                                		</div>
                                	<?
									}
								}
							?>
                            	</div>
                            <?
							}
						}
						?>
                       
                        
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                    <input type="checkbox" name="is_unsubscribe" id="is_unsubscribe" value="Y" /> Include with unsubscribe
                    </td>
                </tr>
                
                <tr>
                  <td  width="40%" height="30" colspan="2" align="center">
                    <div class="combutton pull_right padlr10 padtb10 txtbold letterspac f18" onclick="bulkCircularForm()">Send Now</div>
                  </td>
                </tr>
          		</table>
             </td>
             </tr>   
    </table>
    <?	
	exit();
}

if($_POST['act']=='sendCircularEmail'){
	ob_clean();
	$teacheremail =array();
	$rs_circular = Circulars::getCircularById($_POST['nid']);	
	extract($_POST);
	
	if(count($rs_circular)>0){ 
		$user_type = '';
		$siteEmail=SITE_EMAIL;
		$Subject=$_POST['Subject'];
		$circular_group = explode(',',$circular_group);

		$UpdNL = false; $emailArr=array();
		if(count($circular_group)>0){
		foreach($circular_group as $K_UG=>$V_UG){ 
			$today=time();
			$sqlDateTime=date('Y-m-d H:i:s',$today);
			
			if($V_UG!='')
			{
				$rs_tt = explode(':',$V_UG);
				if($rs_tt[0]=='TSG'){ 
					$table_name = "grade_teachers";
					$qry="SELECT * FROM `".TBL_GRADE_TEACHERS."` where school_id=".$rs_tt[2]." and grade_id=".$rs_tt[1]." group by teacher_id";
					$rs_SelNLMember=dB::mExecuteSql($qry);
					if(count($rs_SelNLMember)>0) {
						foreach($rs_SelNLMember as $kk=>$vv) {
							$tech_obj = new Teacher();
							$tech_obj->id = $vv->teacher_id;
							$tech_obj->fields = "first_name, middle_name, last_name, email_address, mobile";
							$rs_teacher = $tech_obj->getTeachersDtls();
							if($rs_teacher->email_address!="" && !in_array($rs_teacher->email_address,$teacheremail)) {
							     $teacheremail[]=$rs_teacher->email_address;	
								 $emailArr[]=$rs_teacher->email_address."~".$rs_teacher->first_name." ".$rs_teacher->middle_name." ".$rs_teacher->last_name."~".$rs_teacher->mobile."~"."T";
							}
						}
					}
					
				}
				if($rs_tt[0]=='SSG'){
					$table_name = "grade_student";
					$qry="SELECT * FROM `".TBL_GRADE_STUDENTS."` where school_id=".$rs_tt[2]." and grade_id=".$rs_tt[1]." group by student_id";
					$rs_SelNLMember=dB::mExecuteSql($qry);
					if(count($rs_SelNLMember)>0) {
						foreach($rs_SelNLMember as $kk=>$vv) {
							$student_obj = new Student();
							$student_obj->id = $vv->student_id;
							$student_obj->fields = "first_name, middle_name, last_name, email_address, father_email, mother_email, father_phone, mother_phone, father_name, mother_name, mobile";
							$rs_student = $student_obj->getAllStudentDtls();
							$student_name = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
							if($rs_student->father_email!="") $emailArr[]=$rs_student->father_email."~".$rs_student->father_name."~".$rs_student->father_phone."~"."S"."~".$student_name;
							if($rs_student->mother_email!="") $emailArr[]=$rs_student->mother_email."~".$rs_student->mother_name."~".$rs_student->mother_phone."~"."S"."~".$student_name;
							if($rs_student->father_email=="" && $rs_student->mother_email=="" && $rs_student->email_address!="") $emailArr[]=$rs_student->email_address."~".$rs_student->father_name."~".$rs_student->mobile."~"."S"."~".$student_name;
							//if($rs_student->email_address!="") $emailArr[]=$rs_student->email_address."~".$rs_student->father_name."~".$rs_student->mobile."~"."S";
						}
					}
				}
				if($rs_tt[0]=='NS'){
					$table_name = "newsletter_subscribers";
					$qry="SELECT * FROM `".TBL_NL_SUBSCRIBERS."` group by email_address";
					$rs_SelNLMember=dB::mExecuteSql($qry);
					if(count($rs_SelNLMember)>0) {
						foreach($rs_SelNLMember as $kk=>$vv) {
							if($vv->email_address!="") $emailArr[]=$vv->email_address."~".$vv->name."~".$vv->phone."~"."NS";
						}
					}
				}

			}
			
		}
		
		if(count($emailArr)>0){
		
			$UpdNL = true;
			
			$sentCnt=0;
			$arrayCnt=0;
			
			$Sentemail_idArr = array();
			$arrayCnt=0;
			$totalCnt = count($emailArr); 
				
			foreach($emailArr as $K_Mem=>$V_Mem){
				
					$emailid=explode('~',$V_Mem);
					$sentCnt++;
					$Subject    	= $_POST['Subject'];
					$emailAddress 	= $emailid[0];
					$emailName 		= $emailid[1];
					//$emailid[2] 	= "9943032500";
					$contact_number	= $emailid[2];
					$emailType 		= $emailid[3];
					$studentName 	= $emailid[4];
				
					ob_start();
					include "view_newsletter.php";					
					$MailContent=ob_get_contents();
					ob_end_clean();
					
					if($_POST['send_unsub']=="Y") {
						$unsubscribe_details="";
						$unsubemailaddress = $emailAddress."||".$emailType;
						$unsubemail = base64_encode($unsubemailaddress);
						$unsubscribe_details = BASE_URL."unsubscribe.php?id=".$unsubemail;
						$MailContent .= "<p>Would you like to unsubscribe newsletter. <a href='$unsubscribe_details' target='_blank'>Click here</a></p>";
					}
					
					if($sentCnt<=500) { 
						
						$send=0;
		
						$From       	= SITE_EMAIL;
						$fromName   	= FROM_NAME;
						if(is_file(NEWSLETTER_PATH.$rs_circular->ns_file)){
							$attachmentFile = NEWSLETTER_PATH.$rs_circular->ns_file;
						}
						//$emailAddress = 'ri.pandee@gmail.com';
						//include "sendgrid.php";
						
						$newsletter_name = stripslashes($rs_circular->title);
						if($contact_number!="") { 
							$sms_text	= "Please note that a new circular has been sent to your email address $emailAddress regarding $newsletter_name. YT Communications Team."; 
							$fields_string='';
							$fields = array(
								'mno' => $contact_number,
								'msg' => urlencode($sms_text)
							);
							foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
							rtrim($fields_string, '&');
							$fields_string= substr($fields_string,0,-1);
							//$url="http://www.nexmoo.com/ytrain/smssent.php";
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL,$url);
							curl_setopt($ch, CURLOPT_POST, count($fields));
							curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							//$result= curl_exec ($ch);
							curl_close ($ch);
						}
						
						Circulars::insertCircularMailLog($_POST['nid'], $emailType, $emailName, $studentName, $emailAddress, $contact_number, 'Y');
						
						echo $emailid[0]."...".$contact_number."...".$totalCnt;
						echo '<br />';
					
					} else {						
						
						$arrayCnt++;
				
						$Sentemail_idArrLater[] = $emailid[0].'-'.$emailid[1].'-'.$emailid[2];
						$Sentemail_idArr[] = $emailid[0];
						if($arrayCnt>=500 || $sentCnt==$totalCnt){
							
							$arrayCnt=0;
							$members = implode('~',$Sentemail_idArrLater);
						
							$temp=time();
							$currentdate=date("Y-m-d H:i:s", $temp);
							/*$circular_obj= new Circular();
							$circular_obj->circular_id=$_POST['nid'];
							$circular_obj->added_date=$currentdate;
							$circular_obj->members= $members;
							$rs_NewsDtl = $circular_obj->insertCircularLog();*/
							$rs_NewsDtl = Circular::insertCircularLog($_POST['nid'], $members, "", $currentdate);
							$Sentemail_idArrLater= array();
						
						}
				
					}
					
				}
			exit();	
			}
				
	    }
		
	}	
	
	exit();
}

if($_POST['act']=="getAllEmailLogs") {
	ob_clean();
	$circularId = $_POST['circularId'];
	$rs_logs = Circulars::getEmailLogByCircularId($circularId);
	$logsArr=array();
	if(count($rs_logs)>0) {
		foreach($rs_logs as $kk=>$vv) {
			$logsArr[$vv->mail_type][] = $vv;
		}
	}
	$query = "SELECT * FROM `circular_mail_log` where mail_type='S' and circular_id='$circularId' group by student_name";
	$rs_student_count = dB::mExecuteSql($query); 
	//echo "<pre>"; print_r($logsArr); echo "</pre>";
	?>
    <table width="1000" border="0" style="background:#FFFFFF;" class="popuptbl" cellpadding="0" cellspacing="0">
        <tr>
        	<th align="left"><strong>Circular Email Logs</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td colspan="2" width="100%" id="test_circular_td">
            <div style="height:650px; overflow:auto; position:relative;">
                <table border="0" width="100%" cellpadding="0" cellspacing="1" bgcolor="#E5F1FG">
                
				<?
                if(count($logsArr)>0) {
                    foreach($logsArr as $K1=>$V1) {
					
					?>
                    <tr bgcolor="#CCCCCC">
                    	<th colspan="5"><?=$GLOBALS['CircularMailType'][$K1]?></th>
                        <th align="right" style="padding-right:20px;">
						<? if($K1=="S") { ?> <?=count($rs_student_count)?> <? } ?>
                        </th>
                    </tr>
                    <?
						if(count($V1)>0) {
							foreach($V1 as $K=>$V) {
							
						
						$bgcolor="#f7f7f7";
						if($K%2==0) $bgcolor="#FFFFFF";
						$mailtype="";
						if($V->mail_type=="S") $mailtype="Parent"; else if($V->mail_type=="T") $mailtype="Teacher"; else if($V->mail_type=="NS") $mailtype="Newsletter Contacts";
                ?>
                	<? if($K==0) { ?>
        			<tr style="background:#E4C6A0; color:#FFF; font-weight:bold; font-size:16px;">
                        <td width="20%">Date / Time</td>
                        <td width="23%">Email To</td>
                        <? if($V->mail_type=="S") { ?><td width="18%">Student Name</td><? } ?>
                        <td width="17%">Email Address</td>
                        <td width="10%">Mobile #</td>
                        <td width="12%" <?=($V->mail_type!="S")?"colspan=2":""?> align="center">Action</td>
                    </tr>
                    <? } ?>
                    <tr bgcolor="<?=$bgcolor?>">
                      <td><?=date("M d, Y g:i A", strtotime($V->added_date))?></td>
                      <td><?=$V->name?></td>
                      <? if($V->mail_type=="S") { ?><td><?=$V->student_name?></td><? } ?>
                      <td><?=$V->email_address?></td>
                      <td><?=$V->mobile_number?></td>
                      <td align="center" <?=($V->mail_type!="S")?"colspan=2":""?>>
                      	<img src="images/resend_btn.png" alt="Resend" title="Resend" style="cursor:pointer;" onclick="resendEmail('<?=$V->id?>', '<?=$circularId?>')" align="absmiddle" border="0" />
                      </td>
                    </tr>
                
				 <?
				 			}
						}
                    }
                } else {
				?>
                	<tr>
                    	<td colspan="6">No Logs Found</td>
                    </tr>
                <?
				}
                ?>
                
        		</table>
                </div>
             </td>
         </tr> 
    </table>
    <?
	exit();
}

if($_POST['act']=="reSendCircularEmail") {
	ob_clean();
	
	$circular_obj= new Circular();
	$circular_obj->id=$_POST['logId'];
	$rs_email_log = $circular_obj->getCircularEmailLogDtl();
	
	$_POST['nid'] = $rs_email_log->circular_id;
	
	$rs_circular = Circulars::getCircularById($rs_email_log->circular_id);	

	if($rs_email_log->id!=NULL && $rs_circular->id!=NULL) {
		
		$contact_number = $rs_email_log->mobile_number;
		//$contact_number = TO_MOBILE;
	
		$totalCnt = 1;  
		
		ob_clean();
		include "view_newsletter.php";					
		$MailContent=ob_get_contents();
		ob_end_clean();
	
		$email_address	= $rs_email_log->email_address;
		$From			= SITE_EMAIL;
		$fromName		= FROM_NAME;
		$Subject		= $rs_circular->subject;
		if(is_file(NEWSLETTER_PATH.$rs_circular->ns_file)){
			$attachmentFile = NEWSLETTER_PATH.$rs_circular->ns_file;
		}
		
		$emailAddress = $email_address;
		//include "sendgrid.php";
		Circulars::insertCircularMailLog($rs_email_log->circular_id, $rs_email_log->mail_type, $rs_email_log->name, $rs_email_log->student_name, $emailAddress, $contact_number, 'Y');
		
		$newsletter_name = stripslashes($rs_circular->title);
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
			//$url="http://www.nexmoo.com/ytrain/smssent.php";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, count($fields));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//$result= curl_exec ($ch);
			curl_close ($ch);
		}
		
	}
	
	echo $emailAddress."...".$contact_number."...".$totalCnt;
	echo '<br />';
	
	exit();
}

if($_POST['act']=="showStatusFrm") {
	ob_clean();
	$rs_circular = Circulars::getCircularById($_POST['circularId']);
	?>
    <table width="500" border="0" style="background:#FFF;" class="popuptbl" cellpadding="0" cellspacing="0">
        <tr>
        	<th align="left"><strong>Update Status</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        
        <tr>
        	<td id="test_circular_td">
                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="40%" height="30" id="td_from_address"><strong>Select Status</strong></td>
                      <td>
                      	<select name="new_status" id="new_status" class="listbox">
                        	<option value="">Choose Status</option>
                            <? if($rs_circular->status!="S") { ?>
							<? if($rs_circular->status=="N") { ?><option value="S">Sent</option> <? } ?>
                            <? if($rs_circular->status=="D" || $rs_circular->status=="") { ?><option value="D">Save</option><? } ?>
                            <? if($rs_circular->status!="N" && $rs_circular->status=="D") { ?><option value="N">Add</option><? } ?>
                            <? } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td  width="40%" height="30" colspan="2" align="center">
                      <div class="combutton pull_right padlr10 padtb10 txtbold letterspac f18" onclick="updateStatus('<?=$_POST['circularId']?>', 'S')">Send Now</div>
                   </tr>
                </table>
             </td>
         </tr>   
    </table>
    <?
	exit();
}

if($_POST['act']=="saveStatusFrm") {
	ob_clean();
	Circulars::updateCircularByField('status', $_POST['newStatus'], $_POST['circularId']);
	exit();
}

?>

<script type="text/javascript">
$(function() {
   $(".datepicker").datepicker({
		changeMonth: true
   });  
});
</script>

<style>
.boxerror {border:1px solid #F00;}
.txterror {color: #F00;}
</style>

<link rel="stylesheet" type="text/css" href="css/default_style.css" />


<div class="fullsize">
    <div class="content">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright10" /></td>
                <td>Manage <br/> <span class="f30"><strong>Newsletter</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop50">
            <a href="newsletter.php" style="color:#333;">Add Newsletter</a>
        </div>
    </div>
    
    </div>
</div>



<div class="fullsize">
    <div class="content">
    
        <div class="fullsize newsletter_outer">
        	
            <div class="newsletter_left"> <!-- Newsletter Circular -->
            	<div class="newsletter_submenu txtwhite">
					<div class="circular_outer">
                    	<div class="newcircular_head" id="show_newcircular" onclick="showMenuList('N');">New Circulars<span></span></div>
                        <ul class="newcircular_content txttheme" id="curcularmenutab_N" style="padding-right:10px; float:left;"></ul>
                    </div>
                    
                    <div class="circular_outer" style="clear:both;">
                    	<div class="newcircular_head" id="show_draftcircular" onclick="showMenuList('D');">Draft Circulars <span></span></div>
                        <ul class="draftcircular_content txttheme" id="curcularmenutab_D" style="padding-right:10px; float:left;"></ul>
                    </div>
                    
                    <div class="circular_outer" style="clear:both;">
                    	<div class="newcircular_head" id="show_sentcircular" onclick="showMenuList('S');">Sent Circulars <span></span></div>
                        <ul class="sentcircular_content txttheme" id="curcularmenutab_S" style="padding-right:10px; padding-bottom:20px;"></ul>
                    </div>
                </div>
            </div><!-- Newsletter Circular -->
            
            
            <!-- Newsletter Form -->
            <div class="newsletter_right border_theme bgwhite" id="addnstab"><? include "newsletter_add.php"; ?></div><!-- Newsletter Form -->
            
        </div>
    
    </div>
</div>

<div id="circular_popup" style="margin:0px; padding:0px;"></div>


<script type="text/javascript">

showMenuList('N');
function showMenuList(type) { 
	
	ajax({
		a:'newsletter',
		b:'act=loadMenuList&type='+type,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#curcularmenutab_"+type).html(data);
 		}			
	});
	
}

function circularListPaging(page, type) { 
	
	ajax({
		a:'newsletter',
		b:'act=loadMenuList&type='+type+'&page='+page,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#curcularmenutab_"+type).html(data);
 		}			
	});
	
}

function showCircular(action, id) { //alert(action); alert(id);
	
	$("#addnstab").html('<div><img src="images/loader.gif" /></div>');
	ajax({ 
		a:'newsletter',
		b:'act=showNewCircular&Action='+action+'&nsId='+id,
		c:function(){},
		d:function(data){ //alert(data);
			if(action=="D") {
				alert('Circular deleted successfully..!');
				window.location.href="newsletter.php";
			} else {
				$("#addnstab").html(data);
			}
		}
	});
	
}

function popupDtls(){
	
	$("#circular_popup").show();
  	$("#circular_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true
	});
						
	$(".ui-widget-header").css({"display":"none"});
}
function closePopup(){ $("#circular_popup").dialog('close');  }

function sendTestCircular(id){
	
	ajax({
		a:'newsletter',							
		b:'act=showTestCircularEmail&id='+id,
		c:function(){},
		d:function(data) {
			$("#circular_popup").html(data);
			popupDtls();
		}
	});
	
}

function setOptions(circular_id) { 

	var option = $('input[name=send_option]:checked').val();
	
	$('.sendparentoption').hide();
	$('.sendteacheroption').hide();
	$('.sendotheroption').hide();
	$('#single_student_name').val('');
	$('#single_teacher_name').val('');
	
	if(option=="P") {
		$('.sendparentoption').show();
	} else if(option=="T") {
		$('.sendteacheroption').show();
	} else if(option=="O") {
		$('.sendotheroption').show();
	}

	$("#single_student_name").autocomplete("search_details.php?search_type=circular_parent&type=parent&circular_id="+circular_id,{ 
	width:'auto',selectFirst: false,
	select: function(event, ui) { alert(event); }});	
	$("#single_student_name").result(function(event, data, formatted) {
		$("#single_student_name_id").val(data[1]);
	});
	
	$("#single_teacher_name").autocomplete("search_details.php?search_type=circular_parent&type=teacher&circular_id="+circular_id,{ 
	width:'auto',selectFirst: false,
	select: function(event, ui) { alert(event); }});	
	$("#single_teacher_name").result(function(event, data, formatted) {
		$("#single_teacher_name_id").val(data[1]);
	});
	
}

function testCircularForm() {
	var err=0;
	
	if($('#test_from_address').val()==''){ err=1; $('#test_from_address').addClass('boxerror'); } else{ $('#test_from_address').removeClass('boxerror'); }
	if($('#test_from_address').val()!='')
	{
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#test_from_address').val()) == false) 
		{
			err=1;
			$('#test_from_address').addClass('boxerror');
		}
		else{
			$('#test_from_address').removeClass('boxerror');
		}
	}
	
	if($('#to_email').val()==''){ err=1; $('#to_email').addClass('boxerror'); } else{ $('#to_email').removeClass('boxerror'); }
	if($('#to_email').val()!='')
	{
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#to_email').val()) == false) 
		{
			err=1;
			$('#to_email').addClass('boxerror');
		}
		else{
			$('#to_email').removeClass('boxerror');
		}
	}
	
	if($('#test_Subject').val()==''){ err=1; $('#test_Subject').addClass('boxerror'); } else{ $('#test_Subject').removeClass('boxerror'); }
	if($('#to_mobile').val()==''){ err=1; $('#to_mobile').addClass('boxerror'); } else{ $('#to_mobile').removeClass('boxerror'); }
	
	var test_from_address = $('#test_from_address').val();
	var test_Subject = $('#test_Subject').val();
	var to_email = $('#to_email').val();
	var test_addschedule = $('input[name=test_addschedule]:checked').val();
	var test_nid = $('#test_nid').val();
	var test_mobile = $('#to_mobile').val();
	var send_option = $('input[name=send_option]:checked').val();
	var student_id = $('#single_student_name_id').val();
	var teacher_id = $('#single_teacher_name_id').val();
	var send_unsub = $('input[name=test_is_unsubscribe]:checked').val();
	
	if(err==0){
	
		$('#test_circular_td').html('<span style="font-size:24px; padding:20px; color:#BD220A">sending please wait...</span>');
		ajax({
			a:'newsletter',							
			b:'act=sendTestCircularEmail&nid='+test_nid+'&test_from_address='+test_from_address+'&test_Subject='+test_Subject+'&to_email='+to_email+'&test_addschedule='+test_addschedule+'&test_mobile='+test_mobile+'&send_option='+send_option+'&student_id='+student_id+'&teacher_id='+teacher_id+'&send_unsub='+send_unsub,
			c:function(){},
			d:function(data) {
			//alert(data);
				$('#test_circular_td').html(data);
			}
		});
	}
	
}

function sendCircular(id){
	
	ajax({
		a:'newsletter',							
		b:'act=showCircularEmail&id='+id,
		c:function(){},
		d:function(data) {
			$("#circular_popup").html(data);
			popupDtls();
		}
	});
	
}

function bulkCircularForm() {
	
   err=0;
	
	if($('#from_address').val()==''){ err=1; $('#from_address').addClass('boxerror'); } else{ $('#from_address').removeClass('boxerror'); }
	
	if($('#from_address').val()!='')
		{
		 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			if(reg.test($('#from_address').val()) == false) 
			{
				err=1;
				$('#from_address').addClass('boxerror');
			}
			else{
				$('#from_address').removeClass('boxerror');
			}
		}
	
	if($('#Subject').val()==''){ err=1; $('#Subject').addClass('boxerror'); } else{ $('#Subject').removeClass('boxerror'); }
	
	var from_address = $('#from_address').val();
	var Subject = $('#Subject').val();
	var circular_group = $('input[name=circular_group[]]:checked').map(function(){ return this.value; }).get();
	var addschedule = $('input[name=addschedule]:checked').val();
	var nid = $('#nid').val();
	var send_unsub = $('input[name=is_unsubscribe]:checked').val();
	
	if(err==0) {
		$('#circular_td').html('<span style="font-size:24px; padding:20px; color:#BD220A">sending please wait...</span>');
		ajax({
			a:'newsletter',							
			b:'act=sendCircularEmail&nid='+nid+'&from_address='+from_address+'&Subject='+Subject+'&circular_group='+circular_group+'&addschedule='+addschedule+'&send_unsub='+send_unsub,
			c:function(){},
			d:function(data) {
				//alert(data);
				$('#circular_td').html(data);
			}
		});
	}
   
}

function showEmailLogs(circular_id) {
	
	ajax({
		a:'newsletter',							
		b:'act=getAllEmailLogs&circularId='+circular_id,
		c:function(){},
		d:function(data) {
			//alert(data);
			$("#circular_popup").html(data);
			popupDtls();
		}
	});
	
}

function resendEmail(log_id, circular_id) {
	
	if(confirm('Are you sure want to resend this Circular!')){
		ajax({
			a:'newsletter',							
			b:'act=reSendCircularEmail&logId='+log_id,
			c:function(){},
			d:function(data) {
				//alert(data);
				alert('Mail resent successfully');
				showEmailLogs(circular_id);
			}
		});
	}
		
}

function updateStatus(id, action) {
	
	if(action=="U") {
		ajax({
			a:'newsletter',							
			b:'act=showStatusFrm&circularId='+id,
			c:function(){},
			d:function(data) {
				//alert(data);
				$("#circular_popup").html(data);
				popupDtls();
			}
		});
	}
	
	if(action=="S") {
		var err=0;
		var newStatus = $('#new_status').val();
		if($('#new_status').val()==''){ err=1; $('#new_status').addClass('boxerror'); } else{ $('#new_status').removeClass('boxerror'); }
		if(err==0) {
		ajax({
			a:'newsletter',							
			b:'act=saveStatusFrm&circularId='+id+'&newStatus='+newStatus,
			c:function(){},
			d:function(data) {
				alert('Updated Successfully');
				window.location.href="newsletter.php";
			}
		});
		}
	}
	
}

$("#show_newcircular").click(function(){
   $(this).addClass('active');
   $("#show_draftcircular").removeClass('active');
   $("#show_sentcircular").removeClass('active');
   $(".newcircular_content").show();
   $(".draftcircular_content").hide();
   $(".sentcircular_content").hide();   
});


$("#show_draftcircular").click(function(){
   $(this).addClass('active');
   $("#show_newcircular").removeClass('active');
   $("#show_sentcircular").removeClass('active');
   $(".newcircular_content").hide(); 
   $(".draftcircular_content").show(); 
   $(".sentcircular_content").hide(); 
});


$("#show_sentcircular").click(function(){
   $(this).addClass('active');
   $("#show_newcircular").removeClass('active');
   $("#show_draftcircular").removeClass('active');
   $(".newcircular_content").hide(); 
   $(".draftcircular_content").hide(); 
   $(".sentcircular_content").show(); 
});




</script>



<?
}
include "template.php";
?>