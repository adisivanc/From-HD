<?


function main(){




?>


<div class="fullsize">
    <div class="content">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright5" /></td>
                <td>Leave <br/> <span class="f30"><strong>Applications</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop50 cursor" id="show_addteacher">
            
        </div>
    </div>
    
    </div>
</div>



<div class="fullsize">
    <div class="content">
    
        <div class="fullsize padtb15">
        	
            
            
            <div class="newsletter_left"> <!-- Grade Menu -->
          
            	<div class="newsletter_submenu txtwhite">
					<div class="circular_outer">
                    	<div class="newcircular_head" id="show_currentteacher">Catogory<span></span></div>
                        <ul class="currentteacher_content txttheme">
                        	<?
								$rsSchool=School::getAllSchool();
								if(count($rsSchool)>0)
								{
								foreach($rsSchool as $K=>$V)
								{
								?>
                                <li  onclick="getDashBoard(<?=$V->id?>)" style="cursor:pointer"><?=$V->school_name?></li>
                                <?	
								}
								}?>
                        	 
                        </ul>
                    </div>
                    
                </div>
              
            </div>
            
            <!-- Grade Menu -->
            
            <div class="newsletter_right border_theme bgwhite" id="hide_allgradelist"> 
            <!-- Grade -->
            <div class="leave_header">
            Dashboard
            </div>
            <div id="getDashBoard">
            
                                    
                                    
             </div>
            </div><!-- Grade -->
            
        </div>
    
    </div>
</div>




<script type="text/javascript">

function defaultLoader(){
	
	jQuery('#TimeSlotAssignTop').empty().html('');
	var vhtm = new Array();
	var i = 0;
	addTimeSlot();
}


<!-- Popup --->

function show_approved_leaves(){
	
  	$("#approved_leaves").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "puff", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_approved_leaves(){  $("#approved_leaves").dialog('close');  }



function show_pending_leave(){
	
  	$("#pending_leave").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "puff", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_pending_leave(){  $("#pending_leave").dialog('close');  }


function show_reject_leaves(){
	
  	$("#reject_leave").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "puff", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_reject_leaves(){  $("#reject_leave").dialog('close');  }



function showLeaveApplicat(showBy,school_id)
{
		var paramData={'act':'showLeaveApplicat','showBy':showBy,'school_id':school_id}
	ajax({
			a:'leave_process',		
			b:$.param(paramData),			
			c:function(){},
			d:function(data){
			$('#load_leaveapplicant').html(data);
				
			}			
		});

}
function showPendingdDetail(status)
{
	//show_approved_leaves();
	var paramData={'act':'showPendingdDetail','status':status}
	ajax({
		a:'leave_process',
		b:$.param(paramData),
		c:function(){},
		d:function(data){
				//alert(data);
				$('#leave_content').html(data);
			//$('#approved_leaves').html(data);
				
			},
		});
}

function saveLeaveApplicant(id,school_id)
{
var paramData={'act':'saveLeaveApplicant','id':id}
ajax({
	a:'leave_process',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		showLeaveApplicat('',school_id);
		$('#leave_content').html('');
		}
	
	});
}
function rejectLeaveApplicant(id,school_id)
{
	var paramData={'act':'rejectLeaveApplicant','id':id}
ajax({
	a:'leave_process',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		showLeaveApplicat('',school_id);
		$('#leave_content').html('');	
		}
	
	});	
}
getDashBoard(1);
function getDashBoard(schoolId)
{
	var paramData={'act':'getDashBoard','school_id':schoolId}	
	ajax({
		a:'leave_process',
		b:$.param(paramData),
		c:function(){},
		d:function(data){
				$('#getDashBoard').html(data);
				showLeaveApplicat('',schoolId);			
			}
		});
}
///the leave functions start here


</script>







<?

}
include "template.php";
?>


