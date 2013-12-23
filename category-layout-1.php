<?php
/**
 *
 * Layout for special categories
 *
 **/
$cat_desc = category_description();
if (!empty($cat_desc)) {
	echo '<div class="category-desc">' . $cat_desc . '</div>';
}

// query_posts(
// 	array(
// 		'post_status' => 'publish',
// 		'orderby'     => 'date',
// 		'order'       => 'DESC',
// 		'meta_query'  => array(
// 			array(
// 				'key'     => 'tz_filter',
// 				'compare' => 'NOT EXISTS'
// 			)
// 		)
// 	)
// );

if (have_posts()) : ?>

	<div class="post-tile row-fluid">
<?php
	$post_counter = 0; // main posts counter
	$pair_post    = 1; // counter for pair posts
	$adv_content  = 2; // adv content - output after 2 posts

		while (have_posts()) : the_post();

			if ( $post_counter == $adv_content ) {
				// output advertising in the content
				if ( of_get_option('bnr_content') ) {
					get_template_part('bnr/foo-content');
				}
			}

			if ( $pair_post > 2 ) {
				echo '<div class="post-tile row-fluid">';
				$pair_post = 1;
			} ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder span6'); ?>>
				<?php
					get_template_part('includes/post-formats/post-thumb');
					get_template_part('includes/post-formats/post-meta');
				?>
				<header class="post-header">
					<h4 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'cherry');?> <?php the_title(); ?>"><?php the_title(); ?></a></h4>
				</header>
			</article>
			<?php if ( $pair_post == 2 ) {
				echo '</div><!--.post-tile-->';
			}
			$pair_post++;
			$post_counter++;
		endwhile;

		if ( $post_counter % 2 ) {
			echo '</div><!--.post-tile-->';
		}
	get_template_part('includes/post-formats/post-nav');
	// wp_reset_query();
	else: ?>
		<div class="no-results">
			<?php echo '<h5>' . __('There has been an error.', 'cherry') . '</strong></h5>'; ?>
			<p><?php _e('We apologize for any inconvenience, please', 'cherry'); ?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'cherry'); ?></a> <?php _e('or use the search form below.', 'cherry'); ?></p>
			<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
		</div><!--.no-results-->
	<?php endif; ?>