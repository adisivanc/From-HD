<?

$link=mysql_connect('localhost','root','mysql') or die('database not connected');

mysql_select_db('training',$link);


?>
<br/>

<?php

$name=$_POST["name"];
$email=$_POST["email"];
$subject=$_POST["subject"];
$message=$_POST["message"];

if( $_POST["name"] || $_POST["email"] || $_POST["subject"] || $_POST["message"] )
{
	$query="insert into tb_sivabalan (name,email,subject,message) values('".$name."','".$email."','".$subject."','".$message."')";
	mysql_query($query);
}
  
$query="select * from tb_sivabalan";
$select=mysql_query($query);

?>
<br/>
<?

if($numrows=mysql_num_rows($select))
{
	while($obj=mysql_fetch_array($select))
	{
		echo $obj[1];
	}
}

?>


<html>
<body>
  <form action="<?php $_PHP_SELF ?>" method="POST">
      Name: <input type="text" name="name" />
      email: <input type="text" name="email" />
      subject: <input type="text" name="subject" />
      message: <input type="text" name="message" />
      <input type="submit" />
  </form>
</body>
</html>

