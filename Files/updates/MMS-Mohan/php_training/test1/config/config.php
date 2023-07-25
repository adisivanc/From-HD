<?

	// Database Connection 
	
	$con = mysql_connect('localhost','root','mysql') or die('Not Connected with DB! '.mysql_error());
	$dbSel = mysql_select_db('interview',$con); 

?>