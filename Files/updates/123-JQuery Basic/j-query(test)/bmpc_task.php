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

div { width:400px; float:left; clear:both; }
.t1 { background:#d7d7d7; }
.t2 { background:#d7d7d7; }

</style>

</head>

<body>

<div>
    <p class="t1"> Hello world </p>
    <p class="t2"> Hello world Hello world </p>
</div>


<div>
    <p class="t1"> Hello world </p>
    <p class="t2"> Hello world Hello world </p>
</div>





<script type="text/javascript">

$(".test").click(function(){
	 
	$('.test').removeClass('active');
	$(this).addClass('active');
	 
});


$(".test").dblclick(function(){
	 
	<!--$('.test').removeClass('active');-->
	$(this).removeClass('active');
	 
});

</script>

</body>
</html>