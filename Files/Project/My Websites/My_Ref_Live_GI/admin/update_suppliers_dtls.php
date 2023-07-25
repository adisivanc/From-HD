  
  <div class="row" style="margin-top:15px;" id="suppliertab_cntr"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="suppliertab_outer">
          <tr>
            <th width="25%" class="supplier_tab active" id="show_supplier_info">Info</th>
            <th width="25%" class="supplier_tab" id="show_supplier_purchase">Purchase</th>
            <th width="25%" class="supplier_tab" id="show_supplier_notes">Notes</th>
            <th width="25%" class="supplier_tab" id="">&nbsp;</th>
          </tr>
          <tr>
            <td colspan="4">
            
                <div class="full_width" id="supplier_info">
                	<? include "include_supplierinfo.php"; ?>
            	</div>
                
                <div class="full_width" id="supplier_purchase" style=" height:435px;">
                	<div class="row">
                        Purchase Order 
                    </div>
                </div>
                
                <div class="full_width" id="supplier_notes" style=" height:435px;">
                	<div class="row">
                        Purchase Notes
                    </div>
                </div>

            </td>
          </tr>
        </table>
  
  </div>
  
  
    <div class="full_width" >
        <? include "add_new_suppliers.php"; ?>
    </div>

  
<script type="text/javascript">


$("#show_supplier_info").click( function() {
	$("#supplier_info").show();
	$("#supplier_purchase").hide();
	$("#supplier_notes").hide();
});


$("#show_supplier_purchase").click( function() {
	$("#supplier_info").hide();
	$("#supplier_purchase").show();
	$("#supplier_notes").hide();
});


$("#show_supplier_notes").click( function() {
	$("#supplier_info").hide();
	$("#supplier_purchase").hide();
	$("#supplier_notes").show();
});


$('.supplier_tab').click(function(){
	$('.supplier_tab').removeClass('active');
	$(this).addClass('active');
});


</script>
