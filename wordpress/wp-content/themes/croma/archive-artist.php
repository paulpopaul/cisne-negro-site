<?php get_header() ?>
	<!-- container -->
	<div class="container">
		<div class="boxed">

		    <div class="page-title <?php echo (Iron_Croma::isPageTitleUppercase() == true) ? 'uppercase': ''; ?>">
				<span class="heading-t"></span>

				<h1><?php echo post_type_archive_title() ?></h1>
				<?php Iron_Croma::displayPageTitleDivider(); ?>

			</div>


			<?php
			echo '<div id="post-list" class="two_column_album">';

					if ( have_posts() ){
						while ( have_posts() ){
							the_post();
							get_template_part('items/post_grid_artist');
						}
					}else{
				// 		$iron_croma_archive->get404Message();
					}

            ?>
	    </div>
    </div>
<?php get_footer() ?>