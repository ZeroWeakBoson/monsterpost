<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="span8 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="content-inner">
					<?php
						get_template_part('title');
						$cat_desc = category_description();
						if (!empty($cat_desc)) {
							echo '<div class="category-desc">' . $cat_desc . '</div>';
						}

						$args = array('news', 'articles', 'tutorials', 'tools', 'inspiration', 'free-stuff', 'interviews', 'infographics');
						if (is_category($args)) {
							// layout for special categories
							get_template_part('category-layout-1');
						} else {
							// layout for other categories
							get_template_part('category-layout-2');
						}
					?>
				</div><!--.content-inner-->
			</div><!--#content-->
			<?php get_sidebar(); ?>
		</div><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>