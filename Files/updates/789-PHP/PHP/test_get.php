<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>


</head>
<body>




<div style="width:99%; float:left; border:1px solid red;">

<form action="" method="get">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>


</div>



<div style="width:100%; float:left;">

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><? echo $_REQUEST['name']; ?></td>
  </tr>
  <tr>
    <td><? echo $_REQUEST['email']; ?></td>
  </tr>
</table>


</div>

</body>
</html>
