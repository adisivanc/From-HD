<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>


</head>
<body>


<?php
$cars = array("Volvo", "BMW", "Toyota", 2);
echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".";
?>
 
<br/> <br/>

<?

print_r($cars);

?> 


<br/> <br/>

<?

var_dump($cars);

?> 


</body>
</html>
