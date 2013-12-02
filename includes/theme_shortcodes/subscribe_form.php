<?php
/**
 * Subscribe form
 *
 */
if ( !function_exists('monster_subscribe_form') ) {
	function monster_subscribe_form(){
		
		// Load scripts
		wp_enqueue_script('livevalidation', PARENT_URL.'/js/livevalidation_standalone.compressed.js', array('jquery'), '1.3');
		wp_enqueue_script('icheck', PARENT_URL.'/js/jquery.icheck.min.js', array('jquery'), '0.9.1');
		wp_enqueue_style('icheck-minimal', PARENT_URL.'/css/minimal/_all.css', false, '0.9.1', 'all');

		// Code
		return '<form action="" method="post" id="form-subscribe" novalidate="novalidate">
					<fieldset>
						<div class="form-group clearfix">
							<input type="text" class="form-control" id="form-subscribe-name" name="subscribe-name" placeholder="Name">
						</div>
						<div class="form-group clearfix">
							<input type="text" class="form-control" id="form-subscribe-email" name="subscribe-email" placeholder="Email">
						</div>
						<div class="radio-group clearfix">
							<h4>Newsletter Frequency</h4>
							<label for="freq-6-wk"><input type="radio" name="freq" value="6-wk" id="freq-6-wk" checked>six times a week</label><br>
							<label for="freq-1-wk"><input type="radio" name="freq" value="1-wk" id="freq-1-wk">once a week</label><br>
							<label for="freq-2-mot"><input type="radio" name="freq" value="2-mo" id="freq-2-mo">twice a month</label>
						</div>
						<div class="control-group">
							<button type="submit" class="btn btn-primary btn-normal">Subscribe</button>
						</div>
					</fieldset>
				</form>

				<script type="text/javascript">
					jQuery(document).ready(function(){
						// Custom Radio Buttons
						jQuery("#form-subscribe input[type=\'radio\']").iCheck({
							radioClass: "iradio_minimal-grey",
							increaseArea: "20%" // optional
						});
						// init Live Validation
						var _name  = new LiveValidation("form-subscribe-name", { validMessage: "Great, nice to meet you!" }),
							_email = new LiveValidation("form-subscribe-email", { validMessage: "Great, nice to meet you!" });
						_name.add( Validate.Length, { minimum: 3 } );
						_email.add(Validate.Email, { validMessage: "I am valid!", onlyOnBlur: true } );
					});
				</script>';
	}
	add_shortcode( 'subscribe_form', 'monster_subscribe_form' );
} ?>