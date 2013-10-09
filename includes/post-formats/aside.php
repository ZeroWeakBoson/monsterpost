<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>

	<?php if (!is_singular()) :
		get_template_part('includes/post-formats/post-meta');
	else :
		get_template_part('includes/post-formats/single-post-meta');
	endif; ?>

	<!-- Post Content -->
	<div class="post_content">
		<?php the_content(''); ?>
		<div class="clear"></div>
	</div>

</article><!--//.post__holder-->