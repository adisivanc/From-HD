<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

<script type="text/javascript" language="javascript">

$(document).ready(function() {
	alert("df");  
	var element = document.getElementById("element-id");
	var rt=element.parentNode.nodeName;
	alert(rt);
	rt.remove();
});

</script>

</head>
<body>
   <div>
   	<p id="element-id">Click on any box to see the effect:</p>
   </div>
</body>
</html>