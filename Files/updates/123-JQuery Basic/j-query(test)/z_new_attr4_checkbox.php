<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>


<style>

#hello_id_yes[name='hello_name'] { transform:scale(1.5,1.5); margin:10px; }

</style>



</head>
<body>



<input type="radio" id="hello_id_yes" class="hello_class" name="hello_name" value="Yes" /> Yes

<input type="radio" id="hello_id_no" class="hello_class" name="hello_name" value="No" /> No

<div style="width:50px; height:20px; background:#f3f3f3; cursor:pointer;" id="button_sm"></div> 
 
 
<script type="text/javascript">


$("#button_sm").click(function()
{
	var value_input = $("input[name='hello_name']:checked").val();
	alert(value_input);
});

</script>

</body>
</html>