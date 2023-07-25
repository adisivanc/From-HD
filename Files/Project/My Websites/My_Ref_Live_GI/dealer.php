<?
function main(){
	
	if($_POST['act']=='sendmail') {
		
		ob_clean();
		$param_fields = array('dealer_name','dealer_email','dealer_number','dealer_address','bussiness_name','dealer_website');
		$param= array();
		
		foreach($param_fields as $K=>$V) {
			$param[$V] = $_POST[$V];
		}
		
		Contact::sendEmailtoDealer($param);
		exit();	
	}
	
	
	
?>


<div class="container_fluid profile_head">
    <div class="container">
            <h3>Become a Dealer</h3>
    </div>
</div>


<div class="container_fluid dealers">
    <div class="container">
      
      <h3>Who are we looking for?</h3>
      <p>Green India Eco Products is looking for partners who share our passion for a legacy of unparalleled quality assurance and dedication. Our goal of expanding 
      our dealer network can only  happen with the right partners. If you feel you've got what it takes, we invite you to be part of the next chapter of success 
      stories in the making.</p>
      
      <div class="dealer_row" style="background:#ebebeb; " id="dealer_frm">
          
          <div class="dealer_form">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="contactfrm_tbl">
              <tr>
                <td>
                    <p>Tell us a little bit about yourself and we will contact you as soon as possible.</p>
                </td>
              </tr>
              <tr>
                <td>
                    <label> Your Name : </label> <br/>
                    <input type="text" name="dealer_name" id="dealer_name" class="ctxtbox" value="" />
                </td>
              </tr>
              <tr>
                <td>
                    <label> Your E-Mail : </label> <br/>
                    <input type="text" name="dealer_email" id="dealer_email" class="ctxtbox" value="" />
                </td>
              </tr>
              <tr>
                <td>
                    <label> Phone Number : </label> <br/>
                    <input type="text" name="dealer_number" id="dealer_number" class="ctxtbox" value="" onkeypress="return isNumberKey(event)" />
                </td>
              </tr>
              <tr>
                <td>
                    <label> Address   : </label> <br/>
                    <textarea name="dealer_address" id="dealer_address" class="ctxtarea" value=""></textarea>
                </td>
              </tr>
              <tr>
                <td>
                    <label> Business Name : </label> <br/>
                    <input type="text" name="bussiness_name" id="bussiness_name" class="ctxtbox" value="" />
                </td>
              </tr>
              <tr>
                <td>
                    <label> Website : </label> <br/>
                    <input type="text" name="dealer_website" id="dealer_website" class="ctxtbox" value="" />
                </td>
              </tr>
              <tr>
                <td>
                    <input type="button" class="submit_btn" name="submit_form" value="Submit" onclick="validate_dealerfrm()" id="hideon_submit2" />
                    <img src="images/loading.gif" alt="LOADING" title="LOADING" class="submit_btn" id="showon_submit2" style=" background:#ebebeb; cursor:pointer; display:none;"  />
                    <input type="button" class="clear_btn" name="clear_form" value="Clear" onclick="reset_dealerfrm()" />
                </td>
              </tr>
            </table>
          </div>  
          
          <div class="dealer_img">
            <div class="row">
                <img src="images/dealer_img1.png" alt="" />
            </div>
          </div>
      
      </div>
      
      
      <!-- Thank You -->
      
        <div class="row" id="thankyou_dealer" style="background:#ebebeb; display:none "> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="thanku_admtbl">
              <tr>
                <th> <h2>Many thanks for your dealership enquiry for Green India Eco Products.  </h2> </th>
              </tr>
              <tr>
                <td>
                    <p> A representative will be contacting you shortly about your request. </p>
                    <p> Have a great day! </p>
                    
                    <p class="dealer_contact">
                        <strong>CONTACT:</strong> <br/>
                        <strong>Phone:</strong> 97870 97970 <br/>
                        <strong>Mobile:</strong> 95004 08880 <br/>
                    </p>
                </td>
              </tr>
            </table>
        </div>

      <!-- Thank You -->
      
            
    </div>
</div>


<script type="text/javascript">

function validate_dealerfrm(){
	
	var err = 0;
	var dealer_name,dealer_email,dealer_number,dealer_address,bussiness_name,dealer_website;

	if(	$('#dealer_name').val()=='' ){ err=1; $('#dealer_name').addClass('boxred'); } else { $('#dealer_name').removeClass('boxred'); dealer_name = $('#dealer_name').val(); }
	if(	$('#dealer_number').val()=='' ){ err=1; $('#dealer_number').addClass('boxred'); } else { $('#dealer_number').removeClass('boxred'); dealer_number = $('#dealer_number').val(); }
	if(	$('#dealer_address').val()=='' ){ err=1; $('#dealer_address').addClass('boxred'); } else { $('#dealer_address').removeClass('boxred'); dealer_address = $('#dealer_address').val(); }
	
	if(	$('#bussiness_name').val()=='' ){ err=1; $('#bussiness_name').addClass('boxred'); } else { $('#bussiness_name').removeClass('boxred'); bussiness_name = $('#bussiness_name').val(); }
	if(	$('#dealer_website').val()=='' ){ err=1; $('#dealer_website').addClass('boxred'); } else { $('#dealer_website').removeClass('boxred'); dealer_website = $('#dealer_website').val(); }

	if($('#dealer_email').val()=='')
	{
		err=1;
		$('#dealer_email').addClass('boxred');
	}
	else
	{	 
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#dealer_email').val()) == false) 
		{
			err=1;
			$('#dealer_email').addClass('boxred');
		}
		else{
			var dealer_email = $.trim($('#dealer_email').removeClass('boxred').val());
		}
	}


	if(err==0){ 
	
	
		$('#hideon_submit2').hide();
		$('#showon_submit2').show();
		$('#showon_submit2 + input').hide();

	
	 var paramData = {'act':'sendmail','dealer_name':dealer_name,'dealer_email':dealer_email,'dealer_number':dealer_number,'dealer_address':dealer_address,'bussiness_name':bussiness_name,'dealer_website':dealer_website }
	 
		ajax({ 
		a:'dealer',
		b:$.param(paramData),
		c:function(){},
		d:function(data){ 
				$('#dealer_frm').hide();
				$('#thankyou_dealer').show();
		}
		});
	
	}
	
}


function reset_dealerfrm(){
	
	$('#dealer_name').val('');
	$('#dealer_email').val('');
	$('#dealer_number').val('');
	$('#dealer_address').val('');
	$('#bussiness_name').val('');
	$('#dealer_website').val('');
		
}

</script>

<?
}
include "template.php";
?>