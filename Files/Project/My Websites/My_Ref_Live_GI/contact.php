<?
function main(){
	
	if($_POST['act']=='sendcontactmail') {
		
		ob_clean();
		$param_fields = array('contact_name','contact_email','contact_message','phone_numb');
		$param= array();
		
		foreach($param_fields as $K=>$V) {
			$param[$V] = $_POST[$V];
		}
		
		Contact::sendContactEmailtoAdmin($param);
		exit();	
	}
	
?>


<div class="container_fluid profile_head">
    <div class="container">
            <h3>Contact Us</h3>
    </div>
</div>


<div class="container_fluid contact_us">
    <div class="container">
      
      <div class="contact_form" id="contact_frm" >
      <form name="contactform" id="contactform" method="post">
      	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="contactfrm_tbl">
          <tr>
            <td>
            	<h3>How can we assist you?</h3>
                <p>Please feel free to call us, send us an email, or even visit us and let us know how we can assist you.</p>
            </td>
          </tr>
          <tr>
            <td>
            	<label> Your Name (required): </label> <br/>
                <input type="text" name="contact_name" id="contact_name" class="ctxtbox" value="" />
            </td>
          </tr>
          <tr>
            <td>
            	<label> Your E-Mail (required): </label> <br/>
                <input type="text" name="contact_email" id="contact_email" class="ctxtbox" value="" />
            </td>
          </tr>
          <tr>
            <td>
            	<label> Phone Number (required): </label> <br/>
                <input type="text" name="phone_numb" id="phone_numb" class="ctxtbox" value="" onkeypress="return isNumberKey(event)"/>
            </td>
          </tr>
          <tr>
            <td>
            	<label> Your Message (required): </label> <br/>
                <textarea name="contact_message" id="contact_message" class="ctxtarea" value=""></textarea>
            </td>
          </tr>
          <tr>
            <td>
            	<input type="button" class="submit_btn" name="submit_form" value="Submit" onclick="validate_contactfrm()" id="hideon_submit1" />
                <img src="images/loading.gif" alt="LOADING" title="LOADING" class="submit_btn" id="showon_submit1" style=" background:#FFFFFF; cursor:pointer; display:none;"  />
                <input type="button" class="clear_btn" name="clear_form" value="Clear" onclick="reset_contactfrm()" />
            </td>
          </tr>
        </table>
      </form>
      </div>  
      
      <div class="contact_form" id="thankyou_contact" style="display:none;">
      	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="contactfrm_tbl">
          <tr>
            <td>
                <p style="margin-top:10px;">Thank you for contacting us. One of our representatives will be contacting you shortly.</p>
            </td>
          </tr>
        </table>
      </div>  
      
      <div class="contact_map">
        <div class="row" style="border:1px solid #c8c8c8;">
            <? include "map.php"; ?>
        </div>
      </div>
            
    </div>
</div>



<div class="container_fluid gi_contact">
    <div class="container">
        
        <div class="gi_market">
            <h4>Manufactured & Marketed By</h4>
            <p>GREEN INDIA ECO PRODUCTS <br/>
            394-A, Nanjundapuram Road, <br/>
            Ramanathapuram, <br/>
            Coimbatore - 641 045. </p>
        </div>
        
        <div class="gi_enquiry">
            <h4>Enquiry</h4>
            <p><img src="images/mail_icon.png" alt="Mail" align="absmiddle" /> sales@greenindiaecoproducts.com  <br/>
            <img src="images/phone_icon1.png" alt="Phone" align="absmiddle" /> 0422 - 436 8888 <br/>
            <img src="images/phone_icon2.png" alt="Mobile" align="absmiddle" /> +91 97870 97970, 95004 08880 </p>
        </div>
        
        <div class="gi_complaints">
            <h4>Complaints</h4>
            <p> <img src="images/mail_icon.png" alt="Mail" align="absmiddle" /> complaints@greenindiaecoproducts.com  <br/>
            <img src="images/phone_icon1.png" alt="Phone" align="absmiddle" /> 0422 - 4396 332 </p>
        </div>
        
    </div>
</div>



<script type="text/javascript">

function validate_contactfrm(){
	
	var err = 0;
	var contact_name,contact_email,contact_message,phone_numb;

	if(	$('#contact_name').val()=='' )
	{ 
		err=1; 
		$('#contact_name').addClass('boxred'); 
	}
	else
	{ 
		$('#contact_name').removeClass('boxred'); 
		contact_name = $('#contact_name').val(); 
	}
	
	if(	$('#phone_numb').val()=='' ){ err=1; $('#phone_numb').addClass('boxred'); } else { $('#phone_numb').removeClass('boxred'); phone_numb = $('#phone_numb').val(); }
	
	if(	$('#contact_message').val()=='' ){ err=1; $('#contact_message').addClass('boxred'); } else { $('#contact_message').removeClass('boxred'); contact_message = $('#contact_message').val(); }

	if($('#contact_email').val()=='')
	{
		err=1;
		$('#contact_email').addClass('boxred');
	}
	else
	{	 
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#contact_email').val()) == false) 
		{
			err=1;
			$('#contact_email').addClass('boxred');
		}
		else{
			var contact_email = $.trim($('#contact_email').removeClass('boxred').val());
		}
	}


	if(err==0){ 
	
		$('#hideon_submit1').hide();
		$('#showon_submit1').show();
		$('#showon_submit1 + input').hide();

		var paramData = {'act':'sendcontactmail','contact_name':contact_name,'contact_email':contact_email,'contact_message':contact_message,'phone_numb':phone_numb }
	 
		ajax({ 
		a:'contact',
		b:$.param(paramData),
		c:function(){},
		d:function(data){ 
			$('#contact_frm').hide();
			$('#thankyou_contact').show();
			//window.location.href = '<?=getSeoUrl(array('pn'=>'index.php'))?>';
		}
		});
	
	}
	
}


function reset_contactfrm(){
	
	$('#contact_name').val('');
	$('#contact_message').val('');
	$('#contact_email').val('');
	
}

</script>

<?
}
include "template.php";
?>