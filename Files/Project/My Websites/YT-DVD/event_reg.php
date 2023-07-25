<?
function main(){
?>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/responsive1.css" />

<div class="funstop_container">

    <div class="container_full">       
    <div id="innerslide5" class="homeSlideInner">
    <div class="parallax">
        <div class="hsContainer">
        <div class="content" style="position:relative;">        
            
            <div class="innerslide5_content">
                <h1 class="pagetitle" style="padding-top:0px; color:#ffffff; text-shadow:-1px -1px 2px #666666;">FUN STOP</h1>
                <p style="text-shadow:-1px -1px 2px #666666;">Checkout the recent happenings in Yellow Train</p>
            </div>
            
        </div>
        </div>
    </div>
    </div>
    </div>


    <div class="page_menu">
    <div class="content">
        <div class="page_menu_container">
        
            <div class="page_menutop">
                <h1 class="page_menuhd">Fun Stop</h1>
                <div class="pagemenu_right">
                    <div class="pagemenu_desctop" style="padding-top:5px;">YT always celebrates the magic of childhood <br/>by organizing fun filled events throughout the year</div>
                </div>
            </div>
            
            <div class="page_menubtm">
                <ul>
                    <li><a class="active cursor">Upcoming Events</a></li> 
                    <li><a class="cursor">Gallery</a></li> 
                    <li><a class="cursor">Video</a></li> 
                </ul>
            </div>
            
        </div>
    </div>
    </div>
    
</div> <!--funstop container-->



<div class="funstop_content" id="gallery_content">
<div class="content">    

    <h2 class="funhd2">EVENT REGISTRATION</h2>			
    <p class="fun_desc2">Things end the memories lost forever. Browse through our albums of our past events.</p>
    
   
	<div class="full_width">
        <div class="joinus_left" id="eventreg_left"> <!--Event left-->
        	
            <div class="full_width">
                <ul class="hide_thankyou">
                    <li id="eventreg_tab_pd" class="eventreg_tab active" onclick="show_event('pd')">Personal Details</li>
                    <li id="eventreg_tab_ss" class="eventreg_tab eventreg_tab_ss" onclick="show_event('ss')">Select Sessions</li>
                </ul>
                
                <div class="full_width detail_contentbx">
					
                    <!--Personal-->
                    <div class="ques_cointainer personal_ques" id="pd_tab">
                    	<div class="ques_inner personal_ques personal_ques1" id="personal_ques1">
                        	<div class="qus"><p>What's your name?</p></div>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:22px;" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="person_name" name="person_name" value="" onkeydown="if (event.keyCode == 13) { personal_ques(2); }"/></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:22px;" onclick="personal_ques(2)"/></div>			
                            </div>	
                            <div style="float:right; margin-right:3.5%; padding-top:10px;"><span id="qus_number">1</span> / 5</div>
                        </div>	
                    	<div class="ques_inner personal_ques personal_ques2" id="personal_ques2">
                        	<div class="qus"><p>What's your date of Birth? </p></div>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:22px;" onclick="personal_quess(1)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="person_dob" name="person_dob" value="" onkeydown="if (event.keyCode == 13) { personal_ques(3); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:22px;" onclick="personal_ques(3)" /></div>			
                            </div>	
                            <div style="float:right; margin-right:3.5%; padding-top:10px;"><span id="qus_number">1</span> / 5</div>
                        </div>
                    	<div class="ques_inner personal_ques personal_ques3" id="personal_ques3">
                        	<div class="qus"><p>What's your Gender? </p></div>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:22px;" onclick="personal_quess(2)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="person_gender" name="person_gender" value="" onkeydown="if (event.keyCode == 13) { personal_ques(4); }"/></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:22px;" onclick="personal_ques(4)" /></div>			
                            </div>	
                            <div style="float:right; margin-right:3.5%; padding-top:10px;"><span id="qus_number">1</span> / 5</div>
                        </div>
                    	<div class="ques_inner personal_ques personal_ques4" id="personal_ques4">
                        	<p>What's your address? </p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:22px;" onclick="personal_quess(3)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="person_address" name="person_address" value="" onkeydown="if (event.keyCode == 13){ personal_ques(5);}"/></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:22px;" onclick="personal_ques(5)" /></div>			
                            </div>	
                            <div style="float:right; margin-right:3.5%; padding-top:10px;"><span id="qus_number">1</span> / 5</div>
                        </div>	
                    	<div class="ques_inner personal_ques personal_ques5" id="personal_ques5">
                        	<p>What's your E-mail? </p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:22px;" onclick="personal_quess(4)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="person_email" name="person_email" value="" onkeydown="if (event.keyCode == 13) { personal_ques(6); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:22px;" onclick="personal_ques(6)" /></div>			
                            </div>
                            <div style="float:right; margin-right:3.5%; padding-top:10px;"><span id="qus_number">1</span> / 5</div>
                            <div class="event_nextbtn" onclick="personal_ques(6)">Next</div>	
                        </div>
                    </div>
					<!--Personal End-->
					
                    <div class="session_cntr hide_thankyou" id="session_detail" >
                        <p>Please select the session that you would like to attend along with the timing</p>

                        <div class="full_width">
                        	<div style="background:#32a9d4; color:#FFFFFF; width:100%; float:left; padding:10px 0px 10px 0px; margin-top:25px;">
                            <input type="checkbox" class="check_accord" id="" name="" value="" checked="checked" /> Jan 01, 2014</div>
                            
                            <div class="check_accord_det" style="display:block">
                                <div class="session_inner" style="background:#d8d8d8;">
                                    <div class="sessrow1_left">
                                        <input type="checkbox" class="" id="" name="" value="" /> Session1 <br/>
                                        <p>
                                        <input type="checkbox" class="" id="" name="session1" value="" /> 10:30 AM - 11:30 AM &nbsp; <br/>
                                        <input type="checkbox" class="" id="" name="session1" value="" /> 1:30 PM - 2:30 PM
                                        </p>
                                    </div>
                                    <div class="sessrow1_right">
                                        <span>Rs.200 /-</span>
                                    </div>	
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="full_width">
                        	<div style="background:#32a9d4; color:#FFFFFF; width:100%; float:left; padding:10px 0px 10px 0px; margin-top:0px;">
                            <input type="checkbox" class="check_accord" id="" name="" value="" /> Jan 01, 2014</div>
                            
                            <div class="check_accord_det" style="display:none">
                                <div class="session_inner" style="background:#f7f7f7;">
                                    <div class="sessrow1_left">
                                        <input type="checkbox" class="" id="" name="" value="" /> Session1 <br/>
                                        <p>
                                        <input type="checkbox" class="" id="" name="session1" value="" /> 10:30 AM - 11:30 AM &nbsp; <br/>
                                        <input type="checkbox" class="" id="" name="session1" value="" /> 1:30 PM - 2:30 PM
                                        </p>
                                    </div>
                                    <div class="sessrow1_right">
                                        <span>Rs.200 /-</span>
                                    </div>	
                                </div>
                                <div class="session_inner" style="background:#d2d2d2;">
                                    <div class="sessrow1_left">
                                        <input type="checkbox" class="" id="" name="" value="" /> Session1 <br/>
                                        <p>
                                        <input type="checkbox" class="" id="" name="session1" value="" /> 10:30 AM - 11:30 AM &nbsp; <br/>
                                        <input type="checkbox" class="" id="" name="session1" value="" /> 1:30 PM - 2:30 PM
                                        </p>
                                    </div>
                                    <div class="sessrow1_right">
                                        <span>Rs.200 /-</span>
                                    </div>	
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="session_inner total_session">
                        	<div class="sessrow1_left"></div>
                            <div class="sessrow1_right">
                            	<span>Total Amount	&nbsp; Rs. 400 /-</span>
                            </div>	
                        </div>
                        <div class="session_inner">
                        	<span class="session_registerbtn" onclick="show_thanku()">Register now</span>
                        </div>
                    </div>
                    <div class="regthank_cntr" id="show_thanku" style="margin-top:15px;">
                        <img src="images/event_thank_img.jpg" alt="" style="width:100%; float:left;" />
                        <h2>Thank you for registering for Kids Festival. </h2>
                        <p>A confirmation email has been sent to your registered email address. Please make sure you add events@yellowtrainschool.com to the whitelist or else it may 
                        end up in spam folder. </p>
                        <div class="thanku_midparag">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="eventregtbl">
                              <tr>
                                <td align="right" width="56%" valign="top">Your Registration Code</td>
                                <td width="3%" align="center" valign="top">:</td>
                                <td width="42%" valign="top"><span>KID2019</span></td>
                              </tr>
                              <tr>
                                <td align="right" valign="top">Sessions Registered</td>
                                <td align="center" valign="top">:</td>
                                <td valign="top">Session 1 ( 10:00 AM to 11:30 AM)</td>
                              </tr>
                              <tr>
                                <td align="right" valign="top">Total Amount to be paid at the time of the event</td>
                                <td align="center" valign="top">:</td>
                                <td valign="top">Rs. 400/-</td>
                              </tr>
                            </table>
                        </div>
                        <p>Please make sure you remember your registration number as it is important for your entry into the hall. </p>
                    </div>
                    
                    
                </div>
               
            </div>	
        </div> <!--Event left-->
        
        <div class="joinus_right" id="eventreg_right"> <!--Event Right-->
        	<div class="full_width">
            	<p style="padding:5px 0; background:#f9df04;"></p>
                <img src="images/gal_img001.jpg" alt="" style="width:100%; float:left;" />
            </div> 	
        	<div class="full_width kid_festivalbg">
				<h2>KIDS FESTIVAL</h2>
                <p>Dec 20, 2014</p>
                <p>Sunday, 10:00 AM - 5:00 PM</p>
            </div> 
        	<div class="full_width kid_festivalbg" style="border:0;">
                <p>Grade School Campus,</p>
                <p>Mudhalipalayam</p>
                <p>Coimbatore - 641007</p>
            </div> 	
        	<div class="full_width have_question">
                <p>HAVE QUESTIONS </p>
                <span>ABOUT THIS EVENT?</span>
            </div> 	
        	<div class="full_width" style="background:url(images/pattern_1.jpg) no-repeat 100% 100%;">
             	<p>Please fill in the form below</p>
                <div class="eventreg_txtbox2">
                	<img src="images/name1_icon.png" alt="" style="position:absolute; left:4px; top:4px;" />
                	<input type="text" style="width:100%;" class="txtbox_noborder" id="contact_name" name="contact_name" value="" />
                </div>
             	<div class="eventreg_txtbox2">
                	<img src="images/mail1_icon.png" alt="" style="position:absolute; left:4px; top:4px;" />
                	<input type="text" style="width:100%;" class="txtbox_noborder" id="contact_email" name="contact_email" value="" />
                </div>
             	<div class="eventreg_txtbox2">
                    <img src="images/contact_icon.png" alt="" style="position:absolute; left:4px; top:4px;" />
                    <input type="text" style="width:100%;" class="txtbox_noborder" id="contact_number" name="contact_number" value="" />
                </div>
            	<div class="eventreg_txtbox2">
                    <img src="images/messege_icon.png" alt="" style="position:absolute; left:4px; top:4px;" />
                	<textarea style="width:100%; height:90px;" class="txtbox_noborder" id="contact_message" name="contact_message" value=""></textarea>
                </div>
            	<div class="full_width">
                	<span class="eventreg_submit">Submit</span>
                </div>
            </div> 	
        </div> <!--Event Right-->
    </div>


</div>
</div>



<script type="text/javascript">
	
$('.check_accord').click(function(){
	$(this).parent().next('.check_accord_det').slideToggle();
});

	
</script>

<!--<script type="text/javascript">
$("#person_name").keydown(function (e) {
  if (e.keyCode == 13) {
    $('input[name = butAssignProd]').click();
  }
});
</script>
-->

<script type="text/javascript">

$(".eventreg_tab").click(function(){
	$('.eventreg_tab').removeClass('active');
	$(this).addClass('active');
});

function show_event(tabval){
	
	$('.eventreg_tab').removeClass('active');
	
	if(tabval=='pd'){
		$('#eventreg_tab_pd').addClass('active');
		$('#pd_tab').show();
		$('#session_detail').hide();
	}else if(tabval=='ss'){
		$('#eventreg_tab_ss').addClass('active');
		$('#pd_tab').hide();
		$('#session_detail').show();
	}
}


function show_thanku(){
	
	$('#show_thanku').show();
	$('.hide_thankyou').hide();
	
}

function personal_quesq(pdq){
	
	var a = parseInt(pdq);
	
	$("#personal_ques"+(a-1)+" p").slideUp(250);
	setTimeout(function(){ 
		
		document.getElementById("personal_ques"+a).style.display = "block";
		
		if(a==2)
		{
			$("#person_dob" ).focus();
		}
		else if(a==3)
		{
			$("#person_gender" ).focus();
		}
		else if(a==4)
		{
			$("#person_address" ).focus();
		}
		else
		{
			$("#person_email" ).focus();
		}
		
		document.getElementById("personal_ques"+(a-1)).style.display = "none";
		document.getElementByClassName("personal_ques").style.display = "none";
	},400);
	
}


function personal_quess(pdq){
	
	var b = parseInt(pdq);
	
	$("#personal_ques"+(b)+" p").slideDown(250);
	setTimeout(function(){ 
		document.getElementById("personal_ques"+b).style.display = "block";
		$('span#qus_number').text(pdq);
		document.getElementById("personal_ques"+(b+1)).style.display = "none";
		document.getElementByClassName("personal_ques").style.display = "none";
	},400);
	
}


</script>



<script type="text/javascript">

function personal_ques(pdq) {
	
    switch (pdq) {
        case 2:
			if(	$('#person_name').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $('span#qus_number').text(pdq);			 
			 personal_quesq(pdq);
			 return true; 
			}
            break;
        case 3:
			if(	$('#person_dob').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $('span#qus_number').text(pdq);			 
			 personal_quesq(pdq);
			 return true; 
			}
            break;
        case 4:
			if(	$('#person_gender').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $('span#qus_number').text(pdq);			 
			 personal_quesq(pdq);
			 return true; 
			}
            break;
        case 5:
			if(	$('#person_address').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $('span#qus_number').text(pdq);			 
			 personal_quesq(pdq);
			 return true; 
			}
            break;
        case 6:
			if(	$('#person_email').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $("#eventreg_tab_pd").css({"background":"#cccccc","color":"#2b2b2b"});
			 $(".eventreg_tab_ss").css({"background":"#32a9d4","color":"#FFFFFF","display":"block"});
			 
			 setTimeout(function(){show_event('ss');},800);
			 return true; 
			}
            break;
    }
}
</script>


<script type="text/javascript">

$('.page_menubtm ul li').click(function(event) {
	event.preventDefault();
	var target = $(this).find('>a').prop('hash');
	
	$(".pagetopbox").remove(); $(target).prepend($('<div class="pagetopbox">&nbsp;</div>'));
	
	$('html, body').animate({
		scrollTop: $(target).offset().top
	}, 700);
	
});


$(window).on('scroll',function(){
	
	var winHt = $(window).height();
	var scrollVal = $(window).scrollTop();
	var nav_pos = winHt - 260;
	
	if (scrollVal >= nav_pos){ 
		$('.page_menu').addClass('page_menu_active');
	}
	else{ 
		$('.page_menu').removeClass('page_menu_active');
		$('.pagetopbox').hide();
	}
});



$(document).ready(function(){ 

	var parallax = document.querySelectorAll(".parallax_inner1"),speed = 0.03;

	window.onscroll = function(){
	[].slice.call(parallax).forEach(function(el,i){
	
	  var windowYOffset = window.pageYOffset,
		  elBackgrounPos = "100% " + (windowYOffset * speed) + "px";
	  
	  el.style.backgroundPosition = elBackgrounPos;
	
	});
	};
});

</script>


<?
}
include "template.php";
?>