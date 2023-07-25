<?
function main(){
	


if($_POST['act']=="insert_paymethod") {
	
	ob_clean();
	
	$postVars = array('add_paymethod');
	foreach($postVars as $K=>$V) 
	$$V = $_POST[$V];
	Newsletter::insertPayType($add_paymethod);
	
	exit();
}



if($_POST['act']=="showPaymentList") {
	
	ob_clean();
	$rslt_paymenttype=Newsletter::getAllPayType();
	
	
	?>
    
        <table width="600" border="1" cellspacing="0" cellpadding="0" style="margin:100px auto 0 auto; text-align:center;">
          <tr>
            <td>Id &nbsp; &nbsp;</td>
            <td>Pay Type &nbsp; &nbsp;</td>
            <td>Added Date &nbsp; &nbsp;</td>
            <td>Updated Date &nbsp;&nbsp;</td>
          </tr>
          <? foreach($rslt_paymenttype as $K=>$V) { ?> <!-- Display List -->
          <tr>
            <td><?=$V->id?></td> <!-- Retrive element by Value and DB fieldname id -->
            <td><?=$V->pay_type?></td> <!-- DB fieldname pay_type -->
            <td><?=$V->added_date?></td> <!-- DB fieldname added_date -->
            <td><?=$V->updated_date?></td>
          </tr>
          <? } ?>
        </table>
    
    <?

	exit();
	
}

?>

<style>

table tr td { padding:8px 0; font-size:17px; }
.txtbox { width:230px; font-size:17px; height:32px; }
.submitbtn { width:150px; color:#000000; font-size:17px; }

.tbl tr td { border:1px solid #d9d9d9; }

.paybtn { width:150px; background:#555555; color:#FFFFFF; text-align:center; padding:7px 0;  }

</style>



<table width="500" border="0" cellspacing="0" cellpadding="0" style="margin:150px auto 0 auto;">
  <tr>
    <td width="50%" align="right" valign="middle">Add Pay Type : &nbsp; &nbsp;</td>
    <td>
		<input type="text" class="txtbox" id="add_paymethod" name="add_paymethod" value="" />
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<input type="button" class="submitbtn" id="" name="" value="Submit" onclick="SubmitAddPayFrm()" />
    </td>
  </tr>
</table>




<div style="width:100%; float:left;" id="show_payment_types"></div>


<div style="width:100%; float:left; clear:left; margin:20px 0;" align="center">
	<a href="payment_details.php" target="_blank">
        <div class="paybtn">Goto Pay</div>
    </a>
</div>


<script type="text/javascript">

function SubmitAddPayFrm() {
	
	var err=0;
	
		
	if ($('#add_paymethod').val()=='') { err = 1;$('#add_paymethod').addClass('boxerror'); } else { var add_paymethod=$('#add_paymethod').removeClass('boxerror').val(); }

	var paramData =  
				{
				"act":"insert_paymethod", // calling Function
				"add_paymethod": add_paymethod, // If needed add an extra element here
				};


	if(err==0)
	{
		ajax({
			a:'payment_type', // File name
			b:$.param(paramData), // Function where we want to get transfer all data
			c:function(){}, // Incase of any failure in the result
			d:function(data) { // Success in the getting data
				alert(data); // passing data to upper function
				updatePaymentListDtls(); // While Insert we want to update an element in the list, so calling this function
			}
		});
	}
		
}


updatePaymentListDtls(); // While Insert we want to update an element in the list, so calling this function
function updatePaymentListDtls() {
	
	ajax({
		a:'payment_type',
		b:'act=showPaymentList',
		c:function () {},
		d:function (data) {
			$('#show_payment_types').html(data); // Gettng a list of element
		}
	});
	
}

</script>



<?
}
include "admin_template.php";
?>