<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>


<style>

.test { font-size:24px; color:#000000; }
.test.active { font-size:28px; color:#FF0000; }

</style>

</head>

<body>


<p class="test"> Hello world </p>

<p class="test"> Hello world Hello world </p>


<script type="text/javascript">

$(".test").click(function(){
	$('.test').fadeOut(500);
	$(this).fadeToggle(3000);
});



</script>

</body>
</html>