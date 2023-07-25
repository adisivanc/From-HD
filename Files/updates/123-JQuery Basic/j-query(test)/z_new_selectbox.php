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



<select id="media" name='media'>
	<option value="1">1</option>
    <option value="2">2 </option>
    <option value="3">3</option>
</select>


<div style="width:50px; height:20px; background:#f3f3f3; cursor:pointer;" id="button_sm">submit</div> 
 
 
<script type="text/javascript">

$('#media').on('change', function() {
	alert($('#media').val());// or $('#media').val();        
});

</script>

</body>
</html>