<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

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


<script type="text/javascript">
	$(function() {
	$('div.caption img').click(function(){
	var body$ = $(this).closest('div.module').find('div.body');
	if (body$.is(':hidden')) {
	body$.show();
	}
	else {
	body$.hide();
	}
	});
	});
</script>

<style type="text/css">

#social1 { background:url(img/images5.jpeg) no-repeat; display:block; height:36px; width:36px; transition: all ease-in 2s; }

/*#social1:hover { background:url(img/index5.jpg) no-repeat; }*/

</style>









</head>

<body onload="MM_preloadImages('img/index4.jpeg')" class="plain">


<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','img/index4.jpeg',1)"><img src="img/images5.jpeg" name="Image1" width="36" height="36" border="0" id="Image1" /></a>



<table width="400" border="1" cellspacing="0" cellpadding="20" style="margin-top:50px;">
  <tr>
    <td><a href="#" id="social1"></a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


<div class="module">
<div class="caption">
<span>Module Caption</span>
<img src="rollup.gif" alt="rollup" title="rolls up this module"/>
</div>
<div class="body">
Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
Aliquam eget enim id neque aliquet porttitor. Suspendisse
nisl enim, nonummy ac, nonummy ut, dignissim ac, justo.
Aenean imperdiet semper nibh. Vivamus ligula. In in ipsum
sed neque vehicula rhoncus. Nam faucibus pharetra nisi.
Integer at metus. Suspendisse potenti. Vestibulum ante
ipsum primis in faucibus orci luctus et ultrices posuere
cubilia Curae; Proin quis eros at metus pretium elementum.
</div>
</div> 


<script type="text/javascript">

$('#social1').mouseover(function(){
	$(this).css({'background-image':'url(img/index5.jpg)'}).slideDown('slow');
});

$('#social1').mouseout(function(){
	$(this).css('background-image','url(img/images5.jpeg)').slideUp('slow');
});

</script>


</body>
</html>