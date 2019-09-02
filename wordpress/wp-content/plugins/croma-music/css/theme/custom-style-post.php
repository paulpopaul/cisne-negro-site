<?php
global $wp_query;

if( function_exists('is_shop') && is_shop() ){
	$post_id = wc_get_page_id('shop');
}else{
	$post_id = (!is_null($post) )? $post->ID : NULL;
	$post_id = ( (int) get_option('page_for_posts') === $wp_query->queried_object->ID )? (int) get_option('page_for_posts') : $post_id;
}

$backup_id = $post_id;
$iron_styles = new Dynamic_Styles('croma_single');



	$parents = get_post_ancestors($post_id);

	$background_id = ( Iron_Croma::getField('background', $post_id ) )? Iron_Croma::getField('background', $post_id ) : false ;
	$content_background_color = ( get_post_meta($post_id, 'content_background_color', true) )? get_post_meta($post_id, 'content_background_color', true) : false ;


	while( $background_id && $content_background_color && !empty($parents)) {

		$post_id = array_pop($parents);
		$background_id = Iron_Croma::getField('background', $post_id);
		$content_background_color = get_post_meta($post_id, 'content_background_color', true);
	}

	if( $background_id ) {

		if( $background_id ) {
			$background_url = wp_get_attachment_image_src( $background_id, 'full' );
			$background_url = $background_url[0];
		}else{
			$background_url = 'none';
		}

		$background_repeat = Iron_Croma::getField('background_repeat', $post_id);
		$background_size = Iron_Croma::getField('background_size', $post_id);
		$background_position = Iron_Croma::getField('background_position', $post_id);
		$background_attachment = 'initial';

		$iron_styles->useOptions(false);


		$background = array(
			'background-image' => $background_url,
			'background-repeat' => $background_repeat,
			'background-size' => $background_size,
			'background-position' => ( $background_position != 'null' )? $background_position : '0% 0%',
			'background-attachment' => $background_attachment,
		);

		$iron_styles->setBackground('#overlay .perspective', $background );

	}

	$content_background_color = ( get_post_meta($post_id, 'content_background_color', true) )? get_post_meta($post_id, 'content_background_color', true) : false ;
	$content_background_transparency = Iron_Croma::getField('content_background_transparency', $post_id);

	$iron_styles->useOptions(false);

	if( $content_background_color && isset( $content_background_transparency ) ) {
		$rgb = $iron_styles->hex2rgb( $content_background_color );
		$rgba = "rgba(".($rgb[0].",".$rgb[1].",".$rgb[2].",".$content_background_transparency).")";
		$iron_styles->set('#overlay .perspective', 'background-color', $rgba);

	}else{

		if( $content_background_color )
			$iron_styles->set('#overlay .perspective', 'background-color', $content_background_color);

		if( isset( $content_background_transparency ) )
			$iron_styles->set('#overlay .perspective', 'opacity', $content_background_transparency);
	}


	$content_background_color = ( get_post_meta($post_id, 'background_color', true) )? get_post_meta($post_id, 'background_color', true) : false ;

	if ( $content_background_color )
		$iron_styles->set('#overlay', 'background-color', $content_background_color);

	$iron_styles->useOptions(true);

// FEATURED COLOR


$post_id = $backup_id;

if($post_id) {

	$menu_background = Iron_Croma::getField('classic_menu_background', $post_id);

	if(!empty($menu_background)) {

		$menu_background_alpha = Iron_Croma::getField('classic_menu_background_alpha', $post_id);

		if(isset($menu_background_alpha)) {

			$rgb = $iron_styles->hex2rgb($menu_background);
			$menu_background = "rgba(".($rgb[0].",".$rgb[1].",".$rgb[2].",".$menu_background_alpha).")";
		}

		$iron_styles->useOptions(false);
		$iron_styles->setBackgroundColor('.classic-menu', $menu_background);
		$iron_styles->useOptions(true);


	}else{
		$iron_styles->setBackgroundColor('.classic-menu', 'classic_menu_background');
		$iron_styles->setBackgroundColor('.classic-menu > ul', 'classic_menu_inner_background');
	}

	$iron_styles->useOptions(false);
	$menu_is_over = Iron_Croma::getField('classic_menu_over_content', $post_id);
	$menu_main_item_color = Iron_Croma::getField('classic_menu_main_item_color', $post_id);

	if(!empty($menu_is_over) && !empty($menu_main_item_color)) {

		$iron_styles->set('.classic-menu.fixed:not(.fixed_before):not(.mini):not(.responsive) > ul > li > a, .classic-menu.fixed:not(.fixed_before):not(.mini):not(.responsive) .languages-selector a', 'color', $menu_main_item_color);
		$iron_styles->set('.classic-menu.fixed:not(.absolute_before):not(.mini):not(.responsive) > ul > li > a, .classic-menu.fixed:not(.absolute_before):not(.mini):not(.responsive) .languages-selector a', 'color', $menu_main_item_color);
	}
	$iron_styles->useOptions(true);

}else{
	$iron_styles->setBackgroundColor('.classic-menu', 'classic_menu_background');
	$iron_styles->setBackgroundColor('.classic-menu > ul', 'classic_menu_inner_background');
}
// News title font color on hover
$global_custom_css = $iron_styles->get_option('custom_css');
$iron_styles->setCustomCss($global_custom_css);



if(Iron_Croma::getField('hamburger_icon_color', $post_id)){
$iron_hamburger_color = Iron_Croma::getField('hamburger_icon_color', $post_id);
}else{
$iron_hamburger_color = Iron_Croma::getOption('menu_open_icon_color', null, '#000000');
}
$iron_styles->render();

echo '.menu-toggle rect{
	fill:' . $iron_hamburger_color . ';

}';

echo 'ul.header-top-menu li a{color:' . $iron_hamburger_color . ';}';
echo '.menu-toggle-off polygon{
	fill:' . Iron_Croma::getOption('menu_close_icon_color', null, '#ffffff') . ';
}';




$iron_croma_banner_background_type = Iron_Croma::getField('banner_background_type', $post_id);
if($iron_croma_banner_background_type === 'image-background') {

	echo '.page-banner-bg{
		background:url(' . wp_get_attachment_url( Iron_Croma::getField('banner_image', $post_id) ) . ');
		background-position:center ' . Iron_Croma::getField('banner_background_alignement', $post_id) . ';}
		';

} else if ($iron_croma_banner_background_type === 'color-background' ) {
	echo '.page-banner-bg{background:' . Iron_Croma::getField('banner_background_color', $post_id) . ';}';
}

if( intval( Iron_Croma::getField('banner_height', $post_id ) ) > 0 && !Iron_Croma::getField('banner_fullscreen', $post_id ) ){
	echo '#page-banner{height:' . intval( Iron_Croma::getField( 'banner_height', $post_id ) ) . 'px;}';
}else{
	echo '#page-banner{height:350px;}';
}
$iron_croma_banner_font_color = Iron_Croma::getField('banner_font_color', $post_id);
if(!empty($iron_croma_banner_font_color)) {
	echo '
	#page-banner .page-banner-content .inner .page-title, #page-banner .page-banner-content .inner .page-subtitle{
		color:'.$iron_croma_banner_font_color.';
	}';

}



switch ( Iron_Croma::getField('album_background_type', $post_id ) ) {
	case 'image':
		$iron_croma_background_image = wp_get_attachment_image_src( Iron_Croma::getField('album_background_image', $post_id), 'full' );

		echo '.album-header .backCover{
			background: url(' . $iron_croma_background_image[0] . ') center center no-repeat;
			background-size: cover;
		}';
		break;

	case 'color':
		$iron_croma_background_color =  Iron_Croma::getField('album_background_color', $post_id);
		echo '.album-header .backCover{ background-color:' . $iron_croma_background_color . '}';
		break;

	case 'default':
		if ( get_post_thumbnail_id( $post_id ) !== "" ) {

			$iron_croma_uploadDir = wp_upload_dir();
			$iron_croma_imageFile = wp_get_attachment_metadata( get_post_thumbnail_id( $post_id ) );
			$iron_croma_imageFilePath = $iron_croma_uploadDir['basedir'] . '/' .$iron_croma_imageFile['file'];

			$iron_croma_imageFileOnly = substr( $iron_croma_imageFile['file'], strrpos($iron_croma_imageFile['file'], '/') );



			$iron_croma_imageFilePathConverted = $iron_croma_uploadDir['basedir'] . '/converted' .$iron_croma_imageFileOnly;
			$iron_croma_imageFileUrlConverted = $iron_croma_uploadDir['baseurl'] . '/converted' .$iron_croma_imageFileOnly;

			if (!is_dir($iron_croma_uploadDir['basedir'] . '/converted')) {
				mkdir( $iron_croma_uploadDir['basedir'] . '/converted' );
			}
			if (!is_file( $iron_croma_imageFilePathConverted )) {
				$iron_croma_im = imagecreatefromjpeg($iron_croma_imageFilePath);
				if( $iron_croma_im ){
					for ($i = 0; $i < 100; $i++) {
						imagefilter($iron_croma_im, IMG_FILTER_GAUSSIAN_BLUR);
					}
					imagefilter($iron_croma_im, IMG_FILTER_SELECTIVE_BLUR);
				    imagejpeg($iron_croma_im, $iron_croma_imageFilePathConverted);
				}

				imagedestroy($iron_croma_im);
			}
			echo '
			.album-header .backCover{
				background: url(' . $iron_croma_imageFileUrlConverted . ') center center no-repeat;
				background-size: cover;
				filter: blur(50px);
			}';

		}

		break;
	default:
		break;

}