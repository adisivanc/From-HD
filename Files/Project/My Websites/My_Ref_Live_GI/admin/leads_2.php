<?
function main(){
?>


<div class="container-fluid" style="padding-top:25px;">
<div class="container">

    <div class="row"> 

        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_outer">
          <tr>
            <th class="leads_tab active" id="show_leadtab_details">Details</th>
            <th class="leads_tab" id="show_leadtab_order">Order</th>
            <th class="leads_tab" id="show_leadtab_report">Report</th>
            <th class="leads_tab" id="show_leadtab_notes">Notes</th>
            <th class="leads_tab" id="show_leadtab_log">Log</th>
          </tr>
          <tr>
            <td colspan="5">
            
                <div class="full_width" id="leadtab_details">
                	<? include "include_leaddetails.php"; ?>
            	</div>
                
                <div class="full_width" id="leadtab_order" style=" height:435px;">
                	<div class="row">
                        Previous Order <br/> Next Order
                    </div>
                </div>
                
                <div class="full_width" id="leadtab_report" style=" height:435px;">
                	<div class="row">
                        Report
                    </div>
                </div>

                <div class="full_width" id="leadtab_notes" style=" height:435px;">
                	<div class="row">
                        Notes
                    </div>
                </div>
                
                <div class="full_width" id="leadtab_log" style=" height:435px;">
                	<div class="row">
                        Log Activities
                    </div>
                </div>
            
            </td>
          </tr>
        </table>
    </div>
</div>
</div>






<!--- Popup --->

<div id="edit_exceutive_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family:Arial, Helvetica, sans-serif; ">
    <table width="500" border="0" cellspacing="0" cellpadding="0" class="addfollowup_popuptbl">
      <tr>
        <th colspan="2">Executive <span class="pull_right cursor" onClick="close_edit_exceutive_popup()"><img src="images/close1.png" alt="Close" title="Close" /></span> </th>
      </tr>
      <tr>
        <td width="135" valign="top">Choose Executive</td>
        <td valign="top">
              <select class="combo-lg" name="executive_id" id="executive_id">
              	<option value="">Choose Executive</option>
                <option value="1">Raja</option>
              </select>
        </td>
      </tr>
      <tr>
        <td valign="top">Notes</td>
        <td valign="top"> <textarea class="txtarea" id="followup_notes" name="followup_notes"></textarea> </td>
      </tr>
      <tr>
        <td colspan="2"><div class="btn pull_right" onClick="update_executive()"> Add </div></td>
      </tr>
    </table>
</div>


<div id="show_followup" class="popupbox" style="padding:0; margin:0; display:none; font-family:Arial, Helvetica, sans-serif; ">
</div>



<script type="text/javascript">


function update_executive()
{
	var err = 0;
	
	if(	$('#executive_id').val()=='' ){ err=1; $('#executive_id').addClass('boxred'); } else { $('#executive_id').removeClass('boxred'); }
	if(	$('#followup_notes').val()=='' ){ err=1; $('#followup_notes').addClass('boxred'); } else{ $('#followup_notes').removeClass('boxred'); }
	
	if(err==0){ 
	
	
	
	}
}


$("#show_leadtab_details").click( function() {
	$("#leadtab_details").show();
	$("#leadtab_order").hide();
	$("#leadtab_report").hide();
	$("#leadtab_notes").hide();
	$("#leadtab_log").hide();
});


$("#show_leadtab_order").click( function() {
	$("#leadtab_order").show();
	$("#leadtab_details").hide();
	$("#leadtab_notes").hide();
	$("#leadtab_log").hide();
	$("#leadtab_report").hide();
});


$("#show_leadtab_report").click( function() {
	$("#leadtab_report").show();
	$("#leadtab_order").hide();
	$("#leadtab_details").hide();
	$("#leadtab_notes").hide();
	$("#leadtab_log").hide();
});


$("#show_leadtab_notes").click( function() {
	$("#leadtab_notes").show();
	$("#leadtab_order").hide();
	$("#leadtab_details").hide();
	$("#leadtab_report").hide();
	$("#leadtab_log").hide();
});


$("#show_leadtab_log").click( function() {
	$("#leadtab_log").show();
	$("#leadtab_order").hide();
	$("#leadtab_details").hide();
	$("#leadtab_report").hide();
	$("#leadtab_notes").hide();
});



$('.leads_tab').click(function(){
	$('.leads_tab').removeClass('active');
	$(this).addClass('active');
});


<!-- Popup --->

function edit_exceutive_popup(){
	
  	$("#edit_exceutive_popup").dialog({
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

function close_edit_exceutive_popup(){  $("#edit_exceutive_popup").dialog('close');  }

<!-- Popup --->



<!-- Followup Popup -->

function editFollowup(lead_followup_id,lead_id){
	
paramData = {'act':'editFollowup','followup_id':lead_followup_id,'lead_id':lead_id};


$('#show_followup').html('Loading followups..please wait');	
paramData = {'act':'showFollowup','followup_id':lead_followup_id,'lead_id':lead_id};
ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		$('#show_followup').html(data);	
		//$('#followup_lead_id').val(lead_id);
		load_followups(lead_id);
	}});
	
	
	}

  	$("#show_followup").dialog({
		autoOpen: false,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});


	$(".ui-widget-header").css({"display":"none"});

function show_followup(lead_id){

$("#show_followup").dialog('open');
$('#show_followup').html('Loading followups..please wait');	
paramData = {'act':'showFollowup','lead_id':lead_id};
ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		$('#show_followup').html(data);	
		//$('#followup_lead_id').val(lead_id);
		load_followups(lead_id);
	}});

}

function close_followup(){ $("#show_followup").dialog('close'); }

<!-- Followup Popup -->

</script>

<?
}
include "template.php";
?>