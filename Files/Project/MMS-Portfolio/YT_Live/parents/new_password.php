<?
//Ajax Call
include('includes.php');
if($_POST['act']=='resetPassword') {
	ob_clean();
	$fieldsArr=array();
	$rs_student = Student::getStudentById($_POST['student_id']);
	if(count($rs_student) > 0) {
		if($_POST['parent_type']=='F')
			$fieldsArr[] = " f_password = '".$_POST['new_password']."'";
		else
			$fieldsArr[] = " m_password = '".$_POST['new_password']."'";
		$sibblings_arr = array();
		if($rs_student->siblings!='') {
			$sibblings_arr = explode(',',$rs_student->siblings);
		}
		$sibblings_arr[] = $rs_student->id;
		if(count($sibblings_arr) > 0) {
			foreach($sibblings_arr as $K2=>$V2) {
				$rs_student_update = Student::updateStudentByFields($fieldsArr,$V2);
				$final_message = "Updated Sucessfully";
			}
		}
	} else {
		$final_message = "Sorry!!! Could not able to process your request!!!";
	}
	echo $final_message;
	exit();
}

if($_REQUEST['s']!='' && $_REQUEST['e']!='' && $_REQUEST['p']!='') {
	$student_id = base64_decode($_REQUEST['s']);
	$emailAddress = base64_decode($_REQUEST['e']);
	$parent_type = base64_decode($_REQUEST['p']);
} else {
?>
	<script language="javascript" type="text/javascript">
		alert("Sorry!!! Unable to access this page!!!");
    	window.location.href = 'forgot_password.php';
    </script>
<?	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>YT - Parent Login</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>

<style>
.boxerror { border:1px solid #F00; }
.errortxt { color:#F00; }
</style>

</head>
<body>


<div class="header_container">
    <div class="header_pad">
    
    	<div class="logo"><img src="images/logo.png" alt="Yellow Train Logo" align="absmiddle" /> Yellow Train Grade School</div>
        
    </div>
</div>


<div class="full_width">
<input type="hidden" name="student_id" id="student_id" value="<? echo $student_id; ?>"/>
<input type="hidden" name="emailAddress" id="emailAddress" value="<? echo $emailAddress; ?>"/>
<input type="hidden" name="parent_type" id="parent_type" value="<? echo $parent_type; ?>" />
<table width="700" border="0" cellspacing="0" cellpadding="0" class="new_pwdtbl">
  <tr>
    <td style="border-bottom:1px solid #dab791;"><strong>Create a new password</strong></td>
  </tr>
  <tr>
    <td>
    	New password
        <input type="password" class="txtbox_full" id="new_password" name="new_password" value="" />
    </td>
  </tr>
  <tr>
    <td>
    	Confirm password
        <input type="password" class="txtbox_full" id="confirm_password" name="confirm_password" value="" />
    </td>
  </tr>
  <tr>
    <td>
    	<div class="apply_btn" onClick="submitNewPasswordFrm()"><strong>Change password and Sign me in</strong></div>
    </td>
  </tr>
</table>


</div>




<script type="text/javascript">

function submitNewPasswordFrm(){
	
	var err = 0;
	
	if(	$('#new_password').val()=='' ){ err=1; $('#new_password').addClass('boxerror'); } 
	else {
		var new_password = $('#new_password').val();
		$('#new_password').removeClass('boxerror');
	}
	if(	$('#confirm_password').val()=='' ){ err=1; $('#confirm_password').addClass('boxerror'); } 
	else {
		var confirm_password = $('#confirm_password').val();
		$('#confirm_password').removeClass('boxerror');
	}
	if(new_password!=confirm_password) {
		err=1;
		alert("Password Mismatch");
	}
	
	var student_id = $('#student_id').val();
	var emailAddress = $('#emailAddress').val();
	var parent_type = $('#parent_type').val();
	
	if(err==0){
		var paramData={'act':'resetPassword','student_id':student_id,'emailAddress':emailAddress,'parent_type':parent_type,'new_password':new_password}
		ajax({
			a:'new_password',
			b:$.param(paramData),
			c:function(){},
			d:function(data){				
				var result=$.trim(data);
				if(result=='Updated Sucessfully') {
					alert("Password has been updated successfully!!!");
					window.location.href='index.php';
				}
			}
		});
	}
}


</script>



</body>
</html>




