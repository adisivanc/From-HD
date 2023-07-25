<?
$link=mysql_connect('localhost','root','mysql') or die('database not connected');
mysql_select_db('training',$link);
//mysql_query("insert,select,del,update");
//	id	name	email	subject	message
?>
<html>
	<body>
    <?

$query="select * from tb_sivabalan";
$select=mysql_query($query);

if($numrows=mysql_num_rows($select))
{
	while($obj=mysql_fetch_object($select))
	{
		?>
		<p><?=$obj->name?></p>
        <?
	}
}

?>
    	
    </body>
</html>
