<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>


</head>
<body>

<div id="clickme">
Click here
</div>
<img id="book" src="images/8.jpeg" alt="" width="100" height="63" style="position: relative; left: 10px;">




<script type="text/javascript">

$(document).ready(function() {
	$("#book" ).animate({
	opacity: 0.25,
	left: "+=50",
	height: "toggle"
	}, 5000, function() {
	
		$('#book').css({'width':'150px'},{'height':'90px'});
	
	});
});

</script>



</body>
</html>
