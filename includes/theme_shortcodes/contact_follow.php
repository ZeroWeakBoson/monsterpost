<?php
/**
 * Contact follow list
 *
 */
if ( !function_exists('monster_contact_follow') ) {
	function monster_contact_follow( $atts ) {
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

		$output = '<ul class="contact-follow-us unstyled clearfix">';
		foreach ($atts as $key => $value) {
			if ( $key == 'google_plus' ) $key = 'google+';
			$output .=  '<li class="contact-follow-item">&nbsp;&frasl;&nbsp;</li>';
			$output .= '<li class="contact-follow-item"><a href="'.$value.'" target="_blank">'.$key.'</a></li>';
		}
		$output .= '</ul>';

		return $output;
	}
	add_shortcode( 'contact_follow', 'monster_contact_follow' );
} ?>