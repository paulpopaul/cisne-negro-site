<?php
	$iron_croma_page_id = Iron_Croma::getOption('404_page_selection');

	get_header();
?>
	<!-- container -->
	<div class="container">
		<div class="content__wrapper <?php echo ( $iron_croma_page_id ) ? '': 'boxed' ?>">
			<!-- single-post -->
			<article class="single-post">
				<div class="entry">
					<div class="<?php echo ( Iron_Croma::isPageTitleUppercase() ) ? 'uppercase' : '' ?>">
						<span class="heading-t"></span>
						<h1><?php Iron_Croma::displayPageTitle( $iron_croma_page_id, esc_html__('Page not found', 'croma') ); ?></h1>
						<?php Iron_Croma::displayPageTitleDivider(); ?>
					</div>
					<?php if( $iron_croma_page_id ){
						echo wp_kses_post( apply_filters( 'the_content', get_post_field( 'post_content', $iron_croma_page_id) ) );
					}else{ // Default content ?>
						<p style="text-align: center;">
							<?php echo esc_html__('Are you lost? The content you were looking for is not here.','croma'); ?>
						</p>
						<p style="text-align: center;">
							<a href="<?php echo esc_url( get_home_url( null, '/' ) )?>">
								<?php echo esc_html__('Return to home page', 'croma') ?>
							</a>
						</p>
					<?php } ?>
				</div>
			</article>
		</div>
	</div>

	<?php get_footer(); ?>