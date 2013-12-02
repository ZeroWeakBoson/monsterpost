<?php
// =============================== My Post Cycle widget ======================================
class MY_CycleWidget extends WP_Widget {
	/** constructor */
	function MY_CycleWidget() {
		parent::WP_Widget(false, $name = 'Cherry - Post Cycle');
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		extract( $args );
		$title    = apply_filters('widget_title', $instance['title']);
		$category = apply_filters('widget_category', $instance['category']);
		$count    = apply_filters('widget_count', $instance['count']);
		$autoplay = apply_filters('widget_autoplay', $instance['autoplay']);
		$speed    = apply_filters('widget_speed', $instance['speed']);
		$speed    = (int)$speed*1000;
		
		echo $before_widget;
			if ( $title ) {
				echo $before_title . $title . $after_title;
			} else {
				echo $before_title . $category . $after_title;
			}

		$random = uniqid();

		if ( !$count ) $count = -1;
		$args = array(
			'showposts'     => $count,
			'category_name' => $category
		);
		$wp_query = new WP_Query( $args );

		if ( $wp_query->have_posts() ) :
	?>

		<script type="text/javascript">
			jQuery(window).load(function() {
				jQuery('#flexslider_<?php echo $random ?>').flexslider({
					animation: "fade",
					slideshow: <?php echo $autoplay; ?>,
					slideshowSpeed: <?php echo $speed; ?>,
					controlNav: false,
					prevText: '',
					nextText: ''
				});
			});
		</script>
		<div id="flexslider_<?php echo $random ?>" class="widget-flexslider flexslider thumbnail">
			<ul class="slides">
			<?php
				// if ( $wp_query->have_posts() ) : 
					while ($wp_query->have_posts()) : 
						$wp_query->the_post();
						if( has_post_thumbnail() ) { ?>
						<li>
						<?php 
							$thumb   = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb, 'full' ); //get img URL
							$image   = aq_resize( $img_url, 300, 200, true ); //resize & crop img
						?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image ?>" alt="<?php the_title(); ?>" /></a>
							<h5 class="hidden-tablet">
								<a href="<?php the_permalink(); ?>"><?php echo my_string_limit_words(get_the_title(), 3); ?></a>
							</h5>
						</li>
						<?php }
						endwhile;
					?>
			</ul><!-- .slides -->
		</div><!-- .flexslider -->
		<div class="text-right indent-bot">
			<a href="<?php echo home_url('/') . $category; ?>/" class="btn btn-primary btn-normal view-all"><?php _e('View All', 'cherry'); ?></a>
		</div>
	<?php 
		endif;
		wp_reset_postdata();
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$defaults   = array( 'title' => '', 'category' => '', 'count' => '', 'autoplay' => 'true', 'speed' => 7);
		$instance   = wp_parse_args( (array) $instance, $defaults );
		$categories = get_categories(); 
		
		$title    = esc_attr($instance['title']);
		$category = esc_attr($instance['category']);
		$count    = esc_attr($instance['count']);
		$autoplay = esc_attr($instance['autoplay']);
		$speed    = esc_attr($instance['speed']);
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'cherry'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

	<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Posts count:', 'cherry'); ?><input class="widefat" style="width:30px; display:block; text-align:center" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

	<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select category:', 'cherry'); ?><br />
		<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" style="width:150px;" >
			<?php 
				foreach ($categories as $cat) {
					$option = '<option value="' .$cat->cat_name. '"';
					if ( $category === $cat->cat_name ) {
						$option .= ' selected="selected"';
					}
					$option .= '>';
					$option .= $cat->cat_name;
					$option .= '</option>';
					echo $option;
				}
			?>
		</select>
		</label>
	</p>

	<p><label for="<?php echo $this->get_field_id('autoplay'); ?>"><?php _e('Animate slider automatically:', 'cherry'); ?><br />
		<select id="<?php echo $this->get_field_id('autoplay'); ?>" name="<?php echo $this->get_field_name('autoplay'); ?>" style="width:150px;" >
			<?php
				$option = '<option value="true"';
				if ($autoplay == 'true') {
					$option .= ' selected="selected"';
				}
				$option .= '>yes</option>';
				$option .= '<option value="false"';
				if ($autoplay == 'false') {
					$option .= ' selected="selected"';
				}
				$option .= '>no</option>';
				echo $option;
			?>
		</select>
		</label>
	</p>

	<p><label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e('Slideshow cycling speed (in sec.):', 'cherry'); ?><input class="widefat" style="width:30px; display:block; text-align:center" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo $speed; ?>" /></label></p>
	<?php
	}
} // class Cycle Widget
?>