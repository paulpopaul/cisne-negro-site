<?php if( Iron_Croma::getOption('menu_logo', null, get_template_directory_uri().'/images/menu-logo.png') !== ''): 
		$iron_croma_logo1x = Iron_Croma::getOption('menu_logo', null, get_template_directory_uri().'/images/menu-logo.png');
		$iron_croma_logo2x = Iron_Croma::getOption('retina_menu_logo', null, get_template_directory_uri().'/images/menu-logo.png');
 endif; ?>


<div class="side-menu">
	<div class="menu-toggle-off">
		<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-2.5 -2.5 25 25" enable-background="new -2.5 -2.5 25 25" xml:space="preserve">
			<polygon class="svgfill" points="18,2.1 15.9,0 9,6.9 2.2,0 0,2.1 6.9,9 0,15.9 2.1,18 9,11.1 15.9,18 18,15.9 11.1,9" fill="#fff"></polygon>
		</svg>
	</div>

	<a class="site-title" rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>">
		<img class="logo-desktop regular" src="<?php echo esc_url( $iron_croma_logo1x ); ?>" <?php echo 'srcset="' . $iron_croma_logo1x . ' 1x ' . (($iron_croma_logo2x)? ',' . $iron_croma_logo2x . ' 2x' : '') . ' "'; ?> alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
		<img class="logo-mobile regular" src="<?php echo esc_url( $iron_croma_logo1x ); ?>" <?php echo 'srcset="' . $iron_croma_logo1x . ' 1x ' . (($iron_croma_logo2x)? ',' . $iron_croma_logo2x . ' 2x' : '') . ' "'; ?> alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
	</a>


	<!-- panel -->
	<div class="panel">
		<a class="opener" href="#"><i class="icon-reorder"></i> <?php esc_html_e("Menu", 'croma'); ?></a>

		<!-- nav-holder -->
		<div class="nav-holder">

			<!-- nav -->
			<nav id="nav">
				<?php if ( Iron_Croma::getOption('header_menu_logo_icon') != '') : ?>
					<a class="logo-panel" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>">
						<img src="<?php echo esc_url( Iron_Croma::getOption('header_menu_logo_icon') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
					</a>
				<?php endif; ?>
				<?php echo wp_nav_menu( array( 'menu_id' => 'menu-main-menu', 'theme_location' => 'main-menu', 'menu_class' => 'nav-menu', 'echo' => false, 'fallback_cb' => '__return_false', 'walker' => new iron_nav_walker() )); ?>

			</nav>
			<div class="clear"></div>

			<div class="panel-networks">
				<?php get_template_part('parts/networks'); ?>
				<div class="clear"></div>
			</div>

		</div>
	</div>

</div>