<html>
<body>

<?php
  srand( microtime() * 10000 );
  $num = rand( 1, 4 );
   
  switch( $num ) 
  {
  case 1: $image_file = "/home/images/alfa.jpg";
          break;
  case 2: $image_file = "/home/images/ferrari.jpg";
          break;
  case 3: $image_file = "/home/images/jaguar.jpg";
          break;
  case 4: $image_file = "/home/images/porsche.jpg";
          break;
  }
  echo "$image_file <br/>";
  echo "Random Image : <img src='$image_file' alt='123' />";
?>

</body>
</html>