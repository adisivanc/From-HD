<?
include 'includes.php';

if(!isset($_SESSION['YTUserId'])){ ?><script type="text/javascript">window.location.href="index.php";</script> <?
	//header('location: index.php');
	//exit();
}

$rs_user = User::getUserById($_SESSION['YTUserId']);



// SET USER MENU TYPE
$settingsMenuAccess=false; $newsletterMenuAccess=false; $userMenuAccess=false; $blogMenuAccess=false; $eventMenuAccess=false;$calendarMenuAccess=false;$teacherMenuAccess=false;
if($_SESSION['YTUserType']=="SA") {
	$settingsMenuAccess=true; $newsletterMenuAccess=true; $userMenuAccess=true; $blogMenuAccess=true; $eventMenuAccess=true;$calendarMenuAccess=true;$teacherMenuAccess=true;
}


// SET USER ACCESS TYPE
$accessType = explode(",", $rs_user->access_type);
$GLOBALS['isAdd'] = false;
$GLOBALS['isView'] = false;
$GLOBALS['isUpdate'] = false;
$GLOBALS['isDelete'] = false;
if(in_array("All", $accessType)) {  $newsletterMenuAccess=true;$GLOBALS['isAdd'] = true; $GLOBALS['isView'] = true; $GLOBALS['isUpdate'] = true; $GLOBALS['isDelete'] = true; }
if(in_array("A", $accessType)) { $newsletterMenuAccess=true;$GLOBALS['isAdd'] = true; }
if(in_array("V", $accessType)) {$newsletterMenuAccess=true; $GLOBALS['isView'] = true; }
if(in_array("U", $accessType)) {$newsletterMenuAccess=true; $GLOBALS['isUpdate'] = true; }
if(in_array("D", $accessType)) {$newsletterMenuAccess=true; $GLOBALS['isDelete'] = true; }
if($_SESSION['YTUserType']=="T" || $_SESSION['YTUserType']=="FO") {
	$calendarMenuAccess=true;
	$userId=$_SESSION['YTUserId'];
	$rs_teacher_access=User::getUserById($userId);
	$access_controlArr=explode(",",$rs_teacher_access->access_control);
		if(in_array("B",$access_controlArr))
		{
		$blogMenuAccess=true;	
		}
		if(in_array("E",$access_controlArr))
		{
		 $eventMenuAccess=true;	
		}
		if(in_array("N",$access_controlArr))
		{
		 $newsletterMenuAccess=true;	
		}
	
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

if($_POST['act']=="loadLogDtls") {
	ob_clean();
	$tableName = $_POST['tableName'];
	$tableId = $_POST['tableId']; if($tableId=="undefined") $tableId=''; else $tableId=$tableId;
	$userId = $_POST['userId']; if($userId=="undefined") $userId=''; else $userId=$userId;
	$masterTableId1 = $_POST['masterTableId1']; if($masterTableId1=="undefined") $masterTableId1=''; else $masterTableId1=$masterTableId1;
	$masterTableId2 = $_POST['masterTableId2']; if($masterTableId2=="undefined") $masterTableId2=''; else $masterTableId2=$masterTableId2;
	
	$tablesArr=array();
	$tables = explode(",", $tableName); if(!empty($tables)) foreach($tables as $kk=>$vv) $tablesArr[]="'".$vv."'";
	$tableNames = implode(",", $tablesArr);
	$log_obj = new UserLog();
	$log_obj->table_names=$tableNames;
	$log_obj->table_id=$tableId;
	$log_obj->user_id=$userId;
	$log_obj->table_master_id1=$masterTableId1;
	$log_obj->table_master_id2=$masterTableId2;
	$log_obj->orderby="added_date"; $log_obj->sortby="DESC";
	$rs_logs = $log_obj->getLogDetails();
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>Log Details</strong>
            <span onClick="closeTemplatePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2" style="width:100%; padding:0px;"><? include "log_details.php"; ?></td>
        </tr>
    </table>
	<?	
	exit();
}

if($_POST['act']=="loadLogsIndDtls") {
	ob_clean();
	$logId = $_POST['logId'];
	$rs_log = UserLog::getLogById($logId);
	$changesArr = explode("::", $rs_log->changes);
	?>
    <table border="0" width="100%" cellpadding="0" cellspacing="1" bgcolor="#E5F1FG">
    <? $index=0;
	if(!empty($changesArr) && count($changesArr)>0) {
		foreach($changesArr as $kk=>$vv) { $bgcolor="#f7f7f7"; if($index%2==0) $bgcolor="#FFFFFF";
		?>
		<tr bgcolor="<?=$bgcolor?>">
			<td colspan="2" width="100%"><?=$vv?></td>
		</tr>
		<? $index++;
		}
	}
	?>
    </table>
    <?
	exit();
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
    
    <div class="fullsize padtop10 lineht2 bdrtp_white margintop15">
        <div id="cssmenu">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li>
                    <a href="grade.php">Campus</a>
                </li>
                <? if($teacherMenuAccess){?><li><a href="teacher.php">Teachers</a></li><? } ?>
                <? if($newsletterMenuAccess) { ?><li><a href="newsletter.php">Newsletter</a></li><? } ?>
                <? if($settingsMenuAccess) { ?>
                <li><a href="#">Settings</a>
                	<ul>
                        <li><a href="subjects.php">Subjects</a></li>
                        <li><a href="students.php">Students</a></li>
                        <li><a href="transport.php">Transport</a></li>
                        <li><a href="downloads.php">Downloads</a></li>
                        <li><a href="mail_format.php">Mail Template</a></li>
                    </ul>
                </li>
                <? } ?>
                <? if($userMenuAccess) { ?><li><a href="users.php">Users</a></li><? } ?>
                <? if($blogMenuAccess) { ?><li><a href="blogs.php">Blogs</a></li><? } ?>
                <? if($eventMenuAccess) { ?><li><a href="events.php">Events</a></li><? } ?>
                <? if($calendarMenuAccess){?><li><a href="calendar.php">Calendar</a></li><? }?>
               
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    
</div>





<div class="fullsize_pad padtb20">
	<? main(); ?>
</div>
<div id="template_popup" style="display:none; margin:0px; padding:0px;"></div>



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

function popupTemplateDtls(data){
	
	$("#template_popup").show();
	if(data!="" && data!=undefined) $("#template_popup").html(data);
  	$("#template_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true,
		position: { 'my': 'center', 'at': 'top' }
	});
						
	$(".ui-widget-header").css({"display":"none"});
}

function closeTemplatePopup(){ $("#template_popup").dialog('close');  }

function showLogDetails(table_name, table_id, user_id, master_table_id1, master_table_id2) {
	
	$("#template_popup").dialog('open');
	$("#template_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
 	ajax({
		a:'template',
		b:'act=loadLogDtls&tableName='+table_name+'&tableId='+table_id+'&userId='+user_id+'&masterTableId1='+master_table_id1+'&masterTableId2='+master_table_id2,		
		c:function(){},
		d:function(data){
			popupTemplateDtls(data);
		}			
	});
	
}

function showLogsIndDtls(id) {
	
	$('.logtbl').removeClass('active');
	$('#logtbl_'+id).addClass('active');

	if($('#logsinddtlstr_'+id).is(':visible')) { 
		$('#logsinddtlstr_'+id).hide();
		$('#logsinddtlstab_'+id).html('');
		$('#logtbl_'+id).removeClass('active');
	} else { 
		$('.logsinddtlstr').hide();
		$('.logsinddtlstab').html('');
		$('#logsinddtlstr_'+id).show();
		$('#logsinddtlstab_'+id).html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
		ajax({
			a:'template',
			b:'act=loadLogsIndDtls&logId='+id,		
			c:function(){},
			d:function(data){
				$('#logsinddtlstab_'+id).html(data);
			}			
		});
	}
	
}


$("#cssmenu").menumaker({
	title: "Menu",
	format: "multitoggle"
});
</script>

</body>
</html>