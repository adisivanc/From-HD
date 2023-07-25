
var scrollTimer = null;

function scrollToTop( finished ) {
	var scrollPosition = jQuery( window ).scrollTop();
	jQuery( 'body,html' ).stop().animate( { scrollTop: 0 },  scrollPosition*.6, 'easeOutQuad', finished );
}

var FormDrawer = function() {
	var buttonWrap = jQuery( '#request-a-quote' );
	var buttonInner = jQuery( '.request-a-quote-inner' );
	var formDrawerWrap = jQuery( '#header-contact-form-wrap' );
	var closeString = buttonInner.data( 'close' );
	var openString = buttonInner.data( 'open' );
	return {
		switchButton: function( action ) {
			if ( action == 'close' ) {
				buttonWrap.removeClass( 'open' ).addClass( 'closed' );
				buttonInner.html( openString );
			} else if( action == 'open' ) {
				buttonWrap.removeClass( 'closed' ).addClass( 'open' );
				buttonInner.html( closeString );
			}
		},
		drawerOpen: function() {
					FormDrawer().switchButton( 'open' );
					formDrawerWrap.animate( { height: 'show' }, 600, 'easeInOutQuad' );
		},
		drawerClose: function() {
					FormDrawer().switchButton( 'close' );
					formDrawerWrap.animate( { height: 'hide' }, 600, 'easeInOutQuad' );
		}
	}
}

function toggleDrawer( event, button ) {
	event.preventDefault();
	if ( jQuery( button ).hasClass('closed') ) { 
		scrollToTop( function() {
			FormDrawer().drawerOpen();
		});
	} else {
		FormDrawer().drawerClose();
	}
}


jQuery( window ).scroll( function () {
    if (scrollTimer) {
        clearTimeout( scrollTimer );   // clear any previous pending timer
    }
    scrollTimer = setTimeout( handleScroll, 100 );   // set new timer
});

function handleScroll() {
    scrollTimer = null;
    if ( jQuery( window ).scrollTop() > ( parseInt( jQuery( '#header-contact-form' ).height() ) - 1 ) ) {
    	FormDrawer().switchButton('close');
    } else {
    	FormDrawer().switchButton('open');
    }
}