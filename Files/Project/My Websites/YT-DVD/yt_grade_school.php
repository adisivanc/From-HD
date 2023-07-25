<?
function main(){
?>

<div id="campus_container">
<div id="slide1" class="parallax">
<div class="parallax" style="height:auto;">
    
    <div class="slide_container topslidecamps" style="padding-top:0; padding-bottom:0; margin-top:-10px;">  	
        <? include "campus_slide.php"; ?>
    </div>

    <div class="page_menu" style="top:110px; z-index:10; padding-top:17px;">
    <div class="content">
        <div class="page_menu_container">
            
            <div class="page_menutop_outer">
            <div class="page_menutop">
                <h1 class="page_menuhd">YT Grade School</h1>
                <div class="pagemenu_right">
                    <div class="pagemenu_desctop">farmlands meet blue skies meet children</div>
                </div>
            </div>
            </div>
            
        </div>
    </div>
    </div>
    
    
 <!-- Row 1 -->   	
		
    <div class="container_full" id="grade_school" style="padding-top:20px;">
    <div class="container_full">
    <div class="campus_row1_outer nav_smooth_pos">
    <div class="content">
    
        <div class="campus_row1">
            <div class="campus_quote" style="color:#FFFFFF; background:url(images/menu_mo.jpg) repeat;">
            A school in a farm has a place in the history of education like <br/>Gandhiji's experiments with Tolstoy Farm, in South Africa, or<br/> Summer Hill by A S Neill...</div>
                
                
            <div class="campus_row1_left">
                <p>The school is set up in an organic farm. The classrooms are spacious, flooded with light, air and energy.</p>
                <p>The open-air amphitheatre is the hub of the school, where the children come together every morning for their circle time and performances; It was here that we made our 'Aarambham' by witnessing two beautiful rainbows.</p>
                <p>On the first floor children can jump out of the corridors to land in a huge hammock above the ground floor. Little caves, tunnels, hide outs and classrooms which are more outdoor than 
                indoor with spaces to look out everywhere... What meets the eye when you look outside are the amla trees, sheep grazing, ducks quacking, the endless blue skies...</p>
                <p>And a river of knowledge runs through the school like a life force connecting all the spaces together.</p>                
            </div>
    
            <div class="campus_row1_right">
                <div class="campus_row1_img">
                    <ul class="youtube-videogallery" style="float:right; margin-bottom:15px;">
                        <li><a href="https://www.youtube.com/embed/lJW0Un767k8?rel=0&amp;controls=0" id="hi"></a></li>
                    </ul>
                </div>
                <!--<div class="campus_row1_img"><a href="#"><img src="images/pros_banner.jpg" alt="View Our Prospectus" /></a></div>-->
            </div>
        </div>
        
    </div>
    </div>
    </div>
    </div>
    
    <div class="container_full" id="brand_curr">
    <div class="slide_container testimonial_slide nav_smooth_pos">  	
    <div id="innerslide8" class="homeSlideInner">
    <div class="parallax_inner">
        <div class="hsContainer">
            <? include "campus_slide2.php"; ?>
        </div>
    </div>
    </div>
    </div>
    </div>
        
        
 <!-- Row 2 -->   	
 
    <div class="campus_row2_outer">
    <div class="content">
    
        <div class="campus_row2">
            <div class="campus_row2_left">
                <p>The school offers two boards – ICSE and IGCSE and integrates the best of both worlds in the primary education program for Grades 1 - 5.</p>
                <p>The assessments are frequent and holistic where knowledge, application and skills are tested. There is an intense focus on the fundamentals of academics through programs like 
                <a class="blue">YT Fundamentals</a>. This helps them sharpen their skills and gain mastery on various subjects.</p>                     
            </div>
        </div>
        
    </div>
    </div>

</div>
</div>
</div>

<div class="popupbox" id="akka_popup" style="padding:0 20px; margin:0; display:none; font-family: 'sanchez_regularregular';"></div>


<!-- Why akka Popup -->

<? include "whyakka_popup.php"; ?>


<script type="text/javascript" src="js/jquery.youtubevideogallery.js"></script>
<script type="text/javascript" src="js/jquery.colorbox.js"></script>

<script type="text/javascript">

$(document).ready(function(){
	$("ul.youtube-videogallery").youtubeVideoGallery( {plugin:'colorbox',assetFolder:'../',thumbWidth:'auto',urlImg:'images/tour.jpg'} );
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


<?
}
include "template.php";
?>