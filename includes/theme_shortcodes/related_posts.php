<?php
/**
 * Related Posts
 *
 */
if (!function_exists('related_posts_shortcode')) {
	function related_posts_shortcode() {
		ob_start();
		get_template_part('includes/post-formats/related-posts');
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	add_shortcode('related_posts', 'related_posts_shortcode');
}?>