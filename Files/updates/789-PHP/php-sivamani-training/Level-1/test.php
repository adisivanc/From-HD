<?

$link=mysql_connect('localhost','root','mysql') or die('database not connected');

mysql_select_db('training',$link);

//mysql_query("insert,select,del,update");
//	id	name	email	subject	message

$name='x';
$email='x@x.com';
$subject='test';
$message='test message';

$query="insert into tb_sivabalan (name,email,subject,message) values('".$name."','".$email."','".$subject."','".$message."')";
echo $query;
mysql_query($query);

?>

<br/>

<?

$query="select * from tb_sivabalan";
$select=mysql_query($query);

?>

<br/>

<?


if($numrows=mysql_num_rows($select))
{
	while($obj=mysql_fetch_array($select))
	{
		echo $obj[1]."<br/>";
	}
}

?>