
<?
function main(){
?>

<div class="ytfund_container">

    

    <div class="page_menu" style="padding-top:40px;">
    <div class="content">
        <div class="page_menu_container">
        
            <div class="page_menutop">
                <h1 class="page_menuhd">YT Fundamentals</h1>
                <div class="pagemenu_right">
                    <div class="pagemenu_desctop" style="padding-top:5px;">As part of everyday rhythm children are expected to work <br/>with Language and Arithmetic during YT Fundamentals</div>
                </div>
            </div>

        </div>
    </div>
    </div>


    <div class="container_full" style="padding-top:15px;">
    <div class="campus_row1_outer nav_smooth_pos">
    <div class="content">
    
        <div class="campus_row1">
            <div class="campus_row1_left">
            	<p>The two goals for this self-directed program are the following:</p>

                <div class="campus_quote">Child masters a skill by practice, practice and more practice.<br/>Children take ownership of their own progress.</div>
				
                <h2 class="subhd" style="color:#ea8201;">Theme and Project</h2>
                	
                <p>Each month has a theme which inspires work on many areas – children gather a lot of information on it, it gives them an exposure to the subject, it helps them to look at the phenomena or the theme closely 
                and to consolidate their learning in the form of a project. The objective of the project is to enable the child to enquire, do research, gather first hand and second hand data and learn various forms of presenting 
                it. These themes cover areas which may or may not be part of the curriculum. The themes could be as diverse as seeds, cycles, rivers, endangered species and so on.</p>
                
                <p>Main Lesson Block Main lesson block is a one and half hour class only during which all academic subjects will be taught for a block of time lasting 1 to 2 weeks. Teaching in Main Lesson Blocks has become one 
                of the most successful and distinguishing features of Waldorf Education, for it allows the teachers to cover the curriculum intensively and it provides the students with the fullest possible immersion in a subject.</p>
            </div>
    
            <div class="campus_row1_right">
                <div class="campus_row1_img"><a href="<?=getSeoUrl(array('pn'=>'yt_rhythm.php'))?>"><img src="images/rhythm_btn.jpg" alt="Rhythm" /></a></div>
                <div class="campus_row1_img"><a href="#"><img src="images/tour_banner.jpg" alt="Experience the Campus - Take a Tour" /></a></div>
                <div class="campus_row1_img"><a href="#"><img src="images/pros_banner.jpg" alt="View Our Prospectus" /></a></div>
            </div>
        </div>
    </div>
    </div>
    </div>


	<div class="fund_footer" style="padding-top:0;">
	<div class="content">
		<? include "yt_gettoknow.php"; ?>
        <div class="fund_footer_explore"><? include "explore_blue.php"; ?></div>                
	</div>	
	</div>

</div>


<script type="text/javascript">

$(window).on('scroll',function(){
	
	var winHt = $(window).height();
	var scrollVal = $(window).scrollTop();
	var nav_pos = winHt - 550;
	
	if (scrollVal >= nav_pos){ 
		$('.page_menu').addClass('page_menu_active');
	}
	else{ 
		$('.page_menu').removeClass('page_menu_active');
	}
});

</script>


<?
}
include "template.php";
?>