<?php 
/**
 * Template Name: Authors
 */
get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="span8 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="content-inner">
					<?php get_template_part('title'); ?>
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('page page-authors'); ?>>
						<div class="author-holder">
							<ul class="author-list unstyled clearfix">
								<li class="author-item first-item">
									<figure class="featured-thumbnail">
										<a href="become-an-author/"><i class="icon-monster"></i></a>
									</figure>
									<div class="desc">
										<h5>Your Name Here</h5>
									</div>
								</li>
								<?php contributors(); ?>
							</ul>
						</div>
					</div><!--#post-# .post-->
					<?php endwhile; ?>
				</div>
			</div><!--#content-->
			<?php get_sidebar(); ?>
		</div><!--.row-->
	</div><!--.container-->  
<?php get_footer(); ?>