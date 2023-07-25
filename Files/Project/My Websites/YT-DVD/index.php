<?
	ob_start();
	session_start();
	include 'includes1.php';
	$PageUrlArr = explode('/',$_SERVER['SCRIPT_NAME']);
	$curpage=$PageUrlArr[2];
	
	switch($curpage)
	{
		case 'index.php':
		{
			$description='Yellow Train is a progressive school inspired by the philosophy of Rudolf Steiner. The school is also influenced by the thinking of great Teachers like Shri Aurobindo and Rabindranath Tagore.';
			$keywords='yellow train, Kinder Garten, vegetable garden, Primary & middle School, Human Being, Rudolf Steiner, Rabindranath Tagore, sensorial activities,  singing, stories, cookingTotto Chan, Santhya Vikram, Coimbatore.';
			$title='Welcome to Yellow Train, the school founded on love for children';
			break; 
		}
		default:
		{
			$description='Yellow Train is a school founded on love for children, located in Coimbatore, Tamil Nadu';
			$keywords='Free Human Beings, love for children, education, Santhya Vikram, Kinder Garten, Yellow Train School, YT , Coimbatore, Tamil Nadu,Waldorf Education System ';
			$title='Yellow Train | Kinder Garten ,Primary and middle School in Coimbatore -  Waldorf Education System.';
			break;
		}
	}

?>
<!DOCTYPE html5 PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?=$description?>" />
<meta name="keywords" content="<?=$keywords?>"  />
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/logo.png" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />
<!--[if IE 8]><link rel="stylesheet" type="text/css" href="css/style_ie8.css" /> <![endif]-->

<link rel="stylesheet" href="css/youtube-video-gallery.css" type="text/css" />
<link rel="stylesheet" href="css/test.css" type="text/css" />
<!--[if lt IE 8]>
<link href="css/youtube-video-gallery-legacy-ie.css" type="text/css" rel="stylesheet"/>
<![endif]-->

<!-- add colorbox -->
<link rel="stylesheet" type="text/css" href="css/colorbox.css" />
<style type="text/css">.easyhtml5video span{display:none}</style>
</head>

<body>

<div class="video_container">

<div class="easyhtml5video" style="position:relative;">
<video autoplay="autoplay" poster="index.files/html5video/Sequence_01_3.jpg" style="width:100%;">
<source src="index.files/html5video/Sequence_01_3.m4v" type="video/mp4" />
<source src="index.files/html5video/Sequence_01_3.webm" type="video/webm" />
<source src="index.files/html5video/Sequence_01_3.ogv" type="video/ogg" />
<source src="index.files/html5video/Sequence_01_3.mp4" />
<object type="application/x-shockwave-flash" data="index.files/html5video/flashfox.swf" style="position:relative;">
<param name="movie" value="index.files/html5video/flashfox.swf" />
<param name="allowFullScreen" value="true" />
<param name="flashVars" value="autoplay=true&amp;controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=false&amp;poster=index.files/html5video/Sequence_01_3.jpg&amp;src=Sequence_01_3.m4v" />
 <embed src="index.files/html5video/flashfox.swf" style="position:relative;"  flashVars="autoplay=true&amp;controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=false&amp;poster=index.files/html5video/Sequence_01_3.jpg&amp;src=Sequence_01_3.m4v"	allowFullScreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en" />
<img alt="Sequence 01_3" src="index.files/html5video/Sequence_01_3.jpg" style="position:absolute;left:0;" width="100%" title="Video playback is not supported by your browser" />
</object>
</video>
</div>


</div>


<!-- Menu -->

<div id="menu_outer" style="position:relative;">
<? include "template_menu.php"; ?>
</div>

<!-- Menu Ends -->

<div id="slide1" class="homeSlide" style="position:relative;">
    <div class="parallax" style="height:auto;">
    
        <div class="hsContainer" style="height:auto;">
        
        <div style="width:100%; float:left; padding-bottom:40px;">
		<div class="content">        
        	<h1 class="pagetitle">welcome to the land of free human beings</h1>
		</div>
        </div>
        
        <div style="width:100%; float:left;">
            <div id="innerslide1" class="homeSlideInner">
            <div class="parallax_inner">
                <div class="hsContainer">
                <div class="content" style="position:relative;">        
                    
                    <div class="about_quote">
                    I am blooming as a flower<br/>
                    I am fresh as the dew<br/>
                    I am solid as the mountain<br/>
                    I am firm as the earth<br/>
                    I am free<br/>
                    I am water reflecting<br/>
                    What is real, what is true;<br/>
                    And I feel there is space<br/>
                    Inside of me.<br/>
                    I am free, I am free,<br/> I am free<br/>
                    <span> – Thich Nhat Hanh</span>
                    </div>
                    
                    <!--<a href="<?=getSeoUrl(array('pn'=>'free_human_being.php'))?>" class="btn_orange">Free Human Being</a>-->
                    
                </div>
                </div>
            </div>
            </div>
        </div>
        

		<div class="content">        

            <div class="about_row1">
            <div class="about_row1_content">
                
                <p>Yellow Train is a progressive school inspired by the philosophy of Rudolf Steiner. The school is  also influenced by the thinking of great Teachers like Shri Aurobindo and Rabindranath Tagore. </p>

				<p>Located in an organic farm, on the outskirts of Coimbatore, the school is a growing community of teachers and parents in search of unhurried childhood and holistic education. Amidst green fields, orchards, amla groves, 
                cows, peacocks, and loving teachers children learn and grow joyfully.  Our academic program is intensive and creative aiming at excellence. The in-depth and rich ICSE curriculum is accentuated by the artistic and nourishing 
                element of Waldorf Education. </p>

                <p>Free thinking, responsible and skilled young individuals is our promise.</p>
                
            </div>
            </div>
            
        </div>
        </div>
            
     </div>   
</div>



<div id="slide2" class="homeSlide">
    <div class="parallax" style="height:auto;">
        <div class="hsContainer" style="height:auto;">
		<div class="content">        
        
        	<h1 class="pagetitle" style="color:#ffffff; text-align:left;">From the Founder's Desk</h1>
        	
            <div class="founder_container">
                <div class="founder_desc">
                	<h2 class="subhd bgtransperant htwhite" style="font-weight:700; color:#ffffff; text-shadow:-1px -1px 0px #000000; letter-spacing:-1;">Ms. Santhya Vikram</h2>
                    
                    <p>I read this book when I was 12 or may be 14. <span class="htwhite">"Totto Chan"</span> It is a moving tale of one man's endearing love for children. In his school in Japan,'Tomoe Gakuen', children study in an abandoned railroad carriage in a magical setting unaware of the imminent war outside. In their later years, these children could shine through the darkness, they were thrown into, strengthened by the love the headmaster had for them and the fond memories of their school.</p>
                    
                    <p>I grew up wanting to build a school like that. I dreamt of a place for children where they will be loved and nourished and celebrated for who they are, irrespective of anything else. Many years later in my search for an educational philosophy, I met the work of <span class="htwhite">Rudolf Steiner</span>, that resonated deeply with my own convictions.</p>
                    
                    <p>Yellow Train is a realisation of that dream for a space where children will belong, will create a future for themselves and learn to give to the world. I have immense gratitude to the forces of the universe that has made this a possibility.</p>
                    
                    <p>Today when you walk into Yellow Train, you will meet the soul of the school, hidden in the laughter of the children, the happy faces of the teachers and the warmth of the shared energy. </p>
                    
                    <p>I invite you to watch this film that will transport you to <span class="htwhite">'our world'</span>  for those few minutes.</p>
					
                    <div class="full_width">
                    <div class="view_film_btn">
                        <ul class="youtube-videogallery" style="float:left; margin-bottom:15px;">
                            <li><a href="https://www.youtube.com/embed/6aVy1pGcnpo?rel=0&amp;controls=0" id="hi"></a></li>
                        </ul>
                    </div>
                    </div>
                        
					<!--<div style="" class="btnouter"><a href="<?=getSeoUrl(array('pn'=>'free_human_being.php'))?>"><div style="padding:12px 45px; background:#ce9f38 url(images/pattern_1.jpg); color:#000000; cursor:pointer; float:right; margin-bottom:25px; box-shadow:2px 2px 7px #996600;">Click here to view the film</div></a></div>-->
                </div>
        	</div>
            
            <? // include "yt_gettoknow.php"; ?>
            
                        
                <div class="school_titlebar" style="color:#ffffff;">Get to know Yellow Train</div>
                <div class="type_outer">
                    <div class="school_type school_type1" onclick="show_kindergarden()" style="cursor:pointer;">
                        <img src="images/img1.jpg" alt="Kinder Garten" /> 
                        <h2>Kinder Garten</h2>
                    </div>
                    <div class="school_type school_type2" onclick="show_primarypopup()" style="cursor:pointer;">
                        <img src="images/img2.jpg" alt="Primary School" /> 
                        <h2>Primary School</h2>
                    </div>
                    <div class="school_type school_type3" onclick="show_middlepopup()" style="cursor:pointer;">
                        <img src="images/img3.jpg" alt="Middle School" />
                        <h2>Middle School</h2>
                    </div>
                </div>
        	
        </div>
        </div>
        
        </div>
        
        
    </div>
</div>



<div class="popupbox popupbox_outer" id="kindergarden_popup" style="display:none; background: url(images/teacher_popup_bg.jpg) repeat; padding:15px 20px; margin:0; font-family: 'LetterGothicMTStd';">
<div class="yt_popup_outer">
	<img src="images/close_icon.png" class="popupclosebtn" onclick="close_kindergarden_popup()" alt="Close" title="Close" />
	<h2 class="whyakka_hd">Kinder Garten</h2>

	<div class="whyakka_popup_desc">
 	<div class="shad_top"></div>
    <div class="shad_btm"></div>
    	<div id="indexpop_parag1">		
            <p>Children play with wooden blocks, pine cones and fabric,</p>
            <p>They are busy building sandcastles,</p>
            <p>They are tending to their plants and walking in the garden,</p>
            <p>They are washing clothes and hanging them in the clothesline,</p>
            <p>A candle is lit and a beautiful story comes to life with children cuddled around the teacher,</p>
            <p>There is warm smell of food from the kitchen,</p>
            <p>All of this in the background of joyful singing and chattering by the children…</p>
            <p class="poplast_parag">This is life in our kindergarten.</p>
            <div class="indexpop_padd"></div>
        </div>
    </div>
    <img src="images/img11.jpg" alt="Kinder Garten" class="whyakkaimg" />
</div>
</div>


<div class="popupbox popupbox_outer" id="primary_popup" style="display:none; background: url(images/teacher_popup_bg.jpg) repeat; padding:15px 20px; margin:0; font-family: 'LetterGothicMTStd';">
<div class="yt_popup_outer">
	<img src="images/close_icon.png" class="popupclosebtn" onclick="close_primary_popup()" alt="Close" title="Close" />
	<h2 class="whyakka_hd">Primary School</h2>

	<div class="whyakka_popup_desc">
 	<div class="shad_top"></div>
    <div class="shad_btm"></div>
    	<div id="indexpop_parag2">		
            <p>Get down from the bus and greet 'buddy' our dog, the ducks and the chicks.</p>
            <p>Oh it is hot idli and sambar this morning for breakfast,</p>
            <p>Tossing beanbags, stamping and marching to a verse and some singing and greeting too </p>
            <p>Ruskin Bond, naming and doing words, the multiplication wheel, maps and globes, fraction tree, form drawing- lot of new things to learn in the main lesson</p>
            <p>The head can rest now. It is time for singing Assembly, recorder lessons, wool and needle, clay, paints and brushes.</p>
            <p>Sharing secrets in the tunnel, conversations with akkas </p>
            <p>Catching beetles, collecting stones and feathers, a tractor ride sometimes…</p>
            <p class="poplast_parag">This is life in our Primary School.</p>
            <div class="indexpop_padd"></div>
        </div>
    </div>
    <img src="images/img21.jpg" alt="Kinder Garten" class="whyakkaimg" />
</div>
</div>


<div class="popupbox popupbox_outer" id="middle_popup" style="display:none; background: url(images/teacher_popup_bg.jpg) repeat; padding:15px 20px; margin:0; font-family: 'LetterGothicMTStd';">
<div class="yt_popup_outer">
	<img src="images/close_icon.png" class="popupclosebtn" onclick="close_middle_popup()" alt="Close" title="Close" />
	<h2 class="whyakka_hd">Middle School</h2>

	<div class="whyakka_popup_desc">
 	<div class="shad_top"></div>
    <div class="shad_btm"></div>
    	<div id="indexpop_parag3">	
            <p>A run in the fields before chattering over breakfast</p>
            <p>Homework and projects to be submitted, intense discussions during circle times, group work to make posters on organic farming </p>
            <p>Self study, writing haiku poetry, experiments, geometry workshop.</p>
            <p>Loud voices in the field, cheering for the goal, sweaty faces and palms</p>
            <p>Rehearsals for the play, house captain meetings, Presentation for the student assembly.</p>
            <p>Ghost stories at the Night school,eating potatoes by the bon fire, pranks and fun in the boy - girl camps,negotiating with the annas and the akkas.</p>
            <p>Cooking for the whole school, water conservation,term end traveling…</p>
            <p class="poplast_parag">This is life in our Middle School. </p>   	
            <div class="indexpop_padd"></div>
        </div>
    </div>
    <img src="images/img31.jpg" alt="Kinder Garten" class="whyakkaimg" />
</div>
</div>


<? include "footer.php"; ?>

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>

<script type="text/javascript" src="js/jquery.youtubevideogallery.js"></script>
<script type="text/javascript" src="js/jquery.colorbox.js"></script>

<script type="text/javascript" src="js/flaunt.js"></script>
<script type="text/javascript" src="js/mainjs.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>
<script type="text/javascript" src="js/html5ext.js"></script>




<!--- Index Popup ---->

<script type="text/javascript">

$(document).ready(function(){
	$("ul.youtube-videogallery").youtubeVideoGallery( {plugin:'colorbox',assetFolder:'../',thumbWidth:'auto',urlImg:'images/view_the_film.png'} );
});


function show_kindergarden(){
	
  	$("#kindergarden_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_kindergarden_popup(){  $("#kindergarden_popup").dialog('close');  }


function show_primarypopup(){
	
  	$("#primary_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_primary_popup(){  $("#primary_popup").dialog('close');  }


function show_middlepopup(){
	
  	$("#middle_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_middle_popup(){  $("#middle_popup").dialog('close');  }

</script>

<!--- Index Popup ---->




<script type="text/javascript">

$(window).on('scroll load',function(){
	
	var winHt = $(window).height();
	var winWt = $(window).width();
	var scrollVal = $(window).scrollTop();
	var nav_pos = winHt - 150;
	
	
	if(winWt>767)
	{
		if (scrollVal >= nav_pos){ 
			$('.menu_container').removeClass('menu_pos_default');
			$('.menu_container').addClass('fixed');
			$('.menubg_top').show();
		}
		else{ 
			$('.menu_container').removeClass('fixed');
			$('.menu_container').addClass('menu_pos_default');
			$('.menubg_top').hide();
		}
	}else{
		$('.menu_container').addClass('fixed');
		$('.menubg_top').show();
	}
	
});


$('.nav_item_btm').click(function(event) {
	event.preventDefault();
	var target = $(this).find('>a').prop('hash');
	$('html, body').animate({
		scrollTop: $(target).offset().top
	}, 700);
});



/* --- Wecome Readmore ----- */

$('.wel_readmore').click(function(){
	$('.welcome_det').slideToggle(500);
	$('.about_row1_footer').slideToggle(520);

	setTimeout(function(){ 
		if($('.welcome_det').is(':visible')==true){
			$('.wel_readmore').text('Hide Details');
		}else{
			$('.wel_readmore').text('Read more...');
		}
	
	},550);
});



$('.nav-list').mouseover(function(){
	var winHt = $(window).height();
	var scrollVal = $(window).scrollTop();
	
	if(scrollVal<200){
		$('.nav-submenu').addClass('reverse_nav');
	}else{
		$('.nav-submenu').removeClass('reverse_nav');
	}
});


	
var cboxOptions = {
  width: '95%',
  height: '95%',
  maxWidth: '960px',
  maxHeight: '960px',
}

$('.cbox-link').colorbox(cboxOptions);


$(document).ready(function(){
    $.colorbox.resize({
      width: window.innerWidth > parseInt(cboxOptions.maxWidth) ? cboxOptions.maxWidth : cboxOptions.width,
      height: window.innerHeight > parseInt(cboxOptions.maxHeight) ? cboxOptions.maxHeight : cboxOptions.height
    });
});	

$(window).resize(function(){
    $.colorbox.resize({
      width: window.innerWidth > parseInt(cboxOptions.maxWidth) ? cboxOptions.maxWidth : cboxOptions.width,
      height: window.innerHeight > parseInt(cboxOptions.maxHeight) ? cboxOptions.maxHeight : cboxOptions.height
    });
});	


</script>


</body>
</html>