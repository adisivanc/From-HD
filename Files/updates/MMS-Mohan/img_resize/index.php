<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Image Resize</title>
</head>

<body>

<?

function doEncode($str){
	return str_replace("=", "", base64_encode($str)) ;
}


?>


	<img src="images/dr_umesh.jpg" border="0" />
    
    <img src="resize.php?f=<?=doEncode(images/dr_umesh.jpg)?>&rw=100&rh=100" />






</body>
</html>