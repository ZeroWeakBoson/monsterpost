<?php 
/**
 * Template Name: Free Templates
 */
get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="span8 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="content-inner">
					<?php
						get_template_part('title');

						$args = array(
							'category_name'  => 'post-formats'
						);

						// The Query
						query_posts($args);

						// The Loop
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder post__holder_cat'); ?>>
								<?php
									$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
									$url            = $attachment_url['0'];
									$image          = aq_resize($url, 630, 335, true);

									if ($image) { ?>
										<figure class="featured-thumbnail thumbnail large"><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"></a></figure>
									<?php } ?>

								<header class="post-header">
									<h3><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'cherry');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
									<?php get_template_part('includes/post-formats/post-meta'); ?>
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
						<?php }
							get_template_part('includes/post-formats/post-nav');
						} else { ?>
							<div class="no-results">
								<?php echo '<p><strong>' . __('There has been an error.', 'cherry') . '</strong></p>'; ?>
								<p><?php _e('We apologize for any inconvenience, please', 'cherry'); ?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'cherry'); ?></a> <?php _e('or use the search form below.', 'cherry'); ?></p>
								<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
							</div><!--no-results-->
					<?php }

						// Restore original Post Data
						wp_reset_query();
					?>
				</div><!--.content-inner-->
			</div><!--#content-->
			<?php get_sidebar(); ?>
		</div><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>