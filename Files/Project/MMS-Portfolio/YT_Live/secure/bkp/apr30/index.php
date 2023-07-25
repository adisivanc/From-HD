<?
include 'includes.php';

if(isset($_SESSION['YTUserId'])){ ?><script type="text/javascript">window.location.href="dashboard.php";</script> <? }

if($_POST['act']=='Login')
{ 
	$input_msg=false;
	if($_POST['password']!='' && $_POST['user_name']!=''){
		$rsChkDtls = User::getUserLoginCredentials($_POST['user_name'], $_POST['password']); 
		$error_msg=false;
		if($rsChkDtls->id>0) {
			$error_msg=false;
			$_SESSION['YTUserId']=$rsChkDtls->id;
			$_SESSION['YTUserName']=$rsChkDtls->user_name;
			$_SESSION['YTUserType']=$rsChkDtls->user_type;
			
			//SessionWrite('YTUserId',$rsChkDtls->id);
			//SessionWrite('YTUserName',$rsChkDtls->user_name);
			//SessionWrite('YTUserType',$rsChkDtls->user_type);
			//SessionWrite('YTSchoolId',$rsChkDtls->school_id);
			//SessionWrite('YTAccessType',$rsChkDtls->access_type);
           	if($rsChkDtls->user_type=='SA' || count($schoolArr)>1){
				?> <script type="text/javascript">window.location.href="dashboard.php";</script> <?
			}else{
				?> <script type="text/javascript">window.location.href="grade.php";</script> <?
			}
			
			
		} else {
			$ErrorList['Invalid'] = '<span>Invalid Username or Password.</span>';
		}
	}
	else {
		$input_msg=true;
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>YT - Admin Panel</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/default_style.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />
<link rel="stylesheet" type="text/css" href="css/menumaker.css">

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>
<script src="js/menumaker.js"></script>


<style>
.boxerror { border:1px solid #F00; }
.errortxt { color:#F00; }
</style>

</head>
<body>



<form id="login_form" name="login_form" method="post">
<input type="hidden" id="act" name="act" value="Login" />
<table width="440" border="0" cellspacing="0" cellpadding="0" style="margin:190px auto 0 auto; border:2px solid #d0a36c; background:#fbf7f1;">
  <tr>
    <td colspan="2" class="padtb15 txtcenter txtwhite f24" style="background:url(images/menu_bg.jpg) repeat;"><strong>Administration Panel</strong></td>
  </tr>
  <? if($ErrorList['Invalid']!='') { ?>
  <tr>
    <td colspan="2" style="padding:20px 7px 0 7px;"  align="center" class="text-red" >
	  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="error">
  		<tr>
    		<td align="center" style="padding:7px 0; color:#F00; font-weight:bold"><?=$ErrorList['Invalid']?></td>
  		</tr>
	  </table></td>
  </tr>
  <? } ?>
  <tr>
    <td class=" padtop30 padbtm15" align="right">User Name</td>
    <td class="padtop30 padbtm15" align="center"><input type="text" class="txtbox" id="user_name" name="user_name" value="" /></td>
  </tr>
  <tr>
    <td class="padtb10" align="right">Password</td>
    <td class="padtb10" align="center"><input type="password" class="txtbox" id="password" name="password" value="" onKeyPress="return submitenter(this,event)" /></td>
  </tr>
  <tr>
    <td  colspan="2" class="padtb10" align="center">
    	<div class="btn txtwhite f18 margintop15" style="background:url(images/menu_bg.jpg) repeat; width:100px; font-size:18px;" onClick="submitLoginFrm()"><strong>Login</strong></div>
    </td>
  </tr>
</table>
</form>


<script type="text/javascript">
	
function submitLoginFrm() {
 
	var err=0;
	
	if($('#user_name').val()==''){ err=1;  $('#user_name').addClass('boxerror');  }else{  $('#user_name').removeClass('boxerror');  }
 	if($('#password').val()==''){ err=1;  $('#password').addClass('boxerror');  }else{  $('#password').removeClass('boxerror');  }
	 
 	if(err==0){
 		document.login_form.submit();
	}
}

function submitenter(myfield,e)
{
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	
	if (keycode == 13)
	   {
	   myfield.form.submit();
	   return false;
	   }
	else
	   return true;
}
	
function chkField(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

$("#cssmenu").menumaker({
	title: "Menu",
	format: "multitoggle"
});

</script>

</body>
</html>