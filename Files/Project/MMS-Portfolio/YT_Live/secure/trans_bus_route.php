<?
if($actionType=="List") {
$rs_routes = Transportation::getAllBusRouteBySchoolId($schoolId);
?>
<input type="hidden" name="student_route_page" id="student_route_page" value="<?=$page?>" />

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
    	<td width="25%" valign="top" style="border-right:1px solid #DAB791;">
        	<table border="0" cellpadding="0" cellspacing="0" class="gradetbl" width="100%">
            	<tr>
                	<th>Route Name</th>
                </tr>
				<?
				if(count($rs_routes)>0) {
					foreach($rs_routes as $K=>$V) {
				?>
                <tr>
                	<td onclick="showRouteStops(<?=$V->id?>)" style="cursor:pointer; padding:10px;" align="left"><?=$V->route_name?></td>
                </tr>
                <?
					}
				} else {
				?>
                <tr>
                	<td style="cursor:pointer; padding:10px;" align="left">No results found..!</td>
                </tr>
                <?	
				}
				?>
            </table>
        </td>
        <td width="75%" id="routedtlstab" valign="top"></td>
    </tr>
</table>

<script type="text/javascript">
showRouteStops(<?=$rs_routes[0]->id?>);
</script>

<?
}

if($actionType=="Form") {
	
if($Id!="") {
	$rs_busroutes = Transportation::getBusRouteById($Id);
	if($rs_busroutes->id!=NULL) foreach($rs_busroutes as $K=>$V)  $$K=$V;
	$stop_obj = new Transportation();
	$stop_obj->route_id=$Id;
	$rs_stops_to = $stop_obj->getBusRouteStopDtls();
}
?>
<form name="busRouteFrm" id="busRouteFrm" method="post">
<input type="hidden" name="act" value="saveBusRoute" />
<input type="hidden" name="bus_route_db_id" value="<?=$Id?>" />
<input type="hidden" name="bus_route_school_id" value="<?=$schoolId?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtbl">
    <tr>
        <td colspan="2">
        	<div style="max-height:600px; overflow-y:scroll;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">
                <tr>
                    <td>Route Name</td>
                    <td colspan="3"><input type="text" class="txtbox" name="route_name" id="route_name" value="<?=stripslashes($route_name)?>"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td colspan="3"><textarea class="msgbox" id="description" name="description"><?=$description?></textarea></td>
                </tr>
                <tr>
                    <td colspan="4" style="border-top:1px dotted #666;"><b>Stops</b></td>
                </tr>
                <tr>
                    <td>Bus Stops</td>
                    <td colspan="3">
                    	<div id="ToSchoolLevelTop"></div>
                        <span class="spancursor" id="toSchoolLevel_a" style="cursor:pointer;" onclick="addToSchool();">
                        <div class="pull_right txtbold f24 cursor">+</div>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="border-top:1px dotted #666;">Choose Vehicle</td>
                    <td colspan="3" style="border-top:1px dotted #666;"><? $rs_vehicles = Transportation::getAllVehicleBySchoolId($schoolId); ?>
                    	<? $driverArr = explode(",", $vehicle_id); ?>
                    	<select name="vehicle_id[]" id="vehicle_id" multiple="multiple" class="listbox" style="width:98%;">
                        	<option value="">Select Vehicle</option>
                            <? if(count($rs_vehicles)>0) { foreach($rs_vehicles as $k=>$v) { ?><option value="<?=$v->id?>" <?=(in_array($v->id, $driverArr))?"selected":""?>><?=$v->vehicle_name?>-<?=$v->vehicle_number?></option><? } }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Choose Driver</td>
                    <td colspan="3"><? $rs_drivers = Transportation::getAllDriverBySchoolId($schoolId);  ?>
                    	<select name="driver_id" id="driver_id" class="listbox" style="width:98%;">
                        	<option value="">Select Vehicle</option>
                            <? if(count($rs_drivers)>0) { foreach($rs_drivers as $k=>$v) { ?><option value="<?=$v->id?>" <?=($v->id==$driver_id)?"selected":""?>><?=$v->driver_name?></option><? } }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Choose Secondary Driver</td>
                    <td colspan="3"><? $rs_drivers = Transportation::getAllDriverBySchoolId($schoolId);  ?>
                    	<select name="sec_driver_id" id="sec_driver_id" class="listbox" style="width:98%;">
                        	<option value="">Select Vehicle</option>
                            <? if(count($rs_drivers)>0) { foreach($rs_drivers as $k=>$v) { ?><option value="<?=$v->id?>" <?=($v->id==$secondary_driver_id)?"selected":""?>><?=$v->driver_name?></option><? } }?>
                        </select>
                    </td>
                </tr>
            </table>
            </div>
        </td>
    </tr>
    
    <tr>
        <td colspan="2" align="right">
            <div class="fullsize txtwhite txtcenter f18">
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="busSaveBtn" onClick="submitBusRouteDtls('<?=$Id?>', event)">Save</div>
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="busProcessingBtn" style="display:none;">Processing..</div>
            </div>
        </td>
    </tr>
</table>
<input type="hidden" name="tostopcount" id="tostopcount" value="" />
</form>

<script type="text/javascript">

function defaultLoader(){
	
	// Stop for To School Starts Here..
	jQuery('#ToSchoolLevelTop').empty().html('');
	var vhtm = new Array();
	var i = 0;
	<? 	
 	if((!empty($rs_stops_to)) &&(count($rs_stops_to)>0)){
		foreach($rs_stops_to as $tk=>$tv) {
		?>
			addToSchool({id:'<?=$tv->id?>', stop_name:'<?=$tv->stop_name?>', to_stop_position:'<?=$tv->stop_to_position?>', from_stop_position:'<?=$tv->stop_from_position?>', stop_type:'<?=$tv->stop_type?>'});
	<?  } 
	} 
	else { ?>addToSchool(); <? } ?>
		
}

function addToSchool(a){
 	if(a==undefined) a={};
	if(a.id==undefined) a.id='';
	if(a.stop_name==undefined) a.stop_name='';
	if(a.to_stop_position==undefined) a.to_stop_position='';
	if(a.from_stop_position==undefined) a.from_stop_position='';
	if(a.stop_type==undefined) a.stop_type='';
	if(a.Value==undefined) a.Value='';
	
	var row = jQuery('div.ToSchoolclvltop').length;
	
	var vhtml = '';
	vhtml += '<div id="spToSchoolLevel_'+row+'" class="ToSchoolclvltop" style="margin-top:0px; text-align:left;">';
	vhtml += '	<div id="spToSchoolLevel_'+row+'" class="dimage" style="margin-bottom:5px;">';
	vhtml += '	<input type="hidden" name="ToStopsArr[to_stop_id]['+row+']" id="to_stop_id'+row+'" value="'+a.id+'" /><input type="hidden" name="ToStopsArr[to_stop_position]['+row+']" id="to_stop_position'+row+'" value="'+a.to_stop_position+'" /><input type="hidden" name="ToStopsArr[from_stop_position]['+row+']" id="from_stop_position'+row+'" value="'+a.from_stop_position+'" />';
	vhtml += '		<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>';
	vhtml += '			<td style="padding:0px;"><input type="text" class="txtbox" name="ToStopsArr[to_stop_name]['+row+']" id="to_stop_name'+row+'" value="'+a.stop_name+'" /><div>';
	vhtml += '			<input type="radio" name="ToStopsArr[stop_type]['+row+']" id="stop_type'+row+'" value="F" '+(a.stop_type=='F'?'checked':'')+' /> From School';
	vhtml += '			<input type="radio" name="ToStopsArr[stop_type]['+row+']" id="stop_type'+row+'" value="T" '+(a.stop_type=='T'?'checked':'')+' /> To School';
	vhtml += '			<input type="radio" name="ToStopsArr[stop_type]['+row+']" id="stop_type'+row+'" value="B" '+((a.stop_type=='B' || a.stop_type=='')?'checked':'')+'/> Both Stop';
	vhtml += '			</div></td>';
	vhtml +='			<td style="padding:0px;"><div class="txtbold f24 cursor" style="padding:0px; margin:0px; cursor:pointer; width:10%; height:5px; float:right" id="toSchoolLevel_r" onclick="removeToSchoolTopLevel('+row+', &quot;'+a.id+'&quot;);">-</div></td>';
	vhtml += '		</tr></table>';
	vhtml += '	</div>';
	vhtml += '</div>';
 	
	jQuery('#ToSchoolLevelTop').append(vhtml);
	
 	$('#tostopcount').val(jQuery('div.ToSchoolclvltop').length);
	
}

function removeToSchoolTopLevel(r, id){
	var i1; 
	if(r==undefined){ 
		var row = jQuery('div.ToSchoolclvltop').length-1;
		jQuery('#spToSchoolLevel_'+row).remove();
	}
	else
	{  
		var msg = confirm('Are you sure want to delete this stop?');
		if(msg==true) {
			ajax({
				a:'transport',
				b:'act=deleteStop&id='+id,		
				c:function(){},
				d:function(data){ //alert(data);
					alert('Deleted Successfully..!');
				}			
			});
			
			jQuery('#spToSchoolLevel_'+r).remove();
			if(jQuery('div.dimage').length==0){
				for(i1=0;i1<100;i1++){
					if(jQuery('ToSchoolclvltop').length>0)
						jQuery('#spToSchoolLevel_'+i1).remove();
					else
						i1 = 101;
				}
				addToSchool();
			}
		}
	}
	if(jQuery('div.ToSchoolclvltop').length==0)
		addToSchool();
}

jQuery(function(){

	jQuery('#toSchoolLevel_r').show();
	jQuery('#toSchoolLevel_a').show();

	defaultLoader();
	
});

function submitBusRouteDtls(id, e) {
	var	school_id = $("#master_school_id").val();
	var myfrm = document.getElementById('busRouteFrm'); 
	e.preventDefault();
	
	var err=0;
	if($('#route_name').val()==''){ err=1; $('#route_name').addClass('boxerror'); } else { $('#route_name').removeClass('boxerror'); }
	if($('#description').val()==''){ err=1; $('#description').addClass('boxerror'); } else { $('#description').removeClass('boxerror'); }
	if($('#vehicle_id').val()=='' || $('#vehicle_id').val()==undefined){ err=1; $('#vehicle_id').addClass('boxerror'); } else { $('#vehicle_id').removeClass('boxerror'); }
	if($('#driver_id').val()==''){ err=1; $('#driver_id').addClass('boxerror'); } else { $('#driver_id').removeClass('boxerror'); }
	if($('#sec_driver_id').val()==''){ err=1; $('#sec_driver_id').addClass('boxerror'); } else { $('#sec_driver_id').removeClass('boxerror'); }
	
	var toStopCount = $('#tostopcount').val();
	for(var i=0; i<toStopCount; i++) if($('#to_stop_name'+i).val()==''){ err=1; $('#to_stop_name'+i).addClass('boxerror'); } else { $('#to_stop_name'+i).removeClass('boxerror'); }

	if(err==0) {
		$("#busSaveBtn").hide();
		$("#busProcessingBtn").show();
		$.ajax({
			url: "transport.php",
			type: "POST",
			data:  new FormData(myfrm),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)   {
				$("#busSaveBtn").show();
				$("#busProcessingBtn").hide();
				//alert(data); return false;
				if(id!="" && id!=undefined){
					alert("Updated Successfully");
				}else{
					alert("Added Successfully");
				}
				closePopup();
				showTransportDtls('B', school_id, data);
				/*if(id!="" && id!=undefined) showTransportDtls('B', school_id);
				else showRouteStops(data);*/
			}	        
		});
	}
	   
}



</script>
<? 
}
?>
