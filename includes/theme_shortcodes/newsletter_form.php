<?php
/**
 * Newsletter form
 *
 */
if ( !function_exists('monster_newsletter_form') ) {
	function monster_newsletter_form(){

		// Load scripts
		wp_enqueue_script('livevalidation', PARENT_URL.'/js/livevalidation_standalone.js', array('jquery'), '1.3');

		// Code
		$output = "<h3>Get Updates:</h3>";
		$output .= "<form action='#' method='post' id='newsletter-form' class='newsletter newsletter__shortcode clearfix' novalidate='novalidate'>
			<input type='hidden' id='form-type' name='form-type' value='subscribe'>
			<label for='newsletter-form-email'>To subscribe to our FREE newsletter with top news, enter your email below.</label>
			<input type='text' name='newsletter-form-email' id='newsletter-form-email'>
			<span class='custom_LV_invalid'>You have not entered an email address.</span>
			<input type='submit' value='Subscribe' class='btn btn-primary btn-normal'>
		</form>";

		$output .= '<script>
					jQuery(document).ready(function(){
						// init Live Validation
						var _email = new LiveValidation("newsletter-form-email", { validMessage: "Great!" }),
							$email = jQuery("#newsletter-form-email");
						_email.add(Validate.Email, { validMessage: "I am valid!", onlyOnBlur: true } );

						jQuery(".custom_LV_invalid").hide();
						$email.focus(function(){
							$email.next(".custom_LV_invalid").hide();
						});
						jQuery("#newsletter-form").submit(function(){
							var $email = jQuery("#newsletter-form-email"),
								$email_val = $email.val(),
								$is_email_invalid = false,
								$type_val = jQuery("#form-type").val(),
								$data = "";

							if ($email_val == ""){
								$email.next(".custom_LV_invalid").show();
								return false;
							}
							if (jQuery("#newsletter-form-email").hasClass("LV_invalid_field")) {
								$is_email_invalid = true;
							}
							if ($is_email_invalid == true) {
								jQuery("#newsletter-form-email").focus();
								return false;
							}
							$data = "email=" + $email_val + "&type=" + $type_val;

							jQuery.ajax({
								type: "POST",
								url: "'.PARENT_URL.'/bin/process.php",
								data: $data,
								beforeSend: function(){
									jQuery("#newsletter-form .btn").attr("disabled", true);
								},
								success: function(){
									jQuery("#newsletter-form")
										.parent()
										.append("<div id=\'message\'><div class=\'alert alert-block alert-success\'></div></div>")
										.find("span").hide();
									$email.val("");
									jQuery("#message").hide();
									jQuery(".alert-success")
										.html("<button type=\'button\' class=\'close\' data-dismiss=\'alert\'>&times;</button>")
										.append("Thank you for your subscription to our newsletter.")
										.parent()
										.fadeIn()
										.delay(3000)
										.fadeOut();
									jQuery("#newsletter-form .btn").removeAttr("disabled");
								}
							});
							return false;
						})
					});
				</script>';

		return $output;
	}
	add_shortcode( 'newsletter_form', 'monster_newsletter_form' );
} ?>