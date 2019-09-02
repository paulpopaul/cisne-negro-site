<?php

get_header();
$artist_meta = get_post_meta($post->ID);
the_post();

$artist_featured_album = ( get_field('artist_hero_playlist') == 'null' )? false : get_field('artist_hero_playlist') ;
$artist_desc = get_field('artist_desc');
$artist_social = get_field('artist_social');
$artist_link = get_field('artist_link');
$artist_contact = get_field('artist_contact');
$artist_download = get_field('artist_download');

?>
<div class="artist-header">

<?php

$banner_background_type = get_field('banner_background_type', $post->ID);
$banner_typeCSS = ($banner_background_type)? '' : 'no-banner' ;
if ($banner_background_type) {

	get_template_part('parts/page-banner');

}

?>

</div>

<!-- container -->
<div class="container">
	<div class="boxed">
		<article id="<?php echo esc_attr( 'post-' . $post->ID ) ?>" <?php post_class( $banner_typeCSS ); ?>>
		<div class="entry">
			<?php if($artist_featured_album):?>
			<div class="artist_player" data-url-playlist="<?php echo esc_url(home_url('?load=playlist.json&amp;albums='.$artist_featured_album.''))?>" >

			    <div class="playerNowPlaying">
			        <div class="album-art">
			            <img src=""/>
			        </div>
			        <div class="metadata">
			            <div class="track-name"></div>
			            <div class="album-title"></div>
			        </div>
			    </div>
			    <div class="player">
			    <div class="progressLoading"></div>
			    <div id="artistPlayer" class="wave"></div>

			    <div class="control">
			            <div class="previous">
			                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 10.2 11.7" style="enable-background:new 0 0 10.2 11.7;" xml:space="preserve">
								<polygon points="10.2,0 1.4,5.3 1.4,0 0,0 0,11.7 1.4,11.7 1.4,6.2 10.2,11.7"></polygon>
							</svg>
			            </div>
			            <div class="play">
			                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 17.5 21.2" style="enable-background:new 0 0 17.5 21.2;" xml:space="preserve">
								<path d="M0,0l17.5,10.9L0,21.2V0z"></path>

								<rect width="6" height="21.2"></rect>
								<rect x="11.5" width="6" height="21.2"></rect>
							</svg>
			            </div>
			            <div class="next">
			                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 10.2 11.7" style="enable-background:new 0 0 10.2 11.7;" xml:space="preserve">
								<polygon points="0,11.7 8.8,6.4 8.8,11.7 10.2,11.7 10.2,0 8.8,0 8.8,5.6 0,0"></polygon>
							</svg>
			            </div>
			        </div>
			    </div>
			    <div class="playlist"></div>
			</div>
			<?php endif ?>

			<div class="artist_sidebar  padding vc_col-sm-4">
				<?php if( $artist_desc ):?>
					<div class="artist_desc meta">
						<h1><?php the_title()?></h1>
						<?php echo wp_kses_post( apply_filters( 'the_content', $artist_desc ) )?>
					</div>
				<?php endif ?>
				<?php if( $artist_social ):?>
					<div class="artist_social meta">
						<h4><?php esc_html_e('Follow', 'croma')?></h4>
						<?php for ($i = 0; $i < $artist_social; $i++) : ?>
							<div class="social_icon">

								<a href="<?php echo esc_url( $artist_meta['artist_social_'.$i.'_artist_social_link'][0] ) ?>" target="_blank">
									<i class="fa fa-2x <?php echo esc_attr($artist_meta['artist_social_'.$i.'_artist_social_icon'][0] )?>"></i>
									<?php echo wp_kses_post( $artist_meta['artist_social_'.$i.'_artist_social_label'][0] )?>
								</a>
							</div>
						<?php endfor ?>

					</div>
				<?php endif ?>

				<?php if( $artist_link ):?>
					<div class="artist_link meta">
						<h4><?php esc_html_e('Website', 'croma')?></h4>
						<?php for ($i = 0; $i < $artist_link; $i++) : ?>

							<a href="<?php echo esc_url( $artist_meta['artist_link_'.$i.'_artist_link_link'][0] ) ?>" target="_blank">
								<?php echo wp_kses_post( $artist_meta['artist_link_'.$i.'_artist_link_label'][0] )?>
							</a></br>

						<?php endfor ?>

					</div>
				<?php endif ?>

				<?php if( $artist_contact ):?>
					<div class="artist_contact meta">
						<h4><?php esc_html_e('CONTACT & BOOKING','croma')?></h4>
						<?php echo wp_kses_post( apply_filters( 'the_content', $artist_contact ) )?>
					</div>
				<?php endif ?>

				<?php if( $artist_download ):?>
					<div class="artist_download meta">
						<h4><?php esc_html_e('Downloads','croma')?></h4>
						<?php for ($i = 0; $i < $artist_download; $i++) : ?>

							<a href="<?php echo esc_url(wp_get_attachment_url($artist_meta['artist_download_'.$i.'_artist_download_link'][0]) ) ?>" target="_blank">
								<?php echo wp_kses_post( $artist_meta['artist_download_'.$i.'_artist_download_label'][0] )?>
							</a></br>

						<?php endfor ?>

					</div>
				<?php endif ?>

			</div>
			<div class="artist_content padding vc_col-sm-8">
				<?php the_content(); ?>
			</div>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'croma' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		</div>
		</article>
	</div>
</div>

<?php get_footer(); ?>