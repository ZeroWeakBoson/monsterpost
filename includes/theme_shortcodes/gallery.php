<?php
/**
 * Gallery
 */
function monster_gallery_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'orderby' => 'menu_order',
			'order'   => 'DESC',
			'link'    => '',
			'ids'     => '',
		), $atts )
	);

	$output = '';
	$args = array(
		'orderby'        => $orderby,
		'order'          => $order,
		'include'        => $ids,
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
	);

	global $post;
	$attachments = get_posts( $args );

	if ( $attachments ) {

		$random = uniqid();
		if ( count($attachments) > 8 ) {
			$pagerType = 'short';
		} else {
			$pagerType = 'full';
		}
		$output .= "<script type='text/javascript'>
				jQuery(document).ready(function(){
					jQuery('#bxslider_$random').bxSlider({
						pagerType: '$pagerType'
					});
				});
			</script>";
		$output .= "<ul id='bxslider_$random' class='bxslider unstyled'>";

		foreach( $attachments as $post ) : setup_postdata( $post );

			$attachment_url = wp_get_attachment_image_src( $post->ID, 'full' );
			$url            = $attachment_url['0'];
			$w              = $attachment_url['1'];
			if ( $w >= 800 ) {
				$image = aq_resize($url, 800, 400, true);
			} else {
				$image = aq_resize($url, 600, 400, false);
			}
			$output .= "<li><img src='$image' alt='$post->post_title' /></li>";

		endforeach;
		wp_reset_postdata(); // restore the global $post variable
		$output .= "</ul>";
	}

	return $output;
}
add_shortcode( 'gallery', 'monster_gallery_shortcode' );
?>