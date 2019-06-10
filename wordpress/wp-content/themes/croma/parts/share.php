<!-- links-block -->

<?php

$thumb_id = get_post_thumbnail_id( get_the_ID() );
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium');
$thumb_url = $thumb_url_array[0];

?>
<aside class="links-block">
	<a href="#" onclick="window.history.back(); return false;" class="back-btn"><?php echo esc_html__("Back", 'croma'); ?></a>
	<div class="buttons">
		<div class="sharing_toolbox" data-image-social="<?php echo esc_url( $thumb_url ) ?>"></div>
	</div>
</aside>
