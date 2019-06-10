<?php

$iron_croma_atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $iron_croma_atts , EXTR_PREFIX_ALL, 'iron_croma');

wp_enqueue_script( 'wpb_composer_front_js' );

$iron_croma_el_class = $this->getExtraClass( $iron_croma_el_class );
$iron_croma_css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_inner',
	'vc_row-fluid',
	$iron_croma_el_class,
	vc_shortcode_custom_css_class( $iron_croma_css ),
);

if(empty($iron_croma_iron_row_type))
	$iron_croma_iron_row_type = "in_container";

if(!empty($iron_croma_iron_parallax))
	$iron_croma_iron_parallax = " parallax";

if(!empty($iron_croma_iron_overlay_color)) {
	$iron_croma_iron_overlay_color = 'background-color: '.$iron_croma_iron_overlay_color.';';
}
if(!empty($iron_croma_iron_overlay_pattern)) {
	$iron_croma_iron_overlay_pattern = 'background-image: url('.IRON_MUSIC_DIR_URL.'/admin/assets/img/vc/patterns/'.$iron_croma_iron_overlay_pattern.'.png)';
}

if (vc_shortcode_custom_css_has_property( $iron_croma_css, array('border', 'background') )) {
	$iron_croma_css_classes[]='vc_row-has-fill';
}

if (!empty($iron_croma_atts['gap'])) {
	$iron_croma_css_classes[] = 'vc_column-gap-'.$iron_croma_atts['gap'];
}

if ( ! empty( $iron_croma_equal_height ) ) {
	$iron_croma_flex_row = true;
	$iron_croma_css_classes[] = ' vc_row-o-equal-height';
}

if ( ! empty( $iron_croma_content_placement ) ) {
	$iron_croma_flex_row = true;
	$iron_croma_css_classes[] = ' vc_row-o-content-' . $iron_croma_content_placement;
}

if ( ! empty( $iron_croma_flex_row ) ) {
	$iron_croma_css_classes[] = ' vc_row-flex';
}


if(!empty($iron_croma_iron_bg_video)) {

	if ( !class_exists('Mobile_Detect')) {
		include_once(IRON_MUSIC_DIR_PATH.'includes/class/Mobile_Detect.php');
	}
	$detect = new Mobile_Detect();

	$iron_croma_iron_parallax = "";

	$iron_croma_iron_bg_video = " has-bg-video";

	$video_poster = "";
	if(!empty($iron_croma_iron_bg_video_poster)) {
		$data = wp_get_attachment_image_src($iron_croma_iron_bg_video_poster, 'large');
		if(!empty($data[0]))
			$video_poster = $data[0];
	}



	$override_bg_image = false;

	if (!$detect->isMobile() && !$detect->isTablet()) {

		$iron_croma_bg_video = '<div class="bg-video-wrap">';

			$iron_croma_bg_video .= '<video class="bg-video" data-object-fit="cover" poster="'.$video_poster.'" preload="auto" loop autoplay muted>';

			if(!empty($iron_croma_iron_bg_video_mp4)) {
				$iron_croma_bg_video .= '<source type="video/mp4" src="'.$iron_croma_iron_bg_video_mp4.'">';
			}

			if(!empty($iron_bg_video_webm)) {
				$iron_croma_bg_video .= '<source type="video/webm" src="'.$iron_bg_video_webm.'">';
			}

			$iron_croma_bg_video .= '</video>';

		$iron_croma_bg_video .= '</div>';

	}else if(!empty($video_poster)){

		$iron_croma_bg_video = '<div style="position:absolute;top:0;left:0;width:100%;height:100%;background-size:cover;background-repeat:no-repeat;background-image:url('.$video_poster.');"></div>';

	}


}


$iron_croma_css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,  implode( ' ', array_filter( $iron_croma_css_classes )).' '.'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . ( isset($iron_croma_custom) ? $iron_croma_custom : '' ) . $iron_croma_el_class . vc_shortcode_custom_css_class( $iron_croma_css, ' ' ), $this->settings['base'], $iron_croma_atts ).' '.$iron_croma_iron_row_type. ( isset( $iron_croma_iron_parallax )? $iron_croma_iron_parallax : '' ) .$iron_croma_iron_bg_video;
if(!empty($iron_remove_padding_medium)) {

	$iron_croma_css_class .= ' tabletnopadding';
}

if(!empty($iron_remove_padding_small)) {

	$iron_croma_css_class .= ' mobilenopadding';
}

$iron_croma_output = '<div '.(!empty($iron_id) ? 'id="'.$iron_id.'"' : '').' class="'.$iron_croma_css_class.' ' . $this->getCSSAnimation( $iron_croma_css_animation ) . '">';

	if(!empty($iron_croma_bg_video)){
		$iron_croma_output .= $iron_croma_bg_video;
	}

    if( !empty($iron_croma_iron_overlay_color) || !empty($iron_croma_iron_overlay_pattern)){
        $iron_croma_output .= '<div class="background-overlay" style="'.$padding.' '.$iron_croma_iron_overlay_color.' '.$iron_croma_iron_overlay_pattern.';"></div>';
    }

	$iron_croma_output .= wpb_js_remove_wpautop($content);

$iron_croma_output .= '</div>'.$this->endBlockComment('row');

echo $iron_croma_output;