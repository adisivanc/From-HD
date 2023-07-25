<?php
	$PageUrlArr=explode('/',$_SERVER['SCRIPT_NAME']);
	$curpage=$PageUrlArr[5];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width;">
<meta name="copyright" content="Ping Solution. All Rights Reserved." />
<meta name="publisher" content="sevandesigns.com" />
<meta name="Author" content="Website design Company - http://www.sanyotechnologies.com" />
<meta name="Computer sales and service Company" content="Computer sales and service Company, we provide a best computer services and sales in market." />
<link rel='shortcut icon' href='images/logo.jpg' type='image/x-icon' />
<title>Ping Solution</title>
<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/flexslider.css">

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</head>
<body>
<!--[if lt IE 7]>
    <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->

<!-- Header -->

<div id="header">
<div class="mid">

	<a href="index.php"><img src="images/logo.png" border="0" alt="PING SOLUTION" /></a>
    
    <ul>
    <li><a href="index.php" <?php if($curpage=='index.php'){ ?>class="nav-active" <?php } ?>><img src="images/home.png" border="0" alt="Home" title="Home" />Home</a></li>
    <li><a href="about.php" <?php if($curpage=='about.php'){ ?>class="nav-active" <?php } ?>><img src="images/about.png" border="0" alt="About Us" title="About Us" />About Us</a></li>
    <li><a href="service.php" <?php if($curpage=='service.php'){ ?>class="nav-active" <?php } ?>><img src="images/service.png" border="0" alt="Services" title="Services" />Services</a></li>
    <li><a href="product.php" <?php if($curpage=='product.php'){ ?>class="nav-active" <?php } ?> ><img src="images/product.png" border="0" alt="Products" title="Products" />Products</a></li>
    <li><a href="contact.php" <?php if($curpage=='contact.php'){ ?>class="nav-active" <?php } ?>><img src="images/contact.png" border="0" alt="Contact" title="Contact" />Contact</a></li>
    </ul>
    
</div>
</div>

<!-- Content -->

<div id="container">
<?php main(); ?>
</div>


<script type="text/javascript">
function chkField(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>


</body>
</html>