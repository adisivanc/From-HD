<?


function getWeekList($date, $wd){
		$weekdays = array();
		$aDay = 24 * 60 * 60 ;
		for($index=0; $index<7; $index++){
			$cDay = 0;
			if($index<=$wd){
				$cDay=$date-($aDay * ($wd-$index));
			}
			else{
				$cDay=$date+($aDay * ($index-$wd));
			}
			$weekdays[]=date('D', $cDay);
		}
		return $weekdays ;
	}

function getSchoolCalMonthCol($argvs=array()){

        
	$argvs=is_array($argvs)?$argvs:array(); extract($argvs);
	$today = time() ;
	$todaydate = mktime(0, 0, 0, date('m', $today), date('d', $today), date('Y', $today));
	$day = date('d', $today);
	$currmn =  date('m', $today);
	$curryr =  date('Y', $today);

	$today = $yr."_".$mn."_".$day_counter;
	$dvid =  $id."_".$yr."_".$mn."_".$day_counter;
	$db_date = $yr."-".$mn."-".$day_counter;
	$currentdate = mktime(0, 0, 0, $mn, $day_counter, $yr);
	$nwDate =$mn."-".$day_counter."-".$yr;
	$eventDate = ConvertMDY_To_MySQL_doct($nwDate);
	if($day == $day_counter)	$tdclass = 'cal_inner_cur';
	else    $tdclass = 'cal_inner_default';
	$bgcolor = ' background-color:#fff;';
	$currentDate=0;
	if($day_counter == $day && $currmn == $mn && $curryr == $yr) {$currentDate=1; $bgcolor = ' background-color:#CCC;'; }		//if Current Date, Grey
	$PageUrlArr=explode('/',$_SERVER['SCRIPT_NAME']);
	$curpage=$PageUrlArr[2];
	//print_r($_SESSION);
	if($_SESSION['YTUserType']=="SA"){
		$rs_calendar=Calendar::getCalendarByDate($school_id,$eventDate);$cal_Icon='images/plus_icon.png'; $alt="Add Event";$title="Add Event";
		$date_background="";
		if(count($rs_calendar)>0)
						{
							foreach($rs_calendar as $K=>$V) {
							if($V->event_date==$eventDate) { 	
							$date_background="background-color:#5AF;";	
									}
							}
						}
		}
		//echo $curpage;
	
		if($_SESSION['YTUserType']=="T"){
			$rs_calendar_main=Calendar::getCalendarByDate($school_id,$eventDate);
			if(count($rs_calendar_main)>0)
			foreach($rs_calendar_main as $K=>$V)
			{
				if($V->visibility_type=="S"){$rs_calendar=$rs_calendar_main;}
				elseif($V->visibility_type=="I"){
					//print_r($_SESSION);
					$teacher_obj=new Teacher();
					$teacher_obj->user_name=$_SESSION['YTUserName'];
					$teacher_obj->fields="";
					$rs_teacher=$teacher_obj->getTeachersDtls();
					print_r($rs_teacher['id']);
					foreach($rs_teacher as $TK=>$TV)
					{
						$teacher_id=$TV->id;
						$rs_calendar=Calendar::getCalendarEvent($param=array('teachers_id'=>$TV->id."-STRING"),'','');
					}
					$date_background="";
						if(count($rs_calendar)>0)
						{
							foreach($rs_calendar as $K=>$V) {
							if($V->event_date==$eventDate) { 	
							$date_background="background-color:#5AF;";	
									}
							}
						}
					}
			}
			$cal_Icon='images/leave_icon.png'; $alt="Add Event";$title="Add Event";
			//teacher leave put here only
			
			
			
			
			
			//teacher leave part 
			$teacher_obj=new Teacher();
			$teacher_obj->user_name=$_SESSION['YTUserName'];
			$teacher_obj->fields="";			
			$rs_teacher=$teacher_obj->getTeachersDtls();
			foreach($rs_teacher as $TK=>$TV)
					{
						$teacher_id=$TV->id;
					}
			//$tmp_eventDate=str_replace("-","/",$eventDate);
			//$param=array('teacher_id'=>$teacher_id,'leave_date'=>date('Y\m\d',$eventDate)."-DATE");
			$rs_leaveApply=LeaveDetails::getTeacherLeaveByTeacherId($teacher_id,$eventDate);
			
		$method=0;	
		if(count($rs_leaveApply)>0)
		{
						
			if($rs_leaveApply->status=="A")
			{
			$bgcolor = ' background-color:#009D00';
			$cal_Icon='';
			$alt="";$title="";
			$leave_id=$rs_leaveApply->id;
			$method=1;
			}
			if($rs_leaveApply->status=="P")
			{
			$bgcolor = ' background-color:#DAB791';
			$cal_Icon='';
			$alt="";$title="";
			$leave_id=$rs_leaveApply->id;
			$method=1;
			}
			if($rs_leaveApply->status=="R")
			{
			$bgcolor = ' background-color:#ff0000 ';
			$cal_Icon='';
			$alt="";$title="";
			$leave_id=$rs_leaveApply->id;
			$method=1;
			}
			
		}
		
			
			//print_r($rs_leaveApply);
}


///teacher part...
if($curpage=="teacher_login")
{
			$rs_calendar_main=Calendar::getCalendarByDate($school_id,$eventDate);
			if(count($rs_calendar_main)>0)
			foreach($rs_calendar_main as $K=>$V)
			{
				if($V->visibility_type=="S"){$rs_calendar=$rs_calendar_main;}
				elseif($V->visibility_type=="I"){
					//print_r($_SESSION);
					/*$teacher_obj=new Teacher();
					$teacher_obj->id=$_SESSION['YtUser_Id'];
					$teacher_obj->fields="";
					$rs_teacher=$teacher_obj->getTeachersDtls();
					*/
					$rs_teacher= Teacher::getTeachersById($_SESSION['YtUser_Id']);
					foreach($rs_teacher as $TK=>$TV)
					{
						$teacher_id=$TV->id;
						$rs_calendar=Calendar::getCalendarEvent($param=array('teachers_id'=>$TV->id."-STRING"),'','');
					}
					$date_background="";
						if(count($rs_calendar)>0)
						{
							foreach($rs_calendar as $K=>$V) {
							if($V->event_date==$eventDate) { 	
							$date_background="background-color:#5AF;";	
									}
							}
						}
					}
			}
			$cal_Icon='images/leave_icon.png'; $alt="Add Event";$title="Add Event";
			//teacher leave put here only
			
			
			
			
			
			//teacher leave part 
			$teacher_obj=new Teacher();
			$teacher_obj->user_name=$_SESSION['YTUserName'];
			$teacher_obj->fields="";			
			$rs_teacher=$teacher_obj->getTeachersDtls();
			foreach($rs_teacher as $TK=>$TV)
					{
						$teacher_id=$TV->id;
					}
			//$tmp_eventDate=str_replace("-","/",$eventDate);
			//$param=array('teacher_id'=>$teacher_id,'leave_date'=>date('Y\m\d',$eventDate)."-DATE");
			$rs_leaveApply=LeaveDetails::getTeacherLeaveByTeacherId($teacher_id,$eventDate);
			
		$method=0;	
		if(count($rs_leaveApply)>0)
		{
						
			if($rs_leaveApply->status=="A")
			{
			$bgcolor = ' background-color:#009D00';
			$cal_Icon='';
			$alt="";$title="";
			$leave_id=$rs_leaveApply->id;
			$method=1;
			}
			if($rs_leaveApply->status=="P")
			{
			$bgcolor = ' background-color:#DAB791';
			$cal_Icon='';
			$alt="";$title="";
			$leave_id=$rs_leaveApply->id;
			$method=1;
			}
			if($rs_leaveApply->status=="R")
			{
			$bgcolor = ' background-color:#ff0000 ';
			$cal_Icon='';
			$alt="";$title="";
			$leave_id=$rs_leaveApply->id;
			$method=1;
			}
			
		}
		
			
			//print_r($rs_leaveApply);
}


///teacher part

	
	if($_SESSION['YTUserType']=='PARENT'){
		$alt="";$title="";
		$cal_Icon="";
		$dayName=date('l',strtotime($eventDate));
		if($dayName!="Sunday")
		{
		$alt="Apply Leave";$title="Apply Leave";
		$method=0;
		$cal_Icon='images/leave_icon.png';
		}
		else{
			$alt="";$title="";
			$cal_Icon="";
			}
		$gradeId=$_POST['gradeId'];
		$studentId=$_POST['studentId'];
		$rs_calendar=Calendar::getParentCalendarByGrade($gradeId);
		
		
		
		$date_background="";
						if(count($rs_calendar)>0)
						{
							foreach($rs_calendar as $K=>$V) {
							if($V->event_date==$eventDate) { 	
							$date_background="background-color:#5AF;";	
									}
							}
						}
		
		//student_id	teacher_id	leave_date		
		$param=array('student_id'=>$studentId,'leave_date'=>$eventDate."-DATE");
		$rs_StudentLeave=LeaveDetails::getStudentLeaveByStdAndDate($studentId,$eventDate);
		
		if(count($rs_StudentLeave)>0)
		{
			if($dayName!="Sunday")
			{							
				if($rs_StudentLeave->status=="A")		//if Approved, Green
				{
				$bgcolor = ' background-color:#85E49D';
				$cal_Icon='';
				$alt="";$title="";
				$leave_id=$rs_StudentLeave->id;
				$method=1;
				$leave_status = 'Leave Approved';
				}
				if($rs_StudentLeave->status=="P")		//if Pending, Yellow
				{
				$bgcolor = ' background-color:#ffff00';
				$cal_Icon='';
				$alt="";$title="";
				$leave_id=$rs_StudentLeave->id;
				$method=1;
				$leave_status = 'Leave Pending';
				}
				if($rs_StudentLeave->status=="R")
				{
				$bgcolor = ' background-color:#FD7E71';	//if Rejected, Red
				$cal_Icon='';
				$alt="";$title="";
				$leave_id=$rs_StudentLeave->id;
				$method=1;
				$leave_status = 'Leave Rejected';
				}
			}
		}
		
}

?>

<div class="calender_alloc_tbl" style=" <?=$bgcolor?>">
<?



$days = getDaysBetweenDates($eventDate, date('Y-m-d'));
if($days<0) {
?>
<div id="sAppt<?=$dvid?>" style="float: left; ">
	<img src='<?=$cal_Icon?>'  alt='<?=$alt?>' title='<?=$title?>' onclick='<? if($_SESSION['YTUserType']=="SA"){?>addCalendarEvent_load("","<?=$eventDate?>")<? }elseif($_SESSION['YTUserType']=='PARENT' && $method==0){?> LeaveApplay("<?=$studentId?>","<?=$eventDate?>","<?=$school_id?>")<? }elseif($_SESSION['YTUserType']=="T" and $method==0){?> LeaveApplay("<?=$_SESSION['YTUserId']?>","<?=$eventDate?>","<?=$school_id?>")<? }?>' style="cursor:pointer" />
</div>
<? } ?>
<div style="float: right; width:30px; <? echo $date_background; ?>font-weight: <? if($currentDate==1){ ?>bold<? } else{ ?>normal<? }?>; ">  <?=$day_counter?>  </div>
<div  style="text-align:left; padding-top:30px;">

	<?
		$execution=0;
	 	if(count($rs_calendar)>0)
        foreach($rs_calendar as $K=>$V) {
        if($V->event_date==$eventDate && $execution<3) { 
		$execution++;
		?>
             <div onclick="<? if($_SESSION['YTUserType']=="SA"){ ?>addCalendarEvent_load('<?=$V->id?>','<?=date('Y-m-d',strtotime($V->event_date))?>')<? }elseif($_SESSION['YTUserType']=='PARENT'){?>showDetailsToParents('<?=$V->id?>','<?=date('Y-m-d',strtotime($V->event_date))?>')<? }?>" id="<?=$V->id?>" style="cursor:pointer; background-color:#DAB791; font-size:12px; margin:2px 3px 0 3px; border-radius:3px; padding:1px 0; text-indent:3px;" align="center"><? echo substr($V->event_name,0,10); if(strlen($V->event_name)>10){echo "...";}else{}?></div>
    <? 	}   }
		//show leave status
		if($leave_status!='') {
		?>
        	<div  style="background-color:#EEDECC; font-size:12px; margin:2px 3px 0 3px; border-radius:3px; padding:1px 0;" align="center"><? echo $leave_status; ?></div>
        <?	
		}	
	?>

</div>
<?
}


function displayCalendar($id,$mn,$yr,$gradeId,$studentId)	{
	
	   $_SESSION['cal_school_id']=$id;
	   
	    $today = time() ;
		$currmonth = mktime(0, 0, 0, date('m', $today), 1, date('Y', $today));
		$todaydate = mktime(0, 0, 0, date('m', $today), date('d', $today), date('Y', $today));
		$currmonth = mktime(0, 0, 0, date('m', $today), 1, date('Y', $today));
		
		if($mn!="")
			$mn = $mn;
		else 
			$mn = date('m');	
	
		if($yr!="")   
			$yr = $yr;
		else
			$yr = date('Y');		
	
		if($mn>0 && $yr>0)
			$currmonth = mktime(0, 0, 0, $mn, 1, $yr);
			
		$pmonth = mktime(0, 0, 0, date('m', $currmonth)-1, 1, date('Y', $currmonth));
		$nmonth = mktime(0, 0, 0, date('m', $currmonth)+1, 1, date('Y', $currmonth));
	
		$pmn = date('m', $pmonth);
		$pyr = date('Y', $pmonth);
		
		$nmn = date('m', $nmonth);
		$nyr = date('Y', $nmonth);
	
		$date = getDate($currmonth);
		
		$day = $date["mday"];
		$month = $date["mon"];
		$month_name = $date["month"];
		$year = $date["year"];
		
		$this_month = getDate(mktime(0, 0, 0, $month, 1, $year));
		$next_month = getDate(mktime(0, 0, 0, $month + 1, 1, $year));
		
		$first_week_day = $this_month["wday"];
		
		$weekdays = getWeekList(mktime(0, 0, 0, $month, 1, $year), $first_week_day);
		
		$days_in_this_month = round(($next_month[0] - $this_month[0]) / (60 * 60 * 24));
		
		
		
		
		
		
		
?>
<table width="500" border="0" cellpadding="0" cellspacing="0" align="center">
	
	<tr>
		<td width="500" align="center" valign="middle">
			<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%"  class="cal_top_tbl" >
				<tr bgcolor="" height="40">
					<td valign="middle" align="center" width="20%" ><span id="spPrev" onclick='displayCalendar("<?=$id?>", "<?=$pmn?>", "<?=$pyr?>","<?=$gradeId?>","<?=$studentId?>")' style="cursor:pointer;font-size:13.24px;font-family:Trebuchet MS"><b>&lt;&lt; Prev</b></span></td>
					<td valign="middle" align="center" width="60%" style="font-size:13.24px;font-family:Trebuchet MS"><b><?=$month_name . " " . $year ?></b></td>
					<td valign="middle" align="center" width="20%"><span id="spPrev" onclick='displayCalendar("<?=$id?>","<?=$nmn?>", "<?=$nyr?>","<?=$gradeId?>","<?=$studentId?>")' style="cursor:pointer;font-size:13.24px;font-family:Trebuchet MS"><b>Next &gt;&gt;</b></span></td>
				</tr>				
	  </table>		</td>
	</tr>
	<tr>
		<td valign="middle" align="center" >
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="cal_data_tbl" width="100%" >
				<tr style="background-color:#DAB791;">
<?
		for($week_dayindex = 0; $week_dayindex < 7; $week_dayindex++){
?>
		<td align="center" valign="middle" style="background-color:#DAB791;padding:7px 0; color:#FFF; font-weight:bold"><?=$weekdays[$week_dayindex]?></td>
<?
		}
?>
				</tr>
	
				<tr bgcolor="#D9D5D7">
<?
		for($week_day = 0; $week_day < $first_week_day; $week_day++){
?>
					<td style="background-color:#FFF; border-color:DAB791; border:1px;">&nbsp;</td>
<?
		}

		$day = date('d');	
		$week_day = $first_week_day;

		for($day_counter = 1; $day_counter <= $days_in_this_month; $day_counter++){
			$week_day %= 7;
			if($week_day == 0){
?>
				</tr>
				<tr>
<?
			}
?>
				<td valign="top" align="center" width="100%" height="100%" style="">
<?
//echo $gradeId;
getSchoolCalMonthCol(array('school_id'=>$id, 'yr'=>$yr, 'mn'=>$mn, 'day_counter'=>$day_counter, 'rAvailablityDays'=>$rAvailablityDays));
?>
				</td>
<?
			$week_day++;
		}
		
		for(; $week_day < 7; $week_day++){
?>
			<td class="empty">&nbsp;</td>
<?
		}
?>
		</tr>
	</table>	</td>
	</tr>
</table>

	
<?
}


?>