<?
function main(){
?>


<div class="video_container">
<video class="yt_video" autoplay>
  <source src="images/video/Final.mp4" type="video/mp4">
</video> 

<!--[if (IE) & (lt IE 9)]>
<object classid="clsid:22d6f312-b0f6-11d0-94ab-0080c74c7e95" class="yt_video" style="max-width:1920px; width:100%; height:100%; position:relative;">
  <param name="filename" value="images/video/Final.mp4"/>
  <param name="autostart" value="autostart"/>
  <param name="showcontrols" value="false"/>
  <param name="showstatusbar" value="true"/>
</object>
<![endif]-->

</div>


<div class="fund_container">


    <!--<div class="page_menu" style="padding-top:20px;">
    <div class="content">
        <div class="page_menu_container">
        
            <div class="page_menutop">
                <h1 class="page_menuhd">The Free Human Being</h1>
                <div class="pagemenu_right">
                    <div class="pagemenu_desctop" style="padding-top:5px;">Freedom, to us, means the choice and the capability<br/>to be oneself at the core, at the deepest level.</div>
                </div>
            </div>

        </div>
    </div>
    </div>-->


    <div class="container_full">
    <div class="slide_container testimonial_slide nav_smooth_pos">  	
    <div id="innerslide8" class="homeSlideInner">
    <div class="parallax_inner" style="background-image:none">
        <div class="hsContainer" style="background-color:transparent;">
            <? include "campus_slide3.php"; ?>
        </div>
    </div>
    </div>
    </div>
    </div>


    <div class="container_full free_human_outer" style="padding-top:15px;">
    <div class="campus_row1_outer nav_smooth_pos">
    <div class="content">
    
        <div class="">
            <div class="">
                <div class="campus_quote" style="margin-bottom:20px;">To be free is to be responsible <br/>To be free is to be natural <br/>To be free is to choose what is true</div>
            
                <p style="text-align:justify;">With this search being the essence of education at Yellow Train, children will experience and grow up in an environment of unconditional acceptance and it is only then can they receive, change, grow, 
                become and be. And years of childhood in an environment such as this will foster in the child the free human spirit – which is our real goal of education.</p>
            </div>
        </div> 
        
    </div>
    </div>
    </div>



	<!--<div class="fund_footer">
	<div class="content">
		<? include "yt_gettoknow.php"; ?>
        <div class="fund_footer_explore"><? include "explore_blue.php"; ?></div>                
	</div>	
	</div>-->

</div>



<script type="text/javascript">

$(window).on('scroll',function(){
	
	var winHt = $(window).height();
	var scrollVal = $(window).scrollTop();
	var nav_pos = winHt - 140;
	
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