<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

</head>
<body>

 
<script type="text/javascript">
<!--
document.write("Entering the loop!<br /> ");
outerloop:   // This is the label name
for (var i = 0; i < 5; i++)
{
  document.write("Outerloop: " + i + "<br />");
  innerloop:
  for (var j = 0; j < 5; j++)
  {
     if (j >  3 ) break ;         // Quit the innermost loop
     if (i == 2) break innerloop; // Do the same thing
     if (i == 4) break outerloop; // Quit the outer loop
     document.write("Innerloop: " + j + "  <br />");
	 alert("i="+i);
   }
}
document.write("Exiting the loop!<br /> ");
//-->
</script>

</body>
</html>