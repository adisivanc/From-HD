<?
	$PageUrlArr = explode('/',$_SERVER['SCRIPT_NAME']);
	$curpage=$PageUrlArr[3];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TREE</title>

<link rel="stylesheet" type="text/css" href="css/secure_style.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />

<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>

<style> 
.boxred { border:1px solid #FF0000; } 
.textred { color:#ff0000; } 
</style>
</head>
<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:2px solid #c6c5c5;">
  <tr style="background:#47755e;">
    <td width="230" height="105" align="center"><img src="image/mastermid_logo.jpg" border="0" width="190" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr style="background:#c6c5c5; height:30px; line-height:30px;">
    <td width="230"><span style="margin-left:20px;">NAVIGATION</span></td>
    <td><span class="margin_left20"><img src="image/home_icon.png" border="0" /></span> > Dashboard</td>
  </tr>
  <tr>
    <td style="background:#c6c5c5;" width="230" valign="top">
    
        <ul class="nav_menu">
            <li>
                <a href="dashboard.php" id="menu_dashboard" class="menuitem <?=($curpage=='dashboard.php')?'active':''?>">
                    <span class="menuname">Dashboard</span>
                </a>
            </li>
            <li>
                <a id="menu_jobs" class="menuitem <?=($curpage=='jobs.php')?'active':''?>">
                    <span class="menuname">Jobs <span class="nav_arrow <?=($curpage=='jobs.php')?'uparrow':''?>"></span></span>
                </a>
                
                <div class="submenu" style="display:<?=($curpage=='jobs.php')?'block':'none'?>">
                	<a href="jobs.php" class="submenuitem"><img src="image/arrow_submenu.png" border="0" /> <span class="menuname">Add Job</span></a>
	                <div class="submenuitem"><img src="image/arrow_submenu.png" border="0" /> <span class="menuname">Add Job Type</span></div>
                </div>
            </li>
            <li>
            	<a id="menu_clients" class="menuitem <?=($curpage=='clients.php')?'active':''?>">
                    <span class="menuname">Clients <span class="nav_arrow <?=($curpage=='clients.php')?'uparrow':''?>"></span></span>
                </a>
                
                <div class="submenu" style="display:<?=($curpage=='clients.php')?'block':'none'?>">
                	<a href="clients.php" class="submenuitem"><img src="image/arrow_submenu.png" border="0" /> <span class="menuname">Add Job</span></a>
	                <div class="submenuitem"><img src="image/arrow_submenu.png" border="0" /> <span class="menuname">Add Job Type</span></div>
                </div>
            </li>
            <li>
                <a id="menu_tasks" class="menuitem">
                    <span class="menuname">Tasks <span class="nav_arrow"></span></span>
                </a>
                
                <div class="submenu">
                	<a href="jobs.php" class="submenuitem"><img src="image/arrow_submenu.png" border="0" /> <span class="menuname">Add Job</span></a>
	                <div class="submenuitem"><img src="image/arrow_submenu.png" border="0" /> <span class="menuname">Add Job Type</span></div>
                </div>
                
            </li>
            <li>
            	<a id="menu_resource" class="menuitem">
					<span class="menuname">Resources</span>
                </a>
            </li>
            <li>
            	<a id="menu_quotation" class="menuitem">
                	<span class="menuname">Quotation</span>
                </a>
            </li>
            <li>
            	<a id="menu_payment" class="menuitem">
                	<span class="menuname">Payment</span>
                 </a>
            </li>
            <li>
            	<a id="menu_calendar" class="menuitem">
                	<span class="menuname">Calendar</span>
                </a>
            </li>
            <li>
            	<a id="menu_settings" class="menuitem">
                	<span class="menuname">Settings</span>
                </a>
            </li>
            <li>
            	<a id="menu_logout" class="menuitem">
                	<span class="menuname">Logout</span>
                </a>
            </li>
        </ul>
    
    </td>
    <td valign="top" style="background:#FFFFFF; height:600px;">
    <div style="padding:20px 20px;">
	<? main(); ?>
    </div>
    </td>
  </tr>
  <tr height="30"> 
    <td style="background:#c6c5c5;" width="230">&nbsp;</td>
    <td style="background:#FFFFFF; border-top:2px solid #c6c5c5; line-height:30px;"><span class="font14 margin_left20">@2014, Tree.com/ Mastermind. All Rights Reserved</span></td>
  </tr>
</table>


<script type="text/javascript">

$('.menuitem').click(function(){
	$('.menuitem').removeClass('active');
	$(this).addClass('active');
	
	$('.submenu').slideUp('slow');
	$(this).next('.submenu').slideToggle('slow');

	$('.nav_arrow').removeClass('uparrow');
	$(this).find('.nav_arrow').addClass('uparrow');
});

</script>

</body>
</html>