<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

</head>
<body>


<div id="frt">Hello</div>
 
 <input type="text" class="" id="m_phone_1" name="m_phone_1" value="" onkeyup="if(this.value.length==3) document.getElementById('m_phone_2').focus()" onkeypress="return isNumberKey(event)" />
 <input type="text" class="" id="m_phone_2" name="m_phone_2" value="" onkeyup="if(this.value.length==3) document.getElementById('m_phone_3').focus()" onkeypress="return isNumberKey(event)" />
 
 
<script type="text/javascript">


function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	
	return true;
} 

</script>

</body>
</html>