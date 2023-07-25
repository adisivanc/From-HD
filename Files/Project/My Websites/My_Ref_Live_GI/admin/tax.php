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
	
	if($_POST['act']=='getAllTaxes') {
		ob_clean();
		include "include_tax.php";
		exit();
	}
	
	
	if($_POST['act']=='editTaxesDtls') {
		ob_clean();
		include "update_tax_dtls.php";
		exit();
	}	
	
	if($_POST['act']=='mailDtls') {
		ob_clean();

		exit();
	}	

?>


<table width="100%" border="0" cellspacing="0" cellpadding="5" style=" height:auto">
<tr>
    <td colspan="2" bgcolor="#CCCCCC">
    	<div style=" padding:20px 0; text-indent:10px; font-size:20px; float:left;">Manage Tax</div>
    	<div class="add_supplierbtn" onClick="add_new_tax()">Add New Tax</div>
    </td>
</tr>
<tr bgcolor="#FFFFFF">  
    <td  style="width:350px; background-color:#CCCCCC; height:auto;" valign="top" id="allTaxes"> </td>
    <td style="text-align:left; padding-left:15px;" align="left"  valign="top" id="TaxesDtls"></td>
</tr>
</table>




<div id="mailto_tax" class="popupbox" style="padding:0; margin:0; display:none; font-family:Arial, Helvetica, sans-serif; ">

<table width="450" border="0" cellspacing="0" cellpadding="0" class="mailsuppliertbl">
  <tr>
    <th colspan="2"> Mail to Tax <span class="pull_right"> <img src="images/close1.png" alt="Close" title="Close" class="cursor" onclick="close_mailto_tax()" /> </span> </th>
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

function add_new_tax() {

	var err = 0;
	
	$("#suppliertab_cntr").hide();
	$(".addTaxtbl").show();

}


function loadTaxesDtls(lead_id) {

paramData = {'act':'editTaxesDtls','lead_id':lead_id};

ajax({ 
	a:'tax',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		
		$('#TaxesDtls').html(data);	
	}});
}


loadTaxesDtls(0);


function load_taxes() {
	
paramData = {'act':'getAllTaxes'};
ajax({ 
	a:'tax',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		
		var dataArr = data.split(':::');
		
		$('#allTaxes').html(dataArr[1]);	if(dataArr[0]>0) {
		
		var table = $('#leadListTbl').DataTable( {  
		 "oLanguage": {
				  "sSearch": "",
				  "sZeroRecords": "No Records Found",
					},
		 "displayLength": 10,
		 "bLengthChange": false, 
		 "pagingType": "full_numbers" 
		});
		$('.dataTables_filter input').attr("placeholder", "search tax here");
		$('.dataTables_filter input').attr("class", "searchbox");
		var info = table.page.info();
		if(info.pages>1) 
			 $('#taxListTbl_paginate')[0].style.display = "block";
		else  	$('#taxListTbl_paginate')[0].style.display = "none";
		}} }
		);
		
}

load_taxes();




<!--Mail Popup--->

function mailto_tax(){
	
  	$("#mailto_tax").dialog({
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

function close_mailto_tax(){  $("#mailto_tax").dialog('close');  }




function validate_mailpopup()
{
	var err = 0;
	var mail_subject,mail_message;

	if(	$('#mail_subject').val()=='' ){ err=1; $('#mail_subject').addClass('boxred'); } else{ $('#mail_subject').removeClass('boxred'); mail_subject = $('#mail_subject').val(); }
	if(	$('#mail_message').val()=='' ){ err=1; $('#mail_message').addClass('boxred'); } else { $('#mail_message').removeClass('boxred'); mail_message = $('#mail_message').val(); }

	if(err==0){ 
	
	 var paramData = {'act':'mailDtls','mail_subject':mail_subject,'mail_message':mail_message}
	 
		ajax({ 
		a:'tax',
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
