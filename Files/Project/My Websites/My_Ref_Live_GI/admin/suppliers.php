<?
function main(){
	
	$token = md5(rand(1000,9999)); //you can use any encryption
	$_SESSION['token'] = $token; //store it as session variable
		
	if($_POST['act']=='addleads') {
		  ob_clean();
		  foreach($_POST as $K=>$V) { $$K=$V; if($K!='act') $params[$K]=$V; }
		  if($company_id>0) echo Leads::updateLead($params); else echo Leads::insertLead($params);
		  exit();	
	}
	
	if($_POST['act']=='getAllSuppliers') {
		ob_clean();
		include "include_suppliers.php";
		exit();
	}
	
	
	if($_POST['act']=='editSuppliersDtls') {
		ob_clean();
		include "update_suppliers_dtls.php";
		exit();
	}	
	
	if($_POST['act']=='mailDtls') {
		ob_clean();

		exit();
	}	
	
	if($_POST['act']=='buyProducts') {
		ob_clean();

		exit();
	}	


?>


<table width="100%" border="0" cellspacing="0" cellpadding="5" style=" height:auto">
<tr>
    <td colspan="2" bgcolor="#CCCCCC">
    	<div style=" padding:20px 0; text-indent:10px; font-size:20px; float:left;">Manage Suppliers</div>
    	<div class="add_supplierbtn" onClick="add_new_suppiler()">Add New Supplier</div>
    </td>
</tr>
<tr bgcolor="#FFFFFF">  
    <td  style="width:350px; background-color:#CCCCCC; height:auto;" valign="top" id="allSuppliers"> </td>
    <td style="text-align:left; padding-left:15px;" align="left"  valign="top" id="SuppliersDtls"></td>
</tr>
</table>




<div id="mailto_supplier" class="popupbox" style="padding:0; margin:0; display:none; font-family:Arial, Helvetica, sans-serif; ">

<table width="450" border="0" cellspacing="0" cellpadding="0" class="mailsuppliertbl">
  <tr>
    <th colspan="2"> Mail to Suppliers <span class="pull_right"> <img src="images/close1.png" alt="Close" title="Close" class="cursor" onclick="close_mailto_supplier()" /> </span> </th>
  </tr>
  <tr>
    <td>To :</td>
    <td>XYZ</td>
  </tr>
  <tr>
    <td>Subject :</td>
    <td> <input type="text" class="txtbox" name="mail_subject" id="mail_subject" value="" /> </td>
  </tr>
  <tr>
    <td>Message :</td>
    <td> <textarea class="txtarea" id="mail_message" name="mail_message"></textarea> </td>
  </tr>
  <tr>
    <td colspan="2" align="right"> <input type="button" class="btn" name="Send" value="Send" onclick="validate_mailpopup()" /> </td>
  </tr>
</table>

</div>


<div id="product_details_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family:Arial, Helvetica, sans-serif; ">

<table width="640" border="0" cellspacing="0" cellpadding="0" class="product_suppliertbl">
  <tr>
    <th> Product Billing <span class="pull_right"> <img src="images/close1.png" alt="Close" title="Close" class="cursor" onclick="close_product_details_popup()" /> </span> </th>
  </tr>
  <tr>
    <td>
    	<table width="420" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" width="50"><strong>P.O # :</strong></td>
            <td>10101</td>
          </tr>
          <tr>
            <td align="right"><strong>Date :</strong></td>
            <td><input type="text" class="txtbox-md" name="date" id="datepicker" value="" /></td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td> 
    	
        <strong>Products</strong>
        <table width="630" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px dashed #0c6b39;">
          <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th align="center">Amount</th>
          </tr>
          <tr>
            <td colspan="3">
            	<div id="ProductTypeTop"></div>
            </td>
          </tr>
          <tr>
            <td colspan="3" align="right" style="font-size:30px; color:#555555; cursor:pointer;" ><span onclick="addProduct()"><strong>+</strong></span></td>
          </tr>
        </table>

    </td>
  </tr>
  <tr>
    <td> 
    	
        <div style="clear:both;">
        <table width="630" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px dashed #0c6b39; ">
          <tr>
            <td align="right" style="width:320px;"><strong>Tax</strong></td>
            <td>
                <select class="combo-xs" name="product_tax" id="product_tax">
                    <option value="">1 %</option>
                </select> 
            </td>
            <td> <input type="text" class="txtbox-md" name="tax_amount" id="tax_amount" value="" /> </td>
          </tr>
        </table>
        </div>

    </td>
  </tr>
  <tr>
    <td> 
    	
        <table width="630" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px dashed #0c6b39; padding:2px 0;">
          <tr>
            <td align="right" style="width:400px;"><strong>Total</strong></td>
            <td> <input type="text" class="txtbox-md" name="total_amount" id="total_amount" value="" /> </td>
          </tr>
        </table>

    </td>
  </tr>
  <tr>
    <td> 
    	
        <table width="630" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px dashed #0c6b39;">
          <tr>
            <td><strong>Instruction</strong> <br/>
            <textarea class="txtarea" id="product_notes" name="product_notes" style="width:100%;"></textarea> </td>
          </tr>
        </table>

    </td>
  </tr>
  <tr>
    <td align="right"> 
        <input type="button" class="btn" name="Add" value="Add" onclick="validate_productpopup()" /> 
    	<input type="button" class="btn" name="Cancel" value="Cancel" />
    </td>
  </tr>
</table>

</div>


<script type="text/javascript">

function add_new_suppiler() {

	var err = 0;
	
	$("#suppliertab_cntr").hide();
	$(".supplier_dtlstbl").show();

}


function loadSuppliersDtls(lead_id) {

paramData = {'act':'editSuppliersDtls','lead_id':lead_id};

ajax({ 
	a:'suppliers',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		
		$('#SuppliersDtls').html(data);	
	}});
}


loadSuppliersDtls(0);


function load_suppliers() {
	
paramData = {'act':'getAllSuppliers'};
ajax({ 
	a:'suppliers',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		
		var dataArr = data.split(':::');
		
		$('#allSuppliers').html(dataArr[1]);	if(dataArr[0]>0) {
		
		var table = $('#leadListTbl').DataTable( {  
		 "oLanguage": {
				  "sSearch": "",
				  "sZeroRecords": "No Records Found",
					},
		 "displayLength": 10,
		 "bLengthChange": false, 
		 "pagingType": "full_numbers" 
		});
		$('.dataTables_filter input').attr("placeholder", "search supplier here");
		$('.dataTables_filter input').attr("class", "searchbox");
		var info = table.page.info();
		if(info.pages>1) 
			 $('#suppliersListTbl_paginate')[0].style.display = "block";
		else  	$('#suppliersListTbl_paginate')[0].style.display = "none";
		}} }
		);
		
}

load_suppliers();




<!--Mail Popup--->

function mailto_supplier(){
	
  	$("#mailto_supplier").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "puff", duration: 800 },
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_mailto_supplier(){  $("#mailto_supplier").dialog('close');  }



<!--Product Popup--->

function product_details_popup(){
	
  	$("#product_details_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "puff", duration: 800 },
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_product_details_popup(){  $("#product_details_popup").dialog('close');  }



$(function() {
$( "#datepicker" ).datepicker({
  showOn: "button",
  buttonImage: "images/calendar.gif",
  buttonImageOnly: true,
  buttonText: "Select date"
});
});


function validate_mailpopup()
{
	var err = 0;
	var mail_subject,mail_message;

	if(	$('#mail_subject').val()=='' ){ err=1; $('#mail_subject').addClass('boxred'); } else{ $('#mail_subject').removeClass('boxred'); mail_subject = $('#mail_subject').val(); }
	if(	$('#mail_message').val()=='' ){ err=1; $('#mail_message').addClass('boxred'); } else { $('#mail_message').removeClass('boxred'); mail_message = $('#mail_message').val(); }

	if(err==0){ 
	
	 var paramData = {'act':'mailDtls','mail_subject':mail_subject,'mail_message':mail_message}
	 
		ajax({ 
		a:'suppliers',
		b:$.param(paramData),
		c:function(){},
		d:function(data){}
		});

	}
}


function validate_productpopup()
{
	var err = 0;
	var datepicker,product_name,product_quantity,product_amount,product_tax,tax_amount,total_amount;

	if(	$('#datepicker').val()=='' ){ err=1; $('#datepicker').addClass('boxred'); } else{ $('#datepicker').removeClass('boxred'); datepicker = $('#datepicker').val(); }
	if(	$('#product_name').val()=='' ){ err=1; $('#product_name').addClass('boxred'); } else { $('#product_name').removeClass('boxred'); product_name = $('#product_name').val(); }
	if(	$('#product_quantity').val()=='' ){ err=1; $('#product_quantity').addClass('boxred'); } else { $('#product_quantity').removeClass('boxred'); product_quantity = $('#product_quantity').val(); }
	if(	$('#product_amount').val()=='' ){ err=1; $('#product_amount').addClass('boxred'); } else { $('#product_amount').removeClass('boxred'); product_amount = $('#product_amount').val(); }
	if(	$('#product_tax').val()=='' ){ err=1; $('#product_tax').addClass('boxred'); } else { $('#product_tax').removeClass('boxred'); product_tax = $('#product_tax').val(); }
	if(	$('#tax_amount').val()=='' ){ err=1; $('#tax_amount').addClass('boxred'); } else { $('#tax_amount').removeClass('boxred'); tax_amount = $('#tax_amount').val(); }
	if(	$('#total_amount').val()=='' ){ err=1; $('#total_amount').addClass('boxred'); } else { $('#total_amount').removeClass('boxred'); total_amount = $('#total_amount').val(); }

	if(err==0){ 
	
	
	 var paramData = {'act':'buyProducts','datepicker':datepicker,'product_name':product_name,'product_quantity':product_quantity,'product_amount':product_amount,'product_tax':product_tax,'tax_amount':tax_amount,'total_amount':total_amount}
	 
		ajax({ 
		a:'suppliers',
		b:$.param(paramData),
		c:function(){},
		d:function(data){}
		});
	
	}
}



function defaultLoader(){
	
	jQuery('#ProductTypeTop').empty().html('');
	var vhtm = new Array();
	var i = 0;
	addProduct();
}

	
function addProduct(a){
	if(a==undefined) a={};
	if(a.id==undefined) a.id='';
	if(a.product_name==undefined) a.product_name='';
	if(a.product_quantity==undefined) a.product_quantity='';
	if(a.product_amount==undefined) a.product_amount='';
	if(a.Value==undefined) a.Value='';
	
	var row = jQuery('div.ProductInnerTop').length;
	
	var vhtml = '';
	vhtml += '<div id="ProductType_id'+row+'" class="ProductInnerTop" style="margin-top:0px; text-align:left;">';
	vhtml += '	<div id="ProductType_id'+row+'" class="dimage" style="margin-bottom:5px;">';
	vhtml += '		<table width="630" border="0" cellspacing="0" cellpadding="0"><tr>';
	
	vhtml += '			<td><input type="text" class="txtbox" name="product_name'+row+'" id="product_name'+row+'" value="" /></td>';
	
	vhtml += '			<td><input type="text" class="txtbox-sm" name="product_quantity'+row+'" id="product_quantity'+row+'" value="" /></td>';
	
	vhtml +='			<td><input type="text" class="txtbox-md" name="product_amount'+row+'" id="product_amount'+row+'" value="" /></td></tr>';
	
	vhtml +='			<tr><td style="padding:2px 0;" colspan="3"><div class="cursor" style="padding:0px; margin:0px; height:10px; font-size:24px; float:right" id="ProductType_r" onclick="removeProductType('+row+', &quot;'+a.id+'&quot;);"><strong>-</strong></div></td>';
	
	vhtml += '		</tr></table>';
	vhtml += '	</div>';
	vhtml += '</div>';
	
	jQuery('#ProductTypeTop').append(vhtml);
	
}
	
function removeProductType(r, id){ 
	var i1; 
	if(r==undefined){ 
		var row = jQuery('div.ProductInnerTop').length-1;
		jQuery('#ProductType_id'+row).remove();
	}
	else {  
	
		var msg = confirm('Are you sure want to delete this product?');
		
		if(msg==true) {
			jQuery('#ProductType_id'+r).remove();
			if(jQuery('div.dimage').length==0){
				for(i1=0;i1<100;i1++){
					if(jQuery('ProductInnerTop').length>0)
						jQuery('#ProductType_id'+i1).remove();
					else
						i1 = 101;
				}
				addProduct();
			}
		}
		
	}
	if(jQuery('div.ProductInnerTop').length==0)
		addProduct();
}

jQuery(function(){

	jQuery('#ProductType_r').show();
	jQuery('#ProductType_a').show();
	defaultLoader();
	
});


</script>


<?
}
include "template.php";
?>
