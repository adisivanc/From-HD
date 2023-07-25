<html>
<head>
<title>Reading a file using PHP</title>
</head>
<body>

<?php

$file_name="newfile.txt";
$file_open = fopen("$file_name",r);

if($file_open==false)
{
	echo "Error in opening a file";
}

$file_size= filesize("$file_name");
$file_txt = fread ($file_open, $file_size);

echo "$file_txt";


?>

</body>
</html>