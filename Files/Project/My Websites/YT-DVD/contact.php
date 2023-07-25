<?
function main(){
	
if($_POST['act']=="getSchool"){
	ob_clean();
 	$schoolDtls = School::getSchoolById($_POST['school_id']);
 	echo $schoolEmail = $schoolDtls->email;
	exit();
}
if($_POST['act']=="saveContactFrm"){
		ob_clean();
		extract($_POST);
		$Subject = "[The Yellow Train] Thank you for Contacting Us";
		
		ob_start();
		$fileName= 'thankyou_mail_user.php';
		include "mail_template.php";
		$Message = ob_get_contents();
		
		ob_clean();
		$mail = new PHPMailer();
		$mail->IsHTML(true);
		$mail->From       = 'communications@yellowtrainschool.com';
		$mail->FromName   = "The Yellow Train";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		$mail->AddReplyTo('communications@yellowtrainschool.com','The Yellow Train');
		$mail->AddAddress($contact_email, $contact_email); 
		$mail->Send();
		
		$Subject = "[The Yellow Train] User Enquiry Detail";
		
		ob_start();
		$fileName= 'thankyou_mail_admin.php';
		include "mail_template.php";
		$Message = ob_get_contents();
		
		ob_clean();
		
		$mail = new PHPMailer();
		$mail->IsHTML(true);
		
		$mail->From       = 'communications@yellowtrainschool.com';
		$mail->FromName   = "The Yellow Train";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		$mail->AddReplyTo('communications@yellowtrainschool.com','The Yellow Train');
		$mail->AddAddress('communications@yellowtrainschool.com','communications@yellowtrainschool.com'); 
		//$mail->Send();
		exit();
}
?>


<div class="full_width balanced_top"></div>


<div class="full_width contact_cntr">
    <div class="content">
        
        <div class="contact_left">
        
        	<div class="full_width">
                <div class="contact_info">
                	<img src="images/phone_icon.png" alt="" style="float:left; margin-right:7px;" />
                    <p>
                        <span class="letterspac" style="float:left; color:#666666; margin-top:7px;">8220291777</span> 
                    </p>
                </div>
                <div class="contact_info">
                	<img src="images/mail_icon.png" alt="" style="float:left; margin-right:7px;" />
                    <p>
                        <span class="letterspac" style="float:left; color:#666666; margin-top:7px;">communications<br/>@yellowtrainschool.com</span> 
                    </p>
                </div>
            </div> 
            
        	<div class="full_width">
                
                <div class="contact_info">
                	<img src="images/fb_icon.png" alt="" style="float:left; margin-right:7px;" />
                    <p>
                        <a href="https://www.facebook.com/yellowtrainschool" target="_blank"><span style="float:left; color:#666666; margin-top:7px;">yellowtrainschool</span></a> 
                    </p>
                </div>
                
                <div class="contact_info">
                	<img src="images/hours_icon.png" alt="" style="float:left; margin-right:7px;" />
                    <p>
                        <span class="letterspac" style="float:left; color:#666666; line-height:24px;">Monday - Friday <br/> 9:00 AM - 3:00 PM</span> 
                    </p>
                </div>
            </div> 
            
        	<div class="full_width">
                
                <div class="contact_info">
                	<img src="images/location_icon.png" alt="" style="float:left; margin-right:7px;" />
                    <p>
                        <span class="letterspac3" style="float:left; color:#666666; line-height:24px;"><strong>Yellow Train Grade School,</strong><br/> 
                        <span class="letterspac2" style="float:left; ">Mudalipalayam <br/> Coimbatore</span></span> 
                    </p>
                </div>
                
                
                <div class="contact_info">
                	<img src="images/location_icon.png" alt="" style="float:left; margin-right:7px;" />
                    <p>
                        <span class="letterspac3" style="float:left; color:#666666; line-height:24px;"><strong>Yellow Train Garden Campus,</strong><br/> 
                        <span class="letterspac2" style="float:left;">Trichy Road <br/> Coimbatore </span> </span>
                    </p>
                </div>
                
            </div> 
            
        </div>
        
        <div class="contact_right">
        	<? include "map.php"; ?>
        </div>
        
    </div>
</div>

<form name="contactFrm" id="contactFrm" method="post" enctype="multipart/form-data">
<div class="full_width" style="background:url(images/bg1.jpg) no-repeat 100% 100%;">
    <div class="content">
    	<h4>Drop us an email a form below</h4>	
        <input type="hidden" id="schoolEmail" name="schoolEmail"/>
        <input type="hidden" id="school_id" name="school_id"/>
        <div class="contact_background">
            <div class="contact_txtleft">
             	<div class="contact_txtbox">
                	<img src="images/name1_icon.png" alt="" style="position:absolute; left:4px; top:4px;" />
                	<input type="text" onBlur="chkField(this)" onFocus="chkField(this)" style="width:100%;" class="txtbox_noborder"  id="contact_name" name="contact_name" value="Your name" />
                </div>
             	<div class="contact_txtbox">
                	<img src="images/mail1_icon.png" alt="" style="position:absolute; left:4px; top:4px;" />
                	<input type="text" onBlur="chkField(this)" onFocus="chkField(this)" style="width:100%;" class="txtbox_noborder" id="contact_email" name="contact_email" value="Your Email" />
                </div>
             	<div class="contact_txtbox">
                    <img src="images/contact_icon.png" alt="" style="position:absolute; left:4px; top:4px;" />
                    <input type="text" onBlur="chkField(this)" onFocus="chkField(this)" style="width:100%;" class="txtbox_noborder" id="contact_number" name="contact_number" value="Contact number"  onkeypress="return isNumberKey(event)"/>
                </div>
            </div>
            <div class="contact_txtright">
            	<div class="contact_txtbox">
                    <img src="images/messege_icon.png" alt="" style="position:absolute; left:4px; top:4px;" />
                	<textarea onBlur="chkField(this)" onFocus="chkField(this)" style="width:100%; height:150px;" class="txtbox_noborder" id="contact_message" name="contact_message">Message</textarea>
                </div>
            </div>
            <div class="full_width">
            	<div class="contact_submitbtn" onclick="submitContactFrm()" style="background:url(images/menu_bg.jpg) no-repeat;">Submit</div>
            </div>
        </div>
        
	</div>
</div>

</form>


<script type="text/javascript">

function chkField(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}


setSchoolValue('1');
function setSchoolValue(val){
 	
  	ajax({
		a:'contact',
		b:'act=getSchool&school_id='+val,		
		c:function(){},
		d:function(data){
 			//alert(data);
			$('#schoolEmail').val(data);
			$('#school_id').val(val);	 
		}			
	});
}

function submitContactFrm(){
	
	var err = 0;
	var school_id = $('#school_id').val();
	var contact_name = $('#contact_name').val();
	var contact_number = $('#contact_number').val();
	var contact_message = $('#contact_message').val();
	var contact_email = $('#contact_email').val();
	
	if(	$('#contact_name').val()=='' || $('#contact_name').val()=='Your name'){ err=1; $('#contact_name').parent().addClass('boxred'); } else{ $('#contact_name').parent().removeClass('boxred'); }
	if(	$('#contact_number').val()=='' || $('#contact_number').val()=='Contact number'){ err=1; $('#contact_number').parent().addClass('boxred'); } else { $('#contact_number').parent().removeClass('boxred'); }
	if(	$('#contact_message').val()=='' || $('#contact_message').val()=='Message'){ err=1; $('#contact_message').parent().addClass('boxred'); } else { $('#contact_message').parent().removeClass('boxred'); }
	
	if($('#contact_email').val()=='')
	{
	err=1;
	$('#contact_email').parent().addClass('boxred');
	}
	else
	{	 
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#contact_email').val()) == false) 
		{
			err=1;
			$('#contact_email').parent().addClass('boxred');
		}
		else{
			$('#contact_email').parent().removeClass('boxred');
		}
	}
 
	if(err==0){
		ajax({
		a:'contact',
		b:'act=saveContactFrm&school_id='+school_id+'&contact_name='+contact_name+'&contact_number='+contact_number+'&contact_message='+contact_message+'&contact_email='+contact_email,		
		c:function(){},
		d:function(data){
 			//alert(data);
			//alert("Mail has been send successfully..! ");	
			alert("Thank you for contacting Yellow Train. We'll get back to you as soon as we can.");	
			window.location.href = '<?=$curpage?>';
		}			
	});
		
	}
}

</script>




<?
}
include "template.php";
?>