<?php require_once(get_template_directory().'/includes/classes/iron_croma.class.php');

// Setup Theme
Iron_Croma::setup();



// -----------------------------------------------------
// CUSTOM
// -----------------------------------------------------

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

    foreach ( $ultimas_noticias as $post ) {
    	setup_postdata( $post );

    	/*
    	
    		Para título: the_title()
    		Para contenido: the_content()
    		Para imágen destacada: the_post_thumbnail()

    	 */

    ?>

		<!-- EL CÓDIGO HTML -->

    <?
    }

    wp_reset_postdata();

}