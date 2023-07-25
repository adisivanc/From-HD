<?
function main(){
?>

<link rel="stylesheet" type="text/css" href="css/style.css" /> 

<div class="verfication_cntr" id="vfformpage">
    <div class="verify_outer">
        
        <div class="width_100 verify_inner">
          
          <h1>Verification Form</h1>
          <h3>Dear Parent,</h3>
          <p class="verify_parag">We are happy to be transitioning to a paperless office. As a part of the process, we are hereby confirming your details.</p>
          
            <div class="width_100" style="border:1px solid #d9d9d9; background:#faf7c5; margin-top:15px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="vfpersontbl">
                    <tr>
                        <td class="vfwidth1_50"  align="right" valign="top">Name of the Student :</td>
                        <td class="vfwidth2_50"><input type="text" class="vftxt_box vftxt_width80" id="" name="" value="" /></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">Address :</td>
                        <td><textarea style="height:80px;" class="vftxt_box vftxt_width80" id="" name="" value=""></textarea></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">Blood Group :</td>
                        <td><input type="text"  class="vftxt_box vftxt_width30" id="" name="" value="" /></td>
                    </tr>
                </table>
            </div>
            
            <div class="width_100">
                <div class="vfparent_detail1" style="border:1px solid #d9d9d9; background:#faf7c5; margin-top:10px;">
                	<h2>Mother's Details</h2>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="vfpersontbl">
                        <tr>
                            <td width="30%" align="right" valign="top">Name :</td>
                            <td width="70%"><input type="text" class="vftxt_box vftxt_width80" id="" name="" value="" /></td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">Email :</td>
                            <td><input type="text" class="vftxt_box vftxt_width80" id="" name="" value="" /></td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">Phone :</td>
                            <td><input type="text" class="vftxt_box vftxt_width80" id="" name="" value="" /></td>
                        </tr>
                    </table>
                </div>
                
                <div class="vfparent_detail2" style="border:1px solid #d9d9d9; background:#faf7c5; margin-top:10px;">
                	<h2>Father's Details</h2>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="vfpersontbl">
                        <tr>
                            <td width="30%" align="right" valign="top">Name :</td>
                            <td width="70%"><input type="text" class="vftxt_box vftxt_width80" id="" name="" value="" /></td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">Email :</td>
                            <td><input type="text"  class="vftxt_box vftxt_width80" id="" name="" value="" /></td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">Phone :</td>
                            <td><input type="text" class="vftxt_box vftxt_width80" id="" name="" value="" /></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            
            
            
            <div class="width_100" style="border:1px solid #d9d9d9; background:#faf7c5; margin-top:15px;">
            	<h2 class="vf_subheadh2">Emergency Contact Details</h2>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="vfpersontbl">
                    <tr>
                        <td class="vfwidth1_50" align="right" valign="top">Name :</td>
                        <td class="vfwidth2_50" ><input type="text" class="vftxt_box vftxt_width80" id="" name="" value="" /></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">Relationship :</td>
                        <td><input type="text" class="vftxt_box vftxt_width80" id="" name="" value="" /></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">Phone :</td>
                        <td><input type="text"  class="vftxt_box vftxt_width80" id="" name="" value="" /></td>
                    </tr>
                </table>
            </div>
            
            <div class="width_100" style="margin:20px 0; text-align:center;">
                <div class="vfupdatebtn" onClick="update_save()">UPDATE & SAVE THE INFORMATION</div>
            </div>
            
    	</div>
    
    </div>
</div>




<div class="verfication_cntr" id="vfthankyou">
    <div class="verify_outer">
        
        <div class="width_100 verify_inner">
          
          <h1>Verification Updated</h1>
          <h3>Dear Parent,</h3>
          <p class="verify_parag">Thank you for updating your details. Please note that all feature communications will be mailed to the email address that you have updated.
           Also make sure that you add communications@yellowtrainschool.com to your contact list to avoid getting send to the spam/junk folder.</p>
           <p class="verify_parag">&nbsp;</p>
          <h3>Warm Regards,</h3>
		  <h3>YT Communications Team</h3>
    	</div>
    
    </div>
</div>






<script type="text/javascript">

function update_save(){
    document.getElementById("vfformpage").style.display = "none";
	document.getElementById("vfthankyou").style.display = "block";
}


</script>








<?
}
include "template.php";
?>