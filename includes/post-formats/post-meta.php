<?php $post_meta = of_get_option('post_meta'); ?>
<?php if ($post_meta=='true' || $post_meta=='') { ?>
	<!-- Post Meta -->
	<div class="post_meta">
		<?php _e('by ', 'cherry') . the_author_posts_link() ?> &nbsp;<em class="post_meta-separator"></em>&nbsp; <time datetime="<?php the_time('Y-m-d\TH:i:s'); ?>"><?php echo get_the_date(); ?></time>
		<?php 
			if ( !has_post_thumbnail())  {
				$categories = get_the_category();
				if( !empty($categories) ){
					$category = $categories[0];
					echo __('in ', 'cherry') . '<a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>';
				}
			}
		?>
	</div>
	<!--// Post Meta -->
<?php } ?>