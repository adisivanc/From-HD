<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WCR</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menumaker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/menumaker.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="js/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="js/jquery.scrollTo-1.4.2-min.js"></script>


<script type="text/javascript">
$(document).ready(function(){
	$('#nav').localScroll(800);
	//.parallax(xPosition, speedFactor, outerHeight) options:
	//xPosition - Horizontal position of the element
	//inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
	//outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
	$('#intro').parallax("50%", 0.1);
	$('#second').parallax("50%", 0.1);
	$('.bg').parallax("50%", 0.4);
	$('#third').parallax("50%", 0.3);

})

</script>

<style>
	#cssmenu {
		position: relative;
		top: 80px;
		margin: auto;
	}
</style>
</head>

<body>



	<div id="intro">
        <div style="background:url(images/slide_right.png) repeat center right fixed; position:relative; z-index:9;">
        	
            <div style="width:100%; float:left; position:fixed; z-index:999px;">
                <div style="width:35%; float:left; background:#4f4f4f; height:47px; position:relative; z-index:10;">
                    <img src="images/top_left.png" alt="" style="position:absolute; right:-57px;" />
                </div>
                
                <div style="width:35%; float:right; background:#4f4f4f; height:47px; position:relative; z-index:10;">
                    <img src="images/top_right.png" alt="" style="position:absolute; left:-57px;" />
                </div>
            </div>

            
            <div style="width:100%; float:left; padding-top:120px; position:fixed; z-index:12;">	
                <div id="cssmenu">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Speakers</a> </li>
                        <li><img src="images/menu_left3.png" alt="" /></li>
                        <div style="position:relative; background-color:rgba(0, 0, 0, 0); float:left; top:-25px; padding:0 26px; ">
                        <a href="#"><img src="../ROOT BACKUP/Training/Adisivan/jquery-parallax-1.1.3/image/logo.png" alt="" /></a></div>
                        <li><img src="images/menu_right.png" alt="" /></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Venue</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
            
            
            
            <div style="background:url(images/slide_layer1.png) repeat left center local; padding-top:100px; position:relative; z-index:9;">
                <div class="story">
                    <div style="width:100%; float:left; padding-top:120px;">
                        <h2 style=" font-size:72px; color:#4f4f4f; letter-spacing:-3px; " align="center"><strong>WELCOME TO <span style="color:#f05c68;">1WCRe</span></strong></h2>
                        <p style="color:#4f4f4f; font-size:40px; text-align:center;">The First World Congress on Rhenium-188</p>
                        <p style="color:#46628b; font-size:32px; text-align:center;">Explore the use of 188Re for radiotherapy for a variety of applications</p>
                        
                        <div style="width:100%; float:left;">
                        	<div style="width:33.3%; float:left;">
                            	
                            </div>
                        	<div style="width:33.3%; float:left;">
                            
                            </div>
                        	<div style="width:33.3%; float:left;">
                            
                            </div>
                        </div>
                        
                    </div>
                </div> <!--.story-->
            </div> 
        </div>
	</div> <!--#intro-->


    <img src="images/slide_bottom.png" alt="" width="100%" style="position:relative; z-index:-1;" />


	<div id="second">
		<div class="story"><div class="bg"></div>
	    	<div class="float-right">
	            <h2>Multiple Backgrounds</h2>
	            <p>The multiple backgrounds applied to this section are moved in a similar way to the first section -- every time the user scrolls down the page by a pixel, the positions of the backgrounds are changed.</p>
	            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nibh erat, sagittis sit amet congue at, aliquam eu libero. Integer molestie, turpis vel ultrices facilisis, nisi mauris sollicitudin mauris, volutpat elementum enim urna eget odio. Donec egestas aliquet facilisis. Nunc eu nunc eget neque ornare fringilla. Nam vel sodales lectus. Nulla in pellentesque eros. Donec ultricies, enim vitae varius cursus, risus mauris iaculis neque, euismod sollicitudin metus erat vitae sapien. Sed pulvinar.</p>
	        </div>
	    </div> <!--.story-->
	    
	</div> <!--#second-->
	
	<div id="third">
		<div class="story">
	    	<div class="float-left">
	        	<h2>What Happens When JavaScript is Disabled?</h2>
	            <p>The user gets a slap! Actually, all that jQuery does is moves the backgrounds relative to the position of the scrollbar. Without it, the backgrounds simply stay put and the user would never know they are missing out on the awesome! CSS2 does a good enough job to still make the effect look cool.</p>
	        </div>
	    </div> <!--.story-->
	</div> <!--#third-->
	
	<div id="fifth">
		<div class="story">
		    <p>Check out my new plugin <a href="http://www.sequencejs.com" title="Sequence.js">Sequence.js</a> for parallax effects and a whole lot more!</p>
	        
	        <h2>Ian Lunn</h2>
	        <ul>
	            <li><strong>Twitter</strong>: <a href="http://www.twitter.com/IanLunn" title="Follow Ian on Twitter">@IanLunn</a></li>
	            <li><strong>GitHub</strong>: <a href="http://www.github.com/IanLunn" title="Follow Ian on GitHub">IanLunn</a></li>
	            <li><strong>Website</strong>: <a href="http://www.ianlunn.co.uk/" title="Ian Lunn Design">www.ianlunn.co.uk</a></li>
	        </ul>
	        
	        <p>This demo is based on the <a href="http://www.nikebetterworld.com" title="Nike Better World">Nikebetterworld.com</a> website.</p>
	        
	        <h2>Credits</h2>
	        <p>This plugin makes use of some scripts and images made by others:</p>
	        <ul>
	        	<li><a href="http://flesler.blogspot.com/2007/10/jqueryscrollto.html" title="jQuery ScrollTo">jQuery ScrollTo</a></li>
	            <li><a href="http://downloads.dvq.co.nz/" title="Background Textures">Wooden and Pyschedlic Background Textures</a></li>
	            <li><a href="http://www.sxc.hu/photo/931435" title="Trainers Image">Trainers Image</a></li>
	            <li><a href="http://www.sxc.hu/photo/1015485" title="Basketball Image">Basketball Image</a></li>
	            <li><a href="http://www.sxc.hu/photo/563767" title="Bottles Image">Bottles Image</a></li>
	        </ul>
	    </div> <!--.story-->
	</div> <!--#fifth-->


</body>
</html>