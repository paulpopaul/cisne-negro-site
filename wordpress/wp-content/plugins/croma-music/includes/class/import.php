<?php

class iron_music_import{

	const OPT_BASE_NAME = '_iron_music_';
	
	var $opt_name_list = array(  
    	'_iron_music_event_options',                    
        '_iron_music_music_player_options',         
        '_iron_music_discography_options'
    );

	function __construct() {
		// Hook into the WP feeds for downloading exported settings
        add_action('do_feed_ironmusic-opts', array(&$this, 'download_options'), 1, 1);
	}
	

	function download_options(){
		$return = array();
		
		foreach($this->opt_name_list as $optName){
			$value = get_option($optName);
			if( $value !== false ){
				$return[$optName] = $value;	
			}	
		}
		header('Content-Type: application/json');
		header('Cache-Control: must-revalidate');
        header('Pragma: public');
		echo json_encode($return);
		exit;
	}
	
	function import_from_json($json){
		$datas = json_decode($json, true);
		if (!empty($datas)) 
			return false;		
		
		foreach ($datas as $key => $value) {
			update_option($key, $value);
		}
		return true;
	}

}

$import_feed = new iron_music_import();