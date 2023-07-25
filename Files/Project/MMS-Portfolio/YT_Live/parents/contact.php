<?
function main()
{
	$studentId=$_SESSION['studentId'];
?>
<style>

#calendar { width: 98%; margin: 0 auto; border:1px solid #7f9bab; }
#calendar .fc-toolbar .fc-left { border:0; }
#calendar .fc-toolbar .fc-left button .fc-prev-button { display:none; }
#calendar .fc-toolbar .fc-left button .ui-button { display:none; }
#calendar .fc-toolbar .fc-left button .ui-state-default { display:none; }
#calendar .fc-toolbar .fc-left button .ui-corner-left { display:none; }
#calendar .fc-toolbar .fc-left button .ui-corner-right{ display:none; }
#calendar .fc-toolbar .fc-left button span { display:none; }
#calendar .fc-toolbar .fc-left button { background:url(images/arrow_left.png) no-repeat; height:30px; width:25px; }

#calendar .fc-toolbar .fc-right { border:0; }
#calendar .fc-toolbar .fc-right button .fc-prev-button { display:none; }
#calendar .fc-toolbar .fc-right button .ui-button { display:none; }
#calendar .fc-toolbar .fc-right button .ui-state-default { display:none; }
#calendar .fc-toolbar .fc-right button .ui-corner-left { display:none; }
#calendar .fc-toolbar .fc-right button .ui-corner-right{ display:none; }
#calendar .fc-toolbar .fc-right button span { display:none; }
#calendar .fc-toolbar .fc-right button { background:url(images/arrow_right.png) no-repeat; height:30px; width:25px; }

#calendar .fc-toolbar { margin-top:10px; padding-bottom:7px; border-bottom:1px solid #7f9bab; }	
</style>
<div id="student_content">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #003f72;">
          <tr>
            <td style="background:#eec290;">
            	<div class="student_header" style="float:left;">Edit Your Details</div>
                <div class="student_header" style="float:right;"></div>
            </td>
          </tr>
         
          <tr>
            <td id="content">
            <?
			include('student_contact.php');
			?>
            </td>
          </tr>
          
          
 </table>
</div>



<script type="text/javascript">

/*	$(document).ready(function() {

		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev',
				center: 'title',
				right: 'next'
			},
			defaultDate: '2015-05-14',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					title: 'All Day Event',
					start: '2015-05-01',
					imgs:''
				},
				{
					title: 'Long Event',
					start: '2015-05-07',
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2015-05-09T16:00:00'
				},
				{
					title: 'Conference',
					start: '2015-05-11',
				},
				{
					title: 'Birthday Party',
					start: '2015-05-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2015-05-28'
				}
			]
		});
		
	});

*/<!-- Leave Popup  --->

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




<!-- Make Appoinment  --->

function show_make_appoinment(){
	
  	$("#make_appoinment_popup").dialog({
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

function close_make_appoinment(){  $("#make_appoinment_popup").dialog('close');  }





$('.menuitem').click(function(){
	$('.menuitem').removeClass('active');
	$(this).addClass('active');
	window.location.href = "student.php";
});


$('.stdmenu').click(function(){
	$('.stdmenu').removeClass('active');
	$(this).addClass('active');
	
});


$('#show_calendar').click(function() {
	$('.fc-left button').click();
	$('.fc-right button').click();
	$("#calendar .fc-view-container .fc-month-view").addClass('fc-basic-view');
	$("#calendar .fc-view-container .fc-month-view table").show();
});





//////////////////////////////
//////////////////saranya/////////////////////////

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
					
					$('#student_content').html(data);
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
					//alert(data);
					$('#student_content').html(data);
				}
			});
	
	}

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
					$('#student_content').html(data);
				}
			});
	
	}

///////////////saranya//////////////////////////////

</script>

<?	

}
include 'template.php';
?>