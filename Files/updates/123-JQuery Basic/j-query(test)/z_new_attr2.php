<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>


<style>

#new_name { width:150px; height:30px; border:1px solid #dab791; margin-bottom:15px }

</style>



</head>
<body>



<input type="text" id="hello_id" class="hello_class" name="hello_name" value="25" />

<div style="width:50px; height:20px; background:#f3f3f3; cursor:pointer;" id="button_sm"></div> 
 
 
<script type="text/javascript">

alert($('input').attr('value'));


$("#button_sm").click(function()
{
	$('input').attr('value', '36');
	alert($('input').attr('value'));
});

</script>

</body>
</html>