<?php
/**
 * Post Cycle
 *
 */
if ( !function_exists('monster_post_cycle') ) {
	function monster_post_cycle( $atts ) {
		extract(shortcode_atts(array(
				'num'              => '3',
				'effect'           => 'slide',
				'thumb_width'      => '670',
				'thumb_height'     => '385',
				'category'         => '',
				'pagination'       => 'true',
				'navigation'       => 'true',
				'custom_class'     => ''
		), $atts));
		
		$type_post         = 'post';
		$slider_pagination = $pagination;
		$slider_navigation = $navigation;
		$i                 = 0;
		$rand              = rand();

		global $post;
		$args = array(
			'post_type'      => $type_post,
			'category_name'  => $category,
			'posts_per_page' => -1
		);

		$latest = get_posts($args);
		if (empty($latest)) return;

		$output = '<script type="text/javascript">
					jQuery(window).load(function() {
						jQuery("#flexslider_'.$rand.'").flexslider({
							animation: "'.$effect.'",
							smoothHeight : true,
							directionNav: '.$slider_navigation.',
							controlNav: '.$slider_pagination.'
						});
					});';
		$output .= '</script>';
		$output .= '<div id="flexslider_'.$rand.'" class="flexslider no-bg '.$custom_class.'">';
			$output .= '<ul class="slides">';
			$i = 1;

			foreach($latest as $key => $post) {
				setup_postdata($post);

				if ( $num == -1 ) {
					$num = count($latest);
				}
				
				if ( $num >= $i ) {

					if ( has_post_thumbnail($post->ID) ){
						$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
						$url            = $attachment_url['0'];
						$image          = aq_resize($url, $thumb_width, $thumb_height, true);
						$output .= '<li><figure class="featured-thumbnail"><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
						$output .= '<img src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
						$output .= '</a></figure></li>';
						$i++;
					} else {

						$thumbid = 0;
						$thumbid = get_post_thumbnail_id($post->ID);

						$images = get_children( array(
							'orderby'        => 'menu_order',
							'order'          => 'ASC',
							'post_type'      => 'attachment',
							'post_parent'    => $post->ID,
							'post_mime_type' => 'image',
							'post_status'    => null,
							'numberposts'    => -1
						) ); 

						if ( $images ) {

							$k = 0;
							//looping through the images
							foreach ( $images as $attachment_id => $attachment ) {

								$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' ); // returns an array
								$img = aq_resize( $image_attributes[0], $thumb_width, $thumb_height, true ); //resize & crop img
								$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
								$image_title = $attachment->post_title;

								if ( $k == 0 ) {
									$output .= '<li><figure class="featured-thumbnail">';
									$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
									$output .= '<img src="'.$img.'" alt="'.get_the_title($post->ID).'" />';
									$output .= '</a></figure></li>';
								} break;
								$k++;
							}
							$i++;
						}
					}
				}
			}
			wp_reset_postdata();
			$output .= '</ul>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('post_cycle', 'monster_post_cycle');
}?>