<?php
$iron_croma_vid_url = Iron_Croma::getField( 'video_url', $post->ID );

if(!empty($_POST)) {
	die(wp_oembed_get( esc_url( $iron_croma_vid_url ) ) );
}

get_header();


/**
 * Setup Dynamic Sidebar
 */

list( $iron_croma_has_sidebar, $iron_croma_sidebar_position, $iron_croma_sidebar_area ) = Iron_Croma::setupDynamicSidebar( $post->ID );

?>

		<!-- container -->
		<div class="container">
		<div class="boxed">

		<?php
		$iron_croma_single_title = Iron_Croma::getOption('single_video_page_title');
		if(!empty($iron_croma_single_title)):
		?>

			<div class="page-title <?php (Iron_Croma::isPageTitleUppercase() == true) ? 'uppercase' : '';?>">
			<span class="heading-t"></span>
				<h1><?php echo esc_html($iron_croma_single_title); ?></h1>
			<?php Iron_Croma::displayPageTitleDivider(); ?>
		</div>

		<?php else: ?>

			<div class="heading-space"></div>

		<?php endif; ?>

<?php
		if ( $iron_croma_has_sidebar ) :
?>
			<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $iron_croma_sidebar_position ) echo ' content--rev'; ?>">
				<div id="content" class="content__main">
<?php
		endif;

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
?>
					<!-- single-post video-post -->
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php if(!empty($iron_croma_vid_url)): ?>
						<!-- video-block -->
						<div class="video-block">
								<?php echo wp_oembed_get( esc_url( $iron_croma_vid_url ) ); ?>
						</div>
						<?php endif; ?>

						<h4><?php the_title(); ?></h4>

						<div class="entry">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'croma' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div>

<?php	get_template_part('parts/share'); ?>

<?php	comments_template(); ?>
					</div>
<?php
	endwhile;
endif;

if ( $iron_croma_has_sidebar ) :
?>
				</div>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $iron_croma_sidebar_area ); ?>">
<?php
	do_action('before_ironband_sidebar_dynamic_sidebar', 'single-video.php');

	dynamic_sidebar( $iron_croma_sidebar_area );

	do_action('after_ironband_sidebar_dynamic_sidebar', 'single-video.php');
?>
				</aside>
			</div>
<?php
endif;
?>
			</div>

		</div>
	<?php get_footer(); ?>
