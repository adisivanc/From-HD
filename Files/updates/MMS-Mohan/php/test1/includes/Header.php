<?
function redirectUrl($PageUrl){
	ob_clean();	
	header("Location:".$PageUrl);
	exit();
}
?>