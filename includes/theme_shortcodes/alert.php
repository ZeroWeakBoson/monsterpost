<?php
/**
 * Alert boxes
 */
if ( !function_exists('monster_alert_box') ) {
	function monster_alert_box($atts, $content = null) {
		extract(shortcode_atts(
			array(
				'style' => '',
				'close' => ''
		), $atts));

		$output =  '<div class="alert alert-'.$style.' fade in">';
		if ($close == 'yes') {
			$output .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		}
		$output .= $content;
		$output .=  '</div>';
		return $output;
	}
	add_shortcode('alert_box', 'monster_alert_box');
} ?>