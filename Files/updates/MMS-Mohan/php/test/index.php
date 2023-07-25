<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test Form</title>

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>

<style type="text/css">
.txtbox{ width:180px; height:20px; color:#333; background-color:e0e0e0; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #ccc; }
.boxRed{ border:1px solid red; }
</style>

</head>

<body>

<form id="testFrm" name="testFrm" method="post" action="#">
<table width="400" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; margin-top:100px; border:1px solid #ccc;">
  <tr height="40">
    <td bgcolor="#CCCCCC" style="color:#000; font-weight:bold;" colspan="2" align="center">Test Form</td>
  </tr>
  <tr height="40">
    <td width="129" align="right">Firstname :</td>
    <td width="269" style="padding-left:10px;"><input type="text" class="txtbox" id="firstname" name="firstname" /></td>
  </tr>
  <tr height="40">
    <td align="right">Lastname :</td>
    <td style="padding-left:10px;"><input type="text" class="txtbox" id="lastname" name="lastname" /></td>
  </tr>
  <tr height="40">
    <td align="right">Gender :</td>
    <td style="padding-left:10px;"><input type="radio" id="male" name="gender" value="M" />Male &nbsp;&nbsp;&nbsp;
    <input type="radio" id="female" name="gender" value="FM" />Female</td>
  </tr>
  <tr height="40">
    <td align="right">Comments :</td>
    <td style="padding-left:10px;"><textarea class="txtbox" style="height:50px;" id="comments" name="comments"></textarea></td>
  </tr>
  <tr height="40">
    <td colspan="2" align="center"><img src="img/save_btn.jpg" border="0" style="cursor:pointer;" onclick="valFrm()" /></td>
  </tr>
</table>
</form>


<script type="text/javascript">

function valFrm(){
	
	var err=0;
	
	if($.trim($('#firstname').val()) == ''){ err=1; $('#firstname').addClass('boxRed'); } else { $('#firstname').removeClass('boxRed');  }
	if($.trim($('#lastname').val()) == ''){ err=1; $('#lastname').addClass('boxRed'); } else { $('#lastname').removeClass('boxRed');  }
	if($.trim($('#comments').val()) == ''){ err=1; $('#comments').addClass('boxRed'); } else { $('#comments').removeClass('boxRed');  }
	
	if(err == 0){ $('#testFrm').submit(); }
}


</script>

</body>
</html>