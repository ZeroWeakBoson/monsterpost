<?php
/**
 * Contact Form
 */
// Add Shortcode
function monster_contact_form() {

	// Load scripts
	wp_enqueue_script('livevalidation', PARENT_URL.'/js/livevalidation_standalone.js', array('jquery'), '1.3');

	// Code
	return '<form action="" method="post" id="form-contact" novalidate="novalidate">
				<fieldset>
					<input type="hidden" id="form-type" name="form-type" value="contact">
					<div class="form-group clearfix">
						<input type="text" class="form-control" id="form-contact-name" name="form-contact-name" placeholder="Name">
						<span class="custom_LV_invalid">You have not entered a name.</span>
					</div>
					<div class="form-group clearfix">
						<input type="text" class="form-control" id="form-contact-email" name="form-contact-email" placeholder="Email">
						<span class="custom_LV_invalid">You have not entered an email address.</span>
					</div>
					<div class="form-group clearfix">
						<input type="text" class="form-control" id="form-contact-phone" name="form-contact-phone" placeholder="Phone">
					</div>
					<div class="form-group clearfix">
						<textarea name="form-contact-msg" id="form-contact-msg" cols="30" rows="10" placeholder="Message"></textarea>
						<span class="custom_LV_invalid custom_LV_invalid_msg">You have not entered a message.</span>
					</div>
					<div class="control-group">
						<button type="submit" class="btn btn-primary btn-normal">Send</button>
					</div>
				</fieldset>
			</form>

			<script>
				jQuery(document).ready(function(){
					// init Live Validation
					var _name = new LiveValidation("form-contact-name", { validMessage: "Great!" }),
						_email = new LiveValidation("form-contact-email", { validMessage: "Great!" }),
						_msg = new LiveValidation("form-contact-msg", { validMessage: "Great!" }),
						$name = jQuery("#form-contact-name"),
						$email = jQuery("#form-contact-email"),
						$phone = jQuery("#form-contact-phone"),
						$msg = jQuery("#form-contact-msg");
					_name.add(Validate.Length, { minimum: 3 });
					_email.add(Validate.Email, { validMessage: "I am valid!", onlyOnBlur: true } ),
					_msg.add(Validate.Length, { minimum: 3 });

					jQuery(".custom_LV_invalid").hide();
					$name.focus(function(){
						$name.next(".custom_LV_invalid").hide();
					});
					$email.focus(function(){
						$email.next(".custom_LV_invalid").hide();
					});
					$msg.focus(function(){
						$msg.next(".custom_LV_invalid").hide();
					});
					jQuery("#form-contact").submit(function(){
						var $name = jQuery("#form-contact-name"),
							$email = jQuery("#form-contact-email"),
							$phone = jQuery("#form-contact-phone"),
							$msg = jQuery("#form-contact-msg"),
							$name_val = $name.val(),
							$email_val = $email.val(),
							$phone_val = $phone.val(),
							$msg_val = $msg.val(),
							$is_name_invalid = false,
							$is_email_invalid = false,
							$is_msg_invalid = false,
							$type_val = jQuery("#form-type").val(),
							$data = "";

						if (($name_val == "") || ($email_val == "") || ($msg_val == "")) {
							if ($name_val == ""){
								$name.next(".custom_LV_invalid").show();
							}
							if ($email_val == ""){
								$email.next(".custom_LV_invalid").show();
							}
							if ($msg_val == ""){
								$msg.next(".custom_LV_invalid").show();
							}
							return false;
						}
						if (jQuery("#form-contact-name").hasClass("LV_invalid_field")) {
							$is_name_invalid = true;
						}
						if (jQuery("#form-contact-email").hasClass("LV_invalid_field")) {
							$is_email_invalid = true;
						}
						if (jQuery("#form-contact-msgl").hasClass("LV_invalid_field")) {
							$is_msg_invalid = true;
						}
						if ($is_name_invalid == true) {
							jQuery("#form-contact-name").focus();
							return false;
						}
						if ($is_email_invalid == true) {
							jQuery("#form-contact-email").focus();
							return false;
						}
						if ($is_msg_invalid == true) {
							jQuery("#form-contact-msg").focus();
							return false;
						}
						$data = "name=" + $name_val + "&email=" + $email_val + "&phone=" + $phone_val + "&type=" + $type_val + "&msg=" + $msg_val;

						jQuery.ajax({
							type: "POST",
							url: "'.PARENT_URL.'/bin/process.php",
							data: $data,
							success: function(){
								jQuery("#form-contact")
									.append("<div id=\'message\' class=\'alert alert-block alert-success\'></div>")
									.find("span").hide();
								$name.val("");
								$email.val("");
								$phone.val("");
								$msg.val("");
								jQuery("#message")
									.hide()
									.append("<button type=\'button\' class=\'close\' data-dismiss=\'alert\'>&times;</button>")
									.append("<h4>Thank you for contacting us!</h4> If your message requires a response, we will get back to you as soon as we can.")
									.fadeIn()
									.delay(3000)
									.fadeOut();
							}
						});
						return false;
					})
				});
			</script>';
}
add_shortcode( 'contact_form', 'monster_contact_form' );
?>