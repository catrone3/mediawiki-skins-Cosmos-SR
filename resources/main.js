/**
 * JavaScript for ShadowCosmos skin
 */
( function ( $, mw ) {
	'use strict';
	
	// Add a subtle animation to the Ko-fi button
	$( function () {
		$( '.kofi-button' ).hover(
			function() {
				$( this ).css( 'transform', 'scale(1.05)' );
			},
			function() {
				$( this ).css( 'transform', 'scale(1)' );
			}
		);
		
		// Add a pulsing effect to the Ko-fi button
		setInterval( function() {
			$( '.kofi-button' ).animate( {
				opacity: 0.8
			}, 1000 ).animate( {
				opacity: 1
			}, 1000 );
		}, 2000 );
		
		// Add neon glow effect to headings on hover
		$( 'h1, h2, h3, h4, h5, h6' ).hover(
			function() {
				$( this ).css( 'text-shadow', '0 0 10px rgba(255, 0, 102, 0.8)' );
			},
			function() {
				$( this ).css( 'text-shadow', '0 0 5px rgba(255, 0, 102, 0.5)' );
			}
		);
		
		// Mobile menu toggle
		$( '.sc-mobile-menu-toggle' ).on( 'click', function() {
			$( '.sc-nav' ).toggleClass( 'sc-nav-open' );
		});
		
		// Add active class to current page in navigation
		$( '.sc-nav-link' ).each( function() {
			if ( window.location.href.indexOf( $( this ).attr( 'href' ) ) !== -1 ) {
				$( this ).addClass( 'active' );
			}
		});
		
		// Initialize tooltips
		$( '[data-tooltip]' ).each( function() {
			$( this ).attr( 'title', $( this ).data( 'tooltip' ) );
		});
	});
	
})( jQuery, mediaWiki );
