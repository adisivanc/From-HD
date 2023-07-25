<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="../js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.8.11.custom.js" type="text/javascript"></script>
<link rel="stylesheet" href="../css/jquery-ui-1.8.11.custom.css" type="text/css" />

<style>

 .ui-widget-header {
	background:#b9cd6d;
	border: 1px solid #b9cd6d;
	color: #FFFFFF;
	font-weight: bold;
 }
 .ui-widget-content {
	background: #cedc98;
	border: 1px solid #DDDDDD;
	color: #333333;
 }
 #resizable { width: 150px; height: 150px; padding: 0.5em;
	text-align: center; margin: 0; }
	
#alsoresize { width: 170px; height: 170px; background:#f7f7f7; }
	
	
</style>


      
</head>

<body>

<div id="alsoresize">
    <div id="resizable" class="ui-widget-content"> 
     <h3 class="ui-widget-header">Pull my edges to resize me!!</h3>
    </div>
</div>
      

<script type="text/javascript">

 $(function() {
	$( "#alsoresize" ).resizable({ alsoResize:'#resizable' });
 });
 
</script>
      
      
</body>
</html>