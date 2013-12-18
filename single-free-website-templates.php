<div class="container container_free_post">
	<div class="row">
		<div id="content" class="span12">
			<div class="content-inner">
				<?php if ( is_singular() ) : ?>
					<h1 class="post-title"><?php the_title(); ?></h1>
					<ul class="breadcrumb breadcrumb__t">
						<li><a href="<?php echo home_url('/free-website-templates/'); ?>"><?php _e('All Free Website Templates', 'cherry'); ?></a></li>
						<!-- <li class="divider"></li>
						<li><?php echo get_the_term_list( $post->ID, 'type', '', ', ', '' ); ?></li> -->
						<li class="divider"></li>
						<li class="active"><?php the_title(); ?></li>
					</ul>
					<?php
					?>
				<?php endif; ?>
				<div class="row">
					<div class="span7">
						<?php if (have_posts()) : while (have_posts()) : the_post();

							// output featured image or gallery
							monster_free_template_gallery();

							// get post Type
							if ( has_term( '', 'type', $post->ID ) ) {
								$types = get_the_terms( $post->ID, 'type' );

								if ( $types && !is_wp_error( $types ) ) :

									foreach ( $types as $type ) {
										$type_val = array(
												array(
														'taxonomy' => 'type',
														'field'    => 'slug',
														'terms'    => $type->slug
												)
										);
										break;
									}
								endif;
							}
							if ( !isset($type_val) ) $type_val = '';

							// get post Category
							$cats = get_the_category( $post->ID );
							if ( $cats ) {
								$separator = ', ';
								foreach ( $cats as $cat ) {
									if ( ($cat->slug == 'free-stuff') || ($cat->slug == 'free-website-templates') ) continue;
									$cat_val = $cat->term_id;
								}
							}
							if ( !isset($cat_val) ) {
								$free_cat_obj = get_category_by_slug( 'free-website-templates' );
								$cat_val      = $free_cat_obj->term_id;
							}

							$args = array(
								'id'   => $post->ID,
								'type' => $type_val,
								'cat'  => $cat_val
							);

							// output related posts
							monster_free_template_related_posts( $args );
						?>

						<div class="feedback_holder clearfix">
							<?php
								echo "<h3>" . __('Enjoyed This Free Template? Share!', 'cherry') . "</h3>";
								get_template_part('includes/post-formats/social-buttons');
							?>
						</div><!--.feedback_holder-->

						<?php endwhile; endif; ?>
					</div>

					<div class="span4">
						<dl class="free-desc-list clearfix">
							<?php if ( has_term( '', 'type', $post->ID ) ) {
								echo '<dt>' . __('Type:', 'cherry') . '&nbsp;</dt>';
								echo '<dd>' . get_the_term_list( $post->ID, 'type', '', ', ', '' ) . '</dd>';
							} ?>
							<dt><?php _e('Category:', 'cherry'); ?>&nbsp;</dt>
							<dd><?php
									if ( $cats ) {
										$separator = ' ';
										$output = '';
										foreach ( $cats as $cat ) {
											if ( ($cat->slug == 'free-stuff') || ($cat->slug == 'free-website-templates') ) continue;
											$output .= '<a href="'.get_category_link( $cat->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s category" ), $cat->name ) ) . '">'.$cat->cat_name.'</a>'.$separator;
										}
										echo trim( $output, $separator );
									}
								?>
							</dd>
							<?php
								$blog_post = get_post_meta( get_the_ID(), 'tz_blog_post_url', true );
								$lide_demo = get_post_meta( get_the_ID(), 'tz_live_demo_url', true );
								$download  = get_post_meta( get_the_ID(), 'tz_download_url', true );

								if ( !empty($blog_post) || !empty($lide_demo) || !empty($download) ) {
									echo '<dd>';
								}

								if ( !empty($blog_post) ) {
									echo '<a class="btn btn-normal btn-primary" href="' . $blog_post . '" target="_blank">' . __('Blog Post', 'cherry') . '</a>&nbsp;';
								}
								if ( !empty($lide_demo) ) {
									echo '<a class="btn btn-normal btn-primary" href="' . $lide_demo . '" target="_blank">' . __('Live Demo', 'cherry') . '</a>&nbsp;';
								}
								if ( !empty($download) ) {
									echo '<a class="btn btn-normal btn-primary" href="' . $download . '" target="_blank">' . __('Download', 'cherry') . '</a>&nbsp;';
								}
								if ( !empty($blog_post) || !empty($lide_demo) || !empty($download) ) {
									echo '</dd>';
								}
							?>
						</dl>
						<?php the_content(''); ?>
					</div>
				</div><!--.row-->
			</div><!--content-inner-->
		</div><!--#content-->
	</div><!--.row-->
</div><!--.container-->