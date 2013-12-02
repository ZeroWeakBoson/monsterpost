<?php
// Row
function row_shortcode($atts, $content = null) {
	$output = '<div class="row">';
	$output .= do_shortcode($content);
	$output .= '</div> <!-- .row (end) -->';

	return $output;
}
add_shortcode('row', 'row_shortcode');

// Row Fluid
function row_fluid_shortcode($atts, $content = null) {
	$output = '<div class="row-fluid">';
	$output .= do_shortcode($content);
	$output .= '</div> <!-- .row-fluid (end) -->';

	return $output;
}
add_shortcode('row_fluid', 'row_fluid_shortcode');

if ( !function_exists('grid_column') ) {
	// Grid Columns
	function grid_column( $atts, $content = null, $shortcodename = '' ){
		// Balances tags of string using a modified stack.
		$content = force_balance_tags($content);
		$return = '<div class="'.$shortcodename.'">';
		$return .= do_shortcode($content);
		$return .= '</div>';

		return $return;
	}
	add_shortcode('span1', 'grid_column');
	add_shortcode('span2', 'grid_column');
	add_shortcode('span3', 'grid_column');
	add_shortcode('span4', 'grid_column');
	add_shortcode('span5', 'grid_column');
	add_shortcode('span6', 'grid_column');
	add_shortcode('span7', 'grid_column');
	add_shortcode('span8', 'grid_column');
	add_shortcode('span9', 'grid_column');
	add_shortcode('span10', 'grid_column');
	add_shortcode('span11', 'grid_column');
	add_shortcode('span12', 'grid_column');
} ?>