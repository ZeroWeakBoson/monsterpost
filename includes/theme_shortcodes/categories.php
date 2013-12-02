<?php
/**
 * Categories
 *
 */
if (!function_exists('categories_shortcode')) {

	function categories_shortcode($atts) {
		extract(shortcode_atts(
			array(
				'type' => '',
				'class' => 'check'
			), $atts));

		$args = array(
			'type'     => 'post',
			'taxonomy' => 'category'
		);

		$categories = get_categories($args); 
		$output = '<div class="list styled '.$class.'-list">';
		$output .= '<ul>';
		foreach ($categories as $category) {
			$output .= '<li>';
			$output .= '<a href="' . get_category_link( $category ) . '" title="' . $category->slug . '" ' . '>' . $category->name.'</a>';
			$output .= '</li>';
		}
		$output .= '</ul>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode('categories', 'categories_shortcode');

}?>