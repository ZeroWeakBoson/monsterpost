<?php
/**
 * Subscribe form
 *
 */
if ( !function_exists('monster_subscribe_form') ) {
	function monster_subscribe_form($atts){

		// Attributes
		extract( shortcode_atts(
			array(
				'message' => '',
			), $atts )
		);

		// Load scripts
		wp_enqueue_script('livevalidation', PARENT_URL.'/js/livevalidation_standalone.js', array('jquery'), '1.3');
		wp_enqueue_script('icheck', PARENT_URL.'/js/jquery.icheck.min.js', array('jquery'), '0.9.1');
		wp_enqueue_style('icheck-minimal', PARENT_URL.'/css/minimal/_all.css', false, '0.9.1', 'all');

		// Code
		return '<form action="" method="post" id="form-subscribe" novalidate="novalidate">
					<fieldset>
						<input type="hidden" id="form-type" name="form-type" value="subscribe">
						<input type="hidden" id="form-msg" name="form-msg" value="'.esc_textarea($message).'">
						<div class="form-group clearfix">
							<input type="text" class="form-control" id="form-subscribe-name" name="subscribe-name" placeholder="Name">
							<span class="custom_LV_invalid">You have not entered a name.</span>
						</div>
						<div class="form-group clearfix">
							<input type="text" class="form-control" id="form-subscribe-email" name="subscribe-email" placeholder="Email">
							<span class="custom_LV_invalid">You have not entered an email address.</span>
						</div>
						<div class="radio-group clearfix">
							<h4>Newsletter Frequency:</h4>
							<label for="freq-6-wk"><input type="radio" name="freq" value="6-wk" id="freq-6-wk" checked><div>six times a week</div></label><br>
							<label for="freq-1-wk"><input type="radio" name="freq" value="1-wk" id="freq-1-wk"><div>once a week</div></label><br>
							<label for="freq-2-mot"><input type="radio" name="freq" value="2-mo" id="freq-2-mo"><div>twice a month</div></label>
						</div>
						<div class="control-group">
							<button type="submit" class="btn btn-primary btn-normal">Subscribe</button>
						</div>
					</fieldset>
				</form>

				<script>
					jQuery(document).ready(function(){
						// Custom Radio Buttons
						jQuery("#form-subscribe input[type=\'radio\']").iCheck({
							radioClass: "iradio_minimal-grey",
							increaseArea: "20%" // optional
						});
						// init Live Validation
						var _name  = new LiveValidation("form-subscribe-name", { validMessage: "Great!" }),
							_email = new LiveValidation("form-subscribe-email", { validMessage: "Great!" }),
							$name = jQuery("#form-subscribe-name"),
							$email = jQuery("#form-subscribe-email");
						_name.add( Validate.Length, { minimum: 3 } );
						_email.add(Validate.Email, { validMessage: "I am valid!", onlyOnBlur: true } );

						jQuery(".custom_LV_invalid").hide();
						$name.focus(function(){
							$name.next(".custom_LV_invalid").hide();
						});
						$email.focus(function(){
							$email.next(".custom_LV_invalid").hide();
						});
						jQuery("#form-subscribe").submit(function(){
							var $name = jQuery("#form-subscribe-name"),
								$email = jQuery("#form-subscribe-email"),
								$name_val = $name.val(),
								$email_val = $email.val(),
								$is_name_invalid = false,
								$is_email_invalid = false,
								$type_val = jQuery("#form-type").val(),
								$msg_val = jQuery("#form-msg").val(),
								$fr_val = jQuery(".radio-group .checked").next("div").text(),
								$data = "";

							if (($name_val == "") || ($email_val == "")) {
								if ($name_val == ""){
									$name.next(".custom_LV_invalid").show();
								}
								if ($email_val == ""){
									$email.next(".custom_LV_invalid").show();
								}
								return false;
							}
							if (jQuery("#form-subscribe-name").hasClass("LV_invalid_field")) {
								$is_name_invalid = true;
							}
							if (jQuery("#form-subscribe-email").hasClass("LV_invalid_field")) {
								$is_email_invalid = true;
							}
							if ($is_name_invalid == true) {
								jQuery("#form-subscribe-name").focus();
								return false;
							}
							if ($is_email_invalid == true) {
								jQuery("#form-subscribe-email").focus();
								return false;
							}
							$data = "name=" + $name_val + "&email=" + $email_val + "&type=" + $type_val + "&msg=" + $msg_val + "&fr=" + $fr_val;

							jQuery.ajax({
								type: "POST",
								url: "'.PARENT_URL.'/bin/process.php",
								data: $data,
								success: function(){
									jQuery("#form-subscribe")
										.append("<div id=\'message\' class=\'alert alert-block alert-success\'></div>")
										.find("span").hide();
									$name.val("");
									$email.val("");
									jQuery("#message")
										.hide()
										.append("<button type=\'button\' class=\'close\' data-dismiss=\'alert\'>&times;</button>")
										.append("Thank you for your subscription to our newsletter.")
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
	add_shortcode( 'subscribe_form', 'monster_subscribe_form' );
} ?>