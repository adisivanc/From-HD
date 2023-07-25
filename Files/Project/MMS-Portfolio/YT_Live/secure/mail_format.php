<?
function main(){ 
ini_set('max_execution_time', 500000000000);	
	
if($_POST['act']=="showNewCircular") {
	ob_clean();
	if($_POST['Action']=="MC") {
		include "mail_categories.php";
	} else {
		$circularId = $_POST['nsId'];
		$rs_circular = Circulars::getCircularById($circularId);
		if($_POST['Action']=="N" || $_POST['Action']=="E") include "mail_format_add.php";
		else if($_POST['Action']=="V") { 
		?>
        <div class="fullsize lineht2 border_bottom">
            <div class="pull_left padlr10 padtb10 txtbold letterspac f18"><?=stripslashes($rs_circular->title)?></div>
        </div>
        <div class="fullsize lineht2 border_bottom">
            <div class="pull_right pad10 cursor">
            	<img src="images/log_icon.png" alt="Mail Log" title="Mail Log" align="absmiddle" onclick="showEmailLogs('<?=$rs_circular->id?>')" />
            </div>
            <div class="pull_right pad10 cursor">
            	<img src="images/mail_icon.png" alt="Single Mail" title="Single Mail" align="absmiddle" onclick="sendTestCircular('<?=$rs_circular->id?>');" />
            </div>
            <div class="pull_right pad10 cursor">
            	<img src="images/delete_icon.png" alt="Delete" title="Delete" align="absmiddle" onclick="if(confirm('Are you sure want to delete the selected Subject?')) showCircular('D', '<?=$rs_circular->id?>');" />
            </div>
            <div class="pull_right pad10 cursor">
            	<a href="mail_format.php?nsId=<?=$rs_circular->id?>"><img src="images/edit_icon.png" alt="Edit" title="Edit" align="absmiddle" /></a>
            </div>
        </div>
        
        <div class="fullsize margintb10"><? include "view_newsletter.php"; ?></div>
			
        <?
		}
		else if($_POST['Action']=="D") {
			$rs_circular =Circulars::getCircularbyId($circularId);
			$tmpheaderArr = unserialize($rs_circular->header_details);
			$header_file_name=$tmpheaderArr['Img'];
			if($header_file_name!="") {  
				$delete_file1 = NEWSLETTER_HEADER_PATH.$header_file_name;
				if(is_file($delete_file1)) @unlink($delete_file1);
			} 
			$no_of_inner_image = $rs_circular->no_of_inner_image;
			if($no_of_inner_image>0) {
				for($i=1; $i<=$no_of_inner_image; $i++) {
					$tmpinnerArr = unserialize($rs_circular->inner_images);
					$inner_file_name=$tmpinnerArr['Img'.$i];
					$delete_file2 = NEWSLETTER_WELCOME_PATH.$inner_file_name;
					if(is_file($delete_file2)) @unlink($delete_file2);
				}
			}
			$modulesArr = unserialize($rs_circular->modules);
			if(count($modulesArr)>0 && !empty($modulesArr)) { 
				foreach($modulesArr as $mk=>$mv) {  
					if($mv['MHBoxType']=="I") {
						$module_file_name=$mv['MHBoxDetails']['Image'];
						$delete_file3 = NEWSLETTER_MODULE_PATH.$module_file_name;
						if(is_file($delete_file3)) @unlink($delete_file3);
					}
				}
			}
			Circulars::deleteCircularById($circularId);
		}
	}
		
	exit();
}

if($_POST['act']=="loadMenuList") {
	ob_clean();
	$circular_obj = new Circulars();
	$circular_obj->sortby="DESC";
	$circular_obj->orderby="id";
	$circular_obj->ns_main_type="MT";
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
					
	exit();
}

if($_POST['act']=="saveCircular") {
	
	//echo "<pre>"; print_r($_POST); echo "</pre>";
	//echo "<pre>"; print_r($_FILES); echo "</pre>"; 
	
	$ns_main_type = "MT";
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
	
	$status = "A";
	$is_highlight_text = $_POST['highlight_text'];
	$term_calender_position = $_POST['term_calender_position'];
	if($_POST['ns_date']!="" && $_POST['ns_date']!="0000-00-00") $nsdate=date("Y-m-d", strtotime(trim($_POST['ns_date']))); else $nsdate="";
	$ns_date = $nsdate;
	$mail_template_action = trim($_POST['mail_template_action']);
	
	if($_POST['newsletter_db_id']!="" && $_POST['newsletter_db_id']!="undefined") {
		$rs_id = $_POST['newsletter_db_id'];
		Circulars::updateCircular($rs_id, $ns_main_type, $ns_type, $title, $subject, $header_type, $welcome_note, $welcome_text, $no_of_inner_image, $welcome_description, $conclusion_text, $regards_text, $regards_from_text, $send_date, $send_time, $send_time_format, $send_date_position, $status, $apply_to, $is_highlight_text, $term_calender_position, $ns_date, $circular_send_to, $is_configure_url, $button_type, $configure_url, $mail_template_action);
	} else {
		$rs_id = Circulars::insertCircular($ns_main_type, $ns_type, $title, $subject, $header_type, $welcome_note, $welcome_text, $no_of_inner_image, $welcome_description, $conclusion_text, $regards_text, $regards_from_text, $send_date, $send_time, $send_time_format, $send_date_position, $status, $apply_to, $is_highlight_text, $term_calender_position, $ns_date, $circular_send_to, $is_configure_url, $button_type, $configure_url, $mail_template_action);
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
			//smart_resize_image(NEWSLETTER_HEADER_PATH.$filepath_header, null, 800, 304, true, NEWSLETTER_HEADER_PATH.$filepath_header, false, false, 100);
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
			//smart_resize_image(NEWSLETTER_WELCOME_PATH.$filepath_inner_img, null, 800, 304, true, NEWSLETTER_WELCOME_PATH.$filepath_inner_img, false, false, 100);
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
		Circulars::updateCircularByField('highlight_text_details', $highlight_details, $rs_id);
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
						//smart_resize_image(NEWSLETTER_MODULE_PATH.$filepath_modules, null, 800, 304, true, NEWSLETTER_MODULE_PATH.$filepath_modules, false, false, 100);
					}
					if($filepath_modules!="") $filepath_modules_name=$filepath_modules; else $filepath_modules_name=$_POST['h_module_highlight_img_'.$index];
					$modulesArr[$mk]['MHBoxDetails']['Image']=$filepath_modules_name;
				}
				if($modulesArr[$mk]['MHBoxType']!="N") $modulesArr[$mk]['MHBoxPosition']=$modules['module_highlight_box_position'][$index];
			$index++;
			}
		}
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
	
	if($rs_id!="") { ?><script type="text/javascript">window.location.href="mail_format.php";</script> <? //header("Location: newsletter.php");
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
                      <td  width="40%" height="30" colspan="2" align="center">
                      	<div class="combutton pull_right padlr10 padtb10 txtbold letterspac f18" id="testmailsendingbtn" onclick="testCircularForm()">Send Now</div>
                        <div class="combutton pull_right padlr10 padtb10 txtbold letterspac f18" id="testmailloadingbtn" style="display:none;">Sendig..</div>
                      </td>
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
		if($rs_student->father_email!="" && $rs_student->f_email_subscription=="Y") $emailArr[]=$rs_student->father_email."~".$rs_student->father_name."~".$rs_student->father_phone."~"."SF"."~".trim($student_name)."~".$rs_student->id."~".$rs_student->grade_id;
		if($rs_student->mother_email!="" && $rs_student->m_email_subscription=="Y") $emailArr[]=$rs_student->mother_email."~".$rs_student->mother_name."~".$rs_student->mother_phone."~"."SM"."~".trim($student_name)."~".$rs_student->id."~".$rs_student->grade_id;
		if($rs_student->father_email=="" && $rs_student->mother_email=="" && $rs_student->e_email_subscription=="Y") 
		$emailArr[]=$rs_student->email_address."~".$rs_student->father_name."~".$rs_student->mobile."~"."SE"."~".trim($student_name)."~".$rs_student->id."~".$rs_student->grade_id;
	}
	else if($_POST['send_option']=="T") { 
		$rs_teacher = Teacher::getTeachersById($_POST['teacher_id']);
		$teacher_name = $rs_teacher->first_name." ".$rs_teacher->middle_name." ".$rs_teacher->last_name;
		if($rs_teacher->email_address!="" && $rs_teacher->email_subscription=="Y") $emailArr[]=$rs_teacher->email_address."~".trim($teacher_name)."~".$rs_teacher->mobile."~"."T"."~".""."~".$rs_teacher->id;
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
			$s_or_t_id = $vvArr[5];// student or teacher id
			$grade_id = $vvArr[6]; 
			
			if($email_address!="") {
			$From       = FROM_EMAIL;
			$fromName   = FROM_NAME;
			$Subject	= $_POST['test_Subject'];
			if(is_file(NEWSLETTER_PATH.$rs_circular->ns_file)){
				$attachmentFile = NEWSLETTER_PATH.$rs_circular->ns_file;
			}
			$emailAddress = $email_address;
			
			if($_POST['send_unsub']=="Y") {
				$unsubscribe_details="";
				$unsubemailaddress = $emailAddress."||".$mail_type;
				$unsubemail = base64_encode($unsubemailaddress);
				$unsubscribe_details = BASE_URL."unsubscribe.php?id=".$unsubemail;
				$fileFrom="Mail";
				//$MailContent .= "<p>Would you like to unsubscribe newsletter. <a href='$unsubscribe_details' target='_blank'>Click here</a></p>";
			}
			
			ob_start();
			include "view_newsletter.php";					
			$MailContent=ob_get_contents();
			ob_end_clean();
			include "sendgrid.php";
			
			if($mail_type=="SF" || $mail_type=="SM" || $mail_type=="SE") $mail_log_type="S"; else $mail_log_type=$mail_type;
			Circulars::insertCircularMailLog($_POST['nid'], $mail_log_type, $send_to_name, $student_name, $emailAddress, $contact_number, 'Y', $grade_id, $s_or_t_id);
			
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
				$url="http://www.nexmoo.com/ytrain/smssent.php";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, count($fields));
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$result= curl_exec ($ch);
				curl_close ($ch);
			}
		
			echo $email_address."...".$contact_number."...".$mail_type."...".$totalCnt;
			echo '<br />';
			}
		}
	}

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
							$tech_obj->fields = "id, first_name, middle_name, last_name, email_address, mobile";
							$rs_teacher = $tech_obj->getTeachersDtls();
							if($rs_teacher->email_address!="" && !in_array($rs_teacher->email_address,$teacheremail)) {
							     $teacheremail[]=$rs_teacher->email_address;	
								 $is_exists = Circulars::checkEmailinCircularLoByType($rs_teacher->email_address, $rs_circular->id, 'T');
								 if($is_exists<=0)
								 $emailArr[]=$rs_teacher->email_address."~".$rs_teacher->first_name." ".$rs_teacher->middle_name." ".$rs_teacher->last_name."~".$rs_teacher->mobile."~"."T"."~".""."~".$rs_teacher->id."~".$rs_tt[1];
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
							if($rs_circular->circular_send_to=="N") $student_obj->is_new_student = "Y";
							if($rs_circular->circular_send_to=="O") $student_obj->is_new_student = "N";
							$student_obj->fields = "id, grade_id, first_name, middle_name, last_name, email_address, father_email, mother_email, father_phone, mother_phone, father_name, mother_name, mobile";
							$rs_student = $student_obj->getAllStudentDtls();
							$student_name = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
							if($rs_student->father_email!="") $emailArr[]=$rs_student->father_email."~".$rs_student->father_name."~".$rs_student->father_phone."~"."SF"."~".$student_name."~".$rs_student->id."~".$rs_tt[1];
							if($rs_student->mother_email!="") $emailArr[]=$rs_student->mother_email."~".$rs_student->mother_name."~".$rs_student->mother_phone."~"."SM"."~".$student_name."~".$rs_student->id."~".$rs_tt[1];
							if($rs_student->father_email=="" && $rs_student->mother_email=="" && $rs_student->email_address!="") $emailArr[]=$rs_student->email_address."~".$rs_student->father_name."~".$rs_student->mobile."~"."SE"."~".$student_name."~".$rs_student->id."~".$rs_tt[1];
						}
					}
				}
				if($rs_tt[0]=='NS'){
					$table_name = "newsletter_subscribers";
					$qry="SELECT * FROM `".TBL_NL_SUBSCRIBERS."` group by email_address";
					$rs_SelNLMember=dB::mExecuteSql($qry);
					if(count($rs_SelNLMember)>0) {
						foreach($rs_SelNLMember as $kk=>$vv) {
							if($vv->email_address!="") $emailArr[]=$vv->email_address."~".$vv->name."~".$vv->phone."~"."NS"."~".""."~".$vv->id;
						}
					}
				}

			}
			
		}
		
		$sentArr = array();
		if(count($emailArr)>0){
		ini_set('max_execution_time', 500000000000);
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
					$s_or_t_id 	= $emailid[5]; // student or teacher id
					$grade_id 	= $emailid[6]; 
					
				
					if($_POST['send_unsub']=="Y") {
						$unsubscribe_details="";
						$unsubemailaddress = $emailAddress."||".$emailType;
						$unsubemail = base64_encode($unsubemailaddress);
						$unsubscribe_details = BASE_URL."unsubscribe.php?id=".$unsubemail;
						$fileFrom="Mail";
					}
					
					if($_POST['resend_not_receive']=="Y") {
						$is_exists = Circulars::checkEmailinCircularLog($emailAddress, $rs_circular->id);
						if($is_exists==1) continue;
					}

					ob_start();
					include "view_newsletter.php";					
					$MailContent=ob_get_contents();
					ob_end_clean();
					
					if($sentCnt<=500) { 
					
					
					if(!in_array($emailAddress,$sentArr)) {
					$sentArr[]=$emailAddress;	
						$send=0;
						$From       	= SITE_EMAIL;
						$fromName   	= FROM_NAME;
						if(is_file(NEWSLETTER_PATH.$rs_circular->ns_file)){
							$attachmentFile = NEWSLETTER_PATH.$rs_circular->ns_file;
						}
						include "sendgrid.php";
						
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
						
						if($emailType=="SF" || $emailType=="SM" || $emailType=="SE") $email_log_type = "S"; else $email_log_type = $emailType;
						Circulars::insertCircularMailLog($_POST['nid'], $email_log_type, $emailName, $studentName, $emailAddress, $contact_number, 'Y', $grade_id, $s_or_t_id);
						Circulars::updateCircularByField('status', "S", $_POST['nid']);
						
						echo $emailid[0]."...".$contact_number."...".$email_log_type."...".$totalCnt;
						echo '<br />';
					
					} else {						
						
						if(!in_array($emailAddress,$sentArr)) {
						$sentArr[]=$emailAddress;	
						$arrayCnt++;
				
						$Sentemail_idArrLater[] = $emailid[0].'~'.$emailid[1].'~'.$emailid[2].'~'.$emailid[3].'~'.$emailid[4].'~'.$emailid[5].'~'.$emailid[6];
						$Sentemail_idArr[] = $emailid[0];
						if($arrayCnt>=500 || $sentCnt==$totalCnt){
							
							$arrayCnt=0;
							$members = implode('::::',$Sentemail_idArrLater);
						
							$temp=time();
							$currentdate=date("Y-m-d H:i:s", $temp);
							$rs_NewsDtl = Circulars::insertCircularLog($_POST['nid'], $members, $_POST['send_unsub'], $_POST['resend_not_receive'], $currentdate);
							$Sentemail_idArrLater= array();
						
						}
						}
				
					}
					
				}
			}
			exit();	
			
				
	    }
		
	}	
	
	exit();
}

if($_POST['act']=="getAllEmailLogs") {
	ob_clean();
	$circularId = $_POST['circularId'];
	
	$circular_obj = new Circulars();
	$circular_obj->circular_id=$circularId;
	$circular_obj->groupby='mail_type';
	$circular_obj->fields='mail_type as mailType, count(*) as totalLog';
	$circular_obj->sortby="DESC";
	$circular_obj->orderby="added_date";
	$rs_circulars = $circular_obj->getCircularEmailLogDtl();
	?>
    <table width="1200" border="0" style="background:#FFFFFF;" class="popuptbl" cellpadding="0" cellspacing="0">
        <tr>
        	<th align="left"><strong>Circular Email Logs</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td colspan="2" width="100%" id="test_circular_td">
            <div style="max-height:650px; overflow-y:auto; position:relative;">
                <table border="0" width="100%" cellpadding="0" cellspacing="1" bgcolor="#E5F1FG">
				<? if(count($rs_circulars)>0) {
                    foreach($rs_circulars as $K1=>$V1) { ?>
                    <tr bgcolor="#CCCCCC">
                    	<th width="90%"><?=$GLOBALS['CircularMailType'][$V1->mailType]?></th>
                        <th align="right" style="padding-right:20px;" width="10%"><?=$V1->totalLog?>
                        <div class="arrow cursor tabbtn1" id="tabbtn1_<?=$V1->mailType?>" onclick="showMailLogDtls('<?=$V1->mailType?>', '<?=$circularId?>')" style="position:relative; top:30%;"></div></th>
                    </tr>
                    <tr id="mailtypelogtd<?=$V1->mailType?>" class="mailtypelogtd1" style="display:none;">
                    	<td colspan="2" id="mailtypelogs<?=$V1->mailType?>" class="mailtypelogs1" style="padding:0px;"></td>
                    </tr>
                    <? }
                } else { ?>
                	<tr>
                    	<td colspan="2" bgcolor="#f7f7f7">No Logs Found</td>
                    </tr>
                <? } ?>
        		</table>
                </div>
             </td>
         </tr> 
    </table>
    <?
	exit();
}

if($_POST['act']=="loadMailLogs") {
	ob_clean();
	$circularId = $_POST['circularId'];
	$logType = $_POST['logType'];
	
	$cir_log = new Circulars();
	$cir_log->circular_id=$circularId;
	$cir_log->mail_type=$logType;
	if($logType=="S") $cir_log->groupby="grade_id";
	$cir_log->sortby="DESC";
	$cir_log->orderby="added_date";
	$rs_logs = $cir_log->getCircularEmailLogDtl();
	?>
    <table border="0" width="100%" cellpadding="0" cellspacing="1" bgcolor="#E5F1FG">
    	<? if($logType=="S") { ?>
        <tr>
        	<td align="right"> <? if(count($rs_logs)>0) { ?><strong>Total Students: <span id="studentcount<?=$logType?>" style="margin-left:5px;margin-right:10px;"></span></strong>
                    <select id="log_grade_id" name="log_grade_id" class="listbox" onchange="showMailLogsByGrade('<?=$circularId?>', '<?=$logType?>')">
                        <option value="">All Grade</option>
                        <? foreach($rs_logs as $kk=>$vv) { $rs_grade = Grade::getGradeById($vv->grade_id);
						?><option value="<?=$vv->grade_id?>"><?=$rs_grade->grade_name?></option> <? } ?>
                    </select>
               <? } ?>
            </td>
        </tr>
        <tr id="grademaillogtr" style="display:none;">
        	<td id="grademaillogs" style="padding:0px;"></td>
        </tr>
        <script type="text/javascript">showMailLogsByGrade('<?=$circularId?>', '<?=$logType?>');</script>
        <? } else { ?>
	<?
	if(count($rs_logs)>0) {
		foreach($rs_logs as $K=>$V) {
		$bgcolor="#f7f7f7"; if($K%2==0) $bgcolor="#FFFFFF";
		$mailtype="";
		if($V->mail_type=="T") $mailtype="Teacher"; else if($V->mail_type=="NS") $mailtype="Newsletter Contacts";
    ?>
        <? if($K==0) { ?>
        <tr style="background:#E4C6A0; color:#FFF; font-weight:bold; font-size:16px;">
            <td width="4%" align="center">#</td>
            <td width="16%">Date / Time</td>
            <td width="18%">Email To</td>
            <td width="17%">Email Address</td>
            <td width="11%">Mobile #</td>
            <td width="8%" align="center">Action</td>
        </tr>
        <? } ?>
        <tr bgcolor="<?=$bgcolor?>">
       	  <td align="center"><?=($K+1)?></td>
          <td><?=date("M d, Y g:i A", strtotime($V->added_date))?></td>
          <td><?=$V->name?></td>
          <td><?=$V->email_address?></td>
          <td><?=$V->mobile_number?></td>
          <td align="center">
            <div class="combutton pull_right padlr10 padtb10 txtbold letterspac f12" id="resendBtn" onclick="resendEmail('<?=$V->id?>', '<?=$circularId?>', '<?=$logType?>')">Resend</div>
            <div class="combutton pull_right padlr10 padtb10 txtbold letterspac f12" id="resendLoadingBtn" style="display:none;">Sending..</div>
          </td>
        </tr>
    
     <?
		}
	} else { ?>
        <tr>
            <td colspan="6" bgcolor="#f7f7f7">No Logs Found</td>
        </tr>
    <? } ?>
    <? } ?>
    </table>
    <?
	exit();
}

if($_POST['act']=="loadGradeMailLogs") {
	ob_clean();
	$circularId = $_POST['circularId'];
	$logType = $_POST['logType'];
	$logGradeId = $_POST['logGradeId'];
	
	$cir_log = new Circulars();
	$cir_log->circular_id=$circularId;
	$cir_log->mail_type=$logType;
	$cir_log->grade_id=$logGradeId;
	$cir_log->sortby="DESC";
	$cir_log->orderby="added_date";
	$rs_logs = $cir_log->getCircularEmailLogDtl();
	
	$logsArr=array();
	if(count($rs_logs)>0) {
		foreach($rs_logs as $kk=>$vv) {
			$logsArr[$vv->student_name][] = $vv;
		}
	}
	//echo "<pre>"; print_r($logsArr); echo "</pre>";
	?>
    <table border="0" width="100%" cellpadding="0" cellspacing="1" bgcolor="#E5F1FG">
    	
    	<? $index=0; if(count($logsArr)>0 && !empty($logsArr)) {
			foreach($logsArr as $K=>$V) { $bgcolor="#f7f7f7"; if($index%2==0) $bgcolor="#FFFFFF";
			$parentDtlArr = $V;
		?>
        	<? if($index==0) { ?>
            <tr style="background:#E4C6A0; color:#FFF; font-weight:bold; font-size:16px;">
                <td width="4%" align="center">#</td>
                <td width="87%">Student Name</td>
                <td width="9%">Action</td>
            </tr>
            <? } ?>
            <tr bgcolor="<?=$bgcolor?>">
            	<td align="center"><?=($index+1)?></td>
                <td><?=trim($K)?>
                	<div id="hideandshowtr_<?=$index?>" style="display:none;">
                    <table border="0" width="100%" cellpadding="0" cellspacing="1" bgcolor="#E5F1FG" style="margin-top:10px;">
                        <tr style="background:#E4C6A0; color:#FFF; font-weight:bold; font-size:16px;">
                            <td width="4%" align="center">#</td>
                            <td width="16%">Date / Time</td>
                            <td width="18%">Parent Name</td>
                            <td width="17%">Parent Email</td>
                            <td width="11%">Mobile #</td>
                            <td width="8%" align="center">Action</td>
                        </tr>
                        <?
                        if(count($parentDtlArr)>0 && !empty($parentDtlArr)) {
                            foreach($parentDtlArr as $k1=>$v1) { $bgcolor1="#f7f7f7"; if($k1%2==0) $bgcolor1="#FFFFFF";
                        ?>
                        <tr bgcolor="<?=$bgcolor1?>">
                            <td width="4%" align="center"><?=($k1+1)?></td>
                            <td width="16%"><?=date("M d, Y", strtotime($v1->added_date))?> <br /><?=date("g:i A", strtotime($v1->added_date))?></td>
                            <td width="18%"><?=$v1->name?></td>
                            <td width="17%"><?=$v1->email_address?></td>
                            <td width="11%"><?=$v1->mobile_number?></td>
                            <td width="8%" align="center">
                            <div class="combutton pull_right padlr10 padtb10 txtbold letterspac f12" id="resendBtn" onclick="resendEmail('<?=$v1->id?>', '<?=$circularId?>', '<?=$logType?>')">Resend</div>
                            <div class="combutton pull_right padlr10 padtb10 txtbold letterspac f12" id="resendLoadingBtn" style="display:none;">Sending..</div>
                            </td>
                        </tr>
                        <?
                            }
                        }
                        ?>
                    </table>
                    </div>
                </td>
                <td><div class="hideandshow cursor tabbtn2" id="tabbtn2_<?=$index?>" onclick="showStudentLogDtls('<?=$index?>');"></div></td>
            </tr>
        <?  $index++;
			}
		}
		?>
    </table>
    <?
	echo "::::".count($logsArr);
	exit();
}

if($_POST['act']=="reSendCircularEmail") {
	ob_clean();
	
	$circular_obj= new Circulars();
	$circular_obj->id=$_POST['logId'];
	$rs_email_log = $circular_obj->getCircularEmailLogDtl();
	
	$_POST['nid'] = $rs_email_log->circular_id;
	
	$rs_circular = Circulars::getCircularById($rs_email_log->circular_id);	

	if($rs_email_log->id!=NULL && $rs_circular->id!=NULL) {
		
		$contact_number = $rs_email_log->mobile_number;
		//$contact_number = TO_MOBILE;
	
		$totalCnt = 1;  
		
		ob_start();
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
		include "sendgrid.php";
		
		Circulars::insertCircularMailLog($rs_email_log->circular_id, $rs_email_log->mail_type, $rs_email_log->name, $rs_email_log->student_name, $emailAddress, $contact_number, 'Y', $rs_email_log->grade_id, $rs_email_log->mail_sent_id);
		
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
	
	echo $emailAddress."...".$contact_number."...".$totalCnt;
	echo '<br />';
	
	exit();
}


if($_POST['act']=="loadMailCategories") {
	ob_clean();
	include "mail_categories.php";
	exit();
}

if($_POST['act']=="chkCategoryAbv") {
	ob_clean();
	$cate_obj = new Circulars();
	$cate_obj->category_abv=$_POST['category_abv'];
	$cate_obj->id_not=$_POST['category_id'];
	$rs_categories = $cate_obj->getMailCategoryDtl();	
	if(count($rs_categories)>0){
		echo 'already exist';
	} else{
		echo 'not exist';
	}
	exit();
}
 
if($_POST['act']=="loadMailCat") { 
	ob_clean();
	$rs_categories = Circulars::getAllMailCategory();
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="gradetbl">
    	<tr>
        	<th width="9%">#</th>
            <th width="49%">Name</th>
            <th width="21%">Abbrivation</th>
            <th width="21%">Action</th>
        </tr>
	<?
	if(count($rs_categories)>0) {
		foreach($rs_categories as $K=>$V) {	
		$is_log = UserLog::checkLogExistsById(TBL_MAIL_CATEGORY, $V->id); 
	?>
    	<tr>
        	<td><?=($K+1)?></td>
            <td align="left"><?=$V->category_name?></td>
            <td align="center"><?=$V->category_abv?></td>
            <td>
            	<? if($GLOBALS['isDelete']) { ?><img src="images/edit_icon.png" align="absmiddle" alt="Edit" title="Edit" onClick="showCatForm('E', '<?=$V->id?>')" class="cursor" /><? } ?>
                <? if($V->is_deleteable=="Y" && $GLOBALS['isDelete']) { ?><img src="images/delete_icon.png" align="absmiddle" alt="Delete" title="Delete" class="cursor" onClick="if(confirm('Are you sure want to delete the selected Category?')) submitMailCategory('<?=$V->id?>', 'D')" /><? } ?>
                <? if($_SESSION['viewLog'] && $is_log==1){ ?><img src="images/log.png" alt="Log Details" title="Log Details" onClick="showLogDetails('<?=TBL_MAIL_CATEGORY?>', '<?=$V->id?>', '', '')" align="absmiddle" style="cursor:pointer;" /><? } ?>
            </td>
        </tr>
    <?
		}
	} else {
	?>
		<tr>
        	<td colspan="4">No details found..!</td>
		</tr>
	<?
	}
	?>
    </table>
    <?
	echo "::::";
	echo count($rs_categories);
	exit();	
}

if($_POST['act']=="loadCategoryFrm") {
	ob_clean();
	$Id = $_POST['catId'];
	$rs_category = Circulars::getMailCategorybyId($Id);
	if($rs_category->id!=NULL) foreach($rs_category as $K=>$V) $$K=$V;
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>&nbsp;<?=($Id!='')?"Edit Category":"Add Category"?></strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">
                    <tr>
                        <td>Category Name</td>
                        <td colspan="3"><input type="text" class="txtbox" name="category_name" id="category_name" value="<?=stripslashes($category_name)?>" /></td>
                    </tr>
                    <tr>
                        <td>Category Abrivation</td>
                        <td colspan="3"><input type="text" class="txtbox" name="category_abv" id="category_abv" value="<?=stripslashes($category_abv)?>" onBlur="checkAbvExits()" />
                        	<span id="cateNameErr" style="color:#F00;"></span>
                        </td>
                    </tr>
                </table>
			</td>
        </tr>
        <tr>
        	<td style="padding-left:380px;">
            	<? if($Id!='' && $Id!='undefined') $actionName="Edit"; else $actionName="Add"; ?>
            	<div class="combutton pull_right" id="mailSaveBtn" onClick="submitMailCategory('<?=$Id?>', 'S')"><?=$actionName?></div>
                <div class="combutton pull_right" id="mailProcessingBtn" style="display:none;">Processing..</div>
            </td>
        </tr>
    </table>
    <script type="text/javascript">
	
	function checkAbvExits() {
		var err=0;
		var category_id = '<?=$Id?>';
		if($('#category_abv').val()==''){ err=1; $('#category_abv').addClass('boxerror'); } else { var category_abv = $.trim($('#category_abv').removeClass('boxerror').val()); }
		
		if(err==0) {
			ajax({
				a:'mail_format',
				b:'act=chkCategoryAbv&category_abv='+category_abv+'&category_id='+category_id,
				c:function(){},
				d:function(data){
					//alert(data);
					if($.trim(data)=='already exist'){
						$('#cateNameErr').html('<br />Abbrivation already exists');
						$('#category_abv').val('');
						$('#category_abv').focus();
					}
					else{
						$('#cateNameErr').html('');
					}
				}
			});
		}
	}

	</script>
    <?
	exit();
}

if($_POST['act']=="saveMailCategories"){
	ob_clean();
	$categoryId = $_POST['categoryId'];
	
	if($_POST['catAction']=="D") {
		Circulars::deleteMailCategoryById($categoryId);
		echo "Deleted Successfully";
	} else {
		if($categoryId!="" && $categoryId!="undefined") {
			Circulars::updateMailCategory($categoryId, check_input($_POST['categoryName']), check_input(strtoupper($_POST['categoryAbv'])));
			echo "Updated Successfully";
		} else {
			Circulars::insertMailCategory(check_input($_POST['categoryName']), check_input(strtoupper($_POST['categoryAbv'])));
			echo "Inserted Successfully";
		}
	}
	
	exit();
}

if($_POST['act']=="loadExistingTemplates") {
	ob_clean();
	$mailAction = $_POST['mailAction'];
	$mail_obj = new Circulars();
	$mail_obj->mail_template_category_id = $mailAction;
	$rs_templates = $mail_obj->getCircularDtl();
	if(count($rs_templates)>0) {
	?>
    	<div align="center">Mail Template already exists for New Teacher. <br />
        Would you like to see those template. <br />Please <span class="cursor" onclick="showExistsTemplates('<?=$mailAction?>')" style="font-weight:bold;">click here.</span></div>
    <?
	}
	exit();
}

if($_POST['act']=="loadAllExitsTemplates") {
	ob_clean();
	$mailCategoryId = $_POST['mailCategoryId'];
	$mail_obj = new Circulars();
	$mail_obj->mail_template_category_id = $mailCategoryId;
	$rs_templates = $mail_obj->getCircularDtl();
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>Mail Template Details</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gradetbl">
                    <? foreach($rs_templates as $K=>$V) { ?>
                    <tr>
                        <td style="padding:10px;"><?=($K+1)?></td>
                        <td style="padding:10px;"><strong><?=$V->title?></strong></td>
                    </tr>
                    <? } ?>
                </table>
			</td>
        </tr>
    </table>
    <?
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
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright10" /></td>
                <td>Manage <br/> <span class="f30"><strong>Mail Template</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop50">
            <a href="mail_format.php"><div class="combutton pull_right f24 cursor">Add Mail Template</div></a>
        </div>
    </div>
    
</div>



<div class="fullsize">
    
        <div class="fullsize newsletter_outer">
        	
            <div class="newsletter_left"> <!-- Newsletter Circular -->
            	<div class="newsletter_submenu txtwhite">

                    <div class="circular_outer">
                    	<div class="newcircular_head tabbtn" id="tabbtn_MT" onclick="showMenuList('MT');">Mail Templates<span></span></div>
                        <ul class="listoption txttheme" id="curcularmenutab_MT" style="padding-right:10px; "></ul>
                    </div>
                    
                    <div class="circular_outer">
                    	<div class="newcircular_head tabbtn" id="tabbtn_MC" onclick="showCircular('MC');">Mail Category<span></span></div>
                    </div>
                    
                </div>
            </div><!-- Newsletter Circular -->
            
            
            <!-- Newsletter Form -->
            <div class="newsletter_right border_theme bgwhite" id="addnstab"><? include "mail_format_add.php"; ?></div><!-- Newsletter Form -->
            
        </div>
    
</div>

<div id="circular_popup" style="margin:0px; padding:0px;"></div>


<script type="text/javascript">

showMenuList('MT');
function showMenuList(type) { 
	
	$('.tabbtn').removeClass('active');
	$('#tabbtn_'+type).addClass('active');
	
	$(".listoption").hide();
	$(".listoption").html('');
	$('#curcularmenutab_'+type).show(); 
		
	ajax({
		a:'mail_format',
		b:'act=loadMenuList&type='+type,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#curcularmenutab_"+type).html(data);
 		}			
	});
	
}

function circularListPaging(page, type) { 
	
	ajax({
		a:'mail_format',
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
		a:'mail_format',
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
		draggable: true,
		position: { 'my': 'center', 'at': 'top' }
	});
						
	$(".ui-widget-header").css({"display":"none"});
}
function closePopup(){ $("#circular_popup").dialog('close');  }

function sendTestCircular(id){
	
	ajax({
		a:'mail_format',							
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
	//if($('#to_mobile').val()==''){ err=1; $('#to_mobile').addClass('boxerror'); } else{ $('#to_mobile').removeClass('boxerror'); }
	
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
	
		$('#testmailsendingbtn').hide();
		$('#testmailloadingbtn').show();
		$('#test_circular_td').html('<span style="font-size:24px; padding:20px; color:#BD220A">sending please wait...</span>');
		ajax({
			a:'mail_format',							
			b:'act=sendTestCircularEmail&nid='+test_nid+'&test_from_address='+test_from_address+'&test_Subject='+test_Subject+'&to_email='+to_email+'&test_addschedule='+test_addschedule+'&test_mobile='+test_mobile+'&send_option='+send_option+'&student_id='+student_id+'&teacher_id='+teacher_id+'&send_unsub='+send_unsub,
			c:function(){},
			d:function(data) {
			//alert(data);
				$('#test_circular_td').html(data);
			}
		});
	}
	
}


function showEmailLogs(circular_id, type) {
	
	$("#circular_popup").show();
	$("#circular_popup").dialog('open');
	$("#circular_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'mail_format',							
		b:'act=getAllEmailLogs&circularId='+circular_id,
		c:function(){},
		d:function(data) {
			//alert(data);
			$("#circular_popup").html(data);
			popupDtls();
			if(type!="" && type!=undefined) showMailLogDtls(type, circular_id)
		}
	});
}

function resendEmail(log_id, circular_id, type) {
	
	if(confirm('Are you sure want to resend this Circular!')){
		$('#resendBtn').hide();
		$('#resendLoadingBtn').show();
		ajax({
			a:'mail_format',							
			b:'act=reSendCircularEmail&logId='+log_id,
			c:function(){},
			d:function(data) {
				alert(data);
				alert('Mail resent successfully');
				showEmailLogs(circular_id, type);
			}
		});
	}
		
}

function showMailLogDtls(type, circular_id) {
	$('.tabbtn1').removeClass('active');
	$('#tabbtn1_'+type).addClass('active');
	
	$('.mailtypelogtd1').hide();
	$('.mailtypelogs1').html('');
	
	$('#mailtypelogtd'+type).show();
	$('#mailtypelogs'+type).html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'mail_format',							
		b:'act=loadMailLogs&circularId='+circular_id+'&logType='+type,
		c:function(){},
		d:function(data) { //alert(data);
			$('#mailtypelogs'+type).html(data);
		}
	});
	
}

function showMailLogsByGrade(circular_id, type) {
	var logGradeId = $('#log_grade_id').val();
	$('#grademaillogtr').show();
	$('#grademaillogs').html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'mail_format',							
		b:'act=loadGradeMailLogs&circularId='+circular_id+'&logType='+type+'&logGradeId='+logGradeId,
		c:function(){},
		d:function(data) { //alert(data);
			var dataArr = data.split('::::');
			$('#grademaillogs').html($.trim(dataArr[0]));
			$('#studentcount'+type).html($.trim(dataArr[1]));
		}
	});
}

function showStudentLogDtls(row) {
	$('.tabbtn2').removeClass('active');
	$('#tabbtn2_'+row).addClass('active');
	if($('#hideandshowtr_'+row).is(':visible')) {
		$("#hideandshowtr_"+row).hide();
	} else {
		$("#hideandshowtr_"+row).show();
	}
}

function checkTemplateExists() {
	var mail_action = $('#mail_template_action').val();
	$('#mailexisttr').show();
	$('#mailexisttab').html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'mail_format',							
		b:'act=loadExistingTemplates&mailAction='+mail_action,
		c:function(){},
		d:function(data) { //alert(data);
			$('#mailexisttab').html(data);
		}
	});
}

function showExistsTemplates(category_id) {
	$("#circular_popup").show();
	$("#circular_popup").dialog('open');
	$("#circular_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'mail_format',							
		b:'act=loadAllExitsTemplates&mailCategoryId='+category_id,
		c:function(){},
		d:function(data) {
			//alert(data);
			$("#circular_popup").html(data);
			popupDtls();
		}
	});
}


</script>



<?
}
include "template.php";
?>