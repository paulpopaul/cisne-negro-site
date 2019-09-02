<?php

class Iron_Croma_Archive{
	private $_post;
	private $_post_type;
	private $_wp_query;
	private $_paged;
	private $_postTypeObject;

	private $_pageForArchives;

	private $_itemTemplate ;
	private $_enableExcerpts;
	private $_eventsFilter;
	private $_linkMode;
	private $_pageTitleIsHidden;
	private $_hasSideBar;
	private $_sideBarPosition;
	private $_sideBarArea;
	private $_showPostDate;

	private $_isoCol;
	private $_tag;
	private $_class;
	private $_caption;
	private $_next;
	private $_prev;

	private $_attributes = array();

	private $_archiveTitle;
	private $_archiveContent;
	private $_paginateMethod;

	private $_taxonomy;
	private $_term;

	public function __construct(){
		// Set global
		global $post, $post_type, $wp_query;

		$this->_post =& $post;
		$this->_post_type = $post_type;
		$this->_wp_query =& $wp_query;
		$this->_paged = get_query_var('paged') ? get_query_var('paged') : 1;
	}

	public function get_linkMode(){
		return $this->_linkMode;
	}

	public function compile(){
		$this->_postTypeObject = get_post_type_object( $this->_post_type );

		$archivePageName = ( 'post' == $this->getPostType() ) ? get_option('page_for_posts') : Iron_Croma::getOption('page_for_' . $this->getPostType() . 's');
		$this->_pageForArchives = get_post( $archivePageName );

		if($this->_pageForArchives) {
			list( $this->_hasSideBar, $this->_sideBarPosition, $this->_sideBarArea ) = Iron_Croma::setupDynamicSidebar( $this->_pageForArchives->ID );
		}


		if ( is_tax() ){
			$this->_taxonomy = get_query_var('taxonomy');
			$this->_term = get_term_by( 'slug', get_query_var('term'), $this->_taxonomy );
		} elseif ( is_category() ) {
			$this->_taxonomy = 'category';
			$this->_term = get_category( get_query_var('cat') );
		} elseif ( is_tag() ) {
			$taxonomy = 'post_tag';
			$this->_term = get_term_by( 'slug', get_query_var('tag'), $this->_taxonomy );
		}

		$this->_paginateMethod = Iron_Croma::getOption('paginate_method', null, 'posts_nav_link');

		if ( $this->_paginateMethod == 'paginate_scroll' ){
			$this->_paginateMethod = "paginate_more";
		}

		if( is_home() && $this->_wp_query->queried_object ){
			$this->setItemTemplate('post_classic');
			$this->_enableExcerpts = Iron_Croma::getField('enable_excerpts', $this->_wp_query->queried_object->ID);
		}

		if ( $this->_itemTemplate == 'post_classic' && Iron_Croma::getOption( 'post_archive_default_template' ) == 'archive-posts-grid') {
			$this->setItemTemplate('post_grid');
		}

		if ( is_category() ) {
			$this->_enableExcerpts = true;
		}

		if( $this->_postTypeObject && ! empty( $this->_postTypeObject->label ) && !is_search() ){
			if ( isset($this->_wp_query->queried_object) && isset($this->_wp_query->queried_object->ID) ) {
				$this->_archiveTitle = get_the_title( $this->_wp_query->queried_object->ID );
				$this->_archiveContent = apply_filters('the_content', $this->_wp_query->queried_object->post_content);

				$postId = $this->_wp_query->queried_object->ID;

			}else{
				$this->_archiveTitle = $archive_title = get_the_title( $this->_post->ID );
				$this->_archiveContent = apply_filters('the_content', $this->_post->post_content);
				$postId = $this->_post->ID;

			}

			$this->_pageTitleIsHidden = Iron_Croma::getField('hide_page_title', $postId );
			switch($this->getPostType()){
				case 'post':
					$this->_enableExcerpts = Iron_Croma::getField('enable_excerpts', $postId );
					break;
				case 'event':
					$this->_eventsFilter = Iron_Croma::getField('events_filter', $postId );
					break;
				case 'video':
					$this->_linkMode = get_field('video_link_type', $postId );

			}
		}


		switch ( $this->getPostType() ) {
			case 'post':
				$this->setupTypePost();
				break;

			case 'event':
				$this->setupTypeEvent();
				break;

			case 'album':
				$this->setupTypeAlbum();
				break;

			case 'video':
				$this->setupTypeVideo();
				break;

			case 'portfolio':
				$this->setupTypePortfolio();
				break;

			case 'artist':
				$this->setupTypeAlbum();
				break;

			default:
				$this->_tag = 'div';
				$this->_class = 'post-listing';
				$this->_attributes[] = 'data-callback="initGridDisplayNews"';
				$this->_caption = esc_html__('Older Posts','croma');
				$this->_next = esc_html__('Next Posts','croma');
				$this->_prev = esc_html__('Previous Posts','croma');
				break;
		}

		$this->_wp_query->query_vars["is_archive"] = true;
		$this->initAttributes();

	}

	private function setupTypePost(){
		$this->_tag = 'div';

		switch($this->getItemTemplate()){
			case 'post_grid':
				$this->_class = 'articles-section';
				break;
			case 'post_isotope':
				$this->_class = 'isotope-wrap';
				break;
			case 'post_classic':
				$this->_class = 'articles-classic';
				break;
			default:
				$this->_class = 'listing-section news';
		}

		$this->_attributes[] = 'data-callback="initGridDisplayNews,initIsotope"';

		$this->_caption = esc_html__('Older News','croma');
		$this->_next = esc_html__('Older News','croma');
		$this->_prev = esc_html__('Recent News','croma');
	}

	private function setupTypeEvent(){
		if(empty($this->_archiveTitle)) { $this->_archiveTitle = $this->_postTypeObject->labels->name; }
		$this->_tag = 'ul';
		$this->_class = 'concerts-list';
		$this->_attributes[] = 'data-active="' . ( empty($_GET['id']) ? '' : $_GET['id'] ) . '"';
		$this->_attributes[] = 'data-callback="initEventCenter,initCountdownCenter,initDisableTimers"';
		$this->_caption = esc_html__('More Events','croma');
		$this->_next = esc_html__('Next Events','croma');
		$this->_prev = esc_html__('Previous Events','croma');
	}

	private function setupTypeAlbum(){
		if(empty($this->_archiveTitle)) { $this->_archiveTitle = $this->_postTypeObject->labels->name; }
		$this->_tag = 'div';
		$this->_class = 'two_column_album';
		$this->_attributes[] = 'data-callback="initGridDisplayAlbum,initHeadsetCenter"';
		$this->_caption = esc_html__('More Albums','croma');
		$this->_next = esc_html__('Next Albums','croma');
		$this->_prev = esc_html__('Previous Albums','croma');
	}

	private function setupTypeVideo(){
		$this->_tag = 'div';
		$this->_class = 'listing-section videos';
		$this->_attributes[] = 'data-callback="initGridDisplayVideo,initVideoLinks"';
		$this->_caption = esc_html__('More Videos','croma');
		$this->_next = esc_html__('Next Videos','croma');
		$this->_prev = esc_html__('Previous Videos','croma');
	}

	private function setupTypePortfolio(){
		$this->_tag = 'div';
		$this->_class = 'isotope-wrap';
		$this->_attributes[] = 'data-callback="initGridDisplayNews,initIsotope"';
		$this->_caption = esc_html__('More Projects','croma');
		$this->_next = esc_html__('Next Projects','croma');
		$this->_prev = esc_html__('Previous Projects','croma');
	}

	public function setPostType( $value ){
		$this->_post_type = $value;
	}

	public function getPostType(){
		return $this->_post_type;
	}


	public function setItemTemplate( $value ){
		$this->_itemTemplate = $value;
	}

	public function setIsoCol( $value ){
		$this->_isoCol = $value;
	}

	public function getIsoCol(){
		return $this->_isoCol;
	}

	public function getItemTemplate(){
		if ( $this->_itemTemplate === null ){
			return $this->_post_type;
		}
		return $this->_itemTemplate;
	}

	public function initAttributes(){
		$this->_attributes[] = 'data-type="' . esc_attr( $this->getPostType() ) . '"';
		$this->_attributes[] = 'data-page="' . esc_attr( $this->_paged ) . '"';
		if ( ! empty($this->_term) && ! is_wp_error( $this->_term ) ){
			$this->_attributes[] = 'data-taxonomy="' . $this->_taxonomy . '"';
			$this->_attributes[] = 'data-term="' . $this->_term->term_id . '"';
		}

		$this->_attributes[] = 'data-paginate="' . esc_attr($this->getPaginateMethod()) . '"';
		$this->_attributes[] = 'data-template="' . esc_attr($this->getItemTemplate()) . '"';
		$this->_attributes[] = 'data-excerpts="' . esc_attr($this->_enableExcerpts) . '"';
		$this->_attributes[] = 'data-postdate="' . esc_attr($this->_showPostDate) . '"';
		$this->_attributes[] = 'data-eventsfilter="' . esc_attr($this->_eventsFilter) . '"';
		$this->_attributes[] = 'data-isocol="' . esc_attr($this->_isoCol) . '"';
		$this->_attributes[] = 'data-caption="' . esc_attr($this->_caption) . '"';
	}

	public function getAttributesList(){
		return implode(' ', $this->_attributes );
	}

	public function getPaginateMethod(){
		return $this->_paginateMethod;
	}

	public function getArchiveTitle(){
		if ( ! empty($this->_term) && ! is_wp_error( $this->_term ) ){
			return $this->_term->name;
		}

		if ( is_day() ){
			return $this->_archiveTitle = sprintf( esc_html__('Daily Archives: %s', 'croma'), get_the_date() );
		}

		if ( is_month() ) {
			return $this->_archiveTitle = sprintf( esc_html__('Monthly Archives: %s', 'croma'), get_the_date( esc_html_x('F Y', 'monthly archives date format', 'croma') ) );
		}

		if ( is_year() ) {
			return $this->_archiveTitle = sprintf( esc_html__('Yearly Archives: %s', 'croma'), get_the_date( esc_html_x('Y', 'yearly archives date format', 'croma') ) );
		}

		if ( is_search() || !empty($_GET["s"])) {
			return $this->_archiveTitle = sprintf( esc_html__('Search Results', 'croma'));
		}
		if ( is_author() ){
			$iron_croma_author = ( $this->_post )? $this->_post->post_author : $this->_wp_query->get_queried_object()->ID;
			return $this->_archiveTitle = get_the_author_meta( 'nicename', $iron_croma_author );
		}

		if ( is_tag() ) {
			return $this->_archiveTitle = $this->_wp_query->query['tag'];
		}
		if ( is_home() ) {
			return $this->_archiveTitle = '';
		}
		return $this->_post->post_title;

	}

	public function get404message(){
		switch ( $this->getPostType() ) {
			case 'event':
				echo '<div class="search-result"><h3>'.esc_html__('No events at this time', 'croma').'</h3>';
				echo '<p>'.esc_html__('Check back at a later time', 'croma').'</p></div>';
				break;

			default:
					echo '<div class="search-result"><h3>'.esc_html__('Nothing Found!', 'croma').'</h3>';
					echo '<p>'.esc_html__('Search keyword', 'croma').': '.get_search_query().'</p>';
					echo '<p>'.esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'croma').'</p></div>';
				break;
		}
	}

	public function getArchiveContent(){
		if( is_day() || is_month() || is_year() || is_search() || is_home() || is_archive() || is_tax() || is_category() || is_tag() ){
			return '';
		}
		return $this->_archiveContent;
	}

	public function hasTitle(){
		return !$this->_pageTitleIsHidden;
	}

	public function hasSidebar(){
		return (bool)$this->_hasSideBar;
	}

	public function getSideBarPosition(){
		return $this->_sideBarPosition;
	}

	public function getSideBarArea(){
		return $this->_sideBarArea;
	}

	public function getTag(){
		return $this->_tag;
	}

	public function getClass(){
		return $this->_class;
	}


	public function getPrev(){
		return $this->_prev;
	}

	public function getNext(){
		return $this->_next;
	}

	public function displayDate(){
		return $this->_showPostDate;
	}

	public function enableExcerpts(){
		return $this->_enableExcerpts;
	}

	public function changeQuery(){
		// Prevent extra database query by enabling permalink structure
		if ( $this->_post_type !== get_post_type() ){
			if( empty($_GET["s"]) ) {
				$this->_pageForArchives = $this->_post;
				query_posts( array('post_type' => $this->_post_type, 'paged' => $this->_paged ) );
			}
		}
	}
}