<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$iron_croma_fonts = $this->getAttributes( $atts );
$iron_croma_atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $iron_croma_atts , EXTR_PREFIX_ALL, 'iron_croma');


extract( $this->getStyles( $iron_croma_el_class, $iron_croma_css, $iron_croma_fonts['google_fonts_data'], $iron_croma_fonts['font_container_data'], $iron_croma_atts ),  EXTR_PREFIX_ALL, 'iron_croma' );




$iron_croma_settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $iron_croma_settings ) && ! empty( $iron_croma_settings ) ) {
	$iron_croma_subsets = '&subset=' . implode( ',', $iron_croma_settings );
} else {
	$iron_croma_subsets = '';
}

if ( isset( $iron_croma_fonts['google_fonts_data']['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $iron_croma_fonts['google_fonts_data']['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $iron_croma_fonts['google_fonts_data']['values']['font_family'] . $iron_croma_subsets );
}


if($iron_croma_atts['fit_bg_text'] == 1) {
	$iron_croma_css_class .= " fit_bg_text ";
	if(in_array("text-align: center", $iron_croma_styles)){
		$iron_croma_css_class .= " fit_bg_center";
	}

}

if ( ! empty( $iron_croma_styles ) ) {
	$iron_croma_style = 'style="' . esc_attr( implode( ';', $iron_croma_styles ) ) . '"';
} else {
	$iron_croma_style = '';
}
// CUSTOM FIT TO BG


if ( 'post_title' === $iron_croma_source ) {
	$iron_croma_text = get_the_title( get_the_ID() );
}

if ( ! empty( $iron_croma_link ) ) {
	$iron_croma_link = vc_build_link( $iron_croma_link );
	$iron_croma_text = '<a href="' . esc_attr( $iron_croma_link['url'] ) . '"'
		. ( $iron_croma_link['target'] ? ' target="' . esc_attr( $iron_croma_link['target'] ) . '"' : '' )
		. ( $iron_croma_link['title'] ? ' title="' . esc_attr( $iron_croma_link['title'] ) . '"' : '' )
		. '>' . $iron_croma_text . '</a>';
}

$iron_croma_output = '';
if ( apply_filters( 'vc_custom_heading_template_use_wrapper', false ) ) {
	$iron_croma_output .= '<div class="' . esc_attr( $iron_croma_css_class ) . ' ' . $this->getCSSAnimation( $iron_croma_css_animation ) . '" >';
	$iron_croma_output .= '<' . $iron_croma_fonts['font_container_data']['values']['tag'] . ' ' . $iron_croma_style . ' >';
	$iron_croma_output .= $iron_croma_text;
	$iron_croma_output .= '</' . $iron_croma_fonts['font_container_data']['values']['tag'] . '>';
	$iron_croma_output .= '</div>';
} else {
	$iron_croma_output .= '<' . $iron_croma_fonts['font_container_data']['values']['tag'] . ' ' . $iron_croma_style . ' class="' . esc_attr( $iron_croma_css_class ) . ' ' . $this->getCSSAnimation($iron_croma_css_animation) . '">';
	$iron_croma_output .= $iron_croma_text;
	$iron_croma_output .= '</' . $iron_croma_fonts['font_container_data']['values']['tag'] . '>';
}

echo $iron_croma_output;


if(array_key_exists('fit_bg_text', $iron_croma_atts) && $iron_croma_atts['fit_bg_text'] == "fit_yes") {
	echo '<div class="clear"></div>';
}
