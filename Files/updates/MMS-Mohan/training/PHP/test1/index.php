<?
	session_start();
	
	echo $_POST['photo'];
	
	if($_POST['act']=='Submit'){
		
		$Err = 0;
		
		if($_SESSION['random_number'] != $_POST['captcha-code'])
		{
			$CaptchaErr['Capcha']= "Invalid Capcha";
			$Err = 1;
		}
		if(!$Err)
		{
			echo '<script>alert("Record Inserted")</script>';
			
			header('location:index.php');
		}
		
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Form - PHP</title>

<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>

<style type="text/css">

form,table,td,tr,input { padding:0; margin:0; }

.regtbl { margin:0 auto; margin-top: 50px; border:1px solid #3399FF; background:#d5e8fb; background: -moz-linear-gradient(top, #f8f8f8 20%, #bee4fd 100%);
	background: -webkit-linear-gradient(top, #f8f8f8 0%, #bee4fd 100%);
	background: linear-gradient(top, #f8f8f8 0%, #bee4fd 100%);
 }
.regtbl tr td { vertical-align: top; padding:7px; line-height:23px; }
.td_head 
{ 
	background: #3399FF;
	height: 25px; line-height:25px; font-size:16px; font-weight: bold; color:#FFF;
	background: -moz-linear-gradient(top, #79bafc 0%, #3366FF 100%);
	background: -webkit-linear-gradient(top, #79bafc 0%, #3366FF 100%);
	background: linear-gradient(top, #79bafc 0%, #3366FF 100%);
}

.txtbox, .combox { padding:3px; width:200px; font-family:Arial, Helvetica, sans-serif; font-size:14px; border:1px solid #8ed2ff;  }

#submitBtn{ background:#337df8; color:#000; font-weight: bold; font-size:12px; border: none; border-radius:7px; width: 80px; height:30px; padding-bottom:2px; cursor: pointer; transition: all 0.3s; }
#submitBtn:hover { background:#0662fb; color:#FFF; }

.filedErr { border:1px solid #ff0000; }

</style>

<script type="text/javascript">

$(function() {
	
	$(".datepicker").datepicker({
		changeMonth: true,
		changeYear: true
	}); 
	 
});

function isNumberKey(evt)
{
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	
	 return true;
}

 // Captcha

$(document).ready(function() { 

	 // refresh captcha
	 $('img#captcha-refresh').click(function() {  
			
			change_captcha();
	 });
	 
	 function change_captcha()
	 {
		document.getElementById('captcha').src="get_captcha.php?rnd=" + Math.random();
	 }
 
});

</script>

</head>

<body bgcolor="#f0f0f0" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">

<form method="post" id="regfrm" name="regfrm" enctype="multipart/form-data"> 
<table width="600" border="0" cellspacing="0" cellpadding="0" class="regtbl">
  <tr>
    <td colspan="2" align="center" class="td_head">Registration Form</td>
  </tr>
  <tr><td style="padding:0; line-height:10px;">&nbsp;</td></tr>
  <tr>
    <td width="231" align="right">Name of the Candidate :</td>
    <td width="367"><input type="text" class="txtbox" id="name" name="name" value="<?=$_POST['name']?>" /></td>
  </tr>
  <tr>
    <td align="right">Gender :</td>
    <td>
    	<span style="margin-right:10px;"><input type="radio" id="male" name="gender" value="M" <?=($_POST['gender']=='M' ? 'checked' : '');?> /> Male </span>
        <span style="margin-right:10px;"><input type="radio" id="female" name="gender" value="FM" <?=($_POST['gender']=='FM' ? 'checked' : '');?> /> Female </span>
    </td>
  </tr>
  <tr>
    <td align="right">Date of Birth :</td>
    <td><input type="text" class="txtbox datepicker" id="dob" name="dob" value="<?=$_POST['dob']?>" /></td>
  </tr>
  <tr>
    <td align="right">Marital Status :</td>
    <td>
    	<span style="margin-right:10px;"><input type="radio" id="married" name="marital_status" value="M" <?=($_POST['marital_status']=='M' ? 'checked' : '');?> /> Married </span>
        <span style="margin-right:10px;"><input type="radio" id="unmarried" name="marital_status" value="UM" <?=($_POST['marital_status']=='UM' ? 'checked' : '');?> /> UnMarried </span>
    </td>
  </tr>
  <tr>
    <td align="right">Address for Communication :</td>
    <td><textarea class="txtbox" style="height:70px;" id="address" name="address"><?=$_POST['address']?></textarea></td>
  </tr>
  <tr>
    <td align="right">Email ID :</td>
    <td><input type="text" class="txtbox" id="email" name="email" value="<?=$_POST['email']?>" /></td>
  </tr>
  <tr>
    <td align="right">Mobile No :</td>
    <td><input type="text" class="txtbox" id="mobile" name="mobile" onkeypress="return isNumberKey(event)" value="<?=$_POST['mobile']?>" /></td>
  </tr>
  <tr>
    <td align="right">Would like to get Notified for :</td>
    <td><input type="checkbox" id="group1" name="group1" value="G1" <?=($_POST['group1']=='G1') ? 'checked' : '';?> /> Group I Services<br /> 	 
        <input type="checkbox" id="csse" name="csse" value="C" <?=($_POST['csse']=='C') ? 'checked' : '';?> /> CSSE I Services<br />  
        <input type="checkbox" id="group4" name="group4" value="G4" <?=($_POST['group4']=='G4') ? 'checked' : ''?> /> Group IV Services<br /> 	 
        <input type="checkbox" id="technical" name="technical" value="T" <?=($_POST['technical']=='T') ? 'checked' : '';?> /> Technical Posts<br /> 	 
        <input type="checkbox" id="all" name="all" value="A" <?=($_POST['all']=='A' ? 'checked' : '');?> /> All 
    </td>
  </tr>
  <tr>
    <td align="right">Photograph of the Candidate :</td>
    <td><input type="file" id="photo" name="photo" value="<?=$_POST['photo']?>" /></td>
  </tr>
  <tr>
    <td align="right">Security Code :</td>
    <td>
        <div id="captcha-wrap" style="float:left;">
            <div class="captcha-box" style="width:170px;">
                <img id="captcha" alt="" src="get_captcha.php" height="40" style="float:left; border:1px solid #8ed2ff;" />
                <div class="captcha-action" style="float:right; margin:10px 10px 0 0;"><img src="images/refresh1.png" id="captcha-refresh" border="0" alt="" title="Change Text" style="cursor:pointer;"  /></div>
            </div>
            <div class="text-box" style="width:100%; float:left;">
            <label>Type the two words:</label><br/>
            <input type="text" class="txtbox" style="width:125px;" id="captcha-code" name="captcha-code"  />
            </div>
        </div>
        
        <!--  Captcha Error Message  -->
        <span style="color:#FF0000; font-size:11px; float:left; margin:62px 0 0 0px; font-weight:bold"><? if($CaptchaErr['Capcha']!='') { ?>This is not a valid text <? } ?> </span>
    </td>
  </tr>
  <tr height="50">
    <td>&nbsp;</td>
    <td>
            <input type="button" id="submitBtn" name="save" value="Submit" onclick="submitFrm()" />
            <input type="hidden" id="act" name="act" value="Submit" onclick="submitFrm()" />
    </td>
  </tr>
</table>
</form>



<script type="text/javascript">

function submitFrm(){
	
	var err = 0;
	
	if( $.trim($('#name').val()) == '' ) { err = 1;  $('#name').addClass('filedErr'); }else{ $('#name').removeClass('filedErr'); }
	if( $.trim($('#dob').val()) == '' ) { err = 1;  $('#dob').addClass('filedErr'); }else{ $('#dob').removeClass('filedErr'); }
	if( $.trim($('#address').val()) == '' ) { err = 1;  $('#address').addClass('filedErr'); }else{ $('#address').removeClass('filedErr'); }
	
 	if($('#email').val()=='')
	{
	err=1;
	$('#email').addClass('filedErr');
	}
	else
	{	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#email').val()) == false) 
		{
			alert('Enter Valid Email Address'); 
			err = 1;
			$('#email').addClass('filedErr');
		}
		else{
			$('#email').removeClass('filedErr');
		}
	}
	
	if( $.trim($('#mobile').val()) == '' ) { err = 1;  $('#mobile').addClass('filedErr'); }else{ $('#mobile').removeClass('filedErr'); }
	if( $.trim($('#photo').val()) == '' ) { err = 1;  $('#photo').addClass('filedErr'); }else{ $('#photo').removeClass('filedErr'); }
	if($('#captcha-code').val()=='') { err = 1; $('#captcha-code').addClass('filedErr');  } else {  $('#captcha-code').removeClass('filedErr'); }
	
	//if( $("#male").is(':checked') != true ) { err = 1;  alert('Select Gender'); }

	
	if( err == 0)
	{ 
		//alert('Success');
		$('#regfrm').submit();
	}
	
}


</script>

</body>
</html>