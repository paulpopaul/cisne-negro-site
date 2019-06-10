<?php
global $iron_croma_link_mode, $iron_croma_archive;
if ($iron_croma_link_mode == '') {
	$iron_croma_link_mode = $iron_croma_archive->get_linkMode();
}

$iron_croma_term = Iron_Croma::getField('vid_category', $post->ID);

if ( $iron_croma_term && is_array($iron_croma_term) )
{
	$iron_croma_term = get_term($iron_croma_term[0], 'video-category');
}

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('videogrid link-mode-'. $iron_croma_link_mode ); ?> data-url="<?php echo esc_url( Iron_Croma::getField('video_url',$post->ID) ); ?>">
	<a href="<?php the_permalink(); ?>">
		<div class="holder">
			<div class="image">
				<div class="play-button">
					<i class="fas fa fa-play-circle"></i>
				</div>
				<div class="video-mask">
				<?php the_post_thumbnail('medium'); ?>
				</div>
			</div>
			<div class="text-box">
				<h2><?php the_title(); ?></h2>
				<?php if ( ! empty($iron_croma_term->name) ) { ?>
					<span class="category"><?php echo esc_html($iron_croma_term->name); ?></span>
				<?php } ?>
			</div>
		</div>
	</a>
</div>