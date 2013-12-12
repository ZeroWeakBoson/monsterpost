<?php
// =============================== My Author widget ======================================
class MY_AuthorWidget extends WP_Widget {
	/** constructor */
	function MY_AuthorWidget() {
		parent::WP_Widget(false, $name = 'Cherry - Become an Author');
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		// $link = apply_filters('widget_link', $instance['link']);

		// if ( !$link ) {
		// 	$link = '#';
		// }
		
		echo $before_widget;
			echo "<a href='" . home_url(). "/become-an-author/' class='become-author'>";
				echo "<span class='icon-box'><i class='icon-pen_'></i></span><strong>";
				if ( $title ) {
					echo $title;
				} else {
					echo __('Become an Author', 'cherry');
				}
			echo "</strong></a>";
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		// $defaults = array( 'title' => '', 'link' => '');
		$defaults = array( 'title' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title    = esc_attr($instance['title']);
		// $link     = esc_attr($instance['link']);
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'cherry'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
	<!-- <p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Enter URL:', 'cherry'); ?> <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" /></label></p> -->
	<?php
	}
} // class Cycle Widget
?>