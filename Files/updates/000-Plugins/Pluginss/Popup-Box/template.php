<?
	$PageUrlArr=explode('/',$_SERVER['SCRIPT_NAME']);
	$curpage=$PageUrlArr[2];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Parking Access</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" href="css/responsivemobilemenu.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />

<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>
<script type="text/javascript" src="js/responsivemobilemenu.js"></script>


</head>

<body>

<!-- Header -->


<div id="container">

<div id="header">
<div class="mid">

    <div id="logo"><a href="index.php"><img src="images/logo.png" border="0" /></a></div>

	<div id="header_right">
    	<? if($curpage!='index.php') { ?>
		<div id="change_airportbox">
            <select class="listbox" id="change_airport" name="change_airport">
                <option value="">Change Airport</option>
                <option value="">Month dsda asdasd sadsad asd asdasd </option>
            </select>
        </div>
    	<? } ?>
        <div id="menu_container">
        <div class="rmm">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">How we work?</a></li>
                <li><a href="#">FAQ</a></li>       
                <li class="nav-active"><a href="myaccount.php">Login</a></li>     
            </ul>
        </div>
        </div>
    </div>
    
</div>
</div>

<!-- Container -->

<div id="content_container">
<?  main(); ?>
</div>


<!-- Footer -->

<?  include "footer.php";  ?>

</div>


<script type="text/javascript">

$('.rmm ul li a').click(function(){
	$('.rmm ul li a').removeClass('nav-active');
	$(this).addClass('nav-active');
});

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	
	return true;
}

function chkField(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

</script>


</body>
</html>