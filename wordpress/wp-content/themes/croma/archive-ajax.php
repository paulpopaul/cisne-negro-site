<?php
	if ( have_posts() ):
		while ( have_posts() ) : the_post();
			Iron_Croma::getTemplatePart( $iron_croma_archive->getItemTemplate() );
		endwhile;
	else:
		echo '<div class="search-result"><h3>'. esc_html__('Nothing Found!', 'croma') .'</h3>';
		echo '<p>'. esc_html__('Search keyword', 'croma') .': '. get_search_query() .'</p>';
		echo '<p>'. esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'croma') .'</p></div>';
	endif;

	echo esc_url( str_replace('<a ', '<a data-rel="post-list" '.implode(' ', $attr).' class="button-more" ', get_next_posts_link( esc_html__('More', 'croma') ) ) );
?>



