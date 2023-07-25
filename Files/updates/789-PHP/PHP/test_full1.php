<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>


<?php
class Car {
     function Car() {
         $this->model = "VW";
		 $this->mnnn = "123";
     }
}


// create an object
$herbie = new Car();

// show object properties
echo $herbie->model;

?>



<input type="text" value="<? $herbie->model ?>" class="" name="" />

<br/> <br/>


<input type="text" value="<? $herbie->mnnn ?>" class="" name="" />


</body>
</html>