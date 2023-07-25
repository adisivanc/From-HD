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

<div id="div1" style="height:100px;width:300px;padding:10px;margin:3px;border:3px solid blue;background-color:lightblue;"></div>


<div class="full_width" style="padding:60px 0 0 50px;">
    <button>Dimensions of div</button>
</div>
 
<script>
$(document).ready(function(){
  $("button").click(function(){
	  var txt=$('#div1').width();
	  var txt1=$('#div1').height();
	  alert(txt);
	  alert(txt1);
  });
});
</script>


</body>
</html>