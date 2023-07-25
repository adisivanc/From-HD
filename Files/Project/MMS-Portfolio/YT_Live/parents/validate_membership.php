<?
include('includes.php');
if($_POST['act']=="savePassword1")
{
ob_clean();
//print_r($_POST);
$msg="";
$err=0;
$account_set="";
$fieldsArr=array();
$password=$_POST['password'];
$authentication=$_POST['authentication_code'];
$email=$_POST['email_address'];
$student_obj=new Student();
$student_obj->authentication=$authentication;
$rs_student=$student_obj->getAllStudentDtls();
if(count($rs_student)>0)
{
$msg="Authentication is matched";
	foreach($rs_student as $sk=>$sv)
	{
		if($sv->father_email==$email)
		{
			$msg="Father Account is Activated...";
			if($sv->account_set=="N")
			{
				$msg="First Time Account Activated";
				$account_set="F";
				$password_field="f_password";
			}
			elseif($sv->account_set=="M")
			{
				$msg="First Time Account Activated";
				$account_set="BOTH";
				$password_field="f_password";
			}
			else
			{
				$msg="Your Account Already Activated";
				$err=1;
			}
				
		}
		elseif($sv->mother_email==$email)
		{
			$msg="Mother Account is Activated...";
			if($sv->account_set=="N")
			{
				$msg="First Time Account Activated";
				$account_set="M";
				$password_field="m_password";
			}
			elseif($sv->account_set=="F")
			{
				$msg="First Time Account Activated";
				$account_set="BOTH";
				$password_field="m_password";
			}
			else
			{
				$msg="Your Account Already Activated";
				$err=1;
			}
			
		}
		else{
			$msg="The Mail id is Not Matched";
			$err=1;
			}
	//cheack for this only
	if($err==0)
	{	
	$password_field=$password_field."=";	
	$fieldsArr[] = "account_set='".$account_set."'";
	$fieldsArr[] =$password_field."'".$password."'";
	$rs_student_update=Student::updateStudentByFields($fieldsArr,$sv->id);	$msg="updated sucessfully";
    }
	
	
	//
	}

}
else
{$msg="authentication Code Not Match";}
echo $msg;
exit();
}

if($_POST['act']=='savePassword') {
	ob_clean();
	$fieldsArr=array();
	$final_upd = false;
	$final_message = '';
	$student_obj = new Student();
	$student_obj->authentication = $_POST['authentication_code'];	
	$rs_student = $student_obj->getAllStudentDtls();
	if(count($rs_student) > 0) {
		foreach($rs_student as $K1=>$V1) {
			if($_POST['upd_status']==0) {
				if($_POST['parent_type']=='F') {
					if($V1->father_email!=$_POST['email_address']) {
						$final_message = 'MailId-NotMatched';
					} else {
						$final_upd = true;
					}
				} elseif($_POST['parent_type']=='M') {
					if($V1->mother_email!=$_POST['email_address']) {
						$final_message = 'MailId-NotMatched';
					} else {
						$final_upd = true;
					}
				}
			} elseif($_POST['upd_status']==1) {
				$final_upd = true;
				if($_POST['parent_type']=='F')
					$fieldsArr[] = " father_email = '".$_POST['email_address']."'";
				else
					$fieldsArr[] = " mother_email = '".$_POST['email_address']."'";				
			} elseif($_POST['upd_status']==2) {
				$final_upd = true;
			}
			if($final_upd) {
				if($_POST['parent_type']=='F') {
					$fieldsArr[] = " f_password = '".$_POST['password']."'";
					if($V1->account_set=='N')
						$fieldsArr[] = " account_set = 'F'";
					elseif($V1->account_set=='M')
						$fieldsArr[] = " account_set = 'BOTH'";
					elseif($V1->account_set=='BOTH' || $V1->account_set=='F') {
						echo $final_message = 'AlreadyAuthenticated';
						exit();
					}						
				} else {
					$fieldsArr[] = " m_password = '".$_POST['password']."'";
					if($V1->account_set=='N')
						$fieldsArr[] = " account_set = 'M'";
					elseif($V1->account_set=='F')
						$fieldsArr[] = " account_set = 'BOTH'";
					elseif($V1->account_set=='BOTH' || $V1->account_set=='M') {
						echo $final_message = 'AlreadyAuthenticated';
						exit();
					}
				}
				
				$sibblings_arr = array();
				if($V1->siblings!='') {
					$sibblings_arr = explode(',',$V1->siblings);
				}
				$sibblings_arr[] = $V1->id;
				if(count($sibblings_arr) > 0) {
					foreach($sibblings_arr as $K2=>$V2) {
						$rs_student_update = Student::updateStudentByFields($fieldsArr,$V2);
						$final_message = "Updated Sucessfully";
					}
				}	
			}
		}
	} else {
		$final_message = 'InvalidAuthentication';
	}
	echo $final_message;
	exit();
}

//get authentication_code and parent_type from newsletter
if($_REQUEST['authentication_code']!='' && $_REQUEST['parent_type']!='') {
	$authentication_code = base64_decode($_REQUEST['authentication_code']);		//decode the authentication_code
	$parent_type = base64_decode($_REQUEST['parent_type']);						//decode the parent_type
	$student_obj = new Student();
	$student_obj->authentication = $authentication_code;
	$rs_student = $student_obj->getAllStudentDtls();		
	if(count($rs_student) > 0) {
		foreach($rs_student as $K1=>$V1) {
			if($parent_type=='F') $parent_email = $V1->father_email;
			else $parent_email = $V1->mother_email;
			$student_id = $V1->id;
		}
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>YT - Parent Login</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />

<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js"></script>

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
    <div class="login_container">
    	
        <div class="full_width">
            <div class="validate_left">
            	<p>Welcome to the Online Parent Portal.</p> 
                <p> On this page you can validate your membership details in order to login and use the service.</p>
            </div>
            <div class="validate_right">
            	<form name="validatefrm">
                <input type="hidden" name="student_id" id="student_id" value="<? echo $student_id; ?>" />
                <input type="hidden" name="parent_type" id="parent_type" value="<? echo $parent_type; ?>" />
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="validatetbl">
                  <tr>
                    <th colspan="2">Validate Membership</th>
                  </tr>
                  <tr>
                    <td colspan="2"><p>Please enter the details that were sent to you by email in the form below and click continue.</p></td>
                  </tr>
                  <tr>
                    <td width="35%">Authentication code</td>
                    <td><input type="text" class="txtbox_full" id="authentication_code" name="authentication_code" value="<? echo $authentication_code; ?>" /></td>
                  </tr>
                  <tr>
                    <td>Email Address</td>
                    <td><input type="text" class="txtbox_full" id="email_address" name="email_address" value="<? echo $parent_email; ?>" /></td>
                  </tr>
                  <tr>
                    <td>Specify a password</td>
                    <td><input type="text" class="txtbox_full" id="password" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Confirm Password</td>
                    <td><input type="text" class="txtbox_full" id="confirm_password" name="confirm_password" value="" /></td>
                  </tr>
                  <tr>
                    <td><a href="index.php">Back to Login page</a></td>
                    <td><div class="validate_btn" onclick="validate_parent('0')">Register</div></td>
                  </tr>
                </table>
				</form>
            </div>
        </div>
                
    </div>
</div>




<div id="validate_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'LetterGothicMTStd';">
   		<div class="full_width">
        	<table width="580" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;" class="validate_popuptbl">
              <tr>
                <th colspan="2">
                	<div style="float:left;">Parent Login Portal</div>
                    <div onclick="close_validate_popup()" class="close_validate_popup">X</div>
                </th>
              </tr>
              <tr>
                <td><img src="images/alert_icon.png" alt="" /></td>
                <td>Please ensure the passwords entered match</td>
              </tr>
              <tr>
                <td colspan="2" align="center"><div class="okbtn" onclick="close_validate_popup()">OK</div></td>
              </tr>
            </table>
        </div>
</div>




<script type="text/javascript">
function validate_parent(upd_status)
{	
	var err=0;
	if ($('#email_address').val()=='') { err = 1;$('#email_address').addClass('boxerror'); } else { var email_address=$('#email_address').removeClass('boxerror').val(); }
	if ($('#password').val()=='') { err = 1;$('#password').addClass('boxerror'); } else { var password=$('#password').removeClass('boxerror').val(); }
	if ($('#confirm_password').val()=='') { 
	err = 1;$('#confirm_password').addClass('boxerror'); } 
	else {		
	var confirm_password=$('#confirm_password').removeClass('boxerror').val(); 
	if(password==confirm_password){
			$('#password').removeClass('boxerror');
			$('#confirm_password').removeClass('boxerror');	
	}
		else{		
			$('#password').addClass('boxerror');
			$('#confirm_password').addClass('boxerror');
			err=1;
			show_validate_popup();
			}
	}
	
	
	
	if ($('#authentication_code').val()=='') { err = 1;$('#authentication_code').addClass('boxerror'); } else { var authentication_code=$('#authentication_code').removeClass('boxerror').val(); }
	var parent_type = $('#parent_type').val();
	var paramData={'act':'savePassword','authentication_code':authentication_code,'email_address':email_address,'password':password,'parent_type':parent_type,'upd_status':upd_status}
	if(err==0)
		{
			ajax({
				a:'validate_membership',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					//alert(data);
					var result=$.trim(data);
					if(result=="Updated Sucessfully") {
						alert("Authentication successful. You will be redirected to parent login page");
						window.location.href="index.php";
					} else if(result=='MailId-NotMatched') {
						var confirmation = confirm("Your email id does not match our records. Do you want to update your email id?");
						if(confirmation) {
							validate_parent(1);		//update new mail id
						}
						else {
							validate_parent(2);		//dont update new mail id
						}
					} else if(result=='InvalidAuthentication') {
						alert("Authentication MisMatch");
					} else if(result=='AlreadyAuthenticated') {
						alert("Sorry! You are already authenticated!!!");
					}
				}
			});
		}
	
}	







function show_validate_popup(){
	
  	$("#validate_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_validate_popup(){  $("#validate_popup").dialog('close');  }



</script>


</body>
</html>