<?php
header("Content-type: text/css; charset: UTF-8");

$iron_music_event_style = new Dynamic_Styles('_iron_music_event_options');

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



$iron_music_event_style->render();

echo ".event-line-wrap .artists{ background-color:" . $iron_music_event_style->get_option('events_item_typography', 'color') . "}";