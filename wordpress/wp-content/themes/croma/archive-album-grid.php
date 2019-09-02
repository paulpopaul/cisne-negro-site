<?php
/**
 * Template Name: Albums Posts
 */
$iron_croma_archive = new Iron_Croma_Archive();
$iron_croma_archive->setPostType( 'album' );
$iron_croma_archive->setItemTemplate( 'album_grid' );
$iron_croma_archive->compile();

get_template_part('archive'); ?>