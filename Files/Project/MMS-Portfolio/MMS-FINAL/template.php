<?
	ob_start();
	session_start();
	include 'includes.php';
	$PageUrlArr=explode('/',$_SERVER['SCRIPT_NAME']);
	$curpage=$PageUrlArr[2];
	
	if($_POST['act']=='submit_footer_contact')
	{
		ob_clean();
		$resFooterConatct = Contact::insertContact($_POST['footer_contact_name'], $_POST['footer_contact_email'], '', $_POST['footer_contact_message']);
		exit();	
	}
	
	
	if($_POST['act']=='submit_subscribe_newsletter'){
		
		ob_clean(); 

		if(strtolower($_SESSION['random_number'])!=strtolower($_POST['security_code']))
		{
			echo 'Invalid Capcha';
			
		}else{

			$resFooterSubscribe = SubscribeNewsletter::insertSubscribeNewsletter($_POST['name'], $_POST['email_address']);
			$resSubscribeStatus = SubscribeNewsletter::getSubscriberNewsletterById($resFooterSubscribe);
			
			echo $resSubscribeStatus->status;
			if($resSubscribeStatus->status!='U'){
			
				$Subject = "[MASTERMIND SOLUTIONS] Thank you for Subscribing Newsletter";
			
				ob_start();
				include 'newsletter_thankyou.php';	
				$Message = ob_get_contents();
				ob_clean();
				
				$mail = new PHPMailer();
				$mail->IsHTML(true);
				$mail->From       = "info@mastermindsolutionsonline.com";
				$mail->FromName   = "MASTERMIND SOLUTIONS";
				$mail->Subject    = $Subject;
				$mail->MsgHTML($Message);
				$mail->AddReplyTo('info@mastermindsolutionsonline.com','MASTERMIND SOLUTIONS');
				$mail->AddAddress('logesh262@gmail.com', 'logesh262@gmail.com');
				//$mail->AddAddress($email_address, $email_address); 
				echo $Message;
				echo $_POST['email_address'];
				$mail->Send();
			}
		}
		exit();	
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MASTERMIND SOLUTIONS</title>

<link type="text/css" rel="stylesheet" href="css/responsivemobilemenu.css" />
<link type="text/css" rel="stylesheet" href="css/style.css" />
<link type="text/css" rel="stylesheet" href="css/jquery-ui-1.8.11.custom.css" />
<link type="text/css" rel="stylesheet" href="css/responsive.css" />
<link type="text/css" rel="stylesheet" href="css/captcha.css" />

<link rel="icon" href="images/mms.png" type="image/x-icon"/>

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>
<script type="text/javascript" src="js/responsivemobilemenu.js"></script>


<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>

<script>

$(document).ready(function() { 
	
	 // refresh captcha
	 $('img#refresh').click(function() {  
			change_captcha();
	 });

});

function change_captcha()
{
	document.getElementById('captcha').src="get_captcha.php?rnd=" + Math.random();
}
 
</script>

<style>
.boxred { border:1px solid #ff0000; }
</style>
</head>

<body onLoad="MM_preloadImages('images/clear_btn_mo.png','images/send_btn_mo.png')">

<div id="header">
<div class="content">
	
    <div id="header_contact">
    	<div id="header_mail"><a href="mailto:info@mastermindsolutionsonline.com">info@mastermindsolutionsonline.com</a></div>
		<div id="social_icons">
        	<ul>
            	<li><a href="https://www.facebook.com/"><img src="images/fb_icon.png" border="0" alt="Facebook" title="Facebook" /></a></li>
            	<li><a href="https://twitter.com/"><img src="images/twi_icon.png" border="0" alt="Twitter" title="Twitter" /></a></li>
            	<li><a href="http://www.skype.com/en/"><img src="images/skype_icon.png" border="0" alt="Skype" title="Skype" /></a></li>
            	<li><a href="https://www.pinterest.com/"><img src="images/pin_icon.png" border="0" alt="pinterest" title="Pinterest" /></a></li>
            </ul>
        </div>
    </div>
    
    <div id="mmslogo"><a href='<?=getSeoUrl(array('pn'=>'index.php'))?>'><img src="images/mms_logo.png" border="0" alt="MASTERMIND SOLUTIONS" /></a></div>
          
    <div id="menu_container">
        <div class="rmm">
            <ul>
                <li><a href='<?=getSeoUrl(array('pn'=>'index.php'))?>' class="<?=($curpage=='index.php')?'active':''?>">HOME</a></li>
                <li><a href='<?=getSeoUrl(array('pn'=>'about.php'))?>' class="<?=($curpage=='about.php')?'active':''?>">ABOUT US</a></li>
                <li><a href='<?=getSeoUrl(array('pn'=>'services.php'))?>' class="<?=($curpage=='services.php' || $curpage=='service_detail.php')?'active':''?>">SERVICES</a></li>
                <li><a href='<?=getSeoUrl(array('pn'=>'portfolio.php'))?>' class="<?=($curpage=='portfolio.php')?'active':''?>">PORTFOLIO</a></li>
                <li><a href='#'>TECHNOLOGY</a></li>
                <li><a href='<?=getSeoUrl(array('pn'=>'methodology.php'))?>' class="<?=($curpage=='methodology.php')?'active':''?>">METHODOLOGY</a></li>
                <li><a href='<?=getSeoUrl(array('pn'=>'contact.php'))?>' class="<?=($curpage=='contact.php')?'active':''?>">CONTACT US</a></li> 
            </ul>
        </div>
	</div>
    
</div>

<div id="header_shadow"></div>
</div>


<!--Content-->
<div style="width:100%; float:left;">
<? main(); ?>
</div>
<!--Content-->



<!--  Footer  -->

<div class="footer_container">
<div class="content">

    <? if($curpage!='about.php'){ ?>
	<div class="footer_row1">
    	<div class="footer_inner">
    		
            <div><img src="images/box_top.png"/></div>
            <div class="footer_head"><a href="<?=getSeoUrl(array('pn'=>'about.php'))?>" target="_blank" style="color:#039bac;">ABOUT US</a></div>
            <div><img src="images/box_middle.png"/></div>
            <div class="footer_content">
            <p>
                The moment we started in 2004, we knew we were onto something special. With an experienced staff, we wanted to deliver more than results for our affiliates.
                We wanted to deliver fearless personal service. And with that commitment, we've gone on to create a company that takes pride in its roll-your-sleeves-up approach.
                We don't subscribe to titles but we do believe in collaboration and the power it can yield. 
            </p>
            <p style="float:right; padding:12px 0 2px 0;">
            <a href="<?=getSeoUrl(array('pn'=>'about.php'))?>" target="_blank" style="color:#039bac;"> Read more <img src="images/arrow_blue.png" align="absmiddle"/></a></p>
            </div>
            <div><img src="images/box_bottom.png"/></div>
            	
    	</div>
    </div>
    <? } ?>
    
    <? if($curpage=='about.php' || $curpage=='career.php' || $curpage=='career_form.php' || $curpage=='contact.php'){ ?>
	<div class="footer_row1">
    	<div class="footer_inner">
    		
            <div><img src="images/box_top.png"/></div>
            <div class="footer_head"><a href="<?=getSeoUrl(array('pn'=>'services.php'))?>" target="_blank" style="color:#039bac;">SERVICES</a></div>
            <div><img src="images/box_middle.png"/></div>
            <div class="footer_content">
            <p>
                WEB DESIGN &amp; BUILD<br/>
                INTERNET MARKETING<br/> 
                MOBILE &amp; APP LAYOUTS<br/>
                VISUAL BRANDING
            </p>
            <p style="float:right; padding:122px 0 2px 0;">
            <a href="<?=getSeoUrl(array('pn'=>'services.php'))?>" target="_blank" style="color:#039bac;"> Read more <img src="images/arrow_blue.png" align="absmiddle"/></a></p>
            </div>
            <div><img src="images/box_bottom.png"/></div>
            	
    	</div>
    </div>
    <? } ?>
    
    <div class="footer_row1">
    	<div class="footer_inner">
    		
            <div><img src="images/box_top.png"/></div>
            <div class="footer_head"><a href="<?=getSeoUrl(array('pn'=>'contact.php'))?>" target="_blank" style="color:#039bac;">CONTACT INFO</a></div>
            <div><img src="images/box_middle.png"/></div>
            <div class="footer_content">
            <p style="text-align:center;">
                No 3, Sri Ram Colony,<br/>
                Nanjundapuram Road,<br/>
                Ramanathapuram,<br/>
                Coimbatore - 641045<br/>
                Tamilnadu, India<br/><br/>
                <a href="mailto:info@mastermindsolutionsonline.com" target="_blank" style="color:#636363;">info@mastermindsolutionsonline.com</a><br/>
                <div style="margin-top:20px; text-align:center;">
                    <a href="https://www.facebook.com/" target="_blank"><img src="images/fb_icon_gray.png" border="0" alt="Facebook"/></a>
                    <a href="https://twitter.com/" target="_blank"><img src="images/twi_icon_gray.png" border="0" alt="Twitter" /></a>
                    <a href="http://www.skype.com/en/" target="_blank"><img src="images/skype_icon_gray.png" border="0" alt="Skype"/></a>
                    <a href="https://www.pinterest.com/" target="_blank"><img src="images/pin_icon_gray.png" border="0" alt="pinterest" /></a>
                </div>
            </p>
            </div>
            <div><img src="images/box_bottom.png"/></div>
            	
    	</div>
    </div>
    
    <? if($curpage!='career.php' || $curpage!='career_form.php'){ ?>
    <div class="footer_row1">
    	<div class="footer_inner">
    		
            <div><img src="images/box_top.png"/></div>
            <div class="footer_head"><a href="<?=getSeoUrl(array('pn'=>'career.php'))?>">CAREERS @ MMS</a></div>
            <div><img src="images/box_middle.png"/></div>
            <div class="footer_content">
            <p>
                We are currently hiring.
                <ul>
                    <li><a href="<?=getSeoUrl(array('pn'=>'career.php'))?>">PHP Developer</a></li>
                    <li><a href="<?=getSeoUrl(array('pn'=>'career.php'))?>">Android/iPhone Developer</a></li>
                    <li><a href="<?=getSeoUrl(array('pn'=>'career.php'))?>">SEO Optimizer</a></li>
                    <li><a href="<?=getSeoUrl(array('pn'=>'career.php'))?>">Tester</a></li>
                </ul>
            </p>
            <p style="float:right; padding:90px 0 2px 0; ">
            <a href="<?=getSeoUrl(array('pn'=>'career.php'))?>" target="_blank" style="color:#039bac;"> Read More <img src="images/arrow_blue.png" align="absmiddle"/></a></p>
            </div>
            <div><img src="images/box_bottom.png"/></div>
            	
    	</div>
    </div>
    <? } ?>
    
    <? if($curpage!='contact.php'){ ?>
    <div class="footer_row1">
    	<div class="footer_inner">
    		
            <div><img src="images/box_top.png"/></div>
            <div class="footer_head">SHOOT A MESSAGE</div>
            <div><img src="images/box_middle.png"/></div>
            <div class="footer_content">
                <form id="footer_contactfrm" name="footer_contactfrm" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="padding:0 0 3px 0;">Name</td>
                  </tr>
                  <tr>
                    <td><input type="text" class="footer_message_txt" id="footer_contact_name" name="footer_contact_name" /></td>
                  </tr>
                  <tr>
                    <td style="padding:3px 0;">Email</td>
                  </tr>
                  <tr>
                    <td><input type="text" class="footer_message_txt" id="footer_contact_email" name="footer_contact_email" /></td>
                  </tr>
                  <tr>
                    <td style="padding:3px 0;">Message</td>
                  </tr>
                  <tr>
                    <td><textarea class="footer_message_txt" id="footer_contact_message" name="footer_contact_message"></textarea></td>
                  </tr>
                  <tr>
                    <td>
                        <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image22','','images/clear_btn_mo.png',1)">
                        <img src="images/clear_btn.png" alt="Clear" name="Image22" width="116" height="35" border="0" id="Image22" style="margin-top:5px; cursor:pointer" onClick="$('#footer_contactfrm')[0].reset();" /></a>
                        <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image23','','images/send_btn_mo.png',1)">
                        <img src="images/send_btn.png" alt="Send" name="Image23" width="118" height="35" border="0" id="Image23" style="cursor:pointer;" onClick="submitfooterfrm()" /></a>
                    </td>
                  </tr>
                </table>
                </form>
            </div>
            <div><img src="images/box_bottom.png"/></div>
            	
    	</div>
    </div>
    <? } ?>
    
</div> 
</div> 


<div id="footer_newsletter">

	<div id="footer_newsletter_gray"></div>
    <div id="footer_newsletter_white"></div>

	<div class="content" id="footer_newsout">
    	<div id="footer_newshd">NEWSLETTER SIGNUP <img src="images/gray_arow.png" border="0" /></div>
    	<div id="footer_newsmid">
        	<input type="text" class="txtbox_footer namebox" onBlur="chkField(this)" onFocus="chkField(this)" id="newssubscribe_name" name="newssubscribe_name" value="Enter name" />        
        	<input type="text" class="txtbox_footer emailbox" onBlur="chkField(this)" onFocus="chkField(this)" id="newssubscribe_email_address" name="newssubscribe_email_address" value="Enter email address" />
            <input type="text" class="txtbox_footer codebox" onBlur="chkField(this)" onFocus="chkField(this)" id="security_code" name="security_code" value="Enter security code" />
            <div id="captcha_outer">
            <img src="get_captcha.php" class="captchaimg" alt="" id="captcha" />
            <img src="images/refresh1.png" width="25" class="captcha_refresh" alt="Change Text" title="Change Text" id="refresh" style="cursor:pointer;" />
            </div>
        </div>
    	<div id="newsbtn"><img src="images/gray_btn.png" border="0" alt="SEND" title="SEND" style="cursor:pointer;" onClick="return subscribe_newsletter()" /></div>
    </div>
    
</div>



<div class="content_outer" style="background-color:#0396cb; padding:0;">
<div class="content">
    <div class="footer_row3_inner">
        <div id="foot_coprht">Copyright © 2014, <a href="">mastermindsolutionsonline.com</a></div>
    </div>
</div>
</div>


<div id="contact_thkpopup" style="display:none; padding:0;">
<table width="400" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
  <tr>
    <td class="popuptblhd">Thank you for contacting us <div class="popupclosebtn" onClick="close_contact_thkpopup()"></div></td>
  </tr>
  <tr>
    <td>You will receive a confirmation email to the email address you provided. One of our staff members will be in touch with you soon.</td>
  </tr>
  <tr>
    <td>Have a great day.</td>
  </tr>
</table>
</div>


<script type="text/javascript">

$(window).on("scroll click", function() {
  if ($(window).scrollTop() > 50 && $(window).width()>640) {
    $("#header").addClass("headerscroll");
  } else {
    $("#header").removeClass("headerscroll");
  }
});


function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	
	return true;
}

function chkField(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}


function submitfooterfrm(){
	
	var err = 0;

	if(	$('#footer_contact_name').val()==''){ err=1; $('#footer_contact_name').addClass('boxred'); } else { $('#footer_contact_name').removeClass('boxred'); }
	
	if($('#footer_contact_email').val()=='')
	{
	err=1;
	$('#footer_contact_email').addClass('boxred');
	}
	else
	{	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#footer_contact_email').val()) == false) 
		{
			err=1;
			$('#footer_contact_email').addClass('boxred');
		}
		else{
			$('#footer_contact_email').removeClass('boxred');
		}
	}

	if(	$('#footer_contact_message').val()==''){ err=1; $('#footer_contact_message').addClass('boxred'); } else { $('#footer_contact_message').removeClass('boxred'); }
	
	if(err==0)
	{
	
		ajax({
			a:'index',
			b:'act=submit_footer_contact&footer_contact_name='+$('#footer_contact_name').val()+'&footer_contact_email='+$('#footer_contact_email').val()+'&footer_contact_message='+$('#footer_contact_message').val(),
			c:function(){},
			d:function(data)
			{
				$('#footer_contactfrm')[0].reset();

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


function close_contact_thkpopup(){  $("#contact_thkpopup").dialog('close');  }



function subscribe_newsletter(){

	var err=0;

	if(	$('#newssubscribe_name').val()=='' || $('#newssubscribe_name').val()=='Enter name'){ err=1; alert('Enter Name'); $('#newssubscribe_name').val(''); $('#newssubscribe_name').focus();  return false; } 
	
	if($('#newssubscribe_email_address').val()=='' || $('#newssubscribe_email_address').val()=='Enter email address')
	{
	err=1;
	alert('Enter Email Address!'); 
	$('#newssubscribe_email_address').val('');
	$('#newssubscribe_email_address').focus();
	return false;
	}
	else
	{	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#newssubscribe_email_address').val()) == false) 
		{
			err=1;
			alert('Invalid Email Address!');
			$('#newssubscribe_email_address').focus();
			return false;
		}
	}
	
	if(	$('#security_code').val()=='' || $('#security_code').val()=='Enter security code'){ err=1; alert('Enter security code!'); $('#security_code').val(''); $('#security_code').focus(); return false; } 
	
	if(err==0){
		
		ajax({
			a:'index',
			b:'act=submit_subscribe_newsletter&name='+$('#newssubscribe_name').val()+'&email_address='+$('#newssubscribe_email_address').val()+'&security_code='+$('#security_code').val(),
			c:function(){},
			d:function(data)
			{
				alert(data);
				if($.trim(data)=='Invalid Capcha'){ 
					alert('Enter Valid Capcha Code!'); 
					change_captcha();
				}else{
					$('#newssubscribe_name').val('Enter name');
					$('#newssubscribe_email_address').val('Enter email address');
					$('#security_code').val('Enter security code');
					change_captcha();
				}
			}
		});

	}

}





</script>

</body>
</html>