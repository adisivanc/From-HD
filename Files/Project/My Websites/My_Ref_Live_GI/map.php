
<div class="venue_map" style="margin:0 0 0 0; ">
	<div id="c_map"></div>
</div>

<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyB5XTEauI4Gi-4tCFQduqv57mjC-A69ZIk&sensor=false" type="text/javascript"></script> 

<script type="text/javascript">

	function initialize() {
		if (GBrowserIsCompatible()) {
			
			var mapOptions = {
			scrollwheel: false
			}

			var map = new GMap2(document.getElementById("c_map"), mapOptions);
			var bounds = new GLatLngBounds();
			var venue_loc= new GLatLng(10.993835, 76.996561);  
 	
			map.setUIToDefault();
			var venueIcon = new GIcon(G_DEFAULT_ICON);
			venueIcon.image = 'images/marker_sprite.png';
			venueIcon.iconSize = new GSize(57, 34);
			venueIcon.shadow = '';
			venueMarkerOptions = { icon:venueIcon };
			var venueMarker = new GMarker(venue_loc, venueMarkerOptions);
			GEvent.addListener(venueMarker, "click", function() {
              venueMarker.openInfoWindowHtml(

			  "<div style=\"font-size:14px; padding-top:5px; font-family: 'latosemibold'; padding-bottom:8px;\"><div style=\"font-size:16px; font-weight:bold; color:#f05c68; padding-bottom:5px; \"> GREEN INDIA ECO PRODUCTS </div> 394-A, Nanjundapuram Road, <br/> Ramanathapuram, <br/> Coimbatore - 641 045. <br> Tamilnadu, India. <br/>Phone : +91 97870 97970, +91 95004 08880  </div>"
			  
			  );
			});
			
		    map.addOverlay(venueMarker);
			bounds.extend(venue_loc);
			map.setCenter(venue_loc);
			/*map.setZoom(map.getBoundsZoomLevel(bounds) - 10);*/
			map.setZoom(15);
			map.disableScrollWheelZoom();
		}
	}		
	initialize();
	
	

</script>