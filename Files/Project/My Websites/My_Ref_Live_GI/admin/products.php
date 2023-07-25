<?
function main(){
	

?>


<table width="100%" border="0" cellspacing="0" cellpadding="5" style=" height:auto">
<tr>
    <td colspan="2" bgcolor="#CCCCCC">
    	<div style=" padding:20px 0; text-indent:10px; font-size:20px; float:left;">Manage Products</div>
    	<div class="add_supplierbtn" onClick="add_new_product()">Add New Products</div>
    </td>
</tr>
<tr bgcolor="#FFFFFF">  
    <td  style="width:350px; background-color:#CCCCCC; height:auto;" valign="top" id="allProducts"> </td>
    <td style="text-align:left; padding-left:15px;" align="left"  valign="top" id="ProductsDtls"></td>
</tr>
</table>


<div id="mailto_products" class="popupbox" style="padding:0; margin:0; display:none; font-family:Arial, Helvetica, sans-serif; ">

<table width="450" border="0" cellspacing="0" cellpadding="0" class="mailsuppliertbl">
  <tr>
    <th colspan="2"> Mail to Products <span class="pull_right"> <img src="images/close1.png" alt="Close" title="Close" class="cursor" onclick="close_mailto_products()" /> </span> </th>
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





<script type="text/javascript">

function add_new_product() {

	var err = 0;
	
	$("#suppliertab_cntr").hide();
	$(".addProducttbl").show();

}


function loadProductsDtls(lead_id) {

paramData = {'act':'editProductsDtls','lead_id':lead_id};

ajax({ 
	a:'products',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		
		$('#ProductsDtls').html(data);	
	}});
}


loadProductsDtls(0);


function load_taxes() {
	
paramData = {'act':'getAllProducts'};
ajax({ 
	a:'products',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		
		var dataArr = data.split(':::');
		
		$('#allProducts').html(dataArr[1]);	if(dataArr[0]>0) {
		
		var table = $('#leadListTbl').DataTable( {  
		 "oLanguage": {
				  "sSearch": "",
				  "sZeroRecords": "No Records Found",
					},
		 "displayLength": 10,
		 "bLengthChange": false, 
		 "pagingType": "full_numbers" 
		});
		$('.dataTables_filter input').attr("placeholder", "search products here");
		$('.dataTables_filter input').attr("class", "searchbox");
		var info = table.page.info();
		if(info.pages>1) 
			 $('#productsListTbl_paginate')[0].style.display = "block";
		else  	$('#productsListTbl_paginate')[0].style.display = "none";
		}} }
		);
		
}

load_taxes();




<!--Mail Popup--->

function mailto_products(){
	
  	$("#mailto_products").dialog({
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

function close_mailto_products(){  $("#mailto_products").dialog('close');  }




function validate_mailpopup()
{
	var err = 0;
	var mail_subject,mail_message;

	if(	$('#mail_subject').val()=='' ){ err=1; $('#mail_subject').addClass('boxred'); } else{ $('#mail_subject').removeClass('boxred'); mail_subject = $('#mail_subject').val(); }
	if(	$('#mail_message').val()=='' ){ err=1; $('#mail_message').addClass('boxred'); } else { $('#mail_message').removeClass('boxred'); mail_message = $('#mail_message').val(); }

	if(err==0){ 
	
	 var paramData = {'act':'mailDtls','mail_subject':mail_subject,'mail_message':mail_message}
	 
		ajax({ 
		a:'products',
		b:$.param(paramData),
		c:function(){},
		d:function(data){}
		});

	}
}


</script>


<?
}
include "template.php";
?>
