<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

</head>
<body>


<div> 

<p>Transitional1</p>
<p>Transitional2</p>

</div>

<p>Transitional1</p>
<p>Transitional2</p>
<p>Transitional3</p>
 
 
<table width="400" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><p>Transitional 4</p> </td>
  </tr>
</table>


<p>Transitional 4</p> 
 
 
	<script type="text/javascript" language="javascript">
    
        $(document).ready(function() {
          $("div ~ p").css({"color":"#FFFFFF","background-color":"#656565"});
        });
    
    </script>
   
   
</body>
</html>