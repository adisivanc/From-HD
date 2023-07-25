<link rel="stylesheet" type="text/css" href="css/bootstrap_carousel_officeslide.css" />
<script type="text/javascript" src="js/bootstrap-carousel.js"></script>

<!--[if lte IE 9]>   
<script type="text/javascript" src="js/ie-bootstrap-carousel.min.js"></script>
<script type="text/javascript" src="js/ie-bootstrap-carousel.js"></script>
<![endif]-->

<script type="text/javascript">
$(document).ready(function() {
	$('.carousel').carousel({
		 interval: 10000,
	})
});

</script>

<style type="text/css">

	#slide_bg1 { background-image:url(images/header_img_1.jpg); background-repeat:no-repeat; background-position:center; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/header_img_1.jpg', sizingMethod='scale'); }
	#slide_bg2 { background-image:url(images/header_img_2.jpg); background-repeat:no-repeat; background-position:center; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/header_img_2.jpg', sizingMethod='scale'); }
	#slide_bg3 { background-image:url(images/header_img_3.jpg); background-repeat:no-repeat; background-position:center; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/header_img_3.jpg', sizingMethod='scale'); }
	#slide_bg4 { background-image:url(images/header_img_4.jpg); background-repeat:no-repeat; background-position:center; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/header_img_4.jpg', sizingMethod='scale'); }
	#slide_bg5 { background-image:url(images/header_img_5.jpg); background-repeat:no-repeat; background-position:center; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/header_img_5.jpg', sizingMethod='scale'); }

</style>



<div id="mycarousel" class="carousel slide">
<div class="carousel-inner">

            
    <div class="item active">
       <div id="slide_bg1" class="slide_ht">
       <div class="mid_container">
            <div id="slide1_content">
                Bringing individualised<br/>
                <span>PATIENT CARE</span> close to<br/>
                evidence based medicine<br/>  
                <div class="slide1_btn"><a href="<?=getSeoUrl(array('pn'=>'aboutus.php'))?>"><img src="images/explore_keyfocus_btn.png" border="0" alt="Explore Keyfocus" style="cursor:pointer" /></a></div>
            </div>
       </div>
       </div>
    </div>
    
    <div class="item"> 
        <div id="slide_bg2" class="slide_ht">
        <div class="mid_container">
            <div id="slide2_content">
            Right dose at <span>Right Time</span><br/>
            to the <span>Right Patient</span>        
            </div>
            <div class="slide2_btn"><a href="<?=getSeoUrl(array('pn'=>'aboutus.php'))?>"><img src="images/explore_keyfocus_btn.png" border="0" alt="Explore Keyfocus" /></a></div>
        </div>
        </div>
    </div>
     
    <div class="item"> 
        <div id="slide_bg3" class="slide_ht">
        <div class="mid_container">
            <div id="slide3_content">
            Quality <span>CANCER CARE</span><br/>
            at the door-step            
            </div>
            <div class="slide3_btn"><a href="<?=getSeoUrl(array('pn'=>'aboutus.php'))?>"><img src="images/explore_keyfocus_btn.png" border="0" alt="Explore Keyfocus" /></a></div>
        </div>
        </div>
    </div>
    
    
    <div class="item"> 
        <div id="slide_bg4" class="slide_ht">
        <div class="mid_container">
            <div id="slide4_content">
            From <span>HOPE</span> to <span>REALITY</span><br/>   
            <div class="slide4_btn"><a href="<?=getSeoUrl(array('pn'=>'aboutus.php'))?>"><img src="images/explore_keyfocus_btn.png" border="0" alt="Explore Keyfocus" /></a></div>
            </div>
        </div>
        </div>
    </div>

    
    <div class="item"> 
        <div id="slide_bg5" class="slide_ht">
        <div class="mid_container">
            <div id="slide5_content">
            "The <span>FUTURE</span> may be closer<br/>
            than you <span>THINK</span><sup>"</sup>          
            </div>
            <div class="slide5_btn"><a href="<?=getSeoUrl(array('pn'=>'aboutus.php'))?>"><img src="images/explore_keyfocus_btn.png" border="0" alt="Explore Keyfocus" /></a></div>
        </div>
        </div>
    </div>


</div>
</div>


