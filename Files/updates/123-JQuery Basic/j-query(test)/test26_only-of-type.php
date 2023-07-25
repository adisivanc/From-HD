<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Very important</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

</head>
<body>

    <div style="border:1px solid;">
      <p>The first paragraph.</p>
      <p>The last paragraph.</p>
    </div><br>
    
    <div style="border:1px solid;">
      <p>The only paragraph.</p>
    </div><br>
    
    <div style="border:1px solid;">
      <span>This is a span element.</span>
      <p>The only paragraph.</p>
    </div><br>



<script>
	
	$(document).ready(function(){
		$("p:only-of-type").css("background-color", "yellow");
	});
	
</script>


</body>
</html>
