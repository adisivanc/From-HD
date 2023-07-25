<?
function main(){
	
	if($_REQUEST['keyId']=="") { ?><script type="text/javascript">window.location.href="<?=getSeoUrl(array('pn'=>'index.php'))?>";</script> <? }
	
if($_POST['act']=="updateStudentDtls") {
	ob_clean();

		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$bloodGroup = str_replace("Minus", "-", $_POST['sBloodGroup']);
		$bloodGroup = str_replace("Plus", "+", $bloodGroup);
		$fieldsArr=array();
		$fieldsArr[] = "blood_group = '".addslashes($bloodGroup)."'";
		$fieldsArr[] = "father_name = '".$_POST['fatherName']."'";
		$fieldsArr[] = "father_phone = '".$_POST['fatherPhone']."'";
		$fieldsArr[] = "father_email = '".$_POST['fatherEmail']."'";
		//$fieldsArr[] = "father_qualification = '".$_POST['fatherQua']."'";
		$fieldsArr[] = "mother_name = '".$_POST['motherName']."'";
		$fieldsArr[] = "mother_phone = '".$_POST['motherPhone']."'";
		$fieldsArr[] = "mother_email = '".$_POST['motherEmail']."'";
		//$fieldsArr[] = "mother_qualification = '".$_POST['motherQua']."'";
		$fieldsArr[] = "emergency_contact_number = '".$_POST['EmerNumber']."'";
		$fieldsArr[] = "emergency_contact_name = '".$_POST['EmerName']."'";
		$fieldsArr[] = "emergency_contact_relationship = '".$_POST['EmerRelation']."'";
		$fieldsArr[] = "current_address = '".$_POST['sAddress']."'";
		//$fieldsArr[] = "current_state = '".$_POST['sState']."'";
		//$fieldsArr[] = "current_city = '".$_POST['sCity']."'";
		//$fieldsArr[] = "current_zipcode = '".$_POST['sZipcode']."'";
		$fieldsArr[] = "verification_form_status = 'Y'";
		$fieldsArr[] = "verification_form_status_date = '$sqlDateTime'";
		$rs_update = Student::updateCompanyByFields($fieldsArr, $_POST['studentId']);
	exit();
}
	
	
?>

<link rel="stylesheet" type="text/css" href="css/style.css" /> 

<style>
.boxred{border:1px solid #F00;}
</style>

<div class="verfication_cntr" id="vfformpage">
    <div class="verify_outer">
<?
$studid = base64_decode($_REQUEST['keyId']);
$studidArr = explode("~", $studid);
$rs_student_dtls = Student::getStudentById($studidArr[0]); 
?>

<form name="verificationFrm" id="verificationFrm">
<input type="hidden" name="act" value="saveParentFrm" />
<input type="hidden" name="studentid" id="studentid" value="<?=$studidArr[0]?>" />       
        <div class="width_100 verify_inner">
          
          <h1>Verification Form</h1>
          
          <?
		  if($rs_student_dtls->id==NULL) {
			?>
            <h3>Dear Parent,</h3>
            <p class="verify_parag">There is some problem for this page. Kindly contact the YT Communication Team for more details.</p>
            <?
		  } else {
		  ?>
          
          <h3>Dear Parent,</h3>
          <p class="verify_parag">We are happy to be transitioning to a paperless office. As a part of the process, we are hereby confirming your details.</p>
          
            <div class="width_100" style="border:1px solid #d9d9d9; background:#faf7c5; margin-top:15px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="vfpersontbl">
                    <tr>
                        <td class="vfwidth1_50"  align="right" valign="top">Name of the Student :</td>
                        <td class="vfwidth2_50"><!--<input type="text" class="vftxt_box vftxt_width80" id="" name="" value="" />-->
						<?=$rs_student_dtls->first_name?> <?=$rs_student_dtls->middle_name?> <?=$rs_student_dtls->last_name?></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">Address :</td>
                        <td><textarea style="height:80px;" class="vftxt_box vftxt_width80" id="current_address" name="current_address"><?=$rs_student_dtls->current_address?></textarea></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">Blood Group :</td>
                        <td><input type="text"  class="vftxt_box vftxt_width30" id="blood_group" name="blood_group" value="<?=$rs_student_dtls->blood_group?>" /></td>
                    </tr>
                </table>
            </div>
            
            <div class="width_100">
                <div class="vfparent_detail1" style="border:1px solid #d9d9d9; background:#faf7c5; margin-top:10px;">
                	<h2>Mother's Details</h2>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="vfpersontbl">
                        <tr>
                            <td width="30%" align="right" valign="top">Name :</td>
                            <td width="70%"><input type="text" class="vftxt_box vftxt_width80" id="mother_name" name="mother_name" value="<?=$rs_student_dtls->mother_name?>" /></td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">email id :</td>
                            <td><input type="text" class="vftxt_box vftxt_width80" id="mother_email" name="mother_email" value="<?=$rs_student_dtls->mother_email?>" /></td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">Phone :</td>
                            <td><input type="text" class="vftxt_box vftxt_width80" id="mother_phone" name="mother_phone" value="<?=$rs_student_dtls->mother_phone?>" /></td>
                        </tr>
                    </table>
                </div>
                
                <div class="vfparent_detail2" style="border:1px solid #d9d9d9; background:#faf7c5; margin-top:10px;">
                	<h2>Father's Details</h2>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="vfpersontbl">
                        <tr>
                            <td width="30%" align="right" valign="top">Name :</td>
                            <td width="70%"><input type="text" class="vftxt_box vftxt_width80" id="father_name" name="father_name" value="<?=$rs_student_dtls->father_name?>" /></td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">email id :</td>
                            <td><input type="text"  class="vftxt_box vftxt_width80" id="father_email" name="father_email" value="<?=$rs_student_dtls->father_email?>" /></td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">Phone :</td>
                            <td><input type="text" class="vftxt_box vftxt_width80" id="father_phone" name="father_phone" value="<?=$rs_student_dtls->father_phone?>" /></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            
            
            
            <div class="width_100" style="border:1px solid #d9d9d9; background:#faf7c5; margin-top:15px;">
            	<h2 class="vf_subheadh2">Emergency Contact Details</h2>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="vfpersontbl">
                    <tr>
                        <td class="vfwidth1_50" align="right" valign="top">Name :</td>
                        <td class="vfwidth2_50" ><input type="text" class="vftxt_box vftxt_width80" id="emergency_contact_name" name="emergency_contact_name" value="<?=$rs_student_dtls->emergency_contact_name?>" /></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">Relationship :</td>
                        <td><input type="text" class="vftxt_box vftxt_width80" id="emergency_contact_relationship" name="emergency_contact_relationship" value="<?=$rs_student_dtls->emergency_contact_relationship?>" /></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">Phone :</td>
                        <td><input type="text"  class="vftxt_box vftxt_width80" id="emergency_contact_number" name="emergency_contact_number" value="<?=$rs_student_dtls->emergency_contact_number?>" /></td>
                    </tr>
                </table>
            </div>
            
            <div class="width_100" style="margin:20px 0; text-align:center;">
                <div class="vfupdatebtn" onClick="saveVerficationFrm()">UPDATE & SAVE THE INFORMATION</div>
            </div>
            
            <? } ?>
    	</div>
</form>    
    </div>
</div>




<div class="verfication_cntr" id="vfthankyou">
    <div class="verify_outer">
        
        <div class="width_100 verify_inner">
          
          <h1>Verification Updated</h1>
          <h3>Dear Parent,</h3>
          <p class="verify_parag">Thank you for updating your details. Please note that all feature communications will be mailed to the email address that you have updated.
           Also make sure that you add communications@yellowtrainschool.com to your contact list to avoid getting send to the spam/junk folder.</p>
           <p class="verify_parag">&nbsp;</p>
          <h3>Warm Regards,</h3>
		  <h3>YT Communications Team</h3>
    	</div>
    
    </div>
</div>


<script type="text/javascript">

function update_save(){
    document.getElementById("vfformpage").style.display = "none";
	document.getElementById("vfthankyou").style.display = "block";
}

function saveVerficationFrm() {
	var err=0;
	
	var studentId = $.trim($('#studentid').val());
	var sAddress = $.trim($('#current_address').val());
	var sBloodGroup = $.trim($('#blood_group').val());
	var fatherName = $.trim($('#father_name').val());
	var fatherPhone = $.trim($('#father_phone').val());
	var fatherEmail = $.trim($('#father_email').val());
	//var fatherQua = $.trim($('#father_qualification').val());
	//var fatherInter = $.trim($('#father_interest').val());
	//var fatherName = $.trim($('#father_employment').val());
	var motherName = $.trim($('#mother_name').val());
	var motherPhone = $.trim($('#mother_phone').val());
	var motherEmail = $.trim($('#mother_email').val());
	//var motherQua = $.trim($('#mother_qualification').val());
	var EmerNumber = $.trim($('#emergency_contact_number').val());
	var EmerName = $.trim($('#emergency_contact_name').val());
	var EmerRelation = $.trim($('#emergency_contact_relationship').val());
	
	/*var sState = $.trim($('#current_state').val());
	var sCity = $.trim($('#current_city').val());
	var sZipcode = $.trim($('#current_zipcode').val());*/
	
	if(sAddress==''){ err=1; $('#current_address').addClass('boxred'); } else { $('#current_address').removeClass('boxred'); }
	if(sBloodGroup==''){ err=1; $('#blood_group').addClass('boxred'); } else { $('#blood_group').removeClass('boxred'); }
	if(fatherName==''){ err=1; $('#father_name').addClass('boxred'); } else { $('#father_name').removeClass('boxred'); }
	if(fatherPhone==''){ err=1; $('#father_phone').addClass('boxred'); } else { $('#father_phone').removeClass('boxred'); }
	//if(fatherQua==''){ err=1; $('#father_qualification').addClass('boxred'); } else { $('#father_qualification').removeClass('boxred'); }
	if(motherName==''){ err=1; $('#mother_name').addClass('boxred'); } else { $('#mother_name').removeClass('boxred'); }
	if(motherPhone==''){ err=1; $('#mother_phone').addClass('boxred'); } else { $('#mother_phone').removeClass('boxred'); }
	//if(motherQua==''){ err=1; $('#mother_qualification').addClass('boxred'); } else { $('#mother_qualification').removeClass('boxred'); }
	if(EmerNumber==''){ err=1; $('#emergency_contact_number').addClass('boxred'); } else { $('#emergency_contact_number').removeClass('boxred'); }
	if(EmerName==''){ err=1; $('#emergency_contact_name').addClass('boxred'); } else { $('#emergency_contact_name').removeClass('boxred'); }
	if(EmerRelation==''){ err=1; $('#emergency_contact_relationship').addClass('boxred'); } else { $('#emergency_contact_relationship').removeClass('boxred'); }
	
	/*if(sState==''){ err=1; $('#current_state').addClass('boxred'); } else { $('#current_state').removeClass('boxred'); }
	if(sCity==''){ err=1; $('#current_city').addClass('boxred'); } else { $('#current_city').removeClass('boxred'); }
	if(sZipcode==''){ err=1; $('#current_zipcode').addClass('boxred'); } else { $('#current_zipcode').removeClass('boxred'); }*/
	
	if(fatherEmail=='')
	{
	err=1;
	$('#father_email').addClass('boxred');
	}
	else
	{	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test(fatherEmail) == false) 
		{
			err=1;
			$('#father_email').addClass('boxred');
		}
		else{
			$('#father_email').removeClass('boxred');
		}
	}
	
	if(motherEmail=='')
	{
	err=1;
	$('#mother_email').addClass('boxred');
	}
	else
	{	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test(motherEmail) == false) 
		{
			err=1;
			$('#mother_email').addClass('boxred');
		}
		else{
			$('#mother_email').removeClass('boxred');
		}
	}
	var sAddress = sAddress.replace(/&/g, 'and'); 
	var sBloodGroup = sBloodGroup.replace(/[+]/, 'Plus').replace(/-/g, 'Minus'); 

	if(err==0) {
		ajax({
			a:'verification',
			b:'act=updateStudentDtls&studentId='+studentId+'&fatherName='+fatherName+'&fatherPhone='+fatherPhone+'&fatherEmail='+fatherEmail+'&motherName='+motherName+'&motherPhone='+motherPhone+'&motherEmail='+motherEmail+'&EmerNumber='+EmerNumber+'&EmerName='+EmerName+'&EmerRelation='+EmerRelation+'&sBloodGroup='+sBloodGroup+'&sAddress='+sAddress,		
			c:function(){},
			d:function(data){	//alert(data); return false;
				if(data) {
					document.getElementById("vfformpage").style.display = "none";
					document.getElementById("vfthankyou").style.display = "block";
				}
			}			
		});
	}

}

</script>








<?
}
include "template.php";
?>