<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

</head>
<body>

<h1>This is a heading in body</h1>
<p>The first paragraph in body.</p>
<p>The second paragraph in body.</p>

<div style="border:1px solid;">
  <span>This is a span element in div</span>
  <p>The first paragraph in div.</p>
  <p>The second paragraph in another div.</p>
  <p>The last (third) paragraph in div.</p>
</div><br>

<div style="border:1px solid;">
  <p>The first paragraph in another div.</p>
  <p>The second paragraph in another div.</p>
  <p>The last (third) paragraph in another div.</p>
</div>

<p>The last (third) paragraph in body.</p>

<p>The last (third) paragraph in body.</p>



<script>

$(document).ready(function(){
    $("p:nth-of-type(3)").css("background-color", "yellow");
});

</script>



</body>
</html>