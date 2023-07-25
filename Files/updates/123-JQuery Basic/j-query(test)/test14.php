<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>


<style> 
.full_width { width:100%; float:left; }
</style>
</head>
<body>

 
<div style="width:120px; font-size:20px; background:#06F; color:#FFFFFF; cursor:pointer;" id="click">Click here</div>


<p class="output_here"></p>

<script type="text/javascript">

$('#click').click(function() {

	var d="1";
	var r=parseInt(d);
	document.getElementsByClassName('.output_here').innerHTML;	
	
});

</script>



</body>
</html>