<?php
	$iron_croma_fixed_header = Iron_Croma::getOption('enable_fixed_header', null, '1');
	$iron_croma_menu_type = Iron_Croma::getOption('menu_type', null, 'push-menu');
	$iron_croma_menu_position = Iron_Croma::getOption('classic_menu_position', null, 'absolute absolute_before');

	$iron_croma_logo1x = Iron_Croma::getOption('footer_bottom_logo', null, get_template_directory_uri().'/images/logo-irontemplates-footer.png');
	$iron_croma_logo2x = Iron_Croma::getOption('footer_bottom_logo_retina', null, get_template_directory_uri().'/images/logo-retina-irontemplates-footer.png');

 
?>
	</div>



	<!-- footer -->
	<footer id="footer">
		<?php $iron_croma_footer_area = Iron_Croma::getOption('footer-area_id', null, 'croma_sidebar_2');
		if ( is_active_sidebar( $iron_croma_footer_area ) ) :
			$iron_croma_widget_area = Iron_Croma::getOption('widget_areas', $iron_croma_footer_area, array(
				'sidebar_name' => esc_html_x('Default Footer', 'Theme Options', 'croma'),
				'sidebar_desc' => esc_html_x('Site footer widget area.', 'Theme Options', 'croma'),
				'sidebar_grid' => 1,
				'order_no'     => 3
			)); ?>
			<div class="footer__widgets widget-area widget-area--<?php echo esc_attr( $iron_croma_footer_area ); if ( array_key_exists('sidebar_grid', $iron_croma_widget_area) && $iron_croma_widget_area['sidebar_grid'] > 1 ) echo ' grid-cols grid-cols--' . esc_attr($iron_croma_widget_area['sidebar_grid']); ?>">
				<?php
					do_action('before_ironband_footer_dynamic_sidebar');

					dynamic_sidebar( $iron_croma_footer_area );

					do_action('after_ironband_footer_dynamic_sidebar');
				?>
			</div>
		<?php endif;

		if( (bool)Iron_Croma::getOption('footer_social_media_enabled', null, '1') ): ?>
			<div class="footer-block share">
				<!-- links-box -->
				<div class="links-box">
					<?php get_template_part('parts/networks'); ?>
				</div>
			</div>
		<?php endif; ?>

		<!-- footer-row -->
		<div class="footer-row">
			<div class="footer-wrapper">
				<?php if ( Iron_Croma::getOption('footer_bottom_logo', null, get_template_directory_uri().'/images/logo-irontemplates-footer.png') ){
					echo '<a class="footer-logo-wrap" target="_blank" href="' . esc_url( Iron_Croma::getOption('footer_bottom_link', null, 'http://irontemplates.com/') ) .' ">'; ?>
					<img src="<?php echo esc_url( $iron_croma_logo1x ); ?>" <?php echo 'srcset="' . $iron_croma_logo1x . ' 1x, ' . $iron_croma_logo2x . ' 2x"'?> alt=""></a>
				<?php } ?>
				<div>
					<div class="text footer-copyright"><?php echo wp_kses_post( apply_filters('the_content', Iron_Croma::getOption('footer_copyright', null, 'Copyright &copy; '.date('Y') . ' Iron Templates<br>All rights reserved') ) ) ?></div>
					<div class="text footer-author"><?php echo wp_kses_post( apply_filters('the_content', Iron_Croma::getOption('footer_credits', null, 'Template crafted by <b>IronTemplate</b>') ) ); ?></div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</footer>
 </div>
<?php

		if(($iron_croma_menu_type == 'push-menu' && empty($iron_croma_fixed_header)) || ($iron_croma_menu_type == 'classic-menu' && ($iron_croma_menu_position == 'fixed' || $iron_croma_menu_position == 'fixed_before'))) : ?>
		</div>
	<?php endif;

	if(($iron_croma_menu_type == 'push-menu' && !empty($iron_croma_fixed_header)) || ($iron_croma_menu_type == 'classic-menu' && ($iron_croma_menu_position != 'fixed' || $iron_croma_menu_position == 'fixed_before'))) : ?>
		</div>
	<?php endif;?>
	</div>
 <?php wp_footer(); ?>
 <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</body>
</html>