<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>


<style> 
.full_width { width:100%; float:left; }
</style>
</head>
<body>

 

<div class="array"></div>


<script type="text/javascript">

var x = [1, 2, 30, 4, 15];
   var s="fssfs";

for (var i = 0; i < x.length; i++) 
{
   // Do something with x[i];
   document.writeln(s.toUpperCase());
   document.writeln('<div style="height:10px;"></div>');
   document.writeln(s.substr(2,4));
   document.writeln('<div style="height:10px;"></div>');
   document.writeln(x.sort());
   document.writeln('<div style="height:10px;"></div>');
   document.writeln(x.reverse()); // get reversed and save in array
   document.writeln('<div style="height:10px;"></div>');
   document.writeln(x.reverse()); // Again it get reversed and save in array as normal
   document.writeln('<div style="height:100px;"></div>'); 
}

</script>



</body>
</html>