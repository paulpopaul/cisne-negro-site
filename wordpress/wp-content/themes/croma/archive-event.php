<?php
/**
 * Template Name: Event Posts
 */

$iron_croma_archive = new Iron_Croma_Archive();
$iron_croma_archive->setPostType( 'event' );
$iron_croma_archive->compile();

get_template_part('archive'); ?>