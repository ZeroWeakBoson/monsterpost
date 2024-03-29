<?php
	$pageobj = get_queried_object();
	$args = array(
		'author'    => $pageobj->post_author,
		'posts_per_page' => 3,
		'post__not_in' => array($post->ID)
	);

	$read_also_query = new WP_Query($args);

	if ( $read_also_query->have_posts() ) { ?>
	<div class="read-also-posts">
		<?php $blog_read_also = of_get_option('blog_read_also'); ?>
		<?php if($blog_read_also){?>
			<h3 class="read-also_h"><?php echo of_get_option('blog_read_also'); ?></h3>
		<?php } else { ?>
			<h3 class="read-also_h"><?php _e('Read Also','cherry');?></h3>
		<?php } ?>
		<ul class="read-also_list unstyled clearfix">
		<?php while ($read_also_query->have_posts()) : $read_also_query->the_post(); ?>
			<li class="read-also_item">
				<div class="inner">
					<time datetime="<?php the_time('Y-m-d\TH:i:s'); ?>"><?php echo get_the_date(); ?></time>
					<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
				</div>
			</li>
		<?php endwhile; ?>
		</ul>
	</div><!-- .read-also-posts -->
<?php
	}
	wp_reset_postdata(); ?>