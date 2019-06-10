<?php

	$iron_croma_post_id = get_the_ID();

	if(is_home() && get_option('page_for_posts') != '') {

		$iron_croma_post_id = get_option('page_for_posts');

	}else if(is_front_page() && get_option('page_on_front') != '') {

		$iron_croma_post_id = get_option('page_on_front');

	}else if(function_exists('is_shop') && is_shop() && get_option('woocommerce_shop_page_id') != '') {

		$iron_croma_post_id = get_option('woocommerce_shop_page_id');

	}elseif($wp_query && !empty($wp_query->queried_object) && !empty($wp_query->queried_object->ID)) {

		$iron_croma_post_id = $wp_query->queried_object->ID;
	}


	$iron_croma_menu_position = Iron_Croma::getOption('classic_menu_position', null, 'absolute absolute_before');
	$iron_croma_menu_logo_align = Iron_Croma::getOption('classic_menu_logo_align', null, 'pull-left');
	$iron_croma_classic_menu_over_content = Iron_Croma::getField('classic_menu_over_content', $iron_croma_post_id );
	if(!empty( $iron_croma_classic_menu_over_content )) {
		if($iron_croma_menu_position == 'absolute absolute_before') {
			$iron_croma_menu_position = 'absolute';
		}else{
			$iron_croma_menu_position = 'fixed';
		}
	}

	$iron_croma_container_classes = array();
	$iron_croma_container_classes[] = 'classic-menu';
	$iron_croma_container_classes[] = Iron_Croma::getOption('classic_menu_effect', null, 'reset');
	$iron_croma_container_classes[] = $iron_croma_menu_position;


	$iron_croma_menu_classes = array();
	$iron_croma_menu_classes[] = 'menu-level-0';
	$iron_croma_menu_classes[] = Iron_Croma::getOption('classic_menu_align', null, 'pull-center');
	$iron_croma_menu_classes[] = Iron_Croma::getOption('classic_menu_width', null, 'fullwidth');
 	$iron_croma_alternative_logo = Iron_Croma::getField('alternative_logo', $iron_croma_post_id );
	if(!empty( $iron_croma_alternative_logo )) {
		$iron_use_alternative_logo = 1;
		$iron_alternative_logo = Iron_Croma::getOption('header_alternative_logo');
		$iron_alternative_logo_retina = Iron_Croma::getOption('retina_header_alternative_logo');
	}

	$iron_use_alternative_logo_on_mobile = Iron_Croma::getOption('use_alternative_logo_on_mobile');

	if($iron_use_alternative_logo_on_mobile==1){
		$iron_alternative_logo = Iron_Croma::getOption('header_alternative_logo');
		$iron_alternative_logo_retina = Iron_Croma::getOption('retina_header_alternative_logo');
	}



	if($iron_croma_menu_logo_align == 'pull-top')
		$iron_croma_menu_classes[] = 'logo-pull-top';

?>

<div class="<?php echo esc_attr( implode( " ", $iron_croma_container_classes ) ) ?>"
	data-site_url="<?php echo esc_url( home_url('/') ); ?>"
	data-site_name="<?php echo esc_attr( get_bloginfo('name') ); ?>"
	data-logo="<?php echo esc_url( Iron_Croma::getOption('header_logo', null, get_template_directory_uri().'/images/logo.png') ); ?>"
	data-logo_page="<?php echo esc_attr($iron_alternative_logo); ?>"
	data-logo_page_retina="<?php echo esc_attr($iron_alternative_logo_retina); ?>"
	data-use_alternative_logo="<?php echo esc_attr( ( isset( $iron_use_alternative_logo) )? $iron_use_alternative_logo : 0); ?>"
	data-use_alternative_logo_on_mobile="<?php echo esc_attr($iron_use_alternative_logo_on_mobile); ?>"
	data-retina_logo="<?php echo esc_url( Iron_Croma::getOption('retina_header_logo') ); ?>"
	data-logo_mini="<?php echo esc_url( Iron_Croma::getOption('classic_menu_header_logo_mini') ); ?>"
	data-logo_align="<?php echo esc_attr($iron_croma_menu_logo_align); ?>">
	<?php

	echo wp_nav_menu( array(
		'menu_id' => 'menu-main-menu',
		'container' => false,
		'theme_location' => 'main-menu',
		'menu_class' => implode(" ", $iron_croma_menu_classes),
		'echo' => false,
		'fallback_cb' => '__return_false'
	));

	$iron_croma_menu_items = Iron_Croma::getOption('header_top_menu', null, array(
					0 => array(
						'menu_page_name' => '',
						'menu_page_is_menu' => '',
						'menu_page_url' => '',
						'pages_select' => '',
						'menu_page_external_url' => '',
						'menu_page_icon' => '',
						'order_no'     => 1
					),
				));
	//$menu_icon_toggle = (int)Iron_Croma::getOption('header_menu_toggle_enabled');
	if((bool)Iron_Croma::getOption('header_top_menu_enabled', null, false) && !empty($iron_croma_menu_items)): ?>

	<!-- social-networks -->
	<ul class="classic-menu-hot-links <?php echo esc_attr( (!empty($_GET["mpos"]) ? esc_attr($_GET["mpos"]) : Iron_Croma::getOption('menu_position', null, 'righttype') ) )?>">

		<?php foreach($iron_croma_menu_items as $item):
			if(!empty($item["menu_page_external_url"])) {
				$iron_croma_url = $item["menu_page_external_url"];
			}else{
				$iron_croma_url = get_permalink($item["menu_page_url"]);
			}
			$iron_croma_target = $item["menu_page_url_target"];
			$iron_croma_hide_page_name = !empty($item["menu_hide_page_title"]) ? (bool)$item["menu_hide_page_title"] : false;
			?>
			<li class="hotlink pull-right">
				<a target="<?php echo esc_attr($iron_croma_target);?>" href="<?php echo esc_url($iron_croma_url); ?>">
					<?php if(!empty($item["menu_page_icon"])): ?>

					<?php 	if( substr($item["menu_page_icon"],0,4) != 'fab ' && substr($item["menu_page_icon"],0,4) != 'far ' && substr($item["menu_page_icon"],0,4) != 'fas ' && substr($item["menu_page_icon"],0,3) != 'fa '){
						   $item["menu_page_icon"] = 'fa  fa-'.$item["menu_page_icon"];
					}?>

					<i class="<?php echo esc_attr($item["menu_page_icon"]); ?>" title="<?php echo esc_attr($item["menu_page_name"]); ?>"></i>
					<?php endif;?>

					<?php if(!$iron_croma_hide_page_name): ?>
						<?php echo esc_html($item["menu_page_name"]); ?>
					<?php endif; ?>

					<?php if(function_exists('is_shop')): ?>

						<?php global $woocommerce; ?>


						<?php if (!empty($item["menu_page_url"]) && (get_option('woocommerce_cart_page_id') == $item["menu_page_url"]) && $woocommerce->cart->cart_contents_count > 0): ?>

							<span>( <?php echo esc_html($woocommerce->cart->cart_contents_count);?> )</span>

						<?php endif; ?>

					<?php endif; ?>
				</a>

			</li>
		<?php endforeach; ?>
		<li class="languages-selector hotlink pull-right">
			<?php dynamic_sidebar( 'croma_sidebar_lang' ) ?>
		</li>
	</ul>
	<div class="clear"></div>

	<?php endif; ?>

</div>
