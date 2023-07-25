<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

<style>

.subclass { display:none; }


.click_hello { border:1px solid red; }

</style>


</head>
<body>


<div style="width:200px; float:left; background-color:#dddddd;">
	<div id="click_hello">Hello</div>
    <ul class="subclass">
        <li>Hai</li>
        <li>Good Morn</li>
    </ul>
</div>



<script type="text/javascript">


$("#click_hello").click(function(e) {
	if($(e.target).is('div')){
		$('.subclass').slideToggle();
		e.preventDefault();
		return;
	}
	else
	{
		alert("woohoo!");
	}
}); 


</script>



</body>
</html>
