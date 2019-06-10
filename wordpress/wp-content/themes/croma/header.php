<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
	<div id="overlay"><div class="perspective"></div></div>
	<?php
	$iron_croma_fixed_header = Iron_Croma::getOption('enable_fixed_header', null, '1');
	$iron_croma_menu_type = Iron_Croma::getOption('menu_type', null, 'push-menu');
	$iron_croma_menu_position = Iron_Croma::getOption('classic_menu_position', null, 'absolute absolute_before');
	$iron_croma_menu_is_over = Iron_Croma::getField('classic_menu_over_content', get_the_ID());

	if(!empty($iron_croma_menu_is_over)) {
		$iron_croma_menu_position = ($iron_croma_menu_position == 'absolute absolute_before') ? 'absolute' : 'fixed';
	}

	if($iron_croma_menu_type == 'push-menu'){
		get_template_part('parts/push', 'menu');
	}

	if($iron_croma_menu_type == 'classic-menu' && $iron_croma_menu_position != 'absolute' && $iron_croma_menu_position != 'absolute absolute_before'){
		get_template_part('parts/classic', 'menu');
	}
	?>

	<div id="pusher-wrap">
	<?php
	if(($iron_croma_menu_type == 'push-menu' && empty($iron_croma_fixed_header)) || ($iron_croma_menu_type == 'classic-menu' && ($iron_croma_menu_position == 'fixed' || $iron_croma_menu_position == 'fixed_before'))) : ?>
		<div id="pusher" class="menu-type-<?php echo esc_attr($iron_croma_menu_type);?>">
	<?php endif;

	if($iron_croma_menu_type == 'push-menu'): ?>
		<header class="opacityzero">
			<div class="menu-toggle">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve">
					<rect y="3" width="18" height="2"  class="svgfill"></rect>
					<rect y="8" width="18" height="2"  class="svgfill"></rect>
					<rect y="13" width="18" height="2"  class="svgfill"></rect>
				</svg>
			</div>
			<?php get_template_part('parts/top-menu'); ?>

			<?php if( Iron_Croma::getOption('header_logo', null, get_template_directory_uri().'/images/logo.png') !== ''): ?>
				<a href="<?php echo esc_url( home_url('/'));?>" class="site-logo" title="<?php echo esc_attr( get_bloginfo('name') ); ?>">

					<?php if(Iron_Croma::getField('alternative_logo', get_the_ID())){
						$iron_croma_logo1x = Iron_Croma::getOption('header_alternative_logo', null, get_template_directory_uri().'/images/logo.png');
						$iron_croma_logo2x = Iron_Croma::getOption('retina_header_alternative_logo', null, get_template_directory_uri().'/images/logo.png');

					}else{
						$iron_croma_logo1x = Iron_Croma::getOption('header_logo', null, get_template_directory_uri().'/images/logo.png');
						$iron_croma_logo2x = Iron_Croma::getOption('retina_header_logo', null, get_template_directory_uri().'/images/logo.png');

					} ?>
					<img id="menu-trigger" class="logo-desktop regular" src="<?php echo esc_url( $iron_croma_logo1x ); ?>" <?php echo 'srcset="' . $iron_croma_logo1x . ' 1x ' . (($iron_croma_logo2x)? ',' . $iron_croma_logo2x . ' 2x': '') . ' "'; ?> alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
				</a>
			<?php endif; ?>

		</header>
	<?php endif;?>

	<?php if(($iron_croma_menu_type == 'push-menu' && !empty($iron_croma_fixed_header)) || ($iron_croma_menu_type == 'classic-menu' && ($iron_croma_menu_position != 'fixed' || $iron_croma_menu_position == 'fixed_before'))) : ?>
		<div id="pusher" class="menu-type-<?php echo esc_attr($iron_croma_menu_type);?>">
	<?php endif;

	if($iron_croma_menu_type == 'classic-menu' && ($iron_croma_menu_position == 'absolute' || $iron_croma_menu_position == 'absolute absolute_before') ){

		get_template_part('parts/classic', 'menu');
	} ?>
	<div class="pjax-container">
	<div id="wrapper" class="wrapper">
