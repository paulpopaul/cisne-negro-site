<?php
global $iron_croma_link_mode, $iron_croma_archive;
if ($iron_croma_link_mode == '') {
	$iron_croma_link_mode = $iron_croma_archive->get_linkMode();
}
$iron_croma_term = get_field( 'vid_category', $post->ID );

if ( $iron_croma_term && is_array($iron_croma_term) )
{
	$iron_croma_term = get_term($iron_croma_term[0], 'video-category');
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('media-block link-mode-' . $iron_croma_link_mode ); ?> data-url="<?php echo esc_url(get_field('video_url',$post->ID)); ?>">
	<a href="<?php the_permalink(); ?>">
		<div class="holder">
			<div class="image rel">
				<div class="play-button"><i class="fa fa-play-circle"></i></div>
				<?php the_post_thumbnail('medium'); ?>
			</div>
			<div class="text-box">
				<h2><?php the_title(); ?></h2>
			</div>
		</div>
	</a>
</article>