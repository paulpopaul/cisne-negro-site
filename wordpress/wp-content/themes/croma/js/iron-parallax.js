var iron_parallax = function(){
	if (jQuery('.parallax-banner').length ) {

		jQuery(document).on('scroll', function() {

			var $scrollTop = jQuery(document).scrollTop();
			var $bannerHeight = jQuery('.parallax-banner').height();
			if ($scrollTop < $bannerHeight ) {

				$bannerFromTop = Math.pow(( ( $bannerHeight - $scrollTop ) / $bannerHeight ), 1.2);

				// jQuery('.site-logo').text($bannerFromTop);
		        jQuery('.page-banner-bg').velocity({
		        	translateZ: 0,
		            translateY: $scrollTop * 0.8+"px"
		        },{ duration: 0 });

		        jQuery('.page-banner-content').velocity({
		        	translateZ: 0,
		            translateY: $scrollTop * 0.7+"px",
		            opacity: $bannerFromTop
		        },{ duration: 0 });

			}

		});

	}
}

jQuery(document).ready(function($) {
	iron_parallax()
});

