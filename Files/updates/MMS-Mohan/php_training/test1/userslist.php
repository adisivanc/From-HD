
<?
include "include.php";

	$row = Users::getallTestimonialList();
	$ins_userObj = new Users();

	print_r($row);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Userslist</title>

<link rel="stylesheet" type="text/css" href="css/style.css">

<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js"></script>

<style type="text/css">
.boxerror { border:1px solid #F00; }
</style>

</head>

<body>

<table width="700" border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse; margin:0 auto;" >
  <tr style="font-weight:bold;" bgcolor="#CCCCCC">
    <td>S.No</td>
    <td>Name</td>
    <td>Username</td>
    <td>Email</td>
    <td>Mobile Number</td>
    <td>Status</td>
  </tr>
  <? foreach ($rs as $k->$v){
	  
	  echo $v;
	   ?> 
  <tr>
    <td>$v->id</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?  } ?>
</table>










</body>
</html>