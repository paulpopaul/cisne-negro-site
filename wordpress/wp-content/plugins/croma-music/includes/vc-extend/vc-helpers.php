<?php

    
function iron_get_google_fonts() {
	
	$cache_key = 'iron_google_fonts';
	$cache_expire =  (60 * 60 * 24) * 7; // 1 week
	
	$fonts_data = get_transient($cache_key);
	
	if($fonts_data !== false) {
		$fonts_data = unserialize($fonts_data);
	}else{
		$json = wp_remote_retrieve_body(wp_remote_request("https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDulJCJNv_1EH02qfgRhj5SYUT4A6O4QN4", array('timeout'=> 10)));

		$fonts_data = json_decode($json);
		if(!empty($fonts_data->items)) {
			$fonts_data = $fonts_data->items;
			set_transient($cache_key, serialize($fonts_data), $cache_expire);
		}else{
			$fonts_data	= array();
		}	
	}
		
	if(empty($fonts_data))
		return array();
		
	$fonts = array();	
	foreach($fonts_data as $item) {
		
		$font = new stdClass;
		$font->font_family = $item->family;
		$font->font_styles = implode(",", $item->variants);
		
		$styles = array();
		foreach($item->variants as $variant) {
		
			if($variant == "regular") {
			
				$styles[] = '400 regular:400:normal';
				
			}else if($variant == "italic") {	
			
				$styles[] = '400 italic:400:italic';
				
			}else if(is_numeric(substr($variant, 0, 2))) {
			
				if(strlen($variant) == 3) {
					
					if($variant <= 300) {
						$weight = "light";
					}else{
						$weight = "bold";
					}
					$styles[] = $variant.' '.$weight.' regular:'.$variant.':normal';
					
				}else{
				
					$variant_prefix = substr($variant, 0, 3);
					$variant_suffix = substr($variant, 3);
					
					$styles[] = $variant_prefix.' '.$variant_suffix.':'.$variant_prefix.':'.$variant_suffix;
				}
			
			}
		}
		$font->font_types = implode(",", $styles);
		
		$fonts[] = $font;
		
	}
	
	return $fonts;


}


add_filter('vc_google_fonts_get_fonts_filter', 'iron_get_google_fonts');
?>