<?
if($actionType=="List") {
$rs_vehicles = Transportation::getAllVehicleBySchoolId($schoolId);
?>
<input type="hidden" name="student_vehicle_page" id="student_vehicle_page" value="<?=$page?>" />

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:7px auto;" class="gradetbl"><!--Student Tab-->
  <tr>
    <th width="11%">S No.</th>
    <th width="21%" align="left">Vehicle Name</th>
    <th width="25%" align="left">Vehicle #</th>
    <th width="29%" align="left">Registration #</th>
    <th width="14%">Action</th>
  </tr>
  <?
  if(count($rs_vehicles)>0) {
      foreach($rs_vehicles as $K=>$V) {
		$is_log = UserLog::checkLogExistsById(TBL_VEHICLES, $V->id);
  ?>
  <tr>
    <td><?=($K+1)?></td>
    <td align="left"><?=$V->vehicle_name?></td>
    <td align="left"><div style="word-break:break-all;"><?=$V->vehicle_number?></div></td>
    <td align="left"><div style="word-break:break-all;"><?=$V->registration_number?></div></td>
    <td align="center">
    	<? if($GLOBALS['isUpdate']){ ?><img src="images/edit_icon.png" alt="Edit" title="Edit" onClick="showTransFrm('V', '<?=$V->id?>');" align="absmiddle" style="cursor:pointer;" /><? } ?> 
        <? if($GLOBALS['isDelete']){ ?><img src="images/delete_icon.png" alt="Delete" title="Delete" onClick="if(confirm('Are you sure want to delete this Vehicle?')) deleteTransFrm('V', '<?=$V->id?>');" align="absmiddle" style="cursor:pointer;" /><? } ?>
        <? if($_SESSION['viewLog'] && $is_log==1) { ?><img src="images/log.png" alt="Log Details" title="Log Details" onClick="showLogDetails('<?=TBL_VEHICLES?>', '', '', '<?=$V->id?>')" align="absmiddle" style="cursor:pointer;" /><? } ?>
    </td>
  </tr>
  <?
      }
  } else {
  ?>
  	<tr><td colspan="6" style="padding:10px;">No results found..!</td></tr>
  <? } ?>
</table>

<?
}


if($actionType=="Form") {
$rs_routes = Transportation::getAllBusRouteBySchoolId($schoolId);
	
if($Id!=""){ 
	$rs_vehicle = Transportation::getVehicleById($Id);
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">
    <tr>
    	<td>Vehicle Name</td>
        <td><input type="text" class="txtbox" name="vehicle_name" id="vehicle_name" value="<?=$rs_vehicle->vehicle_name?>"></td>
    </tr>
    <tr>
        <td>Vehicle Number</td>
        <td><input type="text" class="txtbox" name="vehicle_reg" id="vehicle_reg" value="<?=$rs_vehicle->vehicle_number?>"></td>
    </tr>
    <tr>
        <td>Registration Number</td>
        <td><input type="text" class="txtbox" name="reg_number" id="reg_number" value="<?=$rs_vehicle->registration_number?>"></td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <div class="fullsize txtwhite txtcenter f18">
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="transSaveBtn" onClick="saveTransFrm('<?=$transType?>', '<?=$Id?>')">Save</div>
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="transProcessingBtn" style="display:none;">Processing..</div>
            </div>
        </td>
    </tr>
</table>
<? 
}
?>
