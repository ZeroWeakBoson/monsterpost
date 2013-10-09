<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>

	<?php $url = get_post_meta(get_the_ID(), 'tz_link_url', true); ?>

	<?php if (!is_singular()) :
		get_template_part('includes/post-formats/post-meta');
	?>
		<header class="post-header">
			<h4 class="post-title">
				<a target="_blank" href="<?php echo $url; ?>" title="<?php _e('Permalink to:', 'cherry');?> <?php echo $url; ?>"><span><?php the_title(); ?></span></a>
			</h4>
		</header>
	<?php 
	else :
		get_template_part('includes/post-formats/single-post-meta');
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
	<?php else :?>

	<!-- Post Content -->
	<div class="post_content">
		<?php the_content(''); ?>
		<div class="clear"></div>
	</div>
	<!-- //Post Content -->

	<?php endif; ?>

</article><!--//.post-holder-->