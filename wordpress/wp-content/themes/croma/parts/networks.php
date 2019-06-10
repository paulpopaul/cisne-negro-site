<?php 

$iron_croma_social_icons = Iron_Croma::getOption('social_icons', null, array(
					0 => array(
						'social_media_name' => esc_html__('Facebook', 'croma'),
						'social_media_url' => 'https://facebook.com/envato',
						'social_media_icon_class' => 'facebook',
						'social_media_icon_url' => '',
						'order_no'     => 1
					),
					1 => array(
						'social_media_name' => esc_html__('Twitter', 'croma'),
						'social_media_url' => 'https://twitter.com/envato',
						'social_media_icon_class' => 'twitter',
						'social_media_icon_url' => '',
						'order_no'     => 1
					)));
if(!empty($iron_croma_social_icons)): ?>
	<!-- social-networks -->
	<ul class="social-networks">
	<?php foreach($iron_croma_social_icons as $icon): ?>
		<?php if( substr($icon["social_media_icon_class"],0,4) != 'fab ' && substr($icon["social_media_icon_class"],0,4) != 'far ' && substr($icon["social_media_icon_class"],0,4) != 'fas ' && substr($icon["social_media_icon_class"],0,3) != 'fa '){
			$icon["social_media_icon_class"] = 'fa  fa-'.$icon["social_media_icon_class"];
		}?>
		<li>
			<a target="_blank" href="<?php echo esc_url($icon["social_media_url"]); ?>">
				<?php if(!empty($icon["social_media_icon_url"])): ?>
					<img src="<?php echo esc_url($icon["social_media_icon_url"]); ?>" style="max-height:50px;">
				<?php else: ?>
					<i class="<?php echo esc_attr($icon["social_media_icon_class"]); ?>" title="<?php echo esc_attr($icon["social_media_name"]); ?>"></i>
				<?php endif; ?>
			</a>
		</li>

	<?php endforeach; ?>	
		
	</ul>
<?php endif; ?>				
