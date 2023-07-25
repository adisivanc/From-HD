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

<div class="fullsize header_container padtb10 lineht2_7">
    <div class="menu_container txtwhite">
    	<div class="logo"> <img src="images/logo.png" alt="Yellow Train" /> </div>	
        <div class="pull_left f24 marginleft15"><strong>Yellow Train Grade School</strong></div>
        <div class="pull_right f18 margintop10">Welcome<strong> ADMIN</strong></div>
    </div>
    
    
    <div class="fullsize padtop10 lineht2 bdrtp_white margintop15">
        <div id="cssmenu">
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li>
                    <a href="#">Grades</a>
                    <ul>
                        <li><a href="#">Grades 1</a></li>
                        <li><a href="#">Grades 2</a></li>
                        <li><a href="#">Grades 3</a></li>
                        <li><a href="#">Grades 4</a></li>
                    </ul>
                </li>
                <li><a href="teacher.php">Teachers</a></li>
                <li><a href="newsletter.php">Newsletter</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    </div>
    
</div>





<div class="fullsize_pad padtb20">
	<? main(); ?>
</div>




<script type="text/javascript">
	
function chkField(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

</script>

<script type="text/javascript">
	$("#cssmenu").menumaker({
		title: "Menu",
		format: "multitoggle"
	});
</script>

</body>
</html>