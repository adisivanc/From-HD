<?


//ini_set('display_errors',1);
require_once("includes.php");

	if($_POST['act']=='login')
	{
		ob_clean();
		$rsStudents = Student::checkLoginCredentials($_POST['email_address'], $_POST['password']);
		if(count($rsStudents)>0) {
				$_SESSION['YTUserType']="PARENT";	
			   $_SESSION['user_email']=$_POST['email_address'];
			   if($rsStudents[0]->father_email==$_POST['email_address']) { $_SESSION['user_type']='F';} else  $_SESSION['user_type']='M';
			   $cnt=0;
			   $students = array();
			   foreach($rsStudents as $K=>$V) {
				   if($cnt==0)
				   {
				   	$_SESSION['studentId']=$V->id;
			      	$students[$V->id]=array('name'=>$V->first_name.' '.$V->last_name,'id'=>$V->id,'grade_id'=>$V->grade_id,'school_id'=>$V->school_id,'sibling'=>$V->siblings);
				  	$cnt++;
				   }
			   }
			   $_SESSION['students']=$students;
			   
			    echo 'Success'; exit();
		}
		else	echo 'Invalid Credentials';
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
            	<p> If you already have an account, log in using your email and password. If you have received an email or letter to add a student to your account, login and follow the instructions. <br/><br/>
                Alternatively if you are setting up your account for the first time and have received an email/letter click the link below the Login button. </p>
				<p> If you have not received an invitation to connect please contact the school.</p>
            </div>
            <div class="validate_right">
            	<form name="validatefrm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="validatetbl">
                  <tr>
                    <th colspan="2">Parent Login</th>
                  </tr>
                  <tr>
                    <td colspan="2"><p>Welcome to the Parent portal </p>
					<p>If you already have a Parent Portal account and wish to view information about student already linked to your account please enter your registered email and password below.</p></td>
                  </tr>
                  <tr>
                                       
                    </td>
                  </tr>
                  <tr>
                    <td width="35%">Your Email Address</td>
                    <td><input type="text" class="txtbox_full" id="email_address" name="email_address" value="" /></td>
                  </tr>
                  <tr>
                    <td>Your Password</td>
                    <td><input type="password" class="txtbox_full" id="password" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td><a href="forgot_password.php">Forgotten Password?</a></td>
                    <td><div class="validate_btn" onclick="SubmitLoginFrm()">Login</div></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="text-align:center;">
                    	<a href="validate_membership.php">First time user? If you have received an email with your authentication code, please click here to validate your account and to choose your password.</a>
                    </td>
                  </tr>
                </table>
				</form>
            </div>
        </div>
                
    </div>
</div>



<div id="login_error_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'LetterGothicMTStd';">
   		<div class="full_width">
        	<table width="580" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;" class="validate_popuptbl">
              <tr>
                <th colspan="2">
                	<div style="float:left;">Parent Login Portal</div>
                    <div onclick="close_login_error_popup()" class="close_validate_popup">X</div>
                </th>
              </tr>
              <tr>
                <td><img src="images/alert_icon.png" alt="" /></td>
                <td>Email Address or Password did not match our records. Please check and try again.</td>
              </tr>
              <tr>
                <td colspan="2" align="center"><div class="okbtn" onclick="close_login_error_popup()">OK</div></td>
              </tr>
            </table>
        </div>
</div>




<script type="text/javascript">
function Parent_LoginFrm()
{

	var err=0;
	if ($('#email_address').val()=='') { err = 1;$('#email_address').addClass('boxerror'); } else { var email_address=$('#email_address').removeClass('boxerror').val(); }
	if ($('#password').val()=='') { err = 1;$('#password').addClass('boxerror'); } else { var password=$('#password').removeClass('boxerror').val(); }
	
	
}	



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
function SubmitLoginFrm()
{

	var err=0;
	if ($('#email_address').val()=='') { err = 1;$('#email_address').addClass('boxerror'); } else { var email_address=$('#email_address').removeClass('boxerror').val(); }
	if ($('#password').val()=='') { err = 1;$('#password').addClass('boxerror'); } else { var password=$('#password').removeClass('boxerror').val(); }
	
			var paramData =  
				{
				"act":"login",
				"email_address": email_address,
				"password": password,
				};
		
		if(err==0)
		{
			ajax({
				a:'index',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					data = $.trim(data);
					if(data=='Success'){window.location.href = 'dashboard.php';}	
					else{ show_login_error_popup();};
				}
			});
		}
	
}	
</script>


</body>
</html>