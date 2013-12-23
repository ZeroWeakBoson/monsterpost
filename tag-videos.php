<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="span8 tag-videos <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="content-inner">
					<?php 
						get_template_part('title');
						echo tag_description(); // displays the tag's description from the Wordpress admin

						global $query_string;
						parse_str($query_string, $args);
						$args['category_name'] = 'watch-learn';
						query_posts( $args );

						if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
								<?php get_template_part('includes/post-formats/post-thumb'); ?>
								<header class="post-header">
									<h3><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'cherry');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
								</header>

								<!--?php $video_source = htmlspecialchars_decode( get_post_meta( $post->ID, 'tz_video_source', true ) );
									if ( !empty($video_source) ) {

										if ( strpos( $video_source, 'http' ) !== false ) {
											$start = strpos( $video_source, 'http' );

											if ( strpos( $video_source, '][' ) !== false ) {
												$len = strpos( $video_source, '][' ) - $start - 1;
												$src = substr( $video_source, $start, $len );
												$attr = array( 'src' => esc_url($src) );

												if ( function_exists('wp_video_shortcode') ) {
													echo '<div class="source_holder source__video">' . wp_video_shortcode( $attr ) . '</div>';
												}
											} else {
												$src = substr( $video_source, $start );

												if (function_exists('wp_oembed_get')) {
													echo '<div class="source_holder source__video">' . wp_oembed_get( esc_url($src) ) . '</div>';
												}
											}
										}
									}
								?-->
								<!-- Post Content -->
								<div class="post_content">
									<div class="excerpt excerpt__shortcode">
										<?php if ( has_excerpt() ) {
											the_excerpt();
										} else {
											$content = get_the_content();
											echo my_string_limit_words($content, 48);
										} ?>
									</div>
								</div>
								<!-- //Post Content -->
							</article>
							<hr>
							<?php
							endwhile;
							wp_reset_query();
							else: ?>
								<div class="no-results">
									<?php echo '<h5>' . __('There has been an error.', 'cherry') . '</strong></h5>'; ?>
									<p><?php _e('We apologize for any inconvenience, please', 'cherry'); ?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'cherry'); ?></a> <?php _e('or use the search form below.', 'cherry'); ?></p>
									<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
								</div><!--.no-results-->
						<?php endif;
					?>
					<?php get_template_part('includes/post-formats/post-nav'); ?>
				</div>
			</div><!--#content-->
			<?php get_sidebar(); ?>
		</div><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>