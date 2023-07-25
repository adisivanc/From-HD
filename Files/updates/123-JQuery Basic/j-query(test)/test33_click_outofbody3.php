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




.full_width { width:200px; float:left; background-color:#dddddd; }

</style>


</head>
<body>


<div class="full_width" onclick="show_menu(1)">
	<div class="click_hello" onclick="show_menu(2)">Hello</div>
    <ul class="subclass" id="subclass">
        <li>Hai</li>
        <li>Good Morn</li>
    </ul>
</div>



<script type="text/javascript">

function show_menu(val)
{
	if(val==2)
	{
		event.stopPropagation();

				$('.subclass').slideToggle();
		
	}
	else
	{
		$('.subclass').slideDown();
		event.stopPropagation();

	}
}


</script>



</body>
</html>
