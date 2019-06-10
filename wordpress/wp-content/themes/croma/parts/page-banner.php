<?php

$iron_croma_banner_bg_style = '';
$iron_croma_banner_classes = array();
$iron_croma_banner_parallax = get_field('banner_parallax', $post->ID);
$iron_croma_banner_fullscreen = Iron_Croma::getField('banner_fullscreen', $post->ID );
$iron_croma_banner_content_type = get_field('banner_content_type', $post->ID);
$iron_croma_banner_texteditor_content = get_field('banner_texteditor_content', $post->ID, false);
$iron_croma_banner_title = get_field('banner_title', $post->ID);
$iron_croma_banner_subtitle = get_field('banner_subtitle', $post->ID);
$iron_croma_banner_horizontal_content_alignment = get_field('banner_horizontal_content_alignment', $post->ID);
$iron_croma_banner_vertical_content_alignment = get_field('banner_vertical_content_alignment', $post->ID);

if( $iron_croma_banner_fullscreen ) array_push($iron_croma_banner_classes, 'fullscreen-banner');
if( $iron_croma_banner_parallax ) array_push( $iron_croma_banner_classes, 'parallax-banner' );
?>


<div id="page-banner" class="<?php echo esc_attr( implode( ' ',$iron_croma_banner_classes ) ); ?>">
	<div class="page-banner-bg"></div>
	<div class="page-banner-content">
		<div class="inner <?php echo esc_attr( $iron_croma_banner_vertical_content_alignment ) ?>">
			<div class="page-banner-row">
			<?php if($iron_croma_banner_content_type === 'advanced-content') : ?>
				<?php
					echo wp_kses_post( apply_filters( 'the_content', $iron_croma_banner_texteditor_content ) );
				?>
			<?php else : ?>
				<h1 class="page-title <?php echo esc_attr( $iron_croma_banner_horizontal_content_alignment ) ?>">
					<?php echo wp_kses_post( $iron_croma_banner_title) ?>
				</h1>
				<span class="page-subtitle <?php echo esc_attr( $iron_croma_banner_horizontal_content_alignment ) ?>">
					<?php echo wp_kses_post( $iron_croma_banner_subtitle ) ?>
				</span>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>