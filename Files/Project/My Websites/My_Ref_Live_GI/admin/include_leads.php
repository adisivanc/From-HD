
<?
$orderBy = 'company_name';  $sortBy='asc';

if($_POST['order']!='') $orderBy = $_POST['order'];
if($_POST['sort']!='') $sortBy = $_POST['sort'];
if($sortBy=='asc') $icon = '<img src="images/asc_icon.png" border="0" style="float:right; cursor:pointer" onclick="sortOrder(\'">';
if($sortBy=='desc') $icon = '<img src="images/desc_icon.png" border="0" style="float:right">';

$rsLeads = Leads::getLeads(array('orderby'=>$orderBy,'sortby'=>$sortBy));
echo count($rsLeads).':::';


?>



<table width="100%" cellpadding="0" cellspacing="0" id="leadListTbl" style="background:#dddddd; margin-top:15px;">
<thead>
    <tr>
        <th style="padding:12px 0; background:#ababab; color:#FFFFFF;" align="left">Name</th>
        <th align="left" style="padding:12px 0;  background:#ababab; color:#FFFFFF;">Status</th>
    </tr>
</thead>

<? 
if(count($rsLeads)>0) {
foreach($rsLeads as $K=>$V) {
$companyCName=$V->company_name;
?>
<tr>
    <td style="padding:10px" colspan="2"><a onclick="loadLeadDtls(<?=$V->id?>)" style="cursor:pointer"><?=$companyCName?></a> </td>
   <!--
    <td width="75"> 
        <img src="images/follow_icon.png" alt="Follow Up" class="cursor" onClick="show_followup('<?=$V->id?>')" /> 
        <img src="images/notes_icon.png" alt="Notes" class="cursor" onClick="show_notes_popup('<?=$V->id?>')" /> 
    </td>
    -->
</tr>
<?
}
} else {
?>
<tr>
<td colspan="2" style="padding:10px; background-color:#FFF">No Leads Added Yet!</td>
</tr>
<?
}
?>
</table>

<table width="100%" cellpadding="0" cellspacing="0" style="background:#cccccc; margin-top:15px;"> 
    <tr>
        <td align="center" style="padding:10px 0;">
            <a onclick="loadLeadDtls(0)" style="cursor:pointer; font-size:14px; background:#FFFFCC; padding:10px 20px;"><strong>Add New Lead</strong></a>
        </td>
    </tr>
</table>