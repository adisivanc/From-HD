<?
$title= 'Add New Lead';
if($_POST['lead_id']!='' && $_POST['lead_id']>0) {
	$leadId=$_POST['lead_id'];
	$rsLead = Leads::getLeads(array('id'=>$leadId.'-INT'));
	$title = 'Edit '.$rsLead->company_name;
	foreach($rsLead as $K=>$V) $$K=$V;

} else $leadId=0; 

if($city=='') $city='Coimbatore';
?>


    	<form id="addleads_frm" name="addleads_frm" method="post">
        <table width="600" border="0" cellspacing="0" cellpadding="0" class="addleadtbl">
            <input type="hidden" name="company_id" id="company_id" value="<?=$leadId?>" />
  <tr>
    <td style="padding-bottom:0px; padding:15px 0; font-size:25px; border-bottom:1px solid #999" colspan="4">
    	<?=$title?>    </td>
  </tr>
  
  <tr><td class="error" style="display:none" colspan="4"></td></tr>
  
          <tr>
            <td valign="top" class="err_leadtype label-right"><strong>Referred By</strong></td>
            <td> 
              <select name="user_id" id="user_id" class="combo-lg">
              <option value="">Choose Executive</option>
              <?
			  ini_set('display_errors',1);
			  $rsUsers = Users::getUsers(array('access_type'=>'Mkg-STRING'));
			  foreach($rsUsers as $K=>$V) {
			  ?>
              <option value="<?=$V->id?>" <?=($user_id==$V->id)?'selected="selected"':'';?>><?=$V->name?></option>
              <?
			  }
			  ?>
              </select>
            </td>
          </tr>
  
  
          <tr>
            <td valign="top" class="label-right"><strong>Company Name</strong></td>
            <td> <input type="text" class="txtbox" id="company_name" name="company_name" value="<?=$company_name?>" /> </td>
          </tr>


          <tr>
            <td valign="top" class="err_leadtype label-right"><strong>Company Type</strong></td>
            <td> 
            	<input type="radio" id="company_type1" name="company_type" value="H" <?=($company_type=='H')?'checked="checked"':''?> /> Hardware Shop
            	<input type="radio" id="company_type2" name="company_type" value="P" <?=($company_type=='P')?'checked="checked"':''?>/> Painter
                <input type="radio" id="company_type3" name="company_type" value="C" <?=($company_type=='C')?'checked="checked"':''?>/> End User
                <input type="radio" id="company_type3" name="company_type" value="E" <?=($company_type=='E')?'checked="checked"':''?>/> Engineer
            </td>
          </tr>


          <tr>
            <td valign="top" class="label-right"><strong>Address</strong></td>
            <td> <textarea class="txtarea" id="company_address" name="company_address"><?=$address?></textarea> </td>
          </tr>
          <tr>
            <td valign="top" class="label-right"><strong>City</strong></td>
            <td> <input type="text" class="txtbox" id="city" name="city" value="<?=$city?>" /> </td>
          </tr>
          <tr>
            <td valign="top" class="label-right"><strong>Area</strong></td>
            <td> <input type="text" class="txtbox" id="area" name="area" value="<?=$area?>" /> </td>
          </tr>
          <tr>
            <td valign="top" class="label-right"><strong>Contact Person</strong></td>
            <td> <input type="text" class="txtbox" id="contact_person" name="contact_person" value="<?=$contact_person?>" /> </td>
          </tr>
          <tr>
            <td valign="top" class="label-right"><strong>Email</strong></td>
            <td> <input type="text" class="txtbox" id="email" name="email" value="<?=$email?>" /> </td>
          </tr>
          <tr>
            <td valign="top" class="label-right"><strong>Mobile</strong></td>
            <td> <input type="text" class="txtbox" id="mobile" name="mobile" value="<?=$mobile?>" /> </td>
          </tr>
          <tr>
            <td valign="top" class="label-right"><strong>Phone</strong></td>
            <td> <input type="text" class="txtbox" id="phone" name="phone" value="<?=$phone?>" /> </td>
          </tr>
          <tr>
            <td valign="top" class="label-right"><strong>Rate</strong></td>
            <td> <input type="text" class="txtbox" id="rate" name="rate" value="<?=$rate?>" /> </td>
          </tr>
          <tr>
            <td valign="top" class="label-right"><strong>Distance</strong></td>
            <td> <input type="text" class="txtbox" id="distance" name="distance" value="<?=$distance?>" /> </td>
          </tr>
          <tr>
            <td valign="top" class="err_leadtype label-right"><strong>Lead Type</strong></td>
            <td> 
            	<input type="radio" id="leadtype_online" name="lead_type" value="Online" <?=($lead_type=='Online')?'checked="checked"':''?> /> Online
            	<input type="radio" id="leadtype_visit" name="lead_type" value="Visit" <?=($lead_type=='Visit')?'checked="checked"':''?>/> Visit
                <input type="radio" id="leadtype_referral" name="lead_type" value="Referral" <?=($lead_type=='Referral')?'checked="checked"':''?>/> Referral
            </td>
          </tr>
          <tr>
            <td valign="top" class="label-right"><strong>Notes</strong></td>
            <td> <textarea class="txtarea" id="remarks" name="remarks"><?=$remarks?></textarea> </td>
          </tr>
          <tr>
            <td valign="top" align="center" colspan="2">
            
             <tr>
        <td colspan="4" style="text-align:right; margin-top:10px; padding:15px 0; border-top:1px solid #666;">
            <input name="add" id="add" onclick="addLead()" type="button" value="<?=($leadId>0 && $leadId!='')?"Update Lead":"Add Lead"?>"  style="margin-right:15px;"/>    </td>
    </tr>
            	
            </td>
          </tr>
        </table>
        </form>
        


   
   
</table>

