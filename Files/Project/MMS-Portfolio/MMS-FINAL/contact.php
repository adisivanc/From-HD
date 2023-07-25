<?
function main(){
	
	if($_POST['act']=='submit_contact')
	{
		ob_clean();
		$resConatct = Contact::insertContact($_POST['contact_name'], $_POST['contact_email'], $_POST['contact_website'], $_POST['contact_message']);
		exit();	
	}
	
?>

<? include "page_header.php"; ?>
<? include "map.php"; ?>

<div class="contactus_cntr">
    <div class="contactus_inner">
    	<div class="contactus_head">CONTACT US</div>
        
        <div class="contactus_left">
            <div class="cntus_lft_inr">
               
                <div class="cntus_subhead">HOW CAN WE ASSIST YOU?</div>
                <p>Please feel free to call us, send us an email, or even visit us and let us know how we can assist you.</p>
				<p>If you would like us to help you with any project which you have in mind, please provide some details with your
                 requirements and we will be get back to you without delay.</p>
				<div class="cntus_subhead">ADDRESS</div>
                <p class="contact_addrs">
                    No 3, Sri Ram Colony,<br/>
                    Nanjundapuram Road,<br/>
                    Ramanathapuram,<br/>
                    Coimbatore - 641045<br/>
                    Tamilnadu, India.<br/>
                </p>
                <div class="cntus_subhead">EMAIL</div>
                <p class="mail_icon2 contact_addrs"><a href="mailto:info@mastermindsolutionsonline.com">
					<img src="images/mail_icon2.png" style="float:left;"/><span style="line-height:19px;">info@mastermindsolutionsonline.com</span></a>
				</p>
                <div class="cntus_subhead">SOCIAL MEDIA</div>
                <p class="contact_addrs">
                    <a href="https://www.facebook.com/" target="_blank"><img src="images/fb_icon.png" style="float:left; margin-right:3px;" alt="Facebook"/></a>
                    <a href="http://www.skype.com/en/" target="_blank"><img src="images/skype_icon.png" style="float:left; margin-right:3px;" alt="Skype"/></a>
                    <a href="https://twitter.com/" target="_blank"><img src="images/twi_icon.png" style="float:left; margin-right:3px;" alt="Twitter"/></a>
                    <a href="https://www.pinterest.com/" target="_blank"><img src="images/pin_icon.png" style="float:left; margin-right:3px;" alt="Pinterest"/></a>
                </p>
            </div>
        </div>
        
        <div class="contactus_right">
            <div class="cntus_rght_inr">
            	<form id="contactfrm" name="contactfrm" method="post">
                    <div>Your Name (required):<br/>
                    <input type="text" class="cntus_txtbox cntus_txtname" id="contact_name" name="contact_name" /></div>
                    
                    <div>Your Email (required):<br/>
                    <input type="text" class="cntus_txtbox cntus_txtmail" id="contact_email" name="contact_email" /></div>
                    
                    <div>Your Website:<br/>
                    <input type="text" class="cntus_txtbox cntus_txtweb" id="contact_website" name="contact_website" /></div>
                    
                    <div>Your Message (required):<br/>
                    <textarea class="cntus_txtarea cntus_txtmsg" id="contact_message" name="contact_message"></textarea></div>
                    
                    <div><img src="images/send_btn_mo.png" class="cntus_sendbtn" style="cursor:pointer;" onclick="submit_contactfrm()" alt="Send"/></div>	
                </form>
            </div>
        </div>
        	
    </div>
</div>


<script type="text/javascript">

function submit_contactfrm(){
	
	var err = 0;

	if(	$('#contact_name').val()=='' || $('#contact_name').val()=='Enter your name'){ err=1; $('#contact_name').addClass('boxred'); } else { $('#contact_name').removeClass('boxred'); }
	
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
			$('#contact_email').removeClass('boxred');
		}
	}

	//if(	$('#contact_website').val()==''){ err=1; $('#contact_website').addClass('boxred'); } else { $('#contact_website').removeClass('boxred'); }
	if(	$('#contact_message').val()==''){ err=1; $('#contact_message').addClass('boxred'); } else { $('#contact_message').removeClass('boxred'); }
	
	if(err==0)
	{
		ajax({
			a:'contact',
			b:'act=submit_contact&contact_name='+$('#contact_name').val()+'&contact_email='+$('#contact_email').val()+'&contact_website='+$('#contact_website').val()+'&contact_message='+$('#contact_message').val(),
			c:function(){},
			d:function(data)
			{
				$('#contactfrm')[0].reset();

				$("#contact_thkpopup").dialog({
					autoOpen: true,
					resizable: false,
					height: 'auto',
					width: 'auto',
					modal: true	,
					show: { effect: "puff", duration: 300 }, 
					draggable: true
				});
				$(".ui-widget-header").css({"display":"none"});
			}
		});
	}

}

</script>


<?
}
include "template.php";
?>
