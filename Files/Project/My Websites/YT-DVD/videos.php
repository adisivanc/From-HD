<?
function main(){
?>


<script src="js/jquery.youtubevideogallery.js"></script>
<link rel="stylesheet" href="css/youtube-video-gallery.css" type="text/css"/>
<link rel="stylesheet" href="css/test.css" type="text/css"/>
<!--[if lt IE 9]>
<link href="css/youtube-video-gallery-legacy-ie.css" type="text/css" rel="stylesheet"/>
<![endif]-->

<!-- add colorbox -->
<link rel="stylesheet" href="css/colorbox.css" />
<script src="js/jquery.colorbox.js"></script>


<div class="full_width balanced_top"></div>

<div class="full_width press_container"> 
<div class="content">

    <ul class="youtube-videogallery" id="ytvideos_container">
        <li><a href="https://www.youtube.com/embed/7NPvQboqlnI?rel=0&amp;controls=0">YT Introduction</a></li>
        <li><a href="https://www.youtube.com/embed/6aVy1pGcnpo?rel=0&amp;controls=0">Experience YT World</a></li>
    </ul>

</div>
</div>


<script type="text/javascript">

$(document).ready(function(){
	$("ul.youtube-videogallery").youtubeVideoGallery( {plugin:'colorbox',assetFolder:'images'} );
	setFooter();
});

$(window).resize(function(){ setFooter(); });
	
function setFooter(){
	var winWid = $(window).width();
	
	if(winWid>1199){
		$('.footer_outer').css({'position':'absolute','bottom':'0'});
	}else{
		$('.footer_outer').css({'position':'relative'});
	}
}	
	
	
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