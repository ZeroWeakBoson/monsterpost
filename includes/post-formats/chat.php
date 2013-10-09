<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>

	<?php if (!is_singular()) :
		get_template_part('includes/post-formats/post-meta');
	?>
	<header class="post-header">
		<h4 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'cherry');?> <?php the_title(); ?>"><?php the_title(); ?></a></h4>
	</header>
	<?php endif; ?>

	<?php if (is_singular()) :
		get_template_part('includes/post-formats/single-post-meta');

		if ( has_excerpt() ) {
			echo '<div class="post_excerpt">';
			the_excerpt();
			echo '</div>';
		}
	endif;

	if (!is_singular()) :
		$post_excerpt = of_get_option('post_excerpt');

			if ($post_excerpt == 'true') {
				$excerpt       = get_the_excerpt();
				$excerpt_count = (of_get_option('excerpt_count')=='') ? 20 : of_get_option('excerpt_count');
			?>
			<!-- Post Content -->
			<div class="post_content">
				<div class="excerpt"><?php echo my_string_limit_words($excerpt, $excerpt_count); ?></div>
			</div>
			<!-- //Post Content -->
		<?php } ?>
	<?php else : ?>

	<!-- Post Content -->
	<div class="post_content">
		<?php the_content(''); ?>
		<div class="clear"></div>
	</div>
	<!-- //Post Content -->

	<?php endif; ?>

</article><!--//.post__holder-->