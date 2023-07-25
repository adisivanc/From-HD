<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Conference Logistics</title>

<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


</head>

<body>


<script type="text/javascript">

/*$(document).ready(function(){
	
   $([window, document]).focus(function(){
	  document.title = 'Conference Logistics';
   }).blur(function(){
	  setTimeout(function() { document.title = 'Please Come Back We lost You !'; }, 2000);
   });
   
});
*/



$(document).ready(function(){
	
   $([window, document]).on("focus focusin load",function(){
	  document.title = 'Conference Logistics';
   }).on("blur focusout",function(){
	  setTimeout(function() { document.title = 'Please Come Back We lost You !'; }, 2000);
   });
   
});







</script>

</body>
</html>