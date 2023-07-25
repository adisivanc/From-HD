<?
include('includes.php');
if($_POST['act']=="deleteLeaveApplication")
{
		
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
        <input type="hidden" name="school_id" id="school_id" value="<?=$school_id?>" />
        <input type="hidden" name="studentId" id="studentId" value="<?=$studentId?>" />
        <input type="hidden" name="leaveFromDate" id="leaveFromDate" value="<? echo date('d-m-Y',strtotime($eventDate))?>" />
    	
            <table width="550" border="0" cellspacing="0" cellpadding="0" class="leave_apptbl">
              <tr>
              	<th colspan="2">
                    Leave Application for <?=$studentName?>
                    <span class="pull_right cursor" onclick="close_leave_application()" style="margin-right:10px">X</span>
                </th>
              </tr>              
              <tr>
                <td width="100" valign="top"><strong>Date</strong></td>
                <td valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                       	 <td><? echo date('d/m/Y',strtotime($eventDate))?></td>
                      </tr>
                      <tr>
                        <td>
                            <input type="radio" id="leave_option" name="leave_option" value="S" /> Single Day
                            <input type="radio" id="leave_option" name="leave_option" value="M" /> Multiple Days
                        </td>                           
                      </tr>
                      <tr>
                       	    <td id="multipleDay_Dtl" style="display:none">To Date <input class="txtbox datepicker" type="text" id="leaveToDate" name="leaveToDate" value="" style="width:100px;" />
                            <script type="text/javascript">																	
									$(".datepicker").datepicker({
										changeMonth: true,
										minDate: new Date(),
										dateFormat: 'dd-mm-yy'
								   });
							</script>
                            </td>
                      </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                    <strong>Reason</strong> <br/>
                    <textarea class="txtarea_full" id="lev_reason" name="lev_reason" style=" margin:10px 0 25px 0;"></textarea>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                    <div class="apply_btn" onclick="submitLeaveForm()"><strong>Apply</strong></div>
                </td>
              </tr>
            </table>

    <?
	exit();	
}

if($_POST['act']=='showCal')
 {
	ob_clean();
	$mn = $_POST['month'];
	$yr = $_POST['year'];
	$school_id = $_POST['school_id'];
	$gradeId=$_POST['gradeId'];
	$studentId=$_POST['studentId'];
	//echo $school_id;
	$rsSchool = School::getSchoolById($school_id);
	print_r($rsSchool);
	ob_clean();
	echo $rsSchool->school_name.'::';
	displayCalendar($school_id,$mn,$yr,$gradeId,$studentId);
	exit();	
}
?>	
<!------------------calendar added here------------------------------>
    <div class="fullsize">
    
             
  
          
          		<div class="fullsize pad10"  id="calendarDisplay" align="center">
                <table width="70%" cellpadding="5" cellspacing="5">
                <tr>
                    <td>
                        <div class="fullsize" style="margin:15px 0;">
                        <div class="indication" ><span class="color_box" style="background:#cccccc;"></span> Current Date</div>
                        <div class="indication" style="margin-left:15px;"><span class="color_box" style="background:#ffff00;"></span> Leave Pending </div>
                        <div class="indication" style="margin-left:15px;"><span class="color_box" style="background:#85e49d;"></span> Leave Approved </div>
                        <div class="indication" style="margin-left:15px;"><span class="color_box" style="background:#fd7e71;"></span> Leave Rejected </div>
                        </div>
                    </td>
                </tr>
                <tr><td id="calendarShow"></td></tr></table>         
          </div>
          

     </div>
 <div id="login_error_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'LetterGothicMTStd';">
   		<div class="full_width">
        	<table width="580" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;" class="validate_popuptbl">
              <tr>
                <th colspan="2">
                	<div style="float:left;">Leave Request</div>
                    <div onclick="close_login_error_popup()" class="close_validate_popup">X</div>
                </th>
              </tr>
              <tr>
                <td><img src="images/alert_icon.png" alt="" /></td>
                <td>Your leave request has been submitted successfully. Waiting For Approval !</td>
              </tr>
              <tr>
                <td colspan="2" align="center"><div class="okbtn" onclick="close_login_error_popup()">OK</div></td>
              </tr>
            </table>
        </div>
</div>

     

<!-- calendar  -->

<script type="text/javascript">

function show_login_error_popup(){
	
  	$("#login_error_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_login_error_popup(){  $("#login_error_popup").dialog('close'); document.location.href="dashboard.php"; }


function displayCalendar(id,month,year,gardeId,studrntId) {
	
		var paramData={'act':'showCal','month':month,'year':year,'school_id':id,'gradeId':gardeId,'studentId':studrntId}
		
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
function LeaveApplay(studentId,event_date,school_id)
	{
		
		//popupTemplateDtls("loading please wait");
		show_leave_application();
		var paramData={'act':'leaveApplication','event_date':event_date,'studentId':studentId,'school_id':school_id}	
		ajax({
			a:'calendar',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				$('#leave_application_popup').html(data);
				
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
	var studentId=$('#studentId').val();
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
	
	var paramData={'act':'saveLeaveApplication','studentId':studentId,'leaveFromDate':leaveFromDate,'leaveOption':leave_option,'leaveToDate':leaveToDate,'leaveReason':leaveReason,'school_id':school_id}
	//alert(jquery.parseJSON(paramData));
	if(err==0)
	{
		ajax({
			a:'student_process',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				//alert(data);
				close_leave_application();
				show_login_error_popup();
//				alert("");
		
				
				}
			});
	}	
}	
function showDetailsToParents(id,event_date){
	show_leave_application();
	$('#leave_application_popup').html("Loading Please Wait");
	var paramData={'act':'showCalendarDetail','id':id,'event_date':event_date}
	ajax({
			a:'student_process',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
					$('#leave_application_popup').html(data);
				}
		});
	}
function cancelStudentLeave(id,event_date)
{
	show_leave_application();
	$('#leave_application_popup').html("Loading Please Wait");
	var paramData={'act':'cancelStudentLeave','id':id,'event_date':event_date}
	ajax({
			a:'student_process',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
					$('#leave_application_popup').html(data);
				}
		});
	
}
function deleteLeaveApplication(id)
{
	var paramData={'act':'deleteLeaveApplication','id':id}
	ajax({
			a:'student_process',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				alert(data);
				close_leave_application();
				document.location.href="dashboard.php";	
				}
		});
}
</script>


 
 <!-------------------------calendar support files------------------------->   
    
<?

?>