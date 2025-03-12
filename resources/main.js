/**
 * JavaScript for ShadowCosmos skin
 */
;(($, mw) => {
  // Add a subtle animation to the Ko-fi button
  $(document).ready(() => {
    $(".shadowcosmos-kofi-support a").hover(
      function () {
        $(this).css("transform", "scale(1.05)")
      },
      function () {
        $(this).css("transform", "scale(1)")
      },
    )

    // Add a pulsing effect to the Ko-fi button
    setInterval(() => {
      $(".shadowcosmos-kofi-support a")
        .animate(
          {
            opacity: 0.8,
          },
          1000,
        )
        .animate(
          {
            opacity: 1,
          },
          1000,
        )
    }, 2000)
  })
})(jQuery, mediaWiki)

/**
 * ShadowCosmos skin JavaScript
 */
( function ( $ ) {
	'use strict';

	// Add mobile menu toggle functionality
	$( function () {
		// This is just a placeholder for any JavaScript functionality you might want to add
		// For example, you could add a mobile menu toggle here
		
		// Example: Toggle sidebar on mobile
		$( '#sc-mobile-menu-toggle' ).on( 'click', function () {
			$( '#sc-sidebar' ).toggleClass( 'sc-sidebar-visible' );
		} );
	} );

}( jQuery ) );
