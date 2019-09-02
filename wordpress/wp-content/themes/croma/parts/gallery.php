<?php

global $post;

$iron_croma_photo_sizes_options = Iron_Croma::getOption('photo_sizes');
$iron_croma_available_sizes = array();

foreach($iron_croma_photo_sizes_options as $photo_size) {
	$iron_croma_available_sizes[]["width"] = $photo_size["size_width"];
	$iron_croma_available_sizes[]["height"] = $photo_size["size_height"];
}

$iron_croma_photos = Iron_Croma::getField('album_photos', $post->ID);

if(!empty($iron_croma_photos)): ?>
	<div class="photogrid-wrap free-wall">
	<?php foreach($iron_croma_photos as $photo) {
		$title = $photo["photo_title"];
		if(empty($title)) {
			$title = $photo["photo_file"]["title"];
		}

		$photo_size = $photo["photo_size"];

		if($photo_size == 'random') {
			$size = $iron_croma_available_sizes[rand(0, count($iron_croma_available_sizes) - 1)];
			$width = $size["width"];
			$height = $size["height"];
		}else{
			$photo_size = str_replace("size_", "", $photo_size);
			$photo_size = $iron_croma_photo_sizes_options[$photo_size];
			$width = $photo_size["size_width"];
			$height = $photo_size["size_height"];
		}

		echo wp_kses_post( '<a class="brick lightbox" rel="lightbox" title="'.esc_attr($title).'" href="'.esc_url($photo["photo_file"]["url"]).'" style="display:block;background-image:url('.esc_attr($photo["photo_file"]["sizes"]["large"]).'); background-position:'.$photo["photo_position"].'; background-repeat: no-repeat; background-size: cover; width:'.esc_attr($width).'px; height: '.esc_attr($height).'px"><div class="imgoverlay"></div></a>' );
		}
	?>
	</div>

<?php endif; ?>