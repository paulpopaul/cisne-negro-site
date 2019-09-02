<?php get_header();

global $post;

/**
 * Setup Dynamic Sidebar
 */

list( $iron_croma_has_sidebar, $iron_croma_sidebar_position, $iron_croma_sidebar_area ) = Iron_Croma::setupDynamicSidebar( $post->ID );

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<!-- container -->
		<div class="container">
		<?php
		$iron_croma_boxed = false;
		if(strpos( get_the_content($post->ID) ,'vc_row') == false){
			$iron_croma_boxed = true;
		}

		if($iron_croma_has_sidebar || $iron_croma_boxed){ ?>
			<div class="boxed">
		<?php }
			$iron_croma_hide_page_title = Iron_Croma::getField('hide_page_title', $post->ID);
			if( empty( $iron_croma_hide_page_title ) ) { ?>
				<div class="page-title <?php echo (Iron_Croma::isPageTitleUppercase() == true) ? 'uppercase' : ''; ?>">
					<span class="heading-t"></span>
					<?php the_title('<h1>','</h1>');
					Iron_Croma::displayPageTitleDivider(); ?>
				</div>
			<?php }
			if ( $iron_croma_has_sidebar ) : ?>
				<div class="content__wrapper<?php if ( 'left' === $iron_croma_sidebar_position ) echo ' content--rev'; ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class('content__main single-post'); ?>>
			<?php else: ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
			<?php endif; ?>
			<?php the_post_thumbnail( 'full', array( 'class' => 'wp-featured-image' ) ); ?>
			<div class="entry">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'croma' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div>

			<?php comments_template();

			if ( $iron_croma_has_sidebar ) : ?>
				</article>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $iron_croma_sidebar_area ); ?>">
			<?php
				do_action('before_ironband_sidebar_dynamic_sidebar', 'page.php');

				dynamic_sidebar( $iron_croma_sidebar_area );

				do_action('after_ironband_sidebar_dynamic_sidebar', 'page.php');
?>
				</aside>
			</div>
<?php
		else:
?>
			</article>
<?php
		endif;
?>
	<?php
		if($iron_croma_has_sidebar || $iron_croma_boxed){
			?>
			</div>
			<?php
		}
		?>
		</div>

<?php
	endwhile;
endif;
get_footer();