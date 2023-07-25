<?
function main(){
	
if($_POST['act']=="loadTransportList") {
	ob_clean();
	
	$schoolId = $_POST['schoolId'];
	$rs_school = School::getSchoolById($schoolId);
	
	$route_obj = new Transportation();
	$route_obj->school_id = $schoolId;
	$rs_routes = $route_obj->getBusRouteDtls();
	$routes = count($rs_routes);
	
	$vehicle_obj = new Transportation();
	$vehicle_obj->school_id = $schoolId;
	$rs_vehicles = $vehicle_obj->getVehicleDtls();
	$vehicles = count($rs_vehicles);
	
	$driver_obj = new Transportation();
	$driver_obj->school_id = $schoolId;
	$rs_derivers = $driver_obj->getDriverDtls();
	$derivers = count($rs_derivers);

	?>
    <div class="fullsize">
        <div class="fullsize lineht2 border_bottom">
            <div class="pull_left padlr10 padtb10 txtbold letterspac f18"><?=$rs_school->school_name?></div>
        </div>
        
        <div class="fullsize padtb10">
        <div class="grade_division"><!-- Grade Division -->
            <table width="230" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; cursor:pointer;" class="border_theme" onclick="showTransportDtls('B', '<?=$schoolId?>');">
              <tr>
                <td colspan="2" class="bgbrown2 txtcenter f32 txtbold padtb10">Bus Route</td>
              </tr>
              <tr>
                <td width="100%" class="f32 txtbold" align="center"><img src="images/route_icon.jpg" alt="" class="marginleft5 margintop10"/> <span class="lineht1_8 marginleft5"><?=$routes?></span></td>
              </tr>
            </table>
        </div><!-- Grade Division -->
        
        <div class="grade_division"><!-- Grade Division -->
            <table width="230" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; cursor:pointer;" class="border_theme" onclick="showTransportDtls('V', '<?=$schoolId?>');">
              <tr>
                <td colspan="2" class="bgbrown2 txtcenter f32 txtbold padtb10">Vehicles</td>
              </tr>
              <tr>
                <td width="100%" class="f32 txtbold" align="center"><img src="images/vehicle_icon.jpg" alt="" class="marginleft5 margintop10"/> <span class="lineht1_8 marginleft5"><?=$vehicles?></span></td>
              </tr>
            </table>
        </div><!-- Grade Division -->
        
        <div class="grade_division"><!-- Grade Division -->
            <table width="230" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; cursor:pointer;" class="border_theme" onclick="showTransportDtls('D', '<?=$schoolId?>');">
              <tr>
                <td colspan="2" class="bgbrown2 txtcenter f32 txtbold padtb10">Drivers</td>
              </tr>
              <tr>
                <td width="100%" class="f32 txtbold" align="center"><img src="images/driver_icon.jpg" alt="" class="marginleft5 margintop10"/> <span class="lineht1_8 marginleft5"><?=$derivers?></span></td>
              </tr>
            </table>
        </div><!-- Grade Division -->
        
    	</div>
  	</div>
    <?
	
	exit();
}

if($_POST['act']=="loadTransportTypes") {
	ob_clean();
	
	$schoolId = $_POST['schoolId'];
	$actionType = "List";
	if($_POST['transType']=="B") { 
		$head = "Bus Route";
		$addhead = "Add Bus Route";
		$filname = "trans_bus_route.php"; 
	}
	else if($_POST['transType']=="V") { 
		$head = "Vehicles";
		$addhead = "Add Vehicles";
		$filname = "trans_vehicle.php";
	}
	else if($_POST['transType']=="D") {
		$head = "Drivers";
		$addhead = "Add Driver";
		$filname = "trans_driver.php";
	}
	
	?>
    <input type="hidden" name="master_school_id" id="master_school_id" value="<?=$schoolId?>" />
    <div class="fullsize">
                
        <div class="fullsize lineht2 border_bottom">
            <div class="pull_left padlr10 padtb5 txtbold letterspac f22">
				<span class="cursor" onclick="showTransportbySchl('<?=$schoolId?>')"><u>Transport List</u></span> >> <?=$head?>
            </div>
            <div class="pull_right bgbrown2 padlr10 padtb5 txtwhite txtbold f18 cursor margintop5 marginright5" onclick="showTransFrm('<?=$_POST['transType']?>', '')"><?=$addhead?></div>
        </div>
        
        <div class="fullsize padtb10"><!-- Grade Tab-->
            <div class="gradetab_outer">
                <div class="fullsize border_theme" id="gradedetatilstab"><? include $filname; ?></div>
            </div>
        </div><!-- Grade Tab-->
    
    </div>
    <?
	exit();
}

if($_POST['act']=="loadForms") {
	ob_clean();
	$schoolId = $_POST['schoolId'];
	$Id = $_POST['id'];
	$actionType = "Form";
	
	if($_POST['transType']=="B") { 
		$head = "Bus Route";
		$addhead = "Add Bus Route";
		$filname = "trans_bus_route.php"; 
	}
	else if($_POST['transType']=="V") { 
		$head = "Vehicles";
		$addhead = "Add Vehicles";
		$filname = "trans_vehicle.php";
	}
	else if($_POST['transType']=="D") {
		$head = "Drivers";
		$addhead = "Add Driver";
		$filname = "trans_driver.php";
	}
	?>
    <table width="450" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong><?=$head?></strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td colspan="2"><? include $filname; ?></td>
        </tr>
        <? if($_POST['transType']!="D") { ?>
        <tr>
        	<td colspan="2" align="right">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="saveTransFrm('<?=$_POST['transType']?>', '<?=$Id?>')">Save</div>
                </div>
            </td>
        </tr>
        <? } ?>
    </table>
    <?
	exit();
}

if($_POST['act']=="saveTransDtls") {
	ob_clean();
	
	$today=time();
	$sqlDateTime = date('Y-m-d H:i:s',$today);
	$schoolId = $_POST['school_id'];
	$Id = $_POST['id'];
	
	if($_POST['transType']=="B") {
		
		if($_POST['id']!=""){
			Transportation::updateBusRoute($schoolId, $_POST['route_name'], addslashes($_POST['description']), $Id);
		}else{
			Transportation::insertBusRoute($schoolId, $_POST['route_name'], addslashes($_POST['description']), $_SESSION['YTUserId'], $sqlDateTime);
		}
	}
	
	if($_POST['transType']=="V") {
		if($_POST['id']!=""){  
			$updateVehicle = Transportation::updateVehicle($schoolId, $_POST['route_id'], $_POST['vehicle_reg'], $_POST['reg_number'], $_POST['id']);
		}else{
			$rsVehicle = Transportation::insertVehicle($schoolId, $_POST['route_id'], $_POST['vehicle_reg'], $_POST['reg_number'], $_SESSION['YTUserId'], $sqlDateTime);
		}
	}
	
	exit();
}

if($_POST['act']=="deleteTransDtls") {
	ob_clean();
	
	if($_POST['transType']=="B") { 
		Transportation::deleteBusRoute($_POST['id']);
		$vehicleRoute = Transportation::getVehicleByBusRouteId($_POST['id']);
		foreach($vehicleRoute as $K=>$V){
			Transportation::updateVehicleByfield("route_id","",$V->id);
		}
	}
	
	if($_POST['transType']=="V") { 
		Transportation::deleteVehicle($_POST['id']);
		$driverVehicle = Transportation::getDriverByVehicleId($_POST['id']);
		foreach($driverVehicle as $K=>$V){
			Transportation::updateDriverByfield("vehicle_id"," ",$V->id);
		}
	}
	
	if($_POST['transType']=="D") { 
		$rs_driver = Transportation::getDriverById($_POST['id']);
		if($rs_driver->photo!="" && is_file(DRIVER_FILE_PATH.$rs_driver->photo)) {
			unlink(DRIVER_FILE_PATH.$rs_driver->photo);
		}
		Transportation::deleteDriver($_POST['id']);
	}
	
	exit();
}

if($_POST['act']=="driverFrmSubmit") {
	ob_clean();
	
	$error=0;
	if($_FILES['driver_photo']['size'] > 0)
	{
		$up_fileArr = $_FILES['driver_photo']; 
		$rExt = array('jpg','jpeg','png','gif');
		$FileObj = new FileUpload();
		$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$up_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>DRIVER_FILE_PATH));
		if($FileResult['Type']==1)
		{
			$error=1;
			$Err=$FileResult['Error'];
			$ErrFlag = false;
			if($FileResult['ErrorNo']==1)
			{
				$Err = "Valid file formats are ".implode(',',$rExt);
				$ErrFlag = true;
			}
		}
		elseif($FileResult['Type']==2)
		{
			$error=0;
			$Uploadup_file = true;
		}
	}
	
	if($error==0) {
		$license_expiry_date = $_POST['driver_expiry_year']."-".date('m',strtotime($_POST['driver_expiry_month']))."-". $_POST['driver_expiry_date'];
		$vehicleIds = explode("~", $_POST['driver_vehicle_id']);
		$school_id = trim($_POST['driver_school_id']);
		$driver_id = trim($_POST['driver_db_id']);
		
		if($driver_id!="" && $driver_id!="undefined") {
			Transportation::updateDriver($school_id, $vehicleIds[0], $_POST['driver_name'], addslashes($_POST['driver_address']), $_POST['driver_mobile'], $_POST['driver_blood_group'], $_POST['driver_license_number'], $license_expiry_date, $vehicleIds[1], $driver_id);
			$rs_driver_id = $driver_id;
		} else {
			$rs_driver_id = Transportation::insertDriver($school_id, $vehicleIds[0], $_POST['driver_name'], $_POST['driver_address'], $_POST['driver_mobile'], $_POST['driver_blood_group'], $_POST['driver_license_number'], $license_expiry_date, $_SESSION['YTUserId'], $vehicleIds[1]);
		}
		
		if(count($rs_driver_id)>0){
			if($Uploadup_file){
				$FileObj->AssignFileName($rs_driver_id);
				$filepath = $FileObj->Upload();
				$rsDriverImg = Transportation::updateDriverByfield('photo', $filepath, $rs_driver_id);
			}
		}
	}
	ob_clean();
	echo $error."~".$Err;
	
	exit();
}

if($_POST['act']=="viewTransDtls") {
	ob_clean();
	$Id = $_POST['id'];
	$actionType = "View";
	
	if($_POST['transType']=="B") { 
		$head = "Bus Route";
		$addhead = "Add Bus Route";
		$filname = "trans_bus_route.php"; 
	}
	else if($_POST['transType']=="V") { 
		$head = "Vehicles";
		$addhead = "Add Vehicles";
		$filname = "trans_vehicle.php";
	}
	else if($_POST['transType']=="D") {
		$head = "Drivers";
		$addhead = "Add Driver";
		$filname = "trans_driver.php";
	}
	?>
    <table width="450" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong><?=$head?></strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td colspan="2"><? include $filname; ?></td>
        </tr>
    </table>
    <?
	exit();
}

if($_POST['act']=="viewAllStudents") {
	ob_clean();
	/*$stud_obj = new Student();
	$stud_obj->school_id=$_POST['schoolId'];
	$stud_obj->grade_id_not_null='1';
	$stud_obj->sortby='ASC';
	$stud_obj->orderby='grade_id, first_name';
	$rs_students = $stud_obj->getAllStudentDtls();*/
	$rs_students = Student::getUnAssignedRouteStudent($_POST['schoolId'], $_POST['routeId']);
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong>Students Details</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td colspan="2" style="padding:0px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                
                    <tr style="font-weight:bold; background:#E4C6A0;">
                        <td width="12%" style="padding:0px; vertical-align:middle;" align="center" height="40"><input type="checkbox" class="stdcheckall" id="stdcheckall[]" name="stdcheckall[]" /></td>
                        <td width="10%" style="padding:0px; vertical-align:middle;" align="center">#</td>
                        <td width="48%" style="padding:0px; vertical-align:middle;" align="left">Student Name</td>
                        <td width="30%" style="padding:0px; vertical-align:middle;" align="left">Grade</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding:0px;">
                        <div style="max-height:600px; overflow:auto">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="gradetbl">
                                <?
                                if(count($rs_students)>0) {
                                    foreach($rs_students as $K=>$V) {
                                        $student_name = $V->first_name." ".$V->middle_name." ".$V->last_name;
                                        $rs_grade = Grade::getGradeById($V->grade_id); 
										$rs_exists = StudentBusRoute::getStudentBusRouteByStudentId($_POST['routeId'], $V->mas_student_id);
										$exists_route_id=""; $exists_student_id="";
										if($rs_exists->id!=NULL) { $exists_route_id = $rs_exists->id; $exists_student_id = $rs_exists->student_id; }
                                    ?>
                                    <tr>
                                        <td width="12%"><input type="checkbox" class="std_checkbox" id="multi_checkbox" name="multi_checkbox" value="<?=$V->mas_student_id?>~<?=$exists_route_id?>" 
										<?=($V->mas_student_id==$exists_student_id)?"checked":""?> /></td>
                                        <td width="10%"><?=($K+1)?></td>
                                        <td width="48%" align="left"><?=trim($student_name)?></td>
                                        <td width="30%"><?=$rs_grade->grade_name?> <?=($V->grade_section!="" && $V->grade_section!="N")?"":""?></td>
                                    </tr>
                                    <?
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        </td>
                    </tr>
                    
                    <tr>
						<td colspan="4" style="padding:0px; margin:0px;">
                        	<select name="std_route_option" id="std_route_option" class="listbox" onchange="saveStudentRoute('<?=$_POST['schoolId']?>', '<?=$_POST['routeId']?>')">
                            	<option value="">Choose Action</option>
                                <option value="DR">Remove from Route</option>
                                <option value="AR">Add to Route</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <script type="text/javascript">
	$('.stdcheckall').click(function(){
		if($('.stdcheckall').is(':checked')){ $('.std_checkbox').prop('checked',true); }
		else{ $('.std_checkbox').prop('checked',false); }
	});
	</script>
    <?
	exit();
}


if($_POST['act']=="setStdRouteDtls") {
	ob_clean();
	
	$idArr = explode(",", $_POST['availableIds']);
	
	if($_POST['routeAction']=="DR") {
		//Delete
		foreach($idArr as $K=>$V) {
			$VArr = explode("~", $V);
			if($VArr[1]!="") StudentBusRoute::deleteStudentBusRoute($VArr[1]);
		}
	} else {
		//insert or update
		foreach($idArr as $K=>$V) {
			$VArr = explode("~", $V);
			$rs_route = StudentBusRoute::getStudentBusRouteById($VArr[1]);
			if($rs_route->id!=NULL) {
				StudentBusRoute::updateStudentBusRoute($VArr[1], $VArr[0], $_POST['routeId'], $vehicle_id, $driver_id);
			} else {
				StudentBusRoute::insertStudentBusRoute($VArr[0], $_POST['routeId'], $vehicle_id, $driver_id);
			}
		}
	}
	
	exit();
}

	
?>


<link rel="stylesheet" type="text/css" href="css/default_style.css" />
<style type="text/css">
.boxerror{border:1px solid #F00;}
</style>

<div class="fullsize">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright5" /></td>
                <td>List <br/> <span class="f30"><strong>Transport</strong></span></td>
              </tr>
            </table>
        </div>
    </div>
    
</div>

<div class="fullsize">
    
        <div class="fullsize padtb15">
            
            <div class="newsletter_left"> <!-- Grade Menu -->
            	<div class="newsletter_submenu txtwhite">
					<div class="circular_outer">
                    	<div class="newcircular_head" id="show_currentteacher">Transports</div>
                        <ul class="currentteacher_content txttheme">
                        	<? 
							$rs_schools = School::getAccessedSchools($GLOBALS['schoolAccess']); 
							foreach($rs_schools as $sk=>$sv) { 
							?>
                            <? if($GLOBALS['schoolAccess'][$sv->id]) { ?>
                            <li><a onclick="showTransportbySchl('<?=$sv->id?>')" style="cursor:pointer;"><?=$sv->school_name?><span class="tabbtn" id="tabbtn_<?=$sv->id?>"></span></a></li>
							<? } ?>
                            <?
							}
							?>
                        </ul>
                    </div>
                    
                </div>
            </div><!-- Grade Menu -->
            
            <div class="newsletter_right border_theme bgwhite" id="transportlisttab"></div><!-- Grade -->
            
        </div>
    
</div>

<div id="transport_popup" style="display:none; margin:0px; padding:0px;"></div>


<script type="text/javascript">

function popupDtls(){
	
	$("#transport_popup").show();
  	$("#transport_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true
	});
						
	$(".ui-widget-header").css({"display":"none"});
}

function closePopup(){ $("#transport_popup").dialog('close');  }

showTransportbySchl('<?=$rs_schools[0]->id?>');
function showTransportbySchl(school_id) { 
	
	$("#transportlisttab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	$('.tabbtn').removeClass('arrow');
	$('#tabbtn_'+school_id).addClass('arrow');
	ajax({
		a:'transport',
		b:'act=loadTransportList&schoolId='+school_id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#transportlisttab").html(data);
		}			
	});
	
}

function showTransportDtls(type, school_id) { 
	
	$("#transportlisttab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'transport',
		b:'act=loadTransportTypes&transType='+type+'&schoolId='+school_id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#transportlisttab").html(data);
		}			
	});
}

function showTransFrm(type, id) { 
	if(id=="" || id==undefined) id=""; else id=id;
	var	school_id = $("#master_school_id").val();
	
	$("#transport_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'transport',
		b:'act=loadForms&transType='+type+'&schoolId='+school_id+'&id='+id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#transport_popup").html(data);
			popupDtls()
		}			
	});
	
}

function saveTransFrm(type, id) { //alert(type); alert(id);
	if(id=="" || id==undefined) id=""; else id=id;
	
	var	school_id = $("#master_school_id").val();
	var param="", err=0; 
	
	param = 'act=saveTransDtls&transType='+type+'&school_id='+school_id+'&id='+id;
	
	if(type=="B") {
		var	route_name = $.trim($("#route_name").val());
		var	description = $.trim($("#description").val());
		
		
		if($('#route_name').val()==''){ err=1; $('#route_name').addClass('boxerror'); } else { $('#route_name').removeClass('boxerror'); }
		
		if($('#description').val()==''){ err=1; $('#description').addClass('boxerror'); } else { $('#description').removeClass('boxerror'); }
		param = param+'&route_name='+route_name+'&description='+description;
	}
	
	if(type=="V") {
		var	route_id = $.trim($("#vehicle_route_id").val());
		var	vehicle_reg = $.trim($("#vehicle_reg").val());
		var	reg_number = $.trim($("#reg_number").val());
		
		if($('#vehicle_route_id').val()==''){ err=1; $('#vehicle_route_id').addClass('boxerror'); } else { $('#vehicle_route_id').removeClass('boxerror'); }
		if($('#vehicle_reg').val()==''){ err=1; $('#vehicle_reg').addClass('boxerror'); } else { $('#vehicle_reg').removeClass('boxerror'); }
		if($('#reg_number').val()==''){ err=1; $('#reg_number').addClass('boxerror'); } else { $('#reg_number').removeClass('boxerror'); }
		if($('#vehicle_route_id').val()==''){ err=1; $('#vehicle_route_id').addClass('boxerror'); } else { $('#vehicle_route_id').removeClass('boxerror'); }
		param = param+'&vehicle_reg='+vehicle_reg+'&route_id='+route_id+'&reg_number='+reg_number;
	}
		
	if(err==0) { //alert(param);
		ajax({
			a:'transport',
			b:param,		
			c:function(){},
			d:function(data){ //alert(data);
				if(id!="" && id!=undefined){
					alert("Updated Successfully");
				}else{
					alert("Added Successfully");
				}
				closePopup();
				showTransportDtls(type, school_id);
			}			
		});
	}
	
	
}

function deleteTransFrm(type, id) {
	var	school_id = $("#master_school_id").val();
	ajax({
		a:'transport',
		b:'act=deleteTransDtls&transType='+type+'&id='+id,		
		c:function(){},
		d:function(data){ //alert(data);
			alert('Deleted Successfully');
			showTransportDtls(type, school_id);
		}			
	});
	
}

function viewTransFrm(type, id) {
	
	$("#transport_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'transport',
		b:'act=viewTransDtls&transType='+type+'&id='+id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#transport_popup").html(data);
			popupDtls()
		}			
	});
	
}
function saveDriverFrm(id, e) {
	var	school_id = $("#master_school_id").val();
	var myfrm = document.getElementById('driverFrm'); 
	e.preventDefault();
	
	var err=0;
	if($('#driver_name').val()==''){ err=1; $('#driver_name').addClass('boxerror'); } else { $('#driver_name').removeClass('boxerror'); }
	if($('#driver_address').val()==''){ err=1; $('#driver_address').addClass('boxerror'); } else { $('#driver_address').removeClass('boxerror'); }
	if($('#driver_mobile').val()==''){ err=1; $('#driver_mobile').addClass('boxerror'); } else { $('#driver_mobile').removeClass('boxerror'); }
	if($('#driver_blood_group').val()==''){ err=1; $('#driver_blood_group').addClass('boxerror'); } else { $('#driver_blood_group').removeClass('boxerror'); }
	if($('#driver_license_number').val()==''){ err=1; $('#driver_license_number').addClass('boxerror'); } else { $('#driver_license_number').removeClass('boxerror'); }
	if($('#driver_license_expiry_date').val()==''){ err=1; $('#driver_license_expiry_date').addClass('boxerror'); } else { $('#license_expiry_date').removeClass('boxerror'); }
	if($('input[name=driver_vehicle_id]:checked').val()==undefined){ err=1; $('#driver_vehicle_id_tab').addClass('txterror'); } else { $('#driver_vehicle_id_tab').removeClass('txterror'); }
	
	if(err==0) {
		$.ajax({
			url: "transport.php",   	// Url to which the request is send
			type: "POST",      				// Type of request to be send, called as method
			data:  new FormData(myfrm), 		// Data sent to server, a set of key/value pairs representing form fields and values 
			contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
			cache: false,					// To unable request pages to be cached
			processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
			success: function(data)  		// A function to be called if request succeeds
			{
				//alert(data); return false;
				var dataArr = data.split('~');
				if(dataArr[0]==0) {
					if(id!="" && id!=undefined){
						alert("Updated Successfully");
					}else{
						alert("Added Successfully");
					}
					closePopup();
					showTransportDtls('D', school_id);
				} else {
					alert(dataArr[1]);
				}
				
			}	        
		});
	}
	   
}

function showStudents(route_id, school_id) {
	
	$("#transport_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'transport',
		b:'act=viewAllStudents&routeId='+route_id+'&schoolId='+school_id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#transport_popup").html(data);
			popupDtls();
		}			
	});
	
}

function saveStudentRoute(school_id, route_id) {
	
	var err=0;
	var availableIds = $('input[class=std_checkbox]:checked').map(function(){
		return this.value;
	}).get();
	var routeAction = $('#std_route_option').val();
	
	if(availableIds=="") { err=1; alert('Please select rows'); $('#multi_actions').val(''); }
	
	if(err==0) {
		$("#transport_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
		ajax({
			a:'transport',
			b:'act=setStdRouteDtls&availableIds='+availableIds+'&routeAction='+routeAction+'&schoolId='+school_id+'&routeId='+route_id,
			c:function(){},
			d:function(data) { //alert(data); return false;
				showTransportDtls('B', school_id);
				closePopup();
			}
		});
	}
	
}

</script>



<?
}
include "template.php";
?>