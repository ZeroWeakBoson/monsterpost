<?php
// Reference : http://codex.wordpress.org/Function_Reference/wp_get_post_tags
// we are using this function to get an array of tags assigned to current post
$tags = wp_get_post_tags($post->ID);

if ($tags) {
	$tag_ids = array();

	foreach($tags as $individual_tag)
		$tag_ids[] = $individual_tag->term_id;

	$args = array(
		'tag__in'             => $tag_ids,
		'post__not_in'        => array($post->ID),
		'posts_per_page'      => 3, // these are the number of related posts we want to display
		'ignore_sticky_posts' => 1 // to exclude the sticky post
	);
	// WP_Query takes the same arguments as query_posts
	$related_query = new WP_Query($args);

	if ( $related_query->have_posts() ) { ?>
	<div class="related-posts">
		<h3 class="related-posts_h"><?php _e('Related Posts','cherry');?></h3>
		<ul class="related-posts_list unstyled">
		<?php
			while ($related_query->have_posts()) : $related_query->the_post();
			?>
			<li class="related-posts_item">
				<?php if ( has_post_thumbnail() ) { ?>
					<?php
						$thumb   = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
						$image   = aq_resize( $img_url, 180, 180, true ); //resize & crop img
					?>
					<figure class="thumbnail featured-thumbnail">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image ?>" alt="<?php the_title(); ?>" /></a>
				<?php } else { ?>
					<figure class="thumbnail featured-thumbnail">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/empty_thumb.gif" alt="<?php the_title(); ?>" /></a>
				<?php } ?>
					<div class="desc hidden-phone">
						<time datetime="<?php the_time('Y-m-d\TH:i:s'); ?>"><?php echo get_the_date(); ?></time>
						<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
					</div>
				</figure>
			</li>
			<?php
			endwhile;
		?>
		</ul>
	</div><!-- .related-posts -->
	<?php }
	wp_reset_query(); // to reset the loop : http://codex.wordpress.org/Function_Reference/wp_reset_query
} ?>