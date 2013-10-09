<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="span8 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="content-inner">
					<?php 
						get_template_part('title');

						if (have_posts()) : while (have_posts()) : the_post();

							// The following determines what the post format is and shows the correct file accordingly
							$format = get_post_format();
							get_template_part( 'includes/post-formats/'.$format );
							if ($format == '')
								get_template_part( 'includes/post-formats/standard' );
						?>
						<hr>
					<?php endwhile; else: ?>
						<div class="no-results">
							<?php echo '<h5>' . __('There has been an error.', 'cherry') . '</strong></h5>'; ?>
							<p><?php _e('We apologize for any inconvenience, please', 'cherry'); ?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'cherry'); ?></a> <?php _e('or use the search form below.', 'cherry'); ?></p>
							<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
						</div><!--.no-results-->
					<?php endif;
					get_template_part('includes/post-formats/post-nav'); ?>
				</div><!--.content-inner-->
			</div><!-- #content -->
			<?php get_sidebar(); ?>
		</div><!--.row-->
	</div><!--.container-->  
<?php get_footer(); ?>