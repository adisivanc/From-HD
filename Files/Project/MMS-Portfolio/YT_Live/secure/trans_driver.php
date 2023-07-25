<?
if($actionType=="List") {
$rs_drivers = Transportation::getAllDriverBySchoolId($schoolId); 
?>
<input type="hidden" name="student_driver_page" id="student_driver_page" value="<?=$page?>" />

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:7px auto;" class="gradetbl"><!--Student Tab-->
  <tr>
    <th width="8%">S No.</th>
    <th width="11%" align="left">Photo</th>
    <th width="19%" align="left">Driver Name</th>
    <th width="25%" align="left">Contact</th>
    <th width="18%" align="left">License Number</th>
    <th width="19%">Action</th>
  </tr>
  <?
  if(count($rs_drivers)>0) {
      foreach($rs_drivers as $K=>$V) {
		$is_log = UserLog::checkLogExistsById(TBL_DRIVERS, $V->id);
		$license_date = new DateTime($V->license_expiry_date);
		$current_date = new DateTime(date("Y-m-d"));

		if($current_date>$license_date) $text = "License Expired"; else $text = "";
  ?>
  <tr>
    <td><?=($K+1)?></td>
    <td align="left"><? if($V->photo!=""){?><img src="resize.php?w=50&h=50&img=<?="../".DRIVER_FILE_REL.$V->photo?>" /><? }else{?>No Photo Found..!<? }?></td>
    <td align="left"><?=$V->driver_name?><br/><?=$V->mobile?></td>
    <td align="left"><div style="word-break:break-all;"><?=$V->email_address?><br /><?=$V->mobile?></div></td>
    <td align="left"><?=$V->license_number?><br /><span style="color:#F00"><?=$text?></span></td>
    <td align="center">
    	<? if($GLOBALS['isView']){ ?><img src="images/view_icon.png" alt="View" title="View" onClick="viewTransFrm('D', '<?=$V->id?>');" align="absmiddle" style="cursor:pointer;" /><? } ?> 
        <? if($GLOBALS['isUpdate']){ ?><img src="images/edit_icon.png" alt="Edit" title="Edit" onClick="showTransFrm('D', '<?=$V->id?>');" align="absmiddle" style="cursor:pointer;" /><? } ?>
        <? if($GLOBALS['isDelete']){ ?><img src="images/delete_icon.png" alt="Delete" title="Delete" onClick="if(confirm('Are you sure want to delete this Driver?')) deleteTransFrm('D', '<?=$V->id?>');" align="absmiddle" style="cursor:pointer;" /><? } ?>
        <? if($_SESSION['viewLog'] && $is_log==1) { ?><img src="images/log.png" alt="Log Details" title="Log Details" onClick="showLogDetails('<?=TBL_DRIVERS?>', '', '', '<?=$V->id?>')" align="absmiddle" style="cursor:pointer;" /><? } ?>
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
        <td>Email Address</td>
        <td colspan="3"><input type="text" class="txtbox" name="driver_email" id="driver_email" value="<?=$rs_driver->email_address?>"></td>
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
        <input type="text" class="txtbox datepicker" name="driver_expiry_date" id="driver_expiry_date" value="<?=$rs_driver->license_expiry_date?>">
        <!--<? $expiryDateArr = explode("-", $rs_driver->license_expiry_date); ?>
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
        </select> -->
        </td>
    </tr>
    <tr>
        <td>Photo</td>
        <td colspan="3"><input type="file" name="driver_photo" id="driver_photo"><? if($_POST['driver_id']!=''){?><img src="<?=DRIVER_FILE_HREF.$rs_driver->photo?>" height="50" width="50"/><? }?>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <div class="fullsize txtwhite txtcenter f18">
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="driverSaveBtn" onclick="saveDriverFrm('<?=$Id?>', event);">Save</div>
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="driverProcessBtn" style="display:none;">Processing..</div>
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


$(function() {
	$(".datepicker").datepicker({
		minDate: new Date(),
		changeMonth: true
 	});  
});
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
                            <tr>
                                <td class="tdhead">Email :</td>
                                <td><?=$rs_driver->email_address?></td>
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
