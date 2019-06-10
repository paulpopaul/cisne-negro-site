<?php global $iron_croma_archive; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('media-block'); ?>>
	<a href="<?php the_permalink(); ?>">
		<div class="holder">
			<?php if(has_post_thumbnail()): ?>
				<div class="image"><?php the_post_thumbnail( 'medium' ); ?></div>
			<?php else :?>
				<div class="image empty"></div>
			<?php endif; ?>
			<div class="text-box<?php if(!has_post_thumbnail()){ echo " empty"; }?>">

				<?php if((bool)Iron_Croma::getOption('show_post_date', null, true)){ ?>
					<time class="datetime" datetime="<?php the_time('c'); ?>"><?php the_time( get_option('date_format') ); ?></time>
				<?php } ?>

				<h2><?php the_title(); ?></h2>
				<?php if($iron_croma_archive->enableExcerpts() || is_archive()): ?>
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>

				<div class="meta-simple">

				<?php if ((bool)Iron_Croma::getOption('show_post_author', null, true)  &&  get_the_author() != '' ): ?>
					<div class="meta-author-link"><?php echo esc_html__('by', 'croma'); ?> <?php the_author(); ?></div>
				<?php endif ?>
				<?php
					$iron_croma_categories_list = get_the_category( get_the_ID() );
					if(!empty($iron_croma_categories_list) && (bool)Iron_Croma::getOption('show_post_categories', null, true)){
						echo '<div class="post-categories"><i class="fa fa-folder-open-o"></i> ';
						foreach ($iron_croma_categories_list as $key => $value) {
							echo wp_kses_post ( (  $key + 1 == count( $iron_croma_categories_list ) )? $value->name  : $value->name . ', ' ) ;
						}
						echo '</div> ';
					}

					$iron_croma_tag_list = get_the_tags( get_the_ID() );
					if( $iron_croma_tag_list && (bool)Iron_Croma::getOption('show_post_tags', null, true) ){
						echo '<div class="post-tags"><i class="fa fa-tag"></i> ';
						foreach ($iron_croma_tag_list as $key => $value) {
							echo wp_kses_post( (  $key + 1 == count( $iron_croma_tag_list ) )? $value->name  : $value->name . ', ' ) ;
						}
						echo '</div> ';
					}
				?>
				</div>

				<div class="stickypost">
					<i class="fa fa-star"></i>
				</div>
			</div>
		</div>
	</a>
</article>
