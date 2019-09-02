<?php




add_action( 'init', 'post_type_init' );
add_action( 'init', 'setup_future_hook' );
add_filter( 'wp_insert_post_data', 'iron_pre_post_update', 10, 2 );
add_filter( 'post_updated_messages', 'events_updated_messages' );
add_filter( 'manage_edit-event_sortable_columns', 'iron_music_manage_event_sortable_columns' );
add_action( 'pre_get_posts', 'iron_music_pre_get_post_types' );
add_filter( 'posts_where', 'iron_events_where' );
add_filter( 'posts_orderby', 'iron_events_orderby' );
add_action( 'manage_event_posts_custom_column', 'iron_manage_event_custom_column', 10, 2 );
add_filter( 'manage_event_posts_columns', 'iron_music_manage_event_columns' );
add_action( 'posts_selection', 'iron_music_posts_selection' );

$iron_features_post_types = array('event', 'album', 'video', 'artist');
$iron_features_query = new stdClass();

function post_type_init() {

    $default_args = array(
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'has_archive'         => true,
        'query_var'           => true,
        'exclude_from_search' => false

    );

    /* Events Post Type (events)
   ========================================================================== */
	$events_args = array(
		'labels'            => array(
			'name'                => esc_html__( 'Events', 'croma-music' ),
			'singular_name'       => esc_html__( 'Events', 'croma-music' ),
			'all_items'           => esc_html__( 'Events', 'croma-music' ),
			'new_item'            => esc_html__( 'New events', 'croma-music' ),
			'add_new'             => esc_html__( 'Add New', 'croma-music' ),
			'add_new_item'        => esc_html__( 'Add New events', 'croma-music' ),
			'edit_item'           => esc_html__( 'Edit events', 'croma-music' ),
			'view_item'           => esc_html__( 'View events', 'croma-music' ),
			'search_items'        => esc_html__( 'Search events', 'croma-music' ),
			'not_found'           => esc_html__( 'No events found', 'croma-music' ),
			'not_found_in_trash'  => esc_html__( 'No events found in trash', 'croma-music' ),
			'parent_item_colon'   => esc_html__( 'Parent events', 'croma-music' ),
			'menu_name'           => esc_html__( 'Events', 'croma-music' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-calendar-alt',
		'menu_position'		=> 25
	);

	$events_args['supports'] = array(
		'title',
		'editor',
		'excerpt',
		'thumbnail',
		'comments',
		'custom-fields',
		'revisions'
	);

	$slug = ( get_ironMusic_option( 'events_slug_name', '_iron_music_event_options' ) )? get_ironMusic_option( 'events_slug_name', '_iron_music_event_options' ): 'events' ;
	$events_args['rewrite'] = array( 'slug'=>$slug );

	register_post_type( 'event',  $events_args );




    /* Album Post Type (album)
   ========================================================================== */

    $album_args = $default_args;

    $album_args['labels'] = array(
          'name'               => esc_html__('Discographies', 'croma-music')
        , 'singular_name'      => esc_html__('Album', 'croma-music')
        , 'name_admin_bar'     => esc_html_x('Album', 'add new on admin bar', 'croma-music')
        , 'menu_name'          => esc_html__('Discographies', 'croma-music')
        , 'all_items'          => esc_html__('All Albums', 'croma-music')
        , 'add_new'            => esc_html__('Add New', 'album', 'croma-music')
        , 'add_new_item'       => esc_html__('Add New album', 'croma-music')
        , 'edit_item'          => esc_html__('Edit album', 'croma-music')
        , 'new_item'           => esc_html__('New album', 'croma-music')
        , 'view_item'          => esc_html__('View album', 'croma-music')
        , 'search_items'       => esc_html__('Search Discography', 'croma-music')
        , 'not_found'          => esc_html__('No albums found.', 'croma-music')
        , 'not_found_in_trash' => esc_html__('No albums found in the Trash.', 'croma-music')
        , 'parent'             => esc_html__('Parent album:', 'croma-music')
    );

    $album_args['supports'] = array('title','editor','excerpt','thumbnail','custom-fields','revisions');
    $slugMusic = ( get_ironMusic_option( 'discography_slug_name', '_iron_music_discography_options' ) )? get_ironMusic_option( 'discography_slug_name', '_iron_music_discography_options' ): 'discography';
    $album_args['rewrite'] = array( 'slug'=>$slugMusic );

    $album_args['menu_icon'] = 'dashicons-format-audio';

    register_post_type( 'album' , $album_args);


     /* Artists Post Type (artist)
   ========================================================================== */

    $artists_args = $default_args;

    $artists_args['labels'] = array(

          'name'               => esc_html__('Artists', 'croma-music')
        , 'singular_name'      => esc_html__('Artist', 'croma-music')
        , 'name_admin_bar'     => esc_html_x('Artist', 'add new on admin bar', 'croma-music')
        , 'menu_name'          => esc_html__('Artists', 'croma-music')
        , 'all_items'          => esc_html__('All Artists', 'croma-music')
        , 'add_new'            => esc_html__('Add Artist', 'video', 'croma-music')
        , 'add_new_item'       => esc_html__('Add New Artist', 'croma-music')
        , 'edit_item'          => esc_html__('Edit Artist', 'croma-music')
        , 'new_item'           => esc_html__('New Project', 'croma-music')
        , 'view_item'          => esc_html__('View Artist', 'croma-music')
        , 'search_items'       => esc_html__('Search Artist', 'croma-music')
        , 'not_found'          => esc_html__('No artists found.', 'croma-music')
        , 'not_found_in_trash' => esc_html__('No artists found in the Trash.', 'croma-music')
        , 'parent'             => esc_html__('Parent Artist:', 'croma-music')
    );

    $artists_args['supports'] = array('title', 'editor', 'revisions','thumbnail');


    $artists_args['menu_icon'] = 'dashicons-groups';

    $artists_args['rewrite'] = array('slug'=> esc_html__('artist', 'croma-music') );

    register_post_type('artist', $artists_args);


    /* Video Post Type (video)
   ========================================================================== */

    $video_args = $default_args;

    $video_args['labels'] = array(
          'name'               => esc_html__('Videos', 'croma-music')
        , 'singular_name'      => esc_html__('Video', 'croma-music')
        , 'name_admin_bar'     => esc_html_x('Video', 'add new on admin bar', 'croma-music')
        , 'menu_name'          => esc_html__('Videos', 'croma-music')
        , 'all_items'          => esc_html__('All Videos', 'croma-music')
        , 'add_new'            => esc_html__('Add New', 'video', 'croma-music')
        , 'add_new_item'       => esc_html__('Add New Video', 'croma-music')
        , 'edit_item'          => esc_html__('Edit Video', 'croma-music')
        , 'new_item'           => esc_html__('New Video', 'croma-music')
        , 'view_item'          => esc_html__('View Video', 'croma-music')
        , 'search_items'       => esc_html__('Search Video', 'croma-music')
        , 'not_found'          => esc_html__('No videos found.', 'croma-music')
        , 'not_found_in_trash' => esc_html__('No videos found in the Trash.', 'croma-music')
        , 'parent'             => esc_html__('Parent Video:', 'croma-music')
    );

    $video_args['supports'] = array(
          'title'
        , 'editor'
        , 'excerpt'
        , 'thumbnail'
        , 'comments'
        , 'custom-fields'
        , 'revisions'
    );


    $video_args['menu_icon'] = 'dashicons-format-video';

    $video_args['rewrite'] = array('slug'=> esc_html__('videos', 'croma-music'));
    register_post_type('video', $video_args);


}










function events_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['events'] = array(
		0 => '', // Unused. Messages start at index 1.

		1 => wp_kses(sprintf( __('Events updated. <a target="_blank" href="%s">View events</a>', 'croma-music'), esc_url( $permalink ) ),get_allowed_html()),
		2 => esc_html__('Custom field updated.', 'croma-music'),
		3 => esc_html__('Custom field deleted.', 'croma-music'),
		4 => esc_html__('Events updated.', 'croma-music'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( esc_html__('Events restored to revision from %s', 'croma-music'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => wp_kses(sprintf( __('Events published. <a href="%s">View events</a>', 'croma-music'), esc_url( $permalink ) ),get_allowed_html()),
		7 => esc_html__('Events saved.', 'croma-music'),
		8 => wp_kses(sprintf( __('Events submitted. <a target="_blank" href="%s">Preview events</a>', 'croma-music'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),get_allowed_html()),
		9 => wp_kses(sprintf( __('Events scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview events</a>', 'croma-music'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( esc_html__( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),get_allowed_html()),
		10 => wp_kses(sprintf( __('Events draft updated. <a target="_blank" href="%s">Preview events</a>', 'croma-music'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),get_allowed_html()),
	);

	return $messages;
}






/*-----------------------------------------------------------------------------------*/
/* Post Type Sorting & Filtering
/*-----------------------------------------------------------------------------------*/

function iron_music_pre_get_post_types ( $query ){
    global $iron_features_post_types, $iron_features_query, $post;

    $post_type = $query->get('post_type');
    $posts_per_page = $query->get('posts_per_page');

    if ( $query->get('taxonomy') == 'events-category') {
        $post_type = 'event';
    }

    if ( is_array( $iron_features_post_types ) && in_array($post_type, $iron_features_post_types) ){

    if (  !is_admin() ) {
        $iron_features_query->post_type = $post_type;

            if ( empty($posts_per_page) || $posts_per_page == 0 ) {
                switch ($post_type) {
                    case 'event':
                        $posts_per_page = get_ironMusic_option('events_per_page', '_iron_music_event_options');
                        break;
                    case 'album':
                        $posts_per_page = get_ironMusic_option('albums_per_page', '_iron_music_discography_options');
                        break;

                    default:
                        $posts_per_page = -1;
                        break;
                }
                $query->set( 'posts_per_page',  $posts_per_page);
            }
        }
    }


    if ( (!is_admin() || ( defined('DOING_AJAX') && DOING_AJAX ) ) && ( $post_type == 'event' || $post_type == 'album' ) ) {

        $artists_filter = array();
        if(!empty($post->ID)) {
            $artists_filter = get_post_meta( $post->ID , 'artists_filter', true );
        }
        if(empty($artists_filter)) {
            $artists_filter = $query->get('artists_filter');
        }


        $key = false;
        if($post_type == 'event') {

            $key = 'artist_events';

        }else if($post_type == 'album') {

            $key = 'artist_discography';

        }


        if(!empty($key) && !empty($artists_filter)) {

            $artist_posts = array();
            foreach($artists_filter as $artist) {

                $posts = get_field($key, $artist);

                if ( is_array( $posts ) ) {
                    $artist_posts = array_merge($artist_posts, $posts);
                }
            }

            $query->set('post__in', $artist_posts);


        }

    }


    if ( 'album' == $post_type && !is_admin() ) {

        $query->set( 'posts_per_page', -1 );

    }


    if ( 'event' == $post_type ){

        
        $iron_features_query->is_main_query = $query->is_main_query();

        $order = $query->get('order');
        $orderby = $query->get('orderby');



        if ( is_admin() && ! $query->get('ajax') ) {

            // Furthest to Oldest
            if ( empty( $order ) )
                $query->set('order', 'ASC');

            if ( empty( $orderby ) )
                $query->set('orderby', 'date');

        } else {

            if(empty($query->query_vars['filter'])) {
                $filter = get_field('events_filter', get_the_id());
                if(empty($filter)) {
                    $filter  = ( empty( $_POST['eventsfilter'] ) ? 'upcoming' : sanitize_key($_POST['eventsfilter']) );
                }

                $query->query_vars['filter'] = $filter;
            }

            $filter = $query->query_vars['filter'];
            $iron_features_query->query_vars['filter'] = $filter;

            // reset Post Status
            $query->set('post_status', array('publish'));

        }


    }

}



function iron_events_where ( $where = '' ){
    global $wpdb, $iron_features_query, $wp_query;


    
    if( is_single() && $iron_features_query->post_type != 'event' )
    return $where;
    
    if( ( is_archive() || is_home() ) && !isset( $iron_features_query->query_vars ) )
    return $where;
    
    if( is_admin() )
    return $where;
    
    if( isset( $iron_features_query->post_type ) && $iron_features_query->post_type != 'event' )
    return $where;
    
    
    if ( is_single() && $iron_features_query->post_type == 'event' && $iron_features_query->is_main_query && ( $wp_query->query_vars['post_type'] == $iron_features_query->post_type )  )
        return $where;
        
    
    if (empty($iron_features_query->query_vars['filter']))
        return $where;


    if( $iron_features_query->query_vars['filter'] == 'past') {

        $where .= " AND ($wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_status != 'future') AND DATE ($wpdb->posts.post_date) < '" . date_i18n('Y-m-d 00:00:00') . "'";

    }else{

        $where .= " AND ($wpdb->posts.post_status = 'publish' OR $wpdb->posts.post_status = 'future') AND DATE ($wpdb->posts.post_date) >= '" . date_i18n('Y-m-d 00:00:00') . "'";

    }

    return $where;
}




function iron_events_orderby($orderby) {
    global $iron_features_query, $wpdb, $wp_query;

    if( is_single() && $iron_features_query->post_type != 'event' )
        return $orderby; 
        
    if( ( is_archive() || is_home() ) && !isset( $iron_features_query->query_vars ) )
        return $orderby;
        
    if( is_admin() )
        return $orderby;
        
    if( isset( $iron_features_query->post_type ) && $iron_features_query->post_type != 'event' )
        return $orderby;
        
    if ( is_single() && ( isset( $iron_features_query->post_type ) && $iron_features_query->post_type != 'event' ) && ( $wp_query->query_vars['post_type'] == $iron_features_query->post_type )  )
        return $orderby;
         
    //WIP - line below throw another error. Commit: 8fded1e | so I replaced it by the old code: Undefined property: stdClass::$query_vars in /wp-content/plugins/croma-music-fix/includes/posttypes.php on line 427
    if ( isset( $iron_features_query->query_vars ) && $iron_features_query->query_vars['filter'] == NULL )
        return $orderby;
    
    if( !empty( $wp_query->query ) && ( isset( $wp_query->query['post_type'] ) && $wp_query->query['post_type'] !== 'event' ) && empty($iron_features_query->query_vars['filter']) )
        return $orderby;

    if ( !( is_single() && $wp_query->query['post_type'] == 'event') ){
        
        if( $iron_features_query->query_vars['filter'] == 'past'){
            $orderby = $wpdb->prefix."posts.post_date DESC";
        }else{    
            $orderby = $wpdb->prefix."posts.post_date ASC";
        }
    }
    
    return $orderby;
}



function iron_music_posts_selection ()
{
    $iron_features_query = (object) array();
}



function setup_future_hook() {
// Replace native future_post function with replacement
    remove_action('future_event','_future_post_hook');
    add_action('future_event','iron_music_publish_future_post_now');
}

function iron_music_publish_future_post_now($id) {
// Set new post's post_status to "publish" rather than "future."
    if(!empty($_POST["post_type"]) && $_POST["post_type"] == "event")
        wp_publish_post($id);
}






/*-----------------------------------------------------------------------------------*/
/* Event Management
/*-----------------------------------------------------------------------------------*/

function iron_music_manage_event_columns ($columns)
{
    unset( $columns['date'] );
    unset( $columns['comments'] );

    $iron_cols = array(
        'event_date'    => esc_html__('Date', 'croma-music'),
        'event_city'    => esc_html__('City', 'croma-music'),
        'event_venue'   => esc_html__('Venue', 'croma-music'),
        'event_artists'   => esc_html__('Artist(s)', 'croma-music'),

    );

    /*if ( function_exists('array_insert') )
        $columns = array_insert($columns, $iron_cols, 'date', 'after');
    else*/
        $columns = array_merge($columns, $iron_cols);


    $columns['title'] = esc_html__('Event', 'croma-music');  // Renamed first column

    return $columns;
}




// Events: Display Custom Columns

function iron_manage_event_custom_column ($column, $post_id)
{
    switch ($column)
    {
        case 'event_date':
            global $mode;

            $post = get_post( $post_id );
            setup_postdata( $post );

            if ( '0000-00-00 00:00:00' == $post->post_date ) {
                $t_time = $h_time = esc_html__('Unpublished', 'croma-music');
            } else {
                $t_time = get_the_time( esc_html__('Y/m/d g:i:s A', 'croma-music') );

                $h_time = date_i18n( get_option('date_format') . ' ' . get_option('time_format'), get_post_time('U', false, $post_id) );
            }

            echo '<abbr title="' . $t_time . '">' . apply_filters( 'post_date_column_time', $h_time, $post, 'event_date', $mode ) . '</abbr>';
        break;

        case 'event_city':
            $post_meta = get_post_meta( $post_id, 'event_city' );
            if ( ! empty( $post_meta ) )
                echo get_post_meta( $post_id, 'event_city', true );
            else
                echo esc_html__('N/A', 'croma-music');


            break;

        case 'event_venue':
            $post_meta = get_post_meta( $post_id, 'event_venue' );
            if ( ! empty( $post_meta ) )
                echo get_post_meta( $post_id, 'event_venue', true);
            else
                echo esc_html__('N/A', 'croma-music');
            break;

        case 'event_artists':
            $post_meta = get_post_meta( $post_id, 'artist_at_event' );

            if ( ! empty( $post_meta[0] ) ){
                foreach ($post_meta[0] as $key => $artist) {
                    $title = ( $key == 0 )? '' : ', ' ;
                    $title .= get_the_title($artist);
                    echo $title;
                }
            }else{
                echo esc_html__('N/A', 'croma-music');
            }
            break;

        default:
            break;

    }
}




// Events: Register Custom Columns as Sortable

function iron_music_manage_event_sortable_columns ($columns)
{
    $columns['event_date']  = 'date';
    // $columns['event_city']  = 'event_city';
    // $columns['event_venue'] = 'event_venue';

    return $columns;
}



/*-----------------------------------------------------------------------------------*/
/* Discography Management
/*-----------------------------------------------------------------------------------*/

// Album: Icon


function iron_music_manage_album_columns ($columns)
{
    $iron_cols = array(
        'alb_tracklist'    => esc_html__('# Tracks', 'croma-music')
        , 'alb_store_list'   => esc_html__('# Stores', 'croma-music')
    );

    if ( function_exists('array_insert') )
        $columns = array_insert($columns, $iron_cols, 'date', 'before');
    else
        $columns = array_merge($columns, $iron_cols);


    $iron_cols = array(
        'icon' => ''
    );

    if ( function_exists('array_insert') )
        $columns = array_insert($columns, $iron_cols, 'title', 'before');
    else
        $columns = array_merge($columns, $iron_cols);

    $columns['date'] = esc_html__('Published', 'croma-music');   // Renamed date column

    return $columns;
}



add_filter('manage_album_posts_columns', 'iron_music_manage_album_columns');



// Discography: Display Custom Columns

function iron_music_manage_album_custom_column ($column, $post_id)
{
    switch ($column)
    {

        case 'alb_tracklist':
            if ( $list = get_field('alb_tracklist', $post_id) )
                echo count($list);
            else
                echo esc_html__('N/A', 'croma-music');
            break;

        case 'alb_store_list':
            if ( $list = get_field('alb_store_list', $post_id) )
                echo count($list);
            else
                echo esc_html__('N/A', 'croma-music');
            break;
        case 'icon':
            $att_title = _draft_or_post_title();
?>
                <a href="<?php echo esc_url(get_edit_post_link( $post_id, true )); ?>" title="<?php echo esc_attr( sprintf( esc_html__('Edit &#8220;%s&#8221;', 'croma-music'), $att_title ) ); ?>"><?php

                    if ( $thumb = get_the_post_thumbnail( $post_id, array(80, 60) ) )
                        echo $thumb;
                    else
                        echo '<img width="46" height="60" src="' . wp_mime_type_icon('image/jpeg') . '" alt="">';
                ?></a>
<?php
            break;
    }
}

add_action('manage_album_posts_custom_column', 'iron_music_manage_album_custom_column', 10, 2);


/*-----------------------------------------------------------------------------------*/
/* Video Management
/*-----------------------------------------------------------------------------------*/

function iron_music_manage_video_columns ($columns)
{
    $iron_cols = array(
        'icon' => ''
    );

    if ( function_exists('array_insert') )
        $columns = array_insert($columns, $iron_cols, 'title', 'before');
    else
        $columns = array_merge($columns, $iron_cols);

    $columns['date'] = __('Published', 'croma-music'); // Renamed date column

    return $columns;
}

add_filter('manage_video_posts_columns', 'iron_music_manage_video_columns');


// Videos: Display Custom Columns

function iron_music_manage_video_custom_column ($column, $post_id)
{
    switch ($column)
    {
        case 'icon':
            $att_title = _draft_or_post_title();
?>
                <a href="<?php echo esc_url(get_edit_post_link( $post_id, true )); ?>" title="<?php echo esc_attr( sprintf( __('Edit &#8220;%s&#8221;', 'croma-music'), $att_title ) ); ?>"><?php
                    if ( $thumb = get_the_post_thumbnail( $post_id, array(80, 60) ) )
                        echo $thumb;
                    else
                        echo '<img width="46" height="60" src="' . wp_mime_type_icon('image/jpeg') . '" alt="">';
                ?></a>
<?php
            break;
    }
}

add_action('manage_video_posts_custom_column', 'iron_music_manage_video_custom_column', 10, 2);








/**
 * Custom Taxonomies
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

$iron_taxonomies = array();

function iron_music_register_taxonomies ()
{
    global $iron_taxonomies;

    $iron_taxonomies = array( 'video-category', 'album-category', 'artist-category');

    $args = array(
          'public'            => true
        , 'show_ui'           => true
        , 'show_in_nav_menus' => true
        , 'show_in_admin_bar' => false
        , 'show_admin_column' => true
        , 'show_tagcloud'     => false
        , 'query_var'         => false
        , 'rewrite'           => true
        , 'hierarchical'      => true
        , 'sort'              => false
    );


/* Video Categories (video-categories)
   ========================================================================== */

    $labels = array(
          'name'          => esc_html_x('Video Categories',     'Taxonomy : name',          'croma-music')
        , 'all_items'     => esc_html_x('All Categories',       'Taxonomy : all_items',     'croma-music')
        , 'singular_name' => esc_html_x('Category',             'Taxonomy : singular_name', 'croma-music')
        , 'add_new_item'  => esc_html_x('Add New Category',     'Taxonomy : add_new_item',  'croma-music')
        , 'not_found'     => esc_html_x('No categories found.', 'Taxonomy : not_found',     'croma-music')
    );

    $args['labels'] = $labels;


    register_taxonomy('video-category', 'video', $args);


/* Discography Categories (discography-categories)
   ========================================================================== */

    $labels = array(
          'name'          => esc_html_x('Discography Categories', 'Taxonomy : name',          'croma-music')
        , 'all_items'     => esc_html_x('All Categories',       'Taxonomy : all_items',     'croma-music')
        , 'singular_name' => esc_html_x('Category',             'Taxonomy : singular_name', 'croma-music')
        , 'add_new_item'  => esc_html_x('Add New Category',     'Taxonomy : add_new_item',  'croma-music')
        , 'not_found'     => esc_html_x('No categories found.', 'Taxonomy : not_found',     'croma-music')
    );

    $args['labels'] = $labels;
    $args['rewrite'] = array(
        'with_front' => false
    );

    register_taxonomy('album-category', 'album', $args);

/* Artists Categories (photo-album-categories)
   ========================================================================== */

    $labels = array(
          'name'          => esc_html_x('Artists Categories',   'Taxonomy : name',          'croma-music')
        , 'all_items'     => esc_html_x('All Categories',       'Taxonomy : all_items',     'croma-music')
        , 'singular_name' => esc_html_x('Category',             'Taxonomy : singular_name', 'croma-music')
        , 'add_new_item'  => esc_html_x('Add New Category',     'Taxonomy : add_new_item',  'croma-music')
        , 'not_found'     => esc_html_x('No categories found.', 'Taxonomy : not_found',     'croma-music')
    );

    $args['labels'] = $labels;


    register_taxonomy('artist-category', 'artist', $args);


/* Events Categories (photo-album-categories)
   ========================================================================== */

    $labels = array(
          'name'          => esc_html_x('Events Categories',   'Taxonomy : name',          'croma-music')
        , 'all_items'     => esc_html_x('All Categories',       'Taxonomy : all_items',     'croma-music')
        , 'singular_name' => esc_html_x('Category',             'Taxonomy : singular_name', 'croma-music')
        , 'add_new_item'  => esc_html_x('Add New Category',     'Taxonomy : add_new_item',  'croma-music')
        , 'not_found'     => esc_html_x('No categories found.', 'Taxonomy : not_found',     'croma-music')
    );

    $args['labels'] = $labels;


    register_taxonomy('events-category', 'event', $args);

}

add_action('init', 'iron_music_register_taxonomies');

function iron_music_post_class_terms ( $classes = array() )
{
    global $post, $iron_taxonomies;


    global $post;

    foreach ( $iron_taxonomies as $tax )
    {
        if ( is_object_in_taxonomy( $post->post_type, $tax ) )
        {
            $terms = get_the_terms($post->ID, $tax);

            foreach ( (array) $terms as $term ) {
                if ( empty($term->slug ) )
                    continue;
                $classes[] = sanitize_html_class($tax, 'tax') . '-' . sanitize_html_class($term->slug, $term->term_id);
            }
        }
    }

    return $classes;
}

add_filter('post_class', 'iron_music_post_class_terms');



function iron_pre_post_update( $data, $postarr ){

        if ($data['post_type'] == 'event' && $data['post_status'] == 'future') {
            $data['post_status'] = 'publish';
        }

        if ( $data['post_type'] == 'album' && !empty( $postarr['fields']['field_548d3d6715e41'] ) ) {
            update_post_meta( $postarr['ID'], 'artist_of_album_string', get_the_title( $postarr['fields']['field_548d3d6715e41'][0] ) );
        }


        return $data;
}

if (function_exists('vc_set_default_editor_post_types')) {
   	vc_set_default_editor_post_types(
   		array(
   			'page',
			'event',
			'album',
			'artist',
			'video'
   		)
   	);
}