<?
require_once("includes.php");
 	
$user_email = $_SESSION['user_email'];
$user_type = $_SESSION['user_type'];
$studentId=$_SESSION['studentId'];

if($user_type=='F')
{
	$field = 'f_password';
	$field_email = "father_email";
}
else
{
	$field = 'm_password';
	$field_email = "mother_email";
}


if($_POST['act']=='chck_pwd')
{
	ob_clean();
	extract($_POST);
	if($_POST['new_pwd']!=$_POST['con_pwd'])
	{
		echo "Confirmation Password is not Match";
		exit();
	}
	$logDtl = Student::checkLoginCredentials($user_email,$_POST['old_pwd']);
	if(count($logDtl) > 0)
	{
		$logupDtl =  "UPDATE student SET $field='".$_POST["con_pwd"]."' WHERE $field_email='".$user_email."'";
		$select1 = mysql_query($logupDtl);
		if(mysql_affected_rows()>0)
		{
			echo 'Password Changed Successfully'; 
			exit();
		}
	}
	else
	{
		echo "Invalid Current Password"; 
		exit();
	}
}


?>


<style type="text/css">
.lbl { padding:15px; padding-left:10px; }
.table { color:#000000; }
.boxerror { border:1px solid #F00; }
</style>


<form  id="change_frm" name="change_frm" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #003f72;">
<tr>
	<td colspan="2" style="background:#eec290;"></td>
</tr>
<tr>
    <td colspan="2" id="errorMsg" style="color:#F00"></td>
</tr>
 <div align="center" class="registrationFormAlert" id="divCheckPasswordMatch"></div>
<tr>
	<td class="lbl" style="padding:20px;"> Current Password <span style="color:#F00;">*</span></td> 
    <td><input type="text" class="txtbox" name="old_pwd" id="old_pwd" value="" placeholder="Enter Current Password" /></td>
    <td><span class="st" id="txthint"></span></td>
</tr>
<tr>
	<td class="lbl" style="padding:20px;">New Password <span style="color:#F00;">*</span></td> 
    <td><input type="password" class="txtbox" name="new_pwd" id="new_pwd" value="" placeholder="Enter Your Password" /></td>
</tr>
<tr>
	<td class="lbl" style="padding:20px;">Confirm Password <span style="color:#F00;">*</span></td> 
    <td><input type="password" class="txtbox" name="con_pwd" id="con_pwd" value="" placeholder="Confirm Your Password" /></td>
    <td><span id="pass" style="color:#f00"></span></td>
   
</tr>
 <tr>
            <td align="center" colspan="2" style="padding-top:10px;">
                <div class="fullsize txtwhite txtcenter f18">
                	<input type="button" id="saveImg" name="saveImg" value="Update" onclick="submitChange(event)">
<!--                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="saveImg" onclick="submitStudent(event)"><strong>SAVE</strong></div>--> 
                    <img src="../secure/images/loader.gif" alt="Processing.." title="Processing.." align="absmiddle" id="processingImg" style="display:none;" />
               </div>
            </td>
        </tr>
</table>
</form>

<script type="text/javascript">

function submitChange(e)
{ 
 	var err=0;

	if ($('#old_pwd').val()=='') { err = 1;$('#old_pwd').addClass('boxerror'); } else { var old_pwd=$('#old_pwd').removeClass('boxerror').val(); }
	if ($('#new_pwd').val()=='') { err=1; $('#new_pwd').addClass('boxerror'); } else { var new_pwd=$('#new_pwd').removeClass('boxerror').val() };
	if ($('#con_pwd').val()=='') { err=1; $('#con_pwd').addClass('boxerror'); } else { var con_pwd=$('#con_pwd').removeClass('boxerror').val() };
	
	
	var paramData =  
	{
		"act":"chck_pwd",
		"old_pwd": old_pwd,
		"new_pwd": new_pwd,
		"con_pwd": con_pwd,
	};
	
	//alert($.param(paramData));	
		
		if(err==0)
		{
			
		 	$('#saveImg').hide();
			$('#processingImg').show();
			ajax({
				a:'changepassword',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					data = $.trim(data);
					alert(data);
						$('#saveImg').show();
						$('#processingImg').hide();
					/*if(data=='Password Changed Successfully') { window.location.href = 'student.php'; }
					else { alert("Current Password Not Matched"); }*/
				}
			});
		}
}
</script>

