<?
		
	if($_POST['act']=='addTax') {
		  ob_clean();

		  exit();	
	}
	
?>

<div class="taxes_details">
    <table width="450" border="0" cellspacing="0" cellpadding="0" class="addTaxtbl">
      <tr>
        <th colspan="2">Add Tax</th>
      </tr>
      <tr>
        <td valign="top" width="130">Tax Name</td>
        <td> <input type="text" class="txtbox" id="tax_name" name="tax_name" value="" /> </td>
      </tr>
      <tr>
        <td valign="top" id="tax_type_err">Tax Type</td>
        <td> 
            <input type="radio" id="tax_type1" name="tax_type" value="P" /> Percentage
            <input type="radio" id="tax_type2" name="tax_type" value="F" /> Flat
        </td>
      </tr>
      <tr>
        <td valign="top">Tax Value</td>
        <td> <input type="text" class="txtbox" id="tax_value" name="tax_value" value="" /> </td>
      </tr>
      <tr>
        <td valign="top">Description</td>
        <td> <textarea class="txtarea" id="description" name="description" value="" ></textarea>  </td>
      </tr>
      <tr>
        <td valign="top" align="right" colspan="2">
            <input type="button" class="btn" value="Add" onclick="addTax()" />
        </td>
      </tr>
    </table>
</div>


<script type="text/javascript">

function addTax(){
	
	var err = 0;
	var tax_name,tax_type,tax_value,description;

	if(	$('#tax_name').val()=='' ){ err=1; $('#tax_name').addClass('boxred'); } else{ $('#tax_name').removeClass('boxred'); tax_name = $('#tax_name').val(); }
	if(!$('input[name="tax_type"]:checked').val()){ err=1; $('#tax_type_err').addClass('txterror'); } else { $('#tax_type_err').removeClass('txterror'); tax_type = $('input[name="tax_type"]:checked').val(); }
	if(	$('#tax_value').val()=='' ){ err=1; $('#tax_value').addClass('boxred'); } else { $('#tax_value').removeClass('boxred'); tax_value = $('#tax_value').val(); }
	if(	$('#description').val()=='' ){ err=1; $('#description').addClass('boxred'); } else { $('#description').removeClass('boxred'); description = $('#description').val(); }

	if(err==0){ 
	
	 var paramData = {'act':'addTax','tax_name':tax_name,'tax_type':tax_type,'tax_value':tax_value,'description':description }
	 
		ajax({ 
		a:'tax',
		b:$.param(paramData),
		c:function(){},
		d:function(data){}
		});
	
	}
	
}

</script>



