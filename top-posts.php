<?php 
	$i = 0;
	global $post;

	// write $post to temp variable $tmp_post
	$tmp_post = $post;
	$args = array( 
		'posts_per_page' => 3,
		'orderby'        => 'post_date',
		'order'          => 'DESC',
		'meta_key'       => 'tz_top_check',
		'meta_value'     => 'true'
	);
	$top_posts = get_posts( $args );
	if ( !empty($top_posts) ) { ?>
		<div class="top-posts clearfix">
			<?php 
				foreach( $top_posts as $post ) : setup_postdata($post); 

					if ( $i == 0 ) { ?>
						<div class="left-side">
					<?php } 
					if ( $i == 1 ){ ?>
						<div class="right-side">
					<?php }

						$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
						$url = $attachment_url['0'];
						if ( !$i ) {
							$image = aq_resize($url, 435, 268, true);
						} else {
							$image = aq_resize($url, 235, 140, true);
						} ?>
						<div class="top-posts-item">
							<?php if ( isset($image) ) { ?>
								<figure class="featured-thumbnail thumbnail">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<img  src="<?php echo $image; ?>" alt="<?php the_title(); ?>" />
									</a>
									<?php 
										$categories = get_the_category();
										if( !empty($categories) ){ 
											$category = $categories[0];
											echo '<span class="post-cat">'.$category->cat_name.'</span>';
										} ?>
								</figure>
							<?php } ?>
							<div class="post_meta">
								<?php _e('by ', 'cherry') . the_author_posts_link() ?>&nbsp;&nbsp;|&nbsp;&nbsp;<time datetime="<?php the_time('Y-m-d\TH:i:s'); ?>"><?php echo get_the_date(); ?></time>
							</div>
							<?php 
								if (!has_post_thumbnail()) {
									$categories = get_the_category();
									if( !empty($categories) ){
										$category = $categories[0];
										echo __('in ', 'cherry') . '<a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>';
									}
								}
							?>
							<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
							<p class="excerpt">
								<?php 
									$excerpt = get_the_excerpt();
									if ( $excerpt ) {
										echo my_string_limit_words($excerpt, 30);
									}
								?>
							</p>
						</div>

					<?php if ( $i == 0 ) { ?>
						</div>
					<?php }

				$i++;
				endforeach;
				
			if ( $i > 1 ) { ?>
				</div>
			<?php } ?>
		</div>
<?php }
	// return value $post
	$post = $tmp_post;
?>