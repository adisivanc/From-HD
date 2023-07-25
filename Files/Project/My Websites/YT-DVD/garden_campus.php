<?
function main(){
?>

<div id="campus_container">
<div id="slide1" class="parallax">
<div class="parallax" style="height:auto;">
    
    <div class="slide_container topslidecamps" id="campuslide" style="padding-top:0; padding-bottom:0; margin-top:-10px;">  	
        <? include "philosophy_slide.php"; ?>
    </div>
 
    <div class="page_menu" style="top:110px; z-index:10; padding-top:17px;">
    <div class="content">
        <div class="page_menu_container">
            
            <div class="page_menutop_outer">
            <div class="page_menutop">
                <h1 class="page_menuhd">Garden Campus</h1>
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
            <div class="campus_quote" style="color:#FFFFFF; background:url(images/menu_mo.jpg) repeat;" id="philosophy_quote">
                "The most effective kind of education is that a child should <br/> play amongst a beautiful environment" - Plato
            </div>
                
        </div>
        
    </div>
    </div>
    </div>
    </div>
    
        
        
 <!-- Row 2 -->   	
 
    <div class="philosophy_row1_outer">
    <div class="content">
    
        
        <div class="full_width">
            <div class="garden_left">
                <h4>Nature as a Teacher</h4>
                <p>Children  enjoy a rich outdoor life with  <br/>
                a large Gulmohar tree and an even larger copper pod tree that defines our garden,<br/>
                grass, pebbles, sand pit, kitchen garden, flower beds and peacock visitors, <br/>
                a tree House, bogeys of a yellow train, wooden stumps and play houses.</p>
                
                <h4>Warm and Imaginative environment</h4>
                
                <p id="garden_quotes">
                    "There was a child went forth every day; <br/>
                    And the first object he look'd   upon, <br/>
                    that object he became; <br/>
                     And that object became part of him for the day,  <br/>
                    or a certain part of the day,  <br/>
                    or for many years, or stretching cycles of years." <br/>
                    <span>- Walt Whitman</span> 
                </p>
                
            </div>
            <div class="garden_right">
				<img src="images/kg/yt_campus.jpg" alt="" />
            </div>
        </div>
        
        <div class="full_width">
            <p>The indoor environment is artistically created to meet the needs of their imaginative play.</p>
            <p>Dolls and doll houses.</p>
            <p>Wooden blocks that can become castles, houses, cars or stables.</p>
            <p>Fabric, seeds, bean bags, paints and pine cones to nurture their imagination.</p>
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
            <li><a href="<?=getSeoUrl(array('pn'=>'philosophy.php'))?>">KG Philosophy</a></li>
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