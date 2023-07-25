<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Php Test</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>

<script type="text/javascript">

function chkField(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

</script>

<style>
.errorVal{ border:1px solid red; }
</style>


</head>


<body>
<div id="container">

<div id="login">Login</div>

<form action="" id="login_frm" name="login_frm" method="post">
<table width="345" border="0" cellspacing="0" cellpadding="0" class="login_tbl">
    <tr>
        <td>
        <label class="txt_bold">Username</label><br />
        <input type="text" class="txtbox" id="username" name="username" onblur="chkField(this)" onfocus="chkField(this)" value="Username" />
        </td>
    </tr>
    <tr>
        <td>
        <label class="txt_bold">Password</label><br />
        <input type="password" class="txtbox" id="password" name="password" onblur="chkField(this)" onfocus="chkField(this)" value="Password" />
        </td>
    </tr>
    <tr>
        <td valign="bottom"><br />
        	<span style="margin-left:35px;"><img src="images/login.png" border="0" style="cursor:pointer;" width="60%" onclick="submitfrm()" /></span>
        </td>
    </tr>
</table>
</form>


</div>

<script>
// Login Form Validation

function submitfrm() { 

	var err=0;
	if( $.trim($('#username').val()) == '' || $('#username').val() == 'Username' ) { err = 1; $('#username').addClass('errorVal'); } else { $('#username').removeClass('errorVal'); }
	if( $.trim($('#password').val()) == '' || $('#password').val() == 'Password' ) { err = 1; $('#password').addClass('errorVal'); } else { $('#password').removeClass('errorVal'); }

	if(err == '0') $('#login_frm').submit();
}

</script>

</body>
</html>