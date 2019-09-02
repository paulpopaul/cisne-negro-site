<?php
/**
 * --- Template Name --- : Portfolio Grid
 */
$iron_croma_archive = new Iron_Croma_Archive();
$iron_croma_archive->setPostType( 'portfolio' );
$iron_croma_archive->setItemTemplate( 'post_portfolio' );
$iron_croma_archive->setIsoCol( 'iso3' );
$iron_croma_archive->compile();

get_template_part('archive'); ?>