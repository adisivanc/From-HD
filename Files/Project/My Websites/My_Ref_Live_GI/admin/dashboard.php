<?
function main(){
?>



<div class="container-fluid" style="padding-top:25px;">
<div class="container">

    <div class="row"> <h2 class="page_header">Dashboard</h2></div>
    
    <div class="row" style="padding-top:10px; padding-bottom:10px;">
        <div class="followup_count">Today's Followups : 5 </div>
        <div class="btn pull_right" onClick="show_addfollowup_popup()"> Add Followup </div>
    </div>
    
    <div class="row">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="today_followuptbl">
          <tr>
            <th width="32">#</th>
            <th width="20%">Company Name</th>
            <th width="20%">Contact Person</th>
            <th width="50%">Notes</th>
            <th width="8%">Action</th>
          </tr>
          <tr>
            <td valign="top">1</td>
            <td valign="top"><strong>Aarbee Agencies</strong> <br/> 413, Kamarajar Road, <br/> Lakshmipuram,<br/> Peelamedu, CBE-04</td>
            <td valign="top">Radhakrishnan <br/> 0422-2575656</td>
            <td valign="top">The controller receives all requests for the application and then works with the model to prepare any data needed by the view. The controller receives all requests for the 
            application and then works with the model to prepare any data needed by the view. </td>
            <td valign="top"> 
                <img src="images/edit_icon.png" alt="Edit" title="Edit" onClick="show_addfollowup_popup()" />
                <img src="images/add_icon.png"  alt="Add" title="Add" onClick="show_addfollowup_popup()" /> 
            </td>
          </tr>
          <tr>
            <td valign="top">2</td>
            <td valign="top"><strong>Aarbee Agencies</strong> <br/> 413, Kamarajar Road, <br/> Lakshmipuram,<br/> Peelamedu, CBE-04</td>
            <td valign="top">Radhakrishnan <br/> 0422-2575656</td>
            <td valign="top">The controller receives all requests for the application and then works with the model to prepare any data needed by the view. The controller receives all requests for the 
            application and then works with the model to prepare any data needed by the view. </td>
            <td valign="top"> 
                <img src="images/edit_icon.png" alt="Edit" title="Edit" onClick="show_addfollowup_popup()" />
                <img src="images/add_icon.png"  alt="Add" title="Add" onClick="show_addfollowup_popup()" /> 
            </td>
          </tr>
        </table>
    </div>


</div>
</div>



<!--- Popup --->

<div id="add_followup_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family:Arial, Helvetica, sans-serif; ">
    <table width="500" border="0" cellspacing="0" cellpadding="0" class="addfollowup_popuptbl">
      <tr>
        <th colspan="2">Follow Up <span class="pull_right cursor" onClick="close_addfollowup_popup()"><img src="images/close1.png" alt="Close" title="Close" /></span> </th>
      </tr>
      <tr>
        <td width="135">Company</td>
        <td><input type="text" class="txtbox" id="followup_cmpy" name="followup_cmpy" value="" /> </td>
      </tr>
      <tr>
        <td>Followup Date</td>
        <td><input type="text" class="txtbox datepicker" id="followup_date" name="followup_date" value="" /> </td>
      </tr>
      <tr>
        <td>Notes</td>
        <td> <textarea class="txtarea" id="followup_notes" name="followup_notes"></textarea> </td>
      </tr>
      <tr>
        <td colspan="2"><div class="btn pull_right" onClick=""> Add </div></td>
      </tr>
    </table>
</div>




<script type="text/javascript">

<!-- Popup --->

function show_addfollowup_popup(){
	
  	$("#add_followup_popup").dialog({
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

function close_addfollowup_popup(){  $("#add_followup_popup").dialog('close');  }

<!-- Popup --->


$(function() {
   $(".datepicker").datepicker({
		changeMonth: true
   });  
});

</script>

<?
}
include "template.php";
?>