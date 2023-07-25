<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Google Map API</title>

<!--  Add Script to Get From google Server  -->

<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyB5XTEauI4Gi-4tCFQduqv57mjC-A69ZIk&sensor=false" type="text/javascript"></script> 

</head>
<body>

<div id="container" style="width:700px; margin:100px auto;">
	<div id="map" style="width:100%; float:left; height:355px; border:0 solid #999; box-shadow:3px 4px 3px #999; "></div>
</div>

<script type="text/javascript">

/*

Get Lat Long Value from This below Site:
=======================================
1. http://itouchmap.com/latlong.html
2. http://universimmedia.pagesperso-orange.fr/geo/loc.htm

*/



	function initialize() {
		if (GBrowserIsCompatible()) {
			var map = new GMap2(document.getElementById("map")/*,
			
 			 { size: new GSize(1183,457) }*/ );
			var bounds = new GLatLngBounds();
			var venue_loc= new GLatLng(11.002682 , 77.029834);
			
			map.setUIToDefault();
			var venueIcon = new GIcon(G_DEFAULT_ICON);
			venueIcon.image = 'images/marker_sprite.png';
			venueIcon.iconSize = new GSize(57, 34);
			venueIcon.shadow = '';
			venueMarkerOptions = { icon:venueIcon };
			var venueMarker = new GMarker(venue_loc, venueMarkerOptions);
			GEvent.addListener(venueMarker, "click", function() {
            	venueMarker.openInfoWindowHtml(

			  "<div style=\"font-size:12px; width:auto; font-weight:bold; padding-top:5px;padding-bottom:8px; color:#333;\"><div style=\"font-size:16px; font-weight:bold; color:#0092d5; \">Test Mapping</div><br>No 3, KMK Nagar,<br>Singanullur,<br>Coimbatore-641045,<br>Contact : +91 422 4395332</div>"
			  
			  );
			});
			
		    map.addOverlay(venueMarker);
			bounds.extend(venue_loc);
			map.setCenter(venue_loc);
			/*map.setZoom(map.getBoundsZoomLevel(bounds) - 10);*/
			map.setZoom(15);

		}
		
	}		
	
	initialize();
	
</script>


</body>
</html>