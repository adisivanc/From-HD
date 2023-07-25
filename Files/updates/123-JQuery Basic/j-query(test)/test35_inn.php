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
table tr td { padding:7px; }
.full_width { width:100%; float:left; background-color:#dddddd; }

</style>

</head>
<body>


<div class="full_width" >
	<input type="text" id="paying_method" name="paying_method" value=""  />
    
    <input type="button" value="Submit" onclick="setPaymentType()"  />
    
    
    <p id="parag"></p>

</div>


<div style="width:150px; background:#0CF; text-align:center; padding:10px 0; margin:40px 0 0 20px; float:left; box-shadow:-15px 0px 0px #555555; transform: rotate(20deg); ">Hello</div>


<script type="text/javascript">


function setPaymentType(){
	
	var a = $('input[name=paying_method]').val();
	
	document.getElementByTagName(p).innerHTML = a;
	
}

</script>



</body>
</html>
