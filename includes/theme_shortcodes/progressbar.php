<?php
/**
 * Progressbar
 *
 */
if ( !function_exists('monster_progressbar') ) {
	function monster_progressbar($atts, $content = null) {
		extract(shortcode_atts(
			array(
					'value'     => '50',
					'type'      => '',
					'grad_type' => '',
					'animated'  => ''
		), $atts));
		
		// check what type user selected
		switch ($type) {
			case 'info':
				$bar_type = 'progress-info';
				break;
			case 'success':
				$bar_type = 'progress-success';
				break;
			case 'warning':
				$bar_type = 'progress-warning';
				break;
			case 'danger':
				$bar_type = 'progress-danger';
				break;
		}
		
		// check what gradient type user selected
		switch ($grad_type) {
			case 'vertical':
				$g_type = '';
				break;
			case 'striped':
				$g_type = 'progress-striped';
				break;
		}
		
		// animated: yes or no
		switch ($animated) {
			case 'no':
				$bar_animated = '';
				break;
			case 'yes':
				$bar_animated = 'active';
				break;
		}
		$output = '<div class="progress '. $bar_type .' '. $bar_animated .' '. $g_type .'">';
		$output .= '<div class="bar" style="width: '. $value .'%;"></div>';
		$output .= '</div><!-- .progressbar (end) -->';

		return $output;

	}
	add_shortcode('progressbar', 'monster_progressbar');
} ?>