<?
$rsLeads = Leads::getLeadFollowups(array('lead_id'=>$_POST['lead_id'].'-INT'));
echo count($rsLeads).':::';
?>
<table width="100%" cellpadding="0" cellspacing="0" id="followupListTbl" style="background:#dddddd; margin-top:15px;">
<thead>
    <tr>
        <th style="padding:12px 0; background:#999999; color:#FFFFFF;" align="left">Notes</th>
        <th align="left" style="padding:12px 0;  background:#999999; color:#FFFFFF;">Date</th>
        <th align="left" style="padding:12px 0;  background:#999999; color:#FFFFFF;">Action</th>
    </tr>
</thead>

<? 
if(count($rsLeads)>0) {
foreach($rsLeads as $K=>$V) {

?>
<tr>
    <td style="padding:10px"><?=$V->followup_notes?></td>
    <td width="90"> <?=date('d M,y',strtotime($V->followup_date))?>
      <td><a onclick="editFollowup(<?=$V->id?>,<?=$V->lead_id?>)" style="cursor:pointer"><img src="images/edit_icon1.png" alt="Edit" /></a></td> 
    </td>
</tr>
<?
}
} else {
?>
<tr>
<td colspan="3" style="padding:10px; background-color:#FFF">No Followups Added Yet!</td>
</tr>
<?
}
?>
</table>