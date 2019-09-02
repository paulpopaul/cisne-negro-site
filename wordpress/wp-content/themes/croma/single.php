<?php get_header(); ?>
		<!-- container -->
		<div class="container">
		<div class="boxed">

			<!-- single-post -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page-title <?php (Iron_Croma::isPageTitleUppercase() == true) ? 'uppercase' : '';?>">
					<span class="heading-t"></span>
					<?php the_title('<h1>','</h1>'); ?>
					<?php Iron_Croma::displayPageTitleDivider(); ?>
				</div>
				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'croma' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>
			</article>
		</div>
		</div>
<?php get_footer(); ?>