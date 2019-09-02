<?php get_header(); ?>
<?php if ( have_posts() ) : the_post() ?>




			<div class="album-header">
				<div class="backCover"></div>
				<div class="albumCover">
					<?php $iron_croma_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
					<img src="<?php echo esc_url($iron_croma_image[0]) ?>">
				</div>
			</div>



		<!-- container -->
		<div class="container">


		<div class="boxed">



	<?php list( $iron_croma_has_sidebar, $iron_croma_sidebar_position, $iron_croma_sidebar_area ) = Iron_Croma::setupDynamicSidebar( $post->ID );
	if ( $iron_croma_has_sidebar ) : ?>
		<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $iron_croma_sidebar_position ) echo esc_attr(' content--rev'); ?>">
			<div id="content" class="content__main">
	<?php endif; ?>


	<!-- info-section -->
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'featured ' ); ?>>
	<?php the_title('<h2>','</h2>');?>

	<?php if( function_exists('get_artists') ): ?>
		<?php if( get_artists($post->ID) ): ?>
			<h3 class="meta-artist_of_album"><span><?php esc_html_e( 'by', 'croma' ) ?></span> <?php echo get_artists($post->ID) ?></h3>
		<?php endif ?>
	<?php endif ?>

	<?php Iron_Croma::displayPageTitleDivider(); ?>
	<?php
	$iron_croma_atts = array(
		'albums' => array($post->ID),
		'show_playlist' => true
	);

	the_widget('Iron_Widget_Radio', $iron_croma_atts, array( 'before_widget'=>'<article class="iron_widget_radio">', 'after_widget'=>'</article>', 'widget_id'=>'single_album'));
	?>
</div>

<?php
if ( Iron_Croma::getField('alb_store_list', $post->ID) ) : ?>
	<div class="buttons-block">
		<div class="ctnButton-block">
		<div class="available-now"><?php echo esc_html__("Available now on", 'croma'); ?>:</div>
		<ul class="store-list">
			<?php while(has_sub_field('alb_store_list')): ?>
			<li><a class="button" href="<?php echo esc_url( get_sub_field('store_link') ); ?>" target="_blank"><?php the_sub_field('store_name'); ?></a></li>
			<?php endwhile; ?>
		</ul>
		</div>
	</div>
<?php endif; ?>




<?php		if ( Iron_Croma::getField('alb_review', $post->ID) ) : ?>
			<!-- content-box -->
			<section class="content-box">
			<h4><?php esc_html_e('Album Review', 'croma'); ?></h4>
			<?php Iron_Croma::displayPageTitleDivider(); ?>
<?php		if ( Iron_Croma::getField('alb_review', $post->ID ) || Iron_Croma::getField('alb_review_author', $post->ID ) ) : ?>
			<!-- blockquote-box -->
				<figure class="blockquote-block">
<?php			if ( Iron_Croma::getField('alb_review', $post->ID ) ) : ?>
					<blockquote><?php echo wp_kses_post( Iron_Croma::getField('alb_review', $post->ID) ) ?></blockquote>
<?php
				endif;

				if ( Iron_Croma::getField('alb_review_author', $post->ID ) ) : ?>
					<figcaption>- <?php echo wp_kses_post( Iron_Croma::getField('alb_review_author', $post->ID ) ) ?></figcaption>
<?php 			endif; ?>
				</figure>
<?php		endif; ?>
			</section>
<?php	endif; ?>



<?php	if ( get_the_content() ) : ?>
			<!-- content-box -->
			<section class="content-box">
				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'croma' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>
			</section>
<?php	endif; ?>



<?php	get_template_part('parts/share'); ?>

<?php	comments_template(); ?>

<?php
		if ( $iron_croma_has_sidebar ) :
?>
				</div>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $iron_croma_sidebar_area ); ?>">
<?php
	do_action('before_ironband_sidebar_dynamic_sidebar', 'single-album.php');

	dynamic_sidebar( $iron_croma_sidebar_area );

	do_action('after_ironband_sidebar_dynamic_sidebar', 'single-album.php');
?>
				</aside>
			</div>
<?php
		endif;
?>

<?php endif; ?>

		</div>
		</div>

<?php get_footer(); ?>