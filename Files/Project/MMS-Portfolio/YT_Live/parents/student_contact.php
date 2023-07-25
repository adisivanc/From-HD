<? 
if($_POST['act']=="saveContact_old") {
	
	ob_clean();
	$studentId = $_POST['student_db_id'];
	
	/*
	extract($_POST);
	
	if($studentId!="" && $studentId!="undefined") {
		$rsDtl = Student::updateStudentContactDtls($student_db_id, $emer_number, $emer_name, $email_address, $emer_relation, $current_address, $current_state, $current_city, $current_zipcode, $is_parent, $father_name, $father_qualification, $father_employment, $father_nature_of_job, $father_annual_income, $father_phone, $father_email, $mother_name,$mother_qualification, $mother_employment, $mother_nature_of_job, $mother_annual_income, $mother_phone, $mother_email,$guardian_name);
	
	}*/
/*******************sivamani working here********************************************/

	//Student::updateStudentByFields($fieldsArr, $_POST['studentId']);
	$fieldsArr=array();
	$fieldsArr[] = "father_phone='".$_POST['father_phone']."'";
	$fieldsArr[] = "father_email='".$_POST['father_email']."'";
	$fieldsArr[] = "father_qualification='".$_POST['father_qualification']."'";
	$fieldsArr[] = "mother_phone='".$_POST['mother_phone']."'";
	$fieldsArr[] = "mother_email='".$_POST['mother_email']."'";
	$fieldsArr[] = "current_address='".$_POST['current_address']."'";
	$fieldsArr[] = "current_state='".$_POST['current_state']."'";
	$fieldsArr[] = "current_city='".$_POST['current_city']."'";
	$fieldsArr[] = "current_zipcode='".$_POST['current_zipcode']."'";
	$fieldsArr[] = "emergency_contact_name='".$_POST['emer_name']."'";
	$fieldsArr[] = "email_address='".$_POST['email_address']."'";
	$fieldsArr[] = "emergency_contact_number='".$_POST['emer_number']."'";
	$fieldsArr[] = "emergency_contact_relationship='".$_POST['emer_relation']."'";
	//print_r($fieldsArr);
	Student::updateStudentByFields($fieldsArr, $studentId);
	
	$rsStudent=Student::getStudentById($studentId);
	$siblings=$rsStudent->siblings;
	//print_r($sibling);
	$sibling[]=array();
	$sibling=explode(',',$siblings);
		foreach($sibling as $K1 => $V1)
				{
					Student::updateStudentByFields($fieldsArr, $V1);
					//echo "Updated Successfully..!";
				}
	//send acknow mail here
	$emailAddress=$_SESSION['user_email'];
		$Subject="The Parent Details Changed By ".$_SESSION['user_email']." On This Student ".$_SESSION['studentId'];
		$MailContent="The Parent Details Changed By ".$_SESSION['user_email']." On This Student ".$_SESSION['studentId'];
			ob_end_clean();
			include "../secure/sendgrid.php";
			$user_obj=new User();
			$user_obj->user_type="SA";
			$rs_user=$user_obj->getAllUserDtls();
			foreach($rs_user as $KU=>$VU)
			{
				$emailAddress=$VU->email_address;
				echo $VU->email_address;
				//include "../secure/sendgrid.php";
			}
	
	echo "Updated Successfully..!";
	//sends acknow mail on here
		exit();
		
/*******************sivamani working here********************************************/
				
	
}	
	//print_r($studentId);
	//print_r($_SESSION['students']);
	$rs_student = Student::getStudentById($studentId); 
	$rs_grade = Grade::getGradeById($rs_student->grade_id); 
	$studentName = $rs_student->first_name.' '.$rs_student->middle_name.' '.$rs_student->last_name;	
	//$sibling = explode(',',$rs_student->siblings);
	
?> 

<style>
.tdhead{font-weight:bold;}
</style>
 <form name="studentContactFrm" id="studentContactFrm" method="post" >
<input type="hidden" id="act" name="act" value="saveContact"/>
<input type="hidden" id="student_db_id" name="student_db_id" value="<?=$studentId?>" /> 
<input type="hidden" id="sib_id" name="sib_id" value="<?=$sibling?>" /> 

<div class="fullsize border_theme pad10" style="width:98%;">
<table width="100%" border="0" cellspacing="15" cellpadding="10"  id="showBasicDtls">
    
    
         
       	  <?php ?>
    
       
        <tr id="showParentDtls">
            <td width="50%">
                <table width="100%" border="0" cellspacing="4" cellpadding="4" class="studentinnertbl">
                	<tr>
                    	<td><h3 class="txtbold" style="color:#996c2c; font-weight:bold; font-size:17px;">Father Details</h3></td>
                    </tr>

                    <tr>
                        <td>Father Phone</td>
                        <td align="center"><input type="text" class="txtbox" name="father_phone" id="father_phone" value="<?=$rs_student->father_phone?>" /></td>
                    </tr>
                    <tr>
                        <td>Father E-Mail</td>
                        <td align="center"><input type="text" class="txtbox" name="father_email" id="father_email" value="<?=$rs_student->father_email?>" /></td>
                    </tr>
                    <tr>
                        <td>Qualification</td>
                        <td align="center" ><input type="text" class="txtbox"  name="father_qualification" id="father_qualification" value="<?=$rs_student->father_qualification?>" /></td>
                    </tr>

                
                </table>
            </td>
            
            <td valign="top" style="margin-bottom:150px;">
                <table width="100%" border="0" cellspacing="4" cellpadding="4" class="studentinnertbl">
                	<tr>
                    	<td><h3 class="txtbold" style="color:#996c2c; font-weight:bold; font-size:17px;">Mother Details</h3></td>
                    </tr>

                    <tr>
                        <td>Mother Phone</td>
                        <td align="center"><input type="text" class="txtbox" name="mother_phone" id="mother_phone" value="<?=$rs_student->mother_phone?>" /></td>
                    </tr>
                    <tr>

                        <td>Mother E-Mail</td>
                        <td align="center" ><input type="text" class="txtbox" name="mother_email" id="mother_email" value="<?=$rs_student->mother_email?>" /></td>
                    </tr>
                    <tr>
                        <td>Qualification</td>
                        <td align="center" ><input type="text" class="txtbox"  name="mother_qualification" id="mother_qualification" value="<?=$rs_student->mother_qualification?>" /></td>
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
             <td valign="top" style="margin-bottom:150px;">
                <table width="100%" border="0" cellspacing="4" cellpadding="4" class="studentinnertbl">
                	<tr>
                    	<td><h3 class="txtbold" style="color:#996c2c; font-weight:bold; font-size:17px;">Current Address</h3></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td align="center"><input type="text" class="txtbox" name="current_address" id="current_address" value="<?=$rs_student->current_address?>" /></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td align="center"><input type="text" class="txtbox"  name="current_state" id="current_state" value="<?=$rs_student->current_state?>" /></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td align="center"><input type="text" class="txtbox"  name="current_city" id="current_city" value="<?=$rs_student->current_city?>" /></td>
                    </tr>
                    <tr>
                        <td>Zipcode</td>
                        <td align="center"><input type="text" class="txtbox" name="current_zipcode" id="current_zipcode" value="<?=$rs_student->current_zipcode?>" onkeypress="return isNumberKey(event)" /></td>
                    </tr>
                </table>
            </td>
            <td valign="top" style="margin-bottom:150px;">
                <table width="100%" border="0" cellspacing="4" cellpadding="4" class="studentinnertbl">
                	<tr>
                    	<td><h3 class="txtbold" style="color:#996c2c; font-weight:bold; font-size:17px;">Emergency Details</h3></td>
                    </tr>
                    <tr>
                        <td> Contact Name</td>
                        <td><input type="text" class="txtbox"  name="emer_name" id="emer_name" value="<?=$rs_student->emergency_contact_name?>" /></td>
                    </tr>
                    <tr>
                        <td>Contact Email</td>
                        <td><input type="text" class="txtbox" name="email_address" id="email_address" value="<?=$rs_student->email_address?>" /></td>
                    </tr>
                    <tr>
                        <td>Contact Mobile</td>
                        <td><input type="text" class="txtbox"  name="emer_number" id="emer_number" value="<?=($rs_student->emergency_contact_number=="")?$rs_student->mobile:$rs_student->emergency_contact_number?>" onkeypress="return isNumberKey(event)" /></td>
                    </tr>
                    <tr>
                        <td>Contact Relationship</td>
                        <td><input type="text" class="txtbox"  name="emer_relation" id="emer_relation" value="<?=$rs_student->emergency_contact_relationship?>" /></td>
                    </tr>
                </table>
            </td>
        </tr>
       
		
         
         <tr>
            <td align="right" colspan="2">
                <div class="fullsize txtwhite txtcenter f18">
                	<input type="button" id="saveImg" name="saveImg" value="SAVE" onclick="submitStudent(event)">
<!--                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="saveImg" onclick="submitStudent(event)"><strong>SAVE</strong></div>--> 
                    <img src="../secure/images/loader.gif" alt="Processing.." title="Processing.." align="absmiddle" id="processingImg" style="display:none;" />
               </div>
            </td>
        </tr>
     <?php /*?> <? } ?><?php */?>
 	</table>    
</div>
  </form>
<script type="text/javascript">
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

</script>