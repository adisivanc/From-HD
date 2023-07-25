<?
function main(){
?>

<div id="campus_container">
<div id="slide1" class="parallax">
<div class="parallax" style="height:auto;">
    

    <div class="page_menu" style="top:110px; z-index:10; padding-top:17px;">
    <div class="content">
        <div class="page_menu_container">
            
            <div class="page_menutop_outer">
            <div class="page_menutop">
                <h1 class="page_menuhd">The Philosophy</h1>
                <div class="pagemenu_right">
                    <div class="pagemenu_desctop">celebrating the joy of unhurried childhood</div>
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
            <div class="campus_quote" style="color:#333333; background:none;" id="philosophy_quote">
"I am struck by the fact that the more slowly trees grow at first, the sounder they are at the <br/> core and I think that the same is true of human beings. We do not wish to see children <br/> precocious, making great strides in their early years, like sprouts, producing a soft and <br/> perishable timber. But it is better if they expand slowly at first, as if contending with <br/> difficulties, and so are solidified and perfected. Such trees continue to expand with nearly <br/> equal rapidity to extreme old age." <br/><div style="color:#83bfcc; font-weight:bold;"> - Henry David Thoreau</div>
            </div>
                
        </div>
        
    </div>
    </div>
    </div>
    </div>
    
    <div class="container_full" id="brand_curr">
    <div class="slide_container testimonial_slide nav_smooth_pos">  	
    <div id="innerslide15" class="homeSlideInner">
    <div class="parallax_inner">
        <div class="hsContainer">
            <? include "philosophy_slide2.php"; ?>
        </div>
    </div>
    </div>
    </div>
    </div>
        
        
 <!-- Row 2 -->   	
 
    <div class="philosophy_row1_outer">
    <div class="content">
    
        <div class="full_width">
            <h3>Unhurried childhood</h3>
            <p>The word Kindergarten translates as 'Child's Garden' which implies a place of beauty, growth, joy and unhurried development.
            At the Yellow Train Kindergarten we celebrate the joy of unhurried childhood.</p>
        </div>
        
        <div class="full_width">
            <h3>Protecting the forces of Childhood</h3>
            <div class="philosophy_left">
                <p>The years of childhood from birth to the change of teeth are critical for the development of a healthy physical body, without which strong intellectual development can not take place. 
                There is no scientific evidence to prove that early intellectual development leads to greater performance in later years. Instead there is great body of research to prove that the more 
                protected they are in the early years from academic pressures and intellectual knowledge the greater their potential and joy for learning in the later years.</p>
                <p>Children need to run, jump, skip, roll, climb, twist and turn.  Sometimes they just need the time to sit, watch, and dream.  Children need a dependable rhythm in the day—a time to eat, 
                a time to work, a time to play and a time to rest.  They need the space and the uninterrupted time to engage in self-initiated pretend play.  Children flourish when a nurturing adult is 
                there to provide this space and uninterrupted time for play.  They are nourished by stories that are told, verses that are recited and songs that are sung.  Life habits are instilled when 
                children can help prepare a snack, help put away the toys or learn to tend to a plant.</p>
                <p>And this is precisely what happens in our Kindergarten.</p>
            </div>
            <div class="philosophy_right">
				<img src="images/kg/philosophy_img.jpg" alt="" />
            </div>
        </div>
        
        <div class="full_width">
            <h3>The Waldorf Inspiration</h3>
            <p>Waldorf Education is unparalleled in its ability to preserve and nourish the life forces of childhood.</p>
            <p>Our Kindergarten program is inspired by Waldorf Education and the work of Rudolf Steiner. Rudolf Steiner believed that the future of each individual child depends on health giving 
            experiences in the first seven years of life. In the light of this understanding, we believe that an atmosphere of loving warmth and guidance promotes joy, wonder and reverence and 
            supports the healthy development of the child. Our kindergarten  at Yellow Train is created on this basic premise.</p>
        </div>
        
    </div>
    </div>

</div>
</div>
</div>


<div style="width:100%; float:left; margin-bottom:10px;">
<div class="content">
    <div class="contact_explore">
        <h2>What to Explore Next ?</h2>
        <ul>
            <li><a href="<?=getSeoUrl(array('pn'=>'garden_campus.php'))?>">Garden Campus</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'garden_program.php'))?>">KG Program</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'garden_teachers.php'))?>">KG Teacher</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'garden_rhythm.php'))?>">KG Rhythm</a></li>
        </ul>
    </div>
</div>
</div>

<!-- Why akka Popup -->



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