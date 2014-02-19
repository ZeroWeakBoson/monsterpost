<?php
/**
 * Feedback Form
 */
// Add Shortcode
function monster_feedback_form($atts) {

	// Attributes
	extract( shortcode_atts(
		array(
			'owner_email' => '',
		), $atts )
	);

	// Load scripts
	wp_enqueue_script('livevalidation', PARENT_URL.'/js/livevalidation_standalone.js', array('jquery'), '1.3');

	// Code
	return '<form action="" method="post" id="form-feedback" novalidate="novalidate">
				<fieldset>
					<input type="hidden" id="form-type" name="form-type" value="feedback">
					<input type="hidden" id="owner-email" name="owner-email" value="'.sanitize_email( $owner_email ).'">
					<div class="form-group clearfix">
						<input type="text" class="form-control" id="form-feedback-name" name="form-feedback-name" placeholder="Name">
						<span class="custom_LV_invalid">You have not entered a name.</span>
					</div>
					<div class="form-group clearfix">
						<input type="text" class="form-control" id="form-feedback-email" name="form-feedback-email" placeholder="Email">
						<span class="custom_LV_invalid">You have not entered an email address.</span>
					</div>
					<div class="form-group clearfix">
						<input type="text" class="form-control" id="form-feedback-phone" name="form-feedback-phone" placeholder="Phone">
					</div>
					<div class="form-group clearfix">
						<textarea name="form-feedback-msg" id="form-feedback-msg" cols="30" rows="10" placeholder="Message"></textarea>
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
					var _name = new LiveValidation("form-feedback-name", { validMessage: "Great!" }),
						_email = new LiveValidation("form-feedback-email", { validMessage: "Great!" }),
						_msg = new LiveValidation("form-feedback-msg", { validMessage: "Great!" }),
						$name = jQuery("#form-feedback-name"),
						$email = jQuery("#form-feedback-email"),
						$phone = jQuery("#form-feedback-phone"),
						$msg = jQuery("#form-feedback-msg");
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
					jQuery("#form-feedback").submit(function(){
						var $name = jQuery("#form-feedback-name"),
							$email = jQuery("#form-feedback-email"),
							$phone = jQuery("#form-feedback-phone"),
							$msg = jQuery("#form-feedback-msg"),
							$name_val = $name.val(),
							$email_val = $email.val(),
							$phone_val = $phone.val(),
							$msg_val = $msg.val(),
							$is_name_invalid = false,
							$is_email_invalid = false,
							$is_msg_invalid = false,
							$type_val = jQuery("#form-type").val(),
							$owner_email = jQuery("#owner-email").val(),
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
						if (jQuery("#form-feedback-name").hasClass("LV_invalid_field")) {
							$is_name_invalid = true;
						}
						if (jQuery("#form-feedback-email").hasClass("LV_invalid_field")) {
							$is_email_invalid = true;
						}
						if (jQuery("#form-feedback-msgl").hasClass("LV_invalid_field")) {
							$is_msg_invalid = true;
						}
						if ($is_name_invalid == true) {
							jQuery("#form-feedback-name").focus();
							return false;
						}
						if ($is_email_invalid == true) {
							jQuery("#form-feedback-email").focus();
							return false;
						}
						if ($is_msg_invalid == true) {
							jQuery("#form-feedback-msg").focus();
							return false;
						}
						$data = "name=" + $name_val + "&email=" + $email_val + "&phone=" + $phone_val + "&type=" + $type_val + "&msg=" + $msg_val + "&owner_email=" + $owner_email;

						jQuery.ajax({
							type: "POST",
							url: "'.PARENT_URL.'/bin/process.php",
							data: $data,
							beforeSend: function(){
								jQuery("#form-feedback .btn").attr("disabled", true);
							},
							success: function(){
								jQuery("#form-feedback")
									.append("<div id=\'message\'><div class=\'alert alert-block alert-success\'></div></div>")
									.find("span").hide();
								$name.val("");
								$email.val("");
								$phone.val("");
								$msg.val("");
								jQuery("#message").hide();
								jQuery(".alert-success")
									.html("<button type=\'button\' class=\'close\' data-dismiss=\'alert\'>&times;</button>")
									.append("<h4>Thank you for feedbacking us!</h4> We will get back to you very shortly with further information.")
									.parent()
									.fadeIn()
									.delay(3000)
									.fadeOut();
								jQuery("#form-feedback .btn").removeAttr("disabled");
							}
						});
						return false;
					})
				});
			</script>';
}
add_shortcode( 'feedback_form', 'monster_feedback_form' );
?>