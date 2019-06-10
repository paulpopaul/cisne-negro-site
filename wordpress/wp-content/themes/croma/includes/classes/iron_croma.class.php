<?php


class Iron_Croma{

	public static function setup(){
		load_template( get_template_directory().'/includes/classes/tgmpa.class.php', true );
		load_template( get_template_directory().'/includes/classes/iron_croma_archive.class.php', true );
		load_template( get_template_directory().'/includes/classes/iron_croma_setup.class.php', true );
		load_template( get_template_directory().'/framework-customizations/theme/hooks.php', true );
        load_template( get_template_directory().'/includes/classes/nav.class.php', true );

		if( !class_exists('Mobile_Detect') ){
			load_template( get_template_directory().'/includes/classes/Mobile_Detect.php', true );
		}
		Iron_Croma_Setup::execute();
	}

	public static function childDir(){
		return get_stylesheet_directory();
	}

	public static function childUrl(){
		return get_stylesheet_directory_uri();
	}

	public static function displayPageTitle( $pageId, $default = null ){
		if( $pageId ){
			echo get_the_title( $pageId );
		}
		echo $default;
	}

	/**
	 * IsLoginPage
	 * @return boolean
	 */
	public static function isLoginPage() {
		return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
	}


	public function getPageTitle( $pageId, $default = null ){
		if( $pageId ){
			return get_the_title( $pageId );
		}
		return $default;
	}

	/**
	 * getField
	 *
	 * @param string $metaKey The metaKey you whant the value
	 * @param int $postID The post ID you want to retreive the metaKey
	 * @param bool $single (Optional) Whether to return a single value.
	 * @return mixed Will be an array if $single is false. Will be value of meta data field if $single is true.
	*/
	public static function getField( $metaKey, $postId, $single = true ){
		// if ( function_exists('get_field') && $single ){
			// return get_field( $metaKey, $postId );
		// }
		// if ( function_exists( 'get_field_object' ) && !$single ) {
			// return get_field_object( $metaKey, $postId, true, true);
		// }

		return get_post_meta( $postId, $metaKey, $single );
	}



	public static function displayFullPagination () {
		global $wp_query, $wp_rewrite;
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		$pagination = array(
			'base' => add_query_arg('paged','%#%'),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
			'show_all' => false,
			'type' => 'list',
			'next_text' => '&raquo;',
			'prev_text' => '&laquo;'

			);



		if( !empty($wp_query->query_vars['s']) )
			$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

		if(isset($_GET['artist-id']) && !empty($_GET['artist-id'])) {
			$pagination['add_args'] = array('artist-id' => $_GET['artist-id']);
		}

		echo paginate_links( $pagination );
	}

	/**
	 * getOption
	 *
	 * @return mixedF
	 */
	public static function getOption( $id, $key = null, $default = null ){
		if( function_exists( 'croma_music_get_option' ) ){
			return croma_music_get_option( $id, $key, $default );
		}
		return $default;
	}

	/**
	 * Setup Dynamic Sidebar
	 */

	public static function setupDynamicSidebar ( $page_id ){
		$sidebar_area = 'croma_sidebar_0';
		$has_sidebar = is_active_sidebar($sidebar_area);
		$sidebar_position = Iron_Croma::getField('sidebar-position', $page_id);


		if ( 'disabled' === $sidebar_position ){
			$sidebar_position = false;
			$has_sidebar = false;
		}

		if ( $sidebar_position ){
			$sidebar_area = Iron_Croma::getField('sidebar-area_id', $page_id );
			$has_sidebar = is_active_sidebar( $sidebar_area );
		}

		return array( $has_sidebar, $sidebar_position, $sidebar_area );
	}


	public static function displayPageTitleDivider() {
		$divider_image = Iron_Croma::getOption('page_title_divider_image');
		$divider_color = Iron_Croma::getOption('page_title_divider_color', null, '#000000');
		$divider_margin_top = Iron_Croma::getOption('page_title_divider_margin_top');
		$divider_margin_bottom = Iron_Croma::getOption('page_title_divider_margin_bottom');
		if(empty($divider_image)){
			echo '<span class="heading-b3" style="margin-top:'.esc_attr($divider_margin_top).'px; margin-bottom:'.esc_attr($divider_margin_bottom).'px; background-color:'.esc_attr($divider_color).'"></span>';
		} else {
			echo '<img class="custom-header-img" style="margin-top:'.esc_attr($divider_margin_top).'px; margin-bottom:'.esc_attr($divider_margin_bottom).'px;" src="'.esc_url($divider_image).'" alt="divider" />';
		}
	}

	public static function isPageTitleUppercase() {
		$page_title_uppercase = (bool)Iron_Croma::getOption('page_title_uppercase');
		if(!empty($page_title_uppercase)){
			return true;
		}
		return false;
	}

	public static function getTemplatePart($type) {
		if($type == 'event')
			iron_music_get_template_part('event');
		elseif($type == 'album')
			iron_music_get_template_part('album');
		else
			get_template_part('items/' . $type);
	}

	public static function allowedHtml() {
		return array(
		    'a' => array(
		        'href' => array(),
		        'title' => array()
		    ),
		    'br' => array(),
		    'em' => array(),
		    'strong' => array(),
		    'p' => array(
		    	'style' => array()
		    ),
		    'font' => array(),
		    'b' => array(),
		    'span' => array(),

		);
	}
}