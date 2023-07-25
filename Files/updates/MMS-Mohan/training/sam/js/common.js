// JavaScript Document


//$(document).ready(function() {
    // This will fire when document is ready:
    
//});


$(window).load(function() { 
	$("#status").fadeOut(); 
	$("#preloader").delay(350).fadeOut("slow"); 
	
})


$(document).ready(function(){



/*var s_url = document.URL;
  if(s_url.search('#') > 0 ){
    window.location = "http://"+document.domain;
  }
*/



var s_url = document.URL;
  
  
  
  if(s_url.search('#web-design') > 0){
		portfolioWeb();

  
  } else if(s_url.search('#brand-design') > 0){
  	portfolioBrand();

    
  } 
  else if(s_url.search('#apps-design') > 0){
  	portfolioApps();
    
  }
  
  else if (s_url.search('#') > 0 ){
    window.location = "http://"+document.domain;
  };



$().SmoothAnchors();
$("body").niceScroll();


// SMOOTH MOVEMENT ANIMATIONS //////////
$(".innerBg").everyTime(10, function(){						 
	$(".innerBg").animate({"top":"-442px"}, 6000).animate({"top":"-332px"}, 6000);	
});

$(".headerBg2").everyTime(100, function(){						 
	$(".headerBg2").animate({"top":"-480px"}, 30000).animate({"top":"0"}, 30000);	
});

$(".topicBg2").everyTime(100, function(){						 
	$(".topicBg2").animate({"top":"-480px"}, 25000).animate({"top":"0"}, 25000);	
});

$(".quick-contactBg").everyTime(100, function(){						 
	$(".quick-contactBg").animate({"top":"-480px"}, 25000).animate({"top":"0"}, 25000);	
});


$(".headerBg32").everyTime(500, function(){						 
	$(".headerBg32").animate({"marginLeft":"2px"}, 1000).animate({"marginTop":"2px"}, 1000);	
	$(".headerBg32").animate({"marginTop":"5px"}, 1000).animate({"marginLeft":"5px"}, 1000);	
});

$(".headerBg31").everyTime(100, function(){						 
	$(".headerBg31").animate({"marginLeft":"2px", "marginTop":"2px"}, 3000).animate({"marginLeft":"5px", "marginTop":"0px"}, 3000);	
});



// ALL MOUSE HOVER EVENTS //////////

$("#web_port .box").hover(function(){
		$(this).find(".view").delay(0).fadeIn(200);
		$(this).find('span').css({'background-color': '#db242d'},{queue:true,duration:200});
		$(this).find('h3').animate({marginTop: '0'},{queue:true,duration:200});
    
    
	}, function() {
		$(this).find(".view").delay(0).fadeOut(200);
    $(this).find('span').css({'background-color': '#3f3f3f'},{queue:true,duration:200});
    $(this).find('h3').animate({marginTop: '100px'},{queue:true,duration:200});
});

$("#brand_port .box").hover(function(){
		$(this).find('span').css({'background-color': '#ffd200'},{queue:true,duration:200});
		$(this).find('h3').animate({marginTop: '0'},{queue:true,duration:200});
    
	}, function() {
    $(this).find('span').css({'background-color': '#3f3f3f'},{queue:true,duration:200});
    $(this).find('h3').animate({marginTop: '100px'},{queue:true,duration:200});
});

$("#app_port .box").hover(function(){
		$(this).find('span').css({'background-color': '#69408b'},{queue:true,duration:200});
		$(this).find('h3').animate({marginTop: '0'},{queue:true,duration:200});
    
	}, function() {
    $(this).find('span').css({'background-color': '#3f3f3f'},{queue:true,duration:200});
    $(this).find('h3').animate({marginTop: '100px'},{queue:true,duration:200});
});



$(".likeUs").hover(function(){
    $(this).stop(true, false).animate({ right: "0" });
	}, function() {
    $(this).stop(true, false).animate({ right: "-313px" });
});
  
  
  
   $("nav h1 a").hover(function(){
    $(this).stop(true, false).animate({ width: "244px" });
	}, function() {
    $(this).stop(true, false).animate({ width: "150px" });
});
 

	
	function boxDefault(){
	};
	
	
	$(".big-box, .studio-in h4, .studio-in p").hover(function(){
		$('.box1, .box2, .box3').animate({top: '806px'},{queue:true,duration:200});
		$(".b0").delay(0).fadeIn(200);
		$(".b1, .b2, .b3").delay(0).fadeOut(200);
		$('.box1, .box2, .box3').css({'background-color': '#3e3e3e'},{queue:true,duration:200});
		$('.big-box').css({'background-color': '#f23d06'},{queue:true,duration:100});
		
});
	
	
	$(".box1").hover(function(){
  	$(".b0").delay(0).fadeOut(0);
		$(this).stop(true, false).animate({ top: "793px" },{queue:true,duration:200});
    
	  $('.big-box').css({'background-color': '#ff2db4'},{queue:true,duration:200});
	  $(this).css({'background-color': '#ff9c00'},{queue:true,duration:200});
	  $('.big-box').css({'background-color': '#f27c00'},{queue:true,duration:200});
	  $(".b0, .b2, .b3").delay(0).fadeOut(200);
	  $(".b1").delay(0).fadeIn(200);
	  $('.box2, .box3').css({'background-color': '#3e3e3e'},{queue:true,duration:200});
	  $('.box2, .box3').animate({top: '806px'},{queue:true,duration:200});
    
	}, function() {
    boxDefault();
});
	
	
	$(".box2").hover(function(){
		$(".b0").delay(0).fadeOut(0);
		$(this).stop(true, false).animate({ top: "793px" },{queue:true,duration:200});
    
	  $('.big-box').css({'background-color': '#ff2db4'},{queue:true,duration:200});
	  $(this).css({'background-color': '#e3124f'},{queue:true,duration:200});
	  $(".b1, .b3").delay(0).fadeOut(200);
	  $(".b2").delay(0).fadeIn(200);
	  $('.box1, .box3').css({'background-color': '#3e3e3e'},{queue:true,duration:200});
	  $('.box1, .box3').animate({top: '806px'},{queue:true,duration:200});
	}, function() {
    boxDefault();
    
});
	
	$(".box3").hover(function(){
		$(".b0").delay(0).fadeOut(0);
    $(this).stop(true, false).animate({ top: "793px" },{queue:true,duration:200});
    $('.big-box').css({'background-color': '#ff19fe'},{queue:true,duration:200});
    $(this).css({'background-color': '#5a5edc'},{queue:true,duration:200});
	  $(".b1, .b2").delay(0).fadeOut(200);
	  $(".b3").delay(0).fadeIn(200);
	  $('.box1, .box2').css({'background-color': '#3e3e3e'},{queue:true,duration:200});
	  $('.box1, .box2').animate({top: '806px'},{queue:true,duration:200});
    
	}, function() {
    boxDefault();
    
});

	
	$('#our-work h3, #our-work h2').mouseenter(function(){
	  $('.catagory').css('background-position','center 0');
	});

	function portfolioWeb(){ 
		
		
		
		$('#web_port').delay(0).animate({marginLeft: '0'},{queue:false,duration:500});
		$('#brand_port').delay(0).animate({marginLeft: '100%'},{queue:false,duration:500});
		$('#app_port').delay(0).animate({marginLeft: '200%'},{queue:false,duration:500});		
		$("#web-portfolio").addClass('active');
		$("#brand-portfolio, #app-portfolio").removeClass('active');
		$('#web_port .box').delay(400).animate({width: '332px'},{queue:true,duration:500});
		$('#brand_port .box').delay(0).animate({width: '0px'},{queue:true,duration:500});
		$('#app_port .box').delay(0).animate({width: '0px'},{queue:true,duration:500});
	};
	
	
	function portfolioBrand(){ 
		$("#brand-portfolio").addClass('active');
		$("#web-portfolio, #app-portfolio").removeClass('active');
		$('#web_port').delay(0).animate({marginLeft: '-100%'},{queue:false,duration:500});
		$('#brand_port').delay(0).animate({marginLeft: '0'},{queue:false,duration:500});
		$('#app_port').delay(0).animate({marginLeft: '100%'},{queue:false,duration:500});
		$('#web_port .box').delay(0).animate({width: '0px'},{queue:true,duration:500});
		$('#brand_port .box').delay(400).animate({width: '332px'},{queue:true,duration:500});
		$('#app_port .box').delay(0).animate({width: '0px'},{queue:true,duration:500});
	};
	
	
	function portfolioApps(){ 
		$("#app-portfolio").addClass('active');
		$("#web-portfolio, #brand-portfolio").removeClass('active');
		$('#web_port').delay(0).animate({marginLeft: '-200%'},{queue:false,duration:500});
		$('#brand_port').delay(0).animate({marginLeft: '-100%'},{queue:false,duration:500});
		$('#app_port').delay(0).animate({marginLeft: '0'},{queue:false,duration:500});
		$('#web_port .box').delay(0).animate({width: '0px'},{queue:true,duration:500});
		$('#brand_port .box').delay(0).animate({width: '0'},{queue:true,duration:500});
		$('#app_port .box').delay(400).animate({width: '332px'},{queue:true,duration:500});
		$('#app_port .part1').delay(400).animate({width: '664px'},{queue:true,duration:500});
	};
	
	
	
// ALL MOUSE CLICK EVENTS //////////
	$('#web-portfolio').click(function(){
		portfolioWeb();
	});
	
	$('#brand-portfolio').click(function(){
		portfolioBrand();
	});
	
	$('#app-portfolio').click(function(){
		portfolioApps();
	});
	
	
	
	
  $('#getInTouch, #getInTouchMob, .iq, .git, #getInTouch-f, #awardsContact').click(function(){
    $('#contact-us').delay(0).animate({top: '0'},{queue:false,duration:500});
  	$('#container, nav').delay(0).animate({top: '950px'},{queue:false,duration:500});
    $('.contactusMap').delay(200).animate({top: '0'},{queue:false,duration:1100});
  	$('#contact-us h2').delay(500).animate({top: '0'},{queue:false,duration:300});
  	$('.contact-us-in').delay(800).fadeIn(300);
  	$('.loc-ico').delay(1000).fadeIn(500);
  	
  	//$('#container').delay(0).css({height: '6440px'});
	});
	
	//$('.web, .brand, .app').click(function(){
	
	//$('.undercns').delay(0).fadeIn(500);
	//$('.undercns').delay(1500).fadeOut(500);
	
	//});
	
	$('.close, .bth').click(function(){
	 closeContactForm();
	 
	});
	
	$('.close-res').click(function(){
	 $('.res-bg').fadeOut(500);
	 
	});
	
	
	$('#getInTouch-f').click(function(){
	  $('#contact').delay(0).animate({height: '544px'},{queue:true,duration:500});
	});

	$('.nav-in a').click(function(){
	  $(".nav-in a").removeClass('active');
	  $(this).addClass('active');
	});
	
	$('#home').click(function(){
	  $("nav").removeClass('nav-active');
  		//$("#home").delay(0).fadeOut(100);
  		$('.header-in').delay(0).animate({top: '-150px'},{queue:false,duration:500});
	});
	
	$('#home, #studio-trionn').click(function(){
	  $(".nav-in a").removeClass('active');
	  $('#contact').delay(0).animate({height: '0px'},{queue:false,duration:500});
	  $('header').delay(0).animate({height: '494px'},{queue:false,duration:500});
	  $('#container').delay(0).animate({left: '0'},{queue:false,duration:500});
		$('#containerRight').delay(0).animate({left: '-100%'},{queue:false,duration:500});
	});
	
	
// ALL CALLED FUNCTIONS 
	function closeContactForm(){
    $('.loc-ico').delay(0).fadeOut(200);
	  $('.contact-us-in').delay(200).fadeOut(200);
    $('.contactusMap').delay(200).animate({top: '-500px'},{queue:true,duration:700});
	  $('#contact-us h2').delay(600).animate({top: '-200px'},{queue:true,duration:200});
	  $('#container, nav').delay(0).animate({top: '0'},{queue:true,duration:0});
	  $('#contact-us').delay(800).animate({top: '-950px'},{queue:true,duration:300});
	  //$('#container').delay(0).css({height: '5440px'});
  };
	

// FUNCTION FOR  MENU ACTIV DACTIVE 
		

	$(window).bind('scroll',function(e){
    	parallaxScroll();
	    
		    
				if ($(this).scrollTop() > 660) {
		      $('#mainNav').delay(0).css({'position': 'fixed', 'top': '0'});
		    	$("#mainNav").addClass('nav-active');
					$("#mainNav .nav-in a").removeClass('active');
			  } else if ($(this).scrollTop() < 660){
		      $("nav").removeClass('nav-active');
		    }
		    
		    if ($(this).scrollTop() > 1320){
					$("#mainNav  #oWork").addClass('active');
					$('.web').delay(0).animate({marginTop: '110px'},{queue:true,duration:800});
					$('.brand').delay(500).animate({marginTop: '107px'},{queue:true,duration:800});
					$('.app').delay(700).animate({marginTop: '107px'},{queue:true,duration:800});
				}
		    
		    
			  if ($(this).scrollTop() > 2550){
					$("#mainNav .nav-in a").removeClass('active');
					$("#mainNav  #studio-trionn").addClass('active');
					$('.n1 span').delay(0).animate({marginTop: '-206px'},{queue:false,duration:1300});
					$('.n2 span').delay(0).animate({marginTop: '-2967px'},{queue:false,duration:1300});
				}
				else if ($(this).scrollTop() < 2550){
		  		//$("nav").removeClass('nav-active');
		  		$('.n1 span').delay(0).animate({marginTop: '0px'},{queue:false,duration:1300});
					$('.n2 span').delay(0).animate({marginTop: '0px'},{queue:false,duration:1300});
				}
				if ($(this).scrollTop() > 2900){
					$('.box1, .box2, .box3').animate({top: '806px'},{queue:true,duration:200});
			    $('.big-box').css({'background-color': '#f23d06'},{queue:true,duration:200});
			  	$('.box1, .box2, .box3').css({'background-color': '#3e3e3e'},{queue:true,duration:200});
			  	$(".b1, .b2, .b3").delay(0).fadeOut(200);
			  	$(".b0").delay(0).fadeIn(200);
				}
			
			});




	$(window).resize(function() {
  	if($(window).width() >= 1024) {
			//alert("aa");
			
			 $('.web').mouseenter(function(){
				  $('.catagory').css('background-position','center -388px');
				});
				
				$('.brand').mouseenter(function(){
				  $('.catagory').css('background-position','center -775px');
				});
				
				$('.app').mouseenter(function(){
				  $('.catagory').css('background-position','center -1162px');
				});
	
			$(window).bind('scroll',function(e){
    	parallaxScroll();

				if ($(this).scrollTop() > 660) {
					//$("header").delay(0).fadeOut(0);
					//$(".headerBg2, .headerBg3, .headerBg31, .headerBg32, .headerBg4").delay(0).fadeOut(0);
			  }
		  	
		    else if ($(this).scrollTop() < 660){
		      //$("header").delay(0).fadeIn(0);
		      //$(".headerBg2, .headerBg3, .headerBg31, .headerBg32, .headerBg4").delay(0).fadeIn(0);
		    }
			});

	} else if ($(window).width() >= 641){

				$('.web').mouseenter(function(){
				  $('.catagory').css('background-position','center -269px');
				});
				
				$('.brand').mouseenter(function(){
				  $('.catagory').css('background-position','center -537px');
				});
				
				$('.app').mouseenter(function(){
				  $('.catagory').css('background-position','center -805px');
				});
	}  else if ($(window).width() >= 240){

		$('.web').mouseenter(function(){
				  $('.catagory').css('background-position','center -233px');
				});
				
				$('.brand').mouseenter(function(){
				  $('.catagory').css('background-position','center -465px');
				});
				
				$('.app').mouseenter(function(){
				  $('.catagory').css('background-position','center -698px');
				});
}
	
	else{

	}
}).resize(); // This will simulate a resize to trigger the initial run.



// FUNCTION for parallax SRCOLLING
function parallaxScroll(){
	var scrolled = $(window).scrollTop();

	//console.log(scrolled);

	$('header.main').css('top',(0-(scrolled*0.66))+'px');
	$('.headerBg5').css('top',(0+(scrolled*0.36))+'px');
	$('.headerBg3').css('top',(0+(scrolled*0.66))+'px');
	$('.headerBg31').css('top',(0+(scrolled*0.66))+'px');
	$('.headerBg32').css('top',(0+(scrolled*0.66))+'px');
	$('.headerBg4').css('top',(0+(scrolled*0.66))+'px');
	}

});

$(function(){
    $('.fadein img:gt(0)').hide();
    setInterval(function(){
      $('.fadein :first-child').fadeOut()
         .next('img').fadeIn()
         .end().appendTo('.fadein');}, 
      3000);
});


// MAIL CHECKING EMAIL ////////////
var errinstant = false;
var errcontact = false;

function clearText(id,value,value2,class_name){
	if($("#"+id).val() == value || $("#"+id).val() == value2){
			$("#"+id).val("");
			$("#"+id).attr('class',class_name);
	}
}
function FillText(id,value,class_name){
	if($("#"+id).val() == ""){
		$("#"+id).val(value);
		$("#"+id).attr('class',class_name);
	}
}
function chkFrmInstant(frmInstant){
    var formclear = true;
    var firstname = trim(document.getElementById("Quotation_fullname").value);
    if(firstname=="" || firstname=="Name" || firstname=="Please Enter Your Name"){
        document.getElementById("Quotation_fullname").className = "input_error textbox";
        document.getElementById("Quotation_fullname").value = "Please Enter Your Name";
        errinstant=true;
        formclear = false;
    }
    var intrested = trim(document.getElementById("Quotation_intreased").value);
    if(intrested=="" || intrested=="Company" || intrested=="Please enter Your Company Name"){
        document.getElementById("Quotation_intreased").className = "input_error textbox";
        document.getElementById("Quotation_intreased").value = "Please enter Your Company Name";
        formclear = false;
    }
	  var telephone = trim(document.getElementById("Quotation_phone").value);
    if(telephone=="" || telephone=="Phone" || telephone=="Please enter Your Phone Number"){
        document.getElementById("Quotation_phone").className = "input_error textbox";
        document.getElementById("Quotation_phone").value = "Please enter Your Phone Number";
        formclear = false;
    }
    else if(telephone.length<6){
        document.getElementById("Quotation_phone").className = "input_error textbox";
        document.getElementById("Quotation_phone").value = "Please enter Your Phone Number";
        formclear = false;
    }
    var email_address = trim(document.getElementById("Quotation_email").value);
    if(email_address=="" || email_address=="Email" || email_address=="Please enter Your valid Email"){
        document.getElementById("Quotation_email").className = "input_error textbox";
        document.getElementById("Quotation_email").value = "Please enter Your Email";
        formclear = false;
    }
      else if(validateEmail(email_address)==null){
        document.getElementById("Quotation_email").className = "input_error textbox";
        document.getElementById("Quotation_email").value = "Please enter Your Email";
    		formclear = false;
    }
    var message = trim(document.getElementById("Quotation_message").value);
    if(message=="" || message=="Message" || message=="Please enter Your Message"){
	      document.getElementById("Quotation_message").className = "input_error";
        document.getElementById("Quotation_message").value = "Please enter Your Message";
        formclear = false;
    }
    if(formclear==false){
        return false;
    }
    else{
        var xmlhttp;
        if (window.XMLHttpRequest){
     			xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
        }
        else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
        }
        $(".process").delay(10).fadeTo("slow",0.7);
        $("#Quotation").delay(10).fadeTo("slow",0.1);
        var sendUrl = "sendmail.php?Quotation_fullname="+firstname+"&Quotation_intreased="+intrested+"&Quotation_phone="+encodeURIComponent(telephone)+"&Quotation_email="+email_address+"&Quotation_message="+message;
        xmlhttp.open("GET",sendUrl);
        xmlhttp.send(null);
        xmlhttp.onreadystatechange=function(){
              if (xmlhttp.readyState==4 && xmlhttp.status==200){
                  if(xmlhttp.responseText=="success"){
                     $(function() {
                           //$('.quote-contact-form').fadeOut('normal');
                           $('#msgquot').delay(100).fadeIn('normal', function() {
                             $(this).delay(1000).fadeOut();
                             $(".process").delay(10).fadeOut("normal");
                             $("#Quotation").delay(300).fadeTo("slow",1);
                           });
                     });
                     document.getElementById("Quotation_fullname").value = "Name"
                     document.getElementById("Quotation_intreased").value = "Company"
                     document.getElementById("Quotation_phone").value = "Phone"
                     document.getElementById("Quotation_email").value = "Email"
                     document.getElementById("Quotation_message").value = "Message"
                     $("#Quotation_fullname").attr('class',"textbox namebox");
                     $("#Quotation_intreased").attr('class',"textbox");
                     $("#Quotation_phone").attr('class',"textbox phonebox");
                     $("#Quotation_email").attr('class',"textbox");
                     $("#Quotation_message").attr('class',"");
                  }
              }
        }
        return false;
    }
    return false;
}
function validateEmail(email){
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    return email.match(re)
}
function trim(str){
    if(!str || typeof str != 'string')
        return null;

    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
}


////////////////////////////////////////////////////////////////////////////////////

/** TIMER JQUERY BACKGROUND MOVEMENT *******************/

jQuery.fn.extend({
	everyTime: function(interval, label, fn, times, belay) {
		return this.each(function() {
			jQuery.timer.add(this, interval, label, fn, times, belay);
		});
	},
	oneTime: function(interval, label, fn) {
		return this.each(function() {
			jQuery.timer.add(this, interval, label, fn, 1);
		});
	},
	stopTime: function(label, fn) {
		return this.each(function() {
			jQuery.timer.remove(this, label, fn);
		});
	}
});

jQuery.event.special

jQuery.extend({
	timer: {
		global: [],
		guid: 1,
		dataKey: "jQuery.timer",
		regex: /^([0-9]+(?:\.[0-9]*)?)\s*(.*s)?$/,
		powers: {
			// Yeah this is major overkill...
			'ms': 1,
			'cs': 10,
			'ds': 100,
			's': 1000,
			'das': 10000,
			'hs': 100000,
			'ks': 1000000
		},
		timeParse: function(value) {
			if (value == undefined || value == null)
				return null;
			var result = this.regex.exec(jQuery.trim(value.toString()));
			if (result[2]) {
				var num = parseFloat(result[1]);
				var mult = this.powers[result[2]] || 1;
				return num * mult;
			} else {
				return value;
			}
		},
		add: function(element, interval, label, fn, times, belay) {
			var counter = 0;
			
			if (jQuery.isFunction(label)) {
				if (!times) 
					times = fn;
				fn = label;
				label = interval;
			}
			
			interval = jQuery.timer.timeParse(interval);

			if (typeof interval != 'number' || isNaN(interval) || interval <= 0)
				return;

			if (times && times.constructor != Number) {
				belay = !!times;
				times = 0;
			}
			
			times = times || 0;
			belay = belay || false;
			
			var timers = jQuery.data(element, this.dataKey) || jQuery.data(element, this.dataKey, {});
			
			if (!timers[label])
				timers[label] = {};
			
			fn.timerID = fn.timerID || this.guid++;
			
			var handler = function() {
				if (belay && this.inProgress) 
					return;
				this.inProgress = true;
				if ((++counter > times && times !== 0) || fn.call(element, counter) === false)
					jQuery.timer.remove(element, label, fn);
				this.inProgress = false;
			};
			
			handler.timerID = fn.timerID;
			
			if (!timers[label][fn.timerID])
				timers[label][fn.timerID] = window.setInterval(handler,interval);
			
			this.global.push( element );
			
		},
		remove: function(element, label, fn) {
			var timers = jQuery.data(element, this.dataKey), ret;
			
			if ( timers ) {
				
				if (!label) {
					for ( label in timers )
						this.remove(element, label, fn);
				} else if ( timers[label] ) {
					if ( fn ) {
						if ( fn.timerID ) {
							window.clearInterval(timers[label][fn.timerID]);
							delete timers[label][fn.timerID];
						}
					} else {
						for ( var fn in timers[label] ) {
							window.clearInterval(timers[label][fn]);
							delete timers[label][fn];
						}
					}
					
					for ( ret in timers[label] ) break;
					if ( !ret ) {
						ret = null;
						delete timers[label];
					}
				}
				
				for ( ret in timers ) break;
				if ( !ret ) 
					jQuery.removeData(element, this.dataKey);
			}
		}
	}
});

jQuery(window).bind("unload", function() {
	jQuery.each(jQuery.timer.global, function(index, item) {
		jQuery.timer.remove(item);
	});
});

////////////////////////////////////////////////////////////////////////////////////

// FUNCTION for SMOOTH SRCOLLING
(function($) {
    $.fn.SmoothAnchors = function() {

        function scrollBodyTo(destination, hash) {

            // Change the hash first, then do the scrolling. This retains the standard functionality of the back/forward buttons.
            var scrollmem = $(document).scrollTop();
            window.location.hash = hash;
            $(document).scrollTop(scrollmem);
            $("html,body").animate({
                scrollTop: destination
            }, 1200);

        }

        if (typeof $().on == "function") {
            $(document).on('click', 'a[href^="#"]', function() {

                var href = $(this).attr("href");

                if ($(href).length == 0) {

                    var nameSelector = "[name=" + href.replace("#", "") + "]";

                    if (href == "#") {
                        scrollBodyTo(0, href);
                    }
                    else if ($(nameSelector).length != 0) {
                        scrollBodyTo($(nameSelector).offset().top, href);
                    }
                    else {
                        // fine, we'll just follow the original link. gosh.
                        window.location = href;
                    }
                }
                else {
                    scrollBodyTo($(href).offset().top, href);
                }
                return false;
            });
        }
        else {
            $('a[href^="#"]').click(function() {
                var href = $(this).attr("href");

                if ($(href).length == 0) {

                    var nameSelector = "[name=" + href.replace("#", "") + "]";

                    if (href == "#") {
                        scrollBodyTo(0, href);
                    }
                    else if ($(nameSelector).length != 0) {
                        scrollBodyTo($(nameSelector).offset().top, href);
                    }
                    else {
                        // fine, we'll just follow the original link. gosh.
                        window.location = href;
                    }
                }
                else {
                    scrollBodyTo($(href).offset().top, href);
                }
                return false;
            });
        }
    };
	
	//For Menu
	$(document).ready(function(){
  $(".menu").click(function(){
    $(".submenu").fadeToggle(200);
  });
});
})(jQuery);