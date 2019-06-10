<?php

//var_dump(delete_option('_iron_music_music_player_options'));


if ( is_admin()) {
	include 'rational-option-page/class.rational-option-page.php';
	$ironFeatures_pages = new RationalOptionPages();
	$ironFeatures_pages_options = array(
	    array(
	        'page_title'    => esc_html__('Croma Music','croma-music'),
	        'menu_title'    => esc_html__('Croma Music','croma-music'),
	        'capability'    => 'manage_options',
	        'menu_slug'     => 'croma-music',
	        'icon_url'      => IRON_MUSIC_DIR_URL . '/images/ironlogo.svg',
	        'position'      => '9999999999999999999999999999',
			'subpages'		=> array(
				array(
					'page_title'	=> esc_html__('Events','croma-music'),
					'menu_title' 	=> esc_html__('Events','croma-music'),
					'capability'    => 'manage_options',
					'menu_slug'     => 'iron_music_event',
					'sections'      => array(
						array(
							'id'    => 'iron_events',
							'title' => esc_html__('General Settings','croma-music'),
							'fields'=> array(
								// text input
								array(
									'id'    => 'events_slug_name',
									'title' => esc_html__('Events slug name','croma-music'),
									'type'  => 'text',
									'description' => esc_html__('eg: http://www.domain.com/SLUG/event-title','croma-music'),
									'value' => 'event'
								),
								array(
									'id' => 'events_per_page',
									'type' => 'text',
									'title' => esc_html__('How many events per page ?', 'croma-music'),
									'description' => esc_html__('This setting apply on your event page template.', 'croma-music'),
									'value' => '10'
								),
							)
						),
						array(
							'id'    => 'iron_events_items',
							'title' => esc_html__('Look and Feel','croma-music'),
							'fields'=> array(
								array(
									'id' => 'events_item_typography',
									'type' => 'typography',
									'title' => esc_html__('Typography', 'croma-music'),
									'description' => esc_html__('Choose a font, font size and color', 'croma-music'),
									'value' => array(
										'font' => 'Karla',
										'font-readable' => 'Karla',
										'weight' => '400',
										'size' => '18px',
										'color' => 'rgb(43, 43, 43)',
									)
								),
								array(
									'id'    => 'events_items_letterspacing',
									'type'  => 'text',
									'title' => esc_html__('Letter Spacing', 'croma-music'),
									'description' => esc_html__('enter value with px (eg: 2px)','croma-music'),
									'value' => '0px'
								),
								array(
									'id' => 'events_item_bg_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Item Background Color', 'croma-music'),
									'value' => 'rgb(255, 255, 255)'
								),
								array(
									'id' => 'events_item_hover_bg_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Item Hover Background Color', 'croma-music'),
									'value' => 'rgb(43, 43, 43)'
								),
								array(
									'id' => 'events_item_hover_text_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Item Hover Text Color', 'croma-music'),
									'value' => 'rgb(255, 255, 255)'
								),
							),
						),
						array(
							'id'    => 'iron_events_countdown',
							'title' => esc_html__('Countdown','croma-music'),
							'fields'=> array(
								array(
									'id' => 'events_show_countdown_rollover',
									'type' => 'checkbox',
									'title' => esc_html__('Show countdown on rollover', 'croma-music'),
									'description' => esc_html__('When option is checked, an animated countdown will be shown when user rollover your event. This global setting may be overridden in each of your individual events.', 'croma-music'),
								),
								array(
									'id' => 'events_countdown_typography',
									'type' => 'typography',
									'title' => esc_html__('Typography', 'croma-music'),
									'description' => esc_html__('Choose a font, font size and color', 'croma-music'),
									'value' => array(
										'font' => 'Karla',
										'font-readable' => 'Karla',
										'weight' => '600',
										'size' => '21px',
										'color' => 'rgb(255, 255, 255)',
									)
								),
								array(
									'id'    => 'events_countdown_letterspacing',
									'type'  => 'text',
									'title' => esc_html__('Letter Spacing', 'croma-music'),
									'description' => esc_html__('enter value with px','croma-music'),
									'value' => '0px'
								),
								array(
									'id' => 'events_countdown_bg_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Background Color', 'croma-music'),
									'value' => 'rgb(143, 34, 75)'
								),
								array(
									'id' => 'events_outline_colors',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Outline Color', 'croma-music'),
									'description' => esc_html__('For separators', 'croma-music'),
									'value' => 'rgb(43, 43, 43)'
								),
								array(
									'id'    => 'events_items_padding',
									'type'  => 'text',
									'title' => esc_html__('Padding between items', 'croma-music'),
									'description' => esc_html__('enter value with px. eg: 5px','croma-music'),
									'value' => '20px'
								),
							),
						),
						array(
							'id'    => 'iron_events_filter',
							'title' => esc_html__('Artist Dropdown','croma-music'),
							'fields'=> array(
								array(
									'id' => 'events_filter',
									'type' => 'checkbox',
									'title' => esc_html__('Show Artist Dropdown', 'croma-music'),
									'description' => esc_html__('Show an artist dropdown selector above your list of events. If you have multiple artists, this can be usefull to filter your events by artists. This option only apply in pages that use the "Event Posts" template.','croma-music'),
									'switch' => true,
								),
								array(
									'id'    => 'events_filter_label',
									'type'  => 'text',
									'title' => esc_html__('Text Label', 'croma-music'),
									'description' => esc_html__('eg: Select an artist','croma-music'),
									'value' => ''
								),
								array(
									'id' => 'events_filter_typography',
									'type' => 'typography',
									'title' => esc_html__('Label Typography', 'croma-music'),
									'description' => esc_html__('Choose a font, font size and color', 'croma-music'),
									'value' => array(
										'font' => 'Karla',
										'font-readable' => 'Karla',
										'weight' => '400',
										'size' => '15px',
										'color' => 'rgb(43, 43, 43)',
									)
								),
								array(
									'id'    => 'events_filter_letterspacing',
									'type'  => 'text',
									'title' => esc_html__('Label Letter Spacing', 'croma-music'),
									'description' => esc_html__('enter value with px (eg: 2px)','croma-music'),
									'value' => '0px'
								),
								array(
									'id' => 'events_filter_bg_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Background Color', 'croma-music'),
									'value' => 'rgb(240, 240, 240)'
								),
								array(
									'id' => 'events_filter_outline_color',
									'type' => 'text',
									'class' => 'color',
									'title' => esc_html__('Event filter Outline Color', 'croma-music'),
									'description' => esc_html__('For dropdown outlines and arrow color', 'croma-music'),
									'value' => 'rgb(0, 0, 0)'
								),
							)
						),

					),
				),
				array(
					'page_title'	=> esc_html__('Music Player','croma-music'),
					'menu_title' 	=> esc_html__('Music Player','croma-music'),
					'capability'    => 'manage_options',
					'menu_slug'     => 'iron_music_music_player',
					'sections'		=> array(
						array(
							'id' 	=> 'iron_music_player',
							'title'	=> esc_html__('Music Player Color Setting', 'croma-music'),
							'fields'=> array(
								array(
									'id' => 'music_player_song_title',
									'type' => 'typography',
									'title' => esc_html__('Music Player Song Title', 'croma-music'),
									'description' => esc_html__('Choose a font, font size and color', 'croma-music'),
									'value' => array(
										'font' => 'Karla',
										'font-readable' => 'Karla',
										'weight' => '700',
										'size' => '16px',
										'color' => 'rgb(43, 43, 43)',
									)
								),
								array(
									'id' => 'music_player_album_title',
									'type' => 'typography',
									'title' => esc_html__('Music Player Album Title', 'croma-music'),
									'description' => esc_html__('Choose a font, font size and color', 'croma-music'),
									'value' => array(
										'font' => 'Karla',
										'font-readable' => 'Karla',
										'weight' => '400',
										'size' => '14px',
										'color' => 'rgb(43, 43, 43)',
									)
								),
								array(
									'id' => 'music_player_playlist',
									'type' => 'typography',
									'title' => esc_html__('Playlist', 'croma-music'),
									'description' => esc_html__('Choose a font, font size and color', 'croma-music'),
									'value' => array(
										'font' => 'Karla',
										'font-readable' => 'Karla',
										'weight' => '400',
										'size' => '16px',
										'color' => 'rgb(43, 43, 43)',
									)
								),
								array(
									'id' => 'music_player_playlist_active_text_color',
									'type' => 'text',
									'title' => esc_html__('Playlist active text color', 'croma-music'),
									'class' => 'color',
									'value' => 'rgb(77, 77, 79)'
								),
								array(
									'id' => 'music_player_playlist_hover_color',
									'type' => 'text',
									'title' => esc_html__('Playlist hover', 'croma-music'),
									'class' => 'color',
									'value' => 'rgb(215, 215, 215)'
								),
								array(
									'id' => 'music_player_icon_color',
									'type' => 'text',
									'title' => esc_html__('Player control color', 'croma-music'),
									'class' => 'color',
									'value' => 'rgb(127, 127, 127)'
								),
								array(
									'id' => 'music_player_timeline_color',
									'type' => 'text',
									'title' => esc_html__('Timeline background', 'croma-music'),
									'class' => 'color',
									'value' => 'rgb(31, 31, 31)'
								),
								array(
									'id' => 'music_player_progress_color',
									'type' => 'text',
									'title' => esc_html__('Progress bar', 'croma-music'),
									'class' => 'color',
									'value' => 'rgb(13, 237, 180)'
								),
							)
						),
						array(
							'id' 	=> 'iron_music_continuous_player',
							'title'	=> esc_html__('Continuous Music Player Color Setting', 'croma-music'),
							'fields'=> array(
								array(
									'id' => 'continuous_music_player_label_color',
									'type' => 'text',
									'title' => esc_html__('Music Player Label Color', 'croma-music'),
									'class' => 'color',
									'value' => 'rgb(0, 0, 0)'
								),
								array(
									'id' => 'continuous_music_player_background',
									'type' => 'text',
									'title' => esc_html__('Footer music player background', 'croma-music'),
									'class' => 'color',
									'value' => 'rgb(0, 0, 0)'
								),
								array(
									'id' => 'continuous_music_player_control_color',
									'type' => 'text',
									'title' => esc_html__('Player Control Color', 'croma-music'),
									'class' => 'color',
									'value' => 'rgb(255, 255, 255)'
								),
								array(
									'id' => 'continuous_music_player_timeline_background',
									'type' => 'text',
									'title' => esc_html__('Timeline background', 'croma-music'),
									'class' => 'color',
									'value' => 'rgb(255, 255, 255)'
								),
								array(
									'id' => 'continuous_music_player_progress_bar',
									'type' => 'text',
									'title' => esc_html__('Progress bar', 'croma-music'),
									'class' => 'color',
									'value' => 'rgb(150, 150, 150)'
								),


							)
						)
					)
				),
				array(
					'page_title'	=> esc_html__('Discography','croma-music'),
					'menu_title' 	=> esc_html__('Discography','croma-music'),
					'capability'    => 'manage_options',
					'menu_slug'     => 'iron_music_discography',
					'sections'      => array(
						array(
							'id'    => 'iron_discography',
							'title' => esc_html__('Discography Features','croma-music'),
							'fields'=> array(
								// text input
								array(
									'id'    => 'discography_slug_name',
									'title' => esc_html__('Discography Slug Name','croma-music'),
									'type'  => 'text',
									'description' => esc_html__('eg: http://www.domain.com/SLUG-NAME/album-title','croma-music'),
									'value' => 'albums'
								),
							)
						),
					),
				),

				array(
					'page_title'	=> 'Import / Export',
					'menu_title' 	=> 'Import / Export',
					'capability'    => 'manage_options',
					'menu_slug'     => 'iron_music_import_export',
					'sections'      => array(
						array(
							'id'    => 'iron_import_export',
							'title' => esc_html__('Import / Export','croma-music'),
							'fields' => array(

								array(
									'id' => 'external_css',
									'type' => 'checkbox',
									'title' => esc_html__('Move Dynamic/Custom CSS Into External Stylesheet?', 'croma-music'),
									'description' => esc_html__('This gives you the option move all the dynamic css that lives in the head by default into its own file for aesthetic & caching purposes', 'croma-music'),
									'value' => 0
								),
								array(
									'id' => 'import_html',
									'title' => esc_html__('Data to import', 'croma-music'),
									'type' => 'html',
									'data' => '<textarea class="import"></textarea><br><button class="btn import">Import data</button>'
								),
								array(
									'id' => 'export_html',
									'title' => esc_html__('Data to export', 'croma-music'),
									'type' => 'htmlExport',
									'export_options' => array(
										'_iron_music_event_options',
								        '_iron_music_music_player_options',
								        '_iron_music_discography_options'
									)
								),
							)
						),
					),
				),
			),
	    ),
	);


	$ironFeatures_pages->pages( $ironFeatures_pages_options );

}
