<?

if($_POST['lead_id']!='' && $_POST['lead_id']>0) {
	$leadId=$_POST['lead_id'];
	$rsLead = Leads::getLeads(array('id'=>$leadId.'-INT'));
	foreach($rsLead as $K=>$V) $$K=$V;
    
	if($user_id>0) {
	  	$rsUser = Users::getUsers(array('id'=>$user_id.'-INT'));
		foreach($rsUser as $K=>$V) $$K=$V;
	}

    if($company_type=='H') $company_type='Hardware Shop';
	if($company_type=='P') $company_type='Painter';
	if($company_type=='E') $company_type='Engineer';
	if($company_type=='C') $company_type='End User';
	

?>

        <table width="800" border="0" cellspacing="0" cellpadding="0" class="tab_outer" >
          <tr>
            <th class="leads_tab active" onclick="showLeadDtls(<?=$leadId?>)" id="leadstab_details" >Details</th>
            <th class="leads_tab " onclick="showNotes(<?=$leadId?>)" id="leadstab_notes">Follow Up</th>
            <th class="leads_tab"  onclick="showLog(<?=$leadId?>)" id="leadstab_log">Log</th>
          </tr>
          <tr>
            <td colspan="5">
                <div class="full_width" id="leadContent">
                    <div class="row" style="margin-top:15px;"> 
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="leads_details_tbl">
                    <tr>
                    <th width="33.3%" align="left"><?=$company_name?> <span class="txt_sm cursor">
                    <img src="images/edit_icon.png" alt="Edit" title="Edit" align="absmiddle" style="margin-left:7px; cursor:pointer" 
                    onclick="editLeadDtls(<?=$leadId?>)" /> </span> </th>
                    <th width="33.3%" align="center"><div class="refered_box" onclick="edit_exceutive_popup()"> <?=$name?> </div></th>
                    <th width="33.3%" align="right"><?=$company_type?><br/> <span style="color:#e8298f;"><?=$area?></span> </th>
                    </tr>
                    <tr>
                    <td colspan="3">
                    
                    <div class="cmpy_address">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    <td valign="top"><strong>Address :</strong><br />
                    <?=$address?></td>
                    </tr>
                    </table>
                    </div>
                    
                    <div class="cmpy_contact">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    <td valign="top" width="270"><?=$contact_person?></td>
                    </tr>
                    <tr>
                    <td valign="top"><?=$mobile?></td>
                    </tr>
                    <tr>
                    <td valign="top"><?=$phone?></td>
                    </tr>
                    <tr>
                    <td valign="top"><?=$email?></td>
                    </tr>
                    </table>
                    </div>
                    
                    <div class="distribution_detail">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    <td valign="top" width="120"><strong>Rate per bag :</strong></td>
                    <td valign="top">Rs. <?=$rate?></td>
                    </tr>
                    <tr>
                    <td valign="top" colspan="2"><em style="font-size:12px"><?=$notes?></em></td>
                    </tr>
                    </table>
                    </div>
                    
                    </td>
                    </tr>
                    </table>
                    
                    </div>
                    
            	</div>
            </td>
          </tr>
        </table>    


<script type="text/javascript">

// Follow Up


$('.leads_tab').click(function(){
	$('.leads_tab').removeClass('active');
	$(this).addClass('active');
});

</script>


<?
}
?>