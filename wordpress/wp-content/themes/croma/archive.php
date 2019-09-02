<?php
global $iron_croma_archive;

if( !isset($iron_croma_archive) ){
	$iron_croma_archive = new Iron_Croma_Archive();
	$iron_croma_archive->setPostType( get_post_type() );
	$iron_croma_archive->setItemTemplate( 'post_classic' );
	$iron_croma_archive->compile();
}

// Template ajax
if( !empty($_POST["ajax"]) ){
	load_template( get_template_directory('archive-ajax.php'), true);
	return;
}

get_header();
?>
	<!-- container -->
	<div class="container">
		<div class="boxed">

			<?php if( $iron_croma_archive->hasTitle() ){ ?>
				<div class="page-title <?php echo (Iron_Croma::isPageTitleUppercase() == true) ? 'uppercase': ''; ?>">
					<span class="heading-t"></span>
					<?php if( $iron_croma_archive->getArchiveTitle() !== '' ):?>
					<h1><?php echo esc_html($iron_croma_archive->getArchiveTitle()); ?></h1>
					<?php Iron_Croma::displayPageTitleDivider(); ?>
					<?php endif ?>
				</div>
			<?php } ?>
			<?php
				echo wp_kses_post( $iron_croma_archive->getArchiveContent() );
				if ( $iron_croma_archive->hasSidebar() ) { ?>
					<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $iron_croma_archive->getSideBarPosition() ) echo ' content--rev'; ?>">
					<div id="content" class="content__main">
			<?php
				}

				$iron_option = ( function_exists( 'get_ironMusic_option' ) ? get_ironMusic_option( 'events_filter', '_iron_music_event_options' ) : false );
				$iron_croma_artists_filter = Iron_Croma::getField('artists_filter', $post->ID );
				if($iron_croma_archive->getPostType() == 'event' && $iron_option ) {
					$iron_artists_filter = Iron_Croma::getField('artists_filter', $post->ID);
					iron_get_events_filter($iron_artists_filter);
				}

				// post-list
				$iron_croma_archive->changeQuery();

				$iron_croma_artists_filter = ( is_array($iron_croma_artists_filter) && $iron_croma_artists_filter[0] == 'null' )? '' : $iron_croma_artists_filter ;

				echo '<'.esc_attr($iron_croma_archive->getTag()).' id="post-list" class="'.esc_attr($iron_croma_archive->getClass()).'">';
				if ( $iron_croma_archive->getPaginateMethod() != 'paginate_more' ){
					if ( have_posts() ){
						while ( have_posts() ){
							the_post();
							if ( get_post_type($post->ID) == 'event' &&  (  $iron_croma_artists_filter != '' ) ) {
								$artist_at_event =  get_post_meta( $post->ID, 'artist_at_event');
								$show_event = false ;

								if ( is_array( $artist_at_event[0] ) ) {
									foreach ( $iron_croma_artists_filter as $artists_event_filter ) {
										if ( in_array( $artists_event_filter,  $artist_at_event[0] ) ) {
											$show_event = true;
										}
									}
								}
								if ( $show_event ){
									Iron_Croma::getTemplatePart( $iron_croma_archive->getItemTemplate()  );
								}
							}else{
								Iron_Croma::getTemplatePart( $iron_croma_archive->getItemTemplate()  );
							}
						}
					}else{
						$iron_croma_archive->get404Message();
					}
				}

				echo '</'.esc_attr($iron_croma_archive->getTag()).'>';
				if( $iron_croma_archive->getPaginateMethod() == 'paginate_links' ){ ?>

					<div class="pages full clear">
						<?php Iron_Croma::displayFullPagination(); ?>
					</div>

				<?php }else{ ?>
					<div class="pages clear">
						<div class="alignleft button-next-prev"><?php previous_posts_link('&laquo; '.$iron_croma_archive->getPrev(), ''); ?></div>
						<div class="alignright button-next-prev"><?php next_posts_link($iron_croma_archive->getNext().' &raquo;',''); ?></div>
					</div>

				<?php }


				if ( $iron_croma_archive->hasSidebar() ){
					echo '</div><aside id="sidebar" class="content__side widget-area widget-area--'.esc_attr( $iron_croma_archive->getSideBarArea() ).'">';
					do_action('before_ironband_sidebar_dynamic_sidebar', 'archive.php');
					dynamic_sidebar( $iron_croma_archive->getSideBarArea() );
					do_action('after_ironband_sidebar_dynamic_sidebar', 'archive.php');
					echo '</aside></div>';
				}
			echo '</div></div>';
	get_footer();
