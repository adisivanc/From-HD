<?
require('includes.php');
$f = doDecode($_GET['f']) ;
$rw = $_GET['rw'] ;
$rh = $_GET['rh'] ;
$t = $_GET['t'] ;
if(fileExists($f)){
	ob_clean();
	//echo $f;
	if($t=='c')
		resizeCropForImgTag(array('src'=>$f, 'rw'=>$rw, 'rh'=>$rh));
	else
		resizeImageForImgTag(array('src'=>$f, 'rw'=>$rw, 'rh'=>$rh));
	exit();
}
?>