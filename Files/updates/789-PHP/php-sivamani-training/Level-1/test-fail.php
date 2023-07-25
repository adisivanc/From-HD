<?php

// Create connection
$conn = mysqli_connect('localhost', 'root', 'mysql');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully <br/>";


$conn->close() ; 

echo "Connection Closed";

mysql_select_db('training',$conn);


$name='ASN';
$dob='30/05/1990';
$comments='Nothing';
$mobile='96524554554555';


$query="insert into tb_adi (name,dob,comments,mobile) values('".$name."','".$dob."','".$comments."','".$mobile."')";
echo $query;
mysql_query($query);



?> 


<br/>

<?

$query="select * from tb_adi";
$select=mysql_query($query);

?>

<br/>
