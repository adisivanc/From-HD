<?
		
	if($_POST['act']=='addProduct') {
		  ob_clean();

		  exit();	
	}
	
?>

<div class="products_details">
    	<table width="450" border="0" cellspacing="0" cellpadding="0" class="addProducttbl">
          <tr>
            <th colspan="2">Add Products</th>
          </tr>
          <tr>
            <td valign="top" width="130">Product Name</td>
            <td> <input type="text" class="txtbox" id="name" name="name" value="" /> </td>
          </tr>
          <tr>
            <td valign="top">Unit</td>
            <td> <input type="text" class="txtbox-md" id="units" name="units" value="" /> </td>
          </tr>
          <tr>
            <td valign="top">Description</td>
            <td> <textarea class="txtarea" id="description" name="description" value="" ></textarea>  </td>
          </tr>
          <tr>
            <td valign="top" id="type_error">Type</td>
            <td> 
                <input type="radio" id="product_type1" name="product_type" value="RM" /> Raw Material  
                <input type="radio" id="product_type2" name="type" value="P" /> Products 
            </td>
          </tr>
          <tr>
            <td valign="top">Tax id</td>
            <td> <input type="text" class="txtbox" id="tax_id" name="tax_id" value="" /> </td>
          </tr>
          <tr>
            <td valign="top">Tax Value</td>
            <td> <input type="text" class="txtbox" id="tax_value" name="tax_value" value="" /> </td>
          </tr>
          <tr>
            <td valign="top">Unit Price</td>
            <td> <input type="text" class="txtbox" id="unit_price" name="unit_price" value="" /> </td>
          </tr>
          <tr>
            <td valign="top">Total Price</td>
            <td> <input type="text" class="txtbox" id="total_price" name="total_price" value="" /> </td>
          </tr>
          <tr>
            <td valign="top">Stock Count</td>
            <td> <input type="text" class="txtbox" id="stock_count" name="stock_count" value="" /> </td>
          </tr>
          <tr>
            <td valign="top">Reorder Count</td>
            <td> <input type="text" class="txtbox" id="reorder_count" name="reorder_count" value="" /> </td>
          </tr>
          <tr>
            <td valign="top" align="right" colspan="2">
            	<input type="button" class="btn" value="Add" onclick="addProducts()" />
            </td>
          </tr>
        </table>
</div>


<script type="text/javascript">

function addProducts(){
	
	var err = 0;
	var name,units,description,type,tax_id,tax_value,unit_price,total_price,stock_count,reorder_count;

	if(	$('#name').val()=='' ){ err=1; $('#name').addClass('boxred'); } else{ $('#name').removeClass('boxred'); name = $('#name').val(); }
	if(	$('#units').val()=='' ){ err=1; $('#units').addClass('boxred'); } else { $('#units').removeClass('boxred'); units = $('#units').val(); }
	if(	$('#description').val()=='' ){ err=1; $('#description').addClass('boxred'); } else { $('#description').removeClass('boxred'); description = $('#description').val(); }
	if(	$('#tax_id').val()=='' ){ err=1; $('#tax_id').addClass('boxred'); } else{ $('#tax_id').removeClass('boxred'); tax_id = $('#tax_id').val(); }
	if(	$('#unit_price').val()=='' ){ err=1; $('#unit_price').addClass('boxred'); } else { $('#unit_price').removeClass('boxred'); unit_price = $('#unit_price').val(); }
	if(	$('#tax_value').val()=='' ){ err=1; $('#tax_value').addClass('boxred'); } else { $('#tax_value').removeClass('boxred'); tax_value = $('#tax_value').val(); }
	if(	$('#total_price').val()=='' ){ err=1; $('#total_price').addClass('boxred'); } else { $('#total_price').removeClass('boxred'); total_price = $('#total_price').val(); }
	if(	$('#stock_count').val()=='' ){ err=1; $('#stock_count').addClass('boxred'); } else { $('#stock_count').removeClass('boxred'); stock_count = $('#stock_count').val(); }
	if(	$('#reorder_count').val()=='' ){ err=1; $('#reorder_count').addClass('boxred'); } else { $('#reorder_count').removeClass('boxred'); reorder_count = $('#reorder_count').val(); }

	if(!$('input[name="type"]:checked').val())
	{ 
		err=1; 
		$('#type_error').addClass('txterror'); 
	} 
	else 
	{ 
		$('#type_error').removeClass('txterror'); 
		type = $('input[name="type"]:checked').val(); 
	}

	if(err==0){ 
	
	 var paramData = {'act':'addProducts','name':name,'units':units,'type':type,'description':description,'tax_id':tax_id,'tax_value':tax_value,'unit_price':unit_price,'total_price':total_price,'stock_count':stock_count,'reorder_count':reorder_count }
	 
		ajax({ 
		a:'products',
		b:$.param(paramData),
		c:function(){},
		d:function(data){}
		});
	
	}
	
}

</script>



