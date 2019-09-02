<?php get_header();


add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
/**
 * woo_hide_page_title
 *
 * Removes the "shop" title on the main shop page
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function woo_hide_page_title() {
	return false;
}


if( function_exists('is_shop') && is_shop() ){
	$post_id = wc_get_page_id('shop');
}else{
	$post_id = $post->ID;
}
/**
 * Setup Dynamic Sidebar
 */

list( $iron_croma_has_sidebar, $iron_croma_sidebar_position, $iron_croma_sidebar_area ) = Iron_Croma::setupDynamicSidebar( $post_id );
?>

<!-- container -->
<div class="container">
<?php
$iron_croma_boxed = false;
if(strpos( get_the_content($post_id) ,'vc_row') == false){
	$iron_croma_boxed = true;
}

if($iron_croma_has_sidebar || $iron_croma_boxed){ ?>
	<div class="boxed">
<?php }
	$iron_croma_hide_page_title = Iron_Croma::getField('hide_page_title', $post_id);
	if( empty( $iron_croma_hide_page_title ) ) { ?>
		<div class="page-title <?php echo (Iron_Croma::isPageTitleUppercase() == true) ? 'uppercase' : ''; ?>">
			<span class="heading-t"></span>
			
			<?php if(is_product_category()){ ?>
			<h1><?php woocommerce_page_title(); ?></h1>
			<?php } else{
			echo '<h1>' . get_the_title($post_id) . '</h1>';
			}
			Iron_Croma::displayPageTitleDivider(); ?>
		</div>
	<?php }
	if ( $iron_croma_has_sidebar ) : ?>
		<div class="content__wrapper<?php if ( 'left' === $iron_croma_sidebar_position ) echo ' content--rev'; ?>">
			<article id="post-<?php the_ID(); ?>" <?php post_class('content__main single-post'); ?>>
	<?php else: ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
	<?php endif; ?>

	<div class="entry">
		<?php woocommerce_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'croma' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div>

	<?php 

	if ( $iron_croma_has_sidebar ) : ?>
		</article>

		<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $iron_croma_sidebar_area ); ?>">
	<?php
		do_action('before_ironband_sidebar_dynamic_sidebar', 'page.php');

		dynamic_sidebar( $iron_croma_sidebar_area );

		do_action('after_ironband_sidebar_dynamic_sidebar', 'page.php');
?>
				</aside>
			</div>
<?php
		else:
?>
			</article>
<?php
		endif;
?>
	<?php
		if($iron_croma_has_sidebar || $iron_croma_boxed){
			?>
			</div>
			<?php
		}
		?>
		</div>

<?php

get_footer();