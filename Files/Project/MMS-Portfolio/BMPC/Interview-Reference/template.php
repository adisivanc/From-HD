<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" ng-app="app">
<head>
<title>BMPC</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="robots" content="index, follow" />

<link rel="icon" href="images/title_logo.png" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" media="all" />

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/example.css">
<link rel="stylesheet" href="css/dynamic-height.css">

<link rel="stylesheet" type="text/css" href="css/menumaker.css">


<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>

<script src="js/dev_deps.js"></script>
<script src="//maps.googleapis.com/maps/api/js?sensor=false"></script>

<script data-require="angular.js@1.2.x" src="js/angular.js" ></script>
<script src="js/lodash.underscore.js"></script>
<script src="js/angular-google-maps.js"></script>
<script src="js/dynamic-map-height.js"></script>

<script src="js/menumaker.js"></script>

</head>
<body>


<div class="full_width">

    <div class="full_width header">
        <div class="full_width headerbg">
            <div class="content">
                <div class="logo"> <img src="images/bmpc_logo.png" alt="" /> </div>
                <div class="gns"> <img src="images/gns_banner.png" alt="" /> </div>
            </div>
        </div>
    </div>
    
    <div class="full_width bg_strip_outer"><div class="full_width bg_strip"></div></div>
    
    <!-- Map -->
    <div class="full_width full_map">
    
        <div class="bg_map">
            <div data-ng-controller="ctrl" class="middle">
                <ui-gmap-google-map id="map" center="map.center" pan="map.pan" zoom="map.zoom" draggable="true" refresh="map.refresh" options="{ scrollwheel: false, streetViewControl: false }"
                                    events="map.events" bounds="map.bounds">
            
                    <ui-gmap-map-control position="top-right" index="1" controller="mapWidgetCtrl"></ui-gmap-map-control>
            
                    <ui-gmap-free-draw-polygons polygons="map.polys" draw="map.draw" ></ui-gmap-free-draw-polygons>
                </ui-gmap-google-map>
                
                <ul> <li ng-repeat="p in map.polys">{{p.getPath()}}</li> </ul>
                
                
                <div class="book_form_outer">
                    <div class="form_outer">
                        <div class="booking_form">
                            3
                        </div>
                    </div>
                </div>
                
            </div>
            
            
        </div>
        
    </div>
    <!-- Map -->
    
    
    <!-- Menu -->
    <div class="full_width menu_cntr">	
        <div class="content">
            
            <div class="menu_part">
                <div id="cssmenu">
                    <ul>
                        <li><a href="#">Airports We Serve</a></li>
                        <li><a href="#">Our Fleet</a></li>
                        <li><a href="#">Drive with us</a></li>
                        <li><a href="#">Manage your Reservation</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
            </div>

            <div class="social_icon">
                <a href="#"><img src="images/fb_icon.png" alt="" /></a>
                <a href="#"><img src="images/twitter_icon.png" alt="" /></a>
                <a href="#"><img src="images/gplus-Icon.png" alt="" /></a>
            </div>
            
        </div>
    </div>
	<!-- Menu -->

</div>




<div class="full_width main_content">
	gdsgds
</div>







<script type="text/javascript">

$(document).ready(function(){
	var total_window;
	var h1=$(".headerbg").height();
	var h2=$(".bg_strip").height();
	var h3=$(".menu_cntr").height();
	
	var h=h1+h2+h3+38;
	
	total_window = $(window).height();
	var x= total_window-h;
	$(".middle").height(x+"px");
});


$(window).on("scroll click", function() {
	
	var h3=$(".menu_cntr").height();
	var scroll_ht = $(window).height();
	
	var h = scroll_ht-h3-164;
	
	if ($(window).scrollTop() > h && $(window).width()>640) {
		$(".menu_cntr").addClass("headerscroll");
		$(".main_content").addClass("pad");
	} else {
		$(".menu_cntr").removeClass("headerscroll");
		$(".main_content").removeClass("pad");
	}
});


</script>

</body>
</html>