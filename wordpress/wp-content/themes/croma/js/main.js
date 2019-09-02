
var iron_vars = window.iron_vars || {},
    IRON = window.IRON || {};

var AudioPlaylists = [];

var isiPad = /ipad/i.test(navigator.userAgent.toLowerCase());
var isMobile = jQuery.browser.mobile;
var isiPhone = /iphone/i.test(navigator.userAgent.toLowerCase());
var isSafari = /safari/i.test(navigator.userAgent.toLowerCase());

var waypoints;
(function($) {
    "use strict";

    IRON.$ = window.IRON.$ || {};

    IRON.XHR = {
        settings: {
            url: iron_vars.ajaxurl,
            type: 'POST'
        }
    };

	IRON.state = iron_vars;
	IRON.libraries = [];

    var jcf = window.jcf || {};
    var DocumentTouch = window.DocumentTouch || {};
    var ResponsiveHelper = window.ResponsiveHelper || {};
    var jPlayerPlaylist = window.jPlayerPlaylist || {};
    var PlaceholderInput = window.PlaceholderInput || {};
    var TouchNav = window.TouchNav || {};
		var lib = window.lib || {};
		
		$(document).on('ready', function() {
			var libraries = $(document).find('head script[src], #pusher-wrap ~ script[src]')
	
			libraries.each(function() {
				IRON.libraries.push($(this).attr('src'))
			})
		})

    // page init
    jQuery(function() {


        /* Fancybox overlay fix */
        // detect device type
        var isTouchDevice = (function() {
            try {
                return ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch;
            } catch (e) {
                return false;
            }
        }());


        IRON.initFreeWall();
        IRON.initPopups();
        IRON.initInputs();
        IRON.initFitVids();
        IRON.initVideoLinks();
        IRON.initDropDownClasses();
        IRON.initAjaxBlocksLoad();
        IRON.initLightbox();
        IRON.initFacebookLikebox();
        IRON.initTwitter();
		IRON.initSideMenu();

		if(iron_vars.header_top_menu_hide_on_scroll == 1)
			IRON.initTopMenu();

		IRON.initCircleCentering();
		IRON.initGridDisplayPhoto();
		IRON.initGridDisplayAlbum();
		IRON.initGridDisplayNews();
		IRON.initGridDisplayVideo();

		// if(!isMobile && !isiPad)
			IRON.initPusherHeight();

		IRON.initEventCenter();
		IRON.initTwitterCenter();
		IRON.initHeadsetCenter();
		IRON.initIOSCenter();
		IRON.initCountdownLang();
		IRON.initCountdownCenter();
		IRON.initMenuHierarchy();
		IRON.initSubmenuPosition();
		IRON.initSingleDisco();
		IRON.initNewsletterLabel();
		IRON.initBackToTop();
		IRON.initScrollToSection();
        IRON.initParallax();
		IRON.initDisableHovers();
		IRON.initVcAnimations();
		IRON.initIsotope();
		IRON.initWooImageBack();
		IRON.initWpAdminBar();
		IRON.initSocialShare();
		IRON.btnPlayAudio()
		IRON.pjax.init();

        if (iron_vars.enable_fixed_header)
            IRON.initFixedBar();

		IRON.initCustomJS();

        // fix options
        var supportPositionFixed = !((jQuery.browser.msie && jQuery.browser.version < 8) || isTouchDevice);
        var overlaySelector = '#fancybox-overlay';

        if (supportPositionFixed) {
            // create <style> rules
            var head = document.getElementsByTagName('head')[0],
                style = document.createElement('style'),
                rules = document.createTextNode(overlaySelector + '{' +
                        'position:fixed;' +
                        'top:0;' +
                        'left:0;' +
                        '}');

            // append style element
            style.type = 'text/css';
            if (style.styleSheet) {
                style.styleSheet.cssText = rules.nodeValue;
            } else {
                style.appendChild(rules);
            }
            head.appendChild(style);
        }
    });

	IRON.initWpAdminBar = function(){
		if( iron_vars.wp_admin_bar ){
			$('html').addClass('wp-admin-bar')
		}
	}

    jQuery(window).load(function() {
        setTimeout(function() {
            IRON.initSameHeight();
            jQuery(window).trigger('resize');
        }, 200);
    });

	IRON.initSocialShare = function(){
		if ( $('.sharing_toolbox').length ) {

			if (iron_vars.social_enabled == "1") {


				var image = $('.sharing_toolbox').data('image-social');
				var url = document.URL
				var shareFacebook = '';
				var shareTwitter = '';
				var shareGoogle = '';
				var shareLinkedin = '';
				var sharePinterest = '';

				if (Object.prototype.hasOwnProperty.call(iron_vars.social, 'facebook') ) {
					shareFacebook = '<a title="Share on Facebook" class="shareFacebook" href="http://www.facebook.com/sharer/sharer.php?u=' + url + '" target="_blank"><i class="fab fa-facebook-square" aria-hidden="true"></i></a>';
				}
				if (Object.prototype.hasOwnProperty.call(iron_vars.social, 'twitter') ) {
					shareTwitter = '<a title="Share on Twitter" class="shareTwitter" href="https://twitter.com/intent/tweet?url=' + url + '&text=' + document.title + '" target="_blank"><i class="fab fa-twitter-square" aria-hidden="true"></i></a>';
				}
				if (Object.prototype.hasOwnProperty.call(iron_vars.social, 'google+') ) {
					shareGoogle = '<a title="Share on Google+" class="shareGoogle" href="https://plusone.google.com/_/+1/confirm?url=' + url + '" target="_blank"><i class="fab fa-google-plus-square" aria-hidden="true"></i></a>';
				}
				if (Object.prototype.hasOwnProperty.call(iron_vars.social, 'linkedin') ) {
					shareLinkedin = '<a title="Share on LinkedIn" class="shareLinkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=' + url + '" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a>';
				}
				if (Object.prototype.hasOwnProperty.call(iron_vars.social, 'pinterest') ) {
					sharePinterest = '<a title="Share on Pinterest" class="sharePinterest" href="https://pinterest.com/pin/create/bookmarklet/?url=' + url + '&description=' + document.title + '&media=' + image + '" target="_blank"><i class="fab fa-pinterest-square" aria-hidden="true"></i></a>';
				}

				$('.sharing_toolbox').append( shareFacebook + shareTwitter + shareGoogle + shareLinkedin + sharePinterest )
			}

		}
	}

    IRON.pagination = {
        XHR: {},
        $: {},
        loadingClass: 'ajax-load',
        ajaxBusy: false,
        isotope: false
    };

    IRON.pagination.XHR = {
        done: function(response, status, xhr) { // success : data, status, xhr

            var IB = IRON.pagination;

            if (response)
            {

            	if(IB.isotope) {
	            	var $newItems = $(response);
					IB.$.container.append( $newItems ).isotope( 'addItems', $newItems ).isotope( 'reLayout' );
					IB.$.container.fadeIn();
            	}else{
                	IB.$.container.append(response).fadeIn();
				}

				var newMoreButton = IB.$.container.find('.button-more');
				if(newMoreButton.length > 0) {
					IB.$.loadButton.replaceWith(newMoreButton[0].outerHTML );
					newMoreButton.remove();
					IB.$.loadButton = $('.button-more');

				}else{
					IB.$.loadButton.remove();
				}


                IB.ajaxBusy = false;

                //IRON.initTouchNav();

                var callbacks = IB.$.loadButton.data('callback');
                if (callbacks) {
                    callbacks = callbacks.split(',');

                    for (var i = 0; i < callbacks.length; i++)
                    {
                        var callback = IRON[callbacks[i]];

                        if (typeof callback === 'function') {
                            callback();
                        }
                    }
                }

                if (IB.method == 'paginate_scroll') {

                    $(document).on('scroll', function(event) {
                        if (!IB.ajaxBusy) {
                            var $win = $(this),
                                $doc = $(document),
                                $foot = $('body > footer');

                            if ($win.scrollTop() >= ($doc.height() - $win.height() - ($foot.height()))) {
                                IB.$.loadButton.click();
                            }
                        }
                    });

                } else {
                    IB.$.loadButton.css('visibility', 'visible').fadeIn();
                }

                IRON.initAjaxBlocksLoadEvent();

            } else {

                IB.$.loadButton.remove();
                IB.XHR.fail(xhr, 'error', 404);
            }
        },
        fail: function(xhr, status, error) { // error : xhr, status, error

            var IB = IRON.pagination;

            setTimeout(function() {
                alert(IB.$.loadButton.data('warning'));
            }, 100);
        },
        always: function() { // complete : data|xhr, status, xhr|error

            var IB = IRON.pagination;
            IB.$.loadButton.prop('disabled', false);

            IB.$.container.removeClass(IB.loadingClass);
        },
        before: function(xhr) {

            var IB = IRON.pagination;
            IB.$.loadButton.prop('disabled', true);
        }
    };


    IRON.initFacebookLikebox = function() {
        if ($('#fb-likebox').length === 0) {
            return false;
        }

        var fb_app_id = $('#fb-likebox').data('appid');
        var fb_page_url = $('#fb-likebox').data('pageurl');
        fb_page_url = encodeURI(fb_page_url);

        var iframe = '<iframe src="//www.facebook.com/plugins/likebox.php?href=' + fb_page_url + '&amp;width=200&amp;height=62&amp;show_faces=false&amp;colorscheme=dark&amp;stream=false&amp;border_color&amp;header=false&amp;appId=' + fb_app_id + '" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:62px;" allowTransparency="true"></iframe>';

        $('#fb-likebox').html(iframe);
    };


    IRON.initTwitter = function() {

        $('.iron_widget_twitter .query').each(function() {

            var $query = $(this);
            var username = $(this).data('username');

            $(function($) {
                $query.tweet({
                    modpath: iron_vars.plugins_url + 'js/twitter/',
                    join_text: 'auto',
                    username: (username ? username : 'envato'),
                    count: 1,
                    auto_join_text_default: '',
                    auto_join_text_ed: '',
                    auto_join_text_ing: '',
                    auto_join_text_reply: '',
                    auto_join_text_url: '',
                    loading_text: 'loading tweets...'
                }).bind('loaded', function() {
                    $(window).resize();
                });
            });

        });
    };

    IRON.initFixedBar = function() {

        var top = 0;

        var waypoint = new Waypoint({
        	element : document.getElementById('wrapper'),
        	handler : function(direction){
        		if (direction == 'down') {
	                $('#fixed-panel').animate({
	                    opacity: "1",
	                    top: top
	                }, 400);
	            } else if (direction == 'up') {
	                $('#fixed-panel').animate({
	                    opacity: "0",
	                    top: "-78"
	                }, 200);
	            }
        	},
        	offset : -1
        })
    };


    IRON.initAjaxBlocksLoad = function() {

        IRON.pagination.XHR.request = {
            dataType: 'text',
            data: {
	            ajax: 1
            },
			beforeSend: IRON.pagination.XHR.before
        };

        IRON.pagination.XHR.request = $.extend(true, IRON.pagination.XHR.request, IRON.XHR.settings);
		IRON.initAjaxBlocksLoadEvent();

        $('a.button-more').trigger('click');

    };

    IRON.initAjaxBlocksLoadEvent = function() {


		$(document).off('click', 'a.button-more');
        $(document).on('click', 'a.button-more', function(e) {
            e.preventDefault();

            var IB = IRON.pagination,
            $this = $(this);

			IB.isotope = ($('.isotope-wrap').length > 0);

            if (IB.ajaxBusy)
                return;

            IB.$.loadButton = $this;
            IB.$.container = $('#' + IB.$.loadButton.data('rel'));
            IRON.pagination.XHR.request.url = IB.$.loadButton.attr('href');
            IRON.XHR.settings.url = IB.$.loadButton.attr('href');

            IB.method = $this.data('paginate');

            $.ajax(IB.XHR.request)
                    .done(IB.XHR.done)
                    .fail(IB.XHR.fail)
                    .always(IB.XHR.always);
        });
    };

    // add classes if item has dropdown
    IRON.initDropDownClasses = function() {
        jQuery('.side-menu #nav li').each(function() {
            var item = jQuery(this);
            var drop = item.find('ul');
            var link = item.find('a').eq(0);
            if (drop.length) {
                item.addClass('has-drop-down');
                if (link.length) {
                    link.addClass('has-drop-down-a');
                }
            }
        });
    };

    // handle flexible video size
    IRON.initFitVids = function() {
        jQuery('.video-block').fitVids();
    };


	IRON.initVideoLinks = function() {

		$('.link-mode-inline a').off('click');
		$('.link-mode-inline a').on('click', function(e){

			e.preventDefault();

			var wrap = $(this).find('.image');
		    var permalink = $(this).attr('href');
		    var wrap_height = wrap.css('height');


	   		$('.link-mode-inline a').not($(this)).find('.fluid-width-video-wrapper').each(function() {

				var parent = $(this).parent();
				$(this).remove();

				parent.find('.loader').remove();
				parent.find('.play-button').fadeIn();
				parent.find('img').fadeIn();
				parent.animate({opacity:1}, 1000);

			});



		    wrap.css('height', wrap_height);
		    wrap.animate({opacity:0});

		    $.ajax({
			   url: permalink,
			   dataType: 'html',
			   type: 'post',
			   data: {ajax:1},
			   success: function(embed) {

					wrap.find('.play-button').hide();
					wrap.find('img').hide();
					if ( ( isiPhone || isiPad ) && isSafari ) {
						wrap.append(embed);
					}else{
						wrap.append(embed).fitVids();
					}

					wrap.animate({opacity:1}, 1000);
			   }

		    });
		});

		var scrolling = false;
		$(document).on('scrollstart', function() {
			scrolling = true;
		});
		$(document).on('scrollstop', function() {
			scrolling = false;
		});


		$(window).on('resize', function() {

			if( (window.outerWidth == screen.width) || scrolling)
				return false;


			$('.link-mode-inline a .image').each(function() {

				$(this).css('height', '');

			});
			$('.link-mode-inline a').not($(this)).find('.fluid-width-video-wrapper').each(function() {

				var parent = $(this).parent();
				$(this).remove();

				parent.find('.loader').remove();
				parent.find('.play-button').fadeIn();
				parent.find('img').fadeIn();
				parent.animate({opacity:1}, 1000);

			});


		});

		$('.link-mode-lightbox a').off('click');
		$('.link-mode-lightbox a').on('click', function(e){

			e.preventDefault();

		    var wrap = $(this).find('.image');
		    var permalink = $(this).attr('href');
		    var wrap_height = wrap.height();

		    $.ajax({
			   url: permalink,
			   dataType: 'html',
			   type: 'post',
			   data: {ajax:1},
			   success: function(embed) {

					$.fancybox(embed, {
						// fancybox API options
						fitToView: false,
						autoSize: true,
						closeClick: false,
						//openEffect: 'none',
						//closeEffect: 'none'
					}); // fancybox


			   }


		    });
		});

	};

    // popups init
    IRON.initPopups = function() {
        jQuery('.panel').contentPopup({
            mode: 'click',
            popup: '.nav-holder',
            btnOpen: '.opener'
        });
    };

    // clear inputs on focus
    IRON.initInputs = function() {
        PlaceholderInput.replaceByOptions({
            // filter options
            clearInputs: true,
            clearTextareas: true,
            clearPasswords: true,
            skipClass: 'default',
            // input options
            wrapWithElement: false,
            showUntilTyping: false,
            getParentByClass: false,
            placeholderAttr: 'value'
        });
    };

    // align blocks height
    IRON.initSameHeight = function() {
        jQuery('.widget-area.grid-cols').sameHeight({
            elements: '.widget',
            flexible: true,
            multiLine: true
        });
    };


    // fancybox modal popup init
    IRON.initLightbox = function() {
		var lightboxtransition = iron_vars.lightbox_transition;
        jQuery('a.lightbox, a[rel*="lightbox"]').fancybox({
            padding: 10,
            cyclic: false,
            overlayShow: true,
            overlayOpacity: 0.65,
            overlayColor: '#000000',
            titlePosition: 'inside',
			transitionIn: 'fade',
			transitionOut: 'fade',
			prevEffect : lightboxtransition,
			nextEffect : lightboxtransition
        });
    };

    IRON.initFreeWall = function() {


			$(".free-wall").each(function() {

				var single_album = $('body').hasClass('single-photo-album');
				var layout = $(this).data('layout');
				var height = parseInt($(this).data('height'));


				if(single_album || layout == 'show_all') {

					var wall = new freewall($(this));

					var multiplier = 0.69;

					var original_height = $(this).height() * multiplier;

					wall.reset({
						selector: '.brick',
						gutterX: 1,
						gutterY: 1,
						animate:false,
						onResize: function() {

							if(single_album)
								original_height =  wall.container.height();

							wall.fitZone();

							if(!single_album)
								wall.container.height(original_height);
						}
					});
					if(single_album)
						original_height = wall.container.height();

					// caculator width and height for IE7;
					wall.fitWidth();

					if(!single_album)
						wall.container.height(original_height);

					$(window).resize();

				}else{
			         var gallery_height;
					if(layout != 'window_height' && height !== '' && height !== 0) {
						gallery_height = height;
					}else{
						gallery_height = $(window).height();
					}

					var wall = new freewall($(this));
					wall.container.height(gallery_height);
					wall.reset({
						selector: '.brick',
						animate: false,
						cellW: 150,
						cellH: 150,
						gutterX: 1,
						gutterY: 1,
						delay: 30,
						onResize: function() {
							wall.refresh($(wall.container).width(), gallery_height);

						}
					});

					// caculator width and height for IE7;
					wall.fitZone($(wall.container).width(), gallery_height);
					$(window).resize();
				}
			});


    };


	// Animation for side menu

	IRON.animation = {
		right: {
			push: anime({
				targets: ['#pusher','#overlay .perspective'],
				translateX: -300,
				autoplay: false,
				easing: 'linear',
				duration: 300
			}),
			pushRotate: anime({
				targets: ['#pusher','#overlay .perspective'],
				translateX: -330,
				translateY: 0,
				translateZ: 0,
				rotateY:15,
				autoplay: false,
				easing: 'linear',
				duration: 350
			}),
			perspective: anime({
				targets: ['#pusher','#overlay .perspective'],
				translateX: 0,
				translateY: 0,
				translateZ: -1000,
				rotateY:15,
				autoplay: false,
				easing: 'linear',
				duration: 350
			})

		},
		left:{
			push: anime({
				targets: ['#pusher','#overlay .perspective'],
				translateX: 370,
				autoplay: false,
				easing: 'linear',
				duration: 350
			}),
			pushRotate: anime({
				targets: ['#pusher','#overlay .perspective'],
				translateX: 330,
				translateY: 0,
				translateZ: 0,
				rotateY:-15,
				autoplay: false,
				easing: 'linear',
				duration: 350
			}),
			perspective: anime({
				targets: ['#pusher','#overlay .perspective'],
				translateX: 0,
				translateY: 0,
				translateZ: -1000,
				rotateY:-15,
				autoplay: false,
				easing: 'linear',
				duration: 350
			})
		}
	}


	/* SIDE MENU */
	IRON.initSideMenu = function() {
		var typeside = iron_vars.menu.top_menu_position;
		var typeclass = iron_vars.menu.menu_transition;
		var bodyScroll = {}
		var pusherScroll = {}
		// debugger
		jQuery('.site-logo,.menu-toggle,.side-menu,#pusher').addClass(typeside);


		jQuery(".menu-toggle,.alt-menu-toggle").click(function(event) {
		var bodyScroll = $(document).scrollTop()

			event.preventDefault();
			var timeout = 1;
			if(isMobile || isiPad) {
				IRON.initPusherHeight();
				timeout = 500;
			}

			setTimeout(function() {
				if(typeclass == 'type1' || typeclass == 'type2'){
					setTimeout(function() {
						jQuery('#pusher').addClass(typeclass);
						$('#pusher').scrollTop(bodyScroll)
						$('body').addClass('pushMenu');
					},50);
					switch (typeclass) {
						case 'type1':
							IRON.animation.right.push.reset()
							IRON.animation.right.push.play()
							break;

						case 'type2':
							IRON.animation.right.pushRotate.reset()
							IRON.animation.right.pushRotate.play()
							break;

						default:
							return

					}
					jQuery('.side-menu').addClass('open');
					jQuery('.menu-toggle').css('display', 'none');
					jQuery('.site-logo').css('opacity', '0');
					jQuery('.header-top-menu').fadeOut();
				}else{

					IRON.animation.right.perspective.reset()
					IRON.animation.right.perspective.play()

					jQuery('#pusher').addClass(typeclass);
					$('body').addClass('pushMenu');
					$('#pusher').scrollTop(bodyScroll)
					jQuery('.side-menu').addClass('open');
					jQuery('.menu-toggle').css('display', 'none');
					jQuery('.site-logo').css('opacity', '0');
					jQuery('.header-top-menu').fadeOut();
				}
			}, timeout);

		});
		jQuery("#pusher-wrap,.menu-toggle-off").click(function() {
			var pusherScroll = $('#pusher').scrollTop()

			if ( !$('.side-menu.open').length )
				return


			if(typeclass == 'type1' || typeclass == 'type2'){

				switch (typeclass) {
					case 'type1':
						IRON.animation.right.push.reverse()
						IRON.animation.right.push.play()
						break;

					case 'type2':
						IRON.animation.right.pushRotate.reverse()
						IRON.animation.right.pushRotate.play()
						break;

					default:
						return
				}


				setTimeout(function() {
					jQuery('.side-menu').removeClass('open');




				},50);

				setTimeout(function(){
					jQuery('#pusher').removeClass(typeclass);
					$(document).scrollTop(pusherScroll);
					$('body').removeClass('pushMenu');
				},500)
				jQuery('.sub-menu').removeClass('active');
				jQuery('.menu-toggle').css('display', 'block');
				jQuery('ul.nav-menu a').css('opacity','1');
				jQuery('.panel-networks').css('opacity','1');
				jQuery('.site-logo').css('opacity', '1');
				jQuery('.nav-menu li a, ul.nav-menu ul a, .nav-menu ul ul a').css('pointer-events','auto');
				jQuery('.header-top-menu').fadeIn();
			}else{


				setTimeout(function(){
					jQuery('#pusher').removeClass(typeclass);
					$(document).scrollTop(pusherScroll)
					$('body').removeClass('pushMenu');
				},500)

				IRON.animation.right.perspective.reverse()
				IRON.animation.right.perspective.play()

				jQuery('.side-menu').removeClass('open');
				jQuery('.sub-menu').removeClass('active');
				jQuery('.menu-toggle').css('display', 'block');
				jQuery('ul.nav-menu a').css('opacity','1');
				jQuery('.panel-networks').css('opacity','1');
				jQuery('.site-logo').css('opacity', '1');
				jQuery('.nav-menu li a, ul.nav-menu ul a, .nav-menu ul ul a').css('pointer-events','auto');
				jQuery('.header-top-menu').fadeIn();
			}

			// if(isMobile || isiPad) {
			// 	setTimeout(function() {
			// 		IRON.resetPusherHeight();
			// 	}, 500);
			// }
		});
		jQuery('.side-menu').css('display','block');
	};

	IRON.initTopMenu = function() {

		$(document).on('scroll', function() {

			if ($(this).scrollTop() >= 400) {

		       	jQuery('.header-top-menu').stop().animate({
					top: '-100px',
					opacity:0
				}, 600);
		    }
		    else {

		       	jQuery('.header-top-menu').stop().animate({
					top: '12px',
					opacity: 1
				}, 600);
		    }

		});

	};

	/* CIRCLE CENTERING */
	IRON.initCircleCentering = function() {
		jQuery(".centering, .circle .wpb_wrapper").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});

		jQuery(window).resize(function(){
			if(jQuery(window).innerWidth() < 660){
				if(jQuery(".circle").length > 0){
					jQuery(".circle").each(function(){
						jQuery(this).closest(".wpb_column").css({
							"float" : "none",
							"margin-left" : "0",
							"width" : "100%"
						});
					});
				}
			} else {
				if(jQuery(".circle").length > 0){
					jQuery(".circle").each(function(){
						jQuery(this).closest(".wpb_column").removeAttr("style");
					});
				}
			}
		});
	};

	/* PHOTO ALBUM GRID DISPLAY */
	IRON.initGridDisplayPhoto = function() {
		setTimeout(function() {
		jQuery('.listing-section.photo').each(function(){
			var leftColumnHeight = 0;
			var rightColumnHeight = 0;
			var $articles = jQuery(this).find('.photo-wrap');
			for (var i = 0; i < $articles.length; i++) {
				if (leftColumnHeight > rightColumnHeight) {
					rightColumnHeight += $articles.eq(i).addClass('right').outerHeight(true);
				} else {
					leftColumnHeight += $articles.eq(i).outerHeight(true);
				}
			}
			jQuery(this).css('visibility','visible');
		});
		},250);
		setTimeout(function() {
			jQuery('.photo-wrap').css('opacity','1');
		},250);
	};

	/* MUSIC ALBUM GRID DISPLAY */
	IRON.initGridDisplayAlbum = function() {
		setTimeout(function() {
		jQuery('.two_column_album').each(function(){
			var leftColumnHeight = 0;
			var rightColumnHeight = 0;
			var $articles = jQuery(this).find('.media-block');
			for (var i = 0; i < $articles.length; i++) {
				if (leftColumnHeight > rightColumnHeight) {
					rightColumnHeight += $articles.eq(i).addClass('right').outerHeight(true);
				} else {
					leftColumnHeight += $articles.eq(i).outerHeight(true);
				}
			}
			jQuery(this).css('visibility','visible');
		});
		},250);
		setTimeout(function() {
			jQuery('.two_column_album .media-block').css('opacity','1');
		},250);
	};

	/* NEWS GRID DISPLAY */
	IRON.initGridDisplayNews = function() {
		setTimeout(function() {
		jQuery('.iron_widget_posts, .articles-section').each(function(){
			var leftColumnHeight = 0;
			var rightColumnHeight = 0;
			var $articles = jQuery(this).find('.news-grid-wrap');
			for (var i = 0; i < $articles.length; i++) {
				if (leftColumnHeight > rightColumnHeight) {
					rightColumnHeight += $articles.eq(i).addClass('right').outerHeight(true);
				} else {
					leftColumnHeight += $articles.eq(i).outerHeight(true);
				}
			}
			jQuery(this).css('visibility','visible');
		});
		},250);
		setTimeout(function() {
			jQuery('.news-grid-wrap').css('opacity','1');
		},250);
	};

	/* VIDEO GRID DISPLAY */
	IRON.initGridDisplayVideo = function() {
		setTimeout(function() {
		jQuery('.iron_widget_videos, .listing-section.videos').each(function(){
			var leftColumnHeight = 0;
			var rightColumnHeight = 0;
			var $articles = jQuery(this).find('.videogrid');
			for (var i = 0; i < $articles.length; i++) {
				if (leftColumnHeight > rightColumnHeight) {
					rightColumnHeight += $articles.eq(i).addClass('right').outerHeight(true);
				} else {
					leftColumnHeight += $articles.eq(i).outerHeight(true);
				}
			}
			jQuery(this).css('visibility','visible');
		});
		},250);
		setTimeout(function() {
			jQuery('.videogrid').css('opacity','1');
		},250);
	};

	// pjax

	IRON.btnPlayAudio = function(){
		jQuery('.pjax-container').on('click', '.vc_btn3[data-album="1"]', function(){
			event.preventDefault();
			IRON.continuousPlayer.setPlaylist( jQuery(this) )
			IRON.continuousPlayer.setCurrentTrack( 0 , jQuery(this) )
		})
	}

	IRON.pjax = {

			oldDocument : '',
			newDocument : '',
			enablePjax : IRON.state.enable_ajax,

			defaultBarba : function(){
				var pjax = this;
				var originalFn = Barba.Pjax.Dom.parseResponse;
				var originalCheck = Barba.Pjax.preventCheck

				Barba.Pjax.Dom.wrapperId = 'pusher';
				Barba.Pjax.Dom.containerClass = 'pjax-container';
				Barba.Pjax.ignoreClassLink  = 'no-ajax';

				Barba.Pjax.Dom.parseResponse = function(response) {
					// $(window).off();
					// $(document).off();
					pjax.oldDocument = window.document;
					var parser = new DOMParser();
					pjax.newDocument = parser.parseFromString(response, "text/html");



					return originalFn.apply(Barba.Pjax.Dom, arguments);

				};

				Barba.Pjax.preventCheck = function(evt, element){
					if (element == null || element.hasAttribute('data-vc-container') || element.hasAttribute('data-slide')) {
						return false
					}

					var elementToAvoidList = $("#wpadminbar a, .esgbox, .link-mode-inline a, .link-mode-lightbox a, .languages-selector a, .lang-item a, .no-ajax a");
					var YouCanGo = true;

					elementToAvoidList.each(function( e, el){
						if(el == element)
							YouCanGo = false;
					})
					 //debugger
					if( element.hash != '' && element != null){

						var scrollToElement = $( element.hash ).position();

						$('html, body').animate({
							scrollTop: scrollToElement.top
						}, 50);
					}

					if(!YouCanGo)
						return YouCanGo;

					return originalCheck.apply(Barba.Pjax, arguments);
				}
			},

			init : function(){

				var pjax = this;
				pjax.defaultBarba();

				if ( pjax.enablePjax && !$('body').hasClass('woocommerce-page') ) {
					Barba.Pjax.start();
					$('body').addClass( 'pjax' );
				}


				Barba.Pjax.getTransition = function() {
					return pjax.HideShowTransition();
				};

				Barba.Dispatcher.on('transitionCompleted', function() {

					pjax.customJs()
					IRON.initCustomJS()
					IRON.btnPlayAudio()
					IRON.initCountdownLang();
					IRON.initCountdownCenter();
					pjax.ironAudioPlayer();
					pjax.wooCommerce();
					eventsFilter();
					vc_js()

					// if ($("[data-vc-grid-settings]").length) {
						// $("[data-vc-grid-settings]").vcGrid()
					// }

				});

				Barba.Dispatcher.on('initStateChange', function(){
					if (typeof ga === 'function') {
						ga('send', 'pageview', location.pathname);
					}
				})

				Barba.Dispatcher.on('newPageReady', function(){



						pjax.swapMenuClass()
						pjax.swapWPAdminbar()
						pjax.swapLanguageLink()


						pjax.cleanHtml()
						// pjax.activateSlider()
						// pjax.activateEsgGrid()
						pjax.updateState()
						if (IRON.state.menu.menu_type == 'classic-menu') {
							calculateTopPadding('pjax');
							IRON.setupMenu()
						}

						pjax.swapLogo();
						IRON.initFreeWall();
				        IRON.initPopups();
				        IRON.initInputs();
				        IRON.initFitVids();
				        IRON.initVideoLinks();
				        IRON.initDropDownClasses();
				        IRON.initAjaxBlocksLoad();
				        IRON.initLightbox();
				        IRON.initFacebookLikebox();
				        IRON.initTwitter();
						// IRON.initSideMenu();

						if(iron_vars.header_top_menu_hide_on_scroll == 1)
							IRON.initTopMenu();

						IRON.initCircleCentering();
						IRON.initGridDisplayPhoto();
						IRON.initGridDisplayAlbum();
						IRON.initGridDisplayNews();
						IRON.initGridDisplayVideo();

						if(!isMobile && !isiPad)
							IRON.initPusherHeight();

						IRON.initEventCenter();
						IRON.initTwitterCenter();
						IRON.initHeadsetCenter();
						IRON.initIOSCenter();
						IRON.initSubmenuPosition();
						IRON.initSingleDisco();
						IRON.initNewsletterLabel();
						// IRON.initScrollToSection();
				        IRON.initParallax();
						IRON.initDisableHovers();
						IRON.initVcAnimations();
						IRON.initIsotope();
						IRON.initWooImageBack();
						IRON.initWpAdminBar();
						IRON.initSocialShare();

						if (IRON.state.menu.menu_type == 'classic-menu') {
							$(window).on('resize', responsiveMenu);
						}

				});


			},

			AjaxPagePass : function(){
				var pjax = this;
				if ( $( pjax.newDocument ).find('body.woocommerce').length ) {
					window.location.reload()
					return false;
				}else{
					return true;
				}
			},
			swapMenuClass : function(){
				var pjax = this;
				$('#menu-main-menu li').removeClass('current-menu-ancestor current-menu-parent current-menu-item current_page_item')

				$( '#' + $( pjax.newDocument ).find('#menu-main-menu li.current-menu-ancestor').attr('id') ).addClass('current-menu-ancestor')
				$( '#' + $( pjax.newDocument ).find('#menu-main-menu li.current-menu-parent').attr('id') ).addClass('current-menu-parent')
				$( '#' + $( pjax.newDocument ).find('#menu-main-menu li.current-menu-item').attr('id') ).find('a:not([href*="#"])').parent('li').addClass('current-menu-item')
				$( '#' + $( pjax.newDocument ).find('#menu-main-menu li.current_page_item').attr('id') ).addClass('current_page_item')
			},
			swapLogo : function(){
				if (IRON.state.logo.use_alternative_logo == true) {
					$('.site-logo img').attr('src', IRON.state.logo.logo_page_url)
				}else{
					$('.site-logo img').attr('src', IRON.state.logo.logo_url)
				}
			},
			swapLanguageLink : function(){
				var pjax = this;

				if ( $( pjax.newDocument ).find('.languages-selector').length ){
					var langContent = $( pjax.newDocument ).find('.languages-selector').html()
					$( pjax.oldDocument ).find('.languages-selector').html(langContent)
				}
			},

			updateState : function(){
				var pjax = this;

				var pjax_iron_vars = $( pjax.newDocument ).find('script[src*="croma/js/main.js"]').prev('script').text();
				var pos1 = pjax_iron_vars.indexOf('{');
				var pos2 = pjax_iron_vars.lastIndexOf('}') - pjax_iron_vars.length + 1;

				pjax_iron_vars =  JSON.parse( pjax_iron_vars.slice( pos1 , pos2 ) );

				for (var prop in pjax_iron_vars){
					IRON.state[prop] = pjax_iron_vars[prop];
				}



			},

			HideShowTransition : function(){
				var pjax = this;
				var overlay = $('#overlay .perspective');
				var transition = Barba.BaseTransition.extend({
					start: function() {
						Promise
						.all([this.newContainerLoading, this.fadeOut() ])
						.then( this.fadeIn.bind(this) )
					},

					fadeOut: function() {
						var _this = this;
						
						$('html, body').animate({
							scrollTop: 0
						}, 800);

						if ( $('.side-menu').hasClass('open') ) {
							$('.side-menu .menu-toggle-off').trigger('click')
						}
						// $('#pusher').removeAttr('style')
						var fadeOut = anime({
							targets: [ this.oldContainer , '#overlay .perspective' ],
							opacity:0,
							// scale:0.9,
							easing: 'easeOutExpo',
							duration: 1000
						})
						return fadeOut.finished;
					},


					fadeIn: function() {
						var _this = this;
						var $el = $(this.newContainer);
						// pjax.AjaxPagePass();
						 if ( pjax.AjaxPagePass() ) {

							pjax.swapBodyClass();
							$(this.oldContainer).hide();
							pjax.customCss();
							$el.css({
							  visibility : 'visible',
							  opacity : 0
							});

							var fadeIn = anime({
								targets: [this.newContainer, '#overlay .perspective' ],
								opacity: 1,
								// scale:1,
								easing: 'easeOutExpo',
								duration: 1000,
							})
							return fadeIn.finished.then(_this.done())

						 }
					}
				});

				return transition;

			},
			customCss : function(){
				var pjax = this;
				var oldStyleSheet = $( pjax.oldDocument ).find('link[rel="stylesheet"]')
				var newStyleSheet = $( pjax.newDocument ).find('link[rel="stylesheet"]')


				$( pjax.oldDocument ).find('style[data-type*="vc"]').remove()
				$( pjax.newDocument ).find('style[data-type*="vc"]').appendTo('head')
				$(pjax.oldDocument).find('#iron-custom-styles-inline-css').remove()
            	$(pjax.newDocument).find('#iron-custom-styles-inline-css').appendTo('head')

				oldStyleSheet.each(function( index, element ){
					if ( !$( pjax.newDocument ).find('link[id="' + $(this).attr('id') + '"]').length) {
						$(this).remove()
					}
				})

				newStyleSheet.each(function( index, element ){
					if ( !$( pjax.oldDocument ).find('link[id="' + $(this).attr('id') + '"]').length) {
						$(this).appendTo('body')
					}
				})

				var customStyle = $( pjax.oldDocument ).find('#custom-styles-inline-css')
				var newStyle = $( pjax.newDocument ).find('#custom-styles-inline-css')


				customStyle.remove()
				newStyle.appendTo('head')



			},

			swapWPAdminbar : function(){
				var pjax = this;
				var newBar = $( pjax.newDocument ).find('#wpadminbar')
				$('#wpadminbar').html( newBar.html() )

			},
			customJs : function(){
				var pjax = this;

				function loadInline() {
					$('script').not('[type="text/json"]').each(function() {
						var text = $(this).text()
						if (text == '')
							return
	
						if (text.substring(7, 12) == 'CDATA') {
							try {
								eval(text.substring(16, text.length - 10));
								return true;
							} catch (error) {
								console.error(error);
							}
						} else {
							try {
								eval(text);
							} catch (error){
								console.error(error);
							}
						}
	
					})
				}


				var newScript = $(pjax.newDocument).find('head script[src], #pusher-wrap ~ script[src]');

				var DocumentScript = $(pjax.newDocument).find('#pusher-wrap script[src]');
				var loadScript = [];

				newScript.each(function() {
					var script = $(this).attr('src');

					var found = IRON.libraries.find(function(element) {
						return element == script;
					})

					if (typeof found == "undefined") {
						loadScript.push($(this).attr('src'))
					}
				})
				DocumentScript.each(function() {
					loadScript.push($(this).attr('src'))
				})

				if (loadScript.length) {
					$.ajaxSetup({ async: false });

					for (var i = 0; i < loadScript.length; i++) {
						$.getScript(loadScript[i], function() {
							if (i == loadScript.length - 1) {
								loadInline()
							}
						})
					}
					$.ajaxSetup({ async: true });
				} else {
					loadInline();
				}


			},

			cleanHtml : function(){
				var pjax = this;
				$( pjax.oldDocument ).find('.esgbox-overlay, .esgbox-wrap').remove()
			},
			swapBodyClass : function(){
				var pjax = this;
				var newClass = $( pjax.newDocument ).find('body').attr('class');
				$('.vc_row.wpb_row.vc_row-fluid.in_container').has('.rev_slider_wrapper.fullscreen-container, .rev_slider_wrapper.fullwidthbanner-container').removeClass('in_container').addClass('full_width');
				$('body').attr('class', newClass);
				$('body').addClass('pjax');



				if ($('.continuousPlayer').hasClass('enable')) {
					$('body').addClass('continuousPlayer-enable');
				}
			},
			activateEsgGrid : function(){
				$('.esg-grid').parents('.wpb_wrapper').find('script').each(function(){
					eval($(this).text())
				})
			},
			wooCommerce : function(){
				$('.product.has-default-attributes.has-children>.images').css('opacity', 1)
			},

			ironAudioPlayer : function(){
				$('.iron-audioplayer').each(function(){
					var player = Object.create( IRON.audioPlayer );
					player.init( $(this) );
				})
				if ($('.artist_player').length) {
					IRON.artistPlayer.setPlayer()
				}

				if ( elementAudio.src && elementAudio.played.length ) {
					IRON.initPusherHeight()
					$('.continuousPlayer').addClass('enable')
					$('body').addClass('continuousPlayer-enable')
					if ( IRON.continuousPlayer.wavesurfer.isPlaying() ) {
						IRON.continuousPlayer.play()
						IRON.continuousPlayer.play()
					}
				}
			}



	}



	/* PUSHER FORCED HEIGHT */
	IRON.initPusherHeight = function() {
		return
	};

	/* RESET PUSHER HEIGHT */
	IRON.resetPusherHeight = function() {
		return
	};

	/* EVENT WIDGET CENTERING */
	IRON.initEventCenter = function() {
		if(jQuery(window).width() >= 767){
			jQuery(".event-text-wrap, .event-text-wrap-single").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		} else {
			jQuery(".event-text-wrap").css('margin-top',0);
		}

		jQuery(window).resize(function(){
			if(jQuery(window).width() >= 767){
				jQuery(".event-text-wrap, .event-text-wrap-single").each(function(){
					var halfheight = (jQuery(this).height())/2;
					jQuery(this).css('margin-top',(-halfheight));
				});
			} else {
				jQuery(".event-text-wrap").css('margin-top',0);
			}
		});

		jQuery('.title-row').mouseenter(function(){
			if(jQuery(window).width() >= 767){
				jQuery(".event-text-wrap.btn").each(function(){
					var halfheight = (jQuery(this).height())/2;
					jQuery(this).css('margin-top',(-halfheight));
				});
			} else {
				jQuery(".event-text-wrap.btn").css('margin-top',0);
			}
		});
	};

	/* TWITTER WIDGET CENTERING */
	IRON.initTwitterCenter = function() {
		jQuery(".twitter-center").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		jQuery(window).resize(function(){
			jQuery(".twitter-center").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		});
	};

	/* HEADSET ICON CENTERING */
	IRON.initHeadsetCenter = function() {
		jQuery(".album-listen").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		jQuery(window).resize(function(){
			jQuery(".album-listen").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		});
	};

	/* IOS SLIDER TEXT CENTERING */
	IRON.initIOSCenter = function() {
		jQuery(".iosSlider .slider .item .inner a").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		jQuery(window).resize(function(){
			jQuery(".album-listen").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		});
	};

	IRON.initCountdownLang = function() {

		if(iron_vars.lang)
			$.countdown.setDefaults($.countdown.regionalOptions[iron_vars.lang]);

	};

	/* COUNTDOWNS CENTERING */
	IRON.initCountdownCenter = function() {
		jQuery(".countdown-wrap,.event-centering").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		jQuery(window).resize(function(){
			jQuery(".countdown-wrap,.event-centering").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		});

		/* New Type */
		jQuery(".event-line-countdown-wrap .countdown-block").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		jQuery(window).resize(function(){
			jQuery(".event-line-countdown-wrap .countdown-block").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		});

	};

	/* MENU HIERARCHY */
	IRON.initMenuHierarchy = function() {
		var menulevel = 0;
		jQuery(".menu-item").each(function(){
			if(jQuery(this).has("ul").length){
				jQuery(this).children(".has-drop-down-a").append("<div class='sub-arrow'><i class='fas fa fa-angle-right'></i></div>");
			}
		});
		jQuery(".has-drop-down-a").click(function(event) {
			event.preventDefault();
			menulevel = menulevel+1;
			jQuery(this).parent('li').parent('ul').children('li').each(function(){
				jQuery(this).children('a').css('opacity','0');
				jQuery(this).children('a').css('pointer-events','none');
				if(menulevel > 0){
					jQuery('.panel-networks').css('opacity','0');
					jQuery('.panel-networks').css('pointer-events','none');
				}
			});
			jQuery(this).next('ul').addClass('active');
		});
		jQuery(".backlist").click(function(event) {
			event.preventDefault();
			menulevel = menulevel-1;
			jQuery(this).parent('ul.sub-menu').parent('li').parent('ul').children('li').each(function(){
				jQuery(this).children('a').css('opacity','1');
				jQuery(this).children('a').css('pointer-events','auto');
				if(menulevel === 0){
					jQuery('.panel-networks').css('opacity','1');
					jQuery('.panel-networks').css('pointer-events','auto');
				}
			});
			jQuery(this).parent("ul").removeClass('active');
		});
	};

	/* SUB-MENU DYNAMIC POSITIONING */
	IRON.initSubmenuPosition = function() {
		function sidemenuoffset(){
			var menuoffset = jQuery('.nav-menu').offset();
			jQuery('.sub-menu').css('top',menuoffset);
		}
		jQuery(window).resize(function(){
			sidemenuoffset();
		});
		sidemenuoffset();
	};

	/* LARGE SINGLE DISCOGRAPHY */
	IRON.initSingleDisco = function() {
		var discocount = $('.two_column_album .media-block').length;
		if(discocount == 1){
			$('.two_column_album .media-block').addClass('single');
		}
	};

	/* NEWSLETTER LABEL TRANSFORM */
	IRON.initNewsletterLabel = function() {
		jQuery(".nm_mc_input").each(function(){
			var thelabel = $(this).prev("label").text();
			$(this).attr('placeholder',thelabel);
		});
		$(".nm_mc_form label").css('display','none');
	};

	/* DISABLE HOVERS ON MOBILE */
	IRON.initDisableHovers = function() {
		$(document).ready(function() {

			if (isMobile === true || isiPad === true){
				jQuery('.countdown-wrap').css('display','none');
				jQuery('.button-wrap').css('display','none');
				jQuery('.buttons').removeClass('no-touchevents');
				jQuery('html').removeClass('no-touchevents');
			}
        });
	};

	/* ISOTOPE NEWS GRID */
	IRON.initIsotope = function() {
		$.Isotope.prototype._getCenteredMasonryColumns = function() {
			this.width = this.element.width();
			var parentWidth = this.element.parent().width();
			var colW = this.options.masonry && this.options.masonry.columnWidth || // i.e. options.masonry && options.masonry.columnWidth
			this.$filteredAtoms.outerWidth(true) || // or use the size of the first item
			parentWidth; // if there's no items, use size of container
			var cols = Math.floor(parentWidth / colW);
			cols = Math.max(cols, 1);
			this.masonry.cols = cols; // i.e. this.masonry.cols = ....
			this.masonry.columnWidth = colW; // i.e. this.masonry.columnWidth = ...
		};
		$.Isotope.prototype._masonryReset = function() {
			this.masonry = {}; // layout-specific props
			this._getCenteredMasonryColumns(); // FIXME shouldn't have to call this again
			var i = this.masonry.cols;
			this.masonry.colYs = [];
				while (i--) {
				this.masonry.colYs.push(0);
			}
		};
		$.Isotope.prototype._masonryResizeChanged = function() {
			var prevColCount = this.masonry.cols;
			this._getCenteredMasonryColumns(); // get updated colCount
			return (this.masonry.cols !== prevColCount);
		};
		$.Isotope.prototype._masonryGetContainerSize = function() {
			var unusedCols = 0,
			i = this.masonry.cols;
				while (--i) { // count unused columns
				if (this.masonry.colYs[i] !== 0) {
					break;
				}
				unusedCols++;
			}
			return {
				height: Math.max.apply(Math, this.masonry.colYs),
				width: (this.masonry.cols - unusedCols) * this.masonry.columnWidth // fit container to columns that have been used;
			};
		};
		$('.isotope-wrap').isotope({
		  itemSelector : '.news-grid-wrap'
		});
		setTimeout(function() {
			$('.isotope-wrap').isotope('reloadItems').isotope('reLayout');
		},200);
	};

	IRON.initParallax = function (){
		setTimeout(function(){
			$("div.wpb_row.parallax").each(function() {
				var bgimage = $(this).css('background-image');
				if(bgimage && bgimage !== '' && bgimage !== 'none') {
					if(!( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )) {
						$(this).parallax("50%", 0.4, false);
						$('.parallax, .page-banner-bg').addClass('enabled');
					}
					// Parallax Fix for Mobile Devices
					if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
						//$(this).css({'background-attachment': 'scroll'});
						$('.parallax').addClass('disabled');
					}
				}
			});
		},1000);

	};

	IRON.initBackToTop = function() {

		$('#back-to-top, #back-to-top-mobile').on('click', function (e) {

			e.preventDefault();

			$('html, body').animate({
				scrollTop: 0
			}, 800);
		});
	};

	IRON.initScrollToSection = function() {

		var animating = false;
		// Iterate over all nav links, setting the "selected" class as-appropriate.

        $(document).on('click', 'a[href*="#"]:not([data-vc-tabs]):not(.sandwich-icon):not([data-slide])', function(e){

			var target = $(this).attr('href');

		  	if(target.charAt(0) != '#') {
			  	target = target.split('#');
			  	target = '#'+target[1];
		  	}
			var $target = $(target);
			if( $(target).hasClass('vc_tta-panel') )
				// e.preventDefault()
            	return

            if( $(this).parents('.comment-navigation').length ){
                return true;
            }


			if(animating || $(this).hasClass('ui-tabs-anchor') )
				return false;



		  	if($(target).length > 0) {
		  		e.preventDefault();
		  		animating = true;

		  		var menu_open = $('.side-menu').hasClass('open');
		  		var timeout = 10;

		  		if(menu_open) {
		  			$('.side-menu.open .menu-toggle-off').click();
		  			timeout = 400;
		  		}

		  		setTimeout(function() {

			  		var top = $(target).position().top;

			  		animating = true;
			  		$('html, body').animate({
						scrollTop: top
					}, 800, function() {

						animating = false;
					});

		  		}, timeout);

		  	}

		});

	};

	IRON.initVcAnimations = function() {

		if(navigator.userAgent.match(/iPhone|iPad|iPod/i))
            jQuery('.wpb_animate_when_almost_visible').removeClass('wpb_animate_when_almost_visible');

		var single_album = $('body').hasClass('single-photo-album');


	};

	IRON.initWooImageBack = function (){
		$('.attachment-shop_catalog').each(function() {
			$(this).wrap('<div class="tint"></div>');
		});
	};


	IRON.initCustomJS = function() {
		// debugger
        jQuery('.event-no-redirect a.event-link').on('click', function(e){
            e.preventDefault();
            return false
        })
		if(iron_vars.custom_js !== '') {
			// debugger
			eval(iron_vars.custom_js);
		}

	};










	$(document).ready(function() {

		$(window).resize();
		setTimeout(function() {
			$(window).resize();
			 jQuery('header').animate({'opacity': 1});
		},1000);


	$('.vc_row.wpb_row.vc_row-fluid.in_container').has('.rev_slider_wrapper.fullscreen-container, .rev_slider_wrapper.fullwidthbanner-container').removeClass('in_container').addClass('full_width');


		$('.button-widget').each(function() {
			var initialcolor = $(this).css('color');
			var initialbg = $(this).css('background-color');
			var initialborder = $(this).css('border-top-color');

			$(this).mouseover(function(){
				var bghovercolor = $(this).attr('data-hoverbg');
				var texthovercolor = $(this).attr('data-hovertext');
				var borderhovercolor = $(this).attr('data-hoverborder');
				$(this).css('border-color',borderhovercolor);
				$(this).css('background-color',bghovercolor);
				$(this).css('color',texthovercolor);
			});
			$(this).mouseout(function(){
				$(this).css('border-color',initialborder);
				$(this).css('background-color',initialbg);
				$(this).css('color',initialcolor);
			});
		});
	});

	/* Portfolio Button Hover */
	$(document).ready(function(){
		$('.portfolio-button').each(function() {
			var initialcolor = $(this).css('color');
			var initialbg = $(this).css('background-color');
			var initialborder = $(this).css('border-top-color');

			$(this).mouseover(function(){
				$(this).css('background-color',initialborder);
				$(this).css('color','#FFF');
			});
			$(this).mouseout(function(){
				$(this).css('background-color',initialbg);
				$(this).css('color',initialcolor);
			});
		});
	});

	/* Fit Text - Auto-Resize page titles */
	$(document).ready(function(){
		/*$('.page-title h1, h1.page-title').fitText(1.2,{maxFontSize:'60px'});*/
		$('.fittext h1, .fittext h2, .fittext h3, .fittext h4, .fittext h5, .fittext h6').fitText(1.2,{maxFontSize:'85px'});
	});

	/* SUB-MENU ARROW CENTERING */
	$(document).ready(function(){
		jQuery(".sub-arrow i").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		jQuery(window).resize(function(){
			jQuery(".sub-arrow i").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		});
	});

    /* Remove link on ancestor item from responsive menu */
    $(document).ready(function() {
        if ($( '.responsive-header' ).length || $( '.side-menu' ).length ){
            $('.menu-item-has-children>a').attr('href', '#');
        }
	});

	/* FOOTER TEXT CENTERING */
	$(document).ready(function(){
		function footertext(){
			var footerheight = $('.footer-wrapper').height();
			$(".footer-wrapper .text").each(function(){
				var footertextheight = $(this).height();
				var centeredtext = (footerheight/2)-(footertextheight/2);
				$(this).css('top',centeredtext);
			});
		}
		footertext();
		$(window).resize(function(){
			footertext();
		});
	});


	/* BACKTOTOP BUTTON */
	$(document).ready(function(){
		var wrapper = document.getElementById("wrapper")
		var offsetNeg = $(wrapper).height() / 2
		waypoints = new Waypoint({
			element: wrapper,
			handler: function(direction){
				if (direction == 'down'){
					$('.footer-wrapper-backtotop').addClass('active');
				} else if (direction == 'up'){
					$('.footer-wrapper-backtotop').removeClass('active');
				}
			},
			offset :  '-' + offsetNeg + 'px',
		})
	});

	/* MENU correction*/
	$(document).ready(function(){
		$('.menu-item-language').first().css("display","none");
		$( '.current-menu-item').find('[href*="#"]').parent('.current-menu-item').removeClass('current-menu-item');
	});

	/* Force Width of pagination */
	$(document).ready(function(){
		$('.pages').width($('#post-list').width());
		$(window).resize(function(){
			$('.pages').width($('#post-list').width());
		});
		setTimeout(function() {
			if ($('.isotope-wrap').length){
				$('.pages .alignleft').css('margin-left','7.5px');
				$('.pages .alignright').css('margin-right','7.5px');
			}
		},500);
	});


jQuery(window).load(function(){
	jQuery('header').animate({'opacity': 1});
});


})(jQuery);

