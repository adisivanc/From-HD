<?
function main(){
if($_POST['act']=="saveContact_old") {
	print_r($_POST);
	ob_clean();
	$studentId = $_POST['student_db_id'];
	
	
/*******************sivamani working here********************************************/

	//Student::updateStudentByFields($fieldsArr, $_POST['studentId']);
	$fieldsArr=array();
	$fieldsArr[] = "father_phone='".$_POST['father_phone']."'";
	$fieldsArr[] = "father_email='".$_POST['father_email']."'";
	$fieldsArr[] = "father_qualification='".$_POST['father_qualification']."'";
	$fieldsArr[] = "mother_phone='".$_POST['mother_phone']."'";
	$fieldsArr[] = "mother_email='".$_POST['mother_email']."'";
	$fieldsArr[] = "current_address='".$_POST['current_address']."'";
	$fieldsArr[] = "current_state='".$_POST['current_state']."'";
	$fieldsArr[] = "current_city='".$_POST['current_city']."'";
	$fieldsArr[] = "current_zipcode='".$_POST['current_zipcode']."'";
	$fieldsArr[] = "emergency_contact_name='".$_POST['emer_name']."'";
	$fieldsArr[] = "email_address='".$_POST['email_address']."'";
	$fieldsArr[] = "emergency_contact_number='".$_POST['emer_number']."'";
	$fieldsArr[] = "emergency_contact_relationship='".$_POST['emer_relation']."'";
	//print_r($fieldsArr);
	Student::updateStudentByFields($fieldsArr, $studentId);
	echo "Updated Successfully..!";
	$rsStudent=Student::getStudentById($studentId);
	$siblings=$rsStudent->siblings;
	//print_r($sibling);
	$sibling[]=array();
	$sibling=explode(',',$siblings);
		foreach($sibling as $K1 => $V1)
				{
					Student::updateStudentByFields($fieldsArr, $V1);
					//echo "Updated Successfully..!";
				}
		exit();
		
/*******************sivamani working here********************************************/
				
	
}
if($_POST['act']=="saveContact") {
	
	ob_clean();
	$studentId = $_POST['student_db_id'];
	
	
/*******************sivamani working here********************************************/

	//Student::updateStudentByFields($fieldsArr, $_POST['studentId']);
	$fieldsArr=array();
	$fieldsArr[] = "father_phone='".$_POST['father_phone']."'";
	$fieldsArr[] = "father_email='".$_POST['father_email']."'";
	$fieldsArr[] = "father_qualification='".$_POST['father_qualification']."'";
	$fieldsArr[] = "mother_phone='".$_POST['mother_phone']."'";
	$fieldsArr[] = "mother_email='".$_POST['mother_email']."'";
	$fieldsArr[] = "current_address='".$_POST['current_address']."'";
	$fieldsArr[] = "current_state='".$_POST['current_state']."'";
	$fieldsArr[] = "current_city='".$_POST['current_city']."'";
	$fieldsArr[] = "current_zipcode='".$_POST['current_zipcode']."'";
	$fieldsArr[] = "emergency_contact_name='".$_POST['emer_name']."'";
	$fieldsArr[] = "email_address='".$_POST['email_address']."'";
	$fieldsArr[] = "emergency_contact_number='".$_POST['emer_number']."'";
	$fieldsArr[] = "emergency_contact_relationship='".$_POST['emer_relation']."'";
	//print_r($fieldsArr);
	Student::updateStudentByFields($fieldsArr, $studentId);
	
	$rsStudent=Student::getStudentById($studentId);
	$siblings=$rsStudent->siblings;
	//print_r($sibling);
	$sibling[]=array();
	$sibling=explode(',',$siblings);
		foreach($sibling as $K1 => $V1)
				{
					Student::updateStudentByFields($fieldsArr, $V1);
					//echo "Updated Successfully..!";
				}
	//send acknow mail here
	
	
	echo "Updated Successfully..!";
	//sends acknow mail on here
		exit();
		
/*******************sivamani working here********************************************/
				
	
}	
?>

<div class="full_width">

    <? include('menu.php');?>
    
    <div class="panel_right">
    	<div class="full_width">
        
            <div class="page_header" id="basic_content">
                
            </div>
            
            <div class="page_content">
				
                <div class="dashboard_content" id="dashboard_content">
				</div>
                
                <div class="dashboard_upcoming" id="dashboard_upcoming">
                   
				</div>
                
            </div>
        
        </div>
    </div>

</div>


<script type="text/javascript">
	
$('.panal_menu').click(function(){
	$('.panal_menu').removeClass('active');
	$(this).addClass('active');
	
	$('.students_list').slideUp('slow');
	$(this).next('.students_list').slideDown('slow');

});
////parent_new
function changePassword(user_email) {
		var paramData =  
				{
				"act":"change_pwd",
				"user_email": "<?=$_SESSION['user_email']?>"
				};

			ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					//alert(data);
					$('#dashboard_content').html(data);
				}
			});
	
	}

function getStudentContact(student_id) {

 		var paramData =  
				{
				"act":"getContact",
				"student_id": student_id
				};

			ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
				
					$('#dashboard_content').html(data);
					
				}
				
			});
		
	}
	function getRecentActivity(student_id,count)
	{
		
		var paramData =  
				{
				"act":"student_recentActitvity","count":count,
				"student_id": student_id
				};

			ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					$('#student_content').html(data);
				}
			});
	} 
	function getStudentScreen(student_id) {

 		var paramData =  
				{
				"act":"student_screen",
				"student_id": student_id
				};

			ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					
					$('#dashboard_content').html(data);
					getCommunication(student_id);
					getComingUp(student_id);
				}
			});
	
	}
function getBasicDetai(student_id)
{
	
var paramData =  
				{
				"act":"student_basicDetail",
				"student_id": student_id
				};

			ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					
					$('#basic_content').html(data);
				}
			});
}
function getComingUp(student_id)
{
var paramData =  
				{
				"act":"getComingUp",
				"student_id": student_id
				};

			ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {					
					$('#dashboard_upcoming').html(data);
				}
			});		
}
function submitStudent(e){ 
 	var myFrm = document.getElementById('studentContactFrm');
		$('#saveImg').hide();
		$('#processingImg').show();
		$.ajax({
			url: 'dashboard.php',
			type: 'POST',
			data: new FormData(myFrm),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#saveImg').show();
				$('#processingImg').hide();
				//alert(data); return false;
				alert(data);
			}
		});
}
function getSCalendar(student_id) {
 		var paramData =  
				{
				"act":"getSCalendar",
				"student_id": student_id
				};

			ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
										
					$('#student_content').html(data);
						$('.sub_nav').removeClass('active');
						$('#menu_calendar').addClass('active');
				
				}
			});
}
function getCommunication(student_id)
{
	var paramData={
		"act":"getCommunication",
		"student_id":student_id
		};
		ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					$('#student_content').html(data);
				
				}
			});	
}
function getSubjects(grade_id,student_id) {
	 		var paramData =  
				{
				"act":"getSubjects",
				"grade_id":grade_id,
				"student_id":student_id
				};

			ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					$('#student_content').html(data);
				}
			});
}


function getDownloads(grade_id,student_id) {
	 		var paramData =  
				{
				"act":"getDownloads",
				"grade_id":grade_id,
				"student_id":student_id
				};

			ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					$('#student_content').html(data);
				}
			});
}
<!-- Leave Popup  --->

function show_leave_application(){
	
  	$("#leave_application_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 300 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_leave_application(){  $("#leave_application_popup").dialog('close');  }


//////////////
getBasicDetai('<?=$_SESSION['studentId']?>');
getStudentScreen('<?=$_SESSION['studentId']?>');
//recent activity page
function show_inbox_popup(){
	
  	$("#inbox_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_inbox_popup(){ $("#inbox_popup").dialog('close');  }

//coming up detail
function getComingUpDetail(id)
{
	show_leave_application();
	var paramData =  
				{
				"act":"showCalendarDetail",
				"id":id
				};

			ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					$('#leave_application_popup').html(data);
				}
			}); 	
}



</script>

<?
}
include "template.php";
?>