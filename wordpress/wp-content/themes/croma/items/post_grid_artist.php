<div class="news-grid-wrap">

	<a href="<?php echo esc_url( get_permalink() )?>" class="<?php (is_sticky()) ? 'sticky' : ''; ?>">
		<?php if(has_post_thumbnail()): ?>
			<?php the_post_thumbnail('medium'); ?>
		<?php endif; ?>
		<div class="news-grid-tab">
			<div class="tab-text">
			<h2 class="tab-title"><?php the_title(); ?></h2>
				<div class="stickypost">
					<i class="fa fa-star"></i>
				</div>
			</div>
		</div>
	</a>
	<div class="clear"></div>
</div>