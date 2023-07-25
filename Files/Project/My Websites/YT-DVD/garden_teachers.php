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
                <h1 class="page_menuhd">The Kindergarten Teacher</h1>
                <div class="pagemenu_right">
                    <div class="pagemenu_desctop">celebrating the joy of <br/> unhurried childhood</div>
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
                The early childhood teacher works with the young child first by creating a warm, beautiful <br/> and loving home-like environment, which is protective and secure and where things <br/> happen in a predictable, regular manner. 
            </div>
                
        </div>
        
    </div>
    </div>
    </div>
    </div>
    
        
 
 
<div class="full_width"> 
<div class="content">

	
    
    
    <div class="full_width" style="padding:5px 0;"> 
        <!--<h2 class="ytmethod_head">WALDORF METHOD</h2> -->
        <div class="ytmethod_row1left">
            <p>Here she responds to the developing child in two basic ways.
            Firstly, the teacher engages in domestic, practical and artistic activities that the children can readily imitate (for example, baking, painting, gardening and handicrafts),
            adapting the work to the changing seasons and festivals of the year.
            </p>
        </div>
    </div>
    
    
    <div class="method_img">
    	<div class="methodimg"><img src="images/kg/teacher_01.jpg" alt="" class="method_float_left" /></div>
        <div class="methodimg"><img src="images/kg/teacher_02.jpg" alt="" /></div>
        <div class="methodimg"><img src="images/kg/teacher_03.jpg" alt="" class="method_float_right" /></div>
    </div>

    <div class="full_width" style="margin-top:25px; padding:5px 0;"> 
        <!--<h2 class="ytmethod_head">WALDORF METHOD</h2> -->
        <div class="ytmethod_row1left">
        	<p>Secondly, the teacher nurtures the children's power of imagination particular to the age. She does so by telling carefully selected stories and by encouraging free play. 
            This free or fantasy play, in which children act out scenarios of their own creation, helps them to experience many aspects of life more deeply. </p>
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
            <li><a href="<?=getSeoUrl(array('pn'=>'philosophy.php'))?>">KG Philosophy</a></li>
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