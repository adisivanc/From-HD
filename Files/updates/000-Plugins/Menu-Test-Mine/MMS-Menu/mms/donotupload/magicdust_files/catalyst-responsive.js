(function(doc) {

	var addEvent = 'addEventListener',
	    type = 'gesturestart',
	    qsa = 'querySelectorAll',
	    scales = [1, 1],
	    meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

	function fix() {
		meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
		doc.removeEventListener(type, fix, true);
	}

	if ((meta = meta[meta.length - 1]) && addEvent in doc) {
		fix();
		scales = [.25, 1.6];
		doc[addEvent](type, fix, true);
	}

}(document));

jQuery(document).ready(function($) {

	if( $('#dropdown-nav-1-form select').length ) {
		$('#dropdown-nav-1-form select').change(function() {
			window.location = $(this).find('option:selected').val();
		});
	}
	
	if( $('#dropdown-nav-2-form select').length ) {
		$('#dropdown-nav-2-form select').change(function() {
			window.location = $(this).find('option:selected').val();
		});
	}

});