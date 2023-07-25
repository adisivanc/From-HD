<?

// Database Connection

$conn = mysql_connect("localhost","root","mysql") or die(mysql_error()." Connection Not Established!");
mysql_select_db("int_test", $conn) or die(mysql_error()." DB Not Selected!");

?>