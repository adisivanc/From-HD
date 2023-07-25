<?
require("includes.php");


/** admin login function **/
if($_POST['act']=='login') {
  $postVar = array('username','password');  
  foreach($postVar as $K=>$V) $$V=check_input($_POST[$V]);
  $returnArr = Users::checkCredentials($username,$password);
  if(count($returnArr)>1) {
	 $rsUser = $returnArr[1];
	 $_SESSION['username']=$rsUser->username;
	 $_SESSION['user_email']=$rsUser->email_address;	 
	 $_SESSION['[notify_on_error']=$rsUser->notify_on_error;	 
	 $_SESSION['[copy_all_emails']=$rsUser->copy_all_emails;	 
	 $_SESSION['[user_type']=$rsUser->user_type;	
	 ob_clean();
	 echo 'Success'; 
	 exit();
  }
  ob_clean();
  echo $returnArr[0];
  exit();	
} 


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GreenIndia - Admin Panel</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<script language="javascript" src="js/default.js"></script>
<script language="javascript" src="js/jquery-1.7.2.js"></script>

</head>
<body>

<div id="tableContainer-1">
  <div id="tableContainer-2">
    
    <form id="indexfrm" name="indexfrm" method="post">
    <table cellpadding="0" cellspacing="0" class="loginTbl">
        <tr>
            <th colspan="2" align="center" style="font-size:18px; border-bottom: 1px solid #999">GreenIndia Admin Panel</th>
        </tr>
        <tr>
            <td colspan="2" align="center" class="error" style="display:none"></td>
        </tr>
        <tr>
            <td><strong>Username</strong></td>
            <td><input type="text" name="username" id="username" class="textbox" value="" /></td>
        </tr>
        <tr>
            <td><strong>Password</strong></td>
            <td><input type="password" name="password" id="password"  class="textbox" value="" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="button" class="btn" value="Login" onclick="login()" /></td>
        </tr>
    </table>
    </form>
    
  </div>
</div>


<script type="text/javascript">

function login() {

	var err = 0;
	if(	$('#username').val()=='' ){ err=1; $('#username').addClass('boxred'); } else{ $('#username').removeClass('boxred'); var username = $('#username').val(); }
	if(	$('#password').val()=='' ){ err=1; $('#password').addClass('boxred'); } else { $('#password').removeClass('boxred'); var password = $('#password').val(); }
	
	if(err==0){ 
	
	 	var paramData = {'act':'login','username':username,'password':password}
	
		ajax({ 
			a:'index',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
							data = $.trim(data);
			if(data=='Success') window.location.href = 'leads.php'; else {
			$('.error').html(data);
			$('.error').show();
			}
		    $('#login').val('Login');			

				
				 }

			});
	}
}

</script>

</body>
</html>