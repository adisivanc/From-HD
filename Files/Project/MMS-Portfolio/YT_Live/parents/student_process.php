<?
include "includes.php";

if($_POST['act']=='getDashboard') {
ob_clean();
include "student_dashboard.php";
exit();	
}


if($_POST['act']=='student_screen') {
ob_clean();
$studentId = $_POST['student_id'];
//echo $studentId;
$rs_student=Student::getStudentById($studentId);
//$studentName = $_SESSION['students'][$studentId]['name'];
$studentName=($rs_student->first_name).($rs_student->middle_name).($rs_student->last_name);
//$gradeName = $_SESSION['students'][$studentId]['grade_name'];
//$gradeId = $_SESSION['students'][$studentId]['grade_id'];
$gradeId =$rs_student->grade_id;
$rs_Grade=Grade::getGradeById($gradeId);
$gradeName=$rs_Grade->grade_name;
//print_r($gradeName);
include "student_dashboard.php";
exit();	
}
if($_POST['act']=="student_basicDetail")
{
	ob_clean();
	$studentId = $_POST['student_id'];
	//echo $studentId;
	$rs_student=Student::getStudentById($studentId);
	//$studentName = $_SESSION['students'][$studentId]['name'];
	$studentName=($rs_student->first_name)." ".($rs_student->middle_name)." ".($rs_student->last_name);
	//$gradeName = $_SESSION['students'][$studentId]['grade_name'];
	//$gradeId = $_SESSION['students'][$studentId]['grade_id'];
	$gradeId =$rs_student->grade_id;
	$rs_Grade=Grade::getGradeById($gradeId);
	$gradeName=$rs_Grade->grade_name;
	include "student_basicdetail.php";	
	exit();
}

if($_POST['act']=='getCommunication') {
ob_clean();
$studentId = $_POST['student_id'];
//$studentName = $_SESSION['students'][$studentId]['name'];
//$gradeName = $_SESSION['students'][$studentId]['grade_name'];
$rs_student=Student::getStudentById($studentId);
$studentName=($rs_student->first_name).($rs_student->middle_name).($rs_student->last_name);
$gradeId =$rs_student->grade_id;
$userType=$_SESSION[user_type];
include "communications.php";	

exit();	
}
if($_POST['act']=='getSCalendar') {
ob_clean();
$studentId = $_POST['student_id'];
//$studentName = $_SESSION['students'][$studentId]['name'];
//$gradeName = $_SESSION['students'][$studentId]['grade_name'];
$rs_student=Student::getStudentById($studentId);
$studentName=($rs_student->first_name).($rs_student->middle_name).($rs_student->last_name);
$gradeId =$rs_student->grade_id;
$userType=$_SESSION[user_type];
include "calendar.php";	
?>
<script>displayCalendar('<?=$rs_student->school_id?>','','','<?=$gradeId?>','<?=$studentId?>');</script>
<?
exit();	
}


if($_POST['act']=='getDiary') {
ob_clean();
$studentId = $_POST['student_id'];
//$studentName = $_SESSION['students'][$studentId]['name'];
//$gradeName = $_SESSION['students'][$studentId]['grade_name'];
$rs_student=Student::getStudentById($studentId);
$studentName=($rs_student->first_name).($rs_student->middle_name).($rs_student->last_name);
$gradeId =$rs_student->grade_id;
$userType=$_SESSION[user_type];
include "student_diary.php";
exit();	
}
if($_POST['act']=="student_recentActitvity")
{
ob_clean();
$studentId = $_POST['student_id'];
$rs_student=Student::getStudentById($studentId);
$gradeId =$rs_student->grade_id;
include  "recent_activity.php";
exit();	
}
if($_POST['act']=="getComingUp")
{
ob_clean();

$studentId = $_POST['student_id'];
$rs_student=Student::getStudentById($studentId);
$gradeId =$rs_student->grade_id;
include "student_comingup.php";
exit();	
}
if($_POST['act']=='getSubjects') {
ob_clean();
$gradeId = $_POST['grade_id'];
$student_id=$_POST['student_id'];
include "student_subject.php";
exit();	
}
if($_POST['act']=="getDownloads")
{	
	ob_clean();
		$gradeId = $_POST['grade_id'];
		$student_id=$_POST['student_id'];
		$params=array("grade_id"=>$gradeId."-STRING","visibility_type"=>"'P','PU','S'-IN");
        $rs_download=Download::getDownloads($params,'id','DESC');
		//echo count($rs_download);
		if($_POST['page']=='')
			$page=1;
		else
			$page = $_POST['page'];
		$totalReg = count($rs_download);
		if($_POST['page_limit']=="" || $_POST['page_limit']=="undefined") $PageLimit = 5; else $PageLimit = $_POST['page_limit'];
		$adjacents = 1;
		$totalPages= ceil(($totalReg)/($PageLimit));
		if($totalPages==0) $totalPages=1;
	    $StartIndex= ($page-1)*$PageLimit; 								
		if(count($rs_download)>0) $rs_downloadArr = array_slice($rs_download,$StartIndex,$PageLimit,true);
		if(count($rs_download)>0 && $totalPages > 1){ 
		$rsPagination = generatePagination("parentDownLoad", $totalReg, count($rs_downloadArr), $PageLimit, $adjacents, $page);
		}
		////		
		include "student_downloads.php";
	exit();	
}
if($_POST['act']=='getContact') {
ob_clean();
$studentId = $_POST['student_id'];
$rs_student=Student::getStudentById($studentId);
$studentName=($rs_student->first_name).($rs_student->middle_name).($rs_student->last_name);
$gradeId =$rs_student->grade_id;
include "student_contact.php";
exit();	
}

if($_POST['act']=='change_pwd') {
ob_clean();
$user_email = $_POST['user_email'];
include "changepassword.php";
exit();	
}

/*if($_POST['act']=="saveContact") {
	
	ob_clean();
	$studentId = $_POST['student_db_id'];
	
	extract($_POST);
	
	if($studentId!="" && $studentId!="undefined") {
		$rsDtl = Student::updateStudentContactDtls($student_db_id, $emer_number, $emer_name, $email_address, $emer_relation, $current_address, $current_state, $current_city, $current_zipcode, $is_parent, $father_name, $father_qualification, $father_employment, $father_nature_of_job, $father_annual_income, $father_phone, $father_email, $mother_name,$mother_qualification, $mother_employment, $mother_nature_of_job, $mother_annual_income, $mother_phone, $mother_email,$guardian_name);
		print_r($rsDtl);
		exit();
				
	}
}*/
/**************************Compose Here************************************************/
if($_POST['act']=='getComposeDiary') {
ob_clean();
$studentId = $_POST['student_id'];
$user_type=$_SESSION[user_type];
$rs_student=Student::getStudentById($studentId);
//$studentName=($rs_student->first_name).($rs_student->middle_name).($rs_student->last_name);
$gradeId =$rs_student->grade_id;
include "student_compose_diary.php";
exit();	
}

if($_POST['act']=='sendStudentDiary') {
ob_clean();
$studentId = $_POST['student_id'];
$sendby="";
$user_type=$_SESSION[user_type];
if($user_type=='M')
{
$sendby='S-M';
}
else
{
$sendby='S-F';
}
$subject=$_POST['subject'];
$message=$_POST['message'];
$replyto=$_POST['sentby'];
//print_r($studentId.$user_type.$subject.$message.$sentby);
$rs_id=StudentDiary::insertStudentDiary($studentId,$subject,$message,$sendby,$studentId,$replyto);
//$rs_id=StudentDiary::insertStudentDiary(1,"test","test",'S-M',"ss","CT");
//print_r($rs_id);
include "student_diary.php";
exit();	
}
/**************************Compose Here************************************************/
if($_POST['act']=="loadReminder")
{
	ob_clean();
		$param=array('id'=>$_POST['id']);
		$rs_calendar=Calendar::getCalendarEvent($param);
		if(count($rs_calendar)>0)
		{
		?>
		<table width="100%" cellpadding="0" style="color:#666666; font-weight:bold; text-indent:10px; font-size:16px; border:#9FC6CC" cellspacing="1" border="1" >
		<?
			foreach($rs_calendar as $K=>$V)
			{
				?>
                	<tr><td width="50%">Event Date</td> <td width="50%"> <?=$V->event_date?></td></tr>
                	<tr><td>Event Name</td> <td> <?=$V->event_name?></td></tr>
                    <tr><td>Event Description</td><td><?=$V->event_desc?></td></tr>
                <?		
			}
		?>
	    </table>
		<?	
		}
	exit();	
}
if($_POST['act']=="saveLeaveApplication")
{
	ob_clean();
	//print_r($_POST);
	//	id	student_id	leave_date	reason	status
	$student_id=$_POST['studentId'];		
	$reason=$_POST['leaveReason'];
	$school_id=$_POST['school_id'];
	$added_by=$_SESSION['user_type'];
	$added_email=$_SESSION['user_email'];
	$leaveFromDate = date('Y-m-d',strtotime($_POST['leaveFromDate']));	
	if($_POST['leaveOption']!='S' && $_POST['leaveToDate']!='') {		
		$leaveToDate = date('Y-m-d',strtotime($_POST['leaveToDate']));
		$aryDates = createDateRangeArray($leaveFromDate,$leaveToDate);
		foreach($aryDates as $dates){
			$postArrs = array('student_id'=>$student_id,'leave_date'=>$dates,'reason'=>$reason,'status'=>'P','added_by'=>$added_by,'added_email'=>$added_email,'school_id'=>$school_id);	
	      	$rs_studentLeave=LeaveApply::insertStudentLeave($postArrs);
		}
	}
	else {		
		$postArrs = array('student_id'=>$student_id,'leave_date'=>$leaveFromDate,'reason'=>$reason,'status'=>'P','added_by'=>$added_by,'added_email'=>$added_email,'school_id'=>$school_id);
		$rs_studentLeave=LeaveApply::insertStudentLeave($postArrs);
	}
	echo "saveLeaveApplication";
	exit();
}
if($_POST['act']=="showCalendarDetail")
	{
	ob_clean();	
	$param=array('id'=>$_POST['id']);
	$rs_calendar=Calendar::getCalendarEvent($param);
	
	?>
    
    
    
    
    
    
    <table width="550" border="0" cellspacing="0" cellpadding="0" class="event_popouter_tbl">
      <tr>
        <td class="event_pop_header">
        	<strong>Event Details</strong>
            <span style="float:right;" class="cursor" onclick="close_leave_application()"><strong>X</strong></span>
        </td>
      </tr>
     <?
        if(count($rs_calendar) > 0) {
        foreach($rs_calendar as $K=>$V)
        {
        ?>
      <tr>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="event_popinner_tbl">
              <tr>
                <td width="95">Name</td>
                <td><?=$V->event_name?></td>
              </tr>
              <tr>
                <td>Description</td>
                <td><?=$V->event_desc?></td>
              </tr>
            </table>

        </td>
      </tr>
      <tr>
        <td width="100%" valign="top">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="event_popinner_tbl">
              <tr>
                <td width="110">Date</td>
                <td><?
            	    $timestamp = strtotime($V->event_date);
					$formattedDate = date('F d, Y', $timestamp);
					echo $formattedDate;
					?></td>
              </tr>
              <? if($V->event_time=='T' && $V->from_time!='' && $V->to_time!='') { ?>
              <tr>
                <td>Time</td>
                <td><? echo $V->from_time?></td>
              </tr>
              <?
			  }
			  ?>
            </table>
        </td>
      </tr>
      <tr>
        <td valign="top">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="event_popinner_tbl">
              <tr>
                <td width="110">Location</td>
                <td>
                <?
				$schoolArr=explode(',',$V->school_id);
				$execution=0;
				foreach($schoolArr as $SV)
				{
					if($execution>0) echo " ,";
					$school_obj=new School();
					$school_obj->id=$SV;
					$rs_school=$school_obj-> getSchoolDtls();
					echo $rs_school->school_name;
					$execution++;
				}
				?>
                
                </td>
              </tr>
            </table>
        </td>
      </tr>
      <?
		}
		}
	
	  ?>
    </table>
     
<?
exit();
}
if($_POST['act']=="cancelStudentLeave"){
	
	ob_clean();
	$timestamp = strtotime($_POST['event_date']);
	$formattedDate = date('F d, Y', $timestamp);
	$id=$_POST['id'];
	$param=array('id'=>$_POST['id']);
	$rs_stuLev=LeaveApply::getStudentLeave($param);
	//print_r($rs_stuLev);
	?>
<table width="500" border="0" cellspacing="0" cellpadding="0" style="margin:10px auto;" class="table_pop">
              <tr>
                <td colspan="2" style="border-bottom:1px solid #eec290; background:url(images/menu_bg.jpg); line-height:32px; color:#FFFFFF;">
                    <div class="pull_left" style="text-indent:10px;"><?=$formattedDate?></div>
                    <div class="pull_right cursor" onclick="close_leave_application()">X</div>
                </td>
              </tr>
              <?
			  foreach($rs_stuLev as $K=>$V)
			  {
			  ?>
              <tr>
              		<td>
                    Apply By
                    </td>
                    <td>
                    <? if($V->added_by=='M')
					{echo "Mother";	}
					elseif($V->added_by=='F')
					{echo "Father";
					}
					?>
                    </td>
              </tr>
              <tr>
              		<td>
                    Added Email Id
                    </td>
                    <td>
                    <?=$V->added_email?>
                    </td>
              </tr>
              <tr>
              		<td>
                    Reason 
                    </td>
                    <td>
                    <?=$V->reason?>
                    </td>
              </tr>
              <tr>
              	<td colspan="2" align="center">
                <div  style="border-bottom:1px solid #eec290; background:url(images/menu_bg.jpg); line-height16px; color:#FFFFFF; width:50%" onclick="deleteLeaveApplication(<?=$id?>)">CANCEL LEAVE</div>
                </td>
              </tr>
              <? }?>
   </table>
    <?
	exit();
	
	}
if($_POST['act']=="deleteLeaveApplication")
{
	$id=$_POST['id'];
	$rs_stuLev=LeaveApply::deleteStudentLeave($id);
	if(count($rs_stuLev)>0)
	{
		echo "Successfully Cancel The Leave";
		
	}
	else
	{
		echo "Unable To Cancel The Leave";	
	}
}
if($_POST['act']=="multipleDownload")
{
	ob_clean();
	$id=$_POST['id'];
	$rs_download=Download::getFileById($id);
	if(count($rs_download)>0)
	{
		$zip = new ZipArchive();
		$zip_name = $rs_download->filename.".zip";
		if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)
			{
				echo $error .=  "* Sorry ZIP creation failed at this time<br/>";
			}
		$filesArr=explode(',',$rs_download->files);
		if(count($filesArr)>0)
		{
			foreach($filesArr as $file){
				
				$zip->addFile(DOWNLOAD_FILE_HREF.$file,DOWNLOAD_FILE_HREF.$file);
				}
		}
		$zip->close();
		if(file_exists($zip_name))
			{
					// push to download the zip
					header('Content-type: application/zip');
					header('Content-Disposition: attachment; filename="'.$zip_name.'"');
					readfile($zip_name);
					// remove zip file is exists in temp path
					unlink($zip_name);
			}
	}
	exit();	
}
?>