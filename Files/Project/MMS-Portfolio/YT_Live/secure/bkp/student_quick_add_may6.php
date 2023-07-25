<?
include "includes.php";	

$languages_known=array(); $siblings_of_student=array(); $document_of_student=array();
if($studentId!='' && $studentId!="undefined"){
	$rs_student = Student::getStudentById($studentId); 
	$languages_known = unserialize($rs_student->languages_known);
	$siblings_of_student = unserialize($rs_student->siblings_of_student);
	$document_of_student = unserialize($rs_student->document_type);
}
//echo "<pre>"; print_r($languages_known); echo "</pre>";
?>

<style>
.boxerror{border:1px solid #F00;}
.txterror{color:#F00}
</style>

<? if($studentFrmPage=="") { ?>
<div class="fullsize">

<div class="pull_right">
    <div class="grade_tab active" id="grade_tabB" style="border-right:0;" onclick="showStudentList('<?=$schoolId?>');">Student List</div>
</div>
<? } ?>


<form name="studentQuickFrm" id="studentQuickFrm" method="post" enctype="multipart/form-data">
<input type="hidden" id="act" name="act" value="saveStudentQuickFrm"/>
<input type="hidden" id="student_db_id" name="student_db_id" value="<?=$studentId?>" /> 
<input type="hidden" id="school_id" name="school_id" value="<?=$schoolId?>" />
 
<div class="border_theme <? if($studentFrmPage=="") { ?>fullsize pad10<? } ?>">
    <table width="98%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showBasicDtls">
        
        <tr>
        	<td colspan="2" width="100%">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td width="28%">Grade to which admission is sought</td>
                    <td width="23%" style="padding-left:10px;">
                        <select class="listbox" name="grade_id" id="grade_id" style="width:80%;">
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
                    
                    <td width="49%">Admission Date
                        <span style="padding-left:45px;">
                            <!-- <input type="text" name="admission_date" id="admission_date" class="txtbox datepicker" value="<?=$rs_student->admission_date?>"/>-->
                            <? $admission_dateArr = explode("-", $rs_student->admission_date); ?>
                            <select  name="date_of_admission" id="date_of_admission" class="listbox" style="width:15%;">
                                <option value="">DD</option>
                                <? for($i=1;$i<32;$i++){ ?>
                                <option <? if($admission_dateArr[2]==$i || (date('d')==$i && $rs_student->id==NULL)){ ?>selected="selected"<? } ?>  value="<?=$i?>"><?=$i?></option>
                                <? } ?>
                            </select>
                            
                            <? $rs_month = currentYearMonth(); ?>
                            <select  name="admission_month" id="admission_month" class="listbox" style="width:20%;">
                                <option value="">MM</option>
                                <? foreach($rs_month as $mk=>$mv){ ?>
                                <option <? if($admission_dateArr[1]==$mk || (date('m')==$mk && $rs_student->id==NULL)){ ?>selected="selected"<? } ?>  value="<?=$mk?>"><?=$mv?></option>
                                <? } ?>
                            </select>
                            
                            <? $rs_year = listofyears(2001,  date("Y")); ?>
                            <select  name="admission_year" id="admission_year" class="listbox" style="width:15%;">
                                <option value="">YYYY</option>
                                <? foreach($rs_year as $yk=>$yv){ ?>
                                <option <? if($admission_dateArr[0]==$yv || (date('Y')==$yv && $rs_student->id==NULL)){ ?>selected="selected"<? } ?>  value="<?=$yv?>"><?=$yv?></option>
                                <? } ?>
                            </select>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Roll No</td>
                    <td style="padding-left:10px;" colspan="2">
                        <input type="text" name="roll_no" id="roll_no" class="txtbox" value="<?=$rs_student->roll_no?>" />
                    </td>
                </tr>
              	</table>
            </td>
        </tr>
        
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
                        <td><input type="text" class="txtbox"  name="emer_name" id="emer_name" value="<?=$rs_student->emergency_contact_name?>" /></td>
                    </tr>
                    <tr>
                        <td>Emergency Contact Email</td>
                        <td><input type="text" class="txtbox" name="email_address" id="email_address" value="<?=$rs_student->email_address?>" /></td>
                    </tr>
                    <tr>
                        <td>Emergency Contact Mobile</td>
                        <td><input type="text" class="txtbox"  name="emer_number" id="emer_number" value="<?=($rs_student->emergency_contact_number=="")?$rs_student->mobile:$rs_student->emergency_contact_number?>" onkeypress="return isNumberKey(event)" /></td>
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
            <td colspan="2"><span class="form_head">Permanent Address</span> <input type="checkbox" id="permanentAddress"  name="permanentAddress"  onclick="fillAddress()"/> Same as Current Address</td>
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
            <td><span class="form_head">Family Details</span></td>
            <td colspan="2"><span class="form_head"></span></td>
        </tr>
        
        <tr>
            <td><div style="float:left;">Is Parent/Guardian?</div>
            <div style="margin-left:50px; float:left;">
                <input type="radio" name="is_parent" id="is_parent" value="P" <? if($rs_student->is_parent=='P') echo "checked" ?> onclick="showParent(this.value)" checked="checked"/>Parent
                <input type="radio" name="is_parent" id="is_parent" value="G" <? if($rs_student->is_parent=='G') echo "checked"?> onclick="showParent(this.value)" />Guardian
            </div>
            </td>
        </tr>
        
        <tr id="showParentDtls" style="display:none;">
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
        	<td id="isnewstderr">Is this New student or Old student?</td>
            <td>
            	<input type="radio" name="is_new_student" id="is_new_student1" value="N" <?=($rs_student->is_new_student=="N")?"checked":""?> /> Old Student
                <input type="radio" name="is_new_student" id="is_new_student2" value="Y" <?=($rs_student->is_new_student=="Y")?"checked":""?> /> New Student
            </td>
        </tr>
        
        <tr>
            <td align="right" colspan="2">
                <div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="saveImg" onclick="submitStudent(event)"><strong>SAVE</strong></div>
                    <img src="images/loader.gif" alt="Processing.." title="Processing.." align="absmiddle" id="processingImg" style="display:none;" />
                </div>
            </td>
        </tr>
        
    </table>
       
    
</div>

</form>
</div>	 

<script type="text/javascript">

$(function() {
	$(".datepicker").datepicker({
 	});  
	showParent();
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

function showParent(){
	
	var val = $('input[name=is_parent]:checked').val();
	if(val=='P'){
		$('#showParentDtls').show();
		$('#showGuardianDtls').hide();
 	}
	if(val=='G'){
		$('#showParentDtls').hide();
		$('#showGuardianDtls').show();
 	}
}

function submitStudent(e){ 
 
 	var bd_err=0;
	e.preventDefault();
	
	if($('#grade_id').val()==''){ bd_err=1; $('#grade_id').addClass('boxerror'); } else { $('#grade_id').removeClass('boxerror'); }
	if($('#first_name').val()==''){ bd_err=1; $('#first_name').addClass('boxerror'); } else { $('#first_name').removeClass('boxerror'); }
	if($('input[name=gender]:checked').val()=='' || $('input[name=gender]:checked').val()==undefined){ bd_err=1;  $('#showGenderErr').addClass('txterror'); } else{ $('#showGenderErr').removeClass('txterror'); }
	if($('#date_of_birth').val()==''){ bd_err=1; $('#date_of_birth').addClass('boxerror'); } else { $('#date_of_birth').removeClass('boxerror'); }
	if($('#dob_month').val()==''){ bd_err=1; $('#dob_month').addClass('boxerror'); } else { $('#dob_month').removeClass('boxerror'); }
	if($('#dob_year').val()==''){ bd_err=1; $('#dob_year').addClass('boxerror'); } else { $('#dob_year').removeClass('boxerror'); }
	if($('input[name=is_new_student]:checked').val()=='' || $('input[name=is_new_student]:checked').val()==undefined){ bd_err=1; $('#isnewstderr').addClass('txterror'); } else { $('#isnewstderr').removeClass('txterror'); }
	var myFrm = document.getElementById('studentQuickFrm');
	
	if(bd_err==0) {
		//document.studentQuickFrm.submit();
		$('#saveImg').hide();
		$('#processingImg').show();
		$.ajax({
			url: 'students.php',
			type: 'POST',
			data: new FormData(myFrm),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#saveImg').show();
				$('#processingImg').hide();
				alert('Saved Successfully..!');
				<? if($studentFrmPage=="Grade") { ?>
					closePopup();
					showGradeStudents('S', '<?=$rs_student->grade_id?>')
				<? } else { ?>
					showStudentList('<?=$schoolId?>');
				<? } ?>
			}
		});
		
	}
	
}


</script>