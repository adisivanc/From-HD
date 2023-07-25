<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

</head>
<body>



<p>The first paragraph in body.</p>

<div style="border:1px solid;">
  <p>The first paragraph in div.</p>
  <p>The last paragraph in div.</p>
</div><br>

<div style="border:1px solid;">
  <span>This is a span element.</span>
  <p>The first paragraph in another div.</p>
  <p>The last paragraph in another div.</p>
</div>

<p>The last paragraph in body.</p>


<script>
$(document).ready(function(){
    $("p:last-of-type").css("color", "#FF0000");
});
</script>



</body>
</html>
