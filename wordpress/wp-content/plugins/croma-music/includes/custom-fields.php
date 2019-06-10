<?php
/***
 *  Install Add-ons
 *
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *
 *  All fields must be included during the 'acf/register_fields' action.
 *  Other types of Add-ons (like the options page) can be included outside of this action.
 *
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme as outlined in the terms and conditions.
 *  However, they are NOT to be included in a premium / free plugin.
 *  For more information, please read http://www.advancedcustomfields.com/terms-conditions/
 */

// Fields

function iron_feature_register_acf_fields()
{
	if ( ! class_exists('acf_field_repeater') )
		include_once( IRON_MUSIC_DIR_PATH .'includes/acf-addons/acf-repeater/repeater.php');

	if ( ! class_exists('acf_field_widget_area') )
		include_once( IRON_MUSIC_DIR_PATH .'includes/acf-addons/acf-widget-area/widget-area-v4.php');

	iron_feature_check_acf_lite_switch();

}
add_action('acf/register_fields', 'iron_feature_register_acf_fields');


/**
* If ACF_LITE is on, update all acf group fields in DB to draft
*/


function iron_feature_check_acf_lite_switch()
{

	if(isset($_GET["settings-updated"])) {

		global $wpdb;

		if(ACF_LITE)
			$status = "draft";
		else
			$status = "publish";

		$wpdb->update( $wpdb->posts, array( 'post_status' => $status ), array( 'post_type' => "acf" ), '%s' );
	}

}



/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if(function_exists("register_field_group") )
{

	$default_sidebar = null;
	$sidebar_position = 'disabled';
	$single_post_featured_image = null;

	$current_path = parse_url( wp_basename( $_SERVER["REQUEST_URI"] ) );

	if(is_admin() && !empty($current_path["path"]) && $current_path["path"] == 'post-new.php') {

		$post_type = !empty($_GET["post_type"]) ? $_GET["post_type"] : 'post';

		if($post_type == 'post') {

			$default_sidebar = croma_music_get_option('single_post_default_sidebar');
			$sidebar_position = "right";
			$single_post_featured_image = croma_music_get_option('single_post_featured_image');

		}else if($post_type == 'video') {

			$default_sidebar = croma_music_get_option('single_video_default_sidebar');
			$sidebar_position = "right";

		}else if($post_type == 'album') {

			$default_sidebar = croma_music_get_option('single_discography_default_sidebar');
			$sidebar_position = "right";

		}else if($post_type == 'event') {

			$default_sidebar = croma_music_get_option('single_event_default_sidebar');
			$sidebar_position = "right";
		}
	}


	register_field_group(array (
		'id' => 'acf_sidebar-options',
		'title' => 'Sidebar Options',
		'fields' => array (
			array (
				'key' => 'field_526d6ec715ee9',
				'label' => 'Sidebar Position',
				'name' => 'sidebar-position',
				'type' => 'radio',
				'choices' => array (
					'disabled' => 'Disabled',
					'left' => 'Left',
					'right' => 'Right'
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => $sidebar_position,
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_526d6c0da8219',
				'label' => 'Widget Area',
				'name' => 'sidebar-area_id',
				'type' => 'widget_area',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_526d6ec715ee9',
							'operator' => '!=',
							'value' => 'disabled',
						),
					),
					'allorany' => 'all',
				),
				'allow_null' => 1,
				'default_value' => $default_sidebar,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 1,
				)
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'single-post-options',
		'title' => 'Single Post Options',
		'fields' => array (
			array (
				'key' => 'field_526d6ec715ef9',
				'label' => 'Single Post Featured Image',
				'name' => 'single_post_featured_image',
				'type' => 'radio',
				'choices' => array(
					'fullwidth' => 'Full Width',
					'original' => 'Original',
					'none' => 'None'
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => $single_post_featured_image,
				'layout' => 'vertical',
			)
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_news-template-settings',
		'title' => 'Template Settings',
		'fields' => array (
			array (
				'key' => 'field_523382c925a72',
				'label' => 'Enable Excerpts',
				'name' => 'enable_excerpts',
				'type' => 'true_false',
				'default_value' => 0,
				'placeholder' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'index.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-grid.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-grid3.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-grid4.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-classic.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),

		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));



	register_field_group(array (
		'id' => 'acf_videos_query',
		'title' => 'Videos Query',
		'fields' => array (
			array (
				'key' => 'field_51b7bff2193fe',
				'label' => 'Filter By Artists',
				'name' => 'artists_filter',
				'type' => 'post_object',
				'post_type' => array(
					0 => 'artist'
				),
				'allow_null' => 1,
				'multiple' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-video.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (),
		),
		'menu_order' => 0,
	));




	register_field_group(array (
		'id' => 'acf_videos-template-settings',
		'title' => 'Template Settings',
		'fields' => array (
			array (
				'key' => 'field_523382c925a73',
				'label' => 'On video click option',
				'name' => 'video_link_type',
				'type' => 'radio',
				'choices' => array (
					'single' => 'Go to detailed video page',
					'lightbox' => 'Open video in a LightBox',
					'inline' => 'Replace image by video'
				),
				'default_value' => 'single',
				'multiple' => 0,
			),
		),
		'location' => array (

			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-video.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-video-grid.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),

		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_page-settings',
		'title' => 'Page Settings',
		'fields' => array (
			array (
				'key' => 'field_523384ce55a99',
				'label' => 'Use the Alternative Logo.',
				'name' => 'alternative_logo',
				'type' => 'true_false',
				'default_value' => 0,
				'placeholder' => 0,
			),
			array (
				'key' => 'field_523382c955a73',
				'label' => 'Hide Page Title',
				'name' => 'hide_page_title',
				'type' => 'true_false',
				'default_value' => 0,
				'placeholder' => 0,
			),
			array (
				'key' => 'field_523384ce55a85',
				'label' => 'Show Menu Over Content',
				'name' => 'classic_menu_over_content',
				'type' => 'true_false',
				'default_value' => 0,
				'placeholder' => 0,
			),
			array (
				'key' => 'field_523384ce55a84',
				'label' => 'Menu Background Color',
				'instructions' => esc_html__('This will override global settings. For classic menu only', 'croma-music'),
				'name' => 'classic_menu_background',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_523384ce55a86',
				'label' => 'Menu Background Transparency',
				'name' => 'classic_menu_background_alpha',
				'instructions' => esc_html__('Set the menu opacity between 0 and 1. For classic menu only', 'croma-music'),
				'type' => 'number',
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
				'default_value' => 1,
			),
			array (
				'key' => 'field_523384ce55a87',
				'label' => 'Classic Menu Main Item Text Color',
				'instructions' => esc_html__('This will override global settings', 'croma-music'),
				'name' => 'classic_menu_main_item_color',
				'type' => 'color_picker',
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_523384ce55a85',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_523384ce55a23',
				'label' => 'Hamburger Icon color',
				'instructions' => esc_html__('This will override global settings. For push menu only', 'croma-music'),
				'name' => 'hamburger_icon_color',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_523382c955a74',
				'label' => 'Page Background',
				'name' => 'background',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (
				'key' => 'field_523382f555a75',
				'label' => 'Background Repeat',
				'name' => 'background_repeat',
				'type' => 'select',
				'choices' => array (
					'repeat' => 'Repeat',
					'no-repeat' => 'No Repeat',
					'repeat-x' => 'Repeat X',
					'repeat-y' => 'Repeat Y',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5233837455a76',
				'label' => 'Background Size',
				'name' => 'background_size',
				'type' => 'select',
				'choices' => array (
					'cover' => 'Cover',
					'contain' => 'Contain',
					'inherit' => 'Inherit',
				),
				'default_value' => 'Cover',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5233842d55a78',
				'label' => 'Background Position',
				'name' => 'background_position',
				'type' => 'select',
				'choices' => array (
					'left top' => 'left top',
					'left center' => 'left center',
					'left bottom' => 'left bottom',
					'right top' => 'right top',
					'right center' => 'right center',
					'right bottom' => 'right bottom',
					'center top' => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_523384ce55a80',
				'label' => 'Background Color',
				'name' => 'content_background_color',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_523384ce55a81',
				'label' => 'Background Transparency',
				'name' => 'content_background_transparency',
				'instructions' => wp_kses( __('0 for transparent and 1 for 100% solid.', 'croma-music'), iron_get_allowed_html() ),
				'type' => 'number',
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
				'default_value' => 1,
			),
			array (
				'key' => 'field_523384ce55a79',
				'label' => '3D Push Menu Background Color',
				'name' => 'background_color',
				'instructions' => 'This is the background color when the menu is pushed. For Push menu only',
				'type' => 'color_picker',
				'default_value' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'artist',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_video-embedder',
		'title' => 'Video Embedder',
		'fields' => array (
			array (
				'key' => 'field_51b8d3ffdfe47',
				'label' => 'Add a video link',
				'name' => 'video_url',
				'type' => 'text',
				'instructions' => 'See <a target="_blank" href="http://codex.wordpress.org/Embeds">Supported Sites</a>',
				'default_value' => 'http://www.youtube.com/watch?v=aHjpOzsQ9YI',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_548d3d6711e41',
				'label' => 'Artist',
				'name' => 'artist_of_video',
				'type' => 'relationship',
				'return_format' => 'id',
				'post_type' => array (
					0 => 'artist'
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search'
				),
				'result_elements' => array (
					0 => 'featured_image'
				),
				'max' => 100,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'revisions',
			),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_albums_query',
		'title' => 'Albums Query',
		'fields' => array (
			array (
				'key' => 'field_5135bff2193fe',
				'label' => 'Filter By Artists',
				'name' => 'artists_filter',
				'type' => 'post_object',
				'post_type' => array(
					0 => 'artist'
				),
				'allow_null' => 1,
				'multiple' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-album.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_albums_page_header',
		'title' => 'Album Page Header',
		'fields' => array (
			array (
				'key'		=> 'album_background_type',
				'label' 	=> 'Album Page Header Background Type',
				'name'		=> 'album_background_type',
				'type'		=> 'radio',
				'choices'	=> array (
					'default'	=> 'Use blurry image of my featured image',
					'image' 	=> 'Use a different background image',
					'color' 	=> 'Use a background color'
				),
				'other_choice'		=> 0,
				'save_other_choice' => 0,
				'default_value' 	=> 'default',
				'layout'			=> 'horizontal',
			),
			array (
				'key' => 'album_background_image',
				'label' => 'Background Image Upload',
				'name' => 'album_background_image',
				'type' => 'image',
				'column_width' => '',
				'save_format' => 'object',
				'preview_size' => 'medium',
				'library' => 'all',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'album_background_type',
							'operator' => '==',
							'value' => 'image',
						),
					),
					'allorany' => 'all',
				)
			),
			array(
				'key' => 'album_background_color',
				'label' => 'Background Color',
				'name' => 'album_background_color',
				'type' => 'color_picker',
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'album_background_type',
							'operator' => '==',
							'value' => 'color',
						),
					),
					'allorany' => 'all',
				)
			)
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'categories',
				5 => 'tags',
				6 => 'send-trackbacks',
			),
		),
		'menu_order' => 1,
	));



	register_field_group(array (
		'id' => 'acf_album-infos',
		'title' => 'Album Infos',
		'fields' => array (
			array (
				'key' => 'field_51b8db2cd11c5',
				'label' => 'Hide album within the Albums Posts template',
				'instructions' => '<br style="clear:both">Could be useful for solo / remix albums<br><br>',
				'name' => 'hide_album',
				'type' => 'true_false',
				'placeholder' => 0,
			),
			array (
				'key' => 'field_51b8db2cd11c4',
				'label' => 'Release Date',
				'name' => 'alb_release_date',
				'type' => 'date_picker',
				'date_format' => 'yy-mm-dd',
				'display_format' => 'yy-mm-dd',
				'first_day' => 1,
			),
			array (
				'key' => 'field_523b66d6f2382',
				'label' => 'External Link',
				'name' => 'alb_link_external',
				'type' => 'text',
				'instructions' => esc_html__("If you want to redirect the user to an external link instead of this page, enter the URL below (eg: https://www.your-url.com).", 'croma-music'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_51b8c4facc846',
				'label' => 'Tracklist',
				'name' => 'alb_tracklist',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_51b8c51ecc847',
						'label' => 'Track Title',
						'name' => 'track_title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c5e3cc850',
						'label' => 'Optional Button Label',
						'name' => 'track_buy_label',
						'type' => 'text',
						'instructions' => 'E.g.: Free Download',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c5e3cc848',
						'label' => 'Optional Button Link',
						'name' => 'track_store',
						'type' => 'text',
						'instructions' => 'Enter the URL of destination: E.g: http://www.yoursite.com/download.zip',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c637cc849',
						'label' => 'MP3 File',
						'name' => 'track_mp3',
						'type' => 'file',
						'instructions' => 'Only .MP3 file accepted',
						'column_width' => '',
						'save_format' => 'url',
						'library' => 'all',
					),
					array (
						'key' => 'stream_link',
						'label' => 'External Audio link',
						'name' => 'stream_link',
						'type' => 'text',
						'instructions' => 'Add link to your external audio file.<br>(Soundcloud is not supported at this time)',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => '+ Add Track',
			),
			array (
				'key' => 'field_51b8c6d6cc84a',
				'label' => 'Store list',
				'name' => 'alb_store_list',
				'type' => 'repeater',
				'instructions' => 'Links the the online stores to buy album',
				'sub_fields' => array (
					array (
						'key' => 'field_51b8c6fdcc84b',
						'label' => 'Store Name',
						'name' => 'store_name',
						'type' => 'text',
						'instructions' => 'Examples : iTunes, Bandcamp, Soundcloud, etc.',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c718cc84c',
						'label' => 'Store Link',
						'name' => 'store_link',
						'type' => 'text',
						'instructions' => 'Link to the online store',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => '+ Add Store',
			),
			array (
				'key' => 'field_51b8c792cc84d',
				'label' => 'Review',
				'name' => 'alb_review',
				'type' => 'textarea',
				'default_value' => '',
				'formatting' => 'br',
				'maxlength' => '',
				'placeholder' => '',
			),
			array (
				'key' => 'field_51b8c88fcc84e',
				'label' => 'Review Author',
				'name' => 'alb_review_author',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_548d3d6715e41',
				'label' => 'Artist',
				'name' => 'artist_of_album',
				'type' => 'relationship',
				'return_format' => 'id',
				'post_type' => array (
					0 => 'artist'
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search'
				),
				'result_elements' => array (
					0 => 'featured_image'
				),
				'max' => 100,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 2,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'categories',
				5 => 'tags',
				6 => 'send-trackbacks',
			),
		),
		'menu_order' => 2,
	));


	$default_event_show_time = get_ironMusic_option('default_event_show_time', '_iron_music_event_options');

	if ( is_null($default_event_show_time) )
		$default_event_show_time = true;

	$events_show_countdown_rollover = get_ironMusic_option('events_show_countdown_rollover', '_iron_music_event_options');

	if ( is_null($events_show_countdown_rollover) )
		$events_show_countdown_rollover = true;


	register_field_group(array (
		'id' => 'acf_event-infos',
		'title' => 'Event Infos',
		'fields' => array (
			array (
				'key' => 'field_523b46ebe355f',
				'type' => 'message',
				'message' => '<p><strong for="acf-event-date">'.esc_html__('Event Date / Time', 'croma-music').'</strong></p>Please use the post publish date to set your event date',
			),
			array (
				'key' => 'field_523b46ebe35ef',
				'label' => '',
				'name' => 'event_show_time',
				'type' => 'true_false',
				'message' => 'Show the time',
				'default_value' => (bool) $default_event_show_time,
			),
			array (
				'key' => 'field_523b46ebe35f0',
				'label' => '',
				'name' => 'event_enable_countdown',
				'type' => 'true_false',
				'message' => 'Enable Rollover Countdown',
				'default_value' => (bool) $events_show_countdown_rollover,
			),
			array (
				'key' => 'field_523b46ebz35f0',
				'label' => '',
				'name' => 'event_no_redirect',
				'type' => 'true_false',
				'message' => 'Disable redirection. Event will shows up in the Event List template but user will not be redirected to this page.',
				'default_value' => 0,
			),
			array (
				'key' => 'field_51b8bf97193f8',
				'label' => 'City',
				'name' => 'event_city',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bfa8193f9',
				'label' => 'Venue',
				'name' => 'event_venue',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bfbf193fb',
				'label' => 'Map Link Label',
				'name' => 'event_map_label',
				'type' => 'text',
				'default_value' => 'Google Map',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => 'Google Map',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bfbf193fa',
				'label' => 'Map Link',
				'name' => 'event_map',
				'type' => 'text',
				'instructions' => 'Add the link to Google Maps pointing to the Venue',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bff2193fd',
				'label' => 'Call to Action Label',
				'name' => 'event_action_label',
				'type' => 'text',
				'default_value' => 'Tickets',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => 'Tickets',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bff2193fb',
				'label' => 'Call to Action Link',
				'name' => 'event_link',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_548d3d5415e41',
				'label' => 'Artist at Event',
				'name' => 'artist_at_event',
				'type' => 'relationship',
				'return_format' => 'id',
				'post_type' => array (
					0 => 'artist'
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search'
				),
				'result_elements' => array (
					0 => 'featured_image'
				),
				'max' => 100,
				// 'conditional_logic' => array (
				// 	'status' => 1,
				// 	'rules' => array (
				// 		array (
				// 			'field' => 'field_536d6d4f15ee9',
				// 			'operator' => '==',
				// 			'value' => 'default',
				// 		),
				// 	),
				// 	'allorany' => 'all',
				// ),
			),
			array (
				'key' => 'field_523b66d6f2382',
				'label' => 'External Link',
				'name' => 'alb_link_external',
				'type' => 'text',
				'instructions' => esc_html__("If you want to redirect the user to an external link instead of this page, enter the URL below (eg: https://www.your-url.com).", 'croma-music'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'format',
				2 => 'categories',
				3 => 'tags',
				4 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));

	// $photo_sizes_options = get_iron_option('photo_sizes');
	$photo_sizes = array('random' => 'Random');

	if(!empty($photo_sizes_options) && is_array($photo_sizes_options)) {
		foreach($photo_sizes_options as $key => $size) {
			$photo_sizes["size_".$key] = $size["size_name"]." (".$size["size_width"]."x".$size["size_height"].")";
		}
	}



	register_field_group(array (
		'id' => 'acf_page-event-template',
		'title' => 'Events Query',
		'fields' => array (
			array (
				'key' => 'field_51b8bff2193fc',
				'label' => 'Filter By Date',
				'name' => 'events_filter',
				'type' => 'select',
				'choices' => array (
					'upcoming' => 'Upcoming Events',
					'past' => 'Past Events'
				),
				'default_value' => 'upcoming',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_51b8bff2193fe',
				'label' => 'Filter By Artists',
				'name' => 'artists_filter',
				'type' => 'post_object',
				'post_type' => array(
					0 => 'artist'
				),
				'allow_null' => 1,
				'multiple' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-event.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (),
		),
		'menu_order' => 0,
	));


	
	register_field_group(array(
		'id' => 'cf_artists',
		'title' => 'Artist options',
		'menu_order' => 2,
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields'
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'artist',
				),
			),
		),
		'fields' => array(
			array(
				'key' => 'artist_hero_playlist',
				'label' => 'Featured playlist',
				'name' => 'artist_hero_playlist',
				'type' => 'post_object',
				'post_type'=> array('album'),
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'artist_desc',
				'label' => 'Description',
				'name' => 'artist_desc',
				'type' => 'wysiwyg',
			),
			array (
				'key' => 'artist_social',
				'label' => 'Social',
				'name' => 'artist_social',
				'type' => 'repeater',
				'button_label'=> 'Add a social link',
				'sub_fields' => array (
					array(
						'key'=>'artist_social_icon',
						'name'=>'artist_social_icon',
						'type'=>'select',
						'label'=>'Icons',
						'choices' => array (
							''=>'none',
							'fab fa-facebook' => '&#xf09a; Facebook',
							'fab fa-twitter' => '&#xf099; Twitter',
							'fab fa-instagram' => '&#xf16d; Instagram',
							'fab fa-bandcamp' => '&#xf2d5; BandCamp',
							'fab fa-flickr' => '&#xf16e; Flickr',
							'fab fa-google-plus' => '&#xf0d5; Google+',
							'fab fa-lastfm' => '&#xf202; Lastfm',
							'fab fa-pinterest' => '&#xf0d2; Pinterest',
							'fab fa-spotify' => '&#xf1bc; Spotify',
							'fab fa-soundcloud' => '&#xf1be; SoundCloud',
							'fab fa-vimeo' => '&#xf27d; Vimeo',
							'fab fa-youtube' => '&#xf167; Youtube',
						),
						'default_value' => '',
						'allow_null' => 0,
						'multiple' => 0,
						'column_width' => '20%',
					),
					array(
						'key'=> 'artist_social_label',
						'name'=> 'artist_social_label',
						'label'=>'label',
						'column_width' => '40%',
						'type'=>'text',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
					),
					array(
						'key'=> 'artist_social_link',
						'name'=> 'artist_social_link',
						'label'=>'link',
						'column_width' => '40%',
						'type'=>'text',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
					),
				)
			),
			array (
				'key' => 'artist_link',
				'label' => 'link',
				'name' => 'artist_link',
				'type' => 'repeater',
				'button_label'=> 'Add a link',
				'sub_fields' => array (
					array(
						'key'=> 'artist_link_label',
						'name'=> 'artist_link_label',
						'label'=>'label',
						'column_width' => '50%',
						'type'=>'text',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
					),
					array(
						'key'=> 'artist_link_link',
						'name'=> 'artist_link_link',
						'label'=>'link',
						'column_width' => '50%',
						'type'=>'text',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
					)
				)
			),
			array (
				'key' => 'artist_contact',
				'label' => 'Contact and Booking',
				'name' => 'artist_contact',
				'type' => 'wysiwyg'
			),
			array (
				'key' => 'artist_download',
				'label' => 'Download link',
				'name' => 'artist_download',
				'type' => 'repeater',
				'layout'=>'row',
				'button_label'=> 'Add a download link',
				'sub_fields' => array (
					array(
						'key'=> 'artist_download_label',
						'name'=> 'artist_download_label',
						'label'=>'label',
						'column_width' => '',
						'type'=>'text',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
					),
					array(
						'key'=> 'artist_download_link',
						'name'=> 'artist_download_link',
						'label'=>'file',
						'type'=>'file',
						'column_width' => '',
						'save_format' => 'url',
						'library' => 'all',
					)
				)
			),
			array (
				'key' => 'field_523b66d6f2382',
				'label' => 'External Link',
				'name' => 'alb_link_external',
				'type' => 'text',
				'instructions' => esc_html__("If you want to redirect the user to an external link instead of this page, enter the URL below (eg: https://www.your-url.com).", 'croma-music'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),

		)
	));


	register_field_group(array (
		'id' => 'acf_page-banner',
		'title' => 'Page Banner',
		'fields' => array (

			array (
				'key' => 'field_54ce55f555a01',
				'label' => 'Background Type',
				'name' => 'banner_background_type',
				'type' => 'select',
				'choices' => array (
					'image-background' => 'Image Background',
					'color-background' => 'Color Background',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),

			array (
				'key' => 'field_54ce55f555a02',
				'label' => 'Page banner Background Color',
				'name' => 'banner_background_color',
				'instructions' => 'Set your desired page banner background color if not using an image',
				'type' => 'color_picker',
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a01',
							'operator' => '==',
							'value' => 'color-background',
						),
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_54ce55f555a03',
				'label' => 'Parallax Effect ?',
				'name' => 'banner_parallax',
				'type' => 'true_false',
				'default_value' => 0,
				'placeholder' => 0,
				'instructions' => 'This will cause your banner to have a parallax scroll effect.',
				/*'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a01',
							'operator' => '==',
							'value' => 'image-background',
						),
					),
					'allorany' => 'all',
				),*/
			),

			array (
				'key' => 'field_54ce55f555a04',
				'label' => 'Page banner Image',
				'name' => 'banner_image',
				'instructions' => 'The image should be between 1600px - 2000px wide and have a minimum height of 475px for best results. Click "Browse" to upload and then "Insert into Post"',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a01',
							'operator' => '==',
							'value' => 'image-background',
						),
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_54ce55f555a05',
				'label' => 'Fullscreen Height',
				'name' => 'banner_fullscreen',
				'type' => 'true_false',
				'default_value' => 0,
				'placeholder' => 0,
				'instructions' => 'Chooseing this option will allow your banner to always remain fullscreen on all devices/screen sizes.',
			),

			array (
				'key' => 'field_54ce55f555a06',
				'label' => 'Page banner Height',
				'name' => 'banner_height',
				'type' => 'text',
				'default_value' => 0,
				'placeholder' => 0,
				'instructions' => 'How tall do you want your banner? Don\'t include "px" in the string. e.g. 350',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a05',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),


			array (
				'key' => 'field_54ce55f555a13',
				'label' => 'Content Type',
				'name' => 'banner_content_type',
				'type' => 'select',
				'choices' => array (
					'default-content' => 'Default Content (Title & Subtitle)',
					'advanced-content' => 'Advanced Content (HTML)',
				),
				'default_value' => 'default-content',
				'allow_null' => 0,
				'multiple' => 0,
			),

			array (
				'key' => 'field_54ce55f555a14',
				'label' => 'HTML Content',
				'name' => 'banner_texteditor_content',
				'type' => 'textarea',
				'toolbar' => 'full',
				'media_upload' => false,
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'advanced-content',
						),
					),
					'allorany' => 'all',
				),
			),


			array (
				'key' => 'field_54ce55f555a07',
				'label' => 'Page banner Title',
				'name' => 'banner_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'default-content',
						),
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_54ce55f555a08',
				'label' => 'Page banner Subtitle',
				'name' => 'banner_subtitle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'default-content',
						),
					),
					'allorany' => 'all',
				),
			),



			array (
				'key' => 'field_54ce55f555a09',
				'label' => 'banner Horizontal Content Alignment',
				'name' => 'banner_horizontal_content_alignment',
				'instructions' => 'Configure the position for your slides content',
				'type' => 'radio',
				'choices' => array (
					'left' => 'Left',
					'centered' => 'Centered',
					'right' => 'Right',
				),
				/*'other_choice' => 0,
				'save_other_choice' => 0,*/
				'default_value' => 'centered',
				'layout' => 'horizontal',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'default-content',
						),
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_54ce55f555a11',
				'label' => 'Background Alignement',
				'name' => 'banner_background_alignement',
				'type' => 'select',
				'choices' => array (
					'top' => 'Top',
					'center' => 'Center',
					'bottom' => 'Bottom',
				),
				'default_value' => 'center',
				'allow_null' => 0,
				'multiple' => 0,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a01',
							'operator' => '==',
							'value' => 'image-background',
						),
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_54ce55f555a12',
				'label' => 'Page banner Font Color',
				'name' => 'banner_font_color',
				'instructions' => 'Set your desired page banner font color',
				'type' => 'color_picker',
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'default-content',
						),
					),
					'allorany' => 'all',
				),
			),


		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'artist',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			// array (
			// 	array (
			// 		'param' => 'post_type',
			// 		'operator' => '==',
			// 		'value' => 'page',
			// 		'order_no' => 0,
			// 		'group_no' => 0,
			// 	),
			// ),
			// array (
			// 	array (
			// 		'param' => 'post_type',
			// 		'operator' => '==',
			// 		'value' => 'post',
			// 		'order_no' => 0,
			// 		'group_no' => 0,
			// 	),
			// ),
			// array (
			// 	array (
			// 		'param' => 'post_type',
			// 		'operator' => '==',
			// 		'value' => 'event',
			// 		'order_no' => 0,
			// 		'group_no' => 0,
			// 	),
			// ),
			// array (
			// 	array (
			// 		'param' => 'post_type',
			// 		'operator' => '==',
			// 		'value' => 'video',
			// 		'order_no' => 0,
			// 		'group_no' => 0,
			// 	),
			// ),
			// array (
			// 	array (
			// 		'param' => 'post_type',
			// 		'operator' => '==',
			// 		'value' => 'album',
			// 		'order_no' => 0,
			// 		'group_no' => 0,
			// 	),
			// ),
			// array (
			// 	array (
			// 		'param' => 'post_type',
			// 		'operator' => '==',
			// 		'value' => 'photo-album',
			// 		'order_no' => 0,
			// 		'group_no' => 0,
			// 	),
			// ),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 1,
	));


}

?>