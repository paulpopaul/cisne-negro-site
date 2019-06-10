<?php
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
$iron_croma_menu_icon_toggle = (int)Iron_Croma::getOption('header_menu_toggle_enabled', null, 1);

if((bool)Iron_Croma::getOption('header_top_menu_enabled', null, false) ): ?>

	<!-- social-networks -->
	<ul class="header-top-menu <?php echo esc_attr( (!empty($_GET["mpos"]) ? $_GET["mpos"] : Iron_Croma::getOption('menu_position', null, 'righttype')) ) ?>">
		<?php foreach($iron_croma_menu_items as $item):
			$url = (!empty($item["menu_page_external_url"])) ? $item["menu_page_external_url"] : get_permalink($item["menu_page_url"]);
			$is_menu = !empty($item["menu_page_is_menu"]) ? (bool)$item["menu_page_is_menu"] : false;
			$hide_page_name = !empty($item["menu_hide_page_title"]) ? (bool)$item["menu_hide_page_title"] : false;
		?>
			<li>
				<a target="<?php echo esc_attr($item["menu_page_url_target"]);?>" href="<?php echo esc_url($url); ?>" <?php echo (!empty($is_menu) ? 'class="alt-menu-toggle"' : '')?>>

					<?php if(!empty($item["menu_page_icon"])){ ?>
						<?php if( substr($item["menu_page_icon"],0,4) != 'fab ' && substr($item["menu_page_icon"],0,4) != 'far ' && substr($item["menu_page_icon"],0,4) != 'fas ' && substr($item["menu_page_icon"],0,3) != 'fa '){
							$item["menu_page_icon"] = 'fa  fa-'.$item["menu_page_icon"];
						}?>
						<i class="<?php echo esc_attr($item["menu_page_icon"]); ?>" title="<?php echo esc_attr($item["menu_page_name"]); ?>"></i>
					<?php }

					if(!$hide_page_name){
						echo esc_html($item["menu_page_name"]);
					}

					if(function_exists('is_shop')){
						global $woocommerce;

						if (!empty($item["menu_page_url"]) && (get_option('woocommerce_cart_page_id') == $item["menu_page_url"]) && $woocommerce->cart->cart_contents_count > 0){
							echo '<span>( '.esc_html($woocommerce->cart->cart_contents_count).' )</span>';
						}

					} ?>
				</a>
			</li>
		<?php endforeach; ?>
		<li class="languages-selector">
			<?php dynamic_sidebar( 'croma_sidebar_lang' ) ?>
		</li>
	</ul>


<?php endif;

if($iron_croma_menu_icon_toggle == 0 || $iron_croma_menu_icon_toggle == 2){ ?>
	<script>
	jQuery(document).ready(function() {
		jQuery('.header-top-menu').css('padding-right','10px');
		jQuery('.header-top-menu').css('padding-left','10px');

		<?php if ( $iron_croma_menu_icon_toggle == 2 ) : ?>

		jQuery('.menu-toggle').addClass('hidden-on-desktop');

		<?php else: ?>

		jQuery('.menu-toggle').remove();

		<?php endif ?>
	});
	</script>
<?php }