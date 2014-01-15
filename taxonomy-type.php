<?php
/**
 * Types taxonomy archive
 */
get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
	<div class="container">
		<div id="content">
			<div class="content-inner">
				<!-- <section class="title-section">
					<h1 class="title-header"><?php echo ucwords(str_replace('-', ' ', apply_filters( 'the_title', $term->slug ))); ?></h1>
				</section> -->
				<section class="title-section">
					<h1 class="title-header">
					<?php
						$wpseo_taxonomy_meta = get_option( 'wpseo_taxonomy_meta', false );

						if ( is_array($wpseo_taxonomy_meta) && array_key_exists('type', $wpseo_taxonomy_meta) ) {

							$wpseo_type_meta = $wpseo_taxonomy_meta['type'];

							if ( array_key_exists($term->term_id, $wpseo_type_meta) ) {

								$end = strpos($wpseo_type_meta[$term->term_id]['wpseo_title'], '%');
								if ( $end === FALSE ) {
									echo $wpseo_type_meta[$term->term_id]['wpseo_title'];
								} else {
									echo substr( $wpseo_type_meta[$term->term_id]['wpseo_title'], 0, $end );
								}
							} else {
								single_cat_title();
							}
						} else {
							single_cat_title();
						}
					?>
					</h1>
				</section>

				<div id="allthatjunk">
					<?php if ( !empty( $term->description ) ): ?>
					<div class="archive-description">
						<?php echo esc_html($term->description); ?>
					</div>
					<?php endif; ?>

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