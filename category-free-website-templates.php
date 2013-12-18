<?php
/**
 * Free Website Templates category
 */
get_header();
?>
	<div class="container">
		<div id="content">
			<div class="content-inner">
				<section class="title-section">
					<h1 class="title-header"><?php single_cat_title('Free Website Category: '); ?></h1>
				</section>

				<div id="allthatjunk">
					<?php $cat_desc = category_description();
					if (!empty($cat_desc)) {
						echo '<div class="category-desc">' . $cat_desc . '</div>';
					} ?>

					<?php if ( have_posts() ):
						$counter = 1;
						echo '<div class="row-fluid">';

						while ( have_posts() ): the_post(); 

						if ( $counter > 4 ) {
							echo '<div class="row-fluid">';
							$counter = 1;
						} ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class('post__holder span3'); ?>>
					<?php 
						$post_id        = get_the_ID();
						$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
						$url            = $attachment_url['0'];
						$image          = aq_resize($url, 254, 134, true);

						if ($image) {
							echo '<figure class="thumbnail">';
								echo '<a href="' . get_permalink( $post_id ) . '" title="Permanent Link to ' . the_title('', '', false) . '">';
									echo '<img src="' . $image . '" alt="' . the_title('', '', false) . '">';
								echo '</a>';
							echo '</figure>';
						}

						echo '<header class="post-header">';
							echo '<h4>';
								echo '<a href="' . get_permalink( $post_id ) . '" title="Permanent Link to ' . the_title('', '', false) . '">'. the_title('', '', false) .'</a>';
							echo '</h4>';
						echo '</header>';

						if ( $counter == 4 ) echo '</div><!--.row-fluid--><hr>';
							$counter++;
					?>
					</div><!--.post__holder-->

					<?php endwhile;
						if ( $counter < 4 ) {
							echo '</div><!--.row-fluid--><hr>';
						}
						get_template_part('includes/post-formats/post-nav');
					?>

					<?php else: ?>

						<div class="no-results">
							<?php echo '<h5>' . __('There has been an error.', 'cherry') . '</h5>'; ?>
							<p><?php _e('We apologize for any inconvenience, please', 'cherry'); ?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'cherry'); ?></a> <?php _e('or use the search form below.', 'cherry'); ?></p>
							<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
						</div><!--.no-results-->

					<?php endif; ?>
				</div><!--.allthatjunk-->
			</div><!--.content-inner-->
		</div><!--#content-->
	</div><!--.container-->
<?php get_footer(); ?>