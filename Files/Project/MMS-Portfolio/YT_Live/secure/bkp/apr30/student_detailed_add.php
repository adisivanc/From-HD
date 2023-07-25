<?
include "includes.php";	
if($_POST['act']=="getGradeList"){
	ob_clean();
	$rs_student = Student::getStudentById($_POST['student_id']); 
?>
    <select class="listbox" name="grade_id" id="grade_id" style="width:315px;" onchange="showGradeFee(this.value)">
        <option value="">-- Select Grade --</option>
        <?
        $rsGrade = Grade ::getAllGrade($_POST['school_id']);
        if(count($rsGrade)>0){
			foreach($rsGrade as $K2=>$V2){
			?>
			<option value="<?=$V2->id?>" <? if($rs_student->grade_id==$V2->id){?>selected="selected"<? }?>><?=ucfirst($V2->grade_name)?></option>
			<?
			}
        }
        ?>
    </select>	 
<?	exit();
}

if($_POST['act']=="loadGradeFee"){
	ob_clean();
	$grade_fee = Grade::getGradeById($_POST['grade_id']);
	echo trim($grade_fee->registration_fee).'-'.$grade_fee->term_fees .'-'.$grade_fee->material_fee.'-'.$grade_fee->food_fee;
 	exit();
}

 
$languages_known=array(); $siblings_of_student=array(); $document_of_student=array();
if($studentId!='' && $studentId!="undefined"){
	$rs_student = Student::getStudentById($studentId); 
	$languages_known = unserialize($rs_student->languages_known);
	$siblings_of_student = unserialize($rs_student->siblings_of_student);
	$document_of_student = unserialize($rs_student->document_type);
}
//echo "<pre>"; print_r($document_of_student); echo "</pre>";
?>

<style>
.boxerror{border:1px solid #F00;}
.txterror{color:#F00}
</style>

<div class="fullsize">
<div class="pull_left">
    <div class="grade_tab active" id="grade_tabB" style="border-right:0;" >Basic Details</div>
    <div class="grade_tab" id="grade_tabS" style="border-right:0;" >Student Details</div>
    <div class="grade_tab" id="grade_tabF" style="border-right:0;" >Family Details</div>
    <div class="grade_tab" id="grade_tabP" >Previous School</div>
    <div class="grade_tab" id="grade_tabD" >Documents</div>
    <div class="grade_tab" id="grade_tabFS" >Fee Setup</div>
</div>

<div class="pull_right">
    <div class="grade_tab active" id="grade_tabB" style="border-right:0;" onclick="showStudentList('<?=$schoolId?>');">Student List</div>
</div>

 
<form name="studentFrm" id="studentFrm" method="post" enctype="multipart/form-data">
<input type="hidden" id="act" name="act" value="saveStudentFrm"/>
<input type="hidden" id="student_db_id" name="student_db_id" value="<?=$studentId?>" /> 
<input type="hidden" id="school_id" name="school_id" value="<?=$schoolId?>" />
 
<div class="fullsize border_theme pad10">
    <table width="98%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showBasicDtls">
    
        <!--<tr>
            <td width="50%">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td id="schoolnamerr">School Name</td>
                        <td>
							<? if($_SESSION['SchoolId']=='A' || $_SESSION['SchoolId']=='') { ?>
                            <select id="school_id" name="school_id" class="listbox" onchange="getGrade(this.value, student_db_id.value)">
                                <option value="">Select</option>
                                <? $school_name = School::getAllSchool();
                                foreach($school_name as $M=>$N){
                                ?>
                                <option <? if($rs_student->school_id==$N->id){ ?>selected="selected"<? } ?> value="<?=$N->id?>"><?=$N->school_name?></option>
                                <? }?>
                            </select>
                            <? } else { ?>
                            <input type="hidden" name="school_id" id="school_id" value="<?=$_SESSION['SchoolId']?>" />
                            <? } ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>-->
    
        <tr>
            <td><span class="form_head">Personal Details</span></td>
            <td colspan="2"><span class="form_head">Contact Details</span></td>
        </tr>
        <tr>
            <td width="50%">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td>First Name</td>
                        <td><input type="text" class="txtbox" name="first_name" id="first_name" value="<?=$rs_student->first_name?>" /></td>
                    </tr>
                    <tr>
                        <td>Middle Name</td>
                        <td><input type="text" class="txtbox"  name="middle_name" id="middle_name" value="<?=$rs_student->middle_name?>" /></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" class="txtbox"  name="last_name" id="last_name" value="<?=$rs_student->last_name?>"/></td>
                    </tr>
                    <tr>
                        <td id="showGenderErr">Gender</td>
                        <td>
                        <input type="radio" name="gender" id="gender" value="M" <? if($rs_student->gender=='M' || $rs_student->gender=='') echo "checked" ?> />Male
                        <input type="radio" name="gender" id="gender" value="F" <? if($rs_student->gender=='F') echo "checked" ?> />Female
                        </td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>
							<? $dobArr = explode("-", $rs_student->date_of_birth); ?>
                            <select  name="date_of_birth" id="date_of_birth" class="listbox" style="width:20%;">
                            <option value="">DD</option>
                            <? for($i=1;$i<32;$i++){ ?>
                            <option <? if($dobArr[2]==$i){ ?>selected="selected"<? } ?>  value="<?=$i?>"><?=$i?></option>
                            <? } ?>
                            </select>
                            
                            <? $rs_month = currentYearMonth(); ?>
                            <select  name="dob_month" id="dob_month" class="listbox" style="width:32%;">
                            <option value="">MM</option>
                            <? foreach($rs_month as $mk=>$mv){ ?>
                            <option <? if($dobArr[1]==$mk){ ?>selected="selected"<? } ?>  value="<?=$mk?>"><?=$mv?></option>
                            <? } ?>
                            </select>
                            
                            <? $rs_year = listofyears(2001,  date(Y)); ?>
                            <select  name="dob_year" id="dob_year" class="listbox" style="width:20%;">
                            <option value="">YYYY</option>
                            <? foreach($rs_year as $yk=>$yv){ ?>
                            <option <? if($dobArr[0]==$yv){ ?>selected="selected"<? } ?>  value="<?=$yv?>"><?=$yv?></option>
                            <? } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Blood Group</td>
                        <td>
                        <input type="text" class="txtbox" style="width:125px; float:left;" name="blood_group" id="blood_group" value="<?=$rs_student->blood_group?>" />
                        <div style="float:left; margin-left:3px; padding:3px;">Age </div>
                        <input type="text" class="txtbox" style="margin-left:2px; width:125px;" name="age" id="age" value="<?=$rs_student->age?>" onkeypress="return isNumberKey(event)"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td>
                        <input type="file" name="photo" id="photo">
                        <? if($rs_student->photo!=''){?><img src="<?=STUDENT_FILE_HREF.$rs_student->photo?>" width="50"  height="50"/><? } ?>
                        </td>
                    </tr>
                </table>
            </td>
            
            <td valign="top" style="margin-bottom:150px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td>Emergency Contact Name</td>
                        <td><input type="text" class="txtbox" name="emer_name" id="emer_name" value="<?=$rs_student->emergency_contact_name?>" /></td>
                    </tr>
                    <tr>
                        <td>Emergency Contact Email</td>
                        <td><input type="text" class="txtbox"  name="email_address" id="email_address" value="<?=$rs_student->email_address?>" /></td>
                    </tr>
                    <tr>
                        <td>Emergency Contact Mobile</td>
                        <td><input type="text" class="txtbox"  name="emergency_contact_number" id="emergency_contact_number" value="<?=($rs_student->emergency_contact_number=="")?$rs_student->mobile:$rs_student->emergency_contact_number?>" onkeypress="return isNumberKey(event)" /></td>
                    </tr>
                    <tr>
                        <td>Emergency Contact Phone</td>
                        <td><input type="text" class="txtbox"  name="emer_number_phone" id="emer_number_phone" value="<?=($rs_student->phone=="")?$rs_student->phone:$rs_student->phone?>" onkeypress="return isNumberKey(event)" /></td>
                    </tr>
                    <tr>
                        <td>Emergency Contact Relationship</td>
                        <td><input type="text" class="txtbox"  name="emer_relation" id="emer_relation" value="<?=$rs_student->emergency_contact_relationship?>" /></td>
                    </tr>
                    <tr>
                        <td>Nationality</td>
                        <td><input type="text" class="txtbox" name="nationality" id="nationality" value="<?=$rs_student->nationality?>" /></td>
                    </tr>
                    <tr>
                        <td>Mother Tongue</td>
                        <td><input type="text" class="txtbox" name="mother_tongue" id="mother_tongue" value="<?=$rs_student->mother_tongue?>" /></td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
            <td><span class="form_head">Current Address</span></td>
            <td colspan="2"><span class="form_head">Permanent Address</span> <input type="checkbox" id="permanentAddress"  name="permanentAddress"  onclick="fillAddress()"/>Same as Current Address</td>
        </tr>
        
        <tr>
            <td valign="top" style="margin-bottom:150px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td>Address</td>
                        <td><input type="text" class="txtbox" name="current_address" id="current_address" value="<?=$rs_student->current_address?>" /></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><input type="text" class="txtbox"  name="current_state" id="current_state" value="<?=$rs_student->current_state?>" /></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input type="text" class="txtbox"  name="current_city" id="current_city" value="<?=$rs_student->current_city?>" /></td>
                    </tr>
                    <tr>
                        <td>Zipcode</td>
                        <td><input type="text" class="txtbox" name="current_zipcode" id="current_zipcode" value="<?=$rs_student->current_zipcode?>" onkeypress="return isNumberKey(event)" /></td>
                    </tr>
                </table>
            </td>
            
            <td valign="top" style="margin-bottom:150px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td>Address</td>
                        <td><input type="text" class="txtbox" name="permanent_address" id="permanent_address" value="<?=$rs_student->permanent_address?>" /></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><input type="text" class="txtbox"  name="permanent_state" id="permanent_state" value="<?=$rs_student->permanent_state?>" /></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input type="text" class="txtbox"  name="permanent_city" id="permanent_city" value="<?=$rs_student->permanent_city?>" /></td>
                    </tr>
                    <tr>
                        <td>Zipcode</td>
                        <td><input type="text" class="txtbox" name="permanent_zipcode" id="permanent_zipcode" value="<?=$rs_student->permanent_zipcode?>" onkeypress="return isNumberKey(event)"/></td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
            <td align="right" colspan="2">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="submitStudent('S')"><strong>NEXT</strong></div>
                </div> 
            </td>
        </tr>
    </table>
       
    <table width="98%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showPresonalStudentDtls" style="display:none">
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td width="50%">Grade in which currently studying </td>
                        <td width="48%" style="padding-left:10px;"><input type="text" class="txtbox" name="current_studying" id="current_studying" value="<?=$rs_student->current_studying?>" /></td>
                    </tr>
                    <tr>
                        <td>Grade to which Admission is sought</td>
                        <td style="padding-left:10px;">
                            <select class="listbox" name="grade_id" id="grade_id" style="width:315px;" onchange="showGradeFee(this.value)">
                                <option value="">-- Select Grade --</option>
                                <?
                                $rsGrade = Grade ::getAllGrade($schoolId);
                                if(count($rsGrade)>0){
									foreach($rsGrade as $K2=>$V2){
									?>
									<option value="<?=$V2->id?>" <? if($rs_student->grade_id==$V2->id){?>selected="selected"<? }?>><?=ucfirst($V2->grade_name)?></option>
									<?
									}
                                }
                                ?>
                            </select>	
                        </td>
                   	</tr>
                    <tr>
                    	<td valign="top">Roll No</td>
                        <td style="padding-left:10px;"><input type="text" class="txtbox" name="roll_no" id="roll_no" value="<?=$rs_student->roll_no?>" style="width:250px;"></td>
                    </tr>
                    <tr>
                        <td valign="top">Describe what you experience as an<br/>area where you see potential in your child</td>
                        <td style="padding-left:10px;"><textarea class="msgbox" name="child_potential" id="child_potential" style="width:550px;"><?=$rs_student->child_potential?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top">What are the languages/areas that your child shows deep interest in and why?</td>
                        <td style="padding-left:10px;"><textarea class="msgbox" name="child_interest" id="child_interest" style="width:550px;"><?=$rs_student->child_interest?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top">Is your child gifted in any realms of life if so, please state.</td>
                        <td valign="top" style="padding-left:10px;">
                        <input type="radio" name="child_gifted" id="child_gifted" value="Y" <? if($rs_student->child_gifted=='Y') echo "checked" ?> onclick="showChildNotes(this.value,'child_gifted')" />Yes
                        <input type="radio" name="child_gifted" id="child_gifted" value="N" <? if($rs_student->child_gifted=='N') echo "checked" ?> onclick="showChildNotes(this.value,'child_gifted')" />No
                        </td>
                    </tr>
                    <tr id="showChildGiftNotes" style="display:<?=($rs_student->child_gifted=='Y')?"":"none" ?>">
                        <td>&nbsp;</td>
                        <td valign="top" style="padding-left:10px;"><textarea class="msgbox" name="child_gifted_notes" id="child_gifted_notes" style="width:550px;"><?=$rs_student->child_gifted_notes?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top">Does your child face difficulty with any particular area/language?</td>
                        <td valign="top" style="padding-left:10px;">
                        <input type="radio" name="child_difficult" id="child_difficult" value="Y" <? if($rs_student->child_difficult=='Y') echo "checked" ?> onclick="showChildNotes(this.value,'child_difficult')" />Yes
                        <input type="radio" name="child_difficult" id="child_difficult" value="N" <? if($rs_student->child_difficult=='N') echo "checked" ?> onclick="showChildNotes(this.value,'child_difficult')"/>No
                        </td>
                    </tr>
                    <tr id="showDifficult" style="display:<?=($rs_student->child_gifted=='Y')?"":"none" ?>">
                        <td>&nbsp;</td>
                        <td valign="top" style="padding-left:10px;"><textarea class="msgbox" name="child_difficulty_notes" id="child_difficulty_notes" style="width:550px;"><?=$rs_student->child_gifted_notes?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top">Please state any health history ( any illnesses,allergies etc) that is important for us to know.</td>
                        <td valign="top" style="padding-left:10px;">
                        <input type="radio" name="health_issue" id="health_issue" value="Y" <? if($rs_student->health_issue=='Y') echo "checked" ?> onclick="showChildNotes(this.value,'health_issue')" />Yes
                        <input type="radio" name="health_issue" id="health_issue" value="N" <? if($rs_student->health_issue=='N') echo "checked" ?> onclick="showChildNotes(this.value,'health_issue')" />No
                        </td>
                    </tr>
                    <tr id="showHealthHistory" style="display:<?=($rs_student->health_issue=='Y')?"":"none" ?>">
                        <td>&nbsp;</td>
                        <td valign="top" style="padding-left:10px;"><textarea class="msgbox" name="health_history" id="health_history" style="width:550px;"><?=$rs_student->health_history?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top">Does your child play any sport or does he/she show inclination towards any sport?</td>
                        <td valign="top" style="padding-left:10px;">
                            <input type="radio" name="sports_inclination" id="sports_inclination" value="Y" <? if($rs_student->sports_inclination=='Y') echo "checked" ?> onclick="showChildNotes(this.value,'sports_inclination')" />Yes
                            <input type="radio" name="sports_inclination" id="sports_inclination" value="N" <? if($rs_student->sports_inclination=='N') echo "checked" ?> onclick="showChildNotes(this.value,'sports_inclination')" />No
                        </td>
                    </tr>
                    <tr id="showSportsDtls" style="display:<?=($rs_student->sports_notes=='Y')?"":"none" ?>">
                        <td>&nbsp;</td>
                        <td valign="top" style="padding-left:10px;"><textarea class="msgbox" name="sports_notes" id="sports_notes" style="width:550px;"><?=$rs_student->sports_notes?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top">Describe your home environment</td>
                        <td style="padding-left:10px;"><textarea class="msgbox" name="home_environment" id="home_environment" style="width:550px;"><?=$rs_student->home_environment?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top">List the activities your child likes to do during his/her leisure time?</td>
                        <td style="padding-left:10px;"><textarea class="msgbox" name="child_hobbies" id="child_hobbies" style="width:550px;"><?=$rs_student->child_hobbies?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top">Does your child have any pets,if yes,what is it and the name of the pet?</td>
                        <td valign="top" style="padding-left:10px;">
                        <input type="radio" name="is_pet" id="is_pet" value="Y" <? if($rs_student->is_pet=='Y') echo "checked" ?> onclick="showChildNotes(this.value,'is_pet')" />Yes
                        <input type="radio" name="is_pet" id="is_pet" value="N" <? if($rs_student->is_pet=='N') echo "checked" ?> onclick="showChildNotes(this.value,'is_pet')" />No
                        </td>
                    </tr>
                    <tr id="showPetName" style="display:<?=($rs_student->is_pet=='Y')?"":"none" ?>">
                        <td align="right">Pet</td>
                        <td style="padding-left:10px;"> <input type="text" class="txtbox" name="what_pet" id="what_pet" value="<?=$rs_student->what_pet?>" style="width:150px;"> &nbsp;
                        Pet Name  <input type="text" class="txtbox" name="pet_name" id="pet_name" value="<?=$rs_student->pet_name?>" style="width:250px;">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Languages Known</td>
                        <td style="padding-left:10px;">
                            <div id="LanguageLevelTop"></div>
                            <span class="spancursor" id="languagesLevel_a" style="cursor:pointer; padding-left:525px;" onclick="addLanguage();">
                            <div class="pull_right txtbold f24 cursor">+</div>
                            </span>
                    	</td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="2">Details of brothers and sisters of the student</td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="2"> 
                            <div id="SibilingLevelTop"></div>
                            <span class="spancursor" id="sibilingsLevel_a" style="cursor:pointer; padding-left:855px;" onclick="addSibiling();">
                            <div class="pull_right txtbold f24 cursor">+</div>
                            </span> 
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="right" colspan="2">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="submitStudent('F')"><strong>NEXT</strong></div>
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="showStudent('B')"><strong>BACK</strong></div>
                </div>
            </td>
        </tr>
    </table>

    <table width="98%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showFamilyDtls" style="display:none">
        <tr>
            <td><div style="float:left;">Is Parent/Guardian?</div>
            <div style="margin-left:50px; float:left;">
                <input type="radio" name="is_parent" id="is_parent" value="P" <? if($rs_student->is_parent=='P') echo "checked" ?> onclick="showParent(this.value)" checked="checked"/>Parent
                <input type="radio" name="is_parent" id="is_parent" value="G" <? if($rs_student->is_parent=='G') echo "checked"?> onclick="showParent(this.value)" />Guardian
            </div>
            </td>
        </tr>
        <tr  id="showParentDtls">
            <td width="50%">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td>Father Name</td>
                        <td><input type="text" class="txtbox" name="father_name" id="father_name" value="<?=$rs_student->father_name?>" /></td>
                    </tr>
                    <tr>
                        <td>Father Phone</td>
                        <td><input type="text" class="txtbox" name="father_phone" id="father_phone" value="<?=$rs_student->father_phone?>" /></td>
                    </tr>
                    <tr>
                        <td>Father E-Mail</td>
                        <td><input type="text" class="txtbox" name="father_email" id="father_email" value="<?=$rs_student->father_email?>" /></td>
                    </tr>
                    <tr>
                        <td>Qualification</td>
                        <td><input type="text" class="txtbox"  name="father_qualification" id="father_qualification" value="<?=$rs_student->father_qualification?>" /></td>
                    </tr>
                    <tr>
                        <td>Interest</td>
                        <td><input type="text" class="txtbox"  name="father_interest" id="father_interest" value="<?=$rs_student->father_interest?>"/></td>
                    </tr>
                    <tr>
                        <td id="showFatherErr">Details of Employment</td>
                        <td>
                            <input type="checkbox" name="father_employment" id="father_employment" value="SE" <? if($rs_student->father_employment=='SE') echo "checked" ?> />Self employed
                            <input type="checkbox" name="father_employment" id="father_employment" value="S" <? if($rs_student->father_employment=='S') echo "checked" ?> />Service
                            <input type="checkbox" name="father_employment" id="father_employment" value="N" <? if($rs_student->father_employment=='N' || $rs_student->father_employment=='') echo "checked" ?> />None
                        </td>
                    </tr>
                    <tr>
                        <td>Nature of Job/Business</td>
                        <td><input type="text" class="txtbox"  name="father_nature_of_job" id="father_nature_of_job" value="<?=$rs_student->father_nature_of_job?>" /></td>
                    </tr>
                    <tr>
                        <td>Annual Income</td>
                        <td><input type="text" class="txtbox"  name="father_annual_income" id="father_annual_income" value="<?=$rs_student->father_annual_income?>" onkeypress="return isNumberKey(event)"/>
                        </td>
                    </tr>
                
                </table>
            </td>
            
            <td valign="top" style="margin-bottom:150px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td>Mother Name</td>
                        <td><input type="text" class="txtbox" name="mother_name" id="mother_name" value="<?=$rs_student->mother_name?>" /></td>
                    </tr>
                    <tr>
                        <td>Mother Phone</td>
                        <td><input type="text" class="txtbox" name="mother_phone" id="mother_phone" value="<?=$rs_student->mother_phone?>" /></td>
                    </tr>
                    <tr>
                        <td>Mother E-Mail</td>
                        <td><input type="text" class="txtbox" name="mother_email" id="mother_email" value="<?=$rs_student->mother_email?>" /></td>
                    </tr>
                    <tr>
                        <td>Qualification</td>
                        <td><input type="text" class="txtbox"  name="mother_qualification" id="mother_qualification" value="<?=$rs_student->mother_qualification?>" /></td>
                    </tr>
                    <tr>
                        <td>Interest</td>
                        <td><input type="text" class="txtbox"  name="mother_interest" id="mother_interest" value="<?=$rs_student->mother_interest?>" /></td>
                    </tr>
                    <tr>
                        <td id="showMotherErr">Details of Employment</td>
                        <td>
                            <input type="checkbox" name="mother_employment" id="mother_employment" value="SE" <? if($rs_student->mother_employment=='SE') echo "checked" ?> />Self employed
                            <input type="checkbox" name="mother_employment" id="mother_employment" value="S" <? if($rs_student->mother_employment=='S') echo "checked" ?> />Service
                            <input type="checkbox" name="mother_employment" id="mother_employment" value="N" <? if($rs_student->mother_employment=='N' || $rs_student->mother_employment=='') echo "checked" ?> />None
                        </td>
                    </tr>
                    <tr>
                        <td>Nature of Job/Business</td>
                        <td><input type="text" class="txtbox" name="mother_nature_of_job" id="mother_nature_of_job" value="<?=$rs_student->mother_nature_of_job?>" /></td>
                    </tr>
                    <tr>
                        <td>Annual Income</td>
                        <td><input type="text" class="txtbox" name="mother_annual_income" id="mother_annual_income" value="<?=$rs_student->mother_annual_income?>" onkeypress="return isNumberKey(event)" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    
        <tr id="showGuardianDtls" style="display:<?=($rs_student->is_parent=='Y')?"":"none" ?>">
            <td width="50%" colspan="4">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td><span class="form_head">Guardian Details</span></td>
                    </tr>
                    <tr>
                        <td>Guardian Name</td>
                        <td><input type="text" class="txtbox" name="guardian_name" id="guardian_name" value="<?=$rs_student->guardian_name?>" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    
        <tr>
            <td width="50%">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td>Photo</td>
                        <td><input type="file" name="family_photo" id="family_photo"/><? if($rs_student->family_photo!=''){?><img src="<?=FAMILY_FILE_HREF.$rs_student->family_photo?>" width="50"  height="50"/><? } ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
            <td valign="top">What are your educational goals for your child?</td>
            <td><textarea class="msgbox" name="educational_goals" id="educational_goals" style="width:450px;"><?=$rs_student->educational_goals?></textarea></td>
        </tr>
    
        <tr>
            <td valign="top">What is your view on competition?</td>
            <td><textarea class="msgbox" name="view_on_competition" id="view_on_competition" style="width:450px;"><?=$rs_student->view_on_competition?></textarea></td>
        </tr>
   
        <tr>
            <td valign="top">What about Yellow Train's offering appeals to you?</td>
            <td><textarea class="msgbox" name="yt_offering" id="yt_offering" style="width:450px;"><?=$rs_student->yt_offering?></textarea></td>
        </tr>
    
        <tr>
            <td valign="top">What is your idea of a free human being?</td>
            <td><textarea class="msgbox" name="idea_free_human" id="idea_free_human" style="width:450px;"><?=$rs_student->idea_free_human?></textarea></td>
        </tr>
        
        <tr>
            <td align="right" colspan="2">
                <div class="fullsize txtwhite txtcenter f18">
                	<div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="submitStudent('P')"><strong>NEXT</strong></div>
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="showStudent('S')"><strong>BACK</strong></div>
                </div>
            </td>
        </tr>
    </table>

    <table width="98%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showPreviousSchoolDtls" style="display:none">
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td>Name of the School</td>
                        <td><input type="text" class="txtbox" name="previous_school_name" id="previous_school_name" value="<?=$rs_student->previous_school_name?>" /></td>
                        <td>Place of the School</td>
                        <td><input type="text" class="txtbox" name="previous_school_place" id="previous_school_place" value="<?=$rs_student->previous_school_place?>" /></td>
                    </tr>
                    <tr>
                        <td>Grades Attended</td>
                        <td><input type="text" class="txtbox" name="previous_grades_attended" id="previous_grades_attended" value="<?=$rs_student->previous_grades_attended?>" /></td>
                        <td>School Board</td>
                        <td><input type="text" class="txtbox" name="previous_school_board" id="previous_school_board" value="<?=$rs_student->previous_school_board?>" /></td>
                    </tr>
                    <tr>
                        <td>Year of Study</td>
                        <td>  <? $previous_from =  $rs_student->previous_from;
                        $previous_to =  $rs_student->previous_to?>
                        <? $rs_year = listofyears(2001, date(Y)); ?>
                        <select  name="previous_from" id="previous_from" class="listbox" style="width:140px;">
                            <option value="">YYYY</option>
                            <? foreach($rs_year as $yk=>$yv){ ?>
                            <option <? if($previous_from==$yv){ ?>selected="selected"<? } ?>  value="<?=$yv?>"><?=$yv?></option>
                            <? } ?>
                        </select>
                        <strong>To</strong>
                        <? $rs_year = listofyears(2001,  date(Y)); ?>
                        <select  name="previous_to" id="previous_to" class="listbox" style="width:140px;">
                            <option value="">YYYY</option>
                            <? foreach($rs_year as $yk=>$yv){ ?>
                            <option <? if($previous_to==$yv){ ?>selected="selected"<? } ?>  value="<?=$yv?>"><?=$yv?></option>
                            <? } ?>
                        </select>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="right" colspan="2">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="submitStudent('D')"><strong>NEXT</strong></div>
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="showStudent('F')"><strong>BACK</strong></div>
                </div>
            </td>
        </tr>
    </table>

    <table width="98%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showDocumentDtls" style="display:none">
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <div id="DocumentLevelTop"></div>
                    <span class="spancursor" id="documentsLevel_a" style="cursor:pointer; padding-left:900px;" onclick="addDocument();">
                    <div class="pull_right txtbold f24 cursor">+</div>
                    </span> 
                </table>
            </td>
        </tr>
        <tr>
        	<td align="right" colspan="2">
                <div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="submitStudent('FS')"><strong>NEXT</strong></div>
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="showStudent('P')"><strong>BACK</strong></div>
                </div>
            </td>
        </tr>
    </table>
 
    <table width="98%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showFeesDtls" style="display:none">
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                    <tr>
                        <td>Registration Fees</td>
                        <td><input type="text" class="txtbox" name="registration_fee" id="registration_fee" value="<?=trim($rs_student->registration_fee)?>" onkeypress="return isNumberKey(event)"/></td>
                        <td>Term Fees</td>
                        <td><input type="text" class="txtbox" name="term_fees" id="term_fees" value="<?=trim($rs_student->term_fees)?>" onkeypress="return isNumberKey(event)"/></td>
                    </tr>
                    <tr>
                        <td>Material Fees</td>
                        <td><input type="text" class="txtbox" name="material_fee" id="material_fee" value="<?=trim($rs_student->material_fee)?>" onkeypress="return isNumberKey(event)"/></td>
                        <td>Food Fees</td>
                        <td><input type="text" class="txtbox" name="food_fee" id="food_fee" value="<?=$rs_student->food_fee?>" onkeypress="return isNumberKey(event)"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">Does Student want Transport Facility?
                        <input type="radio" name="is_transport" id="is_transport" value="Y" <? if($rs_student->is_transport=='Y'){ ?> checked="checked" <? }?>onclick="showChildNotes(this.value,'is_transport')"/>Yes
                        <input type="radio" name="is_transport" id="is_transport" value="N" <? if($rs_student->is_transport=='N'|| $rs_student->is_transport==""){ ?> checked="checked" <? }?>onclick="showChildNotes(this.value,'is_transport')" />No</td>
                    </tr>
                    <tr>&nbsp;</tr>
                
                    <tr>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl" id="showTransportDtls" style="display:<?=($rs_student->is_transport=='Y')?"":"none"?>;" >
                            <tr>
                                <td>Bus Route</td>
                                <td>
                                    <select class="listbox" name="bus_route_id" id="bus_route_id">
                                        <option value="">-- Select Bus Route -- </option>
                                    <?
                                    $busRouteObj = new Transportation();
                                    $busRouteObj->school_id = $schoolId;
                                    $rsBusRoute = $busRouteObj->getBusRouteDtls();
                                    if(count($rsBusRoute)>0){
                                        foreach($rsBusRoute as $K1=>$V1){
                                        ?>
                                        <option value="<?=$V1->id?>" <? if($rs_student->bus_route_id==$V1->id){?> selected="selected"<? } ?>><?=$V1->route_name?></option>
                                        <?
                                        }
                                    }
                                    ?>
                                    </select>
                                </td>
                                <td>Transport Fees</td>
                                <td><input type="text" class="txtbox" name="transportation_fees" id="transportation_fees" value="<?=$rs_student->transportation_fees?>" /></td>
                            </tr>
                            <tr>
                                <td>Bus Order From</td>
                                <td><input type="text" class="txtbox"  name="bus_order_from" id="bus_order_from" value="<?=$rs_student->bus_order_from?>" /></td>
                                <td>Bus Order To</td>
                                <td><input type="text" class="txtbox"  name="bus_order_to" id="bus_order_to" value="<?=$rs_student->bus_order_to?>" /></td>
                            </tr>
                        </table>
                    </tr>
                    
                    <tr>
                        <td colspan="2">Admission Date
                            <span style="padding-left:45px;">
                                <!-- <input type="text" name="admission_date" id="admission_date" class="txtbox datepicker" value="<?=$rs_student->admission_date?>"/>-->
                                <? $admission_dateArr = explode("-", $rs_student->admission_date); ?>
                                <select  name="date_of_admission" id="date_of_admission" class="listbox" style="width:50px;">
                                    <option value="">DD</option>
                                    <? for($i=1;$i<32;$i++){ ?>
                                    <option <? if($admission_dateArr[2]==$i){ ?>selected="selected"<? } ?>  value="<?=$i?>"><?=$i?></option>
                                    <? } ?>
                                </select>
                                
                                <? $rs_month = currentYearMonth(); ?>
                                <select  name="admission_month" id="admission_month" class="listbox" style="width:100px;">
                                    <option value="">MM</option>
                                    <? foreach($rs_month as $mk=>$mv){ ?>
                                    <option <? if($admission_dateArr[1]==$mk){ ?>selected="selected"<? } ?>  value="<?=$mk?>"><?=$mv?></option>
                                    <? } ?>
                                </select>
                                
                                <? $rs_year = listofyears(2001,  date(Y)); ?>
                                <select  name="admission_year" id="admission_year" class="listbox" style="width:70px;">
                                    <option value="">YYYY</option>
                                    <? foreach($rs_year as $yk=>$yv){ ?>
                                    <option <? if($admission_dateArr[0]==$yv){ ?>selected="selected"<? } ?>  value="<?=$yv?>"><?=$yv?></option>
                                    <? } ?>
                                </select>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td align="right" colspan="2">
                        	<div class="fullsize txtwhite txtcenter f18">
                                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="saveImg" onclick="submitStudent('Finish')"><strong>SAVE</strong></div>
                                <img src="images/loader.gif" alt="Proccessing.." title="Processing.." align="absmiddle" id="processingImg" style="display:none;" />
                                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="submitStudent('D')"><strong>BACK</strong></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    
    </table>
</div>

<input type="hidden" id="languagecount" name="languagecount" value="" />
<input type="hidden" id="sibilingcount" name="sibilingcount" value="" />
<input type="hidden" id="documentcount" name="documentcount" value="" />
</form>
</div>	 

<script type="text/javascript">

$(function() {
	$(".datepicker").datepicker({
 	});  
	getGrade('<?=$schoolId?>','<?=$rs_student->id?>');
});

function fillAddress(){
	var permanentAddress = $('#permanentAddress').val();
	if($('input[name=permanentAddress]:checked').val()){
		var current_address =$('#current_address').val();
		var current_state =$('#current_state').val()
		var current_city =$('#current_city').val()
		var current_zipcode =$('#current_zipcode').val()
		
		$('#permanent_address').val(current_address);
		$('#permanent_state').val(current_state);
		$('#permanent_city').val(current_city);
		$('#permanent_zipcode').val(current_zipcode);
	}else{
		$('#permanent_address').val('');
		$('#permanent_state').val('');
		$('#permanent_city').val('');
		$('#permanent_zipcode').val('');
	}
	
}

function showChildNotes(val,fieldname){
  	if(val=='Y' && fieldname=="child_gifted"){
		$('#showChildGiftNotes').show();
	}else if(val=='N' && fieldname=="child_gifted"){
		$('#showChildGiftNotes').hide();
	}
	if(val=='Y' && fieldname=="child_difficult"){
		$('#showDifficult').show();
	}else if(val=='N' && fieldname=="child_difficult"){
		$('#showDifficult').hide();
	}
	if(val=='Y' && fieldname=="health_issue"){
		$('#showHealthHistory').show();
	}else if(val=='N' && fieldname=="health_issue"){
		$('#showHealthHistory').hide();
	} 
	if(val=='Y' && fieldname=="sports_inclination"){
		$('#showSportsDtls').show();
	}else if(val=='N' && fieldname=="sports_inclination"){
		$('#showSportsDtls').hide();
	}
	if(val=='Y' && fieldname=="is_pet"){
 		$('#showPetName').show();
	}else if(val=='N' && fieldname=="is_pet"){
		$('#showPetName').hide();
	}
	if(val=='Y' && fieldname=="is_transport"){
 		$('#showTransportDtls').show();
	}else if(val=='N' && fieldname=="is_transport"){
		$('#showTransportDtls').hide();
		$('#bus_route_id').val('');
		$('#transportation_fees').val('');
		$('#bus_order_from').val('');
		$('#bus_order_to').val('');
	}
}

function showParent(val){
	if(val=='P'){
		$('#showParentDtls').show();
		$('#showGuardianDtls').hide();
 	}
	if(val=='G'){
		$('#showParentDtls').hide();
		$('#showGuardianDtls').show();
 	}
}

function showGradeFee(grade_id){
	
	ajax({
		a:'add_student',
		b:'act=loadGradeFee&grade_id='+grade_id,		
		c:function(){},
		d:function(data){
			var fees_value = data.split('-');
			$('#registration_fee').val($.trim(fees_value[0]));
			$('#term_fees').val($.trim(fees_value[1]));
			$('#material_fee').val($.trim(fees_value[2]));
			$('#food_fee').val($.trim(fees_value[3]));
		}			
	});
 	
}

function defaultLoader(){
	
	// Language Starts Here..
	jQuery('#LanguageLevelTop').empty().html('');
	var vhtm = new Array();
	var i = 0;
	<? 	
 	if((!empty($languages_known)) &&(count($languages_known['language_name'])>0)){
		for($i=0; $i<count($languages_known['language_name']); $i++){
		?>
			//alert('<?=$languages_known['languages_types'][$i]?>');
			addLanguage({language_name:'<?=$languages_known['language_name'][$i]?>', languages_types:'<?=$languages_known['languages_types'][$i];?>'});
	<?  } 
	} 
	else { ?> 
		addLanguage();
	<? } ?>
	
	// Sibling Starts Here..
	jQuery('#SibilingLevelTop').empty().html('');
	var vhtm = new Array();
	var i = 0;
	<? 
		$index = 0;
	if((!empty($siblings_of_student)) &&(count($siblings_of_student['sibiling_name'])>0)) {
 		foreach($siblings_of_student['sibiling_name'] as $M=>$N) {
	?>
			addSibiling({sibiling_name:'<?=$siblings_of_student['sibiling_name'][$index]?>' , sibiling_gender:'<?=$siblings_of_student['sibiling_gender'][$index]?>' , sibiling_class:'<?=$siblings_of_student['sibiling_class'][$index]?>' , sibiling_age:'<?=$siblings_of_student['sibiling_age'][$index]?>', sibiling_name_of_org:'<?=$siblings_of_student['sibiling_name_of_org'][$index]?>'});
	<? $index++;  
		} 
	} 
	else { ?>
   		addSibiling();
	<? } ?>
	
	// Documents Starts Here..
	jQuery('#DocumentLevelTop').empty().html('');
	var vhtm = new Array();
	var i = 0;
	<? 
		$index = 0;
	if((!empty($document_of_student)) &&(count($document_of_student)>0)) {
 		foreach($document_of_student as $M=>$N) {
	?>
 			addDocument({document_name:'<?=$document_of_student[$index]['document_name']?>' , filetitle:'<?=$document_of_student[$index]['filetitle']?>'});
	<? 
	$index++;  
		} 
	} else { ?>
   		addDocument();
	<? }?>
	
}

function addLanguage(a){
 	if(a==undefined) a={};
	if(a.id==undefined) a.id='';
	if(a.language_name==undefined) a.language_name='';
	if(a.languages_types==undefined) a.languages_types='';
	if(a.Value==undefined) a.Value='';
 
 	var new_languages_types=a.languages_types.split(',');	 
	
	var row = jQuery('div.Languageclvltop').length;
	
	var vhtml = '';
	vhtml += '<div id="spLanguageLevel_'+row+'" class="Languageclvltop" style="margin-top:0px; text-align:left; ">';
	vhtml += '	<div style="padding-top:0px; padding-bottom:10px;" id="spLanguageLevel_'+row+'" class="dimage" >';
	vhtml += '		<div>';
	vhtml += '			<td><input type="text" class="txtbox" name="LanguagesArr[language_name]['+row+']" id="language_name'+row+'" value="'+a.language_name+'" />'; 
	vhtml += '			<input type="checkbox" name="LanguagesArr[languages_types]['+row+'][]" id="languages_types'+row+'" value="R" '+(new_languages_types[0]=='R' || new_languages_types[1]=='R' || new_languages_types[2]=='R'?'checked':'')+' />Read ';
	vhtml += '			<input type="checkbox" name="LanguagesArr[languages_types]['+row+'][]" id="languages_types'+row+'" value="W" '+(new_languages_types[0]=='W' || new_languages_types[1]=='W' || new_languages_types[2]=='W'?'checked':'')+' />Write ';
	vhtml += '			<input type="checkbox" name="LanguagesArr[languages_types]['+row+'][]" id="languages_types'+row+'" value="S" '+(new_languages_types[0]=='S' || new_languages_types[1]=='S' || new_languages_types[2]=='S'?'checked':'')+' />Speak ';   
	vhtml += '          </td>';
	vhtml += '		</div>';
	if(row!=0)
		vhtml +='<tr><td colspan="2"><span class="spancursor" id="languagesLevel_r" style="display: block; text-align:right; cursor:pointer;" onclick="removeLanguageTopLevel('+row+');"><div class="txtbold f24 cursor">-</div></span></td></tr>';	
	vhtml += '	</div>';
	vhtml += '</div>';
 	
	jQuery('#LanguageLevelTop').append(vhtml);
	
 	$('#languagecount').val(jQuery('div.Languageclvltop').length);
	
}

function removeLanguageTopLevel(r){
	var i1;
	if(r==undefined){
		var row = jQuery('div.Languageclvltop').length-1;
		jQuery('#spLanguageLevel_'+row).remove();
	}
	else
	{
		jQuery('#spLanguageLevel_'+r).remove();
		if(jQuery('div.dimage').length==0){
			for(i1=0;i1<100;i1++){
				if(jQuery('Languageclvltop').length>0)
					jQuery('#spLanguageLevel_'+i1).remove();
				else
					i1 = 101;
			}
			addLanguage();
		}
	}
	if(jQuery('div.Languageclvltop').length==0)
		addLanguage();
}

/* Languages Known Ends*/

function addSibiling(a){
	
	if(a==undefined) a={};
	if(a.id==undefined) a.id='';
	if(a.sibiling_name==undefined) a.sibiling_name='';
	if(a.sibiling_gender==undefined) a.sibiling_gender='';
	if(a.sibiling_age==undefined) a.sibiling_age='';
	if(a.sibiling_class==undefined) a.sibiling_class='';
	if(a.sibiling_name_of_org==undefined) a.sibiling_name_of_org='';
	if(a.Value==undefined) a.Value='';
	
	var row = jQuery('div.Sibilingclvltop').length;
	
	var vhtml = '';
	vhtml += '<div id="spSibilingLevel_'+row+'" class="Sibilingclvltop" style="margin-top:0px; text-align:left; ">';
	vhtml += '	<div style="padding-top:0px; padding-bottom:10px;" id="spSibilingLevel_'+row+'" class="dimage" >';
	vhtml += '		<div>';
	vhtml += '		<table width="100%" border="0" cellpadding="0" cellspacing="0">';
	vhtml += '		<tr>';
	vhtml += '			<td><input type="text" class="txtbox" name="SibilingsArr[sibiling_name]['+row+']" id="sibiling_name'+row+'" value="'+a.sibiling_name+'" style="width:225px;" placeholder="Name"/></td>';   
	vhtml += '		    <td><select class="listbox" id="sibiling_gender'+row+'" name="SibilingsArr[sibiling_gender]['+row+']" style="width:100px;"><option value="">-Gender-</option><option '+(a.sibiling_gender=='M'?'selected':'')+' value="M">Male</option><option '+(a.sibiling_gender=='F'?'selected':'')+' value="F">Female</option></select>';
	vhtml += '		    <td><input type="text" class="txtbox" name="SibilingsArr[sibiling_age]['+row+']" id="sibiling_age'+row+'" value="'+a.sibiling_age+'" style="width:100px;" placeholder="Age" onkeypress="return isNumberKey(event)"/></td>';
	vhtml += '		    <td><input type="text" class="txtbox" name="SibilingsArr[sibiling_class]['+row+']" id="sibiling_class'+row+'" value="'+a.sibiling_class+'" style="width:100px;" placeholder="Class"/></td>';
	vhtml += '			<td><input type="text" class="txtbox" name="SibilingsArr[sibiling_name_of_org]['+row+']" id="sibiling_name_of_org'+row+'" value="'+a.sibiling_name_of_org+'" style="width:220px;" placeholder="Name of school/college"/></td>';
	vhtml += '		</div>';
	if(row!=0)
		vhtml +='<tr><td colspan="5" align="right"><span class="plusicon_image" id="spLevel_r" style="display: block; cursor:pointer; float:right;" onclick="removeSibilingTopLevel('+row+');"><div class="txtbold f24 cursor">-</div></span></td></tr>';	
	vhtml += '	</div>';
	vhtml += '</div>';
 	
	jQuery('#SibilingLevelTop').append(vhtml);
	
	$('#sibilingcount').val(jQuery('div.Sibilingclvltop').length);
	
}

function removeSibilingTopLevel(r){
	var i1;
	if(r==undefined){
		var row = jQuery('div.Sibilingclvltop').length-1;
		jQuery('#spSibilingLevel_'+row).remove();
	}
	else
	{
		jQuery('#spSibilingLevel_'+r).remove();
		if(jQuery('div.dimage').length==0){
			for(i1=0;i1<100;i1++){
				if(jQuery('Sibilingclvltop').length>0)
					jQuery('#spSibilingLevel_'+i1).remove();
				else
					i1 = 101;
			}
			addSibiling();
		}
	}
	if(jQuery('div.Sibilingclvltop').length==0)
		addSibiling();
}

function addDocument(a){
	
	if(a==undefined) a={};
	if(a.id==undefined) a.id='';
	if(a.document_name==undefined) a.document_name='';
	if(a.file_name==undefined) a.file_name='';
	if(a.filetitle==undefined) a.filetitle='';

	if(a.Value==undefined) a.Value='';
	var row = jQuery('div.Documentclvltop').length;
	
	var vhtml = '';
	vhtml += '<div id="spDocumentLevel_'+row+'" class="Documentclvltop" style="margin-top:0px; text-align:left; ">';
	vhtml += '	<div style="padding-top:0px; padding-bottom:10px;" id="spDocumentLevel_'+row+'" class="dimage" >';
	vhtml += '		<div>';
	vhtml += '			<td>Document Name</td>';
	vhtml += '			<td><input type="text" class="txtbox" name="DocumentsArr[document_name]['+row+']" id="document_name'+row+'" value="'+a.document_name+'" style="width:150px"/></td>';   
	vhtml += '			<td>Upload Document</td>';
	vhtml += '			<td><input type="file" name="file_name_'+row+'" id="file_name'+row+'" value="'+a.file_name+'" style="width:190px"/> <input type="hidden" name="h_file_name_'+row+'" id="h_file_name'+row+'" value="'+a.filetitle+'" style="width:190px"/></td>';
	vhtml += '			<td><input type="hidden" class="txtbox" name="filetitle['+row+']" id="filetitle'+row+'" value="'+a.filetitle+'" style="width:190px"/></td>';
	vhtml += '			<td>'+a.filetitle+'</td>';
 	vhtml += '		</div>';
 	if(row!=0)
		vhtml +='<tr><td colspan="2"><span class="spancursor" id="documentsLevel_r" style="display: block; text-align:right; cursor:pointer;" onclick="removeDocumentTopLevel('+row+');"><div class="txtbold f24 cursor">-</div></span></td></tr>';	
	vhtml += '	</div>';
	vhtml += '</div>';
 	
	jQuery('#DocumentLevelTop').append(vhtml);
	
	$('#documentcount').val(jQuery('div.Documentclvltop').length);	
	
}
 
 
/* Documents Known */
function removeDocumentTopLevel(r){
	var i1;
	if(r==undefined){
		var row = jQuery('div.Documentclvltop').length-1;
		jQuery('#spDocumentLevel_'+row).remove();
	}
	else
	{
		jQuery('#spDocumentLevel_'+r).remove();
		if(jQuery('div.dimage').length==0){
			for(i1=0;i1<100;i1++){
				if(jQuery('Documentclvltop').length>0)
					jQuery('#spDocumentLevel_'+i1).remove();
				else
					i1 = 101;
			}
			addDocument();
		}
	}
	if(jQuery('div.Documentclvltop').length==0)
		addDocument();
}


jQuery(function(){
	/* Languages Known */
	jQuery('#languagesLevel_r').show();
	jQuery('#languagesLevel_a').show();

	/* Sibilings Known */ 
	jQuery('#sibilingsLevel_r').show();
	jQuery('#sibilingsLevel_a').show();

	/* Documents Known */
	jQuery('#documentsLevel_r').show();
	jQuery('#documentsLevel_a').show();
	
	defaultLoader();
	
})

function getGrade(school_id, student_id) { //alert(school_id); alert(student_id);
  	 
	ajax({
		a:'add_student',
		b:'act=getGradeList&school_id='+school_id+'&student_id='+student_id,		
		c:function(){},
		d:function(data){ //alert(data);
 			$('#showGradeAdmission').html(data); 
		}			
	});
 	
}

function submitStudent(action){ 
 
 	var bd_err=0, sd_err=0, fd_err=0, psd_err=0, d_err=0, fs_err=0;
	
	if(action=="S") {
	// Basic Details Validation
	if($('#school_id').val()==''){ bd_err=1; $('#schoolnamerr').addClass('txterror'); } else { $('#schoolnamerr').removeClass('txterror'); }
	if($('#first_name').val()==''){ bd_err=1; $('#first_name').addClass('boxerror'); } else { $('#first_name').removeClass('boxerror'); }
	//if($('#middle_name').val()==''){ bd_err=1; $('#middle_name').addClass('boxerror'); } else { $('#middle_name').removeClass('boxerror'); }
	//if($('#last_name').val()==''){ bd_err=1; $('#last_name').addClass('boxerror'); } else { $('#last_name').removeClass('boxerror'); }
	if($.trim($('input[name=gender]:checked').val())==''){ bd_err=1;  $('#showGenderErr').addClass('txterror'); } else{ $('#showGenderErr').removeClass('txterror'); }
	if($('#date_of_birth').val()==''){ bd_err=1; $('#date_of_birth').addClass('boxerror'); } else { $('#date_of_birth').removeClass('boxerror'); }
	if($('#dob_month').val()==''){ bd_err=1; $('#dob_month').addClass('boxerror'); } else { $('#dob_month').removeClass('boxerror'); }
	if($('#dob_year').val()==''){ bd_err=1; $('#dob_year').addClass('boxerror'); } else { $('#dob_year').removeClass('boxerror'); }
	/*if($('#blood_group').val()==''){ bd_err=1; $('#blood_group').addClass('boxerror'); } else { $('#blood_group').removeClass('boxerror'); }
	if($('#age').val()==''){ bd_err=1; $('#age').addClass('boxerror'); } else { $('#age').removeClass('boxerror'); }
	if($('#nationality').val()==''){ bd_err=1; $('#nationality').addClass('boxerror'); } else { $('#nationality').removeClass('boxerror'); }
	if($('#mother_tongue').val()==''){ bd_err=1; $('#mother_tongue').addClass('boxerror'); } else { $('#mother_tongue').removeClass('boxerror'); }
	if($('#current_address').val()==''){ bd_err=1; $('#current_address').addClass('boxerror'); } else { $('#current_address').removeClass('boxerror'); }
	if($('#current_state').val()==''){ bd_err=1; $('#current_state').addClass('boxerror'); } else { $('#current_state').removeClass('boxerror'); }
	if($('#current_city').val()==''){ bd_err=1; $('#current_city').addClass('boxerror'); } else { $('#current_city').removeClass('boxerror'); }
	if($('#email_address').val()=='')
	{
	bd_err=1;
	$('#email_address').addClass('boxerror');
	}
	else
	{	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#email_address').val()) == false) 
		{
			bd_err=1;
			$('#email_address').addClass('boxerror');
		}
		else{
			$('#email_address').removeClass('boxerror');
		}
	}
	if($('#current_zipcode').val()==''){ bd_err=1; $('#current_zipcode').addClass('boxerror'); } else { $('#current_zipcode').removeClass('boxerror'); }
	if($('#phone').val()==''){ bd_err=1; $('#phone').addClass('boxerror'); } else { $('#phone').removeClass('boxerror'); }
	if($('#mobile').val()==''){ bd_err=1; $('#mobile').addClass('boxerror'); } else { $('#mobile').removeClass('boxerror'); }
	if($('#emergency_contact_number').val()==''){ bd_err=1; $('#emergency_contact_number').addClass('boxerror'); } else { $('#emergency_contact_number').removeClass('boxerror'); }
	if($('#permanent_address').val()==''){ bd_err=1; $('#permanent_address').addClass('boxerror'); } else { $('#permanent_address').removeClass('boxerror'); }
	if($('#permanent_state').val()==''){ bd_err=1; $('#permanent_state').addClass('boxerror'); } else { $('#permanent_state').removeClass('boxerror'); }
	if($('#permanent_city').val()==''){ bd_err=1; $('#permanent_city').addClass('boxerror'); } else { $('#permanent_city').removeClass('boxerror'); }
	if($('#permanent_zipcode').val()==''){ bd_err=1; $('#permanent_zipcode').addClass('boxerror'); } else { $('#permanent_zipcode').removeClass('boxerror'); }*/
	
		if(bd_err==0) { 
			sd_err = 1; 
			showStudent(action); 
		}
	}
	
	else  if(action=="F") {
	// Student Details Validation
	/*if($('#current_studying').val()==''){ sd_err=1; $('#current_studying').addClass('boxerror'); } else { $('#current_studying').removeClass('boxerror'); }*/
	if($('#grade_id').val()==''){ sd_err=1; $('#grade_id').addClass('boxerror'); } else { $('#grade_id').removeClass('boxerror'); }
	
		if(sd_err==0) { 
			fd_err=1; 
			showStudent(action); 
		}
	}
	
	else  if(action=="P") {
	// Family Details Validation
	/*if($.trim($('input[name=is_parent]:checked').val())=='P'){ 
		if($('#father_name').val()==''){ fd_err=1; $('#father_name').addClass('boxerror'); } else { $('#father_name').removeClass('boxerror'); }
		if($('#father_qualification').val()==''){ fd_err=1; $('#father_qualification').addClass('boxerror'); } else { $('#father_qualification').removeClass('boxerror'); }
		if($.trim($('input[name=father_employment]:checked').val())==''){ fd_err=1; $('#showFatherErr').addClass('txterror'); } else { $('#showFatherErr').removeClass('txterror'); }
		//if($('#father_nature_of_job').val()==''){ fd_err=1; $('#father_nature_of_job').addClass('boxerror'); } else { $('#father_nature_of_job').removeClass('boxerror'); }
		//if($('#father_annual_income').val()==''){ fd_err=1; $('#father_annual_income').addClass('boxerror'); } else { $('#father_annual_income').removeClass('boxerror'); }
		if($('#mother_name').val()==''){ fd_err=1; $('#mother_name').addClass('boxerror'); } else { $('#mother_name').removeClass('boxerror'); }
		if($('#mother_qualification').val()==''){ fd_err=1; $('#mother_qualification').addClass('boxerror'); } else { $('#mother_qualification').removeClass('boxerror'); }
		if($.trim($('input[name=mother_employment]:checked').val())==''){ fd_err=1; $('#showMotherErr').addClass('txterror'); } else { $('#showMotherErr').removeClass('txterror'); }
		//if($('#mother_nature_of_job').val()==''){ fd_err=1; $('#mother_nature_of_job').addClass('boxerror'); } else { $('#mother_nature_of_job').removeClass('boxerror'); }
		//if($('#mother_annual_income').val()==''){ fd_err=1; $('#mother_annual_income').addClass('boxerror'); } else { $('#mother_annual_income').removeClass('boxerror'); }
	}else if($.trim($('input[name=is_parent]:checked').val())=='G'){
		if($('#guardian_name').val()==''){ fd_err=1; $('#guardian_name').addClass('boxerror'); } else { $('#guardian_name').removeClass('boxerror'); }
		if($('#guardian_qualification').val()==''){ fd_err=1; $('#guardian_qualification').addClass('boxerror'); } else { $('#guardian_qualification').removeClass('boxerror'); }
		if($.trim($('input[name=guardian_employment]:checked').val())==''){ fd_err=1; $('#showGuardianErr').addClass('txterror'); } else { $('#showGuardianErr').removeClass('txterror'); }
		if($('#guardian_nature_of_job').val()==''){ fd_err=1; $('#guardian_nature_of_job').addClass('boxerror'); } else { $('#guardian_nature_of_job').removeClass('boxerror'); }
		if($('#guardian_annual_income').val()==''){ fd_err=1; $('#guardian_annual_income').addClass('boxerror'); } else { $('#guardian_annual_income').removeClass('boxerror'); }
	}
	*/	//if(fd_err==0) { 
			psd_err=1; 
			showStudent(action); 
		//}
	}
	
	else  if(action=="D") {
	// Previous School Details Validation
/*	if($('#previous_school_name').val()==''){ psd_err=1; $('#previous_school_name').addClass('boxerror'); } else { $('#previous_school_name').removeClass('boxerror'); }
	if($('#previous_school_place').val()==''){ psd_err=1; $('#previous_school_place').addClass('boxerror'); } else { $('#previous_school_place').removeClass('boxerror'); }
	if($('#previous_grades_attended').val()==''){ psd_err=1; $('#previous_grades_attended').addClass('boxerror'); } else { $('#previous_grades_attended').removeClass('boxerror'); }
	if($('#previous_school_board').val()==''){ psd_err=1; $('#previous_school_board').addClass('boxerror'); } else { $('#previous_school_board').removeClass('boxerror'); }
	if($('#previous_from').val()==''){ psd_err=1; $('#previous_from').addClass('boxerror'); } else { $('#previous_from').removeClass('boxerror'); }
	if($('#previous_to').val()==''){ psd_err=1; $('#previous_to').addClass('boxerror'); } else { $('#previous_to').removeClass('boxerror'); }
*/	
		//if(psd_err==0) { 
			d_err=1; 
			showStudent(action); 
			
		//}
	}
	
	else  if(action=="FS") {
		
		/*var rowcount = $('#documentcount').val();
		 
		for(m=0; m<rowcount;m++){
			var fileName = $('#file_name'+m).val();
 			 
			var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
			if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "doc" || ext == "docx" || ext == "pdf" || ext == "txt")
			{
			$('#file_name'+m).removeClass('boxerror');
			//return true;
			} 
			/*else
			{  
			 d_err=1; 
			 alert("File Format is not Valid..!");
			 $('#file_name'+m).addClass('boxerror');
			//return false;
			}*/
		//}
		
		
		/* 
		var rowcount = $('#documentcount').val();
		var type = ["jpg","png", "gif", "jpeg", "docx", "doc","txt","pdf"];
		var m;///++ row count
		var n;////type array length
		for(m=0; m<rowcount;m++){
			if($('#document_name'+m).val()==''){ d_err=1; $('#document_name'+m).addClass('boxerror'); } else { $('#document_name'+m).removeClass('boxerror'); }
			var filename = $('#file_name'+m).val();
			//alert(filename);
			var split_filetype = filename.split('.');
			var filetype = split_filetype[1];
			
			for (n=0; n<=(type.length); n++){
					if(type[n]!=filetype){ d_err=1; alert("File Format is not Valid..!"); $('#file_name'+m).addClass('boxerror');}
					else if(($('#file_name'+m).val()!='') && (type[n]==filetype)) { $('#file_name'+m).removeClass('boxerror'); }
					break;
			}
		}
		*/
		//if(d_err==0) { 
				fs_err=1; 
				showStudent(action); 
		//}
 	}
	
	else  {
	// Fees Setup Details Validation
	/*if($('#registration_fee').val()=='0'){ fs_err=1; $('#registration_fee').addClass('boxerror'); } else { $('#registration_fee').removeClass('boxerror'); }
	if($('#term_fees').val()=='0'){ fs_err=1; $('#term_fees').addClass('boxerror'); } else { $('#term_fees').removeClass('boxerror'); }
	if($('#material_fee').val()=='0'){ fs_err=1; $('#material_fee').addClass('boxerror'); } else { $('#material_fee').removeClass('boxerror'); }
	if($('#food_fee').val()=='0'){ fs_err=1; $('#food_fee').addClass('boxerror'); } else { $('#food_fee').removeClass('boxerror'); }
	
	if($.trim($('input[name=is_transport]:checked').val())==''){ fs_err=1; $('#showTransportErr').addClass('txterror'); } else { $('#showTransportErr').removeClass('txterror'); }
	if($.trim($('input[name=is_transport]:checked').val())=='Y'){ 
		if($('#bus_route_id').val()==''){ fs_err=1; $('#bus_route_id').addClass('boxerror'); } else { $('#bus_route_id').removeClass('boxerror'); }
		if($('#transportation_fees').val()==''){ fs_err=1; $('#transportation_fees').addClass('boxerror'); } else { $('#transportation_fees').removeClass('boxerror'); }
		if($('#bus_order_from').val()==''){ fs_err=1; $('#bus_order_from').addClass('boxerror'); } else { $('#bus_order_from').removeClass('boxerror'); }
		if($('#bus_order_to').val()==''){ fs_err=1; $('#bus_order_to').addClass('boxerror'); } else { $('#bus_order_to').removeClass('boxerror'); }
	} */
		bd_err=0; sd_err=0; fd_err=0; psd_err=0; d_err=0; fs_err=0;
	}
	if(bd_err==0 && sd_err==0 && fd_err==0 && psd_err==0 && d_err==0 && fs_err==0) {
		$('#saveImg').hide();
		$('#processingImg').show();
		document.studentFrm.submit();
		//window.location.href = "students.php";
	}
	
}


</script>