<?
include "includes.php";
if(isset($_SESSION['user_email']))
{

}
else
{
?>
<script type="text/javascript">window.location.href='index.php';</script>
<?
}
//print_r($_SESSION);
   $studentDtls = $_SESSION['students'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>YT - Parent Login</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>

<style>
.boxerror { border:1px solid #F00; }
.errortxt { color:#F00; }
</style>

</head>
<body>


<div class="header_container">
    <div class="header_pad">
    
    	<div class="logo"><img src="images/logo.png" alt="Yellow Train Logo" align="absmiddle" /> Yellow Train Grade School</div>
        <div class="welcome">Welcome <span><? echo $_SESSION["user_email"];?></span></div>
        
    </div>
</div>

<div class="full_width">
	<? main(); ?>
</div>
<div id="inbox_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'LetterGothicMTStd';">
  
</div>
<div id="leave_application_popup" class="popupbox" style=" max-width:550px; padding:0; margin:0; display:none; font-family:Arial, Helvetica, sans-serif;">
</div>
</body>
</html>