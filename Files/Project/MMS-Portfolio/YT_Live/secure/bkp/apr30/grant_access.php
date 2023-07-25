<?
require_once("includes.php");

if($_POST['act']=="setSchoolvalue"){
 	session_start();
	$_SESSION['YTSchoolId'] = $_POST['school_id'];
	//header("Location:grade.php");
}
//print_r($_SESSION);

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
<table width="440" border="0" cellspacing="0" cellpadding="0" style="margin:190px auto 0 auto; border:2px solid #d0a36c; background:#fbf7f1;">
  
    <tr style="background-color:#8198AA;">
        <td class="padtb15 txtcenter txtwhite f24" style="background:url(images/menu_bg.jpg) repeat;"><strong>Grant Access</strong></td>
    </tr>
    
    <tr>
        <td style="padding:20px;" align="center"> 
        <select id="grant_access" name="grant_access" class="listbox" style="width:70%;">
            <option value="">Select School</option>
            <? if($_SESSION['YTUserType']=="SA" ){ ?>
            <option value="A">All School</option>
            <? } ?>
            <?
            if(count($_SESSION['SchoolsArr'])>0) {
                foreach($_SESSION['SchoolsArr'] as $kk=>$vv) {
                    $rs_sch = School::getSchoolById($vv);
                ?>
                <option value="<?=$vv?>"><?=$rs_sch->school_name?></option>
                <?
                }
            }
            ?>
        </select>
        
          </td>
        </tr>
        <tr>
        <td height="10" align="center" style="padding:20px">
        <div class="btn txtwhite f18 margintop15" style="background:url(images/menu_bg.jpg) repeat; width:100px; font-size:18px;" onclick="setSchool(grant_access.value)">Submit</div></td>
    </tr>	
          
</table>


<script type="text/javascript">
 
function setSchool(val) {
	if(val!="") {
		ajax({
			a:'grant_access',
			b:'act=setSchoolvalue&school_id='+val,		
			c:function(){},
			d:function(data){
				window.location.href = 'dashboard.php';
			}			
		});
	} else {
		alert("Select School To View School Details..!");	
	}
}
</script>

</body>
</html>