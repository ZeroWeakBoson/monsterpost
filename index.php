<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="span8 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="content-inner">
					<section class="title-section clearfix">
						<!-- <ul id="tm-followers" class="followers-total unstyled clearfix"></ul> -->
						<?php 
							$blog_text = of_get_option('blog_text');
							if( $blog_text ){
								echo '<h2 class="title-header">' . of_get_option('blog_text') . '</h2>';
							}
						?>
					</section><!--.title-section-->

					<?php get_template_part('top-posts');

					query_posts(
						array(
							'post_status'         => 'publish',
							'ignore_sticky_posts' => 1,
							'orderby'             => 'date',
							'order'               => 'DESC',
							'tax_query'           => array(
								array(
									'taxonomy' => 'category',
									'field'    => 'slug',
									'terms'    => array( 'learn-web-design' ),
									'operator' => 'NOT IN'
								)
							)
							// 'meta_query'  => array(
							// 	array(
							// 		'key'     => 'tz_filter',
							// 		'compare' => 'NOT EXISTS'
							// 	)
							// )
						)
					);

					if (have_posts()) : ?>

					<div class="post-tile">
						<div class="row-fluid">
						<?php 
							$post_counter = 0; // main posts counter
							$pair_post    = 1; // counter for pair posts
							$carousel     = 4; // filterable carousel - output after 4 posts
							$adv_content  = 2; // adv content - output after 2 posts

							while (have_posts()) : the_post();

								// output carousel in the content
								if ( $post_counter == $carousel ) {
									get_template_part('filterable-carousel');
								}
								
								if ( $post_counter == $adv_content ) {
									// output advertising in the content
									if ( of_get_option('bnr_content') ) {
										get_template_part('bnr/foo-content');
									}
								}

								if ( $pair_post > 2 ) {
									echo '<div class="post-tile">';
									echo '<div class="row-fluid">';
									$pair_post = 1;
								} ?>

								<div class="span6">
								<?php 
									// The following determines what the post format is and shows the correct file accordingly
									$format = get_post_format();
									get_template_part( 'includes/post-formats/'.$format );

									if ($format == '')
										get_template_part( 'includes/post-formats/standard' );
								?>
								</div>
								<?php if ( $pair_post == 2 ) {
									echo '</div><!--.row-fluid-->';
									echo '</div><!--.post-tile-->';
								}
								$pair_post++;
								$post_counter++;
								endwhile;

								if ( $post_counter % 2 ) {
									echo '</div><!--.row-fluid-->';
									echo '</div><!--.post-tile-->';
								} ?>

								<div class="post-control">
									<a href="archives/" class="btn btn-primary btn-normal ladda-button" data-style="expand-left">
										<span class="ladda-label"><?php _e('Next Page &nbsp;&rsaquo;&nbsp;', 'cherry') ?></span>
									</a>
								</div><!--.post-control-->

								<?php wp_reset_query(); ?>

							<?php else: ?>
							<div class="no-results">
								<?php echo '<h5>' . __('There has been an error.', 'cherry') . '</strong></h5>'; ?>
								<p><?php _e('We apologize for any inconvenience, please', 'cherry'); ?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'cherry'); ?></a> <?php _e('or use the search form below.', 'cherry'); ?></p>
								<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
							</div><!--.no-results-->
					<?php endif; ?>
				</div><!--.content-inner-->
			</div><!--#content-->
			<?php get_sidebar(); ?>
		</div><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>