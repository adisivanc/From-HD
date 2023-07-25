<?
function main(){
?>

<div class="full_width balanced_top"></div>


<div class="full_width"> 
<div class="content">

	<div class="method_img">
    	<div class="methodimg"><img src="images/method1.jpg" alt="" class="method_float_left" /></div>
        <div class="methodimg"><img src="images/method2.jpg" alt="" /></div>
        <div class="methodimg"><img src="images/method3.jpg" alt="" class="method_float_right" /></div>
    </div>

    <div class="full_width" style="margin-top:25px; padding:5px 0;"> 
        <!--<h2 class="ytmethod_head">WALDORF METHOD</h2> -->
        <div class="ytmethod_row1left">
        	<p>The school is inspired by Rudolf Steiner and his work. Waldorf education is based on a profound understanding of human development that addresses the needs of the 
            growing childand brings 'age appropriate' content to the children that nourishes healthy growth. The Waldorf teacher strives to transform education into an art that 
            educates the whole child – the heart, the hands and the head. This is the fundamental of our methodology.</p>
        </div>
        <div class="ytmethod_row1right">
        	<!--<img src="images/methodology_img1.jpg" alt="" />-->
        </div>
    </div>

    <div class="full_width ytmethod_row2out"> 
        <!--<h2 class="ytmethod_head">MAIN LESSON BLOCKS</h2>--> 
        <div class="ytmethod_row2left">
        	<!--<img src="images/methodology_img2.jpg" alt="" />-->
            <p>The Main Lesson is the essential part of the methodology. It is an hour and half period where the subject is presented in a way to appeal to the 
            thinking, willing and feeling of the child. New information is presented using a variety of engaging and stimulating methods that relate to children 
            as individuals. Teaching in Main Lesson Blocks has become one of the most successful and distinguishing features of Waldorf Education, for it allows 
            the teachers to cover the curriculum intensively and it provides the students with the fullest possible immersion in a subject.</p>
            
            <p>Elements of rhythm and movement, verse and recitation wake the child up to the subject before the teach session ingrains the concept.This ensures 
            the children come to deskwork with heads, hearts and hands already enlivened. This is followed by an activity or doing session which is artistic and 
            appeals to the feeling of the child.Each Main Lesson is carefully and rhythmically structured to ensure that the children listen, work independently, 
            participate and think.This would include performance, painting, handwork and storytelling  and alongside writing and drawing.</p>
        	
        </div>
        <p>Manipulators and aids for Math, Creative writing and engaging role play in English, Nature stories and walks in Science are an everyday feature. </p>
        <p>A high Teacher Student ratio and individual attention to every child their needs & likes support the delivery of the curriculum.</p>
        <p>The subjects offered are English, Mathematics, Environmental Science, Drama, Hindi or Tamil, Social Studies (introduced from Grade 5). Apart from this 
        children have classes once in a week for Recorder, Handwork, Art, Mindfulness, Music, Clay and Sports.</p>
    </div>

</div>
</div>


<div class="full_width" style="padding-bottom:30px;"> 
<div class="content">
    
    <div class="contact_explore">
        <h2>What to Explore Next ?</h2>
        <ul>
            <li><a href="<?=getSeoUrl(array('pn'=>'yt_grade_school.php'))?>">The Campus</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'yt_practices.php'))?>">YT Practices</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'curriculum.php'))?>">Curriculum</a></li>
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