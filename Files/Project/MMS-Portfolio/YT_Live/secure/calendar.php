<?

function main()
{
	
	if($_POST['act']=="showCalendarDetail")
	{
	ob_clean();	
	$param=array('id'=>$_POST['id']);
	$rs_calendar=Calendar::getCalendarEvent($param);
	
	?>
    
    
    
    
    
    
    <table width="550" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
      <tr>
        <th align="left" colspan="2"><strong>
        	<strong>Event Details</strong>
            <span style="float:right;" class="cursor" onclick="closeTemplatePopup()"><strong>X</strong></span>
        </strong></th>
      </tr>
     <?
        if(count($rs_calendar) > 0) {
        foreach($rs_calendar as $K=>$V)
        {
        ?>
      <tr>
        <td valign="top" style="font-size:16px; font-weight:bold">
          <strong><?=$V->event_name?></strong></td>
              </tr>
              <tr>
                <td><em><?=$V->event_desc?></em></td>
              </tr>
            

      <tr>
      
               
                <td><?
            	    $timestamp = strtotime($V->event_date);
					$formattedDate = date('F d, Y', $timestamp);
					echo $formattedDate;
					?></td>
              </tr>
              <? if($V->event_time=='T' && $V->from_time!='' && $V->to_time!='') { ?>
              <tr>
             
                <td><? echo $V->from_time?></td>
              </tr>
              <?
			  }
			  ?>
        
      <!--<tr>
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
              </tr>-->
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
if($_POST['act']=="deleteCalendarEvent")
{
	ob_clean();
	$rs_calender=Calendar::deleteCalendarById($_POST['id']);
	if(count($rs_calender)>0)	echo "deleted successfully";	
	exit();
}
if($_POST['act']=="saveLeaveApplication")
{
	ob_clean();
	//print_r($_POST);
	//	id	student_id	leave_date	reason	status
	$teacherId=$_POST['teacherId'];
	$leavedate=$_POST['leaveFromDate'];
	$leaveOption=$_POST['leaveOption'];
	$leave_toDate=$_POST['leaveToDate'];
	$reason=$_POST['leaveReason'];
	$school_id=$_POST['school_id'];
	$added_by="T";
	$rs_user=User::getUserById($teacherId);
	$added_email=$rs_user->email_address;
	$teacher_obj=new Teacher();
	$teacher_obj->email_address=$added_email;
	$rs_teacher=$teacher_obj->getTeachersDtls();
	foreach($rs_teacher as $TK=>$TV)
	{
		$teacher_id=$TV->id;
	}
	//$added_email=$_SESSION['user_email'];
	
	if($leave_toDate !='')
	{
		$aryDates=createDateRangeArray(date('Y-m-d',strtotime($leavedate)),date('Y-m-d',strtotime($leave_toDate)));
		print_r($aryDates);
		foreach($aryDates as $dates){
			$postArrs = array('teacher_id'=>$teacher_id,'leave_date'=>$dates,'reason'=>$reason,'status'=>'P','added_by'=>$added_by,'added_email'=>$added_email,'school_id'=>$school_id);	
	      $rs_studentLeave=LeaveApply::insertStudentLeave($postArrs);
			echo $rs_studentLeave;
			}
	}
	else{
		$postArrs = array('teacher_id'=>$teacher_id,'leave_date'=>$leavedate,'reason'=>$reason,'status'=>'P','added_by'=>$added_by,'added_email'=>$added_email,'school_id'=>$school_id);	
		$rs_studentLeave=LeaveApply::insertStudentLeave($postArrs);
	}
	echo "saveLeaveApplication";
	exit();	
}
if($_POST['act']=="leaveApplication")
{
	ob_clean();
	$studentId=$_POST['studentId'];
	$eventDate=$_POST['event_date'];
	$school_id=$_POST['school_id'];
	$rs_student=Student::getStudentById($studentId);
	$studentName=$rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
	?>
    	
    	
            <table width="500" border="0" cellspacing="0" cellpadding="0" style="margin:10px auto;" class="table_pop">
              <tr>
                <td colspan="2" style="border-bottom:1px solid #eec290; background:url(images/menu_bg.jpg); line-height:32px; color:#FFFFFF;">
                    <div class="pull_left" style="text-indent:10px;">Leave Application for <?=$studentName?></div>
                    <div class="pull_right cursor" onclick="closeTemplatePopup()">X</div>
                </td>
              </tr>
              <tr>
              	<td colspan="2">
                	<input type="hidden" name="school_id" id="school_id" value="<?=$school_id?>" />
                	<input type="hidden" name="teacherId" id="teacherId" value="<?=$studentId?>" />
                    <input type="hidden" name="leaveFromDate" id="leaveFromDate" value="<?=$eventDate?>" />
                </td>
              </tr>
              <tr>
                <td width="100" valign="top">
                    Date
                </td>
                <td valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                       	 <td><? echo date('d/m/Y',strtotime($eventDate))?></td>
                      </tr>
                      <tr>
                            <td>
                            <input type="radio" id="leave_option" name="leave_option" value="S" /> Single Day<input type="radio" id="leave_option" name="leave_option" value="M" /> Multiple Days</td>
                           
                      </tr>
                      <tr >
                       	    <td id="multipleDay_Dtl" style="display:none">To Date <input class="text datepicker" type="text" id="leaveToDate" name="leaveToDate" value="" style="width:55%;" />
                            <script type="text/javascript">																	
									$(function() {
									   $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val(); 
									});									
							</script>
                            </td>
                      </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                    Reason <br/>
                    <textarea class="txtarea" id="lev_reason" name="lev_reason" style="width:95%;"></textarea>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="border-top:1px solid #eec290;">
                    <div class="newsletter_submenu txtwhite pull_right" align="center" style="width:100px; height:30px;" onclick="submitLeaveForm()">Apply</div>
                </td>
              </tr>
            </table>

    <?
	exit();	
}


if($_POST['act']=='showCal') {
	ob_clean();
	$mn = $_POST['month'];
	$yr = $_POST['year'];
	$school_id = $_POST['school_id'];
	$rsSchool = School::getSchoolById($school_id);
	ob_clean();
	echo $rsSchool->school_name.'::';
	displayCalendar($school_id,$mn,$yr,"","");
	exit();	
}
         
if($_POST['act']=="getGrade")
{
	ob_clean();
	$update=0;
	$grade_imp;
	$grade_obj = new Grade();
    $sv=$_POST['schoolId'];
    if($_POST['schoolId']!="All")
    $grade_obj->school_id =$sv;
    $grade_obj->fields = "id, grade_name";
    $rs_grades = $grade_obj->getGradeDtls();
	if($_POST['event_id']>0) {
		$update=1;
		$cV=Calendar::getCalendarGetById($_POST['event_id']);
		$grade_imp=explode(",",$cV->grades);
	 }
    ?>
   
    <select name="search_grade" id="search_grade" class="listbox" style="width:90%;" multiple="multiple">
    <option value="All" onclick="selectAllGrade()">All</option>
    <? if(count($rs_grades)>0) {   foreach($rs_grades as $gk=>$gv) { ?>
    <option value="<?=$gv->id?>" <? if($update!=0 && in_array($gv->id,$grade_imp)){?>selected="selected" <? }?>><?=$gv->grade_name?></option>
    <? }   }     ?>
    </select>
   <? exit(); 
}


if($_POST['act']=="updateCalendarEvent")
{
	ob_clean();
	$postArrs = array('event_date','event_name','address','event_desc','school_id',
	'grades','visibility_type','teachers_id','added_by','event_time','from_time_24','to_time_24','send_notification','notification_to','from_time','to_time','event_type','id');
	$stringArr = array('event_name','event_desc');
	foreach($postArrs as $K=>$V) {
			if($V=="school_id"){if($_POST[$V]=="All"){$$V="1,2";}else{$$V=$_POST[$V];}}
			if($V!="school_id"){$$V=$_POST[$V];}
			if(in_array($V,$stringArr)) $$V = addslashes($$V);
			if($$V!='') $argV[$V]=$$V;	
	}
	
	$schoolIds = explode(',',$school_id);
	$show=0;
	if(in_array($_SESSION['cal_school_id'],$schoolIds)) $show=1;
	$calendarId=Calendar::updateCalendarEvent($argV);
	ob_clean();
	if($calendarId>0)
		echo "1::Event Successfully Updated::".$calendarId.'::'.$show;
	else
		echo "0::Event Not Updated::".$calendarId.'::'.$show;
	exit();	
}



if($_POST['act']=="saveCalendarEvent")
{
	
	ob_clean();
	if($_POST['multiple_day']=="YES")
	{
		
		$aryDates=createDateRangeArray(date('Y-m-d',strtotime($_POST['start_date'])),date('Y-m-d',strtotime($_POST['end_date'])));
		foreach($aryDates as $date)
		{
			
	
				$postArrs = array('event_date','event_name','address','event_desc','school_id',
				'grades','visibility_type','teachers_id','added_by','event_time','from_time_24','to_time_24','send_notification','notification_to','from_time','to_time','event_type');
				$stringArr = array('event_name','event_desc','event_type');
				foreach($postArrs as $K=>$V) 
				{
					if($V=="event_date"){$$V=$date;	}					
					if($V=="school_id"){if($_POST[$V]=="All"){$$V="1,2";}else{$$V=$_POST[$V];}}
					if($V!="event_date" && $V!="school_id"){$$V=$_POST[$V];}
					if(in_array($V,$stringArr)) $$V = addslashes($$V);
					if($$V!='') $argV[$V]=$$V;	
					//print_r($argV);
				}
				$calendarId=Calendar::insertCalendarEvent($argV);
				//echo "Event Successfully Saved::".$calendarId;
				
				echo $date;
				
		}	
	}
	else{
	$postArrs = array('event_date','event_name','address','event_desc','school_id',
	'grades','visibility_type','teachers_id','added_by','event_time','from_time_24','to_time_24','send_notification','notification_to','from_time','to_time','event_type');
	$stringArr = array('event_name','event_desc');
	foreach($postArrs as $K=>$V) {
		if($V=="school_id"){if($_POST[$V]=="All"){$$V="1,2";}else{$$V=$_POST[$V];}}
		if($V!="school_id"){$$V=$_POST[$V];}
		if(in_array($V,$stringArr)) $$V = addslashes($$V);
		if($$V!='') $argV[$V]=$$V;	 
	}
	$calendarId=Calendar::insertCalendarEvent($argV);
	}
	
	$schoolIds = explode(',',$school_id);
	$show=0;
	if(in_array($_SESSION['cal_school_id'],$schoolIds)) $show=1;
	
	ob_clean();
	if($calendarId>0)
	echo "1::Event Successfully Saved::".$calendarId.'::'.$show;	
	else
	echo "0::Event Not Saved".'::'.$show;
	exit();
}



if($_POST['act']=="getTimeOfEvent")
{
ob_clean();

    if($_POST['event_id']>0) {
		 $cV=Calendar::getCalendarGetById($_POST['event_id']);
		 
		 if($cV->event_time=="T") {
		 $from_time_arr=explode(' ',$cV->from_time);
		 $from_times_arr = explode(':',$from_time_arr[0]);
		 $from_time_hh = $from_times_arr[0];
		 $from_time_mm = $from_times_arr[1];
		 $from_time_ampm = $from_time_arr[1];

		 $to_time_arr=explode(' ',$cV->to_time); 
		 $to_times_arr = explode(':',$to_time_arr[0]);
		 $to_time_hh = $to_times_arr[0];
		 $to_time_mm = $to_times_arr[1];
		 $to_time_ampm = $to_time_arr[1];
		 
		 }
		 
	}

	
		?>
		<td colspan="2">
			From &nbsp;<?   ?>
			<select class="listbox border_white" style="width:57px" id="event_from_hh" name="event_from_hh">
            
            <option value="">HH</option>
                    	<?  for($i=1; $i<=12; $i++){ 
						$iVal = ($i<10)?'0'.$i:$i;
						?>
                     	<option value="<?=$iVal?>"  <?=($from_time_hh==$iVal)?'selected="selected"':'';?>><?=$iVal?></option>
                     	 <? } ?>
                         
			 </select>
						 <span> : </span>
			<select class="listbox border_white" style="width:57px" id="event_from_mm" name="event_from_mm">
             <option value="">MM</option>
					<?  for($i=0; $i<=11; $i++){$mVal=($i*5<10)?'0'.$i*5:$i*5; ?>
                        <option value="<?=($i*5<10)?'0'.$i*5:$i*5?>" <?=($from_time_mm==$mVal)?'selected="selected"':'';?>><? echo ($i*5<10)?'0'.$i*5:$i*5;?></option>           
                        <? }?>           		
							
			</select>
						
			<select class="listbox border_white" style="width:60px" id="event_from_ampm"  name="event_from_ampm">
					  <option value="AM" <?=($from_time_ampm=="AM")?'selected="selected"':'';?>>AM</option>
                      <option value="PM"  <?=($from_time_ampm=="PM")?'selected="selected"':'';?>>PM</option>						  
			 </select>
		<br />
        <br />
        TO &nbsp;&nbsp;&nbsp;<?  ?> 
						<select class="listbox border_white" style="width:57px" id="event_to_hh"  name="event_to_hh">
							<option value="">HH</option>
                    	<?  for($i=1; $i<=12; $i++){ 
						$iVal = ($i<10)?'0'.$i:$i;
						?>
                     	<option value="<?=$iVal?>"  <?=($to_time_hh==$iVal)?'selected="selected"':'';?>><?=$iVal?></option>
                     	 <? } ?>
						</select>
						
						<span> : </span>
						<select class="listbox border_white" style="width:57px" id="event_to_mm" name="event_to_mm">
                                <option value="">MM</option>
                        <?  for($i=0; $i<=11; $i++){$mVal=($i*5<10)?'0'.$i*5:$i*5; ?>
                            <option value="<?=($i*5<10)?'0'.$i*5:$i*5?>" <?=($to_time_mm==$mVal)?'selected="selected"':'';?>><? echo ($i*5<10)?'0'.$i*5:$i*5;?></option>           
                            <? }?>   
							
						</select>
						
						<select class="listbox border_white" style="width:60px" id="event_to_ampm"  name="event_to_ampm">
						  <option value="AM" <?=($to_time_ampm=="AM")?'selected="selected"':'';?>>AM</option>
                      <option value="PM"  <?=($to_time_ampm=="PM")?'selected="selected"':'';?>>PM</option>						  
						</select>
					   
					</td>   
			
	<?	
		
	

?>

<?
exit();
}
			
		if($_POST['act']=="getTeachers")
		{
			ob_clean();
		
		$gradeIds = explode(',',$_POST['gradeIds']);
			if($_POST['visibility_type']=="I")
			{
			 $update=0;	
			$teacher_arr=array();
			
			if($_POST['event_id']>0)
			{
				 $cV=Calendar::getCalendarGetById($_POST['event_id']);
				 $teacher_arr=explode(',',$cV->teachers_id);
				 $update=1;
				 
		    }
			?>
            <td>
           
    	Teachers
    </td>
    <td >
       
            <?
		?>
    	<select name="search_teacher" id="search_teacher" class="listbox" style="width:90%;" multiple="multiple">
        <option value="All" onclick="selectAllTeachers()">All</option>
        	 <?
			 	
				
			 	
			  foreach($gradeIds as $gk=>$gv)
			  {
			   		
					$rs_gteacher=Teacher::getTeachersByGrade($gv);
					foreach($rs_gteacher as $K=>$V)
						{
					 $rs_teacher=Teacher::getTeachersById($V->teacher_id);
							{
						 $teacherName=$rs_teacher->prefix." ".$rs_teacher->first_name.$rs_teacher->middle_name .$rs_teacher->last_name;
					?>
					 <option value="<?=$V->teacher_id;?>"  <? if( $update!=0&&in_array($V->teacher_id,$teacher_arr)){?>selected="selected" <? }?> ><?=$teacherName;?></option>
					<?  
					 		}
			  			}
			  }
			  ?>
        </select>
        </td>
        <?
			}
				
		exit();
			}
		?>
<?php
if($_REQUEST['act']=="showCalendarEvent")
{
	ob_clean();
$update=0;
$event_id=0;
	if($_POST['id']!="")
	{
	 $update=1;	
	 $event_id=$_POST['id'];
	 $cV=Calendar::getCalendarGetById($event_id);
	}
?>

<table width="100%" border="0" cellspacing="1" cellpadding="0" style="margin:5px auto;background-color:#999" class="popuptbl" >
  <tr>
    <th align="left" colspan="2"><strong><? if($update==0){echo "ADD";} else{echo "UPDATE";}?> CALENDER EVENT</strong>
        <span onclick="closeTemplatePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        
  </tr>
<tr style="background-color:#FFF">
      <td>
       Date  
      </td>
      <td>
     
      <input type="hidden" id="added_by" name="added_by" value="<?=$_SESSION['YTUserType']?>"    />
      <input type="hidden" id="event_date" name="event_date" value="<?=$_POST['event_date']?>" style="width:95%" readonly="readonly"/>
      <?
						$timestamp = strtotime($_POST['event_date']);
						$formattedDate = date('F d, Y', $timestamp);
						echo $formattedDate;
	?>
       
      </td>
 </tr>

<?
if($update==0)
{
?>
  <tr style="background-color:#FFF">
		<td>
        	MultiDay Event:
        </td>
        
        <td>
        	<input type="checkbox" name="m_day_eve" value="Off" id="m_day_eve" onclick="multidayEvent(this.value)"/>             
        </td>     
   </tr>

 
    <tr style="background-color:#FFF">
    <td colspan="2">
    <table width="100%" cellpadding="0" cellspacing="1"  class="multiple_day_event" style="background-color:#FFF; border:#666;" >
    <tr style="background-color:#FFF">
        <td>Start Date </td> 
        <td style="width:50%">
            <input type="text" class="datepicker"  name="start_date" id="start_date" value="<?=date('m/d/Y',strtotime($_POST['event_date']))?>" />
        </td>          
    </tr>
    <tr style="background-color:#FFF">
        <td >
            End Date</td>
        <td>
			<? $date_end = strtotime("+2 day", strtotime($_POST['event_date']));?>          
            <input type="text" class="datepicker" value="<?=date("m/d/Y",$date_end)?>" name="end_date" id="end_date"  />
        </td>
    </tr>
    </table></td></tr>
 <script type="text/javascript">
	$(function() {
	   $(".datepicker").datepicker({
			changeMonth: true
	   });
	  
	   
	   $( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' }).val(); 
	});
	
 </script>
<?
}
?>
 
   <tr style="background-color:#FFF">
      <td>
       <span id="err_event_name" style="color:#F00">*</span> Name
      </td>
      <td>
        <input type="text" id="event_name" name="event_name" value="<? if($update!=0){ echo $cV->event_name;}?>" style="width:95%">
      </td>
  </tr>
  <tr style="background-color:#FFF">
      <td>
        <span id="err_event_desc" style="color:#F00">*</span>Description
      </td>
      <td>
        <textarea  id="event_desc" name="event_desc" style="width:95%"><? if($update!=0){ echo $cV->event_desc;}?></textarea>
      </td>
  </tr>
 <tr>
 <!---
 <tr>
      <td>
        <span id="err_event_desc" style="color:#F00">*</span>Color
      </td>
      <td>
        <input type="color" name="event_color" id="event_color" value="<? if($update!=0){ echo $cV->event_color;}?>" />
      </td>
  </tr>
  ------->
 <tr style="background-color:#FFF">
  	<td>
    	<span id="err_event_school" style="color:#F00">*</span>School
    </td>
   
    <td>
                 <?
				 
				 ?> 
                <select style="width:95%" name="search_school" id="search_school"  onchange="getGrade(this.value,<?=$event_id?>)">
     								<?
                                    $school_obj=new School();
									$school_obj->fields="id,school_name";
									$rs_school=$school_obj->getSchoolDtls();
		 							if(count($rs_school)>0) {
										?>
										<option value="All" <? if($cV->school_id=="1,2"){?>selected<? }else{ ?><? }?>>All Campus</option>
										<?
          							foreach($rs_school as $gk=>$gv) { ?>
                                   <option value="<?=$gv->id?>"  <? if($update!=0 && $cV->school_id==$gv->id){?>selected<? }elseif($update==0 && $_SESSION['localSchoolId']==$gv->id){?>selected <? } else{}?>><?=$gv->school_name?></option>																
               							<? } } ?>
										</select>
                                        <?
										if($update!=0){
											
											if($cV->school_id !="1,2"){	$schoolId=$cV->school_id;}
											else{$schoolId="";}
											?>
                                            
                                           <script>
										   
										   	getGrade('<?=$schoolId?>','<?=$event_id?>');
											getTeachers('<?=$cV->visibility_type?>','<?=$event_id?>','<?=$cV->grades?>');
										   </script>
                                            <?
											}
										else{
											?>
                                            <script>
                                            getGrade('<?=$V->id?>','<?=$event_id?>');
											</script>
                                            <?
											}
										?>
    
    </td>
  </tr>	
  <tr style="background-color:#FFF">
  	<td>
    	<span id="err_event_grade" style="color:#F00">*</span>Grade
    </td >
  	
    <td id="loadGrade" >


    </td>
 </tr> 
 
  <tr style="background-color:#FFF">
  	<td>
    	<span id="err_event_visibility_type" style="color:#F00">*</span>Visibility Type
    </td>
    <td>
    	<input type="radio" name="visibility_type" id="visibility_type" value="I" <? if($update!=0 && $cV->visibility_type=="I"){?> checked="checked"<? }?> onclick="getTeachers(this.value,'<?=$event_id?>','')"/>Internal
			<input type="radio" name="visibility_type" id="visibility_type" value="P" <? if($update!=0 && $cV->visibility_type=="P"){?> checked="checked"<? }?> onclick="getTeachers(this.value,'<?=$event_id?>','')"/>Parents
			<input type="radio" name="visibility_type" id="visibility_type" value="PU" <? if($update!=0 && $cV->visibility_type=="PU"){?> checked="checked"<? }elseif($update==0){  }?> onclick="getTeachers(this.value,'<?=$event_id?>','')" />Public
			<input type="radio" name="visibility_type" id="visibility_type" <? if($update!=0 && $cV->visibility_type=="S"){?> checked="checked"<? }?> value="S" onclick="getTeachers(this.value,'<?=$event_id?>','')"/>School
    </td>
  </tr>  
  <tr id="teachrs" style="background-color:#FFF">
	
  </tr>   
  <tr style="background-color:#FFF">
  	<td>
    	<span id="err_event_time" style="color:#F00">*</span>Time
    </td>
    <td>
    	<input type="radio" name="event_time" id="event_time" value="All" <? if($cV->event_time=="All"){?> checked="checked"<? }elseif($update==0){ echo 'checked="checked"'; }?> >All Day Event
			<input type="radio" name="event_time" id="event_time" value="T"   <? if( $cV->event_time=="T"){?> checked="checked"<? }?> onclick="getTimeofEvent('<?=$event_id?>')"> Fixed
    </td>
  </tr>   
  
  
   <tr id="loadEventTime" style="background-color:#FFF">
  	
  </tr>   

<tr style="background-color:#FFF">
  	<td>
    	<span id="err_event_name" style="color:#F00">*</span>Event Type
    </td>
    <td>
    	<input type="radio" name="event_type"  value="H" <? if($cV->event_type=="H"){?> checked="checked"<? }?>/>Holiday&nbsp;&nbsp;<input type="radio" name="event_type" value="E" <? if($cV->event_type==""){?>checked="checked"<? }elseif($cV->event_type=="E"){?> checked="checked"<? }?>>Event
    </td>
</tr> 

<tr style="background-color:#FFF">
  	<td>
    	<span id="err_event_name" style="color:#F00">*</span>Send Reminder
    </td>
    <td>
    	<input type="radio" name="send_notification"  value="Y"  <? if($update!=0 && $cV->send_notification=="Y"){?> checked="checked"<? }?> onclick=""/>Yes&nbsp;&nbsp;<input type="radio" name="send_notification" value="N" <? if($update!=0 &&$cV->send_notification=="N"){?> checked="checked"<? }?> onclick="">No
    </td>
</tr> 

<tr style="background-color:#FFF">
  	<td colspan="2" align="center">
    	<?
		if($update==0)
		{
		?>
    	<input type="button" value="Add To Calendar" onClick="addCalendarEvent()">
        <?
		}
		else{
		?>
        <input type="button" value="Update To Calendar" onClick="updateCalendarEvent(<?=$_POST['id']?>)">
       
       <input type="button" value="Delete This Event" onclick="deleteCalendarEvent(<?=$_POST['id']?>)"/>
        <? }?>
    </td>
</tr>   
</table>
<script>
 <? if( $cV->event_time=="T"){?>
   getTimeofEvent('<?=$event_id?>');
  
   <? } ?>	
</script>
 <?
 exit();
}

?>

<div class="fullsize">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright10" /></td>
                <td>Manage <br/> <span class="f30"><strong>Calendar</strong></span></td>
              </tr>
              
            </table>
        </div>
        <div class="pull_right f24 padtop40">
        
            
        </div>
    </div>
    
</div>


<!--------------------------------title put on here-------------------------------------------->	
    <!------------------calendar added here------------------------------>
    <div class="fullsize">
    
        <div class="fullsize newsletter_outer">
        	
            <div class="newsletter_left"> <!-- Newsletter Circular -->
            	<div class="newsletter_submenu txtwhite">
                
					<div class="circular_outer">
                    	<div class="newcircular_head">Calendar</div>
                        <? $rs_schools = School::getAccessedSchools($GLOBALS['schoolAccess']); ?>
                    <ul class="currentteacher_content txttheme" id="teachermenutab_A" style="padding-right:10px;">
                    <? if(!empty($rs_schools)) {foreach($rs_schools as $sk=>$sv) {
						if($sk==0) $first_school = $sv->id;
						 ?>
                    	<? if($GLOBALS['schoolAccess'][$sv->id]) { ?>
                        	<li onclick="displayCalendar('<?=$sv->id?>','','')" style="cursor:pointer;"><?=$sv->school_name?><span class="tabbtn" id="2tabbtn_<?=$sv->id?>"></span></li>
                            
						<? } ?>
                    <? } } ?>
                    </ul>
                    
                    </div>
                </div>
            </div>
          
  
          <div class="newsletter_right border_theme bgwhite" style="width:78.8%; ">
          		<div class="fullsize pad10"  id="calendarDisplay" >
                <table width="100%" cellpadding="5" cellspacing="5">
                <tr><th style="font-size:20px; padding:10px 0; text-align:left;"><strong><span id="school_name"></span> Calendar</strong></th></tr>
                <tr><td id="calendarShow"></td></tr></table>
                
                
                </div>
          </div>
          

     </div>
    <div id="leave_application_popup" class="popupbox" style=" max-width:550px; padding:0; margin:0; display:none; font-family:Arial, Helvetica, sans-serif;">
    </div>
            <!-- Newsletter Circular -->
<script src="js/jquery-ui-1.8.11.custom.js" type="text/javascript">

</script>
<script type="text/javascript">
function LeaveApplay(studentId,event_date,school_id)
	{
		popupTemplateDtls("loading please wait");
		//show_leave_application();
		var paramData={'act':'leaveApplication','event_date':event_date,'studentId':studentId,'school_id':school_id}	
		ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				popupTemplateDtls(data);
				
				}
			});
	}
	
	$(document).on('change', 'input[name="leave_option"]:radio', function(){
    var cheackVal=($(this).val());
	if(cheackVal=='S')
	{
		$("#multipleDay_Dtl").css("display", "none");
		
	}
	else
	{
		$("#multipleDay_Dtl").css("display", "block");	
	}
});
	


function submitLeaveForm()
{
	var leaveFromDate=$('#leaveFromDate').val();
	var teacherId=$('#teacherId').val();
	var school_id=$('#school_id').val();
	var leave_option;
	var leaveToDate="";
	var leaveReason;
	var err=0;
	if($('#leave_option').is(':checked')){leave_option=$('input:radio[name=leave_option]:checked').val();}else{($(this).css('border-color','red'));}
	if(leave_option!='S'){
			if($('#leaveToDate').val()!='')
			{
				if($('#leaveToDate').val()>leaveFromDate)
				{
				leaveToDate=$('#leaveToDate').val();$('#leaveToDate').css('border-color','#eec290');
				}
				else
				{
					err=1;
					($('#leaveToDate').css('border-color','red'));
						
				}
				
			}
			else{err=1; ($('#leaveToDate').css('border-color','red'));}
		}
	if($('#lev_reason').val()!=''){leaveReason=$('#lev_reason').val(); $('#lev_reason').css('border-color','#eec290');}else{err=1;$('#lev_reason').css('border-color','red');}
	var paramData={'act':'saveLeaveApplication','teacherId':teacherId,'leaveFromDate':leaveFromDate,'leaveOption':leave_option,'leaveToDate':leaveToDate,'leaveReason':leaveReason,'school_id':school_id}
	//alert(jquery.parseJSON(paramData));
	if(err==0)
	{
		ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				alert(data);
				closeTemplatePopup();
				document.location.href="dashboard.php";				
				}
			});
	}	
}



function showCalendar(id)
{
	var paramData={'act':'showCalendar','schoolId':id}
	ajax({
		a:'calendar',
		b:$.param(paramData),
		c:function(){},
		d:function(data){
		$('#calendarShow').html(data);
		}
		});
}

	
function addCalendarEvent_load(id,event_date)
	{
		popupTemplateDtls("loading please wait");
		event_date=event_date;
		var paramData={'act':'showCalendarEvent','event_date':event_date,'id':id}	
		ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				popupTemplateDtls(data);
				}
			});
	}
	
	
function showDetailsToParents(id,event_date){
	popupTemplateDtls("loading please wait");

	var paramData={'act':'showCalendarDetail','id':id,'event_date':event_date}
	ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
					popupTemplateDtls(data); 
				}
		});
	}
	
function getGrade(schoolId,id)
{
	
	
	var paramData={'act':'getGrade','schoolId':schoolId,'event_id':id}
	ajax({
		a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				//alert(data);
				$('#loadGrade').html(data);
			}
		});
}
function getTeachers(visibility_type,id,gradeId)
{
	
	
		var gradIds;
		if(gradeId==0 || gradeId=='')
		{//		gradeIds=$('#search_grade').val();
		gradeIds=($("#search_grade").val() || []).join(', '); 
		}
		else
		{
		gradeIds=gradeId;
		}
		
		var paramData={'act':'getTeachers','gradeIds':gradeIds,'visibility_type':visibility_type,'event_id':id}	
		//alert(JSON.stringify(paramData));
		ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
		
				$('#teachrs').html(data);
				//popupTemplateDtls(data);
				}
			});
		
			
}

function getTimeofEvent(event_id)
{

   
	var paramData={'act':'getTimeOfEvent','event_id':event_id}
		ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				//alert(data);
				$('#loadEventTime').html(data);
				//popupTemplateDtls(data);
				}
			});
}
function loadNotificationTo()
{
	var notificatioToStatus=$('input:radio[name="send_notification"]:checked').val();
		var paramData={'act':'getLoadNotification','notificatioToStatus':notificatioToStatus}
		ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				//alert(data);
				$('#loadNotificationTo').html(data);
				//popupTemplateDtls(data);
				}
			});
}
function tConvert (time) {
	
// var time = document.getElementById('txttime').value;
var hrs = Number(time.match(/^(\d+)/)[1]);
var mnts = Number(time.match(/:(\d+)/)[1]);
var format = time.match(/\s(.*)$/)[1];
if (format == "PM" && hrs < 12) hrs = hrs + 12;
if (format == "AM" && hrs == 12) hrs = hrs - 12;
var hours = hrs.toString();
var minutes = mnts.toString();
if (hrs < 10) hours = "0" + hours;
if (mnts < 10) minutes = "0" + minutes;
return (hours + ":" + minutes);


}

function addCalendarEvent()
{
	
	
	
	var event_date=$('#event_date').val();
	var notification_to="N";
	var teacher=[];
	var  event_from="00:00 AM";
	var event_to="00:00 AM";
	//var  event_from_con="00:00 AM";
	//var event_to_con="00:00 AM";
	var err=0;
	var event_color=0;
	var school_array=[];
	var multiple_day="Off";
	var start_date='';
	var end_date='';
	     
	if($('#event_name').val()!=""){var event_name=$('#event_name').val();}else{err=1;  }
	if($('#event_desc').val()!=""){var event_desc=$('#event_desc').val();}else{err=1; }
	
	//var event_color=$('#event_color').val();
	var school=$('select[name=search_school]').val();
	
		
	if($('#search_grade').val()!="" || $('#search_grade').val()!="undefined"){var grades=$('#search_grade').val();}else{err=1;   }
	if($('input:radio[name="visibility_type"]:checked').val()!="" || $('input:radio[name="visibility_type"]:checked').val()!="undefined"){var visibility_type=$('input:radio[name="visibility_type"]:checked').val();}else{err=1; }
	if($('input:radio[name="visibility_type"]:checked').val()=="I")
	{
		if($('#search_teacher').val()!=""){teacher=$('#search_teacher').val();}
	}
	
	if($('input:radio[name="event_time"]:checked').val()!="" || $('input:radio[name="event_time"]:checked').val()!="undefined"){var event_time=$('input:radio[name="event_time"]:checked').val();}else{err=1; }
	if($('input:radio[name="event_time"]:checked').val()=="T")
	{
		
		if($('#event_from_hh').val()!="" && $('#event_from_mm').val()!="")
		{
			var event_from=$('#event_from_hh').val()+":"+$('#event_from_mm').val()+" "+$('#event_from_ampm').val();
			//var event_from_con=$('#event_from_hh').val()+":"+$('#event_from_mm').val()+" "+$('#event_from_ampm').val();
		
		}else{err=1;  }
		if($('#event_to_hh').val()!="" && $('#event_to_mm').val()!="")
		{
		var event_to=$('#event_to_hh').val()+":"+$('#event_to_mm').val()+" "+$('#event_to_ampm').val();
		//var event_to_con=$('#event_to_hh').val()+":"+$('#event_to_mm').val()+" "+$('#event_to_ampm').val();
		}
		else
		{err=1;
		
		 }
	}
	
	if($('input:radio[name="send_notification"]:checked').val()!="" || $('input:radio[name="send_notification"]:checked').val()!="undefined"){var event_notification=$('input:radio[name="send_notification"]:checked').val();}else{err=1; }
	if($('input:radio[name="send_notification"]:checked').val()=="Y")
	{
	 notification_to=$('input:radio[name="notification_to"]:checked').val();
	}
	if($("#m_day_eve").is(':checked'))
	{
		
		multiple_day="YES";
		if($('#start_date').val()!=""){start_date=$('#start_date').val();}else{err=1;}
		if($('#end_date').val()!=""){end_date=$('#end_date').val();}else{ err=1;}
		if(start_date<end_date){}else{err=1;alert("select date properly");}
	}
	//alert(multiple_day+"  "+start_date+"   "+end_date);
	var event_type= $('input:radio[name="event_type"]:checked').val();
	if(err==0)
	{	
	
		var teachersIds="";
		teachersIds=teacher.join(',');
		var gradeIds=grades.join(',');
		var from_time=tConvert(event_from);
		var to_time=tConvert(event_to);
		
		var paramData={'act':'saveCalendarEvent','event_date':event_date,'event_name':event_name,'event_desc':event_desc,'school_id':school,'grades':gradeIds,'visibility_type':visibility_type,'teachers_id':teachersIds,'event_time':event_time,'from_time_24':from_time,'to_time_24':to_time,'send_notification':event_notification,'notification_to':notification_to,'from_time':event_from,'to_time':event_to,'event_color':event_color,'multiple_day':multiple_day,'start_date':start_date,'end_date':end_date,'event_type':event_type}
		
		ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data)
			{	
				alert(data);
				data = $.trim(data);
				var dataArr = data.split('::');
				var vhtml = '';
				if(dataArr[0]=='1' && dataArr[3]=='1') {
					var event_id  = dataArr[2];
				vhtml += '<li onclick="addCalendarEvent_load('+event_id+','+event_date+')" id="'+event_id+'" style="cursor:pointer">'+event_name+'</li>';
				$('#Event_Data'+event_date).append(vhtml);
				closeTemplatePopup();
				} else {}	
							
   		     }
			});	
	}
	else 
		alert('Some Field is missing');
}


function updateCalendarEvent(id)
{
	
	
	var event_date=$('#event_date').val();
	var notification_to="N";
	var teacher=[];
	var  event_from="00:00 AM";
	var event_to="00:00 AM";
	var err=0;
	var event_color=0;
	var school_array=[];
	var multiple_day="Off";
	var start_date='';
	var end_date='';
	     
	if($('#event_name').val()!=""){var event_name=$('#event_name').val();}else{err=1; }
	if($('#event_desc').val()!=""){var event_desc=$('#event_desc').val();}else{err=1; }
	
	//var event_color=$('#event_color').val();
	
	var school=$('select[name=search_school]').val();
	//alert(school);
		
	if($('#search_grade').val()!="" || $('#search_grade').val()!="undefined"){var grades=$('#search_grade').val();}else{err=1;}
	if($('input:radio[name="visibility_type"]:checked').val()!="" || $('input:radio[name="visibility_type"]:checked').val()!="undefined"){var visibility_type=$('input:radio[name="visibility_type"]:checked').val();}else{err=1; }
	if($('input:radio[name="visibility_type"]:checked').val()=="I")
	{
		if($('#search_teacher').val()!=""){teacher=$('#search_teacher').val();}
	}
	
	if($('input:radio[name="event_time"]:checked').val()!="" || $('input:radio[name="event_time"]:checked').val()!="undefined"){var event_time=$('input:radio[name="event_time"]:checked').val();}else{err=1; }
	if($('input:radio[name="event_time"]:checked').val()=="T")
	{
		
		if($('#event_from_hh').val()!="" && $('#event_from_mm').val()!="")
		{
        var event_from=$('#event_from_hh').val()+":"+$('#event_from_mm').val()+" "+$('#event_from_ampm').val();
		}else{err=1;}
		if($('#event_to_hh').val()!="" && $('#event_to_mm').val()!="")
		var event_to=$('#event_to_hh').val()+":"+$('#event_to_mm').val()+" "+$('#event_to_ampm').val();
		else {err=1;}
	}
	
	if($('input:radio[name="send_notification"]:checked').val()!="" || $('input:radio[name="send_notification"]:checked').val()!="undefined"){var event_notification=$('input:radio[name="send_notification"]:checked').val();}else{err=1; }
	if($('input:radio[name="send_notification"]:checked').val()=="Y")
	{
	 notification_to=$('input:radio[name="notification_to"]:checked').val();
	}
	/*if($("#m_day_eve").is(':checked'))
	{
		multiple_day="YES";
		if($('#start_date').val()!=""){start_date=$('#start_date').val();}else{err=1;}
		if($('#end_date').val()!=""){end_date=$('#end_date').val();}else{ err=1;}
		//start_date=$('#start_date').val();
		//end_date=$('#end_date').val();
	}*/
	var event_type= $('input:radio[name="event_type"]:checked').val();
	if(err==0)
	{	
	//alert('inner method called');
		var teachersIds="";
		teachersIds=teacher.join(',');
		var gradeIds=grades.join(',');
		var from_time=tConvert(event_from);
		var to_time=tConvert(event_to);
		//alert(from_time);
		//alert(to_time);
		var paramData={'act':'updateCalendarEvent','id':id,'event_date':event_date,'event_name':event_name,'event_desc':event_desc,'event_color':event_color,'school_id':school,'grades':gradeIds,'visibility_type':visibility_type,'teachers_id':teachersIds,'event_time':event_time,'from_time_24':from_time,'to_time_24':to_time,'send_notification':event_notification,'notification_to':notification_to,'from_time':event_from,'to_time':event_to,'event_type':event_type}
		ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data)
			{	
				alert(data);
				data = $.trim(data);
				var dataArr = data.split('::');
				
				var vhtml = '';
				
				if(dataArr[0]=='1' ) {
				if(dataArr[3]=='1') { vhtml += '<li onclick="addCalendarEvent_load('+id+','+event_date+')" id="'+id+'" style="cursor:pointer">'+event_name+'</li>'; $('#'+id).html(vhtml); }
				else $('#'+id).remove();
				closeTemplatePopup();
				} else {
					
				}


				
				}
			});	
	}
	else 
		alert('Some Field is missing');		
}

function selectAllGrade()
{
		$('#search_grade option').prop('selected', true);
      $('#search_grade option[value="All"]').prop('selected','');
}
function selectAllTeachers()
{
	$('#search_teacher option').prop('selected', true);
     $('#search_teacher option[value="All"]').prop('selected','');
}


function displayCalendar(id,month,year) {
	var paramData={'act':'showCal','month':month,'year':year,'school_id':id}
		
			ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				data = $.trim(data);
				var dataArr = data.split('::');
				$('#school_name').html(dataArr[0]);
				$('#calendarShow').html(dataArr[1]);
				}
			});

}


<?
if($_SESSION['YTUserType']=="T")
{
		if($_SESSION['cal_school_id']!="All")
		{
		?>
		displayCalendar('<?=$_SESSION['cal_school_id']?>','','');		
		<?
		}
		else{
			?>
		displayCalendar(<?=$first_school?>,'','');
			<?
			}
}
if($_SESSION['YTUserType']=="SA"){
	?>
	displayCalendar(1,'','');
	<?
	} else {
?>
displayCalendar(<?=$first_school?>,'','');


<?
	}
?>


function deleteCalendarEvent(id)
{
	if(confirm('Are you sure you want to delete this event?')) {
	var paramData={'act':'deleteCalendarEvent','id':id}
	ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data)
			{
				$( "#"+id ).remove();
				closeTemplatePopup();	
			}
		});
	} else
	closeTemplatePopup();	
}
 $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                alert("Checkbox is checked.");
            }
            else if($(this).prop("checked") == false){
                alert("Checkbox is unchecked.");
            }
        });
    });
function multidayEvent(mval)
{
	if($("#m_day_eve").is(':checked'))
	{
		$('.multiple_day_event').css("display", "block");
	}
	else
	{
		$('.multiple_day_event').css("display", "none");
	}
	/*
	if(mval=="Off")
	{
	$('.multiple_day_event').css("display", "block");
	$('#m_day_eve').val('On');
	}
	if(mval=="On")
	{
	$('.multiple_day_event').css("display", "none");
	$('#m_day_eve').val('Off');
	}
	*/
}
function updateCalendarEvent_load(event_date,id)
	{
		popupTemplateDtls("loading please wait");
		event_date=event_date;
		
		var paramData={'act':'showCalendarUpdateEvent','event_date':event_date,'id':id}	
		ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				popupTemplateDtls(data);
				
				}
			});
		
	}

</script>


 
 <!-------------------------calendar support files------------------------->   
    
<?
}
include 'template.php';
?>