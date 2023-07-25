<?php

$filename = "newfile.txt";
$file = fopen( $filename, "a+" );
if( $file == false )
{
   echo ( "Error in opening new file" );
   exit();
}
fwrite( $file, "AadhiSivaN" );


if( file_exists( $filename ) )
{
   $file = fopen( $filename, "a+" );
   $msg = "File  created with name $filename ";
   echo ($msg );
}

fclose( $file );

?>


<html>
<head>
<title>Writing a file using PHP</title>
</head>
<body>

</body>
</html>