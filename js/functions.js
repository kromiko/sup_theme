/**
 * Functionality specific to Twenty Thirteen.
 *
 * Provides helper functions to enhance the theme experience.
 */

( function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );

	/**
	 * Adds a top margin to the footer if the sidebar widget area is higher
	 * than the rest of the page, to help the footer always visually clear
	 * the sidebar.
	 */
	$( function() {
		if ( body.is( '.sidebar' ) ) {
			var sidebar   = $( '#secondary .widget-area' ),
			    secondary = ( 0 == sidebar.length ) ? -40 : sidebar.height(),
			    margin    = $( '#tertiary .widget-area' ).height() - $( '#content' ).height() - secondary;

			if ( margin > 0 && _window.innerWidth() > 999 )
				$( '#colophon' ).css( 'margin-top', margin + 'px' );
		}
	} );

	/**
	 * Enables menu toggle for small screens.
	 */
	( function() {
		var nav = $( '#site-navigation' ), button, menu;
		if ( ! nav )
			return;

		button = nav.find( '.menu-toggle' );
		if ( ! button )
			return;

		// Hide button if menu is missing or empty.
		menu = nav.find( '.nav-menu' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		$( '.menu-toggle' ).on( 'click.twentythirteen', function() {
			nav.toggleClass( 'toggled-on' );
		} );
	} )();

	/**
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.twentythirteen', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
				element.tabIndex = -1;

			element.focus();
		}
	} );

	/**
	 * Arranges footer widgets vertically.
	 */
	if ( $.isFunction( $.fn.masonry ) ) {
		var columnWidth = body.is( '.sidebar' ) ? 228 : 245;

		$( '#secondary .widget-area' ).masonry( {
			itemSelector: '.widget',
			columnWidth: columnWidth,
			gutterWidth: 20,
			isRTL: body.is( '.rtl' )
		} );
	}
} )( jQuery );

/*ACCORDION*/
jQuery(document).ready(function($){
	jQuery('.accordion').accordion({
			 active: '.active',
			 selectedClass: 'active',
			 header: "dt",
			 clearStyle: true,
			 autoHeight: false,
			 collapsible: true
		});
	var widgetHeigth = parseInt(jQuery('#tickets_rms-widget-2 > div.rms_item').css('height'));
	var widgetTitleHeight = parseInt(jQuery('#tickets_rms-widget-2 h3.widget-title').css('height'));
	var totHeight = widgetHeigth + widgetTitleHeight + 50;
	jQuery('#tickets_rms-widget-2').css({'height':totHeight+'px', 'overflow':'hidden'});
	jQuery('#tickets_rms-widget-2').append('<a id="show_all">Show more</a>');
	jQuery('#tickets_rms-widget-2 div.rms_item:first hr').css('visibility', 'hidden');
	jQuery('#tickets_rms-widget-2 #show_all').click(function() {
		if (jQuery('#tickets_rms-widget-2 #show_all').html() == 'Show more') {
			jQuery('#tickets_rms-widget-2').css({'height':'auto'});
			jQuery('#tickets_rms-widget-2 div.rms_item:first hr').css('visibility', 'visible');
			jQuery('#tickets_rms-widget-2 #show_all').html('Show less');
		} else {
			jQuery('#tickets_rms-widget-2').css({'height':totHeight+'px'});
			jQuery('#tickets_rms-widget-2 div.rms_item:first hr').css('visibility', 'hidden');
			jQuery('#tickets_rms-widget-2 #show_all').html('Show more');
		}
	})
	
	var widgetHeigth1 = parseInt(jQuery('#tickets_rms-widget-3 > div.rms_item').css('height'));
	var widgetTitleHeight1 = parseInt(jQuery('#tickets_rms-widget-3 h3.widget-title').css('height'));
	var totHeight1 = widgetHeigth1 + widgetTitleHeight1 + 39;
	jQuery('#tickets_rms-widget-3').css({'height':totHeight1+'px', 'overflow':'hidden'});
	jQuery('#tickets_rms-widget-3').append('<a id="show_all">Show more</a>');
	jQuery('#tickets_rms-widget-3 div.rms_item:first hr').css('visibility', 'hidden');
	jQuery('#tickets_rms-widget-3 #show_all').click(function() {
		if (jQuery('#tickets_rms-widget-3 #show_all').html() == 'Show more') {
			jQuery('#tickets_rms-widget-3').css({'height':'auto'});
			jQuery('#tickets_rms-widget-3 div.rms_item:first hr').css('visibility', 'visible');
			jQuery('#tickets_rms-widget-3 #show_all').html('Show less');
		} else {
			jQuery('#tickets_rms-widget-3').css({'height':totHeight1+'px'});
			jQuery('#tickets_rms-widget-3 div.rms_item:first hr').css('visibility', 'hidden');
			jQuery('#tickets_rms-widget-3 #show_all').html('Show more');
		}
	})
	
	function closeHelper(){
		jQuery('#left-hidden').removeClass('opened');
		jQuery('#left-hidden .open-tag').html('Show Sidebar');
	}
	
	function openHelper(){
		jQuery('#left-hidden').addClass('opened');
		jQuery('#left-hidden .open-tag').html('Hide Sidebar');
	}
	
	jQuery('#left-hidden .open-tag').click(function(){
		if (jQuery('#left-hidden').hasClass('opened')){
			jQuery('#left-hidden').animate({
				width:'0'
			}, {
				duration:200,
				easing:'swing',
				complete:closeHelper()
			});
			jQuery(this).animate({
				left:'-54px'
			}, {
				duration:200,
				easing:'swing'
			});
			jQuery('.sidebar .entry-header, .sidebar .entry-content, .sidebar .entry-summary, .sidebar footer.entry-meta, .sidebar article.sup_openings > .entry-meta').animate({
				paddingLeft:'50px'
			}, {
				duration:200,
				easing:'swing'
			});
		} else {
			jQuery('#left-hidden').animate({
				width:'290px'
			}, {
				duration:200,
				easing:'swing',
				complete:openHelper()
			});
			jQuery(this).animate({
				left:'236px'
			}, {
				duration:200,
				easing:'swing'
			});
			jQuery('.sidebar .entry-header, .sidebar .entry-content, .sidebar .entry-summary, .sidebar footer.entry-meta, .sidebar article.sup_openings > .entry-meta').animate({
				paddingLeft:'340px'
			}, {
				duration:200,
				easing:'swing'
			});
		}
	});
});