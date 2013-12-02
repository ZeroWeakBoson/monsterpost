<?php
if ( !function_exists('monster_row_shortcode') ) {
	// Row
	function monster_row_shortcode($atts, $content = null) {
		$output = '<div class="row">';
		$output .= do_shortcode($content);
		$output .= '</div><!-- .row (end) -->';

		return $output;
	}
	add_shortcode('row', 'monster_row_shortcode');
}

if ( !function_exists('row_fluid_shortcode') ) {
	// Row Fluid
	function row_fluid_shortcode($atts, $content = null) {
		$output = '<div class="row-fluid">';
		$output .= do_shortcode($content);
		$output .= '</div><!-- .row-fluid (end) -->';

		return $output;
	}
	add_shortcode('row_fluid', 'row_fluid_shortcode');
}

if ( !function_exists('monster_grid_col') ) {
	// Grid Columns
	function monster_grid_col( $atts, $content = null, $shortcodename = '' ){
		// Balances tags of string using a modified stack.
		$content = force_balance_tags($content);
		$return = '<div class="'.$shortcodename.'">';
		$return .= do_shortcode($content);
		$return .= '</div>';

		return $return;
	}
	add_shortcode('span1', 'monster_grid_col');
	add_shortcode('span2', 'monster_grid_col');
	add_shortcode('span3', 'monster_grid_col');
	add_shortcode('span4', 'monster_grid_col');
	add_shortcode('span5', 'monster_grid_col');
	add_shortcode('span6', 'monster_grid_col');
	add_shortcode('span7', 'monster_grid_col');
	add_shortcode('span8', 'monster_grid_col');
	add_shortcode('span9', 'monster_grid_col');
	add_shortcode('span10', 'monster_grid_col');
	add_shortcode('span11', 'monster_grid_col');
	add_shortcode('span12', 'monster_grid_col');
} ?>