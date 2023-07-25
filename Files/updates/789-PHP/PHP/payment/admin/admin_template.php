<?
include "includes.php";
	
if(!isset($_SESSION['AdminId'])){
	header('location:index.php');
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WRC - Admin Panel</title>

<link rel="stylesheet" type="text/css" href="css/secure_style.css" />
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js"></script>

<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>


<script type='text/javascript' src='../js/autocomplete/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='../js/autocomplete/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="../js/autocomplete/jquery.autocomplete_faculty.css" />

<style type="text/css">
.boxerror { border:1px solid #F00; }
.texterror { color:#F00; }
</style>
</head>
<body>


<!--  Header  -->

<div id="header">
<div class="mid_container">
    <div id="logo"><img src="images/logo_small.png" border="0" alt="WRC" /></div>
    <div id="paneltitle" style="color:#000">ADMINISTRATION PANEL</div>
</div>
</div>

<!--  Container  -->

<div id="container">
<div class="mid_container">

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="168" valign="top" align="left">
        <table width="166" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top">
            
                <table width="100%" border="0" class="dashboard_menu_tbl" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center" bgcolor="#7d7d7d" style="color:#FFF; font-size:16px">Dash Board</td>
                  </tr>
                  
                  <tr>
                    <td>
                        <a href="dashboard.php" class="main_menu">
                        	<!--<div class="main_menu_icon"><img src="images/home_icon.jpg" border="0" alt="Home" style="top:3px;" /></div>-->
                        	<div class="main_menu_item">Home</div>
                        </a>
                        
                        <div class="bottomline"></div>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>
                        <div class="main_menu">
                        	<!--<div class="main_menu_icon"><img src="images/faculty_icon.jpg" border="0" alt="Faculty" style="top:2px;" /></div>-->
                        	<div class="main_menu_item">Payment</div>
                        </div>
                       
                        <div id="faculty_submenu" class="main_submenu">
						
                            <a href="payment_type.php" class="main_submenu_item">
                                <div class="main_submenu_icon"><img src="images/international_faculty_icon.jpg" border="0" alt="Faculty" style="top:3px;" /></div>
                                <div class="main_submenu_itemname">Add Payment Type</div>
                            </a>
                           
							 <a href="payment_details.php" class="main_submenu_item">
                                <div class="main_submenu_icon"><img src="images/national_faculty_icon.jpg" border="0" alt="Faculty" style="top:2px; padding-left:-10px"/></div>
                                <div class="main_submenu_itemname">Payment Details</div></a>
                            
                        </div>
                        <div class="bottomline"></div>
                    </td>
                  </tr>
                  
                      
                  <tr>
                    <td>
                    	<a href="logout.php" class="main_menu">
                        	<!--<div class="main_menu_icon"><img src="images/logout_icon.jpg" border="0" alt="Logout" style="top:3px; margin-left:4px" /></div>-->
                        	<div class="main_menu_item">Logout</div>
                        </a>
                    </td>
                  </tr>
                </table>
            
            </td>
          </tr>
        </table>
    </td>
    <td width="1016" valign="top" style="padding-left:15px;">
        <?  main();  ?>
    </td>
  </tr>
</table>


</div>
</div>

<script type="text/javascript">

<?
	$PageUrlArr = explode('/',$_SERVER['SCRIPT_NAME']);
	$curpage=$PageUrlArr[3];

	if($curpage=='faculty.php' || $curpage=='add_faculty.php' || $curpage=='faculty_report.php' || $curpage=='faculty_session_report.php'){
?>
	$('#faculty_submenu').show();
	
<? } ?>

$(".main_menu").click(function() {
    $(this).next(".main_submenu").slideToggle("slow");
});


$('.submenu_mainmenu').click(function(){
    $(this).next(".submenu_menu").slideToggle(400);
});


function chkField(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	
	return true;
}

</script>


</body>
</html>