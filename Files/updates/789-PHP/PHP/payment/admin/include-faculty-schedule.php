<? 

if(count($Session)>0){ ?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" style="border:0px #999 solid" bgcolor="#666666">
<tr bgcolor="#999999" height="30" style="font-weight:bold">
<td width="155" height="27" align="center">Date/Time</td>
<td width="389" align="center">Session</td>
<td width="255" align="center">Role</td>
<td width="941" align="center">Topic(s)</td>
<? if($_SESSION['admin_type']=="SA") { ?> 
<td width="12%" align="center">Action</td>
<? } ?>

</tr>
<?
foreach($Session as $K=>$V){
foreach($V as $k=>$v){
$bgcolor = '#ffffff';
if($k%2==0) $bgcolor = '#EFEFEF';

?>
<tr bgcolor="<?=$bgcolor?>">
<td valign="top" align="left" ><strong><?=date('M d,Y',strtotime($v['SessionDate']))?></strong><br /><?=$v['FromTime'].' - '.$v['ToTime']?></td>
<td valign="top" align="left"><?=$v['SessionName']?><? if($v['SubSessionName']!=''){ ?><br />(<?=$v['SubSessionName']?>) <? } ?></td>
<td valign="top" align="left"><? if($v['Type']=='Chair') { echo $v['PersonType']; } else echo 'Speaker'; if($v['SpeakingTime']!=''){ echo '<br />('.$v['SpeakingTime'].')'; } if($v['Remarks']!=''){ echo '<br />('.$v['Remarks'].')'; } ?></td>		
<td valign="top" align="left"><?=$v['Topic']?></td>
<? if($_SESSION['admin_type']=="SA") { ?> 
<td align="center">
<? if($v['Type']=='Speaker') { ?>
<img src="images/edit_icon.png" border="0" style="cursor:pointer" onClick="editFacultyTalks(<?=$v['Id']?>,<?=$rs_list->Id?>)" />&nbsp;
<? } ?>
<img src="images/delete_icon.png" border="0" style="cursor:pointer" onClick="deleteFacultyTalks(<?=$v['Id']?>,<?=$rs_list->Id?>)" />&nbsp;
<img src="images/upload_icon.png" border="0" style="cursor:pointer" />
</td>
<? } ?>
</tr>
<?
if($v['SessionName']=='Luncheon Session' && $v['PersonType']=='Speaker') {
?>
<tr>
  <td colspan="5" bgcolor="#FFFFFF"> The format of this session will be as follows:<br />
    <br />

Kindly pickout 8-10 studies in the last year which could impact current STEMI practice.We would suggest <ul style="margin-left:15px">
<li> One slide that summarizes the current standard of care</li>
<li> One to Two slides on the design and conclusion of the new study</li> </ul>
 
Please share 2-3 studies with each of the discussants so that they can discuss the relevance of the new study. <br />
<br />

Discussants of this Session are:

<ul style="margin-left:15px"><li>Dr. Dharam Kumbhani</li><li>Dr. Satyavan Sharma</li><li>Dr. Bhanu Duggal</li><li>Dr. Sudhir Pillai</li></ul>

</td></tr>
<?
}

} }
?>
</table>
<? }else{ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>
	<td align="center" style="padding:10px;">no details found</td>
</tr>
</table>
<? } ?>