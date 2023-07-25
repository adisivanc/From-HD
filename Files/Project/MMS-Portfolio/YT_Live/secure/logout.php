<?
include "includes.php";
ob_start();
session_start();
UserLog::updateUserLogDtls(array('tableId'=>$_SESSION['YTUserId'], 'tableName'=>TBL_USERS, 'tableMasterId1'=>$_SESSION['YTUserId'], 'userId'=>$_SESSION['YTUserId'], 'userType'=>$_SESSION['YTUserType']), $_SESSION['YTUserName'], $updatedData, "Logout", "", "User ".trim($_SESSION['YTUserName'])." (#".$_SESSION['YTUserId'].") Logged Out. ");
foreach($_SESSION as $K=>$V){
	unset($_SESSION[$K]);
}
session_destroy();
session_unset();
?><script type="text/javascript">window.location.href='index.php';</script> <?
//header("location:index.php");
exit();
?>

