<?php
// Question shortcode
if ( !function_exists('monster_question_shortcode') ) {
	function monster_question_shortcode( $atts , $content = null ) {

		// Attributes
		extract( shortcode_atts(
			array(
				'author_name'  => '',
				'author_email' => '',
			), $atts )
		);

		// Code
		$output = '<div class="interview__holder question clearfix">';
		if ( !empty($author_email) ) {
			$output .= '<figure class="thumbnail author-avatar">' . get_avatar( $author_email, 37 ) . '</figure>';
		}
		$output .= '<div class="extra-wrap">';
		if ( !empty($author_email) ) {
			$user = get_user_by( 'email', $author_email );
			if ($user) {
				$output .= '<strong>' . $user->first_name . ' ' . $user->last_name . ': </strong>';
			} elseif ( !empty($author_name) ) {
				$output .= '<strong>' . $author_name . '</strong>: ';
			}
		}
		$output .= do_shortcode( $content );
		$output .= '</div></div>';

		return $output;
	}
	add_shortcode( 'question', 'monster_question_shortcode' );
}

// Answer shortcode
if ( !function_exists('monster_answer_shortcode') ) {
	function monster_answer_shortcode( $atts , $content = null ) {

		// Attributes
		extract( shortcode_atts(
			array(
				'author_name'  => '',
				'author_email' => '',
			), $atts )
		);

		// Code
		$output = '<div class="interview__holder answer clearfix">';
		if ( !empty($author_email) ) {
			$output .= '<figure class="thumbnail author-avatar">' . get_avatar( $author_email, 37 ) . '</figure>';
		}
		$output .= '<div class="extra-wrap">';
		if ( !empty($author_name) ) {
			$output .= '<strong>' . $author_name . '</strong>: ';
		}
		$output .= do_shortcode( $content );
		$output .= '</div></div>';

		return $output;
	}
	add_shortcode( 'answer', 'monster_answer_shortcode' );
} ?>