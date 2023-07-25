<?
if($actionType=="List") {
$rs_drivers = Transportation::getAllDriverBySchoolId($schoolId); 
?>
<input type="hidden" name="student_vehicle_page" id="student_vehicle_page" value="<?=$page?>" />

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:7px auto;" class="gradetbl"><!--Student Tab-->
  <tr>
    <th width="10%">S No.</th>
    <th width="14%" align="left">Photo</th>
    <th width="25%" align="left">Driver Name</th>
    <th width="20%" align="left">Route</th>
    <th width="12%" align="left">Vehicle</th>
    <th width="19%">Action</th>
  </tr>
  <?
  if(count($rs_drivers)>0) {
      foreach($rs_drivers as $K=>$V) {
		$rs_route = Transportation::getBusRouteById($V->route_id); 
		
		$reg_number = Transportation::getVehicleById($V->vehicle_id);
		if($V->vehicle_id!=0) { $vehicle_value = $reg_number->registration_number; $vehicle_color = ""; }else{ $vehicle_value = "Assign Vehicle"; $vehicle_color = "green"; }
  ?>
  <tr>
    <td><?=($K+1)?></td>
    <td align="left"><? if($V->photo!=""){?><img src="<?=DRIVER_FILE_HREF.$V->photo?>" height="50" width="50"/><? }else{?>No Photo Found..!<? }?></td>
    <td align="left"><?=$V->driver_name?><br/><?=$V->mobile?></td>
    <td align="left"><?=$rs_route->route_name?></td>
    <td align="left" style="color:<?=$vehicle_color?>"><?=$vehicle_value?></td>
    <td align="center">
    	<img src="images/view_icon.png" alt="View" title="View" onClick="viewTransFrm('D', '<?=$V->id?>');" align="absmiddle" style="cursor:pointer;" /> 
        <img src="images/edit_icon.png" alt="Edit" title="Edit" onClick="showTransFrm('D', '<?=$V->id?>');" align="absmiddle" style="cursor:pointer;" /> 
        <img src="images/delete_icon.png" alt="Delete" title="Delete" onClick="if(confirm('Are you sure want to delete this Driver?')) deleteTransFrm('D', '<?=$V->id?>');" align="absmiddle" style="cursor:pointer;" />
    </td>
  </tr>
  <?
      }
  } else {
  ?>
  	<tr><td colspan="6" style="padding:10px;">No drivers found..!</td></tr>
  <? } ?>
</table>

<?
}


if($actionType=="Form") {
$rs_routes = Transportation::getAllBusRouteBySchoolId($schoolId);
	
if($Id!=""){ 
	$rs_driver = Transportation::getDriverById($Id);
}
?>
<form name="driverFrm" id="driverFrm" method="post" enctype="multipart/form-data">
<input type="hidden" name="act" id="act" value="driverFrmSubmit" />
<input type="hidden" name="driver_db_id" id="driver_db_id" value="<?=$Id?>" />
<input type="hidden" name="driver_school_id" id="driver_school_id" value="<?=$schoolId?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">
    <tr>
        <td>Driver Name</td>
        <td colspan="3"><input type="text" class="txtbox" name="driver_name" id="driver_name" value="<?=$rs_driver->driver_name?>"></td>
    </tr>
    <tr>
        <td>Address</td>
        <td colspan="3"><input type="text" class="txtbox" name="driver_address" id="driver_address" value="<?=$rs_driver->address?>"></td>
    </tr>
    <tr>
        <td>Mobile</td>
        <td colspan="3"><input type="text" class="txtbox" name="driver_mobile" id="driver_mobile" value="<?=$rs_driver->mobile?>"></td>
    </tr>
    <tr>
        <td>Blood Group</td>
        <td colspan="3"><input type="text" class="txtbox" name="driver_blood_group" id="driver_blood_group" value="<?=$rs_driver->blood_group?>"></td>
    </tr>
    <tr>
        <td>License Number</td>
        <td colspan="3"><input type="text" class="txtbox" name="driver_license_number" id="driver_license_number" value="<?=$rs_driver->license_number?>"></td>
    </tr>
    <tr>
        <td>License Expiry Date</td>
        <td colspan="3">
        <? $expiryDateArr = explode("-", $rs_driver->license_expiry_date); ?>
        <select name="driver_expiry_date" id="driver_expiry_date" class="listbox" style="width:30%;">
            <option value="">Date</option>
            <? for($i=1;$i<32;$i++){ ?>
            <option <? if($expiryDateArr[2]==$i){ ?>selected="selected"<? } ?>  value="<?=$i?>"><?=$i?></option>
            <? } ?>
        </select>
        
        <? $rs_month = currentYearMonth();?>
        <select name="driver_expiry_month" id="driver_expiry_month" class="listbox" style="width:30%;">
            <option value="">Month</option>
            <? foreach($rs_month as $mk=>$mv){ ?>
            <option <? if($expiryDateArr[1]==$mk){ ?>selected="selected"<? } ?>  value="<?=$mk?>"><?=$mv?></option>
            <? } ?>
        </select>
        
        <? $rs_year = listofyears(date('Y'), date('Y', strtotime('+20 years'))); ?>
        <select name="driver_expiry_year" id="driver_expiry_year" class="listbox" style="width:30%;">
            <option value="">Year</option>
            <? foreach($rs_year as $yk=>$yv){ ?>
            <option <? if($expiryDateArr[0]==$yv){ ?>selected="selected"<? } ?>  value="<?=$yv?>"><?=$yv?></option>
            <? } ?>
        </select> 
        </td>
    </tr>
    <tr>
        <td>Photo</td>
        <td colspan="3"><input type="file" name="driver_photo" id="driver_photo"><? if($_POST['driver_id']!=''){?><img src="<?=DRIVER_FILE_HREF.$rs_driver->photo?>" height="50" width="50"/><? }?>
    </tr>
    <tr>
        <td id="driver_vehicle_id_tab" valign="top">Assign Vehicle</td>
        <td colspan="3">
            <div>
            <? 
            $vehicleArr = Transportation::getAllVehicleBySchoolId($schoolId);
            $index=1;
			if(!empty($vehicleArr)) { ?>
            <select name="driver_vehicle_id" id="driver_vehicle_id" class="listbox">
            <option value="">Choose Vehicle</option>
            <?
            foreach($vehicleArr as $M=>$N){?>
            <option value="<?=$N->id."~".$N->route_id?>" <? if($N->id==$rs_driver->vehicle_id) { echo "selected"; }?>><?=$N->registration_number?></option>
            <? }  ?>
            </select>
            <?
			} else { ?>
            	Vechiles not yet added. Please add vehicles and then add driver.
            <? } ?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <div class="fullsize txtwhite txtcenter f18">
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="saveDriverFrm('<?=$Id?>', event);">Save</div>
            </div>
        </td>
    </tr>
    
</table>
</form>

<script type="text/javascript">


/*$(document).ready(function (e) {
	$("#driverFrm").on('submit',(function(e) { alert(e);
		e.preventDefault();
		$.ajax({
        	url: "ajax_image_upload.php",   	// Url to which the request is send
			type: "POST",      				// Type of request to be send, called as method
			data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
			contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
    	    cache: false,					// To unable request pages to be cached
			processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
			success: function(data)  		// A function to be called if request succeeds
		    {
				alert(data);
		    }	        
	   });
	   
	   
	}));
});*/

</script>


<? 
}

if($actionType=="View") {
$rs_driver = Transportation::getDriverById($Id);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showBasicDtls">
    
    <tr>
    	<td style="padding:0px" width="100%">
        	<table border="0" cellpadding="0" cellspacing="0" width="100%">
            	<tr>
                    <td><span class="form_head">Driver Details</span></td>
                </tr>
                <tr>
                    <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                                <td width="48%" class="tdhead">Driver Name :</td>
                                <td width="52%"><?=$rs_driver->driver_name?></td>
                            </tr>
                            <tr>
                                <td class="tdhead">License Number :</td>
                                <td><?=$rs_driver->license_number?> </td>
                            </tr>
                            <tr>
                                <td class="tdhead">License Expiry Date :</td>
                                <td><?=date("M d, Y", strtotime($rs_driver->license_expiry_date))?> </td>
                            </tr>
                            <tr>
                                <td class="tdhead">Blood Group :</td>
                                <td><?=$rs_driver->blood_group?></td>
                            </tr>
                            <tr>
                            	<td>Bus Route :</td>
                                <td></td>
                            </tr>
                            <tr>
                            	<td>Vehicle Number :</td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        
        <td> <div style="margin-top:50px;">
        	<? if($rs_driver->photo!="") { ?><img src="<?=DRIVER_FILE_HREF.$rs_driver->photo?>" height="80" width="80"/><? } else { ?>No Photo Found..!<? } ?>
            </div>
        </td>
    
    </tr>
    
    <tr>
        <td><span class="form_head">Contact Details</span></td>
    </tr>
    <tr>
        <td valign="top" colspan="2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                    <td style="padding:0px;"> 
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                            <tr>
                                <td width="25%" class="tdhead">Address :</td>
                                <td width="75%"><?=$rs_driver->address?></td>
                            </tr>
                            <tr>
                                <td class="tdhead">Mobile :</td>
                                <td><?=$rs_driver->mobile?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
            </table>
        </td>
    </tr>
    
</table>



<?
}

?>
