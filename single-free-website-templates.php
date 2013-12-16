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

							$cat_val = get_post_meta( $post->ID, 'filter-cat', true );
							if ( empty($cat_val) ) {
								$idObj   = get_category_by_slug( 'free-website-templates' );
								$cat_val = $idObj->term_id;
							}

							$args = array(
								'id'   => $post->ID,
								'type' => '',
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
							<dt><?php _e('Type', 'cherry'); ?></dt>
							<dd><?php _e('...', 'cherry'); ?></dd>
							<dt><?php _e('Category', 'cherry'); ?></dt>
							<dd><?php $cat = get_category( $cat_val ); echo $cat->name; ?></dd>
							<dt><?php _e('Title', 'cherry'); ?></dt>
							<dd><?php the_title(); ?></dd>
							<dt><?php _e('Links', 'cherry'); ?></dt>
							<dd>
								<a class="btn btn-small btn-primary" href="#" target="_blank"><?php _e('Blog Post', 'cherry'); ?></a>
								<a class="btn btn-small btn-primary" href="#" target="_blank"><?php _e('Live Demo', 'cherry'); ?></a>
								<a class="btn btn-small btn-primary" href="#" target="_blank"><?php _e('Download', 'cherry'); ?></a>
							</dd>
						</dl>
						<?php the_content(''); ?>
					</div>
				</div><!--.row-->
			</div><!--content-inner-->
		</div><!--#content-->
	</div><!--.row-->
</div><!--.container-->