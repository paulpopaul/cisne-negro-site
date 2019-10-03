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

?>

<div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>


<?
    foreach ( $ultimas_noticias as $post ) {
    	setup_postdata( $post );

    	/*
    	
    		Para título: the_title()
    		Para contenido: the_content()
    		Para imágen destacada: the_post_thumbnail()

    	 */


    ?>


		<!-- EL CÓDIGO HTML -->
   
    <div class="carousel-cell">
        <div class="news-grid-wrap iso4 isotope-item">
            <a href="<? the_permalink() ?>" class=""> <? the_post_thumbnail( 'medium') ?>
                <div class="news-grid-tab">

                    <div class="tab-text">
                        <div class="tab-title" style="color:white;"> <? the_title() ?></div>
                        <br>
                        <time class="datetime"> <?= get_the_date('d F, Y') ?> </time>

                    </div>

                </div>
            </a>
            <div class="clear"></div>
        </div>
    </div>



    <?
    }


    ?>
</div>
<?
    wp_reset_postdata();

}