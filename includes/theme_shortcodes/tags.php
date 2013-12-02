<?php
//Tag Cloud
if (!function_exists('shortcode_tags')) {
	function shortcode_tags($atts, $content = null) {
		$output = '<div class="tags-cloud clearfix"><ul>';
		$tags = wp_tag_cloud('smallest=8&largest=8&format=array');

		foreach($tags as $tag){
			$output .= '<li>' . $tag. '</li>';
		}

		$output .= '</ul></div><!-- .tags-cloud (end) -->';
		return $output;
	}
	add_shortcode('tags', 'shortcode_tags');
} ?>