<?php
// Question shortcode
if ( !function_exists('monster_question_shortcode') ) {
	function monster_question_shortcode( $atts , $content = null ) {

		// Attributes
		extract( shortcode_atts(
			array(
				'author_name'   => '',
				'author_email'  => '',
				'question_text' => '',
			), $atts )
		);

		// Code
		$output = '<div class="interview__holder question clearfix">';
		if ($author_email != '') {
			$output .= '<figure class="thumbnail author-avatar">' . get_avatar( $author_email, 37 ) . '</figure>';
			$user = get_user_by( 'email', $author_email );
			if ($user) {
				$output .= '<em><strong>' . $user->first_name . ' ' . $user->last_name . ': </strong></em>';
			}
			if ($author_name != '') {
				$output .= '<em><strong>' . $author_name . '</strong></em>: ';
			}
		}
		if ($question_text != '') {
			$output .= '<em>' . $question_text . '</em>';
		}
		$output .= '</div>';

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
				'answer_text'  => '',
			), $atts )
		);

		// Code
		$output = '<div class="interview__holder answer clearfix">';
		if ($author_email != '') {
			$output .= '<figure class="thumbnail author-avatar">' . get_avatar( $author_email, 37 ) . '</figure>';
		}
		$output .= '<div class="extra-wrap">';
		if ($author_name != '') {
			$output .= '<strong>' . $author_name . '</strong>: ';
		}
		if ($answer_text != '') {
			$output .= $answer_text;
		}
		$output .= '</div></div>';

		return $output;
	}
	add_shortcode( 'answer', 'monster_answer_shortcode' );
}
?>