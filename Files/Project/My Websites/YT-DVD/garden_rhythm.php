<?
function main(){
?>




<div id="campus_container">
<div id="slide1" class="parallax">
<div class="parallax" style="height:auto;">
    
    <div class="page_menu" style="top:110px; z-index:10; padding-top:27px;">
    <div class="content">
        <div class="page_menu_container">
            
            <div class="page_menutop_outer">
            <div class="page_menutop">
                <h1 class="page_menuhd">The Daily Rhythm </h1>
                <div class="pagemenu_right">
                    <div class="pagemenu_desctop">play is real and purposeful work</div>
                </div>
            </div>
            </div>
            
        </div>
    </div>
    </div>
    
    
    <!-- Row 1 -->   	
    <div class="full_width" style="padding:25px 0 5px 0;"> 
        <div class="content">
            <div class="full_width rhythm_cnt">
                <p>Play is a very important part of the child's growing up years. What we consider as play is real <br/> and purposeful work for the children.</p>
            </div>
        </div>
    </div>
 
    <div class="full_width gd_rhythm_cntr"> 
    <div class="content">
    
        <div class="full_width">
            
			<div class="gd_rhythm">
                <div class="gd_rhythm_inner">
                	<h4>Outdoor free play</h4>
                    <p>Children play outdoors in the garden and sand pit. This is the time when children actively imitate the teacher engaged in purposeful out door work and also has the opportunity to 
                    enjoy nature. The area is set up in such a way that there are enough things to play and also enough opportunity to engage in real work like gardening.</p>
                </div>
            </div>
            
			<div class="gd_rhythm">
                <div class="gd_rhythm_inner">
                	<h4>Indoor free play</h4>
                    <p>children use the gifts of nature which we call 'toys from heaven' (seeds, feathers, leaves, pine cones etc.) and also other toys like fabric, wooden blocks, bean bags to play. 
                    Their imagination and experiences come alive in this play. </p>
                </div>
            </div>

			<div class="gd_rhythm">
                <div class="gd_rhythm_inner">
                	<h4>Morning Circle</h4>
                    <p>The teacher greets each child and brings them into a circle. The morning circle is the time to meet and greet each other and welcome the new day. It is the time for joyful movement 
                    prayers, verses and songs. The child is gently awakened with carefully planned movements which not only brings in a lot of joy but also facilitate age appropriate physical co-ordination for children.</p>
                </div>
            </div>
            
            
			<div class="gd_rhythm">
                <div class="gd_rhythm_inner">
                	<h4>Fruit time</h4>
                    <p>The children have their fruit at around 10:30 am after thanking mother earth and father sun.</p>
                	<h4>Activity</h4>
                    <p>During activity children are exposed to a different activity each day. They cook, paint, wash, clean, attend to the garden, do craft or handiwork etc.</p>
                </div>
            </div>
            

			<div class="gd_rhythm">
                <div class="gd_rhythm_inner">
                	<h4>Story Time</h4>
                    <p>The story fairyarrives after the ritual - song, candles and an inward quiet mood is created by drawing the curtains. It is narrated with a lot of joy and magic and children 
                    treasure their story time. It is also the time when the children build their listening skills.... joyfully. Stories are drawn from fables, fairy talesand folk-lore resonating 
                    with the rhythm of the month and that brings the morning to a close.</p>
                </div>
            </div>

        </div>
    
    </div>
    </div>
        

</div>
</div>
</div>



<div class="full_width" style="padding-bottom:30px;"> 
<div class="content">
    
    <div class="contact_explore">
        <h2>What to Explore Next ?</h2>
        <ul>
            <li><a href="<?=getSeoUrl(array('pn'=>'garden_campus.php'))?>">Garden Campus</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'garden_program.php'))?>">KG Program</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'garden_teachers.php'))?>">KG Teacher</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'philosophy.php'))?>">KG Philosophy</a></li>
        </ul>
    </div>
    
</div>
</div>



<script type="text/javascript">
$(".teacher").click(function(){
	 
	$('.teacher').removeClass('active');
	$(this).addClass('active');
	 
});
</script>


<?
}
include "template.php";
?>