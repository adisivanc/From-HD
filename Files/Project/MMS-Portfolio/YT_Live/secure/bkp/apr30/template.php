<?
include 'includes.php';

if(!isset($_SESSION['YTUserId'])){ ?><script type="text/javascript">window.location.href="index.php";</script> <?
	//header('location: index.php');
	//exit();
}

$rs_user = User::getUserById($_SESSION['YTUserId']);


$PageUrlArr = explode('/',$_SERVER['SCRIPT_NAME']);
$curpage=$PageUrlArr[2];

// SET USER ACCESS TYPE
$accessType = explode(",", $rs_user->access_type);
$GLOBALS['isAdd'] = false;
$GLOBALS['isView'] = false;
$GLOBALS['isUpdate'] = false;
$GLOBALS['isDelete'] = false;
if(in_array("All", $accessType)) {  $GLOBALS['isAdd'] = true; $GLOBALS['isView'] = true; $GLOBALS['isUpdate'] = true; $GLOBALS['isDelete'] = true; }
if(in_array("A", $accessType)) { $GLOBALS['isAdd'] = true; }
if(in_array("V", $accessType)) { $GLOBALS['isView'] = true; }
if(in_array("U", $accessType)) { $GLOBALS['isUpdate'] = true; }
if(in_array("D", $accessType)) { $GLOBALS['isDelete'] = true; }


// SET USER MENU TYPE
$settingsMenuAccess=false; $newsletterMenuAccess=false; $userMenuAccess=false; $blogMenuAccess=false; $eventMenuAccess=false;
if($_SESSION['YTUserType']=="SA") {
	$settingsMenuAccess=true; $newsletterMenuAccess=true; $userMenuAccess=true; $blogMenuAccess=true; $eventMenuAccess=true;
}

// SET USER SCHOOL ACCESS TYPE

$GLOBALS['schoolAccess']=false;
$schoolIds=array();
if($rs_user->school_id=="All") {
	$schoolIds = School::getAllSchool(); 
	if(!empty($schoolIds)) {
		foreach($schoolIds as $sk=>$sv) {
			$GLOBALS['schoolAccess'][$sv->id]=true; 
		}
	}
} else {
	$schoolIds = explode(",",$rs_user->school_id);
	if(!empty($schoolIds)) {
		foreach($schoolIds as $sk=>$sv) {
			$GLOBALS['schoolAccess'][$sv]=true;
		}
	}
}

// SET USER SCHOOL GRADE ACCESS TYPE

$GLOBALS['gradeAccess']=false;
$schoolIds=array();
if($rs_user->grade_level=="All") {
	$grade_obj = new Grade();
	$grade_obj->fields="id";
	$gradeIds = $grade_obj->getGradeDtls(); 
	if(!empty($gradeIds)) {
		foreach($gradeIds as $gk=>$gv) {
			$GLOBALS['gradeAccess'][$gv->id]=true; 
		}
	}
} else {
	$gradeIds = explode(",",$rs_user->grade_level);
	if(!empty($gradeIds)) {
		foreach($gradeIds as $gk=>$gv) {
			$GLOBALS['gradeAccess'][$gv]=true;
		}
	}
}

if($_POST['act']=="setSchool"){
 	session_start();
	$_SESSION['YTSchoolId'] = $_POST['school_id'];
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>YT - Admin Panel</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/default_style.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />
<link rel="stylesheet" type="text/css" href="css/menumaker.css">

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>
<script src="js/menumaker.js"></script>

<script type='text/javascript' src='js/autocomplete/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='js/autocomplete/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="js/autocomplete/jquery.autocomplete_faculty.css" />


<style>
.boxerror { border:1px solid #F00; }
.errortxt { color:#F00; }
</style>

</head>
<body>

<div class="fullsize header_container padtb10 lineht2_7">
    <div class="menu_container txtwhite">
    	<div class="logo"> <img src="images/logo.png" alt="Yellow Train" /> </div>	
        <div class="pull_left f24 marginleft15"><strong>Yellow Train Grade School</strong></div>
        <div class="pull_right f18 margintop10">Welcome<strong> <?=strtoupper($_SESSION['YTUserName'])?></strong></div>
        
    </div>
    <!--<? 
	$school_idArr = explode(',',$rs_user->school_id);
	if($curpage!="grant_access.php" && count($school_idArr)>1 || $_SESSION['YTUserType']=="SA"){
		?>
        <div style="float:right; ">
         <select id="grant_access" name="grant_access" class="listbox" onchange="setSchoolValue(this.value);">
            <? if($_SESSION['YTUserType']=="SA" ){ ?>
            <option value="A"  <? if($_SESSION['YTSchoolId']=="A"){ echo "selected";}?>>All School</option>
            <? } ?>
            <?
            if(count($_SESSION['SchoolsArr'])>0) {
                foreach($_SESSION['SchoolsArr'] as $kk=>$vv) {
                    $rs_sch = School::getSchoolById($vv);
                ?>
                <option value="<?=$vv?>" <? if($_SESSION['YTSchoolId']==$rs_sch->id){ echo "selected";}?>><?=$rs_sch->school_name?></option>
                <?
                }
            }
            ?>
         </select>
        </div>
   <? }?>-->
    
    
    <div class="fullsize padtop10 lineht2 bdrtp_white margintop15">
        <div id="cssmenu">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li>
                    <a href="grade.php">Grades</a>
                    <!--<ul>
                        <li><a href="#">Grades 1</a></li>
                        <li><a href="#">Grades 2</a></li>
                        <li><a href="#">Grades 3</a></li>
                        <li><a href="#">Grades 4</a></li>
                    </ul>-->
                </li>
                <li><a href="teacher.php">Teachers</a></li>
                <? if($newsletterMenuAccess) { ?><li><a href="newsletter.php">Newsletter</a></li><? } ?>
                <? if($settingsMenuAccess) { ?>
                <li><a href="#">Settings</a>
                	<ul>
                        <li><a href="subjects.php">Subjects</a></li>
                        <li><a href="students.php">Students</a></li>
                        <li><a href="transport.php">Transport</a></li>
                    </ul>
                </li>
                <? } ?>
                <? if($userMenuAccess) { ?><li><a href="users.php">Users</a></li><? } ?>
                <? if($blogMenuAccess) { ?><li><a href="blogs.php">Blogs</a></li><? } ?>
                <? if($eventMenuAccess) { ?><li><a href="events.php">Events</a></li><? } ?>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    
</div>





<div class="fullsize_pad padtb20">
	<? main(); ?>
</div>




<script type="text/javascript">
	
function chkField(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 45 || charCode > 57))
	return false;
	
	return true;
}

function setSchoolValue(val){
 	ajax({
		a:'template',
		b:'act=setSchool&school_id='+val,		
		c:function(){},
		d:function(data){
			window.location.href = '<?=$curpage?>';
		}			
	});
}

</script>

<script type="text/javascript">
	$("#cssmenu").menumaker({
		title: "Menu",
		format: "multitoggle"
	});
</script>

</body>
</html>