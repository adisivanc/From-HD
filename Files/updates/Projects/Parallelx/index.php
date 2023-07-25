<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WRC</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menumaker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/menumaker.js"></script>
<script type="text/javascript" src="js/mainjs.js"></script>
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

	<style>
		#cssmenu {
			position: relative;
			top: 80px;
			margin: auto;
		}
	</style>


</script>
</head>

<body>

    <div class="full_width" style="position:relative; z-index:3;"><!--Slide Outer-->
    <div style="width:100%; float:left; height:860px; background:url(images/slide_texture.png) repeat; background-attachment:fixed;">
        <div id="innerslide1" class="homeSlideInner">
        	
            <div id="innerslide2" class="homeSlideInner">
            <div class="parallax_inner">
                <div class="hsContainer">
                    
                    <div class="full_width header_container">
                    	<div class="content txtwhite">
                        	<div class="header_left">September 9-11, 2015</div>
                            <div class="header_right">Kovai Medical Center and Hospital, India</div>
                        </div>
                    </div>
                    
                    <div class="full_width" style="padding-top:50px; position:fixed; z-index:2;">
                        <div class="full_width" style="background:url(images/menufull_bg.png) no-repeat center center;">
                            <div class="full_width">	
                                <div class="menu_content">
                                    <div id="cssmenu">
                                        <ul>
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">About</a></li>
                                            <li><a href="#">Speakers</a> </li>
                                            <div class="logo"><a href="#"><img src="images/logo.png" alt="" /></a></div>
                                            <li><a href="#">Team</a></li>
                                            <li><a href="#">Venue</a></li>
                                            <li><a href="#">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="content" style="position:relative; top:295px; z-index:1;">  <!--Slide Content-->       
                        <div class="full_width slide_container">
                            <div class="content">
                                <h2 class="txtbold" align="center"><strong>WELCOME TO <span style="color:#f05c68;">1WCRe</span></strong></h2>
                                <div class="header_strip"></div>
                                <h3 class="txtbold">The First World Congress on Rhenium-188</h3>
                                <h4>Explore the use of 188Re for radiotherapy for a variety of applications</h4>
                                
                                <div class="full_width slideinfo_outer">
                                	<div class="slide_info">
                                    	<table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin-left:30%;">
                                          <tr>
                                            <td width="29%" class="txtgreen info_count">12</td>
                                            <td class="info_descp">Topics <div>Innovative</div></td>
                                          </tr>
                                        </table>
                                    </div>
                                	<div class="slide_info">
                                    	<table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin:0 15%;">
                                          <tr>
                                            <td width="29%" class="txtgreen info_count">50</td>
                                            <td class="info_descp">Speakers <div>Best specialists</div></td>
                                          </tr>
                                        </table>
                                    </div>
                                	<div class="slide_info">
                                    	<table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin-right:30%;">
                                          <tr>
                                            <td width="29%" class="txtgreen info_count">200</td>
                                            <td class="info_descp">Seats <div>Register</div></td>
                                          </tr>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div><!--Slide Content-->
                
                </div>
            </div>
            </div>
            
            
        </div>
    </div>
	</div><!--Slide Outer-->
    
    
    
    

    <div style="width:100%; float:left; position:relative; margin-top:-115px; top:0px; z-index:5;">
        <img src="images/slide_bottom_img.png" alt="" style="width:100%; float:left; " />
    </div>

<div style="width:100%; float:left; height:1000px; background:url(images/bg1.jpg) repeat;">


</div>




<script type="text/javascript">
	$("#cssmenu").menumaker({
		title: "Menu",
		format: "multitoggle"
	});
</script>

    
</body>
</html>
