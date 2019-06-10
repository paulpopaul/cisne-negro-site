<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $iron_croma_atts
 * @var $iron_croma_title
 * @var $iron_croma_source
 * @var $iron_croma_image
 * @var $iron_croma_custom_src
 * @var $iron_croma_onclick
 * @var $iron_croma_img_size
 * @var $iron_croma_external_img_size
 * @var $iron_croma_caption
 * @var $iron_croma_img_link_large
 * @var $iron_croma_link
 * @var $iron_croma_img_link_target
 * @var $iron_croma_alignment
 * @var $iron_croma_el_class
 * @var $iron_croma_css_animation
 * @var $iron_croma_style
 * @var $iron_croma_external_style
 * @var $iron_croma_border_color
 * @var $iron_croma_css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Single_image
 */

$iron_croma_atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $iron_croma_atts , EXTR_PREFIX_ALL, 'iron_croma');

$iron_croma_default_src = vc_asset_url( 'vc/no_image.png' );

// backward compatibility. since 4.6
if ( empty( $iron_croma_onclick ) && isset( $iron_croma_img_link_large ) && 'yes' === $iron_croma_img_link_large ) {
	$iron_croma_onclick = 'img_link_large';
} elseif ( empty( $iron_croma_atts['onclick'] ) && ( ! isset( $iron_croma_atts['img_link_large'] ) || 'yes' !== $iron_croma_atts['img_link_large'] ) ) {
	$iron_croma_onclick = 'custom_link';
}

if ( 'external_link' === $iron_croma_source ) {
	$iron_croma_style = $iron_croma_external_style;
	$iron_croma_border_color = $iron_croma_external_border_color;
}

$iron_croma_border_color = ( '' !== $iron_croma_border_color ) ? ' vc_box_border_' . $iron_croma_border_color : '';

$iron_croma_img = false;

switch ( $iron_croma_source ) {
	case 'media_library':
	case 'featured_image':

		if ( 'featured_image' === $iron_croma_source ) {
			$post_id = get_the_ID();
			if ( $post_id && has_post_thumbnail( $post_id ) ) {
				$iron_croma_img_id = get_post_thumbnail_id( $post_id );
			} else {
				$iron_croma_img_id = 0;
			}
		} else {
			$iron_croma_img_id = preg_replace( '/[^\d]/', '', $iron_croma_image );
		}

		// set rectangular
		if ( preg_match( '/_circle_2$/', $iron_croma_style ) ) {
			$iron_croma_style = preg_replace( '/_circle_2$/', '_circle', $iron_croma_style );
			$iron_croma_img_size = $this->getImageSquareSize( $iron_croma_img_id, $iron_croma_img_size );
		}

		if ( ! $iron_croma_img_size ) {
			$iron_croma_img_size = 'medium';
		}

		$iron_croma_img = wpb_getImageBySize( array(
			'attach_id' => $iron_croma_img_id,
			'thumb_size' => $iron_croma_img_size,
			'class' => 'vc_single_image-img',
		) );

		// don't show placeholder in public version if post doesn't have featured image
		if ( 'featured_image' === $iron_croma_source ) {
			if ( ! $iron_croma_img && 'page' === vc_manager()->mode() ) {
				return;
			}
		}

		break;

	case 'external_link':
		$dimensions = vcExtractDimensions( $iron_croma_external_img_size );
		$hwstring = $dimensions ? image_hwstring( $dimensions[0], $dimensions[1] ) : '';

		$iron_croma_custom_src = $iron_croma_custom_src ? esc_attr( $iron_croma_custom_src ) : $iron_croma_default_src;

		$iron_croma_img = array(
			'thumbnail' => '<img class="vc_single_image-img" ' . $hwstring . ' src="' . $iron_croma_custom_src . '" />',
		);
		break;

	default:
		$iron_croma_img = false;
}

if ( ! $iron_croma_img ) {
	$iron_croma_img['thumbnail'] = '<img class="vc_img-placeholder vc_single_image-img" src="' . $iron_croma_default_src . '" />';
}

$iron_croma_el_class = $this->getExtraClass( $iron_croma_el_class );

// backward compatibility
if ( vc_has_class( 'prettyphoto', $iron_croma_el_class ) ) {
	$iron_croma_onclick = 'link_image';
}

// backward compatibility. will be removed in 4.7+
if ( ! empty( $iron_croma_atts['img_link'] ) ) {
	$iron_croma_link = $iron_croma_atts['img_link'];
	if ( ! preg_match( '/^(https?\:\/\/|\/\/)/', $iron_croma_link ) ) {
		$iron_croma_link = 'http://' . $iron_croma_link;
	}
}

// backward compatibility
if ( in_array( $iron_croma_link, array( 'none', 'link_no' ) ) ) {
	$iron_croma_link = '';
}

$iron_croma_a_attrs = array();

switch ( $iron_croma_onclick ) {
	case 'img_link_large':

		if ( 'external_link' === $iron_croma_source ) {
			$iron_croma_link = $iron_croma_custom_src;
		} else {
			$iron_croma_link = wp_get_attachment_image_src( $iron_croma_img_id, 'large' );
			$iron_croma_link = $iron_croma_link[0];
		}

		break;

	case 'link_image':
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );

		$iron_croma_a_attrs['class'] = 'prettyphoto';
		$iron_croma_a_attrs['rel'] = 'prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']';

		// backward compatibility
		if ( vc_has_class( 'prettyphoto', $iron_croma_el_class ) ) {
			// $link is already defined
		} elseif ( 'external_link' === $iron_croma_source ) {
			$iron_croma_link = $iron_croma_custom_src;
		} else {
			$iron_croma_link = wp_get_attachment_image_src( $iron_croma_img_id, 'large' );
			$iron_croma_link = $iron_croma_link[0];
		}

		break;

	case 'custom_link':
		// $link is already defined
		break;

	case 'zoom':
		wp_enqueue_script( 'vc_image_zoom' );

		if ( 'external_link' === $iron_croma_source ) {
			$large_img_src = $iron_croma_custom_src;
		} else {
			$large_img_src = wp_get_attachment_image_src( $iron_croma_img_id, 'large' );
			if ( $large_img_src ) {
				$large_img_src = $large_img_src[0];
			}
		}

		$iron_croma_img['thumbnail'] = str_replace( '<img ', '<img data-vc-zoom="' . $large_img_src . '" ', $iron_croma_img['thumbnail'] );

		break;
}

// backward compatibility
if ( vc_has_class( 'prettyphoto', $iron_croma_el_class ) ) {
	$iron_croma_el_class = vc_remove_class( 'prettyphoto', $iron_croma_el_class );
}

$iron_croma_wrapperClass = 'vc_single_image-wrapper ' . $iron_croma_img_fullwidth . ' ' . $iron_croma_style . ' ' . $iron_croma_border_color;

if ( $iron_croma_link ) {
	$iron_croma_a_attrs['href'] = $iron_croma_link;
	$iron_croma_a_attrs['target'] = $iron_croma_img_link_target;
	if ( ! empty( $iron_croma_a_attrs['class'] ) ) {
		$iron_croma_wrapperClass .= ' ' . $iron_croma_a_attrs['class'];
		unset( $iron_croma_a_attrs['class'] );
	}
	$html = '<a ' . vc_stringify_attributes( $iron_croma_a_attrs ) . ' class="' . $iron_croma_wrapperClass . '">' . $iron_croma_img['thumbnail'] . '</a>';
} else {
	$html = '<div class="' . $iron_croma_wrapperClass . '">' . $iron_croma_img['thumbnail'] . '</div>';
}



$iron_croma_class_to_filter = 'wpb_single_image wpb_content_element vc_align_' . $iron_croma_alignment . ' ' . $this->getCSSAnimation( $iron_croma_css_animation );
$iron_croma_class_to_filter .= vc_shortcode_custom_css_class( $iron_croma_css, ' ' ) . $this->getExtraClass( $iron_croma_el_class );
$iron_croma_css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $iron_croma_class_to_filter, $this->settings['base'], $iron_croma_atts );

if ( in_array( $iron_croma_source, array( 'media_library', 'featured_image' ) ) && 'yes' === $iron_croma_add_caption ) {
	$post = get_post( $iron_croma_img_id );
	$iron_croma_caption = $post->post_excerpt;
} else {
	if ( 'external_link' === $iron_croma_source ) {
		$iron_croma_add_caption = 'yes';
	}
}

if ( 'yes' === $iron_croma_add_caption && '' !== $iron_croma_caption ) {
	$html .= '<figcaption class="vc_figure-caption">' . esc_html( $iron_croma_caption ) . '</figcaption>';
}

$iron_croma_output = '
	<div class="' . esc_attr( trim( $iron_croma_css_class ) ) . ' ' . $this->getCSSAnimation( $iron_croma_css_animation ) . '">
		' . wpb_widget_title( array( 'title' => $iron_croma_title, 'extraclass' => 'wpb_singleimage_heading' ) ) . '
		<figure class="wpb_wrapper vc_figure">
			' . $html . '
		</figure>
	</div>
';

echo $iron_croma_output;