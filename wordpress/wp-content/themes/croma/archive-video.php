<?php
/**
 * Template Name: Video Posts (List)
 */

global $iron_croma_archive;
$iron_croma_archive = new Iron_Croma_Archive();
$iron_croma_archive->setPostType( 'video' );
$iron_croma_archive->setItemTemplate( 'video_list' );
$iron_croma_archive->compile();

get_template_part('archive'); ?>