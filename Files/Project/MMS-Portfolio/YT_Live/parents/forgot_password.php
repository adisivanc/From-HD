<?
include('includes.php');



if($_POST['act']=="errorMsg")
{
	ob_clean();
	?>
    <table width="580" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;" class="validate_popuptbl">
              <tr>
                <th colspan="2">
                	<div style="float:left;">Error Message</div>
                    <div onClick="close_login_error_popup()" class="close_validate_popup">X</div>
                </th>
              </tr>
              <tr>
                <td><img src="images/alert_icon.png" alt="" /></td>
                <td>Your Email Id does not match with our record. Kindly Check!!!</td>
              </tr>
              <tr>
                <td colspan="2" align="center"><div class="okbtn" onClick="close_login_error_popup()">OK</div></td>
              </tr>
            </table>
    <?
	exit();	
}
if($_POST['act']=="successMsg")
{
	ob_clean();
	?>
    <table width="580" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;" class="validate_popuptbl">
              <tr>
                <th colspan="2">
                	<div style="float:left;">Success Message</div>
                    <div onClick="close_login_error_popup()" class="close_validate_popup">X</div>
                </th>
              </tr>
              <tr>
                <td><img src="images/alert_icon.png" alt="" /></td>
                <td>An email has been sent to your email id with link to reset your password. Kindly check!!!</td>
              </tr>
              <tr>
                <td colspan="2" align="center"><div class="okbtn" onClick="close_login_error_popup()">OK</div></td>
              </tr>
            </table>
    <?
	exit();	
}




if($_POST['act']=='sendMail') {
	ob_clean();	
	$final_message = "";
	$student_obj = new Student();
	$student_obj->check_all_emails = $_POST['email_address'];
	$rs_student = $student_obj->getAllStudentDtls();
	if(count($rs_student) > 0) {
		foreach($rs_student as $K1=>$V1) {
			if(($V1->father_email==$_POST['email_address'] || $V1->mother_email==$_POST['email_address'])) {
				$student_id = $V1->id;
				if($V1->father_email==$_POST['email_address']) {
					$parent_name = $V1->father_name;
					$parent_type = 'F';
				} else {
					$parent_name = $V1->mother_name;
					$parent_type = 'M';
				}
				$emailAddress = $_POST['email_address'];
				$Subject = "Reset your forgotten password for your YT Parent login account";
				ob_start();
				include('../newsletter/forgot_password_mail.php');
				$MailContent = ob_get_contents();
				ob_clean();
				//echo $MailContent;			
				include "../secure/sendgrid.php";
				echo 'MailSent';
				exit();
			} else {
				$final_message = 'EmailIdMismatch';
			}
		}
	} else {
		$final_message = 'EmailIdMismatch';
	}
	echo $final_message;
	exit();
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


<table width="700" border="0" cellspacing="0" cellpadding="0" class="forgot_pwdtbl" >
  <tr>
    <td style="border-bottom:1px solid #dab791;"><strong>Forgotten your password?</strong></td>
  </tr>
  <tr>
    <td>
    	<p class="parag">Change your password in three easy steps. This helps to keep new password secure.</p>
        <p class="parag">
        1. Fill in your email address below. <br/>
        2. We'll email you a temporary code. <br/>
        3. Use the code to change your password on our secure website.
        </p>
    </td>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="forgot_emailtbl">
          <tr>
            <td colspan="2">Enter your registered email address</td>
          </tr>
          <tr>
            <td colspan="2"><input type="text" class="txtbox_full" id="email_address" name="email_address" value="" /></td>
          </tr>
          <tr>
            <td>Type in the email address you used when you registerd with Yellow Train. Then we'll email a code to this address</td>
            <td width="100" align="right">
            	<div class="apply_btn" onClick="submitEmailFrm()"><strong>Submit</strong></div>
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>


</div>



<div id="login_error_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'LetterGothicMTStd';">
<div class="full_width" id="error_message">
    
</div>
</div>



<script type="text/javascript">


function show_login_error_popup(){
	
  	$("#login_error_popup").dialog({
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

function close_login_error_popup(){  $("#login_error_popup").dialog('close');  }


function submitEmailFrm(){
	
	var err = 0;

	if($('#email_address').val()=='')
	{
	err=1;
	$('#email_address').addClass('boxerror');
	}
	else
	{	 
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#email_address').val()) == false) 
		{
			err=1;
			$('#email_address').addClass('boxerror');
		}
		else{
			$('#email_address').removeClass('boxerror');
			var email_address = $('#email_address').val();
		}
	}

	if(err==0){		
		var paramData={'act':'sendMail','email_address':email_address}
		ajax({
			a:'forgot_password',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				var result=$.trim(data);
				if(result=='MailSent') {
					show_login_error_popup();
					var pData1={'act':'successMsg'}
					ajax({
						a:'forgot_password',
						b:$.param(pData1),
						c:function(){},
						d:function(data){
							$('#error_message').html(data);
							}
						});
					
				} else if(result=='EmailIdMismatch') {
					show_login_error_popup();
					var pData2={'act':'errorMsg'}
					ajax({
						a:'forgot_password',
						b:$.param(pData2),
						c:function(){},
						d:function(data){
							
							$('#error_message').html(data);
							}
						});
					
				}
			}
		});
	}
}

</script>
</body>
</html>




