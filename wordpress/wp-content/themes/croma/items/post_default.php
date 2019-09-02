<?php global $iron_croma_archive; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('simple'); ?>>
	<a href="<?php the_permalink(); ?>">
		<div class="holder">
			<?php if(has_post_thumbnail()): ?>
				<div class="image"><?php the_post_thumbnail( 'medium' ); ?></div>
			<?php else : ?>
				<div class="image empty"></div>
			<?php endif; ?>

			<div class="text-box<?php if(!has_post_thumbnail()){ echo " empty"; }?>">

				<h2><?php the_title(); ?></h2>
				<div class="classic-meta">
					<?php if($iron_croma_archive->displayDate()): ?>
							<time class="datetime" datetime="<?php the_time('c'); ?>"><?php the_time( get_option('date_format') ); ?> </time>
					<?php endif; ?>

					<?php if ((bool)Iron_Croma::getOption('show_post_author', null, true)  &&  get_the_author() != '' ): ?>
						<a class="meta-author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) ?>"><?php echo esc_html__('by', 'croma'); ?> <?php the_author(); ?></a>
					<?php endif ?>
					<?php
						$iron_croma_categories_list = get_the_category_list( ', ',get_the_ID() );
						if(!empty($iron_croma_categories_list) && (bool)Iron_Croma::getOption('show_post_categories', null, true))
						echo wp_kses_post( '<div class="post-categories"><i class="fa fa-folder-open-o"></i> '.$iron_croma_categories_list.' </div> ' );

						$iron_croma_tag_list = get_the_tag_list('',', ');
						if( !empty($tag_list) && (bool)Iron_Croma::getOption('show_post_tags', null, true) )
						echo wp_kses_post( '<div class="post-tags"> <i class="fa fa-tag"></i> '.$iron_croma_tag_list.'</div>' );

					?>
				</div>
				<?php if($iron_croma_archive->enableExcerpts() || is_archive()): ?>
				<div class="excerpt">
					<?php the_content(esc_html__('Read More', 'croma')); ?>
				</div>
				<?php endif; ?>

				<div class="stickypost">
					<i class="fa fa-star"></i>
				</div>
			</div>
		</div>
	</a>
</article>
