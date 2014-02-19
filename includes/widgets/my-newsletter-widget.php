<?php
class MY_NewsletterWidget extends WP_Widget {

	function MY_NewsletterWidget() {
		$widget_ops = array('classname' => 'newsletter', 'description' => __('A widget for newsletter form', 'cherry') );
		$this->WP_Widget( 'newsletter-widget', __('Cherry - Newsletter', 'cherry'), $widget_ops);
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$desc  = $instance['desc'];

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		$message = 'This is new subscription to newsletter.';

		echo '<form action="#" method="post" id="newsletter-widget" class="newsletter newsletter__widget clearfix" novalidate="novalidate">
			<input type="hidden" id="form-type" name="form-type" value="subscribe">
			<input type="hidden" id="form-msg" name="form-msg" value="'.esc_textarea($message).'">
			<label for="newsletter-widget-email">'.$desc.'</label>
			<input type="text" name="newsletter-widget-email" id="newsletter-widget-email" tabindex="1">
			<span class="custom_LV_invalid">You have not entered an email address.</span>
			<input type="submit" value="Subscribe" class="btn btn-primary btn-normal">
		</form>

		<script>
			jQuery(document).ready(function(){
				// init Live Validation
				var _email = new LiveValidation("newsletter-widget-email", { validMessage: "Great!" }),
					$email = jQuery("#newsletter-widget-email");
				_email.add(Validate.Email, { validMessage: "I am valid!", onlyOnBlur: true } );

				jQuery(".custom_LV_invalid").hide();
				$email.focus(function(){
					$email.next(".custom_LV_invalid").hide();
				});
				jQuery("#newsletter-widget").submit(function(){
					var $email = jQuery("#newsletter-widget-email"),
						$email_val = $email.val(),
						$is_email_invalid = false,
						$type_val = jQuery("#form-type").val(),
						$data = "";

					if ($email_val == ""){
						$email.next(".custom_LV_invalid").show();
						return false;
					}
					if (jQuery("#newsletter-widget-email").hasClass("LV_invalid_field")) {
						$is_email_invalid = true;
					}
					if ($is_email_invalid == true) {
						jQuery("#newsletter-widget-email").focus();
						return false;
					}
					$data = "email=" + $email_val + "&type=" + $type_val;

					jQuery.ajax({
						type: "POST",
						url: "'.PARENT_URL.'/bin/process.php",
						data: $data,
						beforeSend: function(){
							jQuery("#newsletter-widget .btn").attr("disabled", true);
						},
						success: function(){
							jQuery("#newsletter-widget")
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
							jQuery("#newsletter-widget .btn").removeAttr("disabled");
						}
					});
					return false;
				})
			});
		</script>';

		echo $after_widget;

		// Load script
		wp_enqueue_script('livevalidation', PARENT_URL.'/js/livevalidation_standalone.js', array('jquery'), '1.3');
	}

	//Update the widget 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and desc to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc']  = strip_tags( $new_instance['desc'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Get Updates (it\'s free)', 'cherry'), 'desc' => __('Enter your email to get free newsletter updates.', 'cherry') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'cherry'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Description:', 'cherry'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo $instance['desc']; ?>" class="widefat" />
		</p>
	<?php
	}
}
?>