<?

if($actionType=="List") {
$rs_routes = Transportation::getAllBusRouteBySchoolId($schoolId);

?>
<input type="hidden" name="student_route_page" id="student_route_page" value="<?=$page?>" />

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:7px auto;" class="gradetbl"><!--Student Tab-->
  <tr>
    <th width="13%">S No.</th>
    <th width="21%" align="left">Route Name</th>
    <th width="31%" align="left">Description</th>
    <th width="20%">Total Students</th>
    <th width="15%">Action</th>
  </tr>
  <?
  if(count($rs_routes)>0) {
      foreach($rs_routes as $K=>$V) {
		  $route_obj = new StudentBusRoute();
		  $route_obj->route_id=$V->id;
		  $rs_stds = $route_obj->getStudentBusRouteDtls();
		  $is_log = UserLog::checkLogExistsById(TBL_BUS_ROUTES, $V->id);
  ?>
  <tr>
    <td><?=($K+1)?></td>
    <td align="left" valign="top"><?=$V->route_name?></td>
    <td align="left"><div style="word-break:break-all;"><?=stripslashes($V->description)?></div></td>
    <td><?=count($rs_stds)?></td>
    <td>
    	<img src="images/edit_icon.png" alt="Edit" title="Edit" onClick="showTransFrm('B', '<?=$V->id?>');" align="absmiddle" style="cursor:pointer;" /> 
        <img src="images/delete_icon.png" alt="Delete" title="Delete" onClick="if(confirm('Are you sure want to delete the Bus Route?')) deleteTransFrm('B', '<?=$V->id?>');" align="absmiddle" style="cursor:pointer;" />
        <img src="images/student_icon.jpg" alt="Add Student" title="Add Student" onClick="showStudents('<?=$V->id?>', '<?=$schoolId?>')" align="absmiddle" style="cursor:pointer;" width="25" height="25" />
        <? if($_SESSION['viewLog'] && $is_log==1) { ?><img src="images/log.png" alt="Log Details" title="Log Details" onClick="showLogDetails('<?=TBL_BUS_ROUTES.",".TBL_STUDENT_BUS_ROUTE?>', '', '', '<?=$V->id?>')" align="absmiddle" style="cursor:pointer;" /><? } ?>
    </td>
  </tr>
  <?
      }
	
  } else {
  ?>
  	<tr><td colspan="5" style="padding:10px;">No results found..!</td></tr>
  <? } ?>
</table>

<?
}


if($actionType=="Form") {
	
if($Id!=""){
	$rs_busroutes = Transportation::getBusRouteById($Id);
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtbl">
    <tr>
        <td colspan="2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">
                <tr>
                    <td>Route Name</td>
                    <td colspan="3"><input type="text" class="txtbox" name="route_name" id="route_name" value="<?=stripslashes($rs_busroutes->route_name)?>"></td>
                </tr>
                
                <tr>
                    <td>Description</td>
                    <td colspan="3"><textarea class="msgbox" id="description" name="description" cols="36"><?=$rs_busroutes->description?></textarea></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<? 
}
?>
