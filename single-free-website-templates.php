<div class="container container_single_post container_free_post">
	<div class="row">
		<div id="content" class="span12">
			<div class="content-inner">
				<?php if ( is_singular() ) : ?>
					<h1 class="post-title"><?php the_title(); ?></h1>
					<ul class="breadcrumb breadcrumb__t">
						<li><a href="<?php echo home_url('/free-website-templates/'); ?>"><?php _e('All Free Website Templates', 'cherry'); ?></a></li>
						<li class="divider">/</li>
						<li><a href="#"></a></li>
						<li class="divider">/</li>
						<li class="active"><?php the_title(); ?></li>
					</ul>
					<?php 
					?>
				<?php endif; ?>
				<div class="row">
					<div class="span7">
						<?php if (have_posts()) : while (have_posts()) : the_post();

							monster_free_template_gallery();

							if (has_term('type', '', $post->ID)) { ?>
								<small>adad</small>
							<?php }

							$terms = get_terms( 'type' );
							if ( is_array($terms) ) {
								$type_val = array(
									array(
										'taxonomy' => 'type',
										'field'    => 'slug',
										'terms'    => $terms[0]->slug
									)
								);
							} else {
								$type_val = '';
							}

							// $cat_val = get_option( 'select-filter-cat' );
							$cat_val = get_post_meta( $post->ID, 'filter-cat', true );
							if ( empty($cat_val) ) {
								$idObj   = get_category_by_slug( 'free-website-templates' );
								$cat_val = $idObj->term_id;
							}

							$args = array(
								'id'   => $post->ID,
								'type' => $type_val,
								'cat'  => $cat_val
							);
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
							<?php 
								if ( is_array($terms) ) {
									echo "<dt>" . __('Type:', 'cherry') . "</dt>";
									echo "<dd>&nbsp;" . $terms[0]->name . "</dd>";
								}
							?>
							<dt><?php _e('Category:', 'cherry'); ?></dt>
							<dd><?php $cat = get_category( $cat_val ); echo '&nbsp;' . $cat->name; ?></dd>
							<?php 
								$blog_post = get_post_meta( get_the_ID(), 'tz_blog_post_url', true );
								$lide_demo = get_post_meta( get_the_ID(), 'tz_live_demo_url', true );
								$download  = get_post_meta( get_the_ID(), 'tz_download_url', true );

								if ( !empty($blog_post) || !empty($lide_demo) || !empty($download) ) {
								}
								echo '<dd>';

								if ( !empty($blog_post) ) {
									echo '<a class="btn btn-normal btn-primary" href="' . $blog_post . '" target="_blank">' . __('Blog Post', 'cherry') . '</a>&nbsp;';
								}
								if ( !empty($lide_demo) ) {
									echo '<a class="btn btn-normal btn-primary" href="' . $lide_demo . '" target="_blank">' . __('Live Demo', 'cherry') . '</a>&nbsp;';
								}
								if ( !empty($download) ) {
									echo '<a class="btn btn-normal btn-primary" href="' . $download . '" target="_blank">' . __('Download', 'cherry') . '</a>&nbsp;';
								}
								echo '</dd>';
							?>
						</dl>
						<?php the_content(''); ?>
					</div>
				</div><!--.row-->
			</div><!--content-inner-->
		</div><!--#content-->
	</div><!--.row-->
</div><!--.container-->