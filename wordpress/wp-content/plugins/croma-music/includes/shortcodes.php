<?php

function getCSSAnimation( $css_animation ) {
	$output = '';
	if ( '' !== $css_animation && 'none' !== $css_animation ) {
		wp_enqueue_script( 'waypoints' );
		wp_enqueue_style( 'animate-css' );
		$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation . ' ' . $css_animation;
	}

	return $output;
}




function iron_shortcode_audioplayer( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'albums' => '',
	  'autoplay' => '',
	  'show_playlist' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Music_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};


    the_widget('Iron_Widget_Radio', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<article class="widget '.$isuppercase.' iron_widget_radio '. getCSSAnimation( $css_animation ) .'">', 'after_widget'=>'</article>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_audioplayer', 'iron_shortcode_audioplayer' );

function iron_shortcode_discography( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'albums' => '',
	  'artists_filter' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Music_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Music_Widget_Discography', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_discography ' . getCSSAnimation( $css_animation ) . '">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_discography', 'iron_shortcode_discography' );

function iron_shortcode_events( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'number' => '',
	  'show_date' => null,
	  'filter' => '',
	  'artists_filter' => '',
	  'enable_artists_filter' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Music_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Music_Widget_Events', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_events ' . getCSSAnimation( $css_animation ) . '">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_events', 'iron_shortcode_events' );






























function iron_shortcode_twitter( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'screen_name' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Music_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Twitter', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_twitter ' . getCSSAnimation( $css_animation ) . '">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_twitter', 'iron_shortcode_twitter' );


function iron_shortcode_posts( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'number' => '',
	  'show_date' => 1,
	  'enable_excerpts' => 0,
	  'category' => '',
	  'view' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Music_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Posts', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_posts ' . getCSSAnimation( $css_animation ) . '">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_posts', 'iron_shortcode_posts' );


function iron_shortcode_videos( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'number' => '',
	  'artists_filter' => '',
	  'category' => '',
	  'view' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );


   	ob_start();
	$uppercase_option = Iron_Music_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Videos', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_videos ' . getCSSAnimation( $css_animation ) . '">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_recentvideos', 'iron_shortcode_videos' );


function iron_shortcode_photos( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'albums' => '',
	  'artists_filter' => '',
	  'gallery_layout' => '',
	  'gallery_height' => '',
	  'action_title' => '',
	  'action_obj_id' => '',
	  'action_ext_link' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Music_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Photos', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_photos ' . getCSSAnimation( $css_animation ) . '">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_featuredphotos', 'iron_shortcode_photos' );


function iron_shortcode_iosslider( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'id' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Music_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Ios_Slider', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_iosslider ' . getCSSAnimation( $css_animation ) . '">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'iron_iosslider', 'iron_shortcode_iosslider' );

function iron_shortcode_newsletter( $atts ) {

	extract( shortcode_atts( array(
	  'title' => '',
	  'description' => '',
	  'fid' => '',
	  'css_animation' => '',
	), $atts ) );

   	ob_start();
	$uppercase_option = Iron_Music_Widget::is_widget_title_uppercase();
	if($uppercase_option == true){
		$isuppercase = 'uppercase';
	} else {
		$isuppercase = '';
	};
    the_widget('Iron_Widget_Newsletter', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<div class="widget '.$isuppercase.' iron_widget_newsletter ' . getCSSAnimation( $css_animation ) . '">', 'after_widget'=>'</div>'));
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'iron_newsletter', 'iron_shortcode_newsletter' );

function iron_shortcode_promotion( $atts ) {

	extract( shortcode_atts( array(
	  'image' => '',
	  'title' => '',
	  'title_tag_name' => '',
	  'title_color' => '',
	  'subtitle' => '',
	  'subtitle_tag_name' => '',
	  'subtitle_color' => '',
	  'overlay_color' => '',
	  'title_align' => '',
	  'link_page' => '',
	  'link_product' => '',
	  'link_external' => '',
	  'hover_animation' => '',
	  'css_animation' => '',
	), $atts ) );

	$image = wp_get_attachment_image_src($image,'medium');
	$link = '';
	$linkwrap = '';
	$linkwrap2 = '';

	if(!empty($link_page)) {
		$link = get_permalink($link_page);
		$linkwrap = 'href="';
		$linkwrap2 = '"';
	} else if(!empty($link_product)) {
		$link = get_permalink($link_product);
		$linkwrap = 'href="';
		$linkwrap2 = '"';
	} else {
		$link = $link_external;
		if(!empty($link)){
			$linkwrap = 'href="';
			$linkwrap2 = '"';
		}
	}

	$title_color_style = '';
	if(!empty($title_color)) {
		$title_color_style = ' style="color:'.$title_color.';"';
	}
	$subtitle_color_style = '';
	if(!empty($subtitle_color)) {
		$subtitle_color_style = ' style="color:'.$subtitle_color.';"';
	}

	$output =<<< stop
	<a {$linkwrap}{$link}{$linkwrap2} class="promobox animation-{$hover_animation} {$css_animation}">
		<div class="promo-overlay" style="background:{$overlay_color}"></div>
		<img src="{$image[0]}" class="promopic" alt="{$title_tag_name}">
		<div class="promocontent {$title_align}">
			<div class="promotext"><{$title_tag_name}{$title_color_style}>{$title}</{$title_tag_name}></div>
			<div class="promosubtext"><{$subtitle_tag_name}{$subtitle_color_style}>{$subtitle}</{$subtitle_tag_name}></div>
		</div>
	</a>
stop;
  return $output;
}
add_shortcode( 'iron_promotion', 'iron_shortcode_promotion' );



/*
function iron_shortcode_infobox( $atts ) {

	extract( shortcode_atts( array(
	  'icon' => '',
	  'title' => '',
	  'description' => '',
	  'css_animation' => '',
	), $atts ) );

	$output =<<< stop
	<div class="infobox {$css_animation}">
		<div class="infobox-icon">
			<i class="fa fa-{$icon}"></i>
		</div>
		<div class="infobox-content">
			<{$title_tag_name} class="infobox-title">{$title}</{$title_tag_name}>
			<div class="infobox-description">{$description}</div>
		</div>
		<div class="clear"></div>
	</div>
stop;
  return $output;
}
add_shortcode( 'iron_infobox', 'iron_shortcode_infobox' );
*/


function iron_shortcode_logos( $atts ) {

	extract( shortcode_atts( array(
		'title' => '',
		'logos' => '',
	), $atts ) );

	$logos = explode(',', $logos);

	ob_start();
	?>

	<div class="widget widget-logos-wrap">

	    <?php if(!empty($title)): ?>
	    <span class="heading-t3"></span>
		<h3 class="widgettitle"><?php echo esc_html($title); ?></h3>
		<?php Iron_Music_Widget::get_title_divider(); ?>
	    <?php endif; ?>

		<div id="owlcarousel" class="owl-carousel">

		<?php
		foreach($logos as $logo) {
			$post = get_post($logo);
			$logo_link_type = $post->logo_link_type;
			$logo_link = $post->logo_link;
			$logo_link_external = $post->logo_link_external;
			if($logo_link_type == 'internal') {
				$link = $logo_link;
				$target = "_self";
			} else {
				$link = $logo_link_external;
				$target = "_blank";
			}
			$image = get_the_post_thumbnail($post->ID, 'thumbnail');
			?>
			<a class="item" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><?php echo $image; ?></a>
			<?php
		}
		?>

		</div>
	</div>

	<?php
	$output = ob_get_contents();
    ob_end_clean();
	return $output;
}
add_shortcode( 'iron_logos', 'iron_shortcode_logos' );

function iron_shortcode_button( $atts ) {

	extract( shortcode_atts( array(
	  'text' => '',
	  'link_page' => '',
	  'link_product' => '',
	  'link_external' => '',
	  'border_width' => '1',
	  'border_radius' => '0',
	  'border_h_padding' => '',
	  'border_v_padding' => '',
	  'border_color' => '',
	  'background_color' => '',
	  'text_color' => '',
	  'text_align' => '',
	  'hover_bg_color' => '',
	  'hover_border_color' => '',
	  'hover_text_color' => '',
	), $atts ) );

	$link = '';
	$target = "_self";
	if(!empty($link_page)) {
		$link = get_permalink($link_page);
	} else if(!empty($link_product)) {
		$link = get_permalink($link_product);
	} else {
		$link = $link_external;
		$target = "_blank";
	}
	$output = '
	<a target="'.$target.'" data-hoverbg="'.$hover_bg_color.'" data-hoverborder="'.$hover_border_color.'" data-hovertext="'.$hover_text_color.'"  class="button-widget '.$text_align.'" href="'.esc_url($link).'" style="padding-left:'.$border_h_padding.'px; padding-right:'.$border_h_padding.'px; padding-top:'.$border_v_padding.'px; padding-bottom:'.$border_v_padding.'px; border-width:'.$border_width.'px; border-radius:'.$border_radius.'px; border-color:'.$border_color.'; background-color:'.$background_color.'; color:'.$text_color.'">'.$text.'</a><div class="clear button-clear"></div>';

    return $output;
}
add_shortcode( 'iron_button', 'iron_shortcode_button' );

/*
function iron_shortcode_fancy_title( $atts ) {

	extract( shortcode_atts( array(
		'title' => '',
		'font_weight' => '',
		'font_family' => '',
		'custom_font_family' => '',
		'title_color' => '',
		'title_size' => '',
		'title_align' => '',
		'letter_spacing' => '',
		'animation_css' => '',
		'el_class' => '',
	), $atts ) );

	$id = mt_rand( 999, 9999 );

	if(!empty($custom_font_family)) {
		$font_family = 'google|'.$custom_font_family;
	}

	$font_type = "safefont";

	if(strpos($font_family, 'google|') !== false) {
		$font_type = "google";
		$font_family = str_replace("google|", "", $font_family);
	}

	$styles = 'font-size: '.$title_size.'px;text-align:'.$title_align.';line-height:1;letter-spacing:'.$letter_spacing.'px;color: '.$title_color.';font-weight:'.$font_weight.';';

	$output = '
	<div style="'.$styles.'" id="fancy-title-'.$id.'" class="fancy-title '.$animation_css.' '.$el_class.'">
		<div class="fancytext">' .$title . '</div>
	</div>';

	$output .= iron_get_fontfamily( "#fancy-title-", $id, $font_family, $font_type );

	return $output;
}
add_shortcode( 'iron_fancy_title', 'iron_shortcode_fancy_title' );

*/


function iron_shortcode_image_divider( $atts ) {

	extract( shortcode_atts( array(
	  'divider_image' => '',
	  'divider_color' => '',
	  'divider_align' => '',
	  'divider_padding_top' => '',
	  'divider_padding_bottom' => '',
	), $atts ) );

	$divider_image = ($divider_image) ? (wp_get_attachment_image_src($divider_image, 'thumbnail')) : ('');
	if(empty($divider_color)){
		$divider_color = ( function_exists('croma_music_get_option') )? croma_music_get_option('featured_color') : '#333';
	}
	if($divider_image) $divider_image = '<img src="' . $divider_image[0] . '" class="imagedividerpic" alt="divider">';
	if($divider_image == ""){
			$output =<<< stop
	<div class="dividerwrap" style="padding-top:{$divider_padding_top}px; padding-bottom:{$divider_padding_bottom}px;">
		<div class="defaultdivider {$divider_align}" style="background-color:{$divider_color}"></div>
		<div class="clear"></div>
	</div>
stop;
  return $output;
	}else{
		$output =<<< stop
	<div class="dividerwrap" style="padding-top:{$divider_padding_top}px; padding-bottom:{$divider_padding_bottom}px;">
		<div class="imagedivider {$divider_align}">
		{$divider_image}
		</div>
		<div class="clear"></div>
	</div>
stop;
  return $output;
	};
}
add_shortcode( 'iron_image_divider', 'iron_shortcode_image_divider' );





function iron_shortcode_countdown( $atts ) {


	extract( shortcode_atts( array(
		'end_time' => '',
		'now_time_type' => '',
		'show_months' => '',
		'show_days' => '',
		'show_hours' => '',
		'show_minutes' => '',
		'show_seconds' => '',
		'show_labels' => '',
		'character_separator' => '',
		'numbers_font' => '',
		'labels_font' => '',
		'labels_align' => '',
		'months_label' => '',
		'days_label' => '',
		'hours_label' => '',
		'minutes_label' => '',
		'seconds_label' => '',
		'count_color' => '',
		'count_splitter' => '',

		'numbers_font_size' => '',
		'numbers_letter_spacing' => '',
		'numbers_line_height' => '',
		'labels_font_size' => '',
		'labels_letter_spacing' => '',
		'labels_line_height' => '',
		'numbers_spacing' => '',
		'numbers_margin' => '',

		'tablet_numbers_font_size' => '',
		'tablet_numbers_letter_spacing' => '',
		'tablet_numbers_line_height' => '',
		'tablet_labels_font_size' => '',
		'tablet_labels_letter_spacing' => '',
		'tablet_labels_line_height' => '',
		'tablet_numbers_spacing' => '',
		'tablet_numbers_margin' => '',

		'mobile_numbers_font_size' => '',
		'mobile_numbers_letter_spacing' => '',
		'mobile_numbers_line_height' => '',
		'mobile_labels_font_size' => '',
		'mobile_labels_letter_spacing' => '',
		'mobile_labels_line_height' => '',
		'mobile_numbers_spacing' => '',
		'mobile_numbers_margin' => ''

	), $atts ) );

	if( empty($end_time) )
		return false;


	$timezone_offset = get_option('gmt_offset');

	if ( $timezone_offset ) {
		$timezone_offset = ( $timezone_offset > 0 )? '+'. $timezone_offset : $timezone_offset;
		$date = date_create_from_format('Y-m-d H:i O', '' . $end_time . ' '. $timezone_offset );
	}else{
		$date = date_create_from_format('Y-m-d H:i', '' . $end_time );
	}

	$end_time = $date->format('U') * 1000;


	$uniqid = uniqid();
	$widget_id = "countdown-".$uniqid;


	$format = '';
	$classes = '';
	if(!empty($show_months))
		$format .= 'O';

	if(!empty($show_days))
		$format .= 'D';

	if(!empty($show_hours))
		$format .= 'H';

	if(!empty($show_minutes))
		$format .= 'M';

	if(!empty($show_seconds))
		$format .= 'S';

	if(empty($format)) {
		$format = 'DHMS';
	}

	if(!empty($show_labels)) {
		$classes .= ' show_labels';
	}

	if(!empty($labels_align)) {
		$classes .= ' label-align-'.$labels_align;
	}

	if(empty($character_separator)) {
		$character_separator = ':';
	}

	$numbers_font_css= "";
	if(!empty($numbers_font)) {
		$font_family = explode("|", $numbers_font);

		$font_style = explode(":", urldecode($font_family[1]));
		$font_style = urldecode($font_style[1]);
		$font_style = explode(" ",$font_style);

		if(!empty($font_family[0])) {

			$font_family = explode(":", $font_family[0]);

			if(!empty($font_family[1])) {
				$font_family = explode(":", urldecode($font_family[1]));
				if(!empty($font_family[0])) {
					$font_family = $font_family[0];
					wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $font_family ), '//fonts.googleapis.com/css?family=' . esc_html( $font_family ) );
				}
			}
		}

		$numbers_font_css .= 'font-family: "'.urldecode($font_family).'"!important'.";\r\n";
		$numbers_font_weight = $font_style[0];
		$numbers_font_style = $font_style[1];
	}

	$labels_font_css= "";
	if(!empty($labels_font)) {
		$font_family = explode("|", $labels_font);
		$font_style = explode(":", urldecode($font_family[1]));
		$font_style = urldecode($font_style[1]);
		$font_style = explode(" ",$font_style);

		if(!empty($font_family[0])) {

			$font_family = explode(":", $font_family[0]);

			if(!empty($font_family[1])) {
				$font_family = explode(":", urldecode($font_family[1]));
				if(!empty($font_family[0])) {
					$font_family = $font_family[0];
					wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $font_family ), '//fonts.googleapis.com/css?family=' . esc_html( $font_family ) );
				}
			}
		}

		$labels_font_css .= 'font-family: "'.urldecode($font_family).'"!important'.";\r\n";
		$labels_font_weight = $font_style[0];
		$labels_font_style = $font_style[1];
	}

	ob_start();
	?>

	<div class="widget widget-countdown">
		<!-- HOVER COUNTDOWN -->
		<div class="vc-countdown-wrap <?php echo esc_attr($classes);?>" id="<?php echo esc_attr($widget_id); ?>">
			<div class="countdown-block"></div>
			<div class="clear:both;"></div>
		</div>
	</div>

	<?php
	$html = ob_get_contents();
    ob_end_clean();
    ob_start();
	?>

	<script type="text/javascript">
	jQuery(function(){
		function showsplitter(){
			var count_id = '<?php echo $widget_id; ?>';
			var splitter = '<?php echo $count_splitter; ?>';
			var count_path = '#'+count_id+' .countdown-block .countdown-row .countdown-section';
			jQuery(count_path).after('<div class="count_splitter">'+splitter+'</div>');
		}
		/* Countdown Call */
		function CountCall(Row,Day){
			jQuery('#'+Row+' .countdown-block').countdown({
				until: Day,
				padZeroes: true,
				format:'<?php echo $format;?>',
				timezone: <?php echo $timezone_offset; ?>,
				onTick: showsplitter,
				timeSeparator: '<?php echo $character_separator;?>'
			});
		};
		var targetRow = '<?php echo $widget_id; ?>';
		var targetDay = new Date(<?php echo $end_time;?>);

		CountCall(targetRow,targetDay);
		//jQuery('.countdown-block').countdown('pause');
	});
	</script>

	<?php
	$js = ob_get_contents();
    ob_end_clean();
    ob_start();
	?>
	<div>
		<style scoped>
			#<?php echo $widget_id; ?> {

			}
			#<?php echo $widget_id; ?> .countdown-amount{
				<?php echo $numbers_font_css;?>
				color:<?php echo $count_color;?>;
				font-style:<?php echo $numbers_font_style;?>;
				font-weight:<?php echo $numbers_font_weight;?>;
			}
			#<?php echo $widget_id; ?> .countdown-period{
				<?php echo $labels_font_css;?>
				color:<?php echo $count_color;?>;
				font-style:<?php echo $labels_font_style;?>;
				font-weight:<?php echo $labels_font_weight;?>;
			}
			#<?php echo $widget_id; ?> .count_splitter{
				<?php echo $labels_font_css;?>
				color:<?php echo $count_color;?>;
				font-style:<?php echo $numbers_font_style;?>;
				font-weight:<?php echo $numbers_font_weight;?>;
			}

			<?php /* DESKTOP SIZE */ ?>
			#<?php echo $widget_id; ?> .countdown-block .countdown-amount{
				<?php if(!empty($numbers_font_size)): ?>
				font-size:<?php echo $numbers_font_size; ?>px;
				<?php endif; ?>
				<?php if(!empty($numbers_line_height)): ?>
				line-height:<?php echo $numbers_line_height; ?>px;
				<?php else: ?>
				line-height:<?php echo $numbers_font_size; ?>px;
				<?php endif; ?>
				<?php if(!empty($numbers_letter_spacing)): ?>
				letter-spacing:<?php echo $numbers_letter_spacing; ?>px;
				<?php endif; ?>
			}
			#<?php echo $widget_id; ?> .countdown-block .countdown-period{
				<?php if(!empty($labels_font_size)): ?>
				font-size: <?php echo $labels_font_size; ?>px;
				<?php endif; ?>
				<?php if(!empty($labels_line_height)): ?>
				line-height: <?php echo $labels_line_height; ?>px;
				<?php endif; ?>
				<?php if(!empty($labels_letter_spacing)): ?>
				letter-spacing: <?php echo $labels_letter_spacing; ?>px;
				<?php endif; ?>
			}
			#<?php echo $widget_id; ?> .countdown-block .count_splitter{
				<?php if(!empty($numbers_font_size)): ?>
				font-size:<?php echo $numbers_font_size; ?>px;
				<?php endif; ?>
				<?php if(!empty($numbers_line_height)): ?>
				line-height:<?php echo $numbers_line_height; ?>px;
				<?php else: ?>
				line-height:<?php echo $numbers_font_size; ?>px;
				<?php endif; ?>
			}
			#<?php echo $widget_id; ?> .countdown-block span.countdown-section{
				<?php if(!empty($numbers_spacing)): ?>
				padding-left: <?php echo ($numbers_spacing/2); ?>px;
				padding-right: <?php echo ($numbers_spacing/2); ?>px;
				<?php endif; ?>
			}
			#<?php echo $widget_id; ?> .countdown-block span.countdown-section span.countdown-amount{
				<?php if(!empty($numbers_margin)): ?>
				margin-bottom: <?php echo $numbers_margin; ?>px;
				<?php endif; ?>
			}

			<?php /* TABLET SIZE */ ?>
			@media only screen and (max-width:768px){
				#<?php echo $widget_id; ?> .countdown-block .countdown-amount{
					<?php if(!empty($tablet_numbers_font_size)): ?>
					font-size: <?php echo $tablet_numbers_font_size; ?>px;
					<?php endif; ?>
					<?php if(!empty($tablet_numbers_line_height)): ?>
					line-height: <?php echo $tablet_numbers_line_height; ?>px;
					<?php else: ?>
					line-height: <?php echo $tablet_numbers_font_size; ?>px;
					<?php endif; ?>
					<?php if(!empty($tablet_numbers_letter_spacing)): ?>
					letter-spacing: <?php echo $tablet_numbers_letter_spacing; ?>px;
					<?php endif; ?>
				}
				#<?php echo $widget_id; ?> .countdown-block .countdown-period{
					<?php if(!empty($tablet_labels_font_size)): ?>
					font-size: <?php echo $tablet_labels_font_size; ?>px;
					<?php endif; ?>
					<?php if(!empty($tablet_labels_line_height)): ?>
					line-height: <?php echo $tablet_labels_line_height; ?>px;
					<?php endif; ?>
					<?php if(!empty($tablet_labels_letter_spacing)): ?>
					letter-spacing: <?php echo $tablet_labels_letter_spacing; ?>px;
					<?php endif; ?>
				}
				#<?php echo $widget_id; ?> .countdown-block .count_splitter{
					<?php if(!empty($tablet_numbers_font_size)): ?>
					font-size: <?php echo $tablet_numbers_font_size; ?>px;
					<?php endif; ?>
					<?php if(!empty($tablet_numbers_line_height)): ?>
					line-height: <?php echo $tablet_numbers_line_height; ?>px;
					<?php else: ?>
					line-height: <?php echo $tablet_numbers_font_size; ?>px;
					<?php endif; ?>
				}
				#<?php echo $widget_id; ?> .countdown-block span.countdown-section{
					<?php if(!empty($tablet_numbers_spacing)): ?>
					padding-left: <?php echo ($tablet_numbers_spacing/2); ?>px;
					padding-right: <?php echo ($tablet_numbers_spacing/2); ?>px;
					<?php endif; ?>
				}
				#<?php echo $widget_id; ?> .countdown-block span.countdown-section span.countdown-amount{
					<?php if(!empty($tablet_numbers_margin)): ?>
					margin-bottom: <?php echo $tablet_numbers_margin; ?>px;
					<?php endif; ?>
				}
			}

			<?php /* MOBILE SIZE */ ?>
			@media only screen and (max-width:480px){
				#<?php echo $widget_id; ?> .countdown-block .countdown-amount{
					<?php if(!empty($mobile_numbers_font_size)): ?>
					font-size: <?php echo $mobile_numbers_font_size; ?>px;
					<?php endif; ?>
					<?php if(!empty($mobile_numbers_line_height)): ?>
					line-height: <?php echo $mobile_numbers_line_height; ?>px;
					<?php else: ?>
					line-height: <?php echo $mobile_numbers_font_size; ?>px;
					<?php endif; ?>
					<?php if(!empty($mobile_numbers_letter_spacing)): ?>
					letter-spacing: <?php echo $mobile_numbers_letter_spacing; ?>px;
					<?php endif; ?>
				}
				#<?php echo $widget_id; ?> .countdown-block .countdown-period{
					<?php if(!empty($mobile_labels_font_size)): ?>
					font-size: <?php echo $mobile_labels_font_size; ?>px;
					<?php endif; ?>
					<?php if(!empty($mobile_labels_line_height)): ?>
					line-height: <?php echo $mobile_labels_line_height; ?>px;
					<?php endif; ?>
					<?php if(!empty($mobile_labels_letter_spacing)): ?>
					letter-spacing: <?php echo $mobile_labels_letter_spacing; ?>px;
					<?php endif; ?>
				}
				#<?php echo $widget_id; ?> .countdown-block .count_splitter{
					<?php if(!empty($mobile_numbers_font_size)): ?>
					font-size: <?php echo $mobile_numbers_font_size; ?>px;
					<?php endif; ?>
					<?php if(!empty($mobile_numbers_line_height)): ?>
					line-height: <?php echo $mobile_numbers_line_height; ?>px;
					<?php else: ?>
					line-height: <?php echo $mobile_numbers_font_size; ?>px;
					<?php endif; ?>
				}
				#<?php echo $widget_id; ?> .countdown-block span.countdown-section{
					<?php if(!empty($mobile_numbers_spacing)): ?>
					padding-left: <?php echo ($mobile_numbers_spacing/2); ?>px;
					padding-right: <?php echo ($mobile_numbers_spacing/2); ?>px;
					<?php endif; ?>
				}
				#<?php echo $widget_id; ?> .countdown-block span.countdown-section span.countdown-amount{
					<?php if(!empty($mobile_numbers_margin)): ?>
					margin-bottom: <?php echo $mobile_numbers_margin; ?>px;
					<?php endif; ?>
				}
			}
		</style>
	</div>
	<?php
	$css = ob_get_contents();
    ob_end_clean();



    $iron_countdown = $css . $js . $html;
    return $iron_countdown;

}
add_shortcode( 'iron_countdown', 'iron_shortcode_countdown' );