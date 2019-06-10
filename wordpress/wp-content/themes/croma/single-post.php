<?php

get_header();

global $post;


$iron_croma_single_post_featured_image = Iron_Croma::getField('single_post_featured_image', $post->ID);
$iron_croma_show_post_date = (bool)Iron_Croma::getOption('show_post_date', null, true);
$iron_croma_show_post_author = (bool)Iron_Croma::getOption('show_post_author', null, true);
$iron_croma_show_post_categories = (bool)Iron_Croma::getOption('show_post_categories', null, true);
$iron_croma_show_post_tags = (bool)Iron_Croma::getOption('show_post_tags', null, true);


/**
 * Setup Dynamic Sidebar
 */

list( $iron_croma_has_sidebar, $iron_croma_sidebar_position, $iron_croma_sidebar_area ) = Iron_Croma::setupDynamicSidebar( $post->ID ); ?>

		<!-- container -->
		<div class="container">
		<div class="boxed">

<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$iron_croma_single_title = Iron_Croma::getOption('single_post_page_title');
		if(!empty($iron_croma_single_title)): ?>
			<div class="page-title <?php (Iron_Croma::isPageTitleUppercase() == true) ? 'uppercase' : '';?>">
				<span class="heading-t"></span>
				<h1><?php echo esc_html($iron_croma_single_title); ?></h1>
				<?php Iron_Croma::displayPageTitleDivider(); ?>
			</div>
		<?php else: ?>
			<div class="heading-space"></div>
		<?php endif;

		if ( $iron_croma_has_sidebar ) : ?>
			<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $iron_croma_sidebar_position ) echo ' content--rev'; ?>">
				<div id="content" class="content__main">
		<?php endif; ?>

		<!-- single-post -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php

			the_title('<h2>','</h2>');
			if($iron_croma_single_post_featured_image == 'fullwidth') {
				the_post_thumbnail( 'large' , array( 'class' => 'wp-featured-image fullwidth' ) );
			}else if($iron_croma_single_post_featured_image == 'original') {
				the_post_thumbnail( 'large' , array( 'class' => 'wp-featured-image original' ) );
			}?>

			<!-- meta -->
			<div class="meta">
				<?php if( $iron_croma_show_post_date ): ?>
					<a href="<?php the_permalink() ?>"><time class="datetime" datetime="<?php the_time('c'); ?>"><?php the_time( get_option('date_format') ); ?></time></a>
				<?php endif; ?>

				<?php if ( $iron_croma_show_post_author ): ?>
						<?php echo esc_html__('by', 'croma'); ?> <a class="meta-author-link" href="<?php echo esc_url( get_author_posts_url(get_the_author_meta('ID'))) ?>"><?php the_author(); ?></a>
				<?php endif;

				$iron_croma_categories_list = get_the_category_list( ', ',get_the_ID() );
				if(!empty($iron_croma_categories_list) && $iron_croma_show_post_categories)
					echo wp_kses_post('<span class="post-categories"><i class="fa fa-folder-open-o"></i> '.$iron_croma_categories_list.'</span>');

				$iron_croma_tag_list = get_the_tag_list('',', ');
				if(!empty($iron_croma_tag_list) && $iron_croma_show_post_tags)
					echo wp_kses_post('<span class="post-tags"><i class="fa fa-tag"></i> '.$iron_croma_tag_list.'</span>');
				?>
			</div>


			<div class="entry">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'croma' ), 'after' => '</span></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div>
		</article>

		<?php

		get_template_part('parts/share');
		comments_template();

		if ( $iron_croma_has_sidebar ) : ?>
		</div>
			<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $iron_croma_sidebar_area ); ?>">
			<?php
				do_action('before_ironband_sidebar_dynamic_sidebar', 'single-post.php');

				dynamic_sidebar( $iron_croma_sidebar_area );

				do_action('after_ironband_sidebar_dynamic_sidebar', 'single-post.php');
			?>
			</aside>
			</div>
<?php 	endif;

	endwhile;
endif;
?>

		</div>
		</div>
<?php get_footer(); ?>