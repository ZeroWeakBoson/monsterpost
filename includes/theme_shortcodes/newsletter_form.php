<?php
/** 
 * Newsletter form
 *
 */
if ( !function_exists('monster_newsletter_form') ) {
	function monster_newsletter_form(){
		// Code
		$output = "<h3>Get Updates:</h3>";
		$output .= "<form action='#' method='post' id='newsletter-shortcode' class='newsletter newsletter__shortcode clearfix' novalidate>
			<label for='email'>To subscribe to our FREE newsletter with top news, enter your email below.</label>
			<input type='email' name='email' id='email' tabindex='1'>
			<input type='submit' value='Subscribe' class='btn btn-primary btn-normal'>
		</form>";
		
		return $output;
	}
	add_shortcode( 'newsletter_form', 'monster_newsletter_form' );
} ?>