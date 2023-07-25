<?
function main(){

/********************************sivamani working here**********************************/
if($_POST['act']=="send_ParentLog_authentication")
{
	ob_clean();
	?>
 <!--   <table border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>Send Email To parents</strong>
            <span onclick="close_parent_email_popup()" class="popup_closebtn" title="Close" style="cursor:pointer; font-weight:bold; font-size:20px;" align="right"><strong>X</strong></span></th>
        </tr>
        <tr>
            <td>-->
        <?
		$studentId=$_POST['studentId'];
		
		$Subject="Parent Login as Been Created";
		
		$rs_student=Student::getStudentById($studentId);
		$emailString=$rs_student->father_email."-".$rs_student->mother_email;
		$contactNoString=$rs_student->father_phone."-".$rs_student->mother_phone;
		$authCode="YT".rand();
		$contactNoArr=explode('-',$contactNoString);
		$emailAddress=explode('-',$emailString);
		foreach($emailAddress as $EK=>$EV)
		{
		ob_start();
		include('../newsletter/parent_portal.php');
		$MailContent=ob_get_contents();
		
		ob_clean();		
		include "sendgrid.php"; 
		}
		foreach($contactNoArr as $CK=>$CV)
		{
			$contact_number=$CV;
			
				if($contact_number!="") { 
					
					$sms_text	= "conten."; 
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
        ?>
     <!--       </td>
        </tr>
   </table>----->
<?
	$fieldsArr=array();
	$fieldsArr[] = "authentication	='".$authCode."'";
	
	$rs_student_update=Student::updateStudentByFields($fieldsArr,$studentId);
	echo "SuccessFully Mail sended for the Id is".$rs_student_update;
	exit();
	
}
if($_POST['act']=="saveParentEmail")
{
	$studentId=$_POST['studentId'];
	if($_POST['type']=='M')  $type= 'mother_email';
	if($_POST['type']=='F') $type ='father_email';
	$email_address = $_POST['email_address'];
	$rs_id =Student::updateStudentByField($type,$email_address,$studentId);
	ob_clean();
	echo $email_address;
	exit();
}

if($_POST['act']=="sendEmailToActivateAcc")
{
ob_clean();	
?>
<table border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>Send Email To parents</strong>
            <span onclick="close_parent_email_popup()" class="popup_closebtn" title="Close" style="cursor:pointer; font-weight:bold; font-size:20px;" align="right"><strong>X</strong></span></th>
        </tr>
        <tr>
        	<td>
            	To :<?=$_POST['emailAddress']?>
            </td>
        </tr>
		<tr>
			<td align="center">
            	<input type="button" id="sendParentEmail" name="sendParentEmail" value="Send" onclick="sendParentEmail('<?=$_POST['studentId']?>','<?=$_POST['emailAddress']?>','<?=$_POST['type']?>')"/>
			</td>
        </tr>
</table>
<?
exit();	
}
if($_POST['act']=="addParentEmail")
{
ob_clean();	
	//print_r($_POST);
	
?>

<table border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>Please Add Your MailId </strong>
            <span onclick="close_parent_email_popup()" class="popup_closebtn" title="Close" style="cursor:pointer; font-weight:bold; font-size:20px;" align="right"><strong>X</strong></span></th>
        </tr>
		<tr>
			<td>
            	<input type="text"  id="email_address" name="email_address" />
			</td>
            </tr>
            <tr>
            <td>
            	<input type="button" id="parentEmailSave" name="parentEmailSave" value="save" onclick="parentEmailSave('<?=$_POST['studentId']?>','<?=$_POST['type']?>')" />
            </td>
            
		</tr>
</table>
<?
exit();
}
/********************************sivamani working here**********************************/

if($_POST['act']=='addSib') {
ob_clean();
$var=(count($_POST['siblings']));
$siblingids = implode(",", $_POST['siblings']);
Student ::updateSiblings($_POST['student_id'],$siblingids);
$siblingids="";
for($i=0; $i<$var;$i++)
{
 for($j=0;$j<$var;$j++)
 {
 	if($j!=$i)
	{
	$siblingids = $siblingids.$_POST['siblings'][$j].",";
	}
	 
 }
 $siblingids = $siblingids.$_POST['student_id'];
	Student ::updateSiblings($_POST['siblings'][$i],$siblingids);	
$siblingids="";
}
//print_r($_POST);
print_r("successfully added");
exit();	
}


if($_POST['act']=='showSibForm') {
ob_clean();


				$main_student = Student::getStudentById($_POST['studentId']);
				$siblingArr = explode(',',$main_student->siblings);
?>
<input type="hidden" name="sib_student_id" id="sib_student_id" value="<?=$_POST['studentId']?>" />
 <table border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>Please Type sibling name in the text box below</strong>
            <span onclick="closePopup_sib()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
		<tr>
			<td>
			Sibling Name
			</td>
		</tr>
        <tr>
        <td>
<!--- siva working place --------------------------------------------------------------->
		<!---<input autocomplete="off" type="text" name="search_by_name" id="search_by_name" class="txtbox ac_input" placeholder="Enter Student Name" value="" />------->
		<div id="StudentLevelTop"></div>
                            <span class="spancursor" id="studentLevel_a" style="cursor:pointer;" onclick="addStudent();">
                            <div class="pull_right txtbold f24 cursor">+</div>
                            </span>
		
		    <script type="text/javascript">
	
	function defaultLoader(){
		
		// Stop for To School Starts Here..
		jQuery('#StudentLevelTop').empty().html('');
		var vhtm = new Array();
		var i = 0;
		<? 	
		if((!empty($siblingArr)) &&(count($siblingArr)>0)){
			foreach($siblingArr as $tk=>$tv) {
				$rs_student = Student::getStudentById($tv);
				$student_name = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
			?>
				addStudent({id:'<?=$tk?>', student_id:'<?=$tv?>', student_name:'<?=$student_name?>'});
		<?  } 
		} 
		else { ?>addStudent(); <? } ?>
	}
	
	function addStudent(a){
		if(a==undefined) a={};
		if(a.id==undefined) a.id='';
		if(a.student_id==undefined) a.student_id='';
		if(a.student_name==undefined) a.student_name='';
		if(a.Value==undefined) a.Value='';
		
		var row = jQuery('div.Studentclvltop').length;
		
		var vhtml = '';
		vhtml += '<div id="spStudentLevel_'+row+'" class="Studentclvltop" style="margin-top:0px; text-align:left;">';
		vhtml += '	<div id="spStudentLevel_'+row+'" class="dimage" style="margin-bottom:5px;">';
		vhtml += '		<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>';
		vhtml += '			<td style="padding:5px;"><input type="text" class="txtbox" name="studentSibArr[student_name]['+row+']" id="student_name'+row+'" value="'+$.trim(a.student_name)+'" placeholder="Type Sibling Name" /><input type="hidden" class="student_id" name="studentSibArr[student_id]['+row+']" id="student_id'+row+'" value="'+a.student_id+'" /></td>';
		vhtml +='			<td style="padding:0px;"><div class="txtbold f24 cursor" style="padding:0px; margin:0px; cursor:pointer; width:10%; height:5px; float:right" id="studentLevel_r" onclick="removeStudentTopLevel('+row+', &quot;'+a.id+'&quot;);">-</div></td>';
		vhtml += '		</tr></table>';
		vhtml += '	</div>';
		vhtml += '</div>';
		
		jQuery('#StudentLevelTop').append(vhtml);
		
		$().ready(function() { 
			var	school_id = $("#master_school_id").val(); 
			$("#student_name"+row).autocomplete("search_details.php?search_type=bus_student&student_notin_route=<?=$routeId?>&type=name&school_id="+school_id,{ 
				width:'auto', selectFirst: false,
				select: function(event, ui) { alert(event); }});	
			$("#student_name"+row).result(function(event, data, formatted) {
				$("#student_id"+row).val(data[1]);
			});
		});
		
		$('#stopstudentcount').val(jQuery('div.Studentclvltop').length);
		
	}
	
	function removeStudentTopLevel(r, id){ 
		var i1; 
		if(r==undefined){ 
			var row = jQuery('div.Studentclvltop').length-1;
			jQuery('#spStudentLevel_'+row).remove();
		}
		else {  
		
			var msg = confirm('Are you sure want to delete this sibling?');
			if(msg==true) {
				
				jQuery('#spStudentLevel_'+r).remove();
				if(jQuery('div.dimage').length==0){
					for(i1=0;i1<100;i1++){
						if(jQuery('Studentclvltop').length>0)
							jQuery('#spStudentLevel_'+i1).remove();
						else
							i1 = 101;
					}
					addStudent();
				}
			}
			
		}
		if(jQuery('div.Studentclvltop').length==0)
			addStudent();
	}

	jQuery(function(){
	
		jQuery('#studentLevel_r').show();
		jQuery('#studentLevel_a').show();
		defaultLoader();
		
	});
	
	
	</script>

        </td>
		</tr>
        <tr>
			<td align="center">
		 <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="saveSiblings()" id="sendbtn"><strong>Save</strong></div>
		</td>
<!--- siva working place --------------------------------------------------------------->      
		</tr>
    </table>

<?
exit();	
}


if($_POST['act']=="loadStudentsListDtls"){
	ob_clean();
	
	$gradeId = $_POST['gradeId']; 
	$sectionId = $_POST['sectionId']; 
	$schoolId = $_POST['schoolId']; $orderBy=$_POST['orderBy']; $sortBy=$_POST['sortBy']; $actionPage = $_POST['actionPage'];
	extract($_POST);
	$exportArr=array();
	if(!empty($_POST)) {
		foreach($_POST as $k1=>$v1) {
			if($k1!="act") $exportArr[] = $k1."=".$v1;
		}
	}
	$exportValues = implode("&", $exportArr);
	
	$student_obj = new Student();
	if($_POST['schoolId']!='' && $_POST['schoolId']!='undefined'){ $student_obj->school_id = $_POST['schoolId']; }
	if($gradeId!="" && $gradeId!="undefined") $student_obj->grade_id=$gradeId;
	
	if($actionPage=="Grade"){  $student_obj->student_id_in_grade=$gradeId;
								if($sectionId!='N')  $student_obj->section_id_in_grade=$sectionId;
	}
	
	if($_POST['searchBy']=="N") {
		if($_POST['searchByNameId']!="" && $_POST['searchByNameId']!="undefined") $student_obj->search_id=$_POST['searchByNameId']; 
		if($_POST['searchByName']!="" && $_POST['searchByName']!="undefined") $student_obj->name_search=$_POST['searchByName']; 
	}
	
	if($_POST['searchBy']=="Id") {
		if($_POST['searchById']!="" && $_POST['searchById']!="undefined") $student_obj->search_id=$_POST['searchById']; 
	}
	
	if($_POST['searchBy']=="E") {
		if($_POST['searchByEmail']!="" && $_POST['searchByEmail']!="undefined") $student_obj->check_all_emails=$_POST['searchByEmail']; 
	}
	
	if($_POST['orderBy']!="") $order_by=$_POST['orderBy']; else $order_by='first_name';
	if($_POST['sortBy']!="") $sort_by=$_POST['sortBy']; else $sort_by='ASC';
	
	$student_obj->orderby = $order_by;
	$student_obj->sortby = $sort_by;
	$rs_student = $student_obj->getAllStudentDtls();
	//Pagination 
		
		if($_POST['page']=='')
		$page=1;
		else
		$page = $_POST['page'];
		$totalReg = count($rs_student);
		if($_POST['page_limit']=="" || $_POST['page_limit']=="undefined") $PageLimit = 20; else $PageLimit = $_POST['page_limit'];
		$adjacents = 1;
				
		$totalPages= ceil(($totalReg)/($PageLimit));
		if($totalPages==0) $totalPages=1;
		$StartIndex= ($page-1)*$PageLimit; 
			
		if(count($rs_student)>0) $rs_studentArr = array_slice($rs_student,$StartIndex,$PageLimit,true);
		if(count($rs_student)>0 && $totalPages > 1){ 
			$rsPagination = generatePagination("studentList", $totalReg, count($rs_studentArr), $PageLimit, $adjacents, $page); 
		}
		$rs_school = School::getSchoolById($schoolId);
		include "student_list_include.php";
		echo "::::".count($rs_student);
		echo "::::".$rs_school->school_name;
		
	exit();
}

if($_POST['act']=="loadStudentlist") {
	ob_clean();
	$gradeId = $_POST['gradeId'];
	$schoolId = $_POST['schoolId'];
	
	include "student_list.php";
	exit();
}

if($_POST['act']=="viewStudentFrmOption") {
	ob_clean();
	?>
    <table width="400" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>Choose Form Type</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td align="center">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown  cursor" style="padding:20px; margin:5px;">
                    	<input type="radio" name="student_form_type" id="student_form_type" value="QF" checked/> <strong>Quick Form &nbsp;&nbsp;</strong>
                    </div>
                    <div class="bgbrown  cursor" style="padding:20px;  margin:5px;">
                    	<input type="radio" name="student_form_type" id="student_form_type" value="DF" /> <strong>Detailed Form</strong>
                    </div>
                </div>
			</td>
        </tr>
        <tr>
        	<td align="center">
            	<div class="bgbrown cursor txtwhite txtcenter f18" onclick="getFormType('<?=$_POST['studentId']?>')" style="padding:20px; margin:5px; width:20%;"><strong>Go</strong></div>
            </td>
        </tr>
    </table>
    <?
	exit();
}

if($_POST['act']=="loadStudentFrm") {
	ob_clean();
	$studentId = $_POST['studentId'];
	$schoolId = $_POST['schoolId'];
	if($_POST['action']=="DF") include "student_detailed_add.php";
	if($_POST['action']=="QF") include "student_quick_add.php";
	exit();
}

if($_POST['act']=="saveStudentQuickFrm") {
	//echo "<pre>"; print_r($_POST); echo "</pre>";
	ob_clean();
	$studentId = $_POST['student_db_id'];
	
	extract($_POST);
	$admission_date = $admission_year.'-'.$admission_month.'-'.$date_of_admission;
	$dateofbirth = $dob_year.'-'.$dob_month.'-'.$date_of_birth;
	$joining_year = $admission_year;
	
	if($studentId!="" && $studentId!="") {
		Student::updateStudentShortDtls($student_db_id, $school_id, $grade_id, $admission_date, check_input(ucfirst($first_name)), check_input(ucfirst($middle_name)), check_input(ucfirst($last_name)), $gender, $dateofbirth, $blood_group, $age, check_input($nationality), $mother_tongue, strtolower($email_address), $emer_number, $emer_name, check_input($emer_relation), check_input($current_address), $current_state, $current_city, $current_zipcode, check_input($permanent_address), check_input($permanent_state), check_input($permanent_city), $permanent_zipcode, $is_parent, check_input(ucfirst($father_name)), check_input($father_qualification), $father_employment, check_input($father_nature_of_job), check_input($father_annual_income), $father_phone, strtolower($father_email), check_input(ucfirst($mother_name)), check_input($mother_qualification), $mother_employment, check_input($mother_nature_of_job), check_input($mother_annual_income), $mother_phone, strtolower($mother_email), check_input(ucfirst($guardian_name)), $roll_no, $emer_number_phone, $joining_year, $is_new_student);
		$rs_st_id = $studentId;
	} else {
		$rs_student_id = Student::insertStudentShortDtls($school_id, $grade_id, $admission_date, check_input(ucfirst($first_name)), check_input(ucfirst($middle_name)), check_input(ucfirst($last_name)), $gender, $dateofbirth, $blood_group, $age, check_input($nationality), $mother_tongue, strtolower($email_address), $emer_number, $emer_name, check_input($emer_relation), check_input($current_address), $current_state, $current_city, $current_zipcode, check_input($permanent_address), check_input($permanent_state), check_input($permanent_city), $permanent_zipcode, $is_parent, check_input(ucfirst($father_name)), check_input($father_qualification), $father_employment, check_input($father_nature_of_job), check_input($father_annual_income), $father_phone, strtolower($father_email), check_input(ucfirst($mother_name)), check_input($mother_qualification), $mother_employment, check_input($mother_nature_of_job), check_input($mother_annual_income), $mother_phone, strtolower($mother_email), check_input(ucfirst($guardian_name)), $roll_no, $emer_number_phone, $joining_year, $is_new_student);
		$rs_st_id = $rs_student_id;
	}
	
	if($rs_st_id>0) {
		
		if($_FILES['photo']['size'] > 0)
		{
			$up_fileArr = $_FILES['photo']; 
			$rExt = array('jpg','jpeg','png','gif');
			$FileObj = new FileUpload();
			$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$up_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>STUDENT_FILE_PATH));
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
				$Uploadup_file = true;
			}
		}
		if($Uploadup_file){
			$FileObj->AssignFileName($rs_st_id);
			$filepath = $FileObj->Upload();
			$rsStudentImg = Student::updateStudentByField('photo', $filepath, $rs_st_id);
		}
		
		if($circular_id!="" && $circular_id!="undefined" && $send_circular=="Y" && $rs_st_id!='' && $rs_st_id!="undefined") {
			$student_id = $rs_st_id;
			$circularIds = $circular_id;
			$action_type = "Student";
			include "circular_mail_process.php";
		}
		
		//header("Location: students.php");
	}
	exit();	
}

if($_POST['act']=='saveStudentFrm'){
	
	$date_of_birth = $_POST['dob_year'].'-'.$_POST['dob_month'].'-'.$_POST['date_of_birth'];
	$admission_date = $_POST['admission_year'].'-'.$_POST['admission_month'].'-'.$_POST['date_of_admission'];
	$joining_year = $admission_year;
	
	$lanArr=array();
	if(count($_POST['LanguagesArr']['languages_types'])>0) { 
		foreach($_POST['LanguagesArr']['languages_types'] as $kk=>$vv) {
			$lanArr[$kk] = implode(",", $vv);
		}
	}
	
	$langArr=array();
	$langArr['language_name'] = $_POST['LanguagesArr']['language_name'];
	$langArr['languages_types'] = $lanArr;
	$languages_known = serialize($langArr);
	
	$siblings_of_student = serialize($_POST['SibilingsArr']);
	
	if($_POST['student_db_id']!='' && $_POST['student_db_id']!='undefined'){
		
		$rsStudentUpd = Student::updateStudent($_POST['student_db_id'], $_POST['school_id'], $admission_date, check_input($_POST['first_name']), check_input($_POST['middle_name']), check_input($_POST['last_name']), $_POST['gender'], $date_of_birth, $_POST['blood_group'], $_POST['age'], $_POST['nationality'], $_POST['mother_tongue'], $_POST['email_address'], $_POST['emer_number_phone'], $_POST['mobile'], $_POST['emergency_contact_number'], check_input($_POST['current_address']), check_input($_POST['current_state']), check_input($_POST['current_city']), check_input($_POST['current_zipcode']), check_input($_POST['permanent_address']), check_input($_POST['permanent_state']), check_input($_POST['permanent_city']), check_input($_POST['permanent_zipcode']), $_POST['current_studying'], $_POST['grade_id'], check_input($_POST['child_potential']), check_input($_POST['child_interest']), check_input($_POST['child_gifted']), check_input($_POST['child_gifted_notes']), check_input($_POST['child_difficult']), check_input($_POST['child_difficulty_notes']), check_input($_POST['health_issue']), check_input($_POST['health_history']), check_input($_POST['sports_inclination']), check_input($_POST['sports_notes']), check_input($_POST['home_environment']), check_input($_POST['child_hobbies']), $languages_known, check_input($_POST['is_pet']), check_input($_POST['what_pet']), check_input($_POST['pet_name']), $siblings_of_student, $_POST['is_parent'], check_input($_POST['father_name']), check_input($_POST['father_qualification']), check_input($_POST['father_interest']), check_input($_POST['father_employment']), check_input($_POST['father_nature_of_job']), $_POST['father_annual_income'], check_input($_POST['father_phone']), check_input($_POST['mother_name']), check_input($_POST['mother_qualification']), check_input($_POST['mother_interest']), check_input($_POST['mother_employment']), check_input($_POST['mother_nature_of_job']), $_POST['mother_annual_income'], $_POST['mother_phone'], check_input($_POST['guardian_name']), check_input($_POST['educational_goals']), check_input($_POST['view_on_competition']), check_input($_POST['yt_offering']), check_input($_POST['idea_free_human']), check_input($_POST['previous_school_name']), check_input($_POST['previous_school_place']), check_input($_POST['previous_grades_attended']), check_input($_POST['previous_school_board']), $_POST['previous_from'],$_POST['previous_to'], $_POST['term_fees'],$_POST['registration_fee'], $_POST['material_fee'], $_POST['food_fee'], $_POST['is_transport'], $_POST['bus_route_id'], $_POST['transportation_fees'], $_POST['bus_order_from'], $_POST['bus_order_to'], $_POST['father_email'], $_POST['mother_email'], check_input($_POST['emer_name']), $_POST['emer_relation'], $_POST['roll_no'], $joining_year, $_POST['is_new_student']);
 		$student_id = $_POST['student_db_id'];
 	} else {
	
  		$rsStudentIns = Student::insertStudent($_POST['school_id'], $admission_date, check_input($_POST['first_name']), check_input($_POST['middle_name']), check_input($_POST['last_name']), $_POST['gender'], $date_of_birth, $_POST['blood_group'], $_POST['age'], $_POST['nationality'], $_POST['mother_tongue'], $_POST['email_address'], $_POST['emer_number_phone'], $_POST['mobile'], $_POST['emergency_contact_number'], check_input($_POST['current_address']), check_input($_POST['current_state']), check_input($_POST['current_city']), $_POST['current_zipcode'], check_input($_POST['permanent_address']), check_input($_POST['permanent_state']), check_input($_POST['permanent_city']), $_POST['permanent_zipcode'], check_input($_POST['current_studying']), $_POST['grade_id'], check_input($_POST['child_potential']), check_input($_POST['child_interest']), check_input($_POST['child_gifted']), check_input($_POST['child_gifted_notes']), check_input($_POST['child_difficult']), check_input($_POST['child_difficulty_notes']), check_input($_POST['health_issue']), check_input($_POST['health_history']), check_input($_POST['sports_inclination']), check_input($_POST['sports_notes']), check_input($_POST['home_environment']), check_input($_POST['child_hobbies']), $languages_known, $_POST['is_pet'], check_input($_POST['what_pet']), check_input($_POST['pet_name']), $siblings_of_student, $_POST['is_parent'], check_input($_POST['father_name']), check_input($_POST['father_qualification']), check_input($_POST['father_interest']), check_input($_POST['father_employment']), check_input($_POST['father_nature_of_job']), $_POST['father_annual_income'], $_POST['father_phone'], $_POST['father_email'], $_POST['mother_name'], $_POST['mother_qualification'], $_POST['mother_interest'], $_POST['mother_employment'], $_POST['mother_nature_of_job'], $_POST['mother_annual_income'], $_POST['mother_phone'], $_POST['mother_email'], check_input($_POST['guardian_name']), check_input($_POST['educational_goals']), check_input($_POST['view_on_competition']), check_input($_POST['yt_offering']), check_input($_POST['idea_free_human']), check_input($_POST['previous_school_name']), check_input($_POST['previous_school_place']), check_input($_POST['previous_grades_attended']), check_input($_POST['previous_school_board']), $_POST['previous_from'], $_POST['previous_to'], $_POST['term_fees'], $_POST['registration_fee'], $_POST['material_fee'], $_POST['food_fee'], $_POST['is_transport'], $_POST['bus_route_id'], $_POST['transportation_fees'], $_POST['bus_order_from'], $_POST['bus_order_to'], $_POST['emer_name'],$_POST['emer_relation'], $_POST['roll_no'], $joining_year, $_POST['is_new_student']);
		$student_id = $rsStudentIns;
	}	
  
  	if($student_id>0) {
		
		//single image uploading
		if($_FILES['photo']['size'] > 0)
		{
			$up_fileArr = $_FILES['photo']; 
			$rExt = array('jpg','jpeg','png','gif');
			$FileObj = new FileUpload();
			$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$up_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>STUDENT_FILE_PATH));
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
				$Uploadup_file = true;
			}
		}
		if($Uploadup_file){
			$FileObj->AssignFileName($student_id);
			$filepath = $FileObj->Upload();
			$rsStudentImg = Student::updateStudentByField('photo', $filepath, $student_id);
		}
		
		if($_FILES['family_photo']['size'] > 0)
		{
			$family_fileArr = $_FILES['family_photo']; 
			$rExt = array('jpg','jpeg','png','gif');
			$familyFileObj = new FileUpload();
			$FileResult = $familyFileObj->AssignAndCheck(array('FileRef'=>$family_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>FAMILY_FILE_PATH));
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
				$familyUploadup_file = true;
			}
		}
		if($familyUploadup_file){
			$familyFileObj->AssignFileName($student_id);
			$Familyfilepath = $familyFileObj->Upload();
			$rsFamilyImg = Student::updateStudentByField('family_photo',$Familyfilepath,$student_id);
		}
		
		
		$documentArr = $_POST['DocumentsArr']['document_name'];
		//echo "<pre>"; print_r($documentArr); echo "</pre>";
		//echo "<pre>"; print_r($_FILES); echo "</pre>";
		
		$docDtlsArr=array();
		$doc_index=0;
		if(count($documentArr)>0) {
			foreach($documentArr as $k=>$v) {
				
				if($_FILES['file_name_'.$doc_index]['size'] > 0)
				{
					//print_r($_POST);
					$up_fileArr = $_FILES['file_name_'.$doc_index]; 
					$rExt = array('jpg','jpeg','png','gif');
					$FileObj = new FileUpload();
					$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$up_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>DOCUMENT_FILE_PATH));
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
						$doc_file_upload = true;
					}
				}
				
				if($doc_file_upload){
					//$FileObj->AssignFileName(UniqueIdGen());
					
					$doc_file_name = "Doc_".$student_id."_".($doc_index+1);
					$FileObj->AssignFileName($doc_file_name);
					$filepath_doc = $FileObj->Upload();
				}
				if($filepath_doc!="") $filepath_modules_name=$filepath_doc; else $filepath_modules_name=$_POST['h_file_name_'.$doc_index];
				
				$docDtlsArr[$k]['document_name']=$v;
				$docDtlsArr[$k]['filetitle']=$filepath_modules_name;
				
				$doc_index++;
			}
			
			$documents = serialize($docDtlsArr);
			$rsDocumentImg = Student::updateStudentByField('document_type', $documents, $student_id);
		}
		//exit();
		?>
        <script type="text/javascript">window.location.href="students.php";</script>
        <?
		//header("Location: students.php");
		$circular_id = $_POST['circular_id'];
		if($circular_id!="" && $circular_id!="undefined" && $_POST['send_circular']=="Y" && $student_id!="" && $student_id!="undefined") {
			$student_id = $student_id;
			$circularIds = $circular_id;
			$action_type = "Student";
			include_once "circular_mail_process.php";
		}
		
	}
}

if($_POST['act']=='delStudent'){
	ob_clean();
	$deleteStudentPic = Student::getStudentById($_POST['student_id']);
	
	if(is_file(STUDENT_FILE_PATH.$deleteStudentPic->photo)) {
		$deleteStudentFile = STUDENT_FILE_PATH.$deleteStudentPic->photo;
		unlink($deleteStudentFile);
	}
	
	if(is_file(FAMILY_FILE_PATH.$deleteStudentPic->family_photo)) {
		$deleteFamilyFile = FAMILY_FILE_PATH.$deleteStudentPic->family_photo;
		unlink($deleteFamilyFile);
	}
	
	$file_name = unserialize($deleteStudentPic->document_type); 
	$filecount = count($file_name['filetitle']);
	for($i=0;$i<$filecount;$i++){
		$deleteStudentDocument = DOCUMENT_FILE_PATH.$file_name['filetitle'][$i];
 		unlink($deleteStudentDocument);
	}
 	
 	Student::deleteStudent($_POST['student_id']);
	Student::deleteGradeStudentByStudentId($_POST['student_id']);
	StudentBusRoute::deleteStudentBusRouteByStudentId($_POST['student_id']);
	
	exit();
}

if($_POST['act']=="viewStudentDtls"){
	ob_clean();
	$studentId = $_POST['student_id'];
	$schoolId = $_POST['school_id'];
	$gradeId = $_POST['grade_id'];
	$sendType='S';
	?>
    <table width="850" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>&nbsp;Circular Details</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2">
			<? if($_POST['action']=="QV") include "student_quick_view.php"; if($_POST['action']=="DV") include "student_detailed_view.php"; if($_POST['action']=="M") include "student_mail_form.php"; ?>
            </td>
        </tr>
    </table>
    <?
   	
	exit();
}

if($_POST['act']=="loadEmailSubscriptions") {
	ob_clean();
	$rs_student = Student::getStudentById($_POST['studentId']);
	?>
    <table width="400" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>Update Email Subscriptions</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td align="center">
            	<table border="0" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td>Father Email Subscription</td>
                        <td>
                        	<input type="radio" name="f_email_subs" id="f_email_subs_y" value="Y" <?=($rs_student->f_email_subscription=="Y")?"checked":""?> /> Yes
                            <input type="radio" name="f_email_subs" id="f_email_subs_n" value="N" <?=($rs_student->f_email_subscription=="N")?"checked":""?> /> No
                        </td>
                    </tr>
                    <tr>
                    	<td>Mother Email Subscription</td>
                        <td>
                        	<input type="radio" name="m_email_subs" id="m_email_subs_y" value="Y" <?=($rs_student->m_email_subscription=="Y")?"checked":""?> /> Yes
                            <input type="radio" name="m_email_subs" id="m_email_subs_n" value="N" <?=($rs_student->m_email_subscription=="N")?"checked":""?> /> No
                        </td>
                    </tr>
                    <tr>
                    	<td>Emergency Email Subscription</td>
                        <td>
                        	<input type="radio" name="e_email_subs" id="e_email_subs_y" value="Y" <?=($rs_student->e_email_subscription=="Y")?"checked":""?> /> Yes
                            <input type="radio" name="e_email_subs" id="e_email_subs_n" value="N" <?=($rs_student->e_email_subscription=="N")?"checked":""?> /> No
                        </td>
                    </tr>
                </table>
			</td>
        </tr>
        <tr>
        	<td align="center">
            	<div class="bgbrown cursor txtwhite txtcenter f18" onclick="updateEmailSubscription('<?=$_POST['studentId']?>')" id="subsSaveImg" style="padding:20px; margin:5px; width:20%;"><strong>Save</strong></div>
                <img src="images/loader.gif" align="absmiddle" alt="Processing.." title="Processing.." id="subsLoadingImg" style="display:none;" />
            </td>
        </tr>
    </table>
    <?
	exit();
}

if($_POST['act']=="updateEmailSubs") {
	ob_clean();
	$fieldsArr=array();
	$fieldsArr[] = "f_email_subscription='".$_POST['fatherEmail']."'";
	$fieldsArr[] = "m_email_subscription='".$_POST['motherEmail']."'";
	$fieldsArr[] = "e_email_subscription='".$_POST['emerEmail']."'";
	Student::updateStudentByFields($fieldsArr, $_POST['studentId']);
	echo "Updated Successfully..!";
	exit();
}


?>

<style>
.boxerror{border:1px solid #F00;}
.txterror{color:#F00}
</style>

<link rel="stylesheet" type="text/css" href="css/default_style.css" />

<div class="fullsize">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright5" /></td>
                <td>List <br/> <span class="f30"><strong>Students</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop50 cursor" id="show_addteacher">
        	<? if($_SESSION['viewLog']) { ?><div class="combutton" onclick="showLogDetails('<?=TBL_STUDENT?>', '')">Logs</div><? } ?>
        </div>
    </div>
    
</div>



<div class="fullsize">
    
    <div class="fullsize padtb15">

        <div class="newsletter_left"> <!-- Menu -->
            <div class="newsletter_submenu txtwhite">
                <div class="circular_outer">
                    <div class="newcircular_head" id="show_currentteacher">Students</div>
                    <? $rs_schools = School::getAccessedSchools($GLOBALS['schoolAccess']); ?>
                    <ul class="currentteacher_content txttheme" id="teachermenutab_A" style="padding-right:10px;">
                    <? if(!empty($rs_schools)) {foreach($rs_schools as $sk=>$sv) { ?>
                    	<? if($GLOBALS['schoolAccess'][$sv->id]) { ?>
                        	<li onclick="showStudentList('<?=$sv->id?>', 'first_name', 'ASC')" style="cursor:pointer;"><?=$sv->school_name?><span class="tabbtn" id="2tabbtn_<?=$sv->id?>"></span></li>
						<? } ?>
                    <? } } ?>
                    </ul>
                </div>
                
            </div>
        </div><!-- Menu -->
        
        <div class="newsletter_right border_theme bgwhite" style="width:78.8%;"> <!-- Grade -->
        
        	<div class="fullsize lineht2 border_bottom" id="studentcountdtls">
                <div class="pull_left padlr10 padtb10 txtbold letterspac f18">Master Students List for <span id="masterschoolname"></span></div>
                <div class="pull_right padlr10 padtb10 txtbold letterspac f18">
                    <div class="pull_left">Total Students: <span id="studentscount"></span></div>
                    <? if($GLOBALS['isAdd']){ ?><div class="combutton pull_right" onclick="showStudentFrm('', 'N')" style="margin-left:20px;">Add Students</div><? } ?>
                </div>
            </div>
            
            <div class="fullsize">
                <div id="studentslisttab" style="padding:5px;"></div>
            </div>

        </div>

    </div>
    
</div>
<!---------------------------------siva working place------------------------------------->

<div id="student_popup_sib" style="display:none; padding:0px; margin:0px;">

</div>

<div id="parent_email_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'newsgoth_btroman';">


</div>

<!---------------------------------siva working place------------------------------------->


<div id="student_popup" style="display:none; padding:0px; margin:0px;"></div>
<script type="text/javascript">

$("#student_popup_sib").dialog({
		autoOpen: false,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true,
		position: { 'my': 'center', 'at': 'top' }
	});
$(".ui-widget-header").css({"display":"none"});

////////////////// siva working place///////////////////////////////
function popupDtls_sib(student_id){
	$("#student_popup_sib").show();
	$("#student_popup_sib").dialog('open');
  $('#student_popup_sib').html('loading.please wait');
		ajax({
			a:'students',
			b:'act=showSibForm&studentId='+student_id,		
			c:function(){},
			d:function(data){
				$("#student_popup_sib").html(data);
			
			}			
		});

	
}

function closePopup_sib(){ $("#student_popup_sib").dialog('close');  }

////////////////// siva working place//////////////////////////////
function popupDtls(data){
	$("#student_popup").show();
	if(data!="" && data!=undefined) $("#student_popup").html(data);
	$("#student_popup").dialog({
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

function closePopup(){ $("#student_popup").dialog('close');  }

function showStudentList(school_id) { //alert(school_id);
	
	$('.tabbtn').removeClass('arrow');
	$('#2tabbtn_'+school_id).addClass('arrow');
	
	ajax({
		a:'students',
		b:'act=loadStudentlist&schoolId='+school_id,		
		c:function(){},
		d:function(data){ //alert(data);
			$('#studentslisttab').html(data);
		}			
	});
}
showStudentList('<?=$rs_schools[0]->id?>');

function getFormType(student_id) {
	var action = $('input[name=student_form_type]:checked').val();
	closePopup();
	showStudentFrm(student_id, action);
}

function showStudentFrm(student_id, action) { //alert(student_id); alert(action);
	
	var school_db_id = $('#school_db_id').val();
	if(action=="N") { 
		ajax({
			a:'students',
			b:'act=viewStudentFrmOption&studentId='+student_id,		
			c:function(){},
			d:function(data){
				$("#student_popup").html(data);
				popupDtls();
			}			
		});
	} else {
		$("#studentslisttab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
		ajax({
			a:'students',
			b:'act=loadStudentFrm&studentId='+student_id+'&schoolId='+school_db_id+'&action='+action,		
			c:function(){},
			d:function(data){ //alert(data);
				$('#studentcountdtls').hide();
				$("#studentslisttab").html(data);
			}			
		});
	}
	
}


function studentActions(student_id, action, grade_id){
	var page = $('#student_list_page').val();
	var school_db_id = $('#school_db_id').val();
	if(grade_id==undefined) grade_id=''; else grade_id=grade_id;
	if(action=="D") {
		ajax({
			a:'students',
			b:'act=delStudent&student_id='+student_id,		
			c:function(){},
			d:function(data){ //alert(data);
				alert('Deleted Successfully');
				studentListPaging(page)
			}			
		});
	} 
	else {
		$("#student_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
		ajax({
			a:'students',
			b:'act=viewStudentDtls&student_id='+student_id+'&action='+action+'&school_id='+school_db_id+'&grade_id='+grade_id,		
			c:function(){},
			d:function(data){
				$("#student_popup").html(data);
				popupDtls();
			}			
		});
	}
	
}

function showStudent(seltab) {  //alert(seltab);

	$('.grade_tab').removeClass('active');
	$('#grade_tab'+seltab).addClass('active');
 
	if(seltab=="B"){ 
		$('#showBasicDtls').show();
		$('#showPresonalStudentDtls').hide();
		$('#showFamilyDtls').hide();
		$('#showPreviousSchoolDtls').hide();
		$('#showDocumentDtls').hide();
		$('#showFeesDtls').hide();
	}
	if(seltab=="S"){ 
		$('#showBasicDtls').hide();
		$('#showPresonalStudentDtls').show();
		$('#showFamilyDtls').hide();
		$('#showPreviousSchoolDtls').hide();
		$('#showDocumentDtls').hide();
		$('#showFeesDtls').hide();
	}
	if(seltab=="F"){ 
		$('#showBasicDtls').hide();
		$('#showPresonalStudentDtls').hide();
		$('#showFamilyDtls').show();
		$('#showPreviousSchoolDtls').hide();
		$('#showDocumentDtls').hide();
		$('#showFeesDtls').hide();
	}
	if(seltab=="P"){ 
		$('#showBasicDtls').hide();
		$('#showPresonalStudentDtls').hide();
		$('#showFamilyDtls').hide();
		$('#showPreviousSchoolDtls').show();
		$('#showDocumentDtls').hide();
		$('#showFeesDtls').hide();
	}
	if(seltab=="D"){ 
		$('#showBasicDtls').hide();
		$('#showPresonalStudentDtls').hide();
		$('#showFamilyDtls').hide();
		$('#showPreviousSchoolDtls').hide();
		$('#showDocumentDtls').show();
		$('#showFeesDtls').hide();
	}
	if(seltab=="FS"){ 
		$('#showBasicDtls').hide();
		$('#showPresonalStudentDtls').hide();
		$('#showFamilyDtls').hide();
		$('#showPreviousSchoolDtls').hide();
		$('#showDocumentDtls').hide();
		$('#showFeesDtls').show();
	}
	
}


function saveSiblings() {
	
		var student_ids = $('.student_id').map(function(){
			return this.value;
			//$('#sib_student_id').val();
		}).get();
		//var student_ids =$('#sib_student_id').val();
		
		var main_student_id = $('#sib_student_id').val();
		
		var paramData = {'act':'addSib','siblings':student_ids,'student_id':main_student_id }
		
		ajax({
			a:'students',
			/********************** siva edit************************************************/
			//b:'act=viewStudentDtls&student_id='+student_id+'&action='+action+'&school_id='+school_db_id+'&grade_id='+grade_id,				
			b:$.param(paramData),		
			/********************** siva edit************************************************/			
			c:function(){},
			d:function(data){
				//alert(data);
				closePopup_sib();
				
			}			
		});

}


$("#parent_email_popup").dialog({
		autoOpen: false,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
	
function close_parent_email_popup(){  $("#parent_email_popup").dialog('close');  }	
function addParentEmail(studentId,userType)
{
	
	
	$("#parent_email_popup").dialog('open'); 
	$("#parent_email_popup").html('loading..please wait..');
	var paramData = {'act':'addParentEmail','studentId':studentId,'type':userType }
	ajax({
		a:'students',
			//b:'act=viewStudentDtls&student_id='+student_id+'&action='+action+'&school_id='+school_db_id+'&grade_id='+grade_id,				
			b:$.param(paramData),		
			/********************** siva edit************************************************/			
			c:function(){},
			d:function(data){
		
		$("#parent_email_popup").html(data); 
		}
	});
	///poup ///////////////////////////
	
	
	///////////////////////////////////////
}
function parentEmailSave(studentId,field)
{
	var fieldValue=$('#email_address').val();
	var paramData = {'act':'saveParentEmail','studentId':studentId,'type':field,'email_address':fieldValue }
	
	ajax({
		a:'students',
		b:$.param(paramData),
		c:function(){},
		d:function(data){
			alert(data);
			$('#'+field+'_email_'+studentId).html(data);
	close_parent_email_popup();
			
		}
	});
}
function sendEmailActivatePassword(studentId,emailAddress,type)
{
	//alert("method called");
	//alert(studentId+emailAddress+type);
	$("#parent_email_popup").dialog('open'); 
	$("#parent_email_popup").html('loading..please wait..');
	var paramData={'act':'sendEmailToActivateAcc','studentId':studentId,'emailAddress':emailAddress,'type':type}
	ajax({
		a:'students',
		b:$.param(paramData),
		c:function(){},
		d:function(data){
			$("#parent_email_popup").html(data);
			}
		});
}
function sendParentEmail(studentId,emailAddress,type)
{
//alert('method called');
//alert(studentId+emailAddress+type);
var paramData={'act':'sendMailToParent','studentId':studentId,'emailAddress':emailAddress,'type':type}
	ajax({
		a:'',
		b:$.param(paramData),
		c:function(){},
		d:function(data){
			alert(data)
			}
		});
}
function send_Authentication(studentId)
{
	
	//$("#parent_email_popup").dialog('open'); 
	//$("#parent_email_popup").html('loading..please wait..');
var paramData={'act':'send_ParentLog_authentication','studentId':studentId}
ajax({
		a:'students',
		b:$.param(paramData),
		c:function(){},
		d:function(data){
			alert(data);
			//$("#parent_email_popup").html(data);
			}
		});
}


</script>

<?
}
include "template.php";
?>