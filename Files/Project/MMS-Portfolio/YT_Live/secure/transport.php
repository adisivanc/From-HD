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
                <td width="100%" class="f32 txtbold" align="center">
                	<img src="images/route_icon.jpg" alt="" class="marginleft5 margintop10"/> <span class="lineht1_8 marginleft5"><?=$routes?></span>
                </td>
              </tr>
            </table>
        </div><!-- Grade Division -->
        
        <div class="grade_division"><!-- Grade Division -->
            <table width="230" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; cursor:pointer;" class="border_theme" onclick="showTransportDtls('V', '<?=$schoolId?>');">
              <tr>
                <td colspan="2" class="bgbrown2 txtcenter f32 txtbold padtb10">Vehicles</td>
              </tr>
              <tr>
                <td width="100%" class="f32 txtbold" align="center">
                	<img src="images/vehicle_icon.jpg" alt="" class="marginleft5 margintop10"/> <span class="lineht1_8 marginleft5"><?=$vehicles?></span>
                </td>
              </tr>
            </table>
        </div><!-- Grade Division -->
        
        <div class="grade_division"><!-- Grade Division -->
            <table width="230" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; cursor:pointer;" class="border_theme" onclick="showTransportDtls('D', '<?=$schoolId?>');">
              <tr>
                <td colspan="2" class="bgbrown2 txtcenter f32 txtbold padtb10">Drivers</td>
              </tr>
              <tr>
                <td width="100%" class="f32 txtbold" align="center">
                	<img src="images/driver_icon.jpg" alt="" class="marginleft5 margintop10"/> <span class="lineht1_8 marginleft5"><?=$derivers?></span>
                </td>
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
		$tablename = TBL_BUS_ROUTES.",".TBL_BUS_ROUTE_STOPS.",".TBL_STUDENT_BUS_ROUTE;
	}
	else if($_POST['transType']=="V") { 
		$head = "Vehicles";
		$addhead = "Add Vehicles";
		$filname = "trans_vehicle.php";
		$tablename = TBL_VEHICLES;
	}
	else if($_POST['transType']=="D") {
		$head = "Drivers";
		$addhead = "Add Driver";
		$filname = "trans_driver.php";
		$tablename = TBL_DRIVERS;
	}
	?>
    <input type="hidden" name="master_school_id" id="master_school_id" value="<?=$schoolId?>" />
    <div class="fullsize">
                
        <div class="fullsize lineht2 border_bottom">
            <div class="pull_left padlr10 padtb5 txtbold letterspac f22">
				<span class="cursor" onclick="showTransportbySchl('<?=$schoolId?>')"><u>Transport List</u></span> >> <?=$head?>
            </div>
             <? if($_SESSION['viewLog']) {?><div class="pull_right bgbrown2 padlr10 padtb5 txtwhite txtbold f18 cursor margintop5 marginright5"onclick="showLogDetails('<?=$tablename?>', '')">Logs</div><? }?>
            <div class="pull_right bgbrown2 padlr10 padtb5 txtwhite txtbold f18 cursor margintop5 marginright5" onclick="showTransFrm('<?=$_POST['transType']?>', '')"><?=$addhead?></div>
        </div>
        
        <div class="fullsize" style="padding:5px;"><!-- Grade Tab-->
            <div class="gradetab_outer" style="width:99%; margin:0px;">
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
	$transType = $_POST['transType'];
	
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
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong><?=$head?></strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td colspan="2"><? include $filname; ?></td>
        </tr>
        <!--<? if($_POST['transType']!="D") { ?>
        <tr>
        	<td colspan="2" align="right">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="transSaveBtn" onClick="saveTransFrm('<?=$_POST['transType']?>', '<?=$Id?>')">Save</div>
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="transProcessingBtn" style="display:none;">Processing..</div>
                </div>
            </td>
        </tr>
        <? } ?>-->
    </table>
    <?
	exit();
}

if($_POST['act']=="loadRouteStops") {
	ob_clean();
	$bus_obj = new Transportation();
	$bus_obj->route_id=$_POST['routeId'];
	$bus_obj->fields='id, stop_type';
	$rs_stops = $bus_obj->getBusRouteStopDtls();
	$rs_route = Transportation::getBusRouteById($_POST['routeId']);
	$stopsTypeArr=array();
	?>
    <div class="fullsize">
                
        <div class="fullsize lineht2 border_bottom">
            <div class="pull_left padlr10 padtb5 txtbold letterspac f22">
				<?=$rs_route->route_name?>
            </div>
            <div class="pull_right padlr10 padtb10 txtbold letterspac f18"># Stops : <?=count($rs_stops)?></div>
            <? if($rs_route->id!=NULL) { ?>
            <? if($GLOBALS['isUpdate']){ ?><div class="pull_right padlr10 padtb10 txtbold letterspac f18"><img src="images/edit_icon.png" alt="Edit" title="Edit" onClick="showTransFrm('B', '<?=$_POST['routeId']?>');" align="absmiddle" style="cursor:pointer;" /> </div><? } ?>
            <? if($GLOBALS['isDelete']){ ?><div class="pull_right padlr10 padtb10 txtbold letterspac f18"><img src="images/delete_icon.png" alt="Delete" title="Delete" onClick="if(confirm('Are you sure want to delete the Bus Route?')) deleteTransFrm('B', '<?=$_POST['routeId']?>');" align="absmiddle" style="cursor:pointer;" /></div><? } ?>
            <? if($_SESSION['viewLog']) { ?><div class="pull_right padlr10 padtb10 txtbold letterspac f18"><img src="images/log.png" alt="Log Details" title="Log Details" onClick="showLogDetails('<?=TBL_BUS_ROUTES.",".TBL_BUS_ROUTE_STOPS.",".TBL_STUDENT_BUS_ROUTE?>', '', '', '<?=$_POST['routeId']?>')" align="absmiddle" style="cursor:pointer;" /></div><? } ?>
			<? if($GLOBALS['isAdd']){ ?><div class="pull_right combutton margin5 txtbold letterspac f18" onclick="showAllStudents('<?=$_POST['routeId']?>')">Assign Student</div><? } ?>
            <? } ?>
        </div>
        
        <div class="fullsize padtb10"><!-- Grade Tab-->
            
            <div class="gradetab_outer" style="width:98%; margin:0 1%;">
                
                <div class="pull_left">
                    <div class="grade_tab active" id="grade_tab_T" onclick="showStopTypeDtls('T', '<?=$_POST['routeId']?>')">To School</div>
                    <div class="grade_tab" id="grade_tab_F" onclick="showStopTypeDtls('F', '<?=$_POST['routeId']?>')">From School</div>
                </div>
                <div class="fullsize border_theme" id="stoptypedtltab"></div>
            </div>
            
        </div><!-- Grade Tab-->
    
    </div>
    <script type="text/javascript">showStopTypeDtls('T', '<?=$_POST['routeId']?>')</script>
    <?
	exit();
}

if($_POST['act']=="loadStopTypeDtls") {
	ob_clean();
	if($_POST['stopType']=="F") { $stopposition = "stop_from_position"; $stopid = "from_stop_id"; } 
	if($_POST['stopType']=="T") { $stopposition = "stop_to_position"; $stopid = "to_stop_id"; }
	
	$stop_obj = new Transportation();
	$stop_obj->route_id=$_POST['routeId'];
	//$stop_obj->stop_type=$_POST['stopType'];
	$stop_obj->stop_type_in="'".$_POST['stopType']."', 'B'";
	$stop_obj->sortby="ASC"; 
	$stop_obj->orderby=$stopposition;
	$rs_stops = $stop_obj->getBusRouteStopDtls();
	$rs_route = Transportation::getBusRouteById($_POST['routeId']);
	?>
    <style>.dragTr:hover td{border-bottom:1px solid #DAB791; border-top:1px solid #DAB791;}</style>
    <div id="status" style="display:none; color:#093; text-align:center; padding:10px; font-weight:bold;"></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="gradetbl" id="stopTbl">
      <thead><tr>
        <th width="13%" style="border-bottom:1px solid #DAB791;">S No.</th>
        <th width="21%" align="left" style="border-bottom:1px solid #DAB791;">Stops</th>
        <th width="31%" align="left" style="border-bottom:1px solid #DAB791;">Student</th>
        <th width="20%" style="border-bottom:1px solid #DAB791;">Driver</th>
        <th width="20%" style="border-bottom:1px solid #DAB791;">Action</th>
      </tr></thead>
      <tbody>
      <?
      if(count($rs_stops)>0) {
          foreach($rs_stops as $K=>$V) {
              $is_log1=0; $is_log2=0;
              $is_log1 = UserLog::checkLogExistsById(TBL_BUS_ROUTES, $V->id);
              $is_log2 = UserLog::checkLogExistsById(TBL_STUDENT_BUS_ROUTE, '', $V->id);
			  $rs_driver = Transportation::getDriverById($rs_route->driver_id);
			  
			  $stud_obj = new StudentBusRoute();
			  $stud_obj->$stopid = $V->id;
			  $stud_obj->fields = "id, student_id";
			  $rs_students = $stud_obj->getStudentBusRouteDtls();
			  
			  $student_names_arr=array();
			  if(!empty($rs_students)) {
				  foreach($rs_students as $k1=>$v1) { 
				  	$rs_student = Student::getStudentById($v1->student_id);
			  		$student_names_arr[] = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
				  }
			  }
			  $student_names = implode(", <br />", $student_names_arr);
			  
			 
      ?>
      <tr id="<?=$V->id?>" style="cursor:move;" class="dragTr">
        <td class="dragHandle" valign="top"><?=($K+1)?></td>
        <td class="dragHandle" align="left" valign="top"><?=$V->stop_name?></td>
        <td class="dragHandle" align="left"><div style="word-break:break-all;"><?=($student_names=='')?"--":$student_names?></div></td>
        <td class="dragHandle"><?=$rs_driver->driver_name?></td>
        <td class="dragHandle">
            <? if($GLOBALS['isAdd']){ ?><img src="images/student_icon.jpg" alt="Add Student" title="Add Student" onClick="showStudentsFrm('<?=$V->id?>', '<?=$_POST['routeId']?>', '<?=$_POST['stopType']?>')" align="absmiddle" style="cursor:pointer;" width="25" height="25" /><? } ?>
        </td>
      </tr>
      <?
          }
      } else { ?>
        <tr><td colspan="5" style="padding:10px;">No results found..!</td></tr>
      <? } ?>
      </tbody>
    </table>
    <script type="text/javascript">
	$(document).ready(function() { 
		$('#status').hide(); $('#status').html('');
		$('#stopTbl').tableDnD({
			onDrop: function(table, row) { 
				var rows = table.tBodies[0].rows; 
				var companies='';
				for (var i=0; i<rows.length; i++) { 
					companies += rows[i].id+",";
				}
				companies = companies.substring(0, companies.length - 1); 
				
				var stop_type = '<?=$stopposition?>';
				var paramData = {'act':'updateStopPosition', 'position':companies, 'stop_type':stop_type };
				ajax({ 
					a:'transport',
					b:$.param(paramData),
					c:function(){},
					d:function(data){ //alert(data);
						$('#status').show();
						$('#status').html(data);
				}});
			}, 
			dragHandle: ".dragHandle"
		});
	});
	</script>
    <?
	exit();
}

if($_POST['act']=="updateStopPosition") {
	ob_clean();
	Transportation::updateBusRouteStopPosition($_POST['position'], $_POST['stop_type']);
	echo "Postion Changed Successfully";
	exit();
}

if($_POST['act']=="loadStopAssigningFrm") {
	ob_clean();
	$Id = $_POST['id'];
	$routeId = $_POST['routeId'];
	$stopType = $_POST['stopType'];
	if($stopType=="F") $stopposition = "from_stop_id"; if($stopType=="T") $stopposition = "to_stop_id";
	
	$stud_obj = new StudentBusRoute();
	$stud_obj->route_id = $routeId;
	$stud_obj->$stopposition = $Id;
	$studentStopsArr = $stud_obj->getStudentBusRouteDtls();
	
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong>Edit Bus Stop</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td colspan="2" style="padding:0px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    	<td>Enter Student</td>
                        <td>
                        	<div id="StudentLevelTop"></div>
                            <span class="spancursor" id="studentLevel_a" style="cursor:pointer;" onclick="addStudent();">
                            <div class="pull_right txtbold f24 cursor">+</div>
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
        	<td colspan="2">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="studentSaveBtn" onClick="saveStudentStop('<?=$Id?>', '<?=$routeId?>', '<?=$stopType?>')">Save</div>
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="studentProcessingBtn" style="display:none;">Processing..</div>
                </div>
            </td>
        </tr>
    </table>
    <input type="hidden" name="stopstudentcount" id="stopstudentcount" value="" />
    <script type="text/javascript">
	
	function defaultLoader(){
		
		// Stop for To School Starts Here..
		jQuery('#StudentLevelTop').empty().html('');
		var vhtm = new Array();
		var i = 0;
		<? 	
		if((!empty($studentStopsArr)) &&(count($studentStopsArr)>0)){
			foreach($studentStopsArr as $tk=>$tv) {
				$rs_student = Student::getStudentById($tv->student_id);
				$student_name = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
			?>
				addStudent({id:'<?=$tv->id?>', student_id:'<?=$tv->student_id?>', stop_student_name:'<?=$student_name?>'});
		<?  } 
		} 
		else { ?>addStudent(); <? } ?>
	}
	
	function addStudent(a){
		if(a==undefined) a={};
		if(a.id==undefined) a.id='';
		if(a.student_id==undefined) a.student_id='';
		if(a.stop_student_name==undefined) a.stop_student_name='';
		if(a.Value==undefined) a.Value='';
		
		var row = jQuery('div.Studentclvltop').length;
		
		var vhtml = '';
		vhtml += '<div id="spStudentLevel_'+row+'" class="Studentclvltop" style="margin-top:0px; text-align:left;">';
		vhtml += '	<div id="spStudentLevel_'+row+'" class="dimage" style="margin-bottom:5px;">';
		vhtml += '		<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>';
		vhtml += '			<td style="padding:5px;"><input type="text" class="txtbox" name="StudentStopArr[stop_student_name]['+row+']" id="stop_student_name'+row+'" value="'+$.trim(a.stop_student_name)+'" placeholder="Type Student Name" /><input type="hidden" class="stop_student_id" name="StudentStopArr[stop_student_id]['+row+']" id="stop_student_id'+row+'" value="'+a.student_id+'" /></td>';
		vhtml +='			<td style="padding:0px;"><div class="txtbold f24 cursor" style="padding:0px; margin:0px; cursor:pointer; width:10%; height:5px; float:right" id="studentLevel_r" onclick="removeStudentTopLevel('+row+', &quot;'+a.id+'&quot;);">-</div></td>';
		vhtml += '		</tr></table>';
		vhtml += '	</div>';
		vhtml += '</div>';
		
		jQuery('#StudentLevelTop').append(vhtml);
		
		$().ready(function() { 
			var	school_id = $("#master_school_id").val(); 
			$("#stop_student_name"+row).autocomplete("search_details.php?search_type=bus_student&student_notin_route=<?=$routeId?>&type=name&school_id="+school_id,{ 
				width:'auto', selectFirst: false,
				select: function(event, ui) { alert(event); }});	
			$("#stop_student_name"+row).result(function(event, data, formatted) {
				$("#stop_student_id"+row).val(data[1]);
			});
		});
		
		$('#stopstudentcount').val(jQuery('div.Studentclvltop').length);
		
	}
	
	function removeStudentTopLevel(r, id){ 
		var i1; 
		if(r==undefined){ 
			var row = jQuery('div.Studentclvltop').length-1;
			jQuery('#spStudentLevel_'+row).remove();
		}
		else {  
		
			var msg = confirm('Are you sure want to delete this stop?');
			if(msg==true) {
				var stopType = '<?=$stopType?>';
				ajax({
					a:'transport',
					b:'act=deleteStudentBusStop&id='+id+'&stopType='+stopType,		
					c:function(){},
					d:function(data){ //alert(data);
						alert('Deleted Successfully..!');
					}			
				});
				jQuery('#spStudentLevel_'+r).remove();
				if(jQuery('div.dimage').length==0){
					for(i1=0;i1<100;i1++){
						if(jQuery('Studentclvltop').length>0)
							jQuery('#spStudentLevel_'+i1).remove();
						else
							i1 = 101;
					}
					addStudent();
				}
			}
			
		}
		if(jQuery('div.Studentclvltop').length==0)
			addStudent();
	}

	jQuery(function(){
	
		jQuery('#studentLevel_r').show();
		jQuery('#studentLevel_a').show();
		defaultLoader();
		
	});
	
	</script>
    <?
	exit();
}

if($_POST['act']=="assignStudentStop") {
	ob_clean();
	//Transportation::updateBusRouteStopByStudent($_POST['studentIds'], $_POST['id']);
	$routeId = $_POST['routeId'];
	$studentIds = $_POST['studentIds'];
	$stopId = $_POST['id'];
	$stopType = $_POST['stopType'];
	
	$studentsArr = explode(",", $studentIds);
	if(!empty($studentsArr) && count($studentsArr)>0) {
		foreach($studentsArr as $kk=>$vv) { 
			$rs_exists = StudentBusRoute::getStudentBusRouteByStudId($vv);
			if($stopType=="F") { $from_stop_id = $stopId; $to_stop_id = $rs_exists->to_stop_id; }
			if($stopType=="T") { $from_stop_id = $rs_exists->from_stop_id; $to_stop_id = $stopId; }
			if($rs_exists->id!=NULL) {
				StudentBusRoute::updateStudentBusRoute($rs_exists->id, $vv, $routeId, $from_stop_id, $to_stop_id);
			} else {
				StudentBusRoute::insertStudentBusRoute($vv, $routeId, $from_stop_id, $to_stop_id);
			}
		}
	}
	exit();
}

if($_POST['act']=="saveBusRoute") {
	ob_clean();
		$route_id =$_POST['bus_route_db_id'];
		$school_id =$_POST['bus_route_school_id'];
		$vehicleIds = implode(",", $_POST['vehicle_id']);
		$action = "";
		if($route_id!="") {
			Transportation::updateBusRoute($school_id, check_input(ucwords($_POST['route_name'])), check_input($_POST['description']), $vehicleIds, $_POST['driver_id'], $_POST['sec_driver_id'], $route_id); 
			$rs_id = $route_id;
			$action = "update";
		}
		else {
			$rs_id = Transportation::insertBusRoute($school_id, check_input(ucwords($_POST['route_name'])), check_input($_POST['description']), $vehicleIds, $_POST['driver_id'], $_POST['sec_driver_id']);
			$action = "insert";
		}
		
		if($rs_id>0) {
			$toStopsArr = $_POST['ToStopsArr'];
			if(count($toStopsArr)>0 && !empty($toStopsArr)) { 
				if($action=="update") {
					$bus_obj = new Transportation();
					$bus_obj->route_id=$rs_id;
					$bus_obj->fields='max(stop_from_position) as MaxFromPosition, max(stop_to_position) as MaxToPosition';
					$rs_stops = $bus_obj->getBusRouteStopDtls();
					$tindex=$rs_stops[0]->MaxToPosition+1; $findex=$rs_stops[0]->MaxFromPosition+1;
				} else { $tindex=1; $findex=1; }

				foreach($toStopsArr['to_stop_name'] as $tk=>$tv) {  
					$stop_db_id = $toStopsArr['to_stop_id'][$tk];
					$stop_type = $toStopsArr['stop_type'][$tk];
					if($toStopsArr['to_stop_id'][$tk]!="" && $toStopsArr['to_stop_id'][$tk]!="undefined") {
						Transportation::updateBusRouteStop($school_id, $rs_id, $stop_type, check_input(ucfirst($tv)), $toStopsArr['from_stop_position'][$tk], $toStopsArr['to_stop_position'][$tk], $stop_db_id);
					} else {
						$from_position = 0; $to_position = 0;
						if($stop_type=="F" || $stop_type=="B") { $from_position = $findex; $findex++; }
						if($stop_type=="T" || $stop_type=="B") { $to_position = $tindex; $tindex++; }
						Transportation::insertBusRouteStop($school_id, $rs_id, $stop_type, check_input(ucfirst($tv)), $from_position, $to_position);
					}
					
				}
			}
		}
		ob_clean();
		echo $rs_id;
		
	exit();
}

if($_POST['act']=="deleteStop") {
	ob_clean();
	Transportation::deleteBusRouteStop($_POST['id']);
	exit();
}

if($_POST['act']=="saveTransDtls") {
	ob_clean();
	$schoolId = $_POST['school_id'];
	$Id = $_POST['id'];
	if($_POST['transType']=="V") {
		if($_POST['id']!="") $updateVehicle = Transportation::updateVehicle($schoolId, check_input($_POST['vehicle_reg']), check_input($_POST['reg_number']), check_input($_POST['vehicle_name']), $_POST['id']);
		else $rsVehicle = Transportation::insertVehicle($schoolId, check_input($_POST['vehicle_reg']), check_input($_POST['reg_number']), check_input($_POST['vehicle_name']));
	}
	exit();
}

if($_POST['act']=="deleteTransDtls") {
	ob_clean();
	
	if($_POST['transType']=="B") { 
		Transportation::deleteBusRoute($_POST['id']);
		Transportation::deleteBusRouteStopByRouteId($_POST['id']);
	}
	
	if($_POST['transType']=="V") { 
		Transportation::deleteVehicle($_POST['id']);
	}
	
	if($_POST['transType']=="D") { 
		$rs_driver = Transportation::getDriverById($_POST['id']);
		if($rs_driver->photo!="" && is_file(DRIVER_FILE_PATH.$rs_driver->photo)) { unlink(DRIVER_FILE_PATH.$rs_driver->photo); }
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
		if($FileResult['Type']==1) {
			$error=1;
			$Err=$FileResult['Error'];
			$ErrFlag = false;
			if($FileResult['ErrorNo']==1) {
				$Err = "Valid file formats are ".implode(',',$rExt);
				$ErrFlag = true;
			}
		}
		elseif($FileResult['Type']==2) {
			$error=0;
			$Uploadup_file = true;
		}
	}
	
	if($error==0) {
		//$license_expiry_date = $_POST['driver_expiry_year']."-".date('m',strtotime($_POST['driver_expiry_month']))."-". $_POST['driver_expiry_date'];
		if($_POST['driver_expiry_date']!='' && $_POST['driver_expiry_date']!="1970-01-01") $license_expiry_date = date("Y-m-d", strtotime($_POST['driver_expiry_date'])); else $license_expiry_date='';
		$school_id = trim($_POST['driver_school_id']);
		$driver_id = trim($_POST['driver_db_id']);
		
		if($driver_id!="" && $driver_id!="undefined") {
			Transportation::updateDriver($school_id, ucwords($_POST['driver_name']), check_input($_POST['driver_address']), $_POST['driver_email'], $_POST['driver_mobile'], $_POST['driver_blood_group'], $_POST['driver_license_number'], $license_expiry_date, $driver_id);
			$rs_driver_id = $driver_id;
		} else {
			$rs_driver_id = Transportation::insertDriver($school_id, ucwords($_POST['driver_name']), check_input($_POST['driver_address']), $_POST['driver_email'], $_POST['driver_mobile'], $_POST['driver_blood_group'], $_POST['driver_license_number'], $license_expiry_date);
		}
		
		if(count($rs_driver_id)>0){
			if($Uploadup_file){
				$FileObj->AssignFileName($rs_driver_id);
				$filepath = $FileObj->Upload();
				Transportation::updateDriverByfield('photo', $filepath, $rs_driver_id);
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

if($_POST['act']=="loadStudentStopFrm") {
	ob_clean();
	$routeId = $_POST['routeId'];
	$bus_obj = new Transportation();
	$bus_obj->route_id=$routeId;
	$bus_obj->stop_type_in="'F', 'B'";
	$rs_stops_from = $bus_obj->getBusRouteStopDtls();
	
	$bus_obj->stop_type_in="'T', 'B'";
	$rs_stops_to = $bus_obj->getBusRouteStopDtls();
	
	$stud_obj = new StudentBusRoute();
	$stud_obj->route_id = $routeId;
	$rs_students = $stud_obj->getStudentBusRouteDtls();
			  
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left" colspan="2"><strong>Assign Students</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
        	<td colspan="2" style="padding:0px;"> <div style="max-height:550px; overflow-y:scroll;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    	<td>Enter Student</td>
                        <td>
                        	<div id="StudentStopLevelTop"></div>
                            <span class="spancursor" id="studentLevel_a" style="cursor:pointer;" onclick="addStopStudent();">
                            <div class="pull_right txtbold f24 cursor">+</div>
                            </span>
                        </td>
                    </tr>
                </table></div>
            </td>
        </tr>
        <tr>
        	<td colspan="2">
            	<div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="studentSaveBtn" onClick="saveAllStudentStop('<?=$routeId?>')">Save</div>
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="studentProcessingBtn" style="display:none;">Processing..</div>
                </div>
            </td>
        </tr>
    </table>
    <input type="hidden" name="studentstopcount" id="studentstopcount" value="" />
    <script type="text/javascript">
	
	function defaultStopLoader(){
		
		// Stop for To School Starts Here..
		jQuery('#StudentStopLevelTop').empty().html('');
		var vhtm = new Array();
		var i = 0;
		<? 	
		if((!empty($rs_students)) &&(count($rs_students)>0)){
			foreach($rs_students as $tk=>$tv) {
				$rs_student = Student::getStudentById($tv->student_id);
				$student_name = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
			?>
				addStopStudent({id:'<?=$tv->id?>', student_name:'<?=$student_name?>', student_id:'<?=$tv->student_id?>', from_stop_id:'<?=$tv->from_stop_id?>', to_stop_id:'<?=$tv->to_stop_id?>'});
		<?  } 
		} 
		else { ?>addStopStudent(); <? } ?>
	}
	
	function addStopStudent(a){
		if(a==undefined) a={};
		if(a.id==undefined) a.id='';
		if(a.student_name==undefined) a.student_name='';
		if(a.student_id==undefined) a.student_id='';
		if(a.from_stop_id==undefined) a.from_stop_id='';
		if(a.to_stop_id==undefined) a.to_stop_id='';
		if(a.Value==undefined) a.Value='';
		
		var row = jQuery('div.StudentStopclvltop').length;
		
		var vhtml = '';
		vhtml += '<div id="spStudentStopLevel_'+row+'" class="StudentStopclvltop" style="margin-top:0px; text-align:left;">';
		vhtml += '	<div id="spStudentStopLevel_'+row+'" class="dimage" style="margin-bottom:5px;">';
		vhtml += '		<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>';
		vhtml += '			<td style="padding:5px;"><input type="text" class="student_name txtbox" name="StudentStopArr[student_name]['+row+']" id="student_name'+row+'" value="'+$.trim(a.student_name)+'" placeholder="Type Student Name" /><input type="hidden" class="student_id" name="StudentStopArr[student_id]['+row+']" id="student_id'+row+'" value="'+a.student_id+'" /></td>';
		vhtml += '			<td style="padding:5px;">From School : <select name="StudentStopArr[from_stop_id]['+row+']" id="from_stop_id'+row+'" class="from_stop_id listbox"><option value="">Select Stop</option>';
		
		<? if(count($rs_stops_from)>0) { 
			foreach($rs_stops_from as $k=>$v) {  ?>
		vhtml += '			<option value="<?=$v->id?>" '+(a.from_stop_id=='<?=$v->id?>'?'selected':'')+'><?=$v->stop_name?></option>';
		<?
			}
		}
		?>
		
		vhtml += '			</select></td>';
		vhtml += '			<td style="padding:5px;">To School : <select name="StudentStopArr[to_stop_id]['+row+']" id="to_stop_id'+row+'" class="to_stop_id listbox"><option value="">Select Stop</option>';
		
		<? if(count($rs_stops_to)>0) { 
			foreach($rs_stops_to as $k=>$v) {  ?>
		vhtml += '			<option value="<?=$v->id?>" '+(a.to_stop_id=='<?=$v->id?>'?'selected':'')+'><?=$v->stop_name?></option>';
		<?
			}
		}
		?>
		
		vhtml += '			</select></td>';
		vhtml +='			<td style="padding:0px;"><div class="txtbold f24 cursor" style="padding:0px; margin:0px; cursor:pointer; width:10%; height:5px; float:right" id="studentStopLevel_r" onclick="removeStudentStopTopLevel('+row+', &quot;'+a.id+'&quot;);">-</div></td>';
		vhtml += '		</tr></table>';
		vhtml += '	</div>';
		vhtml += '</div>';
		
		jQuery('#StudentStopLevelTop').append(vhtml);
		
		$().ready(function() { 
			var	school_id = $("#master_school_id").val(); 
			$("#student_name"+row).autocomplete("search_details.php?search_type=bus_student&student_notin_route=<?=$routeId?>&type=name&school_id="+school_id,{ 
				width:'auto', selectFirst: false,
				select: function(event, ui) { alert(event); }});	
			$("#student_name"+row).result(function(event, data, formatted) {
				$("#student_id"+row).val(data[1]);
			});
		});
		
		$('#studentstopcount').val(jQuery('div.StudentStopclvltop').length);
		
	}
	
	function removeStudentStopTopLevel(r, id){
		var i1; 
		if(r==undefined){ 
			var row = jQuery('div.StudentStopclvltop').length-1;
			jQuery('#spStudentLevel_'+row).remove();
		}
		else {  
		
			var msg = confirm('Are you sure want to delete this stop?');
			if(msg==true) {
				ajax({
					a:'transport',
					b:'act=deleteStudentBusStop&id='+id,		
					c:function(){},
					d:function(data){ //alert(data);
						alert('Deleted Successfully..!');
					}			
				});
				
				jQuery('#spStudentStopLevel_'+r).remove();
				if(jQuery('div.dimage').length==0){
					for(i1=0;i1<100;i1++){
						if(jQuery('StudentStopclvltop').length>0)
							jQuery('#spStudentStopLevel_'+i1).remove();
						else
							i1 = 101;
					}
					addStopStudent();
				}
			}
			
		}
		if(jQuery('div.StudentStopclvltop').length==0)
			addStopStudent();
	}

	jQuery(function(){
	
		jQuery('#studentStopLevel_r').show();
		jQuery('#studentStopLevel_a').show();
		defaultStopLoader();
		
	});
	
	</script>
    <?

	exit();
}

if($_POST['act']=="deleteStudentBusStop") {
	ob_clean();
		if($_POST['stopType']!="" && $_POST['stopType']!="undefined") {
			if($_POST['stopType']=="F") StudentBusRoute::updateStudentBusRouteByfield("from_stop_id", "0", $_POST['id']);
			if($_POST['stopType']=="T") StudentBusRoute::updateStudentBusRouteByfield("to_stop_id", "0", $_POST['id']);
			$rs_student_stop = StudentBusRoute::getStudentBusRouteById($_POST['id']);
			if($rs_student_stop->from_stop_id==0 && $rs_student_stop->to_stop_id==0) {
				StudentBusRoute::deleteStudentBusRoute($_POST['id']);
			}
			
		} else {
			StudentBusRoute::deleteStudentBusRoute($_POST['id']);
		}
	exit();
}

if($_POST['act']=="assignAllStudentStop") {
	ob_clean();
	$routeId = $_POST['routeId'];
	$studentIds = $_POST['studentIds'];
	$fromStopIds = $_POST['fromStopIds'];
	$toStopIds = $_POST['toStopIds'];
	
	$studentsArr = explode(",", $studentIds); $fromStopArr = explode(",", $fromStopIds); $toStopArr = explode(",", $toStopIds);
	if(!empty($studentsArr) && count($studentsArr)>0) {
		foreach($studentsArr as $kk=>$vv) { 
			$rs_exists = StudentBusRoute::getStudentBusRouteByStudId($vv);
			if($rs_exists->id!=NULL) {
				StudentBusRoute::updateStudentBusRoute($rs_exists->id, $vv, $routeId, $fromStopArr[$kk], $toStopArr[$kk]);
			} else {
				StudentBusRoute::insertStudentBusRoute($vv, $routeId, $fromStopArr[$kk], $toStopArr[$kk]);
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
            
            <div class="newsletter_right border_theme bgwhite" id="transportlisttab" style="width:78.8%;"></div><!-- Grade -->
            
        </div>
    
</div>

<div id="transport_popup" style="display:none; margin:0px; padding:0px;"></div>

<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/jquery.tablednd.js"></script>
<script type="text/javascript">

function popupDtls(){
	
	$("#transport_popup").show();
  	$("#transport_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true,
		position: { 'my': 'center', 'at': 'top' }
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

function showTransportDtls(type, school_id, is_reload_id) { 
	
	$("#transportlisttab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'transport',
		b:'act=loadTransportTypes&transType='+type+'&schoolId='+school_id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#transportlisttab").html(data);
			if(is_reload_id!="" && is_reload_id!=undefined) showRouteStops(is_reload_id);
		}			
	});
}

function showTransFrm(type, id) { 
	if(id=="" || id==undefined) id=""; else id=id;
	var	school_id = $("#master_school_id").val();
	
	$("#transport_popup").dialog('open');
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

function showRouteStops(id) {
	$("#routedtlstab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'transport',
		b:'act=loadRouteStops&routeId='+id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#routedtlstab").html(data);
		}			
	});
}

function showStopTypeDtls(type, route_id) {
	$('.grade_tab').removeClass('active');
	$('#grade_tab_'+type).addClass('active');

	$("#stoptypedtltab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'transport',
		b:'act=loadStopTypeDtls&routeId='+route_id+'&stopType='+type,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#stoptypedtltab").html(data);
		}			
	});
}

function saveTransFrm(type, id) { //alert(type); alert(id);
	if(id=="" || id==undefined) id=""; else id=id;
	
	var	school_id = $("#master_school_id").val();
	var param="", err=0; 
	
	param = 'act=saveTransDtls&transType='+type+'&school_id='+school_id+'&id='+id;
	
	if(type=="V") {
		if($('#vehicle_name').val()==''){ err=1; $('#vehicle_name').addClass('boxerror'); } else { var vehicle_name = escape($.trim($('#vehicle_name').removeClass('boxerror').val())); }
		if($('#vehicle_reg').val()==''){ err=1; $('#vehicle_reg').addClass('boxerror'); } else { var vehicle_reg = escape($.trim($('#vehicle_reg').removeClass('boxerror').val())); }
		if($('#reg_number').val()==''){ err=1; $('#reg_number').addClass('boxerror'); } else { var reg_number = escape($.trim($('#reg_number').removeClass('boxerror').val())); }
		param = param+'&vehicle_reg='+vehicle_reg+'&reg_number='+reg_number+'&vehicle_name='+vehicle_name;
	}
		
	if(err==0) { //alert(param);
		$('#transSaveBtn').hide();
		$('#transProcessingBtn').show();
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
	
	if($('#driver_email').val()=='') { err=1; $('#driver_email').addClass('boxerror'); }
	else {	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#driver_email').val()) == false) { err=1; $('#driver_email').addClass('boxerror'); }
		else{ $('#driver_email').removeClass('boxerror'); }
	}
	
	if(err==0) {
		$("#driverSaveBtn").hide();
		$("#driverProcessBtn").show();
		$.ajax({
			url: "transport.php",
			type: "POST",
			data:  new FormData(myfrm),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data) {
				//alert(data); return false;
				$("#driverSaveBtn").show();
				$("#driverProcessBtn").hide();
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

function showStudentsFrm(id, route_id, type) {
	
	$("#transport_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'transport',
		b:'act=loadStopAssigningFrm&id='+id+'&routeId='+route_id+'&stopType='+type,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#transport_popup").html(data);
			popupDtls();
		}			
	});
	
}

function saveStudentStop(id, route_id, stop_type) {
	
	var err=0;
	var student_count = $('#stopstudentcount').val();
	for(var i=0; i<student_count; i++) { 
		if($('#stop_student_name'+i).val()==''){ err=1; $('#stop_student_name'+i).addClass('boxerror'); } else { $('#stop_student_name'+i).removeClass('boxerror'); }
	} 
	if(err==0) {
		$("#studentProcessingBtn").show();
		$("#studentSaveBtn").hide();
		var student_ids = $('.stop_student_id').map(function(){
			return this.value;
		}).get();

		ajax({
			a:'transport',
			b:'act=assignStudentStop&id='+id+'&studentIds='+student_ids+'&stopType='+stop_type+'&routeId='+route_id,		
			c:function(){},
			d:function(data){ 
				$("#studentProcessingBtn").hide();
				$("#studentSaveBtn").show(); //alert(data); return false;
				alert('Assigned Successfully..!');
				closePopup();
				showStopTypeDtls(stop_type, route_id);
			}			
		});
	}
}

function showAllStudents(route_id) {
	$("#transport_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'transport',
		b:'act=loadStudentStopFrm&routeId='+route_id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#transport_popup").html(data);
			popupDtls();
		}			
	});
}

function saveAllStudentStop(route_id) {
	
	var err=0;
	var student_count = $('#studentstopcount').val();
	for(var i=0; i<student_count; i++) { 
		if($('#student_name'+i).val()==''){ err=1; $('#student_name'+i).addClass('boxerror'); } else { $('#student_name'+i).removeClass('boxerror'); }
		if($('#from_stop_id'+i).val()==''){ err=1; $('#from_stop_id'+i).addClass('boxerror'); } else { $('#from_stop_id'+i).removeClass('boxerror'); }
		if($('#to_stop_id'+i).val()==''){ err=1; $('#to_stop_id'+i).addClass('boxerror'); } else { $('#to_stop_id'+i).removeClass('boxerror'); }
	} 
	if(err==0) {
		$("#studentProcessingBtn").show();
		$("#studentSaveBtn").hide();
		var student_ids = $('.student_id').map(function(){
			return this.value;
		}).get();
		var from_stop_ids = $('.from_stop_id').map(function(){
			return this.value;
		}).get();
		var to_stop_ids = $('.to_stop_id').map(function(){
			return this.value;
		}).get();

		ajax({
			a:'transport',
			b:'act=assignAllStudentStop&routeId='+route_id+'&studentIds='+student_ids+'&fromStopIds='+from_stop_ids+'&toStopIds='+to_stop_ids,		
			c:function(){},
			d:function(data){ 
				$("#studentProcessingBtn").hide();
				$("#studentSaveBtn").show(); //alert(data); return false;
				alert('Assigned Successfully..!');
				closePopup();
				showStopTypeDtls('T', route_id);
			}			
		});
	}
	
}

</script>



<?
}
include "template.php";
?>