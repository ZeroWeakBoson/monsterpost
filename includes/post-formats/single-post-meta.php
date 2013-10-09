<?php $post_meta = of_get_option('post_meta'); ?>
<?php if ($post_meta=='true' || $post_meta=='') { ?>
	<!-- Post Meta -->
	<div class="post_meta">
		<span class="post_author"><?php _e('Posted by ', 'cherry') . the_author_posts_link() ?></span>
		<span class="post_comment">
			<i class="icon-bubble"></i>
			<?php if (function_exists('disqus_count')) {
				disqus_count(DISQUS_SHORTNAME);
			} else {
				comments_popup_link('No comments', '1 comment', '% comments', 'comments-link', 'Comments are closed');
			} ?>
		</span>
	</div>
	<!--// Post Meta -->
<?php } ?>