(function($) {
	$(document).ready( function() {
		$( '#fcbkbttn_settings_form input' ).bind( "change", function() {
			if ( $( this ).attr( 'type' ) != 'submit' ) {
				$( '.updated.fade' ).css( 'display', 'none' );
				$( '#fb_admin_notice' ).fadeIn('fast');
			};
		});
		$( '#fcbkbttn_settings_form select' ).bind( "change", function() {
			$( '.updated.fade' ).css( 'display', 'none' );
			$( '#fb_admin_notice' ).css( 'display', 'block' );
		});
	});
})(jQuery);