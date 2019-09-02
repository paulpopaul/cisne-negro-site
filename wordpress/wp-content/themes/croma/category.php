<?php
$iron_croma_archive = new Iron_Croma_Archive();
$iron_croma_archive->setPostType( 'post' );
$iron_croma_archive->setItemTemplate( 'post_classic' );
$iron_croma_archive->compile();

get_template_part('archive'); ?>