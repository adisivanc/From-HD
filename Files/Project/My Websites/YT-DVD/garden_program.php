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
                <h1 class="page_menuhd">Our Program</h1>
                <div class="pagemenu_right">
                    <div class="pagemenu_desctop">celebrating the joy of unhurried childhood</div>
                </div>
            </div>
            </div>
            
        </div>
    </div>
    </div>
    
    
 
    <div class="full_width gd_rhythm_cntr"> 
    <div class="content">
    
            
            <div class="full_width" style="padding:5px 0;"> 
                <div class="ytmethod_row1left">
                    <h3>Pushing skills before children are biologically ready sets them up to fail.</h3>
                    <p>Early childhood Education is the foundation for all that is to come in the later years in life.  Love for learning, confidence in oneself, Language skills, Thinking and 
                    Problem solving capabilities, emotional anchoring, connection with people and the world around – All these important habits, skills and attitudes develop in early childhood 
                    and it is important that the curriculum is directed towards this. Our kindergarten program comprises of the following.</p>
                </div>
            </div>

            
            <div class="full_width"> 
                <div class="full_width"> 
                    <div class="gd_program">
                        <div class="gd_program_left gd_program1"><strong>Seasons and Rhythms</strong></div>
                        <div class="gd_program_right">The monthly rhythms are guided by the seasons and what happens in nature. The rhythm sets the theme for the month. 
                        For instance during the monsoon rhythm, the morning circle is filled with songs of the rain,the stories have the themes of rain and even the seasonal 
                        craft would reflect the same. This allows children to experience the world outside through the lens of the work they do in the kindergarten.</div>
                    </div>
                
                    <div class="gd_program">
                        <div class="gd_program_left gd_program3"><strong>Language Learning</strong></div>
                        <div class="gd_program_right">The Kindergarten environment is extremely rich in language in all its myriad forms – songs, stories, verses, poems and plays.
                         There is great emphasis on presenting the language in its beautiful and lyrical form.</div>
                    </div>
                
                    <div class="gd_program">
                        <div class="gd_program_left gd_program3"><strong>Joy of Singing and Movement</strong></div>
                        <div class="gd_program_right">Movement plays an extremely vital role in the healthy development of children in their early years. Each day is filled with a lot 
                        of singing, movement and gesture plays in the morning circle that children greatly enjoy and benefit from.</div>
                    </div>
                    
                    <div class="gd_program">
                        <div class="gd_program_left gd_program3"><strong>Working with the Hand</strong></div>
                        <div class="gd_program_right">Children are exposed to various activities that engage their hands in a purposeful way. They knead dough, stitch with the matte cloth, 
                        model with clay, beeswax, do beading and are provided with many such opportunities to use their hands skilfully.</div>
                    </div>
                    
                    <div class="gd_program">
                        <div class="gd_program_left gd_program2"><strong>Imagination and Free play</strong></div>
                        <div class="gd_program_right">Children work with wooden blocks, fabric and other material that lend themselves to creative and original free play. This promotes 
                        imagination and creativity.</div>
                    </div>
                    
                    <div class="gd_program">
                        <div class="gd_program_left gd_program3"><strong>Domestic work as pedagogy</strong></div>
                        <div class="gd_program_right">Cooking, Baking, washing, cleaning, Gardening and other purposeful domestic work is actively encouraged. It has deep pedagogic significance 
                        and builds practical life skills in children.</div>
                    </div>
                    
                    <div class="gd_program">
                        <div class="gd_program_left gd_program3"><strong>Artistic Expression</strong></div>
                        <div class="gd_program_right">Art is used as a medium of expression. Children not only pursue artistic activities such as Wet on Wet painting, but also are surrounded in 
                        an environment where everything is presented in an artistic manner.</div>
                    </div>
                    
                    <div class="gd_program">
                        <div class="gd_program_left gd_program3"><strong>Celebrations and Rituals</strong></div>
                        <div class="gd_program_right">Festivals have a connection with either our culture or rhythms of nature. Celebrating festivals with an understanding of its significance 
                        builds deep roots to one's culture. Therefore festivals are celebrated with stories and rituals to establish these bonds.</div>
                    </div>
                </div>
            </div>
            
            
            <div class="full_width" style="padding:5px 0;"> 
                <!--<h2 class="ytmethod_head">WALDORF METHOD</h2> -->
                <div class="ytmethod_row1left">
                    <p>Sequencing, sensory integration, eye-hand coordination tracking, appreciating the beauty of language and other basic skills necessary for the foundation of academic 
                    excellence are fostered in the Kindergarten through all the above. In this truly natural, loving and creative environment, the children are given a range of activities 
                    and the structure that help them prepare for the next phase of school life.            
                    </p>
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
            <li><a href="<?=getSeoUrl(array('pn'=>'philosophy.php'))?>">KG Philosophy</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'garden_teachers.php'))?>">KG Teacher</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'garden_rhythm.php'))?>">KG Rhythm</a></li>
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