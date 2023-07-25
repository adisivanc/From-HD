<?
function main(){

?>
<link rel="stylesheet" type="text/css" href="css/minimalform/component.css" />
<script src="js/minimalform/modernizr.custom.js"></script>
<script type="text/javascript">
$(function() {
	$(".datepicker").datepicker({
		changeMonth: true
	});  
});
</script>
<style>
.ques_progress, .ques_progress1, .ques_progress2, .ques_progress3 { width:92%; float:left; height:8px; padding:0 4%; margin-bottom:15px; }
.ques_progress_status, .ques_progress1_status, .ques_progress2_status, .ques_progress3_status { width:0; float:left; background:#999999; height:6px; -webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }
</style>

<div class="funstop_container">

    <div class="container_full">       
    <div id="innerslide5" class="homeSlideInner">
    <div class="parallax">
        <div class="hsContainer">
        <div class="content" style="position:relative;">        
            
            <div class="innerslide5_content">
                <h1 class="pagetitle" style="padding-top:0px; color:#ffffff; text-shadow:-1px -1px 2px #666666;">FUN STOP</h1>
                <p style="text-shadow:-1px -1px 2px #666666;">Checkout the recent happenings in Yellow Train</p>
            </div>
            
        </div>
        </div>
    </div>
    </div>
    </div>

    <div class="page_menu"> 
    <div class="content">
        <div class="page_menu_container">
        
            <div class="page_menutop">
                <h1 class="page_menuhd">Fun Stop</h1>
                <div class="pagemenu_right">
                    <div class="pagemenu_desctop" style="padding-top:5px;">YT always celebrates the magic of childhood <br/>by organizing fun filled events throughout the year</div>
                </div>
            </div>
            
            <div class="page_menubtm">
                <ul>
                    <li><a href="<?=getSeoUrl(array('pn'=>'funstop.php','Type'=>'events'))?>" class="funstoptab funstop_events active cursor" onclick="show_stop('events')">Upcoming Events</a></li> 
                    <li><a href="<?=getSeoUrl(array('pn'=>'funstop.php','Type'=>'gallery'))?>" class="funstoptab funstop_gallery cursor" onclick="show_stop('gallery')">Gallery</a></li> 
                    <!--<li><a class="funstop_ cursor" onclick="show_stop('video')">video</a></li>-->
                </ul>
            </div>
            
        </div>
    </div>
    </div>

	<div class="funstop_content" id="up_events_content">
    <div class="content">    
    <script src="js/minimalform/modernizr.custom.js"></script>
    		
    	<form id="theForm" class="simform" autocomplete="off">
            <div class="simform-inner">
                <ol class="questions">
                    <li>
                        <span><label for="q1">What's your name?</label></span>
                        <input id="q1" name="q1" type="text"/>
                    </li>
                    <li>
                        <span><label for="q2">What's your date of Birth? (MM/DD/YYYY)</label></span>
                        <input id="q2" name="q2" type="text"/>
                    </li>
                    <li>
                        <span><label for="q3">What's your Gender?  </label></span>
                        <input id="q3" name="q3" type="text"/>
                    </li>
                    <li>
                        <span><label for="q4">What's your address?</label></span>
                        <input id="q4" name="q4" type="text"/>
                    </li>
                    <li>
                        <span><label for="q5">What's your E-mail?</label></span>
                        <input id="q5" name="q5" type="text"/>
                    </li>
                </ol><!-- /questions -->
                <button class="submit" type="submit">Send answers</button>
                <div class="controls">
                    <button class="next"></button>
                    <div class="progress"></div>
                    <span class="number">
                        <span class="number-current"></span>
                        <span class="number-total"></span>
                    </span>
                    <span class="error-message"></span>
                </div><!-- / controls -->
            </div><!-- /simform-inner -->
            <span class="final-message"></span>
        </form>
    
    </div>
    </div>

	
    

</div>




<script src="js/minimalform/classie.js"></script>
<script src="js/minimalform/stepsForm.js"></script>

        
<script type="text/javascript">
var theForm = document.getElementById('theForm');

new stepsForm( theForm, {
	onSubmit : function( form ) {
		// hide form
		classie.addClass( theForm.querySelector( '.simform-inner' ), 'hide' );

		/*
		form.submit()
		or
		AJAX request (maybe show loading indicator while we don't have an answer..)
		*/

		// let's just simulate something...
		var messageEl = theForm.querySelector( '.final-message' );
		messageEl.innerHTML = 'Thank you! We\'ll be in touch.';
		classie.addClass( messageEl, 'show' );
	}
} );
</script>




<?
unset($_SESSION['YTRegistration']);
}
include "template.php";
?>