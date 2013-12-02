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

		echo "<form action='#' method='post' id='newsletter-widget' class='newsletter newsletter__widget clearfix' novalidate>
			<label for='email'>$desc</label>
			<input type='email' name='email' id='email' tabindex='1'>
			<input type='submit' value='Subscribe' class='btn btn-primary btn-normal'>
		</form>";

		echo $after_widget;
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
		$defaults = array( 'title' => __('Get Updates (it\'s free)', 'cherry'), 'desc' => __('Enter your email to get free newsletter updates', 'cherry') );
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