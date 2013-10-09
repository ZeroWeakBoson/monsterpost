<?php 
	// Add Shortcode
	function contact_follow_shortcode( $atts ) {

		// Attributes
		extract( shortcode_atts(
			array(
				'facebook'    => '',
				'twitter'     => '',
				'google_plus' => '',
				'pinterest'   => '',
				'dribbble'    => '',
				'behance'     => '',
			), $atts )
		);

		if (empty($atts)) return;

		// Output
		$output = '<ul class="contact-follow-us unstyled clearfix">';
		foreach ($atts as $key => $value) {
			if ( $key == 'google_plus' ) $key = 'google+';
			$output .=  '<li class="contact-follow-item">&nbsp;&frasl;&nbsp;</li>';
			$output .= '<li class="contact-follow-item"><a href="'.$value.'" target="_blank">'.$key.'</a></li>';
		}
		$output .= '</ul>';

		// Code
		return $output;
	}
	add_shortcode( 'contact_follow', 'contact_follow_shortcode' );
?>