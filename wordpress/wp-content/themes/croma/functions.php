<?php require_once(get_template_directory().'/includes/classes/iron_croma.class.php');

// Setup Theme
Iron_Croma::setup();



// -----------------------------------------------------
// CUSTOM
// -----------------------------------------------------

/**
*
*	Agrega [estilo] en Admin
*
*/
add_action('wp_enqueue_scripts', 'flickity_dependencies');

function flickity_dependencies ( ) {
	wp_register_style('flickity-css','https://unpkg.com/flickity@2/dist/flickity.min.css');
    wp_enqueue_style('flickity-css');

    wp_register_script('flickity-js','https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array('jquery'),'', true);
    wp_enqueue_script('flickity-js');
}


add_shortcode( 'noticias', 'noticias_inicio_shortcode' );
// Shortcode para Noticias en Inicio
function noticias_inicio_shortcode ( $atts ) {

	global $post;

	// Attributes
	$atts = shortcode_atts(
		array(
			'max' => 4	// default
		),
		$atts
	);

    // Render
    $ultimas_noticias = get_posts( array(
    	'posts_per_page' => $atts['max']
    ) );

?>

<div class="main-carousel" >


<?
	if ( $ultimas_noticias ) :
	    foreach ( $ultimas_noticias as $post ) :
	    	setup_postdata( $post );

	    	/*
	    	
	    		Para título: the_title()
	    		Para contenido: the_content()
	    		Para imágen destacada: the_post_thumbnail()

	    	 */

?>
   
    <div class="carousel-cell">
        <div class="news-grid-wrap iso4 isotope-item">
            <a href="<? the_permalink() ?>">
            	<? the_post_thumbnail( 'medium' ) ?>

                <div class="news-grid-tab">
                    <div class="tab-text">
                        <div class="tab-title" style="color:white"> <? the_title() ?> </div>
                        <br>
                        <time class="datetime"> <?= get_the_date( 'd F, Y' ) ?> </time>

                    </div>
                </div> <!-- news-grid-tab -->
            </a>

            <div class="clear"></div>
        </div> <!-- isotope-item -->
    </div>  <!-- carousel-cell -->

<?

	    endforeach;

	else:
		echo 'No hay noticias.';

	endif;

?>

</div> <!-- main-carousel -->

<script type="text/javascript">
	jQuery(document).on('ready', function() {
		jQuery('.main-carousel').flickity({

			cellAlign: 'center',
			contain: true,
			autoPlay: 3500,
		});
	});
</script>

<?

    wp_reset_postdata();

}

?>