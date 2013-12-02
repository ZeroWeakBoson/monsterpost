<?php
/*
 * Tags
 *
 */
if (!function_exists('monster_tags_shortcode')) {
	function monster_tags_shortcode( $atts ) {
		extract(shortcode_atts(
			array(
				'class' => 'check'
			), $atts)
		);
		$args = array(
			'smallest' => 16,
			'largest'  => 16,
			'unit'     => 'px',
			'format'   => 'array',
			'echo'     => false
		);
		$tags = wp_tag_cloud($args);
		$output = '<div class="list styled '.$class.'-list"><ul>';

		foreach($tags as $tag){
			$output .= '<li>' . $tag. '</li>';
		}

		$output .= '</ul></div>';
		return $output;
	}
	add_shortcode('tags', 'monster_tags_shortcode');
} ?>