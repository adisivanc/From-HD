<?
$orderBy = 'company_name';  $sortBy='asc';

if($_POST['order']!='') $orderBy = $_POST['order'];
if($_POST['sort']!='') $sortBy = $_POST['sort'];

$rsLeads = Leads::getLeads(array('orderby'=>$orderBy,'sortby'=>$sortBy));
echo count($rsLeads).':::';


?>



<table width="100%" cellpadding="0" cellspacing="0" id="leadListTbl" style="background:#dddddd; margin-top:15px;">
<thead>
    <tr>
        <th style="padding:12px 0; background:#999999; color:#FFFFFF;" align="left">Name</th>
        <th align="left" style="padding:12px 0;  background:#999999; color:#FFFFFF;">Status</th>
    </tr>
</thead>

<tr>
    <td style="padding:10px"><a onclick="" style="cursor:pointer">Products 12</a> </td>
    <td width="75"> 
        <img src="images/edit_icon.png" alt="Follow Up" class="cursor" onClick="" /> 
        <img src="images/close.png" alt="Notes" class="cursor" onClick="" /> 
    </td>
</tr>
<tr>
<td colspan="2" style="padding:10px; background-color:#FFF">No Products Added Yet!</td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" style="background:#cccccc; margin-top:15px; margin-bottom:15px;"> 
    <tr>
        <td align="center" style="padding:10px 0;">
            <a onClick="add_new_product()" style="cursor:pointer; font-size:14px; background:#FFFFCC; padding:10px 20px;"><strong>Add New Users</strong></a>
        </td>
    </tr>
</table>