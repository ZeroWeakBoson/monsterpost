<?php
/**
 * Related Posts
 *
 */
if ( !function_exists('monster_related_posts') ) {
	function monster_related_posts() {
		ob_start();
		get_template_part('includes/post-formats/related-posts');
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	add_shortcode('related_posts', 'monster_related_posts');
} ?>