<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>


</head>
<body>




<div style="width:100%; float:left; border:1px solid red;">

<form method="post" action="<? // echo $_SERVER['PHP_SELF'];?>">
   Name: <input type="text" name="fname" value="45">
   <input type="submit">
</form>

<?

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // collect value of input field
     $name = $_REQUEST['fname'];
     if (empty($name)) {
         echo "Name is empty";
     } else {
         echo $name;
     }
}

?>

</div>


</body>
</html>
