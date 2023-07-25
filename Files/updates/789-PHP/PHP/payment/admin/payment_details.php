<?
function main(){

	$rsltCustDlts = Newsletter::getAllPayType(); // Update while data insert everytime
	

if($_POST['act']=="insert_cust_paymethod") {
	
	ob_clean();
	
	$postVarss = array('customer_address','customer_mobile','cust_pay_method','customer_name'); // Form an array
	foreach($postVarss as $K=>$V) 
	$$V = $_POST[$V]; // Assign value
	Newsletter::insertCustDltss($customer_address,$customer_mobile,$cust_pay_method,$customer_name); // Call To insertCustDltss() in Class Newsletter
	
	exit();
}



?>

<style>

table tr td { padding:7px 0; }
.paybtn { width:150px; background:#555555; color:#FFFFFF; text-align:center; padding:12px 0; cursor:pointer; margin-top:25px; font-size:20px;  }

.txtbox { width:250px; font-size:17px; color:#333333; height:32px; }
.listbox { width:257px; font-size:17px; color:#333333; height:32px; }

</style>


<input type="hidden" name="" id="" value="<?=$rsltCustDlts->id?>" />

<table width="600" border="0" cellspacing="0" cellpadding="0" style="margin:200px auto 0 auto; text-align:center;">
  <tr>
    <td width="40%">Customer Name</td>
    <td>
    	<input type="text" class="txtbox" id="customer_name" name="customer_name" value="" />
    </td>
  </tr>
  <tr>
    <td>Address</td>
    <td>
    	<input type="text" class="txtbox" id="customer_address" name="customer_address" value="" />
    </td>
  </tr>
  <tr>
    <td>Mobile</td>
    <td>
    	<input type="text" class="txtbox" id="customer_mobile" name="customer_mobile" value="" />
    </td>
  </tr>
  <tr>
    <td>Payment Method</td>
    <td>
    	<select class="listbox" id="cust_pay_method" name="cust_pay_method">
        	<? foreach($rsltCustDlts as $K=>$V) { ?> <!-- Get an element in DB with $rsltCustDlts -->
                <option value="<?=$V->pay_type?>"><?=$V->pay_type?></option>
            <? } ?>
        </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    	<div class="paybtn" onclick="SubmitCustomerDtls()">Pay</div>
    </td>
  </tr>
</table>




<script>


function SubmitCustomerDtls() {
	
	var err=0;
	
		
	if ($('#customer_name').val()=='') { err = 1;$('#customer_name').addClass('boxerror'); } else { var customer_name=$('#customer_name').removeClass('boxerror').val(); }
	if ($('#customer_address').val()=='') { err = 1;$('#customer_address').addClass('boxerror'); } else { var customer_address=$('#customer_address').removeClass('boxerror').val(); }
	if ($('#customer_mobile').val()=='') { err = 1;$('#customer_mobile').addClass('boxerror'); } else { var customer_mobile=$('#customer_mobile').removeClass('boxerror').val(); }
	if ($('#cust_pay_method').val()=='') { err = 1;$('#cust_pay_method').addClass('boxerror'); } else { var cust_pay_method=$('#cust_pay_method').removeClass('boxerror').val(); }

	var paramData =  
				{
				"act":"insert_cust_paymethod",
				"customer_address": customer_address,
				"customer_mobile": customer_mobile,
				"cust_pay_method": cust_pay_method,
				"customer_name": customer_name,
				};


	if(err==0)
	{
		ajax({
			a:'payment_details',
			b:$.param(paramData),
			c:function(){},
			d:function(data) {
				alert(data);
			}
		});
	}
		
}



</script>



<?
}
include "admin_template.php";
?>