<?php
/**
 * Categories
 *
 */
if ( !function_exists('monster_categories_shortcode') ) {
	function monster_categories_shortcode($atts) {
		extract(shortcode_atts(
			array(
				'class' => 'check'
			), $atts)
		);

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
	add_shortcode('categories', 'monster_categories_shortcode');
} ?>