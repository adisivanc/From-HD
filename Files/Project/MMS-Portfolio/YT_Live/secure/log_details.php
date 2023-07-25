<div style="max-height:700px; overflow-y:scroll;">
<table width="1200" border="0" style="background:#FFFFFF;" class="popuptbl" cellpadding="0" cellspacing="0">
<? 
if(count($rs_logs)>0) {
	foreach($rs_logs as $K=>$V) {
		$rs_user = User::getUserById($V->user_id);
		$changesArr = explode("::", $V->changes);
		$log_user = UserLog::getTableMasterId($V->table_name, $V->table_id);
	?>
    <tr bgcolor="#FFFFFF">
        <td width="100%" align="left" style="padding:0px;">
        	<table border="0" width="100%" cellpadding="0" cellspacing="1" bgcolor="#E5F1FG">
            	<tr bgcolor="#CCCCCC">
                	<th width="90%" valign="top" style="line-height:25px;">
						<?=$V->transaction?><br /><strong><?=ucfirst($rs_user->user_name)?></strong> - <?=date("M d, Y g:i A", strtotime($V->added_date))?>
                    </th>
                    <th width="10%" align="right" valign="top">
                    	<div class="arrow cursor logtbl" id="logtbl_<?=$V->id?>" onclick="showLogsIndDtls('<?=$V->id?>')" style="position:relative; top:30%;" title="Log Details"></div>
                    </th>
                </tr>
                <tr id="logsinddtlstr_<?=$V->id?>" class="logsinddtlstr" style="display:none;">
                    <td colspan="2" id="logsinddtlstab_<?=$V->id?>" class="logsinddtlstab" style="padding:0px; margin:0px;"></td>
                </tr>
            </table>
        </td>
    </tr>
<?
	}
} else {
?>
	<tr bgcolor="#FFFFFF">
    	<td>No logs found..!</td>
    </tr>
<?
}
?>
</table>
</div>