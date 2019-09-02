<?php
/**
 * Template Name: Blog Posts (Grid 3-Columns)
 */
$iron_croma_archive = new Iron_Croma_Archive();
$iron_croma_archive->setPostType( 'post' );
$iron_croma_archive->setItemTemplate( 'post_isotope' );
$iron_croma_archive->setIsoCol( 'iso3' );
$iron_croma_archive->compile();

get_template_part('archive'); ?>