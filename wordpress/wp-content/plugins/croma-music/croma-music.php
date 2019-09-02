<?php
/*
Plugin Name: Croma Music
Description: A Music manager for the themes Croma by IronTemplates
Plugin URI:  http://irontemplates.com
Author: IronTemplates
Author URI: http://irontemplates.com
Version: 3.4.5
License: GPL2
Text Domain: croma-music
*/

/*

    Copyright (C) 2015  IronTemplates  Email

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


define( 'IRON_MUSIC', TRUE );
if (!defined('ACF_LITE'))
    define( 'ACF_LITE', FALSE );

define( 'IRON_MUSIC_DIR_PATH', plugin_dir_path(__FILE__ ) );
define( 'IRON_MUSIC_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'IRON_MUSIC_PREFIX', 'IRONMUSIC: ' );
load_plugin_textdomain('croma-music', false, basename( dirname( __FILE__ ) ) . '/languages' );

if (!defined( 'IRON_MUSIC_TEXT_DOMAIN')) {
    define( 'IRON_MUSIC_TEXT_DOMAIN', 'croma-music' );
}

require IRON_MUSIC_DIR_PATH . 'includes/functions.php';
require IRON_MUSIC_DIR_PATH . 'includes/class/template-loader-class.php';
require IRON_MUSIC_DIR_PATH . 'includes/posttypes.php';
require IRON_MUSIC_DIR_PATH . 'includes/options.php';
require IRON_MUSIC_DIR_PATH . 'includes/class/import.php';
require IRON_MUSIC_DIR_PATH . 'includes/class/widget.class.php';
require IRON_MUSIC_DIR_PATH . 'includes/widgets.php';
require IRON_MUSIC_DIR_PATH . 'admin/updates.php';

require IRON_MUSIC_DIR_PATH . 'admin/options.php';
require IRON_MUSIC_DIR_PATH . 'includes/advanced-custom-fields/acf.php';
require IRON_MUSIC_DIR_PATH . 'includes/custom-fields.php';

// Load Widgets
require_once IRON_MUSIC_DIR_PATH . 'includes/class/widget.class.php';
require_once IRON_MUSIC_DIR_PATH . 'includes/shortcodes.php';
require_once IRON_MUSIC_DIR_PATH . 'includes/widgets.php';

if ( ! class_exists( 'Dynamic_Styles' ) )
    require IRON_MUSIC_DIR_PATH . 'includes/class/styles.class.php';



add_action( 'updated_option', 'ironMusic_write_dynamic_assets', 10, 3 );
add_action( 'updated_option', 'ironMusic_event_write_dynamic_assets', 10, 3 );
add_action(	'updated_option', 'iron_croma_write_dynamic_assets', 10, 3 );
add_action( 'admin_enqueue_scripts', 'ironMusic_load_script' );
add_action( 'wp_enqueue_scripts', 'ironMusic_load_frontend', 12);
add_action( 'init', 'ironMusic_load_dynamic_assets');
add_action( 'init', 'dynamicAssets');
add_action( 'admin_menu', 'custom_menu_page_removing' , 999);
add_action( 'wp_ajax_ironMusic_ajax', 'ironMusic_ajax');
add_action( 'wp_ajax_ironTwitter', 'ironMusic_twitter');
add_action( 'wp_ajax_nopriv_ironTwitter', 'ironMusic_twitter');


function iron_music_is_active_plugin( $plugin ){
    $active_plugins = get_option( 'active_plugins' );
    if( is_array($active_plugins) && in_array( $plugin, $active_plugins ) ){
        return true;
    }

    $active_sitewide_plugins = get_site_option( 'active_sitewide_plugins' );
    if( is_array($active_sitewide_plugins) && in_array( $plugin, $active_sitewide_plugins ) ){
        return true;
    }

    return false;
}


if ( iron_music_is_active_plugin( 'js_composer/js_composer.php' ) ) {

    add_action( 'vc_before_init', 'iron_croma_vc_init' );
    function iron_croma_vc_init() {
        require IRON_MUSIC_DIR_PATH . 'includes/vc-extend/vc-custom-params.php';
        require IRON_MUSIC_DIR_PATH . 'includes/vc-extend/vc-map.php';
        require IRON_MUSIC_DIR_PATH . 'includes/vc-extend/vc-helpers.php';
        vc_set_as_theme();
        vc_set_shortcodes_templates_dir( IRON_MUSIC_DIR_PATH . 'includes/vc_templates' );
    }
}









// Template loader instantiated elsewhere, such as the main plugin file
$iron_music_template_loader = new Iron_Features_Template_Loader;

// ...

// This function can live wherever is suitable in your plugin
function iron_music_get_template_part($slug, $name = null, $load = true ) {
    global $iron_music_template_loader;
    $iron_music_template_loader->get_template_part( $slug, $name, $load );
}


function custom_menu_page_removing() {
    remove_menu_page( 'fw-extensions' );
}



function ironMusic_load_script($hook){
    wp_register_style('iron-font-awesome', IRON_MUSIC_DIR_URL . '/fontawesome/css/fontawesome-all.min.css', false, '', 'all' );
    wp_enqueue_style( 'ironMusic_css', IRON_MUSIC_DIR_URL . 'css/ironMusicAdmin.css', array('iron-font-awesome'), NULL );


    wp_enqueue_script( 'color', IRON_MUSIC_DIR_URL . '/js/jqColorPicker.min.js', array( 'jquery' ), NULL, TRUE );
    wp_enqueue_script( 'fontSelector', IRON_MUSIC_DIR_URL . '/includes/fontselect-jquery-plugin/jquery.fontselect.min.js', array('jquery'), NULL, TRUE );
    wp_enqueue_style( 'fontSelectorCss', IRON_MUSIC_DIR_URL . '/includes/fontselect-jquery-plugin/fontselect.css', array(), NULL );

    wp_enqueue_style( 'ironMusic_css', IRON_MUSIC_DIR_URL . 'css/ironMusicAdmin.css', array('fontSelectorCss'), NULL );
    wp_enqueue_script( 'iron_feature', IRON_MUSIC_DIR_URL . '/js/ironFeatures.js', array( 'jquery', 'color', 'fontSelector' ), NULL, TRUE );

    wp_enqueue_style('iron-vc', IRON_MUSIC_DIR_URL .'admin/assets/css/vc.css', false, '', 'all' );
	wp_enqueue_style('iron-acf', IRON_MUSIC_DIR_URL .'admin/assets/css/acf.css', false, '', 'all' );

	wp_enqueue_script('iron-admin-custom', IRON_MUSIC_DIR_URL .'admin/assets/js/custom.js', array('jquery'), null, true);
	wp_enqueue_script('iron-admin-vc', IRON_MUSIC_DIR_URL .'admin/assets/js/vc.js', array('jquery','rome-datepicker'), null, true);

	wp_localize_script('iron-admin-vc', 'iron_vars', array(
		'patterns_url' => IRON_MUSIC_DIR_URL .'admin/assets/img/vc/patterns/'
	));

}

function ironMusic_load_frontend(){

    $uploadDir = wp_upload_dir();

    if ( get_ironMusic_option( 'external_css', '_iron_music_import_export_options' ) == '1' ) {
		wp_enqueue_style('iron_feature_music_css', $uploadDir['baseurl'] . '/css/custom-style-croma-music.css' , array(), NULL, 'all' );
		wp_enqueue_style('iron_feature_event_css', $uploadDir['baseurl'] . '/css/custom-style-croma-event.css' , array(), NULL, 'all' );
	}else{
		wp_enqueue_style('iron_feature_event_css', home_url('/') .'?loadIronMusic=iron_feature.css&option_style=event', array(), NULL, 'all' );
        wp_enqueue_style('iron_feature_music_css', home_url('/') .'?loadIronMusic=iron_feature.css&option_style=music', array(), NULL, 'all' );
	}

	$custom_styles_url = home_url('/').'?load=custom-style.css';

    if ( Iron_croma::getOption( 'external_css' ) ) {
		wp_enqueue_style('iron-custom-styles', $uploadDir['baseurl'] . '/css/custom-style.css' , array('iron-master'), NULL, 'all' );
	}else{
		wp_enqueue_style('iron-custom-styles', $custom_styles_url, array('iron-master'), '', 'all' );
	}

    global $wp_query;
	if ( !is_archive() || ( (int) get_option('page_for_posts') === $wp_query->get_queried_object_id() )   )
        wp_add_inline_style( 'iron-custom-styles', iron_croma_inline_dynamic_assets() );


    wp_enqueue_script( 'jquery.plugin', IRON_MUSIC_DIR_URL . 'js/countdown/jquery.plugin.min.js', array( 'jquery' ), NULL, TRUE );
    wp_enqueue_script( 'jquery.countdown_js', IRON_MUSIC_DIR_URL . 'js/countdown/jquery.countdown.min.js', array( 'jquery', 'jquery.plugin' ), NULL, TRUE );
    wp_enqueue_script( 'ironMusic-js', IRON_MUSIC_DIR_URL.'js/ironMusic.js', NULL, false );
    wp_enqueue_script( 'objectFittPolyfill', IRON_MUSIC_DIR_URL. 'js/objectFittPolyfill.min.js', NULL, true );

    wp_register_script('wavesurfer', '//cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.8/wavesurfer.min.js', array(), NULL, true);
	wp_register_script('moments', '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js', array(), NULL, true);
	wp_enqueue_script('iron-audio-player', get_template_directory_uri () . '/js/iron-audioplayer.js', array('jquery', 'wavesurfer','iron-main', 'moments'), NULL, true);
	wp_enqueue_style('iron-audio-player', get_template_directory_uri () . '/css/iron-audioplayer.css', array('js_composer_front'));

    wp_localize_script('jquery.countdown_js', 'plugins_vars', array(
		'labels' => array(_x('Years','Countdown label','croma-music'),_x('Months','Countdown label','croma-music'),_x('Weeks','Countdown label','croma-music'),_x('Days','Countdown label','croma-music'),_x('Hours','Countdown label','croma-music'),_x('Minutes','Countdown label','croma-music'),_x('Seconds','Countdown label','croma-music')),
		'labels1' => array(_x('Year','Countdown label','croma-music'),_x('Month','Countdown label','croma-music'),_x('Week','Countdown label','croma-music'),_x('Day','Countdown label','croma-music'),_x('Hour','Countdown label','croma-music'),_x('Minute','Countdown label','croma-music'),_x('Second','Countdown label','croma-music')),
		'compactLabels' => array(_x('y','Countdown label','croma-music'),_x('m','Countdown label','croma-music'),_x('w','Countdown label','croma-music'),_x('d','Countdown label','croma-music'))
	));

    wp_enqueue_script( 'iron-twitter', IRON_MUSIC_DIR_URL.'js/twitter/jquery.tweet.min.js', array('jquery'), null, TRUE);
	wp_localize_script('iron-twitter', 'ajax_vars', array(
	    'ajax_url' => admin_url( 'admin-ajax.php' )
    ));


    wp_localize_script('ironMusic-js', 'ironmusic_vars', array(
	    'i18n' => array(
	        'no_events' => esc_html__("No events scheduled yet. Stay tuned!", IRON_MUSIC_TEXT_DOMAIN)
	    )
    ));
}

function get_ironMusic_option($option_singular = NULL, $option_name = '_croma-music_options' ){

    $iron_music_options = get_option( $option_name );

    if ( !$iron_music_options )
        return FALSE;

    if ( !array_key_exists( $option_singular , $iron_music_options ) )
        return FALSE;

    if ( is_null( $option_singular ) )
        return $iron_music_options;

    return $iron_music_options[$option_singular];

}



function ironMusic_option($option_singular = NULL, $option_name = '_croma-music_options' ){
    $iron_music_option = get_ironMusic_option( $option_singular, $option_name );
    if ( is_array( $iron_music_option ) ) {
        print_r( $iron_music_option );
    }else{
        echo $iron_music_option;
    }
}

function ironMusic_load_dynamic_assets() {
    if( is_admin() )
        return;

    if ( !isset( $_GET["loadIronMusic"] )  )
        return;

    $loadIronMusic = $_GET["loadIronMusic"];
    if(!empty( $loadIronMusic )) {

        if( $loadIronMusic == 'iron_feature.css' ) {
            include_once( IRON_MUSIC_DIR_PATH . 'css/custom-style.php');
            exit;
        }

    }
}

function dynamicAssets() {
	if( is_admin() ) return -1;

	if(!empty($_GET["load"])) {
		if($_GET["load"] == 'custom-style.css' || $_GET["load"] == 'custom-post-style.css') {
			load_template( IRON_MUSIC_DIR_PATH .'css/theme/custom-style.php', true );
			exit;
		}
	}
}

function ironMusic_write_dynamic_assets( $option, $old_value, $value ){

	if( !is_admin() )
		return;

    $generalOption = get_option('_iron_music_import_export_options');

	if ( ( $option == '_iron_music_music_player_options' || $option == '_iron_music_event_options' || $option == '_iron_music_general_options' || $option == '_iron_music_import_export_options' || $option == 'theme_switched' ) ){



        if ( $generalOption['external_css'] == '1' ) {

    		// read file
    		ob_start();

    		include( IRON_MUSIC_DIR_PATH .'/css/custom-style.php');
    		// put content in data
    		$data = ob_get_clean();

    		$uploadDir = wp_upload_dir();
    		if (!is_dir($uploadDir['basedir'] . '/css')) {
    			mkdir( $uploadDir['basedir'] . '/css' );
    		}

    		$fileCCss = fopen( $uploadDir['basedir'] . '/css/custom-style-croma-music.css', 'w' );
    		fwrite($fileCCss,  $data );
    		fclose($fileCCss);
        }
	}

}

function ironMusic_event_write_dynamic_assets( $option, $old_value, $value ){

	if( !is_admin() )
		return;

    $generalOption = get_option('_iron_music_import_export_options');

	if ( ( $option == '_iron_music_music_player_options' || $option == '_iron_music_event_options' || $option == '_iron_music_general_options' || $option == '_iron_music_import_export_options' || $option == 'theme_switched' ) ){

        if ( $generalOption['external_css'] == '1' ) {

    		// read file
    		ob_start();

    		include( IRON_MUSIC_DIR_PATH .'/css/custom-style-event.php');
    		// put content in data
    		$data = ob_get_clean();

    		$uploadDir = wp_upload_dir();
    		if (!is_dir($uploadDir['basedir'] . '/css')) {
    			mkdir( $uploadDir['basedir'] . '/css' );
    		}

    		$fileCCss = fopen( $uploadDir['basedir'] . '/css/custom-style-croma-event.css', 'w' );
    		fwrite($fileCCss,  $data );
    		fclose($fileCCss);
        }
	}

}



function iron_croma_inline_dynamic_assets(){
	global $post;

	ob_start();

	include( IRON_MUSIC_DIR_PATH .'/css/theme/custom-style-post.php');
	// put content in data
	$data = ob_get_clean();

	return $data;

}


function iron_croma_write_dynamic_assets( $option, $old_value, $value ){

	if( !is_admin() )
		return;

	if ( $option == 'croma' && array_key_exists('external_css', $value ) && $value['external_css'] == '1'){

		// read file
		ob_start();

		include( IRON_MUSIC_DIR_PATH .'/css/theme/custom-style.php');
		// put content in data
		$data = ob_get_clean();

		$uploadDir = wp_upload_dir();
		if (!is_dir($uploadDir['basedir'] . '/css')) {
			mkdir( $uploadDir['basedir'] . '/css' );
		}

		$fileCCss = fopen( $uploadDir['basedir'] . '/css/custom-style.css', 'w' );
		fwrite($fileCCss,  $data );
		fclose($fileCCss);
	}

}



function ironMusic_ajax($data){
    $data = $_POST['data'];
    $data = json_decode( stripcslashes( $data ) ,true);

    $data_update = array();
    foreach ($data as $key => $options) {
        foreach ($options as $key => $value) {
            update_option( $key , $value );
        }

        $value = get_option( $key );
        if ( !empty( $value ) ) {
            array_push($data_update, array($key => $value) );
        }

    }
    echo json_encode($data_update);

    wp_die();

}






/*-----------------------------------------------------------------------------------*/
/* Twitter widget
/*-----------------------------------------------------------------------------------*/

require IRON_MUSIC_DIR_PATH . 'js/twitter/jquery-twitter-class.php';

$optionTwitter = get_option('croma');

if ( $optionTwitter ) {
    define('CONSUMER_KEY', ( array_key_exists( 'twitter_consumerkey' ,$optionTwitter ) )? $optionTwitter['twitter_consumerkey']: '' );
    define('CONSUMER_SECRET', ( array_key_exists( 'twitter_consumersecret' ,$optionTwitter ) )? $optionTwitter['twitter_consumersecret']: '' );
    define('ACCESS_TOKEN', ( array_key_exists( 'twitter_accesstoken' ,$optionTwitter ) )? $optionTwitter['twitter_accesstoken']: '' );
    define('ACCESS_SECRET', ( array_key_exists( 'twitter_accesstokensecret' ,$optionTwitter ) )? $optionTwitter['twitter_accesstokensecret']: '' );
}


function ironMusic_twitter(){

    if( empty($_POST) || $_POST['action'] !='ironTwitter' || CONSUMER_KEY == '' || CONSUMER_SECRET == '' || ACCESS_TOKEN == '' || ACCESS_SECRET == '')
        wp_send_json( array() );

    $ezTweet = new ezTweet;
    $ezTweet->fetch();
    wp_die();
}