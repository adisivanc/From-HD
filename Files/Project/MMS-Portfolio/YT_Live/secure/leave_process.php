<?
include 'includes.php';
if($_POST['act']=="showPendingdDetail")
{
	ob_clean();
	$type=$_POST['status'];
	if($type=='p'){$rs_stdlev=$_SESSION['result_pending']; $title="List Of Leave Applications";}
	if($type=='a'){$rs_stdlev=$_SESSION['result_approved']; $title="Approved List";}
	if($type=='r'){$rs_stdlev=$_SESSION['result_reject']; $title="Rejected List";}
	//pagignation 
	if($_POST['page']=='')
		$page=1;
		else
		$page = $_POST['page'];
		$totalReg = count($rs_stdlev);
		//echo $totalReg;
		if($_POST['page_limit']=="" || $_POST['page_limit']=="undefined") $PageLimit = 5; else $PageLimit = $_POST['page_limit'];
		$adjacents = 1;
				
		$totalPages= ceil(($totalReg)/($PageLimit));
		if($totalPages==0) $totalPages=1;
		$StartIndex= ($page-1)*$PageLimit; 
			
		if(count($rs_stdlev)>0) $rs_stdlevArr = array_slice($rs_stdlev,$StartIndex,$PageLimit,true);
		if(count($rs_stdlev)>0 && $totalPages > 1){ 
			$rsPagination = generatePagination("studentLeaveList", $totalReg, count($rs_stdlevArr), $PageLimit, $adjacents, $page); 
		}
		$rs_school = School::getSchoolById($schoolId);
		//echo "::::".count($rs_stdlev);
		//echo "::::".$rs_stdlev->school_name;
///pagignation
	include 'leave_content.php';
	exit();
}
if($_POST['act']=="showLeaveApplicat")
{
ob_clean();
	//print_r($_POST);
	$showBy=$_POST['showBy'];
	$school_id=$_POST['school_id'];
	if($_POST['showBy']=="")
	{
	$sortby='DESC';
	$paramPen=array('status'=>'P-ENUM','school_id'=>$school_id);
	$rs_stdlev_pen=LeaveDetails::getStudentLeave($paramPen,'',$sortby);
	$paramApp=array('status'=>'A-ENUM','school_id'=>$school_id);
	$rs_stdlev_app=LeaveDetails::getStudentLeave($paramApp,'',$sortby);
	$paramRej=array('status'=>'R-ENUM','school_id'=>$school_id);
	$rs_stdlev_rej=LeaveDetails::getStudentLeave($paramRej,'',$sortby);
	}
	if($showBy=="Tdy")
	{
		$rs_stdlev_pen=LeaveDetails::getTodayLeaveApplicant('P',$school_id);
		$rs_stdlev_app=LeaveDetails::getTodayLeaveApplicant('A',$school_id);
		$rs_stdlev_rej=LeaveDetails::getTodayLeaveApplicant('R',$school_id);		
	}
	if($showBy=="Tmw")
	{
		$rs_stdlev_pen=LeaveDetails::getTomorowLeaveApplicant('P',$school_id);
		$rs_stdlev_app=LeaveDetails::getTomorowLeaveApplicant('A',$school_id);
		$rs_stdlev_rej=LeaveDetails::getTomorowLeaveApplicant('R',$school_id);	
	}
	if($showBy=="ThW")
	{
		$rs_stdlev_pen=LeaveDetails::getThisWeekLeaveApplicant('P',$school_id);
		$rs_stdlev_app=LeaveDetails::getThisWeekLeaveApplicant('A',$school_id);
		$rs_stdlev_rej=LeaveDetails::getThisWeekLeaveApplicant('R',$school_id);	
	}
	if($showBy=="Thm")
	{
		$rs_stdlev_pen=LeaveDetails::getThisMonthLeaveApplicant('P',$school_id);
		$rs_stdlev_app=LeaveDetails::getThisMonthLeaveApplicant('A',$school_id);
		$rs_stdlev_rej=LeaveDetails::getThisMonthLeaveApplicant('R',$school_id);	
	}
	$_SESSION['result_pending']=$rs_stdlev_pen;
	$_SESSION['result_approved']=$rs_stdlev_app;
	$_SESSION['result_reject']=$rs_stdlev_rej;
	include('leave_fulldetails.php');
exit();
}
if($_POST['act']=="saveLeaveApplicant")
{
	ob_clean();
	$id=$_POST['id'];
	$param=array('id'=>$id,'status'=>'A');
	$rs_stu_leave=LeaveDetails::updateStudentLeave($param);
	if(count($rs_stu_leave)>0)
	{
		echo "APPROVED THE LEAVE";
	}
	else{
		echo "Not Affected";
	}
	exit();
}
if($_POST['act']=="rejectLeaveApplicant")
{
	ob_clean();
	$id=$_POST['id'];
	$param=array('id'=>$id,'status'=>'R');
	$rs_stu_leave=LeaveDetails::updateStudentLeave($param);
	if(count($rs_stu_leave)>0)
	{
		echo "APPROVED THE LEAVE";
	}
	else{
		echo "Not Affected";
	}
	exit();
}
if($_POST['act']=="getDashBoard")
{
ob_clean();
$school_id=$_POST['school_id'];
?>

	<div class="leave_header">
    		<?
				$param=array('school_id'=>"'".$school_id."'",'added_by'=>"'T'");
				$rs_staff_count=LeaveDetails::getStudentLeave($param);
				//$rs_LeaveTeacher=
			?>
            <div class="pull_left">Staff (<?=count($rs_staff_count)?>)</div>
            <?
			$param=array('school_id'=>$school_id);
			$rs_student_count=LeaveDetails::getStudentLeave($param);
            $countStudent=count($rs_student_count);
			?>            
            <div class="pull_right">Student (<?=$countStudent?>)</div>
            </div>
            	<div class="leave_header">
                    <div class="pull_left">Leave Applicant</div>
                    <div class="pull_right">
                    	<select class="leavebox" onchange="showLeaveApplicat(this.value,'<?=$school_id?>')">
                        	<option value="">All</option>
                        	<option value="Tdy">Today</option>
                            <option value="Tmw">Tomorow</option>
                            <option value="ThW">This Week</option>
                            <option value="Thm">ThisMonth</option>                            
                        </select>
                    </div>
                </div>
            	<div class="leave_header" id="load_leaveapplicant">
					
                    <? //include('leave_fulldetails.php');?>
                </div>
                <div class="leave_header" id="leave_content">
          
                 </div>
<?
exit();	
}
?>