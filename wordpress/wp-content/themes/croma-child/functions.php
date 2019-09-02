<?php
function croma_child_enqueue_styles() {

   wp_enqueue_style( 'iron-master', get_template_directory_uri() . '/style.css' );
   wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'iron-master' ), '', 'all' );
}
add_action( 'wp_enqueue_scripts', 'croma_child_enqueue_styles' );

