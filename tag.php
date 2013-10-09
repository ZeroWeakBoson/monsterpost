<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="span8 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="content-inner">
					<?php 
						get_template_part('title');
						echo tag_description(); // displays the tag's description from the Wordpress admin
					?>
					<div class="post-tile row-fluid">
					<?php 
						$post_counter 	= 0; // main posts counter
						$pair_post 		= 1; // counter for pair posts
						$adv_content 	= 2; // adv content - output after 2 posts
					
						if (have_posts()) : while (have_posts()) : the_post();
							
							// output advertising in the content
							if ( $post_counter == $adv_content ) {
								get_template_part('bnr/foo-content');
							}
					
							if ( $pair_post > 2 ) {
								echo '<div class="post-tile row-fluid">';
								$pair_post = 1;
							}?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder span6'); ?>>
								<?php get_template_part('includes/post-formats/post-thumb'); ?>
								<?php get_template_part('includes/post-formats/post-meta'); ?>
								<header class="post-header">
									<h4 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'cherry');?> <?php the_title(); ?>"><?php the_title(); ?></a></h4>
								</header>
							</article>
							<?php if ( $pair_post == 2 ) {
								echo '</div>'; // .row-fluid
							}
							$pair_post++;
							$post_counter++;
							endwhile;
							else: ?>
								<div class="no-results">
									<?php echo '<h5>' . __('There has been an error.', 'cherry') . '</strong></h5>'; ?>
									<p><?php _e('We apologize for any inconvenience, please', 'cherry'); ?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'cherry'); ?></a> <?php _e('or use the search form below.', 'cherry'); ?></p>
									<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
								</div><!--.no-results-->
							</div>
						<?php endif;
						
						if ( $post_counter % 2 ) {
							echo '</div>'; // .row-fluid
						}
					?>
					<?php get_template_part('includes/post-formats/post-nav'); ?>
				</div>
			</div><!--#content-->
			<?php get_sidebar(); ?>
		</div><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>