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
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</head>
<body onload="MM_preloadImages('image/dashborad_icon_small_mo.png','image/jobs_icon_mo.png','image/client_icon_mo.png','image/task_icon_mo.png','image/resource_icon_mo.png','image/quotation_icon_mo.png','image/payment_icon_mo.png','image/settings_icon_mo.png','image/logout_icon_mo.png')">

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
                <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','image/dashborad_icon_small_mo.png',1)" class="menuitem menu_active">
                    <img src="image/dashborad_icon_small.png" name="Image1" width="20" height="14" border="0" id="Image1" /><span class="menuname">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','image/jobs_icon_mo.png',1)" class="menuitem">
                	<img src="image/jobs_icon.png" name="Image2" width="19" height="17" border="0" id="Image2" /><span class="menuname">Jobs</span>
                </a>
            </li>
            <li>
            	<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','image/client_icon_mo.png',1)" class="menuitem">
                	<img src="image/client_icon.png" name="Image3" width="20" height="12" border="0" id="Image3" /><span class="menuname">Clients</span>
                </a>
            </li>
            <li>
                <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','image/task_icon_mo.png',1)" class="menuitem">
                    <img src="image/task_icon.png" name="Image4" width="12" height="16" border="0" id="Image4" /><span class="menuname">Tasks</span>
                </a>
            </li>
            <li>
            	<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','image/resource_icon_mo.png',1)" class="menuitem">
                	<img src="image/resource_icon.png" name="Image5" width="15" height="14" border="0" id="Image5" /><span class="menuname">Resources</span>
                </a>
            </li>
            <li>
            	<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image13','','image/quotation_icon_mo.png',1)" class="menuitem">
                	<img src="image/quotation_icon.png" name="Image13" width="14" height="14" border="0" id="Image13" /><span class="menuname">Quotation</span>
                </a>
            </li>
            <li>
            	<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','image/payment_icon_mo.png',1)" class="menuitem">
                	<img src="image/payment_icon.png" name="Image6" width="14" height="14" border="0" id="Image6" /><span class="menuname">Payment</span>
                 </a>
            </li>
            <li>
            	<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','image/calendar_icon_mo.png',0)" class="menuitem">
                	<img src="image/calendar_icon.png" name="Image7" width="14" height="14" border="0" id="Image7" /><span class="menuname">Calendar</span>
                </a>
            </li>
            <li>
            	<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','image/settings_icon_mo.png',1)" class="menuitem">
                	<img src="image/settings_icon.png" name="Image8" width="15" height="15" border="0" id="Image8" /><span class="menuname">Settings</span>
                </a>
            </li>
            <li>
            	<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','image/logout_icon_mo.png',1)" class="menuitem">
                	<img src="image/logout_icon.png" name="Image9" width="14" height="16" border="0" id="Image9" /><span class="menuname">Logout</span>
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
	$('.menuitem').removeClass('menu_active');
	$(this).addClass('menu_active');	
});


</script>



</body>
</html>