<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enquiry Form - JQuery Validation</title>

<style>
#wrap{border:solid #4aa518 2px;width:304px;-webkit-border-radius: 10px;float:left;-moz-border-radius: 10px;border-radius: 10px;
	padding:3px;margin-top:3px;background-color:#FFFFFF;margin-left:40px;}
img#refresh{float:left;margin-top:17px;margin-left:4px;cursor:pointer;border:1px solid red;}
.red{border:2px solid #FF0000;}
 </style>
 
<style type="text/css">
body{ background:#999;}
table{ margin:0 auto; width:400px; margin-top:100px; background:#FF9; font-family:Arial, Helvetica, sans-serif; font-size:14px;}
table tr td{ padding:10px 10px 10px 0px;}


/* Form Validation */

form .error,form .validation-failed{
	background:#ffdfef;
	border-color:#ffafbf!important
}

form .error_message{ color:#f27490;font-size:12px;}

form .select{border:3px solid #e6e7e8}

form .select li{
	color:#acb1b4;
	background:#fff;
	font-size:12px;
	margin:0;
	padding:5px 10px;
	border-bottom:1px dotted #e6e7e8;
	overflow:hidden;
}

form .select li:hover{ color:#7b8084; background:#f4f5f7;}

form .select li.selected{
	color:#7b8084;
	background:#f4f5f7;
	font-weight:700;
}
</style>


<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js" ></script>
<script  type="text/javascript" src="js/jquery.validate.js"></script>


</head>

<body>

<form name="enqfrm" id="enqfrm" method="post">
<table border="0" cellpadding="0" cellspacing="0">

<tr style=" background:#0C0; color:#FFF; font-weight:bold; font-size:16px;">
    <td width="50">&nbsp;</td>
    <td width="100">&nbsp;</td>
	<td colspan="2" align="left"><strong>Enquiry Form</strong></td>
</tr>

<tr>
    <td width="50">&nbsp;</td>
    <td width="100" align="right">Name :</td>
    <td width="200"><input type="text" id="fname" name="fname" class="txtbox" /></td>
    <td width="50">&nbsp;</td>
</tr>

<tr>
    <td width="50">&nbsp;</td>
    <td width="100" align="right">Email :</td>
    <td width="200"><input type="text" id="email" name="email" class="txtbox" /></td>
    <td width="50">&nbsp;</td>
</tr>

<tr>
    <td width="50">&nbsp;</td>
    <td width="100" align="right">Password :</td>
    <td width="200"><input type="password" id="password" name="password" class="txtbox" /></td>
    <td width="50">&nbsp;</td>
</tr>

<tr>
    <td width="50">&nbsp;</td>
    <td width="100">&nbsp;</td>
	<td colspan="2" align="left"><input type="button" value="Submit" onclick="submitfrm()" /></td>
</tr>


</table>
</form>


</body>
</html>

<script>

function submitfrm() {  $('#enqfrm').submit(); }
$("#enqfrm").validate({
	rules: {
		fname: "required",
		email: {required: true,	email: true	},
		password: { required: true,	minlength: 5}
	},
	messages: {
		fname: "",	email: "",	password: {	required: "",	minlength: "" } }
});
		
	
</script>
