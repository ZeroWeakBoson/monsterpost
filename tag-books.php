<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="span8 tag-books <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="content-inner">
					<?php 
						get_template_part('title');
						echo tag_description(); // displays the tag's description from the Wordpress admin

						if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
								<?php get_template_part('includes/post-formats/post-thumb'); ?>
								<header class="post-header">
									<h3><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'cherry');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
								</header>
								<div class="tag_excerpt">
									<?php if ( has_excerpt() ) {
										the_excerpt();
									} else {
										$content = get_the_content();
										echo my_string_limit_words($content, 48);
									} ?>
								</div>
							</article>
							<hr>
							<?php
							endwhile;
							else: ?>
								<div class="no-results">
									<?php echo '<h5>' . __('There has been an error.', 'cherry') . '</strong></h5>'; ?>
									<p><?php _e('We apologize for any inconvenience, please', 'cherry'); ?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'cherry'); ?></a> <?php _e('or use the search form below.', 'cherry'); ?></p>
									<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
								</div><!--.no-results-->
							</div>
						<?php endif;
					?>
					<?php get_template_part('includes/post-formats/post-nav'); ?>
				</div><!--.content-inner-->
			</div><!--#content-->
			<?php get_sidebar(); ?>
		</div><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>