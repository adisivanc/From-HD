<?
function main(){
	
	
	if($_POST['act']=='enquirymail') {
		ob_clean();
		$param_fields = array('name','enquiry_for','email','phone','message');
		$param= array();
		
		foreach($param_fields as $K=>$V) {
			$param[$V] = $_POST[$V];
		}
			//print_r($param);
		Contact::sendEnquiryEmailtoAdmin($param);
		exit();	
	}
	
	
?>


<div class="container_fluid">
	<? include "slider.php"; ?>
</div>

 
<div class="container_fluid advantage_container">
    <div class="container">
		<div class="row" align="center"> <img src="images/quality_img.png" alt="Efficiency" /></div>
        <h1>We pay high attention towards the quality of our product and services</h1>
        <p>Our product is developed using high-grade raw material and advanced technologies following international standards. Moreover, a team of quality inspectors is 
        appointed by us, which keep a strict vigil on all the stages of production and service execution process so as to eliminate the chances of occurring any kind 
        of defects in it. These professionals check the quality of products making use of advanced machines and testing instruments at our advanced quality testing unit. </p>
        
        <p>To maintain our present niche in the industry, our quality analysts check our range on following parameters: </p>
        <ul>
            <li>Quality of raw material	</li>
            <li>Tolerance</li>			
            <li>Smoothness</li>
            <li>Whiteness</li>				
            <li>Coverage</li>		
            <li>Reliability</li>
            <li>Finishing</li>
        </ul>
    </div>
</div>


<div class="container_fluid parallelx_container">
    <div class="container_fluid"><!--Slide Outer-->
        
        <div id="innerslide1">
            <div id="innerslide2">
            <div class="parallax_inner">
                <div class="hsContainer">
                    
                	<div class="container_fluid">
                        <div class="hexgon_container">
                            <div class="hexgon1"> <img src="images/hex_01.png" alt="" /> </div>
                            <div class="hexgon2"> 
                            	<img src="images/hex_02.png" alt="" /> 
                            	<p> <img src="images/quote_icon.png" alt="" /> <br/> <br/> Water-resistance, <br/> Compatible with all  <br/> types of paints <br/> and Smooth <br/> <span style="margin-top:5px; float:left;">- <strong>Gopal, Painter</strong></span> </p> 
                            </div>
                            <div class="hexgon3"> 
                            	<img src="images/hex_03.png" alt="" /> 
                                <h4>Adding <br/> Value to <br/> your <br/> Building</h4>
                            </div>
                            <div class="hexgon4"> 
                            	<img src="images/hex_02.png" alt="" />
                                <p> <img src="images/quote_icon.png" alt="" /> <br/> <br/> Smooth finish, <br/> Excellent bonding <br/> and Improves finish <br/> paint performance <br/> <span style="margin:5px 0 0 0; float:left; clear:both;"> - <strong>No.1 Hardware</strong></span> </p>
                            </div>
                            <div class="hexgon5"> 
                            	<img src="images/hex_03.png" alt="" />
                                <h4>perfect <br/> wall <br/> nutritionist</h4>
                            </div>
                            <div class="hexgon6"> <img src="images/hex_07.png" alt="" /> </div>
                            <div class="hexgon7"> <img src="images/hex_04.png" alt="" /> </div>
                            <div class="hexgon8"> <img src="images/hex_07.png" alt="" /> </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            </div>
        </div>
        
	</div><!--Slide Outer-->
</div>


<div class="container_fluid enquiry_container">
    <div class="container">
    	<h2>Looking for Wall Putty, Tile Adhesive, White Cement, <br/> or Raw material for Wall Putty?</h2>
        
        <div class="enquiry_form">
            <div class="enquiry_inner" id="enquiry_frm_hidden">
                <div class="enquiry_detail">
                    <label>Enquiry for </label>
                    <select name="enquiry_for" id="enquiry_for" class="combo-full">
                        <option value="wall_putty">Wall Putty</option>
                        <option value="g_lose">G-Lose</option>
                        <option value="white_cement">White Cement</option>
                    </select>
                </div>
                <div class="enquiry_detail">
                    <label>Name </label>
                    <input type="text" name="name" id="name" class="txtbox-full" value="" />
                </div>
                <div class="enquiry_detail">
                    <label>Email </label>
                    <input type="text" name="email" id="email" class="txtbox-full" value="" />
                </div>
                <div class="enquiry_detail">
                    <label>Phone </label>
                    <input type="text" name="phone" id="phone" class="txtbox-full" value="" onkeypress="return isNumberKey(event)" />
                </div>
                <div class="enquiry_detail">
                    <label>Message </label>
                    <textarea name="message" id="message" class="txtarea-full" value=""></textarea>
                </div>
                <div class="enquiry_detail">
                    <input type="button" class="btn-md bg-pink" name="send_enquiry" value="Send" onclick="enquiryProducts()" id="hideon_submit3" />
                    <img src="images/loading.gif" alt="LOADING" title="LOADING" class="btn-md bg-pink" id="showon_submit3" style=" background:#FFFFFF; cursor:pointer; display:none;"  />
                </div>
            </div>
            
            <!-- Thank You -->
            <div class="enquiry_inner" id="enquiry_thanku" style="display:none;">
                <div class="row" id="thankyou_enquiry" style="background:#ebebeb; margin-top:0; padding-top:0; "> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="thanku_admtbl">
                      <tr>
                        <th> <h2>Many thanks for your enquiry about our products. </h2> </th>
                      </tr>
                      <tr>
                        <td>
                            <p>A representative will be contacting you shortly about your request.</p>
                            <p>Have a great day!</p>
                        </td>
                      </tr>
                    </table>
                </div>
            </div>
            <!-- Thank You -->
            
        </div>
        
    </div>
</div>




<script type="text/javascript">

function enquiryProducts(){
	
	var err = 0;
	var name,enquiry_for,email,phone,message;

	if(	$('#name').val()=='' ){ err=1; $('#name').addClass('boxred'); } else{ $('#name').removeClass('boxred'); name = $('#name').val(); }
	if(	$('#enquiry_for').val()=='' ){ err=1; $('#enquiry_for').addClass('boxred'); } else { $('#enquiry_for').removeClass('boxred'); enquiry_for = $('#enquiry_for').val(); }
	if(	$('#phone').val()=='' ){ err=1; $('#phone').addClass('boxred'); } else{ $('#phone').removeClass('boxred'); phone = $('#phone').val(); }
	if(	$('#message').val()=='' ){ err=1; $('#message').addClass('boxred'); } else { $('#message').removeClass('boxred'); message = $('#message').val(); }

	if($('#email').val()=='')
	{
		err=1;
		$('#email').addClass('boxred');
	}
	else
	{	 
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#email').val()) == false) 
		{
			err=1;
			$('#email').addClass('boxred');
		}
		else{
			var email = $.trim($('#email').removeClass('boxred').val());
		}
	}

	if(err==0){ 
	
		$('#hideon_submit3').hide();
		$('#showon_submit3').show();
	
	 var paramData = {'act':'enquirymail','name':name,'enquiry_for':enquiry_for,'email':email,'phone':phone,'message':message }
//	alert('am here');
		ajax({ 
		a:'index',
		b:$.param(paramData),
		c:function(){},
		d:function(data){
			//alert(data);
			$('#enquiry_frm_hidden').hide();
			$('#enquiry_thanku').show();
			}
		});
	
	}
	
}


</script>


<?
}
include "template.php";
?>