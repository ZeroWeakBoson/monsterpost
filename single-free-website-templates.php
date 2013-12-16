<div class="container container_single_post container_free_post">
	<div class="row">
		<div id="content" class="span12">
			<div class="content-inner">
				<?php if ( is_singular() ) : ?>
					<h1 class="post-title"><?php the_title(); ?></h1>
				<?php endif; ?>
				<div class="row">
					<div class="span7">
						<?php if (have_posts()) : while (have_posts()) : the_post();

							get_template_part( 'includes/post-formats/single-post-meta' );
							monster_free_template_gallery();

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

						<div class="post-author clearfix">
							<h3 class="post-author_h"><?php _e('About the Author', 'cherry'); ?></h3>
							<figure class="post-author_gravatar">
								<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '170' ); /* This avatar is the user's gravatar (http://gravatar.com) based on their administrative email address */  } ?>
								<figcaption class="post-author_name"><?php the_author_posts_link() ?></figcaption>
							</figure>
							<div class="post-author_desc">
								<?php the_author_meta('description') ?>
							</div>
						</div><!--.post-author-->

						<div class="feedback_holder clearfix">
							<?php 
								get_template_part('includes/post-formats/social-buttons');
							?>
						</div><!--.feedback_holder-->

						<?php 
							// If comments are opened.
							if ( comments_open() ) :
								if (function_exists('disqus_embed')) {
									disqus_embed(DISQUS_SHORTNAME);
								} else {
									comments_template('', true);
								}
							else :
								echo '<p class="nocomments">' . __('Comments are closed.', 'cherry') . '</p>';
							endif;

						endwhile; endif; ?>
					</div>

					<div class="span4">
						<dl class="free-desc-list">
							<?php 
								if ( is_array($terms) ) {
									echo "<dt>" . __('Type', 'cherry') . "</dt>";
									echo "<dd>" . $terms[0]->name . "</dd>";
								}
							?>
							<dt><?php _e('Category', 'cherry'); ?></dt>
							<dd><?php $cat = get_category( $cat_val ); echo $cat->name; ?></dd>
							<dt><?php _e('Title', 'cherry'); ?></dt>
							<dd><?php the_title(); ?></dd>
							<?php 
								$blog_post = get_post_meta( get_the_ID(), 'tz_blog_post_url', true );
								$lide_demo = get_post_meta( get_the_ID(), 'tz_live_demo_url', true );
								$download  = get_post_meta( get_the_ID(), 'tz_download_url', true );

								if ( !empty($blog_post) || !empty($lide_demo) || !empty($download) ) {
									echo '<dt>' . __('Links', 'cherry') . '</dt>';
								}
								echo '<dd>';

								if ( !empty($blog_post) ) {
									echo '<a class="btn btn-small btn-primary" href="' . $blog_post . '" target="_blank">' . __('Blog Post', 'cherry') . '</a>&nbsp;';
								}
								if ( !empty($lide_demo) ) {
									echo '<a class="btn btn-small btn-primary" href="' . $lide_demo . '" target="_blank">' . __('Live Demo', 'cherry') . '</a>&nbsp;';
								}
								if ( !empty($download) ) {
									echo '<a class="btn btn-small btn-primary" href="' . $download . '" target="_blank">' . __('Download', 'cherry') . '</a>&nbsp;';
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