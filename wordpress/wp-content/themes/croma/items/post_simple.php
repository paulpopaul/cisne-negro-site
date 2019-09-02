<article id="post-<?php the_ID(); ?>" <?php post_class('media-block'); ?>>
	<a href="<?php the_permalink(); ?>" class="simple-post-img-wrap">
		<?php if(has_post_thumbnail()): ?>
			<div class="image"><?php the_post_thumbnail( 'medium' ); ?></div>
		<?php else :?>
			<div class="image empty"></div>
		<?php endif; ?>
	</a>

	<div class="simple-post-txt-wrap">
		<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
		<?php if($iron_croma_archive->enableExcerpts()): ?>
		<div class="excerpt">
			<?php
			echo wp_kses_post( substr(strip_tags(get_the_excerpt()),0,60).'...' );
			?>
		</div>
		<?php endif; ?>
	</div>
	<div class="clear"></div>
	<div class="splitter"></div>
</article>
