jQuery(document).ready(function($) {

	if ( $('input.color').length ) {
		$('input.color').colorPicker();
	}

	if ( $('.if_font').length ) {
		$('.if_font').fontselect().change(function() {
			var fontSelector = $(this);
			var fontFont = fontSelector.parents('.typography').find('.if_font_font');
			var fontWeight = fontSelector.parents('.typography').find('.if_font_weight');
			var font = $(this).val().replace(/\+/g, ' ');

          	font = font.split(':');

          	fontFont.val(font[0]);
          	fontWeight.val(font[1]);

		});
	}

	if ( window.location.search === '?page=croma-music' ) {
		var location = window.location;
		var tabContainerSingle = $('.tab-container-single');
		var tabSelect = $('.nav-tab');

		tabContainerSingle.hide();

		$('.nav-tab-wrapper').on('click', '.nav-tab', function(event) {
			tabContainerSingle.hide();
			tabSelect.removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');
			tabContainerSingle.eq($(this).index()).show();
		});


		if ( location.hash !== "" ) {
			$('.nav-tab[data-tab="' + location.hash + '"]').click();
		}else{
			tabSelect.eq(0).click();
		}


	}

	$('.croma-music_page_iron_music_import_export').on('click', '.btn.import', function(event) {
		event.preventDefault();

		var importData = $('textarea.import').val();
		var exportData = $('textarea.export');
		jQuery.post(
			ajaxurl ,
			{
				action: 'ironMusic_ajax',
				data: importData
			},
			function(data, textStatus, xhr) {

		  		if ( 'success' == textStatus && data.length ) {
		  			exportData.val(data);
		  		};
		});
	});


});