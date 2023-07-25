
<style>
.boxerror{border:1px solid #F00;}
</style>
<form name="eventFrm" id="eventFrm" method="post" enctype="multipart/form-data">
  <input type="hidden" name="act" id="act" value="eventSubmit" />
  <input type="hidden" name="event_db_id" id="event_db_id" value="<?=$eventId?>" />
  
  
    <!--<div class="tabouter">
      <div class="tabbtn active">Events</div>
      <div class="tabbtn">Add Session</div>
      <a href="events.php" style="float:right;"> Event List </a> 
    </div>-->
    
<div class="fullsize pad10">
    <table width="98%" border="0" cellspacing="0" cellpadding="0" class="newsheadertbl">
        <tr>
            <td colspan="2"><span class="pagehd">Event Details</span></td>
        </tr>
        
        <tr>
          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">
              <tr>
                <td>Event Name <span class="txterror">*</span></td>
                <td><input type="text" class="txtbox" name="event_name" id="event_name" value="<?=$rs_event->event_name?>" /></td>
                <td>Event Type <span class="txterror">*</span></td>
                <td>
                	<select name="event_type" id="event_type" class="listbox" onchange="showMultipleDates(this.value);">
                    	<option value="">Choose Type</option>
                        <option value="M">Multiple Day</option>
                        <option value="S">Single Day</option>
                	</select>
                    <script type="text/javascript">
						$('#event_type').val('<?=$rs_event->event_type?>');
					</script>
                </td>
              </tr>
              
              <tr>
                <td>Event From Date <span class="txterror">*</span></td>
                <td><input type="text" class="txtbox"  name="event_from_date" id="event_from_date" value="<?=($rs_event->event_from_date!="" && $rs_event->event_from_date!="1970-01-01")?$rs_event->event_from_date:""?>" /></td>
                <td id="todatevaluetab1" style="display:<?=($rs_event->event_type=="M")?"":"none"?>;">Event To Date <span class="txterror">*</span></td>
                <td id="todatevaluetab2" style="display:<?=($rs_event->event_type=="M")?"":"none"?>;"><input type="text" class="txtbox"  name="event_to_date" id="event_to_date" value="<?=($rs_event->event_to_date!="" && $rs_event->event_to_date!="1970-01-01")?$rs_event->event_to_date:""?>" /></td>
              </tr>
              
              <tr>
                <td>Event From Time <span class="txterror">*</span></td>
                <td><? $fromdateArr = explode(":", $rs_event->from_time); $fromdateArr1 = explode(" ", $fromdateArr[1]); ?>
                	<select class="listbox border_white" style="width:57px" id="event_from_hh" name="event_from_hh">
                    	<option value="">HH</option>
                    	<?  for($i=1; $i<=12; $i++){ ?>
                     	<option value="<?=($i<10)?'0'.$i:$i?>"><?=($i<10)?'0'.$i:$i?></option>
                     	 <? } ?>
                    </select>
                    <script type="text/javascript">
						$('#event_from_hh').val('<?=$fromdateArr[0]?>');
					</script>
                    <span> : </span>
                	<select class="listbox border_white" style="width:57px" id="event_from_mm" name="event_from_mm">
                    	<option value="">MM</option>
                    	<?  for($i=0; $i<=11; $i++){ ?>
                     	<option value="<?=($i*5<10)?'0'.$i*5:$i*5?>"><?=($i*5<10)?'0'.$i*5:$i*5?></option>
                     	 <? } ?>
                    </select>
                    <script type="text/javascript">
						$('#event_from_mm').val('<?=$fromdateArr1[0]?>');
					</script>
                	<select class="listbox border_white" style="width:60px" id="event_from_ampm" name="event_from_ampm">
                      <option value="AM">AM</option>
                      <option value="PM">PM</option>
                    </select>
                    <script type="text/javascript">
						$('#event_from_ampm').val('<?=$fromdateArr1[1]?>');
					</script>
                </td>
                <td>Event To Time <span class="txterror">*</span></td>
                <td>
				<? $todateArr = explode(":", $rs_event->to_time); $todateArr1 = explode(" ", $todateArr[1]); ?>
                	<select class="listbox border_white" style="width:57px" id="event_to_hh" name="event_to_hh">
                    	<option value="">HH</option>
                    	<?  for($i=1; $i<=12; $i++){ ?>
                     	<option value="<?=($i<10)?'0'.$i:$i?>"><?=($i<10)?'0'.$i:$i?></option>
                     	 <? } ?>
                    </select>
                    <script type="text/javascript">
						$('#event_to_hh').val('<?=$todateArr[0]?>');
					</script>
                    
                    <span> : </span>
                	<select class="listbox border_white" style="width:57px" id="event_to_mm" name="event_to_mm">
                    	<option value="">MM</option>
                    	<?  for($i=0; $i<=11; $i++){ ?>
                     	<option value="<?=($i*5<10)?'0'.$i*5:$i*5?>"><?=($i*5<10)?'0'.$i*5:$i*5?></option>
                     	 <? } ?>
                    </select>
                    <script type="text/javascript">
						$('#event_to_mm').val('<?=$todateArr1[0]?>');
					</script>
                    
                	<select class="listbox border_white" style="width:60px" id="event_to_ampm" name="event_to_ampm">
                      <option value="AM">AM</option>
                      <option value="PM">PM</option>
                    </select>
                    <script type="text/javascript">
						$('#event_to_ampm').val('<?=$todateArr1[1]?>');
					</script>
                </td>
              </tr>
              
              <tr>
                <td valign="top">Address <span class="txterror">*</span></td>
                <td><textarea class="msgbox" name="event_address" id="event_address"><?=$rs_event->event_address?></textarea></td>
                <td valign="top">Event File</td>
                <td valign="top"><input type="file" name="event_file" id="event_file">
                  <? if($rs_event->event_file!=''){?>
                  <input type="hidden" name="h_event_file" id="h_event_file" value="<?=$rs_event->event_file?>" />
                  <img src="<?=EVENT_FILE_HREF.$rs_event->event_file?>" width="50" height="50"/>
                  <? } ?></td>
              </tr>
              
              <tr>
                <td valign="top">Contact Name <span class="txterror">*</span></td>
                <td><input type="text" class="txtbox" name="contact_name" id="contact_name" value="<?=$rs_event->contact_person?>" /></td>
                <td valign="top">Contact Email <span class="txterror">*</span></td>
                <td><input type="text" class="txtbox" name="contact_email" id="contact_email" value="<?=$rs_event->contact_email?>" /></td>
              </tr>
              
              <tr>
                <td valign="top">Contact Phone <span class="txterror">*</span></td>
                <td><input type="text" class="txtbox"  name="contact_phone" id="contact_phone" value="<?=$rs_event->contact_phone?>" /></td>
                <td valign="top">Event Place <span class="txterror">*</span></td>
                <td>
                	<? $rs_schools = School::getAllSchool(); ?>
                	<select id="event_place" name="event_place" class="listbox border_white">
                    	<option value="">Choose Place</option>
                       <? 
					   if(count($rs_schools)>0) { 
					   	foreach($rs_schools as $sk=>$sv) {
						?>
                        <option value="<?=$sv->id?>" <?=($sv->id==$rs_event->event_place)?"selected":""?>><?=$sv->school_name?></option>
                        <?
						}
					   }
					   ?>
                    </select>
                	<!--<input type="text" class="txtbox" name="event_place" id="event_place" value="<?=$rs_event->event_place?>" />-->
                </td>
              </tr>
              
              <tr>
                <td valign="top">Description <span class="txterror">*</span></td>
                <td colspan="3"><textarea class="msgbox" name="event_desc" id="event_desc" style="width:980px; height:200px;"><?=stripslashes($rs_event->description)?></textarea></td>
              </tr>
            </table></td>
        </tr>
        
        <tr>
            <td colspan="2"><span class="pagehd">Session Details</span></td>
        </tr>
        
        <tr>
        	<td colspan="2">
            	<div id="SessionLevelTop"></div>
                <div style="float:right; margin-right:0px; margin-bottom:30px;">
                    <span class="spancursor" id="SessionLevel_a" style="cursor:pointer; padding-left:15px;" onclick="addSessionTopLevel();">
                    	<div class="pull_right txtbold f24 cursor">+</div>
                    </span>
                </div>
            </td>
        </tr>
        
        <tr>
          <td align="right" colspan="2">
            <? if($rs_event->id>0) { $actionName = "Update"; } else { $actionName = "Add"; } ?>
            <div class="fullsize txtwhite txtcenter f18">
	            <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="savebtn" onClick="saveEventDtls('<?=$rs_event->id?>', event)"><strong><?=$actionName?></strong></div>
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="loadingbtn" style="display:none;"><strong>Loading..</strong></div>
            </div>
          </td>
        </tr>
        
      </table>
</div>
    
<input type="hidden" name="sessionpluscount" id="sessionpluscount" />
</form>


<script type="text/javascript">

<? if($rs_event->id>0) { ?>
showMultipleDates('<?=$rs_event->event_type?>');
<? } ?>

$(function() { 
	
	$.datepicker.setDefaults({minDate: new Date()});
	$('#event_from_date').datepicker({ 
		onSelect: function(date) {
			date = $(this).datepicker('getDate');
			var maxDate = new Date(date.getTime());
			$('#event_to_date').datepicker('option', {minDate: date});
			$('.session_date_picker').datepicker('option', {minDate: date});
		}
		
	});
	$('#event_to_date').datepicker({ 
		onSelect: function(date) {
		}
	}); 
	 
});

function showMultipleDates(value) { 
	if(value=="M") {
		$('#todatevaluetab1').show();
		$('#todatevaluetab2').show();
	} else {
		$('#todatevaluetab1').hide();
		$('#todatevaluetab2').hide();
		$('#event_to_date').val('');
	}
}

function saveEventDtls(event_id, a) { //alert(event_id);
	
	var err = 0;
	
	if($('#event_name').val()==''){ err=1; $('#event_name').addClass('boxerror'); } else { $('#event_name').removeClass('boxerror'); }
	/*if($('#event_type').val()==''){ err=1; $('#event_type').addClass('boxerror'); } else { $('#event_type').removeClass('boxerror'); }
	if($('#event_from_date').val()==''){ err=1; $('#event_from_date').addClass('boxerror'); } else { $('#event_from_date').removeClass('boxerror'); }
	
	if($('#event_type').val()=="M") {
		if($('#event_to_date').val()==''){ err=1; $('#event_to_date').addClass('boxerror'); } else { $('#event_to_date').removeClass('boxerror'); }
	}
	
	if($('#event_from_hh').val()==''){ err=1; $('#event_from_hh').addClass('boxerror'); } else { $('#event_from_hh').removeClass('boxerror'); }
	if($('#event_from_mm').val()==''){ err=1; $('#event_from_mm').addClass('boxerror'); } else { $('#event_from_mm').removeClass('boxerror'); }
	if($('#event_from_ampm').val()==''){ err=1; $('#event_from_ampm').addClass('boxerror'); } else { $('#event_from_ampm').removeClass('boxerror'); }
	
	if($('#event_to_hh').val()==''){ err=1; $('#event_to_hh').addClass('boxerror'); } else { $('#event_to_hh').removeClass('boxerror'); }
	if($('#event_to_mm').val()==''){ err=1; $('#event_to_mm').addClass('boxerror'); } else { $('#event_to_mm').removeClass('boxerror'); }
	if($('#event_to_ampm').val()==''){ err=1; $('#event_to_ampm').addClass('boxerror'); } else { $('#event_to_ampm').removeClass('boxerror'); }
	
	var sDate = $('#event_from_date').val();
	var sHours = $('#event_from_hh').val();
	var sMinutes = $('#event_from_mm').val();
	var sPeriod = $('#event_from_ampm').val();
	var sTime = sHours+":"+sMinutes+" "+sPeriod;
	var sdt = new Date(sDate+" "+sTime);
	
	var eDate = $('#event_from_date').val();
	var eHours = $('#event_to_hh').val();
	var eMinutes = $('#event_to_mm').val();
	var ePeriod = $('#event_to_ampm').val();
	var eTime = eHours+":"+eMinutes+" "+ePeriod;
	var edt = new Date(eDate+" "+eTime);
	
		if(sdt > edt) { 
			err=1;
			alert("Date and Time should be greater than event date and time..!");
			$('#event_to_hh').val('');
			$('#event_to_mm').val('');
			$('#event_to_ampm').val('');
		}
	
	if($('#event_address').val()==''){ err=1; $('#event_address').addClass('boxerror'); } else { $('#event_address').removeClass('boxerror'); }
	if($('#contact_name').val()==''){ err=1; $('#contact_name').addClass('boxerror'); } else { $('#contact_name').removeClass('boxerror'); }
	if($('#contact_phone').val()==''){ err=1; $('#contact_phone').addClass('boxerror'); } else { $('#contact_phone').removeClass('boxerror'); }
	if($('#event_desc').val()==''){ err=1; $('#event_desc').addClass('boxerror'); } else { $('#event_desc').removeClass('boxerror'); }
	if($('#event_place').val()==''){ err=1; $('#event_place').addClass('boxerror'); } else { $('#event_place').removeClass('boxerror'); }
	
	if($('#contact_email').val()=='')
	{
	err=1;
	$('#contact_email').addClass('boxerror');
	}
	else
	{	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#contact_email').val()) == false) 
		{
			err=1;
			$('#contact_email').addClass('boxerror');
		}
		else{
			$('#contact_email').removeClass('boxerror');
		}
	}
	
	var total_plus_count = $('#sessionpluscount').val();
	
	for(var i=0; i<total_plus_count; i++) {
		
		var total_time_plus_count = $('#sessiontimepluscount_'+i).val();
		
		for(var j=0; j<total_time_plus_count; j++) {
		
		if($('#session_ftime_hh_'+i+'_'+j).val()=='') { err=1; $('#session_ftime_hh_'+i+'_'+j).addClass('boxerror'); } else { $('#session_ftime_hh_'+i+'_'+j).removeClass('boxerror').val(); }
		if($('#session_ftime_mm_'+i+'_'+j).val()=='') { err=1; $('#session_ftime_mm_'+i+'_'+j).addClass('boxerror'); } else { $('#session_ftime_mm_'+i+'_'+j).removeClass('boxerror').val(); }
		if($('#session_ftime_ampm_'+i+'_'+j).val()=='') { err=1; $('#session_ftime_ampm_'+i+'_'+j).addClass('boxerror'); } else { $('#session_ftime_ampm_'+i+'_'+j).removeClass('boxerror').val(); }
		
		if($('#session_ttime_hh_'+i+'_'+j).val()=='') { err=1; $('#session_ttime_hh_'+i+'_'+j).addClass('boxerror'); } else { $('#session_ttime_hh_'+i+'_'+j).removeClass('boxerror').val(); }
		if($('#session_ttime_mm_'+i+'_'+j).val()=='') { err=1; $('#session_ttime_mm_'+i+'_'+j).addClass('boxerror'); } else { $('#session_ttime_mm_'+i+'_'+j).removeClass('boxerror').val(); }
		if($('#session_ttime_ampm_'+i+'_'+j).val()=='') { err=1; $('#session_ttime_ampm_'+i+'_'+j).addClass('boxerror'); } else { $('#session_ttime_ampm'+i).removeClass('boxerror').val(); }
		
		var sDate1 = $('#session_date'+i).val();
		var sHours1 = $('#session_ftime_hh_'+i+'_'+j).val();
		var sMinutes1 = $('#session_ftime_mm_'+i+'_'+j).val();
		var sPeriod1 = $('#session_ftime_ampm_'+i+'_'+j).val();
		var sTime1 = sHours1+":"+sMinutes1+" "+sPeriod1;
		var sdt1 = new Date(sDate1+" "+sTime1);
		
		var eDate1 = $('#session_date_'+i+'_'+j).val();
		var eHours1 = $('#session_ttime_hh_'+i+'_'+j).val();
		var eMinutes1 = $('#session_ttime_mm_'+i+'_'+j).val();
		var ePeriod1 = $('#session_ttime_ampm_'+i+'_'+j).val();
		var eTime1 = eHours1+":"+eMinutes1+" "+ePeriod1;
		var edt1 = new Date(eDate1+" "+eTime1); 
		
			if(sdt1 > edt1) { 
				err=1;
				alert("Date and Time should be greater than event date and time..!");
				$('#session_ttime_hh_'+i+'_'+j).val('');
				$('#session_ttime_mm_'+i+'_'+j).val('');
				$('#session_ttime_ampm_'+i+'_'+j).val('');
			}
		}
		
		if($('#session_name'+i).val()=='') { err=1; $('#session_name'+i).addClass('boxerror'); } else { $('#session_name'+i).removeClass('boxerror').val(); }
		if($('#session_date'+i).val()=='') { err=1; $('#session_date'+i).addClass('boxerror'); } else { $('#session_date'+i).removeClass('boxerror').val(); }
		
		if($('#session_type'+i).val()=='') { err=1; $('#session_type'+i).addClass('boxerror'); } else { $('#session_type'+i).removeClass('boxerror').val(); }
		if($('#session_type'+i).val()=="P") {
			if($('#session_amount'+i).val()=='') { err=1; $('#session_amount'+i).addClass('boxerror'); } else { $('#session_amount'+i).removeClass('boxerror').val(); }
		}
		if($('#session_place'+i).val()=='') { err=1; $('#session_place'+i).addClass('boxerror'); } else { $('#session_place'+i).removeClass('boxerror').val(); }
		if($('#session_description'+i).val()=='') { err=1; $('#session_description'+i).addClass('boxerror'); } else { $('#session_description'+i).removeClass('boxerror').val(); }
			
	
	}
	
	//alert(err);*/
	if(err==0){
		//document.eventFrm.submit();
		$('#savebtn').hide();
		$('#loadingbtn').show();
		var myfrm = document.getElementById('eventFrm'); 
		$.ajax({
			url: "events.php",   	// Url to which the request is send
			type: "POST",      				// Type of request to be send, called as method
			data:  new FormData(myfrm), 		// Data sent to server, a set of key/value pairs representing form fields and values 
			contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
			cache: false,					// To unable request pages to be cached
			processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
			success: function(data)  		// A function to be called if request succeeds
			{
				//alert(data); return false;
				$('#savebtn').show();
				$('#loadingbtn').hide();
				showEventsList('<?=$listType?>', event_id);
			}	        
		});
	}

}

function defaultLoader() {
	
	jQuery('#SessionLevelTop').empty().html('');
		var vhtm = new Array();
		var i = 0;
	<? 
		if(count($rs_sessions)>0){
			foreach($rs_sessions as $sk=>$sv){
	?>
		//alert('<?=$sv->id?>');
				addSessionTopLevel({id:unescape('<?=rawurlencode(htmlentities(stripslashes($sv->id)))?>'), event_session_name:unescape('<?=rawurlencode(htmlentities(stripslashes($sv->event_session_name)))?>'), session_description:unescape('<?=rawurlencode(htmlentities(stripslashes($sv->session_description)))?>'), session_date:unescape('<?=rawurlencode(htmlentities(stripslashes($sv->session_date)))?>'), session_time:unescape('<?=rawurlencode(htmlentities(stripslashes($sv->session_time)))?>'), session_type:unescape('<?=rawurlencode(htmlentities(stripslashes($sv->session_type)))?>'), session_amount:unescape('<?=rawurlencode(htmlentities(stripslashes($sv->session_amount)))?>'), session_place:unescape('<?=rawurlencode(htmlentities(stripslashes($sv->session_place)))?>') });
				i++;
	<?
			}
		}
		else {
	?>
		addSessionTopLevel();
	<?
		}
	?>
	
	
}


function addSessionTopLevel(a){ 
		
	if(a==undefined) a={};
	
	if(a.id==undefined) a.id='';
	if(a.event_session_name==undefined) a.event_session_name='';
	if(a.session_description==undefined) a.session_description='';
	if(a.session_date==undefined) a.session_date='';
	if(a.session_time==undefined) a.session_time='';
	if(a.session_type==undefined) a.session_type='';
	if(a.session_amount==undefined || a.session_amount=='0.00') a.session_amount='';
	if(a.session_place==undefined) a.session_place='';
	
	if(a.Value==undefined) a.Value='';
	
	var row = jQuery('div.omclvltop').length;
	var parent_row=0;
	
	var vhtml = '';
	vhtml += '<div id="spLevel_'+row+'" class="omclvltop" style="margin:5px 0px;">';
	vhtml += '	<div style="width:100%;" id="spLevel1_'+row+'" class="dimage" >';
	vhtml += '		<div>';
	vhtml += '			 <input type="hidden" name="evntSessionArr[session_db_id]['+row+']" id="session_db_id'+row+'" value="'+a.id+'" />';
	vhtml += '			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="schooltbl">';
	vhtml += '				<tr>';
	vhtml += '				  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">';
	vhtml += '					  <tr>';
	vhtml += '						<td>Session Name <span class="txterror">*</span></td>';
	vhtml += '						<td><input type="text" class="txtbox" name="evntSessionArr[session_name]['+row+']" id="session_name'+row+'" value="'+a.event_session_name+'" /></td>';
	vhtml += '						<td>Session Date <span class="txterror">*</span></td>';
	vhtml += '						<td><input type="text" class="txtbox session_date_picker"  name="evntSessionArr[session_date]['+row+']" id="session_date'+row+'" value="'+a.session_date+'" /></td>';
	vhtml += '					  </tr>';
								  
	vhtml += '					  <tr>';
	vhtml += '						<td valign="top">Session Time <span class="txterror">*</span></td>';
	vhtml += '						<td valign="top">';
	vhtml += '							<div id="SessionTimeLevelTop'+row+'"></div><div style="float:right; margin-right:0px; margin-bottom:30px;"><span class="spancursor" id="SessionTimeLevel_a" style="cursor:pointer; padding-left:15px;" onclick="addSessionTimeTopLevel(&quot;&quot;, '+row+');"><div class="pull_right txtbold f24 cursor">+</div></span></div>';
	vhtml += '						</td>';
	vhtml += '					  </tr>';
								  
	vhtml += '					  <tr>';
	vhtml += '						<td valign="top">Session Type <span class="txterror">*</span></td>';
	vhtml += '						<td>';
	vhtml += '							<select name="evntSessionArr[session_type]['+row+']" id="session_type'+row+'" class="listbox" onchange="showPriceDtls(this.value, '+row+');">';
	vhtml += '								<option value="">Choose Type</option>';
	vhtml += '								<option value="F" '+(a.session_type=='F'?'selected':'')+'>Free</option>';
	vhtml += '								<option value="P" '+(a.session_type=='P'?'selected':'')+'>Paid</option>';
	vhtml += '							</select>';
	vhtml += '						</td>';
	vhtml += '						<td valign="top" style="display:none;" id="sessionamttab1'+row+'">Session Amount</td>';
	vhtml += '						<td valign="top" style="display:none;" id="sessionamttab2'+row+'"><input type="text" class="txtbox" name="evntSessionArr[session_amount]['+row+']" id="session_amount'+row+'" value="'+a.session_amount+'" /></td>';
	vhtml += '					  </tr>';
								  
	vhtml += '					  <tr>';
	vhtml += '						<td valign="top">Session Place <span class="txterror">*</span></td>';
	vhtml += '						<td><input type="text" class="txtbox" name="evntSessionArr[session_place]['+row+']" id="session_place'+row+'" value="'+a.session_place+'" /></td>';
	vhtml += '					  </tr>';
								  
	vhtml += '					  <tr>';
	vhtml += '						<td valign="top">Description <span class="txterror">*</span></td>';
	vhtml += '						<td colspan="3"><textarea class="msgbox" name="evntSessionArr[session_description]['+row+']" id="session_description'+row+'" style="width:980px; height:200px;">'+a.session_description+'</textarea></td>';
	vhtml += '					  </tr>';
	vhtml += '					</table></td>';
	vhtml += '				</tr>';
	vhtml += '				<tr>';
	//if(row!=0) {
	vhtml += '					<td align="right" colspan="4"><span class="spancursor" id="SessionLevel_r" style="display: block; text-align:right; padding-right:10px;"><div class="fullsize"><div class="pull_right txtbold f24 cursor" onclick="removeSessionTopLevel('+row+', &quot;'+a.id+'&quot;);">-</div></div></span></td>';
	//} else {
	//vhtml += '					<td align="right" colspan="4">&nbsp;</td>';
	//}
	vhtml += '				</tr>';
	vhtml += '		  </table>';
	vhtml += '		<div class="border_bottom"></div>';
	vhtml += '		</div>';
		
	vhtml += '	</div>';
	vhtml += '</div>';

	//alert(vhtml);
	jQuery('#SessionLevelTop').append(vhtml);
	
	var session_time_arr=[];
	if(a.session_time!="" && a.session_time!=undefined) {
		session_time_arr = a.session_time.split(",");
	}
	
	if(session_time_arr.length>0 && session_time_arr.length!=undefined) {
		for(var i=0; i<session_time_arr.length; i++) {
			addSessionTimeTopLevel({ session_time:session_time_arr[i] }, row);
		}
	} else {
		addSessionTimeTopLevel("", row);
	}
	
	$('#sessionpluscount').val(jQuery('div.omclvltop').length);
	
	$(".session_date_picker").datepicker({
		changeMonth: true
	}); 

	
}

function removeSessionTopLevel(r, session_id){ 

	var i1;
			
	var msg = confirm("Are you sure want to delete..?");
	
	if(msg==true) {
		
		var row = jQuery('div.omclvltop').length-1;
		//alert(row);
		jQuery('#spLevel_'+r).remove();
		$('#sessionpluscount').val(row);
		
		if(session_id!="" && session_id!=undefined) {
			ajax({
				 a:'events',
				 b:'act=deleteSessionDtls&sessionId='+session_id,
				 c:function(){},
				 d:function(data){ //alert(data);
					alert('Deleted successfully');
				 }
			 });
		}
			 
		if(jQuery('div.dimage').length==0){
			for(i1=0;i1<100;i1++){
				
				if(jQuery('omclvltop').length>0){
					jQuery('#spLevel_'+i1).remove();
				}
				else
					i1 = 101;
			}
			addSessionTopLevel();
		}
	
		if(jQuery('div.omclvltop').length==0) {
			addSessionTopLevel();
		}
	
	}

}

function showPriceDtls(value, row) {
	
	if(value=="P") {
		$('#sessionamttab1'+row).show();
		$('#sessionamttab2'+row).show();
	} else {
		$('#sessionamttab1'+row).hide();
		$('#sessionamttab2'+row).hide();
	}
	
}

function addSessionTimeTopLevel(a, parent_row){ //alert(parent_row);
		
	if(a==undefined) a={};
	
	if(a.id==undefined) a.id='';
	if(parent_row==undefined) parent_row=0;
	if(a.session_time==undefined) a.session_time='';
	
	if(a.Value==undefined) a.Value='';
	
	if(a.session_time!="" && a.session_time!=undefined) {
		a.session_time_arr = a.session_time.split(" - ");
		a.ftime = a.session_time_arr[0].split(":");
		a.ftime1 = a.ftime[1].split(" ");
		a.ftimehh = a.ftime[0];
		a.ftimemm = a.ftime1[0];
		a.ftimeampm = a.ftime1[1];
		
		a.ttime = a.session_time_arr[1].split(":");
		a.ttime1 = a.ttime[1].split(" ");
		a.ttimehh = a.ttime[0];
		a.ttimemm = a.ttime1[0];
		a.ttimeampm = a.ttime1[1];
	}
	
	var row = jQuery('div.stlvltop'+parent_row).length;
	
	var vhtml = '';
	vhtml += '<div id="spLevel_'+row+'" class="stlvltop'+parent_row+'" style="margin:0px 0px;">';
	vhtml += '	<div style="width:100%;" id="spLevel1_'+row+'" class="dimage" >';
	vhtml += '		<div>';
	vhtml += '		<input type="hidden" name="sessiontimepluscount" id="sessiontimepluscount_'+parent_row+'" />';
	vhtml += '			 <input type="hidden" name="evntSessionTimeArr['+parent_row+'][session_db_id]['+row+']" id="session_db_id'+row+'" value="'+a.id+'" />';
	vhtml += '			<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	vhtml += '				<tr>';
	vhtml += '						<td valign="top" style="padding-top:0px;">';
	vhtml += '							<select class="listbox border_white" style="width:57px" id="session_ftime_hh_'+parent_row+'_'+row+'" name="evntSessionTimeArr['+parent_row+']['+row+'][session_ftime_hh]">';
	vhtml += '								<option value="">HH</option>';
											<?  for($i=1; $i<=12; $i++){ ?>
	vhtml += '								<option value="<?=($i<10)?'0'.$i:$i?>" '+(a.ftimehh=='<?=($i<10)?'0'.$i:$i?>'?'selected':'')+'><?=($i<10)?'0'.$i:$i?></option>';
											 <? } ?>
	vhtml += '							</select>';
	vhtml += '							<span> : </span>';
	vhtml += '							<select class="listbox border_white" style="width:57px" id="session_ftime_mm_'+parent_row+'_'+row+'" name="evntSessionTimeArr['+parent_row+']['+row+'][session_ftime_mm]">';
	vhtml += '								<option value="">MM</option>';
										<?  for($i=0; $i<=11; $i++){ ?>
	vhtml += '								<option value="<?=($i*5<10)?'0'.$i*5:$i*5?>" '+(a.ftimemm=='<?=($i*5<10)?'0'.$i*5:$i*5?>'?'selected':'')+'><?=($i*5<10)?'0'.$i*5:$i*5?></option>';
										 <? } ?>
	vhtml += '							</select>';
	vhtml += '							<select class="listbox border_white" style="width:60px" id="session_ftime_ampm_'+parent_row+'_'+row+'" name="evntSessionTimeArr['+parent_row+']['+row+'][session_ftime_ampm]">';
	vhtml += '							  <option value="AM" '+(a.ftimeampm=='AM'?'selected':'')+'>AM</option>';
	vhtml += '							  <option value="PM" '+(a.ftimeampm=='PM'?'selected':'')+'>PM</option>';
	vhtml += '							</select>';
										
	vhtml += '							to ';
										
	vhtml += '							<select class="listbox border_white" style="width:57px" id="session_ttime_hh_'+parent_row+'_'+row+'" name="evntSessionTimeArr['+parent_row+']['+row+'][session_ttime_hh]">';
	vhtml += '								<option value="">HH</option>';
											<?  for($i=1; $i<=12; $i++){ ?>
	vhtml += '								<option value="<?=($i<10)?'0'.$i:$i?>" '+(a.ttimehh=='<?=($i<10)?'0'.$i:$i?>'?'selected':'')+'><?=($i<10)?'0'.$i:$i?></option>';
											 <? } ?>
	vhtml += '							</select>';
	vhtml += '							<span> : </span>';
	vhtml += '							<select class="listbox border_white" style="width:57px" id="session_ttime_mm_'+parent_row+'_'+row+'" name="evntSessionTimeArr['+parent_row+']['+row+'][session_ttime_mm]">';
	vhtml += '								<option value="">MM</option>';
										<?  for($i=0; $i<=11; $i++){ ?>
	vhtml += '								<option value="<?=($i*5<10)?'0'.$i*5:$i*5?>" '+(a.ttimemm=='<?=($i*5<10)?'0'.$i*5:$i*5?>'?'selected':'')+'><?=($i*5<10)?'0'.$i*5:$i*5?></option>';
			 							 <? } ?>
	vhtml += '							</select>';
	vhtml += '							<select class="listbox border_white" style="width:60px" id="session_ttime_ampm_'+parent_row+'_'+row+'" name="evntSessionTimeArr['+parent_row+']['+row+'][session_ttime_ampm]">';
	vhtml += '							  <option value="AM" '+(a.ttimeampm=='AM'?'selected':'')+'>AM</option>';
	vhtml += '							  <option value="PM" '+(a.ttimeampm=='PM'?'selected':'')+'>PM</option>';
	vhtml += '							</select>';
	vhtml += '						</td>';
	vhtml += '				</tr>';
	vhtml += '				<tr>';
	//if(row!=0) {
	vhtml += '					<td align="right" colspan="4"><span class="spancursor" id="SessionTimeLevel_r" style="display: block; text-align:right; padding-right:10px;"><div class="pull_right txtbold f24 cursor" onclick="removeSessionTimeTopLevel('+row+', '+parent_row+', &quot;'+a.id+'&quot;);">-</div></span></td>';
	//} else {
	//vhtml += '					<td align="right" colspan="4">&nbsp;</td>';
	//}
	vhtml += '				</tr>';
	vhtml += '		  </table>';
	vhtml += '		<div class="border_bottom"></div>';
	vhtml += '		</div>';
		
	vhtml += '	</div>';
	vhtml += '</div>';

	//alert(vhtml);
	jQuery('#SessionTimeLevelTop'+parent_row).append(vhtml);
	$('#sessiontimepluscount_'+parent_row).val(jQuery('div.stlvltop'+parent_row).length);
	
}

function removeSessionTimeTopLevel(r, parent_row, session_id){ 

	var i1;
		
	var row = jQuery('div.stlvltop'+parent_row).length-1;
	jQuery('#spLevel_'+r).remove();
	$('#sessiontimepluscount_'+parent_row).val(row);
	 
	if(jQuery('div.dimage').length==0){
		for(i1=0;i1<100;i1++){
			
			if(jQuery('stlvltop'+parent_row).length>0){
				jQuery('#spLevel_'+i1).remove();
			}
			else
				i1 = 101;
		}
		addSessionTopLevel();
	}

	if(jQuery('div.stlvltop'+parent_row).length==0) {
		addSessionTopLevel();
	}

}


jQuery(function(){
	
	jQuery('#SessionLevel_r').show();
	jQuery('#SessionLevel_a').show();
	
	/*jQuery('#SessionTimeLevel_r').show();
	jQuery('#SessionTimeLevel_a').show();*/
	
	defaultLoader();
})




</script> 
