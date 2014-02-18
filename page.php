<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="span8 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="content-inner">
					<?php 
						get_template_part('title');
						if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
						<?php if (has_post_thumbnail()) {
							echo '<figure class="featured-thumbnail thumbnail">'; the_post_thumbnail(); echo '</figure>';
						} ?>
						<div id="page-content">
							<?php the_content(); ?>
							<div class="clear"></div>
						</div><!--#page-content -->
					</div><!--#post-# .post-->
					<?php endwhile; ?>
				</div><!--.content-inner-->
			</div><!--#content-->
			<?php get_sidebar(); ?>
		</div><!--.row-->
	</div><!--.container-->  
<?php get_footer(); ?>