<?php 
	$post_image_before = (!is_singular()) ? '<a href="'.get_permalink().'" title="'.get_the_title().'" >' : '';
	$post_image_after  = (!is_singular()) ? '</a>' : '';
	$thumb             = get_post_thumbnail_id(); //get img ID
	$img_url           = wp_get_attachment_url($thumb, 'full'); //get img URL
	// $img_width         = (is_singular()) ? 630 : 335; //set width large img
	// $img_height        = (is_singular()) ? 330 : 200; //set height large img
	$img_width         = (is_singular()) ? 900 : 335; //set width large img
	$img_height        = (is_singular()) ? 538 : 200; //set height large img
	$figure_class      = (is_singular()) ? 'large' : '';
	$suffix = '';
	if (is_singular()) {
		$suffix = the_post_thumbnail_caption();
	} else {
		if (!is_tag()) {
			$categories = get_the_category();
			if (!empty($categories)) {
				$category = $categories[0];
				$suffix = '<span class="post-cat">'.$category->cat_name.'</span>';
			}
		}
	}
	if (has_post_thumbnail()) {
		$image = aq_resize($img_url, $img_width, $img_height, true); //resize & crop img
		echo '<figure class="featured-thumbnail thumbnail '.$figure_class.'" >'.$post_image_before.'<img src="'.$image.'" alt="'.get_the_title().'" >'.$post_image_after.$suffix.'</figure>';
	};
?>