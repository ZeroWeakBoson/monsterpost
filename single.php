<?php get_header(); ?>
	<div class="container container_single_post">
		<div class="row">
			<div id="content" class="span12">
				<div class="row">
					<div class="span2">
						<?php get_template_part( 'includes/post-formats/post-date' ); ?>
					</div>

					<div class="span10 content-single-post clearfix">
						<?php if ( is_singular() ) : ?>
							<h1 class="post-title"><?php the_title(); ?></h1>
						<?php endif; ?>
						<div class="row">
							<div class="span7">
								<?php if (have_posts()) : while (have_posts()) : the_post();

									$format = get_post_format();
									get_template_part( 'includes/post-formats/'.$format );

									if ( $format == '' )
										get_template_part( 'includes/post-formats/standard' );

									wp_link_pages('before=<div class="pagination">&after=</div>');

									global $tag_array; // from post-date.php
									$filter_array = array('videos', 'books', 'podcasts', 'slideshows'); // tags array from filterable-carousel.php

									if ( array_intersect($filter_array, $tag_array) ) {
										$source = get_post_meta(get_the_ID(), 'tz_source_url', true); ?>
										<div class="source_holder">
											<a href="<?php echo $source; ?>" target="_blank" class="btn btn-primary btn-normal btn-source"><?php _e('Source', 'cherry'); ?></a>
										</div><!--.source_holder-->
									<?php }
								?>

								<div class="post-author clearfix">
									<h3 class="post-author_h"><?php _e('About the Author', 'cherry'); ?></h3>
									<a class="post-author_gravatar" href="<?php echo home_url() . '/author/' . get_the_author(); ?>">
										<?php if ( function_exists('get_avatar') ) { 
											echo get_avatar( get_the_author_meta('email'), '100' );
											echo "<span class='zoom-icon'></span>";
										} ?>
										<span class="post-author_name"><?php the_author(); ?></span>
									</a>
									<div class="post-author_desc">
										<?php the_author_meta('description') ?>
									</div>
								</div><!--.post-author-->

								<div class="feedback_holder clearfix">
									<?php
										echo '<h3>' . __('Enjoyed This Post? Share!', 'cherry') . '</h3>';
										get_template_part('includes/post-formats/social-buttons');
										// wpsocialite_markup();
										echo do_shortcode('[newsletter_form]');
									?>
								</div><!--.feedback_holder-->

								<?php
									// get_template_part( 'includes/post-formats/read-also-posts' );
									echo '<div class="read-also-posts clearfix">' . do_shortcode('[related_posts title="Read Also" num_to_display="3" no_rp_text="No Related Posts"]') . '</div>';

									// If comments are opened.
									if ( comments_open() ) :
										if (function_exists('disqus_embed')) {
											disqus_embed(DISQUS_SHORTNAME);
										} else {
											comments_template('', true);
										}
									else :
										echo '<p class="nocomments">' . __('Comments are closed.', 'cherry') . '</p>';
									endif;

								endwhile; endif; ?>
							</div>

							<div class="span3">
								<div class="sidebar-single">
									<ul class="pager single-pager">
									<?php
										$prev_post = get_previous_post();
										if ( !empty( $prev_post ) ): ?>
										<li class="previous">
											<?php previous_post_link('%link', '<span>' . __('&lsaquo;&nbsp;Previous', 'cherry') . '</span>' . my_string_limit_words($prev_post->post_title, 7)); ?>
										</li>
										<?php endif;

										$next_post = get_next_post();
										if ( !empty( $next_post ) ): ?>
										<li class="next">
											<?php next_post_link('%link', '<span>' . __('Next&nbsp;&rsaquo;', 'cherry') . '</span>' . my_string_limit_words($next_post->post_title, 7)); ?>
										</li>
										<?php endif; ?>
									</ul><!--.single-pager -->

									<?php
									if (function_exists('wpp_get_mostpopular')) { ?>
										<div class="custom-popular-posts">
											<h3><?php _e('Popular Posts', 'cherry'); ?></h3>
											<?php
												$args = array(
													'range'                => 'weekly',
													'limit'                => 5,
													'order_by'             => 'views',
													'stats_comments '      => 0,
													'stats_date'           => 0,
													'stats_author'         => 1,
													// 'stats_date_format' => 'M j, Y',
													'post_type'            =>'post',
													'do_pattern'           => 1,
													'pattern_form'         => '{summary}{stats}{title}'
												);
												wpp_get_mostpopular($args);
											?>
										</div><!--.custom-popular-posts-->
									<?php } ?>
								</div><!--.sidebar-single-->
							</div>
						</div><!--.row-->
					</div><!--content-single-post-->
				</div><!--.row-->
			</div><!--#content-->
		</div><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>