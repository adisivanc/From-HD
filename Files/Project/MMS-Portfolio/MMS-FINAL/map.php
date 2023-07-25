
<div class="venue_map">
	<div id="c_map"></div>
</div>

<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyB5XTEauI4Gi-4tCFQduqv57mjC-A69ZIk&sensor=false" type="text/javascript"></script> 

<script type="text/javascript">

	function initialize() {
		if (GBrowserIsCompatible()) {
			var map = new GMap2(document.getElementById("c_map")/*,
			
 			 { size: new GSize(1183,457) }*/ );
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

			  "<div style=\"font-size:12px; font-weight:bold; padding-top:5px;padding-bottom:8px;\"><div style=\"font-size:15px; font-weight:bold; color:#0396cb; padding-bottom:5px; \">MASTERMIND SOLUTIONS</div> No 3, Sri Ram Colony, <br> Nanjundapuram Road, <br/>Ramanathapuram,<br/> Coimbatore - 641045<br/> Tamilnadu, India.<br/><div style=\"padding-top:7px;\">info@mastermindsolutionsonline.com</div> </div>"
			  
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
	
	
function showDetail(selVal){
	
	$('.moreDetail').hide();
	$('.mumbaiAttrsRM').show();
	
	$('#a'+selVal).hide();
	$('#m'+selVal).show();
	
}

function show_mumbai_attractions(){
	$('.venuehide').hide();
	$('.mumbai_attractions').show();	
	$(window).scrollTop(0);
}

function show_venue(){
	$('.venuehide').show();
	$('.mumbai_attractions').hide();	
	$(window).scrollTop(0);
}

</script>