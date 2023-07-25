<?
function main(){
	
if($_POST['act']=="loadAllGradeStudents") {
	ob_clean();
	$schoolId = $_POST['schoolId'];
	$studentIds = $_POST['studentIds'];
	$gradeSection = $_POST['gradeSection'];
	$gradeId = $_POST['grade_id'];
	$makeType = $_POST['type'];
	
	$stud_obj = new Student();
	$stud_obj->ids=$studentIds;
	$stud_obj->sortby="ASC";
	$stud_obj->orderby="first_name";
	$rs_students = $stud_obj->getAllStudentDtls();
	if($makeType=="N") $headTxt = "New"; if($makeType=="O") $headTxt = "Old";
?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong>NEW STUDENTS</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2">
				<div style="max-height:600px; overflow:auto;">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gradetbl">
                <tr><td colspan="2" align="left">Please make sure these students are <?=$headTxt?> Students. <?=$headTxt?> students are listed below:</td></tr>
				<? if(!empty($rs_students)) {
                    foreach($rs_students as $kk=>$vv) { $student_name = $vv->first_name." ".$vv->middle_name." ".$vv->last_name;  ?>
                <tr>
                    <td align="left"><input type="checkbox" name="new_student" id="new_student<?=$vv->id?>" value="<?=$vv->id?>" class="new_student" checked/> </td>
                    <td align="left"><?=trim($student_name)?></td>
                </tr>
                <? } 
				}
            	?>	
            	</table>
                </div>
            </td>
        </tr>
        <tr>
        	<td>Choose Year</td>
            <td>
            	<select name="new_batch_year" id="new_batch_year" class="listbox">
                	<option value="">Select Year</option>
                    <? $rs_years = listofyears(2000, date("Y", strtotime("+2 years")));
					foreach($rs_years as $K=>$V) { ?>
						<option value='<?=$V?>'><?=$V?></option>
					<? } ?>
                </select>
            </td>
        </tr>
        <? if(!empty($rs_students)) { ?>
        <tr>
        	<td colspan="2" align="right">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="updateNewStudent('<?=$gradeId?>', '<?=$makeType?>')" id="saveBtn"><strong>Make <?=$headTxt?> Student</strong></div>
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="processBtn" style="display:none;"><strong>Processing..</strong></div>
                </div>
            </td>
        </tr>
        <? } ?>
    </table>
<?	
	exit();
}	

if($_POST['act']=="setNewStudents") {
	ob_clean();
	$schoolId = $_POST['schoolId'];
	$studentIds = $_POST['studentIds'];
	$gradeSection = $_POST['gradeSection'];
	$gradeId = $_POST['grade_id'];
	$joiningYear = $_POST['newBatch'];
	$makeType = $_POST['type'];

	if($_POST['studentIds']!="" && $_POST['studentIds']!="undefined" && $makeType!="" && $makeType!="undefined") {
		$studentsArr = explode(",", $_POST['studentIds']);
		if(!empty($studentsArr)) {
			foreach($studentsArr as $kk=>$vv) { 
				if($makeType=="N") $isNew="Y";
				else if($makeType=="O") $isNew="N";
				$fieldsArr=array();
				$fieldsArr[] = "is_new_student='$isNew'";
				$fieldsArr[] = "joining_year='$joiningYear'";
				Student::updateStudentByFields($fieldsArr, $vv);
				/*Student::updateStudentByField("is_new_student", $isNew, $vv);
				Student::updateStudentByField("joining_year", $joiningYear, $vv);*/
			}
		}
	}
	exit();
}
	
if($_POST['act']=="loadGradeforUpgrade") {
	ob_clean();
	$schoolId = $_POST['schoolId'];
	$studentIds = $_POST['studentIds'];
	$gradeSection = $_POST['gradeSection'];
	$gradeId = $_POST['grade_id'];

?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong>&nbsp;<?=($gradeId!='')?"Edit Grade":"Add Grade"?></strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td>Choose Grade</td>
            <td><? $rs_grades = Grade::getUpgradeGrades($schoolId, $gradeSection, $gradeId); ?>
            	<?
				if(!empty($rs_grades)) {
				?>
				<select name="upgrade_grade_id" id="upgrade_grade_id" class="listbox">
                	<option value="">Select Grade</option>
                <?	foreach($rs_grades as $kk=>$vv) {
					?>
                    <option value="<?=$vv->id?>"><?=$vv->grade_name?></option>
                <? } ?>
                </select>
                <?
				} else { ?>
                	No Grades found to upgrade. 
					<? if($_SESSION['YTUserType']=="SA") { ?> <br />Would you like to Add Grade <span onclick="showAddGrade('N', '', '<?=$schoolId?>', 'NG')" class="cursor"><u>click here</u></span> <? } ?>
                <?
					
				}
				?>
            </td>
        </tr>
        <? if(!empty($rs_grades)) { ?>
        <tr>
        	<td colspan="2" align="right">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="upgradeStudentGrade('<?=$studentIds?>', '<?=$gradeId?>', 'N')"><strong>Upgrade</strong></div>
                </div>
            </td>
        </tr>
        <? } ?>
    </table>
<?	
	exit();
}

if($_POST['act']=="updateStudentGrade") {
	ob_clean();
	
	if($_POST['studentIds']!="" && $_POST['studentIds']!="undefined" && $_POST['newGradeId']!="" && $_POST['newGradeId']!="undefined") {
		$studentsArr = explode(",", $_POST['studentIds']);
		if(!empty($studentsArr)) {
			foreach($studentsArr as $kk=>$vv) { 
				$rs_new_grade = Grade::getGradeById($_POST['newGradeId']);
				Student::updateGradeStudent($rs_new_grade->school_id, $vv, $_POST['newGradeId'], $_POST['gradeSection']);
				Student::updateStudentByField("grade_id", $_POST['newGradeId'], $vv);
				Student::updateStudentByField("school_id", $rs_new_grade->school_id, $vv);
			}
		}
	}
	exit();
}
	
if($_POST['act']=="loadGradeFrm") {
	ob_clean();
	$schoolId = $_POST['schoolId'];
	$newAction = $_POST['new_action'];
	if($_POST['gradeId']!="" && $_POST['gradeId']!="undefined") $gradeId = $_POST['gradeId']; else $_POST['gradeId'] = "";
?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>&nbsp;<?=($gradeId!='')?"Edit Grade":"Add Grade"?></strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2"><? include "grade_add.php"; ?>
            </td>
        </tr>
    </table>
<?	
	exit();
}

if($_POST['act']=="loadGradeList") {
	ob_clean();
	
	$schoolId = $_POST['schoolId'];
	$grade_obj = new Grade();
	if($_POST['schoolId']!='' && $_POST['schoolId']!="undefined") { $grade_obj->school_id = $_POST['schoolId']; }
	$rs_grades = $grade_obj->getGradeDtls(); 
	
	$rs_school = School::getSchoolById($schoolId);
	
	$grade_obj = new Student();
	$grade_obj->school_id=$schoolId;
	$rs_grade_student = $grade_obj->getAllGradeStudents();

	?>
    <div class="fullsize">
        <div class="fullsize lineht2 border_bottom">
            <div class="pull_left padlr10 padtb10 txtbold letterspac f18"><?=$rs_school->school_name?> - Grades List</div>
            <? if($GLOBALS['isAdd'] && $_SESSION['YTUserType']=="SA"){ ?><div class="combutton pull_right padlr10 padtb10 txtbold letterspac f18" onclick="showAddGrade('N', '', '<?=$rs_school->id?>')">Add Grade</div><? } ?>
            <div class="pull_right padlr10 padtb10 txtbold letterspac f18">Total Students: <?=count($rs_grade_student)?></div>
            
        </div>
        
        <div class="fullsize padtb10">
    <?
	if(count($rs_grades)>0) {
		foreach($rs_grades as $k=>$v) {
			
			if(!$GLOBALS['gradeAccess'][$v->id]) continue;
			
			$sectionArr = explode(",",$v->section);
			foreach($sectionArr as $kk=>$vv) {
				
			$grade_obj->grade_id=$v->id;
			$rs_grade_students = $grade_obj->getAllGradeStudents();
			$studentsCount = count($rs_grade_students);
			
			$teacher_obj = new Teacher();
			$teacher_obj->grade_id=$v->id;
			$rs_grade_teacher = $teacher_obj->getAllGradeTeacherDtls();

			$teachersCount = count($rs_grade_teacher);
	?>
        <div class="grade_division" style="width:25%;"><!-- Grade Division -->
            <table width="230" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; cursor:pointer;" class="border_theme">
              <tr>
                <td colspan="2" class="bgbrown2 txtcenter f32 txtbold padtb10">
					<div style="float:left; margin-left:10px;" onclick="showGradeDtls('<?=$v->id?>', '<?=$schoolId?>', '<?=$vv?>');">
                        <div align="right" style="text-align:right">
                        <?=$v->grade_name?> <?=($vv=="N" || $vv=="")?"":"-".$vv?>
                        </div>
                    </div>
                    <div style="float:right; margin-top:5%; margin-right:5%;" onclick="showAddGrade('E', '<?=$v->id?>', '<?=$schoolId?>')">
                    	<? if($GLOBALS['isUpdate']){ ?><img src="images/edit_icon1.png" /><? } ?>
                    </div>
                </td>
              </tr>
              <tr onclick="showGradeDtls('<?=$v->id?>', '<?=$schoolId?>', '<?=$vv?>');">
                <td width="50%" class="f32 txtbold border_right"><img src="images/student_icon.jpg" alt="" class="marginleft5 margintop10"/> <span class="lineht1_8 marginleft5"><?=$studentsCount?></span></td>
                <td width="50%" class="f32 txtbold"><img src="images/teacher_icon.jpg" alt="" class="marginleft5 margintop10"/> <span class="lineht1_8 marginleft5"><?=$teachersCount?></span></td>
              </tr>
            </table>
        </div><!-- Grade Division -->
	<?  	}
		}
	}
	?>
    	</div>
  	</div>
    <?
	
	exit();
}

if($_POST['act']=="loadGradeDtls") {
	ob_clean();
	$gradeId = $_POST['gradeId'];
	$schoolId = $_POST['schoolId']; 
	
	$grade_obj = new Student();
	$grade_obj->grade_id=$gradeId;
	$rs_grade_student = $grade_obj->getAllGradeStudents();
	
	$rs_grade = Grade::getGradeById($gradeId);
	
	?>
    <input type="hidden" name="master_school_id" id="master_school_id" value="<?=$schoolId?>" />
    <input type="hidden" name="master_grade_section" id="master_grade_section" value="<?=$_POST['section']?>" />
    <div class="fullsize">
                
        <div class="fullsize lineht2 border_bottom">
            <div class="pull_left padlr10 padtb5 txtbold letterspac f22">
				<span class="cursor" onclick="showGradebySchl('<?=$schoolId?>')"><u>Grade List</u></span> >> <?=$rs_grade->grade_name?>
            </div>
            <div class="pull_right padlr10 padtb10 txtbold letterspac f18">Student #: <?=count($rs_grade_student)?></div>
        </div>
        
        <div class="fullsize padtb10"><!-- Grade Tab-->
            
            <div class="gradetab_outer" style="width:98%; margin:0 1%;">
                
                <div class="pull_left">
                    <div class="grade_tab active" style="border-right:0;" id="grade_tabS" onclick="showGradeStudents('S', '<?=$gradeId?>')">Students</div>
                    <div class="grade_tab" style="border-right:0;" id="grade_tabT" onclick="showGradeStudents('T', '<?=$gradeId?>')">Teachers</div>
                    <div class="grade_tab" id="grade_tabSB" onclick="showGradeStudents('SB', '<?=$gradeId?>')">Subjects</div>
                    <!--<div class="grade_tab" id="show_projecttab" onclick="showGradeStudents('P', '<?=$gradeId?>')">Projects</div>-->
                </div>
                <div class="pull_right">
                    <? if($GLOBALS['isAdd']){ ?><div class="gradeAddition pull_left bgbrown2 padlr10 padtb5 txtwhite txtbold f18 cursor margintop5 marginright5 grade_S" onclick="showStudents('<?=$gradeId?>')">ASSIGN STUDENT</div><? } ?>
                    <? if($GLOBALS['isAdd']){ ?><div class="gradeAddition pull_left bgbrown2 padlr10 padtb5 txtwhite txtbold f18 cursor margintop5 grade_S" onclick="showCirculars('<?=$gradeId?>', 'GS')">SEND CIRCULAR</div><? } ?>
                    <? if($GLOBALS['isAdd']){ ?><div class="gradeAddition pull_left bgbrown2 padlr10 padtb5 txtwhite txtbold f18 cursor margintop5 grade_T" id="" style="display:none;" onclick="showTeacherFrm('N', '<?=$gradeId?>', '')">ASSIGN TEACHER</div><? } ?>
                    <? if($GLOBALS['isAdd']){ ?><div class="gradeAddition pull_left bgbrown2 padlr10 padtb5 txtwhite txtbold f18 cursor margintop5 grade_SB" id="" style="display:none;" onclick="showSubFrm('N', '<?=$gradeId?>', '')">ASSIGN SUBJECT</div><? } ?>
                    <? if($GLOBALS['isAdd']){ ?><div class="gradeAddition pull_left bgbrown2 padlr10 padtb5 txtwhite txtbold f18 cursor margintop5 grade_P" id="" style="display:none;">ASSIGN PROJECT</div><? } ?>
                </div>
                
                <div class="fullsize border_theme" id="gradedetatilstab"></div>
            </div>
            
        </div><!-- Grade Tab-->
    
    </div>
    <script type="text/javascript">
	showGradeStudents('S', '<?=$gradeId?>');
	</script>
    <?
	exit();
}

if($_POST['act']=="loadGradeStudents") {
	ob_clean();
	$gradeId = $_POST['gradeId']; $action = $_POST['action']; $page_limit= $_POST['page_limit'];
	if($_POST['action']=="S") include "grade_students.php";
	else if($_POST['action']=="T") include "grade_teachers.php";
	else if($_POST['action']=="SB") include "grade_subjects.php";
	else if($_POST['action']=="P") include "grade_projects.php";
	exit();
}

if($_POST['act']=="loadSubjectForm") {
	ob_clean();
	?>
    <table width="450" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong>Assign Subject</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td>Choose Subject</td>
            <td><?
					if($_POST['subjectId']!='' && $_POST['subjectId']!='undefined') {
						$grade_subject_id = $_POST['subjectId'];
					} else {
						$grade_subject_id = '';
					}
                    $rs_grade_subjs = Subject::chkSubjectExist($_POST['schoolId'], $_POST['gradeId'], $grade_subject_id); 
					
					if(count($rs_grade_subjs)>0){
				?>
                    <select class="listbox" name="assign_grade_subject_id" id="assign_grade_subject_id" multiple="multiple" style="max-height:300px; height:100px; width:300px;">
                        <option value="">-- Select Grade Subject</option>
                    <?  foreach($rs_grade_subjs as $K=>$V){ ?>
                                <option value="<?=$V->id?>" <? if($grade_subject_id!=''){?> <? if($rs_grade_subjs->subject_id==$V->id){?>selected="selected"<? } } ?>><?=$V->subject_name?></option>
                    <?  } ?>
                    </select>
                <? } else { ?>
                	No subjects are available..!
                <? } ?>
            </td>
        </tr>
        <tr>
        	<td colspan="2" align="right">
            	<div class="fullsize txtwhite txtcenter f18">
                <? if(count($rs_grade_subjs)>0){ ?>
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="showSubFrm('S', '<?=$_POST['gradeId']?>','<?=$grade_subject_id?>')"><strong>Save</strong></div>
                <? } ?>
                </div>
            </td>
        </tr>
    </table>
    <?
	exit();
}

if($_POST['act']=='assignGradeSubject'){
	ob_clean();
	if($_POST['action']=="D") {
		Teacher::unsetSubjectFromGradeTeacherBySubGradeId($_POST['grade_subject_id'], $_POST['grade_id'], $_POST['grade_section']);
		Subject::deleteGradeSubject($_POST['grade_subject_id']);		
	} else if($_POST['action']=="S") { 
		if($_POST['grade_subject_id']!=''){
			$rsGradeSubjectUpd = Subject::updateGradeSubject($_POST['school_id'],$_POST['grade_id'],$_POST['subject_id'],addslashes($_POST['description']),$_POST['grade_subject_id']);
		}else{
			$subjectIdArr=array();
			$subjectIdArr = explode(",", $_POST['subject_id']);
			if(!empty($subjectIdArr)) {
				foreach($subjectIdArr as $kk=>$vv) {
					$rsGradeSubjectIns = Subject::insertGradeSubject($_POST['school_id'],$_POST['grade_id'],$vv,addslashes($_POST['description']));
				}
			}
		}
	}
	exit();
}

if($_POST['act']=="loadTeacherForm") {
	ob_clean();
	
	if($_POST['action']=="N") {
		 $rs_class_teacher = Teacher::getClassTeacherByGradeIdAndSection($_POST['gradeId'], $_POST['gradeSection']);
		 if($rs_class_teacher->id!=NULL) $checked="disabled"; else $checked="";
		
	?>
    <table width="450" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong>Assign Teacher</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td>Choose Subject</td>
            <td>
				<? $rs_subjects = Subject::getGradeSubjects($_POST['gradeId'], $_POST['schoolId'], $_POST['gradeSection']); ?>
                <select class="listbox" name="new_grade_subject_id" id="new_grade_subject_id" onchange="showSubTeachers()">
                    <option value="">-- Select Grade Subject</option>
					<? if(count($rs_subjects)>0){
						foreach($rs_subjects as $K=>$V){
							$rs_subject = Subject::getSubjectById($V->subject_id); ?>
							<option value="<?=$rs_subject->id?>"><?=$rs_subject->subject_name?></option>
					<?
						}
					}
                    ?>
                </select>
            </td>
        </tr>
        <tr>
        	<td id="gradeteacherassignlist" colspan="2"></td>
        </tr>
        <tr>
        	<td>Is Class Teacher?</td>
            <td>
            	<input type="radio" name="is_grade_class_teacher" id="is_grade_class_teacher" value="Y" <?=$checked?> /> Yes
                <input type="radio" name="is_grade_class_teacher" id="is_grade_class_teacher" value="N" <?=$checked?> checked/> No
            </td>
        </tr>
        <tr>
        	<td colspan="2" align="right">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="showTeacherFrm('S', '<?=$_POST['gradeId']?>','<?=$_POST['gTeacherId']?>')"><strong>Save</strong></div>
                </div>
            </td>
        </tr>
    </table>
    <?
	}
	
	if($_POST['action']=="E") {
		 $rs_class_teacher = Teacher::getClassTeacherByGradeIdAndSection($_POST['gradeId'], $_POST['gradeSection']);
		 //if($rs_class_teacher->id!=NULL) $checked="disabled"; else $checked="";
		 $rs_exits = Teacher::checkGradeSecTeacherExists($_POST['schoolId'], $_POST['gradeId'], $_POST['gradeSection'], $_POST['teacherId']);
		 $existsArr = explode(",", $rs_exits->subject_id);

	?>
    <table width="450" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong>Assign Teacher</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td>Choose Subject</td>
            <td>
				<? $rs_subjects = Subject::getGradeTeacherSubjects($_POST['gradeId'], $_POST['schoolId'], $_POST['gradeSection'], $_POST['teacherId']); ?>
                <select class="listbox" name="newe_grade_subject_id" id="newe_grade_subject_id" onchange="showSubTeachers()" multiple="multiple" style="width:100%;">
                    <option value="">-- Select Grade Subject</option>
					<? 
					if(count($rs_subjects)>0){
						foreach($rs_subjects as $K=>$V){
							$rs_subject = Subject::getSubjectById($V->subject_id);
					?>
							<option value="<?=$rs_subject->id?>" <?=(in_array($rs_subject->id, $existsArr))?"selected":""?>><?=$rs_subject->subject_name?></option>
					<?
						}
					}
                    ?>
                </select>
            </td>
        </tr>
        <!--<tr>
        	<td id="gradeteacherassignlist" colspan="2"></td>
        </tr>
        <tr>
        	<td>Is Class Teacher?</td>
            <td>
            	<input type="radio" name="is_grade_class_teacher" id="is_grade_class_teacher" value="Y" <?=$checked?> /> Yes
                <input type="radio" name="is_grade_class_teacher" id="is_grade_class_teacher" value="N" <?=$checked?> checked/> No
            </td>
        </tr>-->
        <tr>
        	<td colspan="2" align="right">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="showTeacherFrm('SE', '<?=$_POST['gradeId']?>', '<?=$_POST['gTeacherId']?>' , '<?=$_POST['teacherId']?>')"><strong>Save</strong></div>
                </div>
            </td>
        </tr>
    </table>
    <?
	}
	
	if($_POST['action']=="S") {
		
		$teacher_obj = new Teacher();
		$teacher_obj->grade_id=$_POST['gradeId'];
		$teacher_obj->school_id=$_POST['schoolId'];
		$teacher_obj->grade_section=$_POST['gradeSection'];
		$teacher_obj->teacher_id=$_POST['teacherId'];
		$rs_teacher = $teacher_obj->getAllGradeTeacherDtls();
	
		if(count($rs_teacher)>0) {
			if($rs_teacher[0]->subject_id!=0 && $rs_teacher[0]->subject_id!="") $subjectIs = $rs_teacher[0]->subject_id.",".$_POST['subjectId']; else $subjectIs = $_POST['subjectId'];
			Teacher::updateGradeTeacherByfield("subject_id", $subjectIs, $rs_teacher[0]->id);
		} else {
			Teacher::insertGradeTeacher($_POST['schoolId'], $_POST['gradeId'], $_POST['gradeSection'], $_POST['subjectId'], $_POST['teacherId'], $_POST['isClassTeacher'], $_SESSION['UserId']);
		}
	}
	
	if($_POST['action']=="SE") {
		Teacher::updateGradeTeacherBySubjects($_POST['schoolId'], $_POST['gradeId'], $_POST['gradeSection'], $_POST['teacherId'], $_POST['subjectId'], $_POST['gTeacherId']);
	}
	
	if($_POST['action']=="D") {
		//print_r($_POST);
		$grade_obj = new Teacher();
		$grade_obj->id=$_POST['gTeacherId'];
		$rs_grade_teacher = $grade_obj->getAllGradeTeacherDtls();
		$subjectArr = explode(",", $rs_grade_teacher->subject_id);
		$subjectsArr=array();
		foreach($subjectArr as $k=>$v) {
			$rs_subjects = Subject::getSubjectById($v);
			$subjectsArr[] = $v."~".$rs_subjects->subject_name;
		}

	?>
    <table width="450" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong>Remove Teacher From Grade</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td width="242">Do you want to remove this teacher from the Subject or Grade?</td>
            <td width="208">
            	<input type="radio" name="remove_teacher" id="remove_teacher" value="S" onclick="chooseTeacherOptions()" /> Subject
                <input type="radio" name="remove_teacher" id="remove_teacher" value="G" onclick="chooseTeacherOptions()" checked/> Grade
            </td>
        </tr>
        <tr id="removablesubjects" style="display:none;">
        	<td id="tserror">Choose Subjects which do you want to remove?</td>
            <td>
            	<?
				if(!empty($subjectsArr)) {
					foreach($subjectsArr as $kk=>$vv) { $vvv = explode("~", $vv);
					?>
                    	<input type="checkbox" name="teacher_r_subjects[]" id="teacher_r_subjects" class="teacher_r_subjects" value="<?=$vvv[0]?>" /> <?=$vvv[1]?><br />
                    <?
					}
				}
				?>
            </td>
        </tr>
        <tr>
        	<td colspan="2" align="right">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="showTeacherFrm('DC', '<?=$_POST['gradeId']?>','<?=$_POST['gTeacherId']?>')"><strong>Save</strong></div>
                </div>
            </td>
        </tr>
    </table>
    <?
		
	}
	
	if($_POST['action']=="DC") { 
		if($_POST['option']=="S") { 
			Teacher::unsetTeacherFromGradeSubjectById($_POST['subjectIds'], $_POST['gTeacherId']);
		} else { 
			Teacher::deleteGradeTeacher($_POST['gTeacherId']);
		}
	}
	
	exit();
}

if($_POST['act']=="loadTeacherList") {
	ob_clean();
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
        <tr>
        	<td>Choose Teacher</td>
            <td>
				<?
					$sub_obj = new Teacher();
					$sub_obj->school_id = $_POST['schoolId'];
					$sub_obj->subject_id = $_POST['subjectId'];
					$rs_teachers = $sub_obj->getTeachersDtls();
				?>
                <select class="listbox" name="new_grade_teacher_id" id="new_grade_teacher_id">
                    <option value="">-- Select Grade Teachers--</option>
					<? 
					if(count($rs_teachers)>0){
						foreach($rs_teachers as $K=>$V){
							$teacherName = $V->first_name." ".$V->middle_name." ".$V->last_name;
					?>
							<option value="<?=$V->id?>"><?=trim($teacherName)?></option>
					<?
						}
					}
                    ?>
                </select>
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
	$studentFrmPage = 'Grade';
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>Student Details</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2" style="padding:0px;">
				<? if($_POST['action']=="DF") include "student_detailed_add.php"; if($_POST['action']=="QF") include "student_quick_add.php"; ?>
            </td>
        </tr>
    </table>
    <?
	exit();
}

if($_POST["act"]=='updateIsClassTeacher'){
	ob_clean();
		Teacher::updateGradeIsClassTeacher($_POST['status'], $_POST['id']);
	exit();
}

if($_POST['act']=="showAllGradeStudents") {
	ob_clean();
	$grade_obj = new Student();
	$grade_obj->grade_id=$_POST['grade_id'];
	$grade_obj->sortby="ASC";
	$grade_obj->orderby="first_name";
	$rs_grades = $grade_obj->getAllStudentDtls();
	$rs_grade = Grade::getGradeById($_POST['grade_id']); 
	
	/*$rs_grades = Student::getUnassignedStudents($_POST['schoolId'], $_POST['grade_id']);*/
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="3"><strong>Student Details for <?=$rs_grade->grade_name?></strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr style="font-weight:bold; background:#E4C6A0;">
            <td width="12%" style="padding:0px; vertical-align:middle;" align="center" height="40"><input type="checkbox" class="stdcheckall" id="stdcheckall[]" name="stdcheckall[]" /></td>
            <td width="10%" style="padding:0px; vertical-align:middle;" align="center">#</td>
            <td width="48%" style="padding:0px; vertical-align:middle;" align="center">Student Name</td>
        </tr>
        <tr>
            <td colspan="4" style="padding:0px;"><div style="max-height:600px; overflow:auto;">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gradetbl">
			<?
                if(!empty($rs_grades)) {
                    foreach($rs_grades as $K=>$V) {
						$stud_obj = new Student();
						$stud_obj->student_id=$V->id;
						$rs_grade_stud = $stud_obj->getAllGradeStudents();
				?>
                <tr>
                    <td align="left" width="12%"><input type="checkbox" name="grade_new_student_list" id="multi_checkbox" class="new_student_id" value="<?=$V->id?>" <?=($rs_grade_stud[0]->student_id==$V->id)?"checked":""?> /></td>
                    <td align="center" width="10%"><?=($K+1)?></td>
                    <td align="left" width="48%"><?=$V->first_name?> <?=$V->middle_name?> <?=$V->last_name?></td>
                </tr>
                <?
					}
                }
            ?>	
            	</table></div>
            </td>
        </tr>
        <tr>
        	<td colspan="3" align="right">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="submitNewStudents('<?=$_POST['grade_id']?>')"><strong>Save</strong></div>
                </div>
            </td>
        </tr>
    </table>
    <script type="text/javascript">
	$('.stdcheckall').click(function(){
		if($('.stdcheckall').is(':checked')){ $('.new_student_id').prop('checked',true); }
		else{ $('.new_student_id').prop('checked',false); }
	});
	</script>
    <?
	exit();
}

if($_POST['act']=="saveNewStudents") {
	ob_clean();
	
	$studArr = explode(",", $_POST['studentIds']);
	if(!empty($studArr)) {
		foreach($studArr as $kk=>$vv) {
			$stud_obj = new Student();
			$stud_obj->student_id=$vv;
			$rs_grade_stud = $stud_obj->getAllGradeStudents();
			if(count($rs_grade_stud)>0) {
				Student::updateGradeStudent($_POST['schoolId'], $vv, $_POST['gradeId'], $_POST['gradeSection']);
			} else {
				Student::insertGradeStudent($_POST['schoolId'], $vv, $_POST['gradeId'], $_POST['gradeSection']);
			}
			if($_POST['gradeSection']!="" && $_POST['gradeSection']!="undefined") Student::updateStudentByField("grade_section", $_POST['gradeSection'], $vv);
		}
	}
	
	exit();
}

if($_POST['act']=="loadAllCirculars") {
	ob_clean();
	$gradeId = $_POST['grade_id'];
	$sendType = $_POST['send_type'];
	$schoolId = $_POST['school_id'];
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="3"><strong>All Circulars</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="4" style="padding:0px;">
            	<? include "student_mail_form.php"; ?>
            </td>
        </tr>
    </table>
    <?
	exit();
}

?>


<link rel="stylesheet" type="text/css" href="css/default_style.css" />
<style type="text/css">
.boxerror{border:1px solid #F00;}
</style>

<div class="fullsize">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright5" /></td>
                <td>List <br/> <span class="f30"><strong>Grade</strong></span></td>
              </tr>
            </table>
        </div>
        
    </div>
    
</div>

<div class="fullsize">
    
        <div class="fullsize padtb15">
            
            <div class="newsletter_left"> <!-- Grade Menu -->
            	<div class="newsletter_submenu txtwhite">
					<div class="circular_outer">
                    	<div class="newcircular_head" id="show_currentteacher">Grade</div>
                        <ul class="currentteacher_content txttheme">
						<? 
                        $rs_schools = School::getAccessedSchools($GLOBALS['schoolAccess']); 
                        if(!empty($rs_schools)) {foreach($rs_schools as $sk=>$sv) { 
                        ?>
                        <? if($GLOBALS['schoolAccess'][$sv->id]) { ?>
                        	<li onclick="showGradebySchl('<?=$sv->id?>', 'first_name', 'ASC')" style="cursor:pointer;"><?=$sv->school_name?><span class="tabbtn" id="1tabbtn_<?=$sv->id?>"></span></li>
                        <? } ?>
                        <?
                        } }
                        ?>
                        </ul>
                    </div>
                    
                </div>
            </div><!-- Grade Menu -->
            
            <div class="newsletter_right border_theme bgwhite" id="gradelisttab"></div><!-- Grade -->
            
        </div>
    
</div>

<div id="student_popup" style="display:none; padding:0px; margin:0px;"></div>
<div id="grade_popup" style="display:none; margin:0px; padding:0px;"></div>


<script type="text/javascript">

function popupDtls(data){
	
	$("#grade_popup").show();
	if(data!="" && data!=undefined) $("#grade_popup").html(data);
  	$("#grade_popup").dialog({
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

function closePopup(){ $("#grade_popup").dialog('close');  }

function showAddGrade(action, id, school_id, new_action) { 
	
	$("#grade_popup").show();
	$("#grade_popup").dialog('open');
	$("#grade_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'grade',
		b:'act=loadGradeFrm&action='+action+'&gradeId='+id+'&schoolId='+school_id+'&new_action='+new_action,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#grade_popup").html(data);
			popupDtls();
		}			
	});
	
}

showGradebySchl('<?=$rs_schools[0]->id?>');
function showGradebySchl(school_id) { 
	
	$('.tabbtn').removeClass('arrow');
	$('#1tabbtn_'+school_id).addClass('arrow');
	
	$("#gradelisttab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'grade',
		b:'act=loadGradeList&schoolId='+school_id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#gradelisttab").html(data);
		}			
	});
	
}

function showGradeDtls(grade_id, school_id, section) {
	
	$("#gradelisttab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'grade',
		b:'act=loadGradeDtls&gradeId='+grade_id+'&schoolId='+school_id+'&section='+section,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#gradelisttab").html(data);
		}			
	});
}

function showGradeStudents(action, grade_id) { 
	
	$('.grade_tab').removeClass('active');
	$('#grade_tab'+action).addClass('active');
	
	$('.gradeAddition').hide();
	$('.grade_'+action).show();
	var page_limit = $('#student_page_limit').val(); 
	
	$("#gradedetatilstab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'grade',
		b:'act=loadGradeStudents&gradeId='+grade_id+'&action='+action+'&page_limit='+page_limit,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#gradedetatilstab").html(data);
		}			
	});
}

function studentListPaging(page, action) {
	
	var action = "S";
	var grade_id = $('#student_grade_id').val();
	$('.grade_tab').removeClass('active');
	$('.grade_tab'+action).addClass('active');
	$("#gradedetatilstab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	
	var page_limit = $('#student_page_limit').val();
	ajax({
		a:'grade',
		b:'act=loadGradeStudents&page='+page+'&gradeId='+grade_id+'&action='+action+'&page_limit='+page_limit,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#gradedetatilstab").html(data);
		}			
	});
}

function showSubFrm(action, grade_id, sub_id) { 
	
	var school_id = $('#master_school_id').val();
	
	if(action=="N") {
		$("#grade_popup").show();
		$("#grade_popup").dialog('open');
		$("#grade_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
		ajax({
			a:'grade',
			b:'act=loadSubjectForm&action='+action+'&gradeId='+grade_id+'&schoolId='+school_id+'&subjectId='+sub_id,		
			c:function(){},
			d:function(data){ //alert(data);
				$("#grade_popup").html(data);
				popupDtls();
			}			
		});
	}
	else if(action=="S") { 
		
		var	subject_id = $("#assign_grade_subject_id").val();
		var err=0; 
	
		if($('#assign_grade_subject_id').val()=='' || $('#assign_grade_subject_id').val()==undefined){ err=1; $('#assign_grade_subject_id').addClass('boxerror'); } else { $('#assign_grade_subject_id').removeClass('boxerror'); }
		
		if(err==0) {
			ajax({
				a:'grade',
				b:'act=assignGradeSubject&subject_id='+subject_id+'&school_id='+school_id+'&grade_id='+grade_id+'&grade_subject_id='+sub_id+'&action='+action,		
				c:function(){},
				d:function(data){
					//alert(data);
					if(sub_id!=""){
						alert("Grade Subject Updated Successfully");
					}else{
						alert("Grade Subject Added Successfully");
					}
					closePopup();
					showGradeStudents('SB', grade_id);
				}			
			});
		}
	}
	
	else if(action=="D") {
		var grade_section = $('#master_grade_section').val(); 
		ajax({
			a:'grade',
			b:'act=assignGradeSubject&grade_subject_id='+sub_id+'&action='+action+'&grade_id='+grade_id+'&grade_section='+grade_section,		
			c:function(){},
			d:function(data){ //alert(data);
				alert('Deleted Successfully');
				showGradeStudents('SB', grade_id);
			}			
		});
	}
	
}

function showTeacherFrm(action, grade_id, grade_teacher_id, teacher_id) {
	
	var school_id = $('#master_school_id').val();
	var grade_section = $('#master_grade_section').val();
	
	if(action=="N" || action=="E") { // Teacher Form new
		$("#grade_popup").show();
		$("#grade_popup").dialog('open');
		$("#grade_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
		ajax({ 
			a:'grade',
			b:'act=loadTeacherForm&action='+action+'&gradeId='+grade_id+'&schoolId='+school_id+'&gTeacherId='+grade_teacher_id+'&gradeSection='+grade_section+'&teacherId='+teacher_id,		
			c:function(){},
			d:function(data){ //alert(data);
				$("#grade_popup").html(data);
				popupDtls();
			}			
		});
	}
	
	else if(action=="S") { // Save Teacher Form Details
		var	subject_id = $("#new_grade_subject_id").val();
		var	is_class_teacher = $("input[name=is_grade_class_teacher]:checked").val();
		var	teacher_id = $("#new_grade_teacher_id").val();
		var err=0; 
		if($('#new_grade_subject_id').val()==''){ err=1; $('#new_grade_subject_id').addClass('boxerror'); } else { $('#new_grade_subject_id').removeClass('boxerror'); }
		if($('#new_grade_teacher_id').val()==''){ err=1; $('#new_grade_teacher_id').addClass('boxerror'); } else { $('#new_grade_teacher_id').removeClass('boxerror'); }
		
		if(err==0) {
			ajax({
				a:'grade',
				b:'act=loadTeacherForm&action='+action+'&gradeId='+grade_id+'&schoolId='+school_id+'&subjectId='+subject_id+'&isClassTeacher='+is_class_teacher+'&teacherId='+teacher_id+'&gradeSection='+grade_section,		
				c:function(){},
				d:function(data){ //alert(data); return false;
					alert('Teacher added successfully..');
					closePopup();
					showGradeStudents('T', grade_id);
				}			
			});
		}
	}
	
	else if(action=="SE") { // Save Teacher Form Details
		var	subject_id = $("#newe_grade_subject_id").val();
		//var	is_class_teacher = $("input[name=is_grade_class_teacher]:checked").val();
		var err=0; 
		if($('#newe_grade_subject_id').val()=='' || $('#newe_grade_subject_id').val()==null){ err=1; $('#newe_grade_subject_id').addClass('boxerror'); } else { $('#newe_grade_subject_id').removeClass('boxerror'); }
		if(err==0) {
			ajax({
				a:'grade',
				b:'act=loadTeacherForm&action='+action+'&gradeId='+grade_id+'&schoolId='+school_id+'&subjectId='+subject_id+'&teacherId='+teacher_id+'&gradeSection='+grade_section+'&gTeacherId='+grade_teacher_id,		
				c:function(){},
				d:function(data){ //alert(data); return false;
					alert('Teacher added successfully..');
					closePopup();
					showGradeStudents('T', grade_id);
				}			
			});
		}
	}
	
	else if(action=="D") { // Delete Option show 
		$("#grade_popup").show();
		$("#grade_popup").dialog('open');
		$("#grade_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
		ajax({
			a:'grade',
			b:'act=loadTeacherForm&action='+action+'&gradeId='+grade_id+'&schoolId='+school_id+'&gTeacherId='+grade_teacher_id,		
			c:function(){},
			d:function(data){ 
				$("#grade_popup").html(data);
				popupDtls();
			}			
		});
		
	}
	
	else if(action=="DC") { // Delete option completed
		
		var err=0;
		var option =  $('input[name=remove_teacher]:checked').val();
		var subjectIds = $('input[class=teacher_r_subjects]:checked').map(function(){
			return this.value;
		}).get();
		if(option=="S") if($('input[class=teacher_r_subjects]:checked').val()==undefined){ err=1; $('#tserror').addClass('txterror'); } else { $('#tserror').removeClass('txterror'); }
		
		if(err==0) {
			ajax({
				a:'grade',
				b:'act=loadTeacherForm&action='+action+'&gradeId='+grade_id+'&schoolId='+school_id+'&gTeacherId='+grade_teacher_id+'&option='+option+'&subjectIds='+subjectIds,		
				c:function(){},
				d:function(data){  //alert(data); return false;
					alert('Deleted Successfully'); closePopup();
					showGradeStudents('T', grade_id);
				}			
			});
		}
	}
	
}

function showSubTeachers() {
	var subject_id = $('#new_grade_subject_id').val();
	var school_id = $('#master_school_id').val();
	
	ajax({
		a:'grade',
		b:'act=loadTeacherList&subjectId='+subject_id+'&schoolId='+school_id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#gradeteacherassignlist").html(data);
		}			
	});
	
}

function chooseTeacherOptions() {
	var option =  $('input[name=remove_teacher]:checked').val(); 
	if(option=="S") $('#removablesubjects').show(); else $('#removablesubjects').hide();

}

function drwStatusChecked(id, status, grade_id){
	
	if(status=='Y'){
		$('#spSt'+id).html('<img src="images/green.gif" />&nbsp;<span style="cursor:pointer" onclick="chStatusChecked(\''+id+'\',\'N\',\''+grade_id+'\')" title="Click to make status inactive"><img src="images/red1.gif" border="0" alt="Click to make status inactive" title="Click to make status inactive" /></span>');
	}
	else{
		$('#spSt'+id).html('<span style="cursor:pointer" onclick="chStatusChecked(\''+id+'\',\'Y\',\''+grade_id+'\')" title="Click to make status active"><img src="images/green1.gif" border="0" alt="Click to make status active" title="Click to make status active"/></span>&nbsp;<img src="images/red.gif" border="0" /></span>');
	}
}

function chStatusChecked(id, status, grade_id){
 
	ajax({
		a:'grade',
		b:'act=updateIsClassTeacher&id='+id+"&status="+status+"&grade_id="+grade_id,		
		c:function(){},
		d:function(data){
			//alert(data); return false;
			drwStatusChecked(id, status, grade_id);
			showGradeStudents('T', grade_id)
		}			
	}); 
	
}

function showStudents(grade_id) {
	var school_id = $('#master_school_id').val();
	$("#grade_popup").show();
	$("#grade_popup").dialog('open');
	$("#grade_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'grade',
		b:'act=showAllGradeStudents&grade_id='+grade_id+'&schoolId='+school_id,		
		c:function(){},
		d:function(data){
			$("#grade_popup").html(data);
			popupDtls();
		}			
	}); 
	
}

function submitNewStudents(grade_id) {
	
	var err=0;
	var studentIds = $('input[class=new_student_id]:checked').map(function(){
		return this.value;
	}).get();
	var school_id = $('#master_school_id').val();
	var grade_section = $('#master_grade_section').val();

	if(studentIds=="" || studentIds==undefined) {
		alert('Please select rows'); return false;
	}
		
	ajax({
		a:'grade',
		b:'act=saveNewStudents&gradeId='+grade_id+'&studentIds='+studentIds+'&schoolId='+school_id+'&gradeSection='+grade_section,		
		c:function(){},
		d:function(data){
			closePopup();
			showGradeStudents('S', grade_id)
		}			
	}); 
}

function showStudentFrm(student_id, action) { //alert(student_id); alert(action);
	
	var school_db_id = $('#master_school_id').val();
	$("#grade_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'grade',
		b:'act=loadStudentFrm&studentId='+student_id+'&schoolId='+school_db_id+'&action='+action,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#grade_popup").html(data);
			popupDtls();
		}			
	});
}

function studentActions(student_id, action, grade_id){
	var page = $('#student_list_page').val();
	var school_db_id = $('#master_school_id').val();
	if(grade_id==undefined) grade_id=''; else grade_id=grade_id;
	$("#grade_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'students',
		b:'act=viewStudentDtls&student_id='+student_id+'&action='+action+'&school_id='+school_db_id+'&grade_id='+grade_id,		
		c:function(){},
		d:function(data){
			$("#grade_popup").html(data);
			popupDtls();
		}			
	});
	
}

function showCirculars(grade_id, send_type) { //send_type=GS-(Grade Student), S-(Single)
	
	var school_db_id = $('#master_school_id').val();
	ajax({
		a:'grade',
		b:'act=loadAllCirculars&grade_id='+grade_id+'&send_type='+send_type+'&school_id='+school_db_id,		
		c:function(){},
		d:function(data){
			$("#grade_popup").html(data);
			popupDtls();
		}			
	});
	
}


</script>



<?
}
include "template.php";
?>