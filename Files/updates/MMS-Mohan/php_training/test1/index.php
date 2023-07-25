<?
include "include.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test Doc</title>

<link rel="stylesheet" type="text/css" href="css/style.css">

<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js"></script>

<style type="text/css">
.boxerror { border:1px solid #F00; }
</style>

</head>

<body>

<?

if($_POST['act']=='Submit'){
	
	$ins_userObj = new Users();
	
	$ins_userObj->uName = $_POST['name'];
	$ins_userObj->uUsername = $_POST['username'];
	$ins_userObj->uPassword = $_POST['password'];
	$ins_userObj->uEmail = $_POST['email'];
	$ins_userObj->uMobile = $_POST['mobile_number'];
	$ins_userObj->uStatus = $_POST['status'];
	
	$rs_contactDtls = $ins_userObj->insertUser();
	if(count($rs_contactDtls>0))
	{
		echo '<script type="text/javascript">alert("Record Inserted Successfully!")</script>';
		//header('location:index.php');
	}
	
}


?>


<form id="regfrm" name="regfrm" method="post">
<input type="hidden" id="act" name="act" value="Submit" />
<table width="500" border="0" class="regtbl" style="margin:0 auto;">
  <tr>
    <td colspan="2" class="tblhd" align="center">Registration Form</td>
  </tr>
  <tr>
    <td align="right">Name</td>
    <td><input type="text" class="txtbox" id="name" name="name" /></td>
  </tr>
  <tr>
    <td align="right">Username</td>
    <td><input type="text" class="txtbox" id="username" name="username" /></td>
  </tr>
  <tr>
    <td align="right">Password</td>
    <td><input type="password" class="txtbox" id="password" name="password" /></td>
  </tr>
  <tr>
    <td align="right">Confirm Password</td>
    <td><input type="password" class="txtbox" id="cpassword" name="cpassword" /></td>
  </tr>
  <tr>
    <td align="right">Email</td>
    <td><input type="text" class="txtbox" id="email" name="email" /></td>
  </tr>
  <tr>
    <td align="right">Mobile Number</td>
    <td><input type="text" class="txtbox" id="mobile_number" name="mobile_number" /></td>
  </tr>
  <tr>
    <td align="right">Status</td>
    <td>
    	<select class="listbox" id="status" name="status">
        <option value="A">Active</option>
		<option value="IN">In Active</option>
        </select>
    
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><img src="images/submit_btn.jpg" border="0" style="cursor:pointer" width="120" onclick="submit_regfrm()" /></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="userslist.php" target="_blank" style="color:#039; font-size:14px; text-decoration:none">Show List</a></td>
  </tr>
</table>
</form>



<script type="text/javascript">

function submit_regfrm(){
	
	var err=0;
	
	if($('#name').val()==''){ err=1; $('#name').addClass('boxerror'); }else { $('#name').removeClass('boxerror'); }
	if($('#username').val()==''){ err=1; $('#username').addClass('boxerror'); }else { $('#username').removeClass('boxerror'); }
	if($('#password').val()==''){ err=1; $('#password').addClass('boxerror'); }else { $('#password').removeClass('boxerror'); }
	if($('#cpassword').val()==''){ err=1; $('#cpassword').addClass('boxerror'); }else { $('#cpassword').removeClass('boxerror'); }
	if($('#email').val()==''){ err=1; $('#email').addClass('boxerror'); }else { $('#email').removeClass('boxerror'); }
	if($('#mobile_number').val()==''){ err=1; $('#mobile_number').addClass('boxerror'); }else { $('#mobile_number').removeClass('boxerror'); }
	if($('#status').val()==''){ err=1; $('#status').addClass('boxerror'); }else { $('#status').removeClass('boxerror'); }
	
	if(err==0){
		document.regfrm.submit();	
	}
	
}

</script>

</body>
</html>