<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.11.custom.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/jquery-ui-1.8.11.custom.css" type="text/css" />

<style>
	#draggable { width: 150px; height: 150px; padding: 0.5em; background:#cccccc;}
	#containment_outer { width:600px; height:600px; background:#f8f8f8; border:1px solid #dab791; }
</style>

    
</head>

<body>

<div id="containment_outer">
<div id="draggable" class="ui-widget-content">
    <p>Drag me !!!</p>
</div>   
</div>   
     
<script>
	$(function() {
	$( "#draggable" ).draggable(
		{ opacity: 0.5, revert: true, distance: 100 , cursor: "pointer", axis: "y" , containment: "parent"  /*, disabled: true*/ }
		);
	});
</script>  
     
      
</body>
</html>