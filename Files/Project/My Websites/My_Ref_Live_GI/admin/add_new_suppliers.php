<?
		
	if($_POST['act']=='addSuppliers') {
		  ob_clean();

		  exit();	
	}
	
?>

<div class="row" style="margin-top:15px;">

<table border="0" cellspacing="0" cellpadding="0" class="supplier_dtlstbl">
  <tr>
    <td>
    	<h3 class="sub_header">Company Details:</h3>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_suppliertbl">
          <tr>
            <td width="180">Company Name :</td>
            <td> <input type="text" name="company_name" id="company_name" value="" class="txtbox" /> </td>
          </tr>
          <tr>
            <td>Address :</td>
            <td> <textarea class="txtarea" id="address" name="address"></textarea> </td>
          </tr>
          <tr>
            <td>City :</td>
            <td> <input type="text" class="txtbox" name="city" id="city" value="" /> </td>
          </tr>
          <tr>
            <td>State :</td>
            <td><input type="text" name="state" id="state" value="" class="txtbox" /></td>
          </tr>
          <tr>
            <td>Zip Code :</td>
            <td><input type="text" class="txtbox-md" name="zipcode" id="zipcode" value="" /></td>
          </tr>
          <tr>
            <td>Country :</td>
            <td>
                <select class="combo-lg" name="country" id="country">
                    <option value="">Select Country</option>
                </select>
            </td>
          </tr>
        </table>

    </td>
  </tr>
  <tr>
    <td>
    	<h3 class="sub_header">Contact Details:</h3>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_suppliertbl">
          <tr>
            <td width="180">Contact Name :</td>
            <td><input type="text" class="txtbox" id="contact_name" name="contact_name" value="" /></td>
          </tr>
          <tr>
            <td>Email :</td>
            <td><input type="text" class="txtbox" id="contact_email" name="contact_email" value="" /></td>
          </tr>
          <tr>
            <td>Mobile :</td>
            <td> <input type="text" class="txtbox" name="mobile_num" id="mobile_num" value="" /> </td>
          </tr>
          <tr>
            <td>Phone :</td>
            <td> <input type="text" class="txtbox" name="phone_num" id="phone_num" value="" /> </td>
          </tr>
          <tr>
            <td>Website :</td>
            <td> <input type="text" class="txtbox" name="website" id="website" value="" /> </td>
          </tr>
        </table>

    </td>
  </tr>
  <tr>
    <td>
    	<h3 class="sub_header">Products:</h3>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_suppliertbl">
          <tr>
            <td width="180">Choose Product :</td>
            <td>
                <select class="combo-lg-multiple" name="product_type" id="product_type" multiple="multiple">
                    <option value="">Select Product</option>
                    <option value=""></option>
                </select>
            </td>
          </tr>
        </table>

    </td>
  </tr>
  <tr>
    <td>
    	<h3 class="sub_header">Other Details:</h3>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_suppliertbl">
          <tr>
            <td>PAN No :</td>
            <td> <input type="text" class="txtbox" name="pan_no" id="pan_no" value="" /> </td>
          </tr>
          <tr>
            <td width="180">TIN No :</td>
            <td> <input type="text" class="txtbox" name="tin_no" id="tin_no" value="" /> </td>
          </tr>
          <tr>
            <td width="180">CST No :</td>
            <td> <input type="text" class="txtbox" name="cst_no" id="cst_no" value="" /> </td>
          </tr>
          <tr>
            <td width="180">Sales Tax No :</td>
            <td> <input type="text" class="txtbox" name="sales_tax_no" id="sales_tax_no" value="" /> </td>
          </tr>
        </table>
    
    </td>
  </tr>
  <tr>
    <td>
    	<h3 class="sub_header">Bank Details:</h3>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_suppliertbl">
          <tr>
            <td>Bank Name :</td>
            <td> <input type="text" name="bank_name" id="bank_name" value="" class="txtbox" /> </td>
          </tr>
          <tr>
            <td width="180">Account No :</td>
            <td> <input type="text" class="txtbox" name="account_number" id="account_number" value=""  /> </td>
          </tr>
          <tr>
            <td>IFSC Code :</td>
            <td> <input type="text" class="txtbox" name="ifsc_code" id="ifsc_code" value="" /> </td>
          </tr>
          <tr>
            <td>Bank Address :</td>
            <td> <textarea class="txtarea" id="bank_address" name="bank_address"></textarea> </td>
          </tr>
          <tr>
            <td colspan="2"><input type="button" class="btn" name="add" id="add" onclick="addSupplier()" value="ADD" style="margin-right:15px;"/></td>
          </tr>
        </table>
    
    </td>
  </tr>
</table>

</div>


<script type="text/javascript">

function addSupplier(){
	
	var err = 0;
	var company_name,address,city,state,zipcode,country,contact_name,contact_email,mobile_num,phone_num,product_type,pancard_num,tin_no,sales_tax_no,cst_no,bank_name,account_number,ifsc_code,bank_address;

	if(	$('#company_name').val()=='' ){ err=1; $('#company_name').addClass('boxred'); } else{ $('#company_name').removeClass('boxred'); company_name = $('#company_name').val(); }
	if(	$('#address').val()=='' ){ err=1; $('#address').addClass('boxred'); } else { $('#address').removeClass('boxred'); address = $('#address').val(); }
	if(	$('#city').val()=='' ){ err=1; $('#city').addClass('boxred'); } else { $('#city').removeClass('boxred'); city = $('#city').val(); }
	if(	$('#state').val()=='' ){ err=1; $('#state').addClass('boxred'); } else { $('#state').removeClass('boxred'); state = $('#state').val(); }
	if(	$('#zipcode').val()=='' ){ err=1; $('#zipcode').addClass('boxred'); } else { $('#zipcode').removeClass('boxred'); zipcode = $('#zipcode').val(); }
	if(	$('#country').val()=='' ){ err=1; $('#country').addClass('boxred'); } else { $('#country').removeClass('boxred'); country = $('#country').val(); }
	
	if(	$('#contact_name').val()=='' ){ err=1; $('#contact_name').addClass('boxred'); } else { $('#contact_name').removeClass('boxred'); contact_name = $('#contact_name').val(); }
	if(	$('#contact_email').val()=='' ){ err=1; $('#contact_email').addClass('boxred'); } else { $('#contact_email').removeClass('boxred'); contact_email = $('#contact_email').val(); }
	if(	$('#mobile_num').val()=='' ){ err=1; $('#mobile_num').addClass('boxred'); } else { $('#mobile_num').removeClass('boxred'); mobile_num = $('#mobile_num').val(); }
	if(	$('#phone_num').val()=='' ){ err=1; $('#phone_num').addClass('boxred'); } else { $('#phone_num').removeClass('boxred'); phone_num = $('#phone_num').val(); }
	if(	$('#product_type').val()=='' ){ err=1; $('#product_type').addClass('boxred'); } else { $('#product_type').removeClass('boxred'); product_type = $('#product_type').val(); }
	
	if(	$('#pan_no').val()=='' ){ err=1; $('#pan_no').addClass('boxred'); } else { $('#pan_no').removeClass('boxred'); pan_no = $('#pan_no').val(); }
	if(	$('#tin_no').val()=='' ){ err=1; $('#tin_no').addClass('boxred'); } else { $('#tin_no').removeClass('boxred'); tin_no = $('#tin_no').val(); }
	if(	$('#sales_tax_no').val()=='' ){ err=1; $('#sales_tax_no').addClass('boxred'); } else { $('#sales_tax_no').removeClass('boxred'); sales_tax_no = $('#sales_tax_no').val(); }
	if(	$('#cst_no').val()=='' ){ err=1; $('#cst_no').addClass('boxred'); } else { $('#cst_no').removeClass('boxred'); cst_no = $('#cst_no').val(); }
	
	if(	$('#bank_name').val()=='' ){ err=1; $('#bank_name').addClass('boxred'); } else { $('#bank_name').removeClass('boxred'); bank_name = $('#bank_name').val(); }
	if(	$('#account_number').val()=='' ){ err=1; $('#account_number').addClass('boxred'); } else { $('#account_number').removeClass('boxred'); account_number = $('#account_number').val(); }
	if(	$('#ifsc_code').val()=='' ){ err=1; $('#ifsc_code').addClass('boxred'); } else { $('#ifsc_code').removeClass('boxred'); ifsc_code = $('#ifsc_code').val(); }
	if(	$('#bank_address').val()=='' ){ err=1; $('#bank_address').addClass('boxred'); } else { $('#bank_address').removeClass('boxred'); bank_address = $('#bank_address').val(); }


	if(err==0){ 
	
	 var paramData = {'act':'addSuppliers','company_name':company_name,'address':address,'city':city,'state':state,'zip':zip,'country':country,'contact_name':contact_name,'contact_email':contact_email,'mobile_num':mobile_num,'phone_num':phone_num,'product_type':product_type,'pan_no':pan_no,'tin_no':tin_no,'sales_tax_no':sales_tax_no,'cst_no':cst_no,'bank_name':bank_name,'account_number':account_number,'ifsc_code':ifsc_code,'bank_address':bank_address}
	 
		ajax({ 
		a:'suppliers',
		b:$.param(paramData),
		c:function(){},
		d:function(data){}
		});
	
	}
	
}

</script>



