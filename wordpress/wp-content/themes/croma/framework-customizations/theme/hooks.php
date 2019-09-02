<?php

function iron_croma_get_demo(){
    $demo_folder = 'http://croma.irontemplates.com/demo/';
    $demo_list = wp_remote_get( $demo_folder . 'demo.json');

    if ( is_wp_error( $demo_list ) || $demo_list['response']['code'] !== 200  ){
        add_action( 'admin_notices', 'demo_importer_notice__error' );
        return false;
    }

    $json_demo_list = json_decode( wp_remote_retrieve_body( $demo_list ) , true);

    $unyson_format_demo_list = array();

    foreach( $json_demo_list as $demo){
        $unyson_format_demo_list[$demo['id']] = array(
            'title' => $demo['title'],
            'screenshot' => $demo_folder . $demo['id'] .'/'. $demo['screenshot'],
            'preview_link' => $demo['preview_link']
            );
    }
    return $unyson_format_demo_list;
}
/**
 * @param FW_Ext_Backups_Demo[] $demos
 * @return FW_Ext_Backups_Demo[]
 */

function _filter_theme_fw_ext_backups_demos($demos) {
    $demos_array = iron_croma_get_demo();

    if (!$demos_array)
        return array();

    $download_url = 'http://croma.irontemplates.com/demo/';

    foreach ($demos_array as $id => $data) {
        $demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
            'url' => $download_url,
            'file_id' => $id,
        ));
        $demo->set_title($data['title']);
        $demo->set_screenshot($data['screenshot']);
        $demo->set_preview_link($data['preview_link']);

        $demos[ $demo->get_id() ] = $demo;

        unset($demo);
    }

    return $demos;
}
add_filter('fw:ext:backups-demo:demos', '_filter_theme_fw_ext_backups_demos');



function demo_importer_notice__error() {
	$class = 'notice notice-error is-dismissible';
	$message = sprintf( __( 'To import a demo,  %s. If you have previously imported a demo, you can deactivate the plugin "Iron Demo Importer" to dismiss this notice.', 'sample-text-domain' ), '<a href="https://irontemplates.ticksy.com/article/12229/" in this tutorial</a>' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
}