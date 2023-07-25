<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script type="text/javascript" src="js/jquery-1.7.2.js" ></script>
<script type="text/javascript" src="js/default.js" ></script>

</head>
<body>


<?php

$U = array("user1"=>"123", "user2"=>"234", "user3"=>"345", "user4"=>"456");

foreach ($U as $AB) {
    echo "$U->$AB";
}

?>
 
    
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


<script type="text/javascript">

function login() {

	var err = 0;
	
	if(	$('#username').val()=='' ){ err=1; $('#username').addClass('boxred'); } else{ $('#username').removeClass('boxred'); var username = $('#username').val(); }
	if(	$('#password').val()=='' ){ err=1; $('#password').addClass('boxred'); } else { $('#password').removeClass('boxred'); var password = $('#password').val(); }
	
}

</script>

</body>
</html>
