<?
include "includes.php";
ob_start();
session_start();

unset($_SESSION['user_email']);
unset($_SESSION['user_type']);
/*UserLog::updateUserLogDtls(array('father_email'=>$_SESSION['user_email'], 'tableName'=>TBL_STUDENTS, 'father_email'=>$_SESSION['user_email'], 'user_type'=>$_SESSION['user_type']), $updatedData, "Logout", "", "Student ".trim($_SESSION['user_email'])." (#".$_SESSION['studentId'].") Logged Out. ");
foreach($_SESSION as $K=>$V){
	unset($_SESSION[$K]);
}*/
session_destroy();
session_unset();
?><script type="text/javascript">window.location.href='index.php';</script> <?
//header("location:index.php");
exit();
?>

