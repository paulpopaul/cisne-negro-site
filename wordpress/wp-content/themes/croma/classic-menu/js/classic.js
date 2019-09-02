$ = jQuery;
$wrap = $('.classic-menu');
$menu = $wrap.find('>ul');

var menu_height = $menu.outerHeight(true);
$wrap.height(menu_height);


var calculateTopPadding = function( callFrom ) {
	var callFrom = typeof callFrom !== 'undefined' ? callFrom : 'default';
	var wrapper = $('.wrapper');
	switch ( callFrom ) {
		case 'pjax':

			if(!IRON.state.responsive) {

				if(IRON.state.menu.classic_menu_over_content == '0' ) {
					wrapper.eq(1).css('padding-top', $wrap.outerHeight(true) + 'px');
				}

				if(IRON.state.menu.classic_menu_position == 'absolute absolute_before') {
					wrapper.eq(1).css('padding-top', $wrap.outerHeight(true) + 'px');
				}

			}else{
				wrapper.eq(1).css('padding-top', '');
			}

			break;

		default:
			if(!IRON.state.responsive) {

				if(IRON.state.menu.classic_menu_over_content == '0' ) {
					$('#wrapper').css('padding-top', $wrap.outerHeight(true) + 'px');
				}

				if(IRON.state.menu.classic_menu_position == 'absolute absolute_before') {
					$('#wrapper').css('padding-top', $wrap.outerHeight(true) + 'px');
				}

			}else{
				$('#wrapper').css('padding-top', '');
			}
	}



}

// add class ready when classic menu is ready.
$(window).load( function() { $('.classic-menu').addClass('ready'); });
// activate responsiveness to classic menu.

if($('html').hasClass('no-touchevents')) {
	$(window).on('load', responsiveMenu);
	$(window).on('resize', responsiveMenu);
}else{
	$(window).on('resize', responsiveMenu);
	$(window).on('load', responsiveMenu);
}

// function that activate responsiveness
function responsiveMenu() {
		IRON.state.responsive = false;
	if( $(window).width() < 1144 ) {
		IRON.state.responsive = true;
		$('.classic-menu').addClass('responsive').removeClass('mini');
		/*if(logo_mini_url != '') {
			$('.classic-menu').find('.classic-menu-logo').attr('src', logo_url);
		}*/
		if(IRON.state.logo.use_alternative_logo_on_mobile) {
			$('.classic-menu').find('.classic-menu-logo').attr('src', IRON.state.logo.logo_page_url);
		}else{
			$('.classic-menu').find('.classic-menu-logo').attr('src', $wrap.data('logo'));
		}


		if( $('.responsive-header').length < 1  ) {
			$('<div class="responsive-header"><a class="sandwich-icon"></a></div>').prependTo('.classic-menu');
			if (jQuery('.languages-selector').children().length == 0){
                $( '.languages-selector' ).remove();
            }
		}
		$('.responsive-header').off().on('click', '.sandwich-icon', function(e) {
			// e.preventDefault();

			// debugger
			if( $('.classic-menu').is('.visible') ) { $('.sandwich-icon').removeClass('opened'); $('.classic-menu').removeClass('visible'); return false; }
			else { $('.sandwich-icon').addClass('opened'); $('.classic-menu').addClass('visible');  }
		});

		$('.classic-menu ul li a').off().on('click', function(e) {

			// toggle in all case active class
			var anchor = $(this)
			var anchorParents = anchor.parents('li')

			$(this).parents('#menu-main-menu').find('li').each(function(el){
				if ( !_.contains( anchorParents, this ) ) {
					$(this).removeClass('active')
				}
			})
			$(this).closest('li').not('.logo').toggleClass('active');

			if( $(this).attr('href') == '#' ) {
				e.preventDefault();
			}else{
				// window.location.href = $(this).attr('href');
				$('.classic-menu').removeClass('visible');
				$('.classic-menu .sandwich-icon').removeClass('opened');
				$('.classic-menu').scrollTop(0);
			}

		});

	} else {
		$('.classic-menu').removeClass('responsive');
		if($('.classic-menu').hasClass('mini') ){
			if(IRON.state.logo.logo_mini_url != '') {
				$('.classic-menu').find('.classic-menu-logo').attr('src', IRON.state.logo.logo_mini_url);
			}

		}else{
			$('.classic-menu').find('.classic-menu-logo').attr('src', IRON.state.logo.logo_url);
		}

		$('.classic-menu .hotlink').attr('style', '');
		$('.classic-menu .responsive-header').remove();
	}

	setTimeout(function() {
		calculateTopPadding();
	},450);
}



function fixLogoMargin() {

	if($('.classic-menu > ul > li.logo').hasClass('pull-center') || $('.classic-menu > ul > li.logo').hasClass('pull-top'))
		return false;

	var itemHeight = $('.classic-menu > ul > li').not('.logo').first().outerHeight(true);
	var logoHeight = $('.classic-menu > ul > li.logo a').height();
	var marginTop = (itemHeight / 2) - (logoHeight / 2);
	$('.classic-menu > ul > li.logo a').css('margin', marginTop+'px 0 0');
}




IRON.setupMenu = function() {
	var total_items = $menu.find('>li:not(".hotlink")').length;

	var position = 0;
	if ( IRON.state.logo.logo_align == 'pull-right' ) {
		position = total_items
	}
	if ( IRON.state.logo.logo_align == 'pull-center' ) {
		position = Math.ceil(total_items / 2);
	}


	// Activate Mini menu.
	var lastScrollTop = 0;

	if(IRON.state.logo.logo_page_url ==''){
		IRON.state.logo.logo_page_url = IRON.state.logo.logo_url;
		if(IRON.state.logo.logo_page_retina_url ==''){
			IRON.state.logo.logo_page_retina_url = IRON.state.logo.retina_logo_url;
		}
	}
	if(IRON.state.logo.logo_page_retina_url ==''){
		IRON.state.logo.logo_page_retina_url = IRON.state.logo.logo_page_url;
	}
	if(IRON.state.logo.retina_logo_url ==''){
		IRON.state.logo.retina_logo_url = IRON.state.logo.logo_url;
	}

		$(document).on('scroll touchmove', function (e) {
		   	var offset = $(this).scrollTop();
		   	var st = $(this).scrollTop();

	       	if( ( $('.classic-menu').hasClass('mini-active') || $('.classic-menu').hasClass('mini-fullwidth-active') ) && !$('.classic-menu').hasClass('responsive')) {
				   
		   		if (offset > 150) {
					if( !$('.classic-menu').hasClass('mini') ){
						$('.classic-menu').css( 'width', '100%' ).addClass('mini');
					}
			    	if(IRON.state.logo.logo_mini_url != '') {
				    	$('.classic-menu').find('.classic-menu-logo').attr('src', IRON.state.logo.logo_mini_url);
				    	$('.classic-menu').find('.classic-menu-logo').attr('srcset', IRON.state.logo.logo_mini_url + ' 1x, ' + IRON.state.logo.logo_mini_url + ' 2x');
			    	}

			    }
			    if (offset <= 150) {
					if( $('.classic-menu').hasClass('mini') ){
						$('.classic-menu').css( 'width', $('body').width() - 2*parseInt(iron_vars.menu.classic_menu_hmargin) ).removeClass('mini') ;	
					}
			    	if(IRON.state.logo.logo_mini_url != '') {
						$('.classic-menu').find('.classic-menu-logo').attr('src', IRON.state.logo.logo_url);
						$('.classic-menu').find('.classic-menu-logo').attr('srcset', IRON.state.logo.logo_url + ' 1x, ' + IRON.state.logo.retina_logo_url + ' 2x');
			    	}
			    }

		    	fixLogoMargin();

			}
			lastScrollTop = st;

			$('.classic-menu').css('height', '');

		});

		setTimeout(function() {
			fixLogoMargin();
		},450);





	calculateTopPadding();

	if(IRON.state.logo.use_alternative_logo && !IRON.state.responsive) {
	//if(logo_page_url != '' && !$('.classic-menu').hasClass('responsive')) {
		IRON.state.logo.logo_url = IRON.state.logo.logo_page_url;

		if(IRON.state.logo.logo_page_retina_url !=''){
			IRON.state.logo.retina_logo_url = IRON.state.logo.logo_page_retina_url;
		}
	}

	if(IRON.state.logo.use_alternative_logo_on_mobile && IRON.state.responsive) {
	//if(logo_page_url != '' && !$('.classic-menu').hasClass('responsive')) {
		IRON.state.logo.logo_url = IRON.state.logo.logo_page_url;

		if(IRON.state.logo.logo_page_retina_url !=''){
			IRON.state.logo.retina_logo_url = IRON.state.logo.logo_page_retina_url;
		}
	}

	if(IRON.state.logo.logo_url) {

		IRON.state.logo.logo_url = IRON.state.logo.logo_url.slice( IRON.state.logo.logo_url.indexOf('/') )
		IRON.state.logo.retina_logo_url = IRON.state.logo.retina_logo_url.slice( IRON.state.logo.retina_logo_url.indexOf('/') )

		var $logo = $('<li class="logo '+IRON.state.logo.logo_align+'"><a href="'+IRON.state.site_url+'"><img class="classic-menu-logo" src="'+IRON.state.logo.logo_url+'" srcset="'+IRON.state.logo.logo_url+' 1x, '+IRON.state.logo.retina_logo_url+' 2x" alt="' + IRON.state.site_name + '"></a></li>');

	}else{
		var $logo = $('<li class="logo '+IRON.state.logo.logo_align+'"><a href="'+IRON.state.site_url+'">'+IRON.state.site_name+'</a></li>');
	}

	if (!$menu.find('.logo').length) {
		$menu.find('>li').eq(position).before($logo);
	}else{
		$menu.find('.logo img').attr({
			src : IRON.state.logo.logo_url,
			srcset : IRON.state.logo.logo_url+' 1x, '+IRON.state.logo.retina_logo_url+' 2x'
		})
	}

	// Collision: avoid submenu to be out of viewport.
	$menu.find('>li a').on('mouseover', function(e) {
		// check if has submenu
		if( $(this).find(' + ul').length > 0 ) {
			// var zI = 1;
			var $_this = $(this).find(' + ul');
			if( $_this.outerWidth(true) + $_this.offset().left > $(window).width() ) {
				// $_this.css('zIndex', zI++);
				$(this).parent().addClass('collision');
			}
		}

	});

	// hotlinks
	$hotlinks = $wrap.find('.classic-menu-hot-links');
	if($hotlinks.length > 0) {
		var links = $hotlinks.html();
		$hotlinks.detach();
		$menu.append(links);
	}

	if($('.logo.pull-left')){
		var totalwidth = 0;
		$(".hotlink.pull-right").each(function(){
			totalwidth = totalwidth + $(this).outerWidth(true);
		});
	}



};

$(window).on('load', IRON.setupMenu );