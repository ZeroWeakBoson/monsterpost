<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="span8 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="content-inner">
					<?php
						if(isset($_GET['author_name'])) :
							$curauth = get_userdatabylogin($author_name);
						else :
							$curauth = get_userdata(intval($author));
						endif;
					?>

					<?php
						// get all categories and record to array
						$categories = get_categories(); 
						foreach ($categories as $category) {
							$allCategoriesArray[$category->slug] = $category->cat_ID;
						}

						//get all terms (e.g. categories or post tags), then display all posts in each term
						$taxonomy   = 'category'; //  e.g. post_tag, category
						$param_type = 'category__in'; //  e.g. tag__in, category__in
						$term_args  = array(
							'orderby' => 'name',
							'order'   => 'ASC'
						);
						$terms = get_terms($taxonomy, $term_args);
						if ($terms) {
							$catCounter = 0;
							foreach( $allCategoriesArray as $key => $value ) {
								$args = array(
									"$param_type"         => $value,
									'author_name'         => $curauth->display_name,
									'post_type'           => 'post',
									'post_status'         => 'publish',
									'showposts'           => -1,
									'ignore_sticky_posts' => 1
								);
								$my_query = new WP_Query($args);
								if( $my_query->have_posts() ) {
									while ($my_query->have_posts()) : $my_query->the_post();?>
									<?php
									endwhile;
									$catCounter++;
								}
							}
						}
						wp_reset_postdata();  // Restore global post data stomped by the_post().
					?>
					
					<section class="title-section clearfix">
						<?php get_template_part('includes/author-social'); ?>
						<h2 class="title-section-h"><?php echo $curauth->display_name; ?></h2>
						<div class="author-counters clearfix">
							<span class="label label__article">
								<b class="label__value"><?php echo get_the_author_posts(); ?></b>
								<span class="label__txt"><?php _e('Articles', 'cherry'); ?></span>
							</span>
							<span class="label label__category">
								<b class="label__value"><?php echo $catCounter; ?></b>
								<span class="label__txt"><?php _e('Categories', 'cherry'); ?></span>
							</span>
							<span class="label label__comment">
								<b class="label__value"><?php echo author_comment_count($curauth->display_name); ?></b>
								<span class="label__txt"><?php _e('Comments', 'cherry'); ?></span>
							</span>
						</div>
					</section>
					
					<div id="recent-author-posts">
						<h2 class="recent-author-h"><?php _e('Posts by', 'cherry'); ?> <?php echo $curauth->display_name; ?></h2>

					<?php if (have_posts()) : ?>

						<div class="post-tile">
							<div class="row-fluid">
							<?php 
								$post_counter = 0; // main posts counter
								$pair_post    = 1; // counter for pair posts
								$adv_content  = 2; // adv content - output after 2 posts

								while (have_posts()) : the_post();

									// output advertising in the content
									if ( $post_counter == $adv_content ) {
										get_template_part('bnr/foo-content');
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

							<?php else: ?>
							<div class="no-results">
								<?php echo '<h5>' . __('There has been an error.', 'cherry') . '</strong></h5>'; ?>
								<p><?php _e('We apologize for any inconvenience, please', 'cherry'); ?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'cherry'); ?></a> <?php _e('or use the search form below.', 'cherry'); ?></p>
								<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
							</div><!--.no-results-->
						<?php endif; ?>
					</div><!--#recentPosts-->

					<?php get_template_part('includes/post-formats/post-nav'); ?>
				</div>
			</div><!--#content-->
			<?php get_sidebar('author'); ?>
		</div><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>