<aside id="sidebar-author" class="sidebar sidebar__author span4 hidden-phone">
	<div class="post-author widget">
		<?php
			if(isset($_GET['author_name'])) :
				$curauth = get_userdatabylogin($author_name);
			else :
				$curauth = get_userdata(intval($author));
			endif;
		?>
		<figure class="post-author_gravatar">
		<?php if(function_exists('get_avatar')) { echo get_avatar( $curauth->user_email, $size = '270' ); } ?>
		</figure>
		
		<?php if($curauth->description !="") { ?>
		<div class="post-author_desc">
			<?php echo $curauth->description; ?>
		</div>
		<?php } ?>
	</div><!--.post-author-->

	<?php
		// get all categories and record to array
		$categories = get_categories(); 
		foreach ($categories as $category) {
			$allCategoriesArray[$category->slug] = $category->cat_ID;
		}

		//get all terms (e.g. categories or post tags), then display all posts in each term
		$taxonomy   = 'category'; //  e.g. post_tag, category
		$param_type = 'category__in'; //  e.g. tag__in, category__in
		$term_args  = array(
			'orderby' => 'name',
			'order'   => 'ASC'
		);
		$terms = get_terms($taxonomy, $term_args);
		if ($terms) {
			$authorCatArray = array();
			foreach( $allCategoriesArray as $key => $value ) {
			$args = array(
				"$param_type"         => $value,
				'author_name'         => $curauth->display_name,
				'post_type'           => 'post',
				'post_status'         => 'publish',
				'showposts'           => -1,
				'ignore_sticky_posts' => 1
			);
			$my_query = new WP_Query($args);
			if( $my_query->have_posts() ) {
				while ($my_query->have_posts()) : $my_query->the_post();
				endwhile;
				$authorCatArray[$value] = $key;
				}
			}
			if ( !empty($authorCatArray) ) { ?>
				<div class="author-category widget">
					<h3 class="author-category-h"><?php _e('Categories', 'cherry'); ?></h3>
					<ul class="author-category-list unstyled clearfix">
					<?php foreach ( $authorCatArray as $k => $v ) {
						$name = get_category_by_slug($v)->cat_name;
						$link = get_category_link( $k );
						echo '<li class="author-category-item"><a class="author-category-link" href="'.$link.'" title="'.$name.'">' . $name . '</a></li>';
					} ?>
					</ul>
				</div><!--.author-category-->
			<?php }
		}
		wp_reset_postdata();  // Restore global post data stomped by the_post().
	?>

	<div class="widget">
		<a href="<?php echo home_url(); ?>/?page_id=2067/" class="become-author">
			<span class='icon-box'><i class="icon-pencil"></i></span>
			<strong><?php _e('Become an Author', 'cherry'); ?></strong>
		</a>
	</div>
</aside><!--.sidebar-author-->