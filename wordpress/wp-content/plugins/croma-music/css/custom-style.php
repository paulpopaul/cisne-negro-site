<?php
header("Content-type: text/css; charset: UTF-8");

$post_id = !empty($_GET["post_id"]) ? intval($_GET["post_id"]) : null;
$backup_id = $post_id;
$iron_music_event_style = new Dynamic_Styles('_iron_music_event_options');
$iron_music_music_style = new Dynamic_Styles('_iron_music_music_player_options');

/* New Event Styles */
$iron_music_event_style->setFont('.event-line-node', 'events_item_typography', true);
$iron_music_event_style->setColor('.event-line-wrap:hover .event-line-node', 'events_item_hover_text_color');
$iron_music_event_style->setBackgroundColor('.event-line-wrap', 'events_item_bg_color');
$iron_music_event_style->setBackgroundColor('.event-line-wrap:hover', 'events_item_hover_bg_color');
$iron_music_event_style->setColor('.event-line-wrap .artists', 'events_item_bg_color');
$iron_music_event_style->setBackgroundColor('.event-line-wrap .artists', $iron_music_event_style->get_option('events_item_typography', 'color') );
$iron_music_event_style->setFont('.countdown-block', 'events_countdown_typography', true);
$iron_music_event_style->set('.countdown-block', 'letter-spacing', 'events_countdown_letterspacing');
$iron_music_event_style->setBackgroundColor('.event-line-wrap .event-line-countdown-wrap', 'events_countdown_bg_color');
$iron_music_event_style->set('.event-line-wrap', 'padding-top', 'events_items_padding');
$iron_music_event_style->set('.event-line-wrap', 'padding-bottom', 'events_items_padding');
$iron_music_event_style->set('ul.concerts-list', 'border-top-color', 'events_outline_colors');
$iron_music_event_style->set('ul.concerts-list li', 'border-bottom-color', 'events_outline_colors');
$iron_music_event_style->set('.events-bar', 'border-top-color', 'events_outline_colors');
$iron_music_event_style->set('span.events-bar-artists select', 'border-color', 'events_filter_outline_color');
$iron_music_event_style->setBackgroundColor('.events-bar', 'events_filter_bg_color');
$iron_music_event_style->setFont('span.events-bar-title, span.events-bar-artists select', 'events_filter_typography', true);
$iron_music_event_style->set('span.events-bar-title, span.events-bar-artists select', 'letter-spacing', 'events_filter_letterspacing');
$iron_music_event_style->set('span.events-bar-artists:after', 'border-top-color', 'events_filter_outline_color');
$iron_music_event_style->set('span.events-bar-artists:after', 'border-bottom-color', 'events_filter_outline_color');


$global_custom_css = $iron_music_event_style->get_option('custom_css');



$iron_music_event_style->setCustomCss($global_custom_css);



// Music Player Style

$iron_music_music_style->setFont('.iron-audioplayer .playlist .audio-track, .iron-audioplayer .playlist .track-number', 'music_player_playlist', true);
$iron_music_music_style->setFont('.iron-audioplayer .track-title, .continuousPlayer .track-name, .artist_player .track-name', 'music_player_song_title', true);
$iron_music_music_style->setFont('.iron-audioplayer .album-title, .continuousPlayer .album-title, .artist_player .album-title', 'music_player_album_title', true);

$iron_music_music_style->setColor('.continuousPlayer .track-name', 'continuous_music_player_label_color', true);
$iron_music_music_style->setColor('.continuousPlayer .album-title', 'continuous_music_player_label_color', true);

$music_player_hover_playlist = '.iron-audioplayer .playlist :not([data-audiopath = ""])>.audio-track:hover';
$iron_music_music_style->setColor($music_player_hover_playlist, 'music_player_playlist_hover_color');


$music_player_playlist_active_text_color = '.iron-audioplayer .playlist li.current.playing .audio-track';
$iron_music_music_style->setColor($music_player_playlist_active_text_color, 'music_player_playlist_active_text_color');


$global_custom_css = $iron_music_music_style->get_option('custom_css');
$iron_music_music_style->setCustomCss($global_custom_css);

$iron_music_music_style->setBackgroundColor('.continuousPlayer', 'continuous_music_player_background');

$musicPlayerPlaylist = $iron_music_music_style->get_option('music_player_playlist');
if(!empty($musicPlayerPlaylist["color"])) {
	$iron_music_music_style->useOptions(false);
	$iron_music_music_style->setColor('.playlist .cr_it-playlist-title, .cr_it-playlist-artists, .cr_it-playlist-release-date', $musicPlayerPlaylist["color"]);
	$iron_music_music_style->useOptions(true);
}


//RENDER
$option_style = !empty($_GET["option_style"]) ? $_GET["option_style"] : NULL ;

switch ($option_style) {
    case 'event':
        $iron_music_event_style->render();
        echo ".event-line-wrap .artists{ background-color:" . $iron_music_event_style->get_option('events_item_typography', 'color') . "}";
        break;

    default:

        $iron_music_music_style->render();
        $iron_music_player = get_option('_iron_music_music_player_options');
        echo '.iron-audioplayer .control polygon, .iron-audioplayer .control path, .iron-audioplayer .control rect, .continuousPlayer .control rect, .continuousPlayer .control path, .continuousPlayer .control polygon{
        	fill:' . get_ironMusic_option('music_player_icon_color', '_iron_music_music_player_options') . ';
        }
        .iron-audioplayer .player .currentTime, .iron-audioplayer .player .totalTime{
            color:' . get_ironMusic_option('music_player_icon_color', '_iron_music_music_player_options') . ';
        }
        .iron-audioplayer .playlist .track-number svg path, .iron-audioplayer .playlist .track-number svg rect{
            fill:' . get_ironMusic_option('music_player_playlist_active_text_color', '_iron_music_music_player_options') . ';
        }';

        echo '.continuousPlayer .control rect, .continuousPlayer .control path, .continuousPlayer .control polygon{
        	fill:' . get_ironMusic_option('continuous_music_player_control_color', '_iron_music_music_player_options') . ';
        }';

        break;
}