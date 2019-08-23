<?php

/*
Main Coming soon page template
-------------------------------
*/

$nifty_timer = ot_get_option('display_count_down_timer');

?>
<!DOCTYPE html <?php language_attributes(); ?>>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title><?php echo ot_get_option('page_title'); ?></title>
    <meta name="description" content="<?php echo ot_get_option('page_description'); ?>">
    <link rel="stylesheet" href="<?php echo plugins_url('template/assets/css/normalize.css', dirname(__FILE__)); ?>">
    <link rel="stylesheet" href="<?php echo plugins_url('template/assets/css/foundation.css', dirname(__FILE__)); ?>">
    <link rel="stylesheet" href="<?php echo plugins_url('template/assets/css/animate.css', dirname(__FILE__)); ?>">
    <link rel="stylesheet" href="<?php echo plugins_url('template/assets/css/icomoon.css', dirname(__FILE__)); ?>">
    <link rel="stylesheet" href="<?php echo plugins_url('template/assets/css/style.css', dirname(__FILE__)); ?>">

    <script src="<?php echo plugins_url('template/assets/js/vendor/custom.modernizr.js', dirname(__FILE__)); ?>"></script>

    <!-- Default WordPress jQuery lib (sorry, it just have to go this way because of template system limitations) -->

    <script src="<?php echo includes_url('js/jquery/jquery.js', dirname(__FILE__)); ?>"></script>

    <?php

    $background_color = ot_get_option('background_color');
    $sitetitle_font = ot_get_option('choose_sitetitle_font');
    $heading_font = ot_get_option('choose_heading_font');
    $paragraph_font = ot_get_option('choose_paragraph_font');
    $counter_font = ot_get_option('choose_counter_font');
    $button_color = ot_get_option('sign_up_button_color');
    $button_color_hover = ot_get_option('sign_up_button_color_hover');


    echo "<link href='https://fonts.googleapis.com/css?family=" . $sitetitle_font . "&subset=latin,latin-ext' rel='stylesheet' type='text/css'>";
    echo "<link href='https://fonts.googleapis.com/css?family=" . $heading_font . "&subset=latin,latin-ext' rel='stylesheet' type='text/css'>";
    echo "<link href='https://fonts.googleapis.com/css?family=" . $paragraph_font . "&subset=latin,latin-ext' rel='stylesheet' type='text/css'>";
    if ('off' != $nifty_timer) {
        echo "<link href='https://fonts.googleapis.com/css?family=" . $counter_font . "&subset=latin,latin-ext' rel='stylesheet' type='text/css'>";
    }
    echo "<style>";
    echo "body {background:" . $background_color . " !important;}";
    echo '#days, #hours, #minutes, #seconds { color: ' . (ot_get_option('countdown_font_color') ? ot_get_option('countdown_font_color') : '#ffffff') . '; }';
    echo '.timer-bottom { color: ' . (ot_get_option('countdown_font_color_bottom') ? ot_get_option('countdown_font_color_bottom') : '#ffffff') . '; }';
    echo ".button {background:" . $button_color . " !important;}.button:hover {background:" . $button_color_hover . " !important;}";
    echo ".nifty-title {font-family:'" . $sitetitle_font . "' !important;}";
    echo ".nifty-coming-soon-message {font-family:'" . $heading_font . "' !important;}";
    echo ".timer-item {font-family:'" . $counter_font . "' !important;}";
    echo "body p, .nifty-inform, .nifty-success, .nifty-error, input {font-family:'" . $paragraph_font . "' !important;}";
    echo '</style>';

    $weforms_form = ot_get_option('weforms_sign_up_form');
    $weforms_form_enable = ot_get_option('weforms_sign_up_form_enable');

    $nifty_form = ot_get_option('enable_sign_up_form');

    if ($weforms_form_enable == 'off' && $nifty_form != 'off' && $nifty_form != 'on') {
        $nifty_form = 'off';
    }

    if (ot_is_weforms_active()) {
        $weforms_scripts_styles = new WeForms_Scripts_Styles;
        foreach ($weforms_scripts_styles->get_frontend_styles() as $weforms_style) {
            echo "<link href='" . $weforms_style['src'] . "' rel='stylesheet' type='text/css'>" . "\n";
        }

        echo "<script src='" . includes_url('js/wp-embed.min.js', dirname(__FILE__)) . "' type='text/javascript'></script>" . "\n";
        echo "<script src='" . includes_url('js/jquery/ui/core.min.js', dirname(__FILE__)) . "' type='text/javascript'></script>" . "\n";
        echo "<script src='" . includes_url('js/jquery/ui/datepicker.min.js', dirname(__FILE__)) . "' type='text/javascript'></script>" . "\n";
        echo "<script src='" . includes_url('js/jquery/ui/widget.min.js', dirname(__FILE__)) . "' type='text/javascript'></script>" . "\n";
        echo "<script src='" . includes_url('js/jquery/ui/mouse.min.js', dirname(__FILE__)) . "' type='text/javascript'></script>" . "\n";
        echo "<script src='" . includes_url('js/jquery/ui/slider.min.js', dirname(__FILE__)) . "' type='text/javascript'></script>" . "\n";
        echo "<script src='" . includes_url('js/jquery/ui/sortable.min.js', dirname(__FILE__)) . "' type='text/javascript'></script>" . "\n";

        foreach ($weforms_scripts_styles->get_frontend_scripts() as $weforms_script) {
            echo "<script src='" . $weforms_script['src'] . "' type='text/javascript'></script>" . "\n";
        }

        echo '<script>/* <![CDATA[ */
    var wpuf_frontend = {"ajaxurl":"' . admin_url('admin-ajax.php') . '","error_message":"Please fix the errors to proceed","nonce":"' . wp_create_nonce('wpuf_nonce') . '","word_limit":"Word limit reached"};
    var error_str_obj = {"required":"is required","mismatch":"does not match","validation":"is not valid","duplicate":"requires a unique entry and this value has already been used"};
    var wpuf_frontend_upload = {"confirmMsg":"Are you sure?","delete_it":"Yes, delete it","cancel_it":"No, cancel it","nonce":"' . wp_create_nonce('wpuf_nonce') . '","ajaxurl":"' . admin_url('admin-ajax.php') . '","plupload":{"url":"' . admin_url('admin-ajax.php') . '?nonce=' . wp_create_nonce('wpuf-upload-nonce') . '","flash_swf_url":"' . includes_url('js/plupload/plupload.flash.swf') . '","filters":[{"title":"Allowed Files","extensions":"*"}],"multipart":true,"urlstream_upload":true,"warning":"Maximum number of files reached!","size_error":"The file you have uploaded exceeds the file size limit. Please try again.","type_error":"You have uploaded an incorrect file type. Please try again."}};
    /* ]]> */</script>';
    }


    if(nifty_is_notificationx_really_setup_and_active()){

        echo '<link rel="stylesheet" href="' . NOTIFICATIONX_PUBLIC_URL . 'assets/css/notificationx-public.min.css" type="text/css">';
        echo '<script type="text/javascript" src="' . NOTIFICATIONX_PUBLIC_URL . 'assets/js/Cookies.js"></script>';
        echo '<script type="text/javascript" src="' . NOTIFICATIONX_PUBLIC_URL . 'assets/js/notificationx-public.min.js"></script>';
    }


    ?>



</head>

<body <?php body_class(); ?>>
    <div class="nifty-main-wrapper" id="nifty-full-wrapper">

        <!-- Page Preloader -->

        <?php
        $preloader = ot_get_option('enable_preloader');

        if ('off' != $preloader) {
            echo '<div id="preloader"></div>';
        } else {;
        }
        ?>

        <div class="nifty-content-wrapper">
            <header class="nifty-row ">
                <div class="large-12 columns text-center">

                    <!-- Logo and navigation  -->
                    <?php
                    $niftylogo = ot_get_option('disable_logo');
                    $sitepath = get_site_url();
                    $blogname =  get_bloginfo();
                    $sitetitle =  ot_get_option('display_site_title');
                    $logopath =  ot_get_option('upload_your_logo');
                    if ('off' != $niftylogo) {
                        echo '<div class="nifty-logo"><a href="' . $sitepath . '"><img src="' . $logopath . '" alt="' . $blogname . '" /></a></div>';
                    } elseif ('off' != $sitetitle) {
                        echo '<div class="nifty-logo"><h1 class="nifty-title">' . $blogname . '</h1></div>';
                    }
                    ?>

                    <?php
                    $navigation = ot_get_option('disable_navigation');
                    $slide_index = 0;
                    if ('off' != $navigation) {
                        $custom_signup_form = ot_get_option( 'insert_custom_signup_form' );
   
                        echo '<div id="slider-navigation">';
                        if ( $nifty_form != 'off' || strlen($custom_signup_form) > 0 ) {
                            echo '<a data-slide-index="' . ($slide_index) . '" href=""><span aria-hidden="true" class="icon-paperplane"></span></a>';
                            $slide_index++;
                        }
                        echo $weforms_form_enable;
                        if (ot_get_option('enable_contact_details') != 'off') {
                            echo '<a data-slide-index="' . ($slide_index) . '" href=""><span aria-hidden="true" class="icon-location"></span></a>';
                            $slide_index++;
                        }
                        if (ot_get_option('enable_social_links') != 'off') {
                            echo '<a data-slide-index="' . ($slide_index) . '" href=""><span aria-hidden="true" class="icon-thumbs-up"></span></a>';
                            $slide_index++;
                        }
                        echo '</div>';
                    }
                    ?>

                </div>
        </div>
        </header>
        <div class="nifty-row">
            <div class="large-10 small-centered columns text-center">
                <div class="nifty-coming-soon-message">
                    <div id="animated_intro" class="tlt">
                        <ul class="texts" style="display: none">
                            <li><?php echo ot_get_option('your_coming_soon_message', true); ?></li>
                            <li><?php echo ot_get_option('enter_second_coming_soon_message', true); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timer Section -->

        <?php
        $nifty_days = ot_get_option('nifty_days_translate');
        $nifty_hours = ot_get_option('nifty_hours_translate');
        $nifty_minutes = ot_get_option('nifty_minutes_translate');
        $nifty_seconds = ot_get_option('nifty_seconds_translate');

        if ('off' != $nifty_timer) {
            echo '<div class="nifty-row" id="clock">
                <div class="large-8 small-centered columns">
                    <div class="large-3 small-3 columns">
                        <div class="timer-item">
                        <div class="timer-top"><span id="days"></span></div>
                        <div class="timer-bottom">' . $nifty_days . '</div>
                    </div>
                    </div>
                    <div class="large-3 small-3 columns">
                        <div class="timer-item">
                        <div class="timer-top"><span id="hours"></span></div>
                        <div class="timer-bottom">' . $nifty_hours . '</div>
                    </div>
                    </div>
                    <div class="large-3 small-3 columns">
                        <div class="timer-item">
                        <div class="timer-top"><span id="minutes"></span></div>
                        <div class="timer-bottom">' . $nifty_minutes . '</div>
                    </div>
                    </div>
                    <div class="large-3 small-3 columns">
                        <div class="timer-item">
                        <div class="timer-top"><span id="seconds"></span></div>
                        <div class="timer-bottom">' . $nifty_seconds . '</div>
                    </div>
                    </div>
                </div>
        </div>  ';
        } else {;
        }

        ?>

        <!-- Content Section -->

        <div class="nifty-content-full">
            <div class="nifty-row">

                <!-- Slider Section -->

                <ul class="bxslider">

                    <!-- Slide One - Subscribe Here -->

                    <?php

                    if (ot_is_weforms_active() && !empty($weforms_form) && $weforms_form > 0 && $weforms_form_enable != 'off') {
                        echo '<li><section class="large-12 columns">';
                        echo do_shortcode('[weforms id="' . $weforms_form . '"]');
                        echo '</li>';
                    } else {




                        if ('off' != $nifty_form) {
                            echo '<li>
            <section class="large-12 columns"> ';
                            echo '<form id="contact" method="post" action="' . admin_url('admin-ajax.php') . '">
              <div class="large-4 small-centered columns">
            <div class="nifty-inform">';

                            echo ot_get_option('sign_up_form_intro_text');
                            echo '</div>  <div class="nifty-row collapse">
                <div class="small-8 columns">
                  <input type="text" name="email" id="email" autocomplete="off" placeholder="';
                            echo ot_get_option('enter_email_text');
                            echo  '">
            </div>
            <div class="small-4 columns">
                  <input type="submit" value=" ';
                            echo ot_get_option('sign_up_button_text');
                            echo '" name="submit" class="button prefix">
            </div>
            <div class="nifty-success" style="display:none">';
                            echo ot_get_option('email_confirmation___success');
                            echo '</div>
              <div class="nifty-error" style="display:none"> ';
                            echo ot_get_option('email_confirmation___error');
                            echo '</div>
              </div>
            </div>
                </form>
            </section>
            </li>';
                        } else {
                            $custom_signup_form = ot_get_option('insert_custom_signup_form');

                            if (strlen($custom_signup_form) > 0) {
                                echo '<li>
            <section class="large-12 columns"> ';
                                echo ot_get_option('insert_custom_signup_form');
                                echo '</section>
            </li>';
                            }
                        }
                    }

                    ?>

                    <!-- Slide Two - About Us -->

                    <?php
                    $nifty_contact = ot_get_option('enable_contact_details');
                    $contact_website = ot_get_option('enter_you_website_or_company_name');
                    $contact_address = ot_get_option('enter_your_address');
                    $contact_phone = ot_get_option('enter_your_phone_number');
                    $contact_email = ot_get_option('enter_your_email_address');


                    if ('off' != $nifty_contact) {
                        echo '<li>
			<section class="small-12 small-centered columns">
			<div class="nifty-contact-details">
				<p class="contact-website"><strong>' . $contact_website . '
				</strong></p>
				<p class="contact-address"><span aria-hidden="true" class="icon-house"></span>
				' . $contact_address . '</p>
				<p class="contact-phone"><span aria-hidden="true" class="icon-phone"></span>
				' . $contact_phone . '</p><p> <span aria-hidden="true" class="icon-mail"></span> <a href="mailto:' . $contact_email . '">' . $contact_email . '</a></p></div>

			</section>
		  </li>';
                    } else {;
                    }
                    ?>

                    <!-- Slide Three - Social links -->

                    <?php
                    $nifty_social = ot_get_option('enable_social_links');
                    $social_intro = ot_get_option('social_links_intro_text');
                    $social_facebook = ot_get_option('facebook_page_or_profile_url');
                    $social_twitter = ot_get_option('twitter_url');
                    $social_googleplus = ot_get_option('google___profile_or_page_url');
                    $social_linkedin = ot_get_option('linkedin_profile_url');
                    $social_pinterest = ot_get_option('pinterest_url');
                    $social_instagram = ot_get_option('instagram_url');
                    $social_vimeo = ot_get_option('vimeo_url');

                    if ('off' != $nifty_social) {
                        echo '<li>
        <section class="large-12 columns">
		<div class="nifty-row">
        <div class="small-12 small-centered columns">
        <div class="nifty-inform">' . $social_intro .
                            '</div>';
                        if (!empty($social_facebook) && $social_facebook != '#')
                            echo '<a href="' . $social_facebook . '"><span aria-hidden="true" class="icon-facebook"></span></a>';
                        if (!empty($social_twitter) && $social_twitter != '#')
                            echo '<a href="' . $social_twitter . '"><span aria-hidden="true" class="icon-twitter"></span></a>';
                        if (!empty($social_linkedin) && $social_linkedin != '#')
                            echo '<a href="' . $social_linkedin . '"><span aria-hidden="true" class="icon-linkedin"></span></a>';
                        if (!empty($social_pinterest) && $social_pinterest != '#')
                            echo '<a href="' . $social_pinterest . '"><span aria-hidden="true" class="icon-pinterest"></span></a>';
                        if (!empty($social_instagram) && $social_instagram != '#')
                            echo '<a href="' . $social_instagram . '"><span aria-hidden="true" class="icon-instagram"></span></a>';
                        if (!empty($social_googleplus) && $social_googleplus != '#')
                            echo '<a href="' . $social_googleplus . '"><span aria-hidden="true" class="icon-google-plus"></span></a>';
                        if (!empty($social_vimeo) && $social_vimeo != '#')
                            echo '<a href="' . $social_vimeo . '"><span aria-hidden="true" class="icon-vimeo"></span></a>';

                        echo '</div>
            </div>
        </section>
      </li>
		';
                    } else {
                        echo '<section class="large-12 columns"><div class="nifty-row"></div></section>';
                    }
                    ?>


                </ul>
            </div>
        </div>
    </div>


    <!-- jQuery Vegas Background Slider -->

    <?php
    $nifty_background_slider = ot_get_option('disable_background_image_slider');

    if ('off' != $nifty_background_slider) {
        $slide_1 = ot_get_option('upload_slider_images');
        $slide_2 = ot_get_option('upload_slider_images_2');
        $slide_3 = ot_get_option('upload_slider_images_3');
        $slide_4 = ot_get_option('upload_slider_images_4');
        $slider_time = ot_get_option('background_slider_time', '6000');
        $body = '#nifty, body';
        $bck_animation = ot_get_option('background_slider_animation');
        $bck_animation_time = ot_get_option('background_slider_animation_time');
        $pattern = ot_get_option('select_pattern_overlay');
        $pattern_opacity = ot_get_option('pattern_overlay_opacity');
        $pattern_lib = OT_URL . '/assets/images/patterns/';

        echo "<script>
	jQuery(document).ready(function($){
	$('" . $body . "').vegas({
		 animation: 'random',
		 cover: true,
		 animationDuration: '" . $bck_animation_time . "',
		 timer: false,
		 transition: '" . $bck_animation . "',
		 delay:" . $slider_time . ",
		 opacity:" . $pattern_opacity . ",
		 overlay:'" . $pattern_lib . $pattern . "',
			slides: [
				{ src:'" . $slide_1 . "'},
				{ src:'" . $slide_2 . "'},
				{ src:'" . $slide_3 . "'},
				{ src:'" . $slide_4 . "'}
			 ]
    }); });
	</script>";
    } else { }

    ?>

    <?php
    if ('off' != $nifty_timer) {
        ?>
        <script>
            // Timer Settings  //
            jQuery(function($) {
                $('div#clock').countdown("<?php
                                            $timer_state = ot_get_option('setup_the_count_down_timer');
                                            $time_updated = date("Y/m/d H:i", strtotime($timer_state));
                                            echo $time_updated;

                                            ?>", function(event) {
                    var $this = $(this);
                    switch (event.type) {
                        case "seconds":
                        case "minutes":
                        case "hours":
                        case "days":
                        case "weeks":
                        case "daysLeft":
                            $this.find('span#' + event.type).html(event.value);

                            break;
                        case "finished":
                            $this.hide();
                            break;
                    }
                });
            });
        </script>
    <?php
}
?>

    <!-- Footer js scripts -->

    <script src="<?php echo plugins_url('template/assets/js/scripts.js', dirname(__FILE__)); ?>"></script>
    <?php
    if ('off' != $nifty_timer) {
        ?>
        <script src="<?php echo plugins_url('template/assets/js/jquery.countdown.js', dirname(__FILE__)); ?>"></script>
    <?php } ?>
    <script src="<?php echo plugins_url('template/assets/js/jquery.bxslider.min.js', dirname(__FILE__)); ?>"></script>
    <script src="<?php echo plugins_url('template/assets/js/vegas.min.js', dirname(__FILE__)); ?>"></script>
    <script src="<?php echo plugins_url('template/assets/js/jquery.fittext.js', dirname(__FILE__)); ?>"></script>
    <script src="<?php echo plugins_url('template/assets/js/jquery.textillate.js', dirname(__FILE__)); ?>"></script>
    <script src="<?php echo plugins_url('template/assets/js/jquery.lettering.js', dirname(__FILE__)); ?>"></script>

    <?php
    $animation = ot_get_option('disable_animation');

    if ('off' != $animation) {
        echo "<script>
	jQuery(document).ready(function($){
	 $('.tlt').textillate({
  selector: '.texts',
  loop: true,
  minDisplayTime: 2500,
  autoStart: true,
  outEffects: [ 'bounceOut' ],

  // in animation settings
  in: {
    // set the effect name
    effect: 'fadeIn',
    delayScale: 1.5,
    delay: 50,
    sync: false,
    shuffle: true
  },

  // out animation settings.
  out: {
    effect: 'bounceOut',
    delayScale: 1.5,
    delay: 150,
    sync: false,
    shuffle: true,
  }
});
	});
	</script>
";
    } else {
        echo "<script>
   jQuery(document).ready(function($){
	 $('.tlt').textillate({
  selector: '.texts',
  loop: true,
  minDisplayTime: 2500,
  autoStart: true,
  outEffects: [ 'bounceOut' ],

  // in animation settings
  in: {
    effect: 'none',
    delayScale: 1.5,
    delay: 50,
    sync: false,
    shuffle: true
  },

  // out animation settings.
  out: {
    effect: 'bounceOut',
    delayScale: 1.5,
    delay: 150,
    sync: false,
    shuffle: true,
  }
});
	});
	</script>";
    }
    ?>

    <!-- Google Analytics Code -->

    <?php echo ot_get_option('insert_google_analytics_code'); ?>

    <!-- Additional CSS -->

    <?php
    $additional_css_code = ot_get_option('insert_additional_css');

    echo "<style>" . $additional_css_code . "</style>";

    if(isset($nx_bar_html) && is_array($nx_bar_html) && count($nx_bar_html)>0){
        echo implode('',$nx_bar_html);
    }
    ?>

</body>

</html>