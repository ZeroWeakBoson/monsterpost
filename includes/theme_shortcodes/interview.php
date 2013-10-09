<?php 
// Question shortcode
function question_shortcode( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
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
	}
	if ($question_text != '') {
		$output .= '<em>' . $question_text . '</em>';
	}
	$output .= '</div>';

	return $output;
}
add_shortcode( 'question', 'question_shortcode' );


// Answer shortcode
function answer_shortcode( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'author_name' => '',
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
add_shortcode( 'answer', 'answer_shortcode' );
?>