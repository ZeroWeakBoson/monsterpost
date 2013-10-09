<?php 
	// Newsletter form
	function newsletter_form_shortcode(){

		// Code
		$output = "<h3>Get Updates</h3>";
		$output .= "<form action='#' method='post' id='newsletter-shortcode' class='newsletter newsletter__shortcode clearfix' novalidate>
			<label for='email'>Have web design news delivered to your inbox. Sign up to a free newsletter report.</label>
			<input type='email' name='email' id='email' tabindex='1'>
			<input type='submit' value='Subscribe' class='btn btn-primary'>
		</form>";
		return $output;
	}
	add_shortcode( 'newsletter_form', 'newsletter_form_shortcode' );
?>