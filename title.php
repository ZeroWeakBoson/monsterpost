<section class="title-section">
	<h1 class="title-header">
		<?php if(is_home()){ ?>
			<?php $blog_text = of_get_option('blog_text'); ?>
				<?php if($blog_text){?>
					<?php echo of_get_option('blog_text'); ?>
				<?php } else { ?>
					<?php _e('Blog','cherry');?>
			<?php } ?>
			
		<?php } elseif ( is_category() ) { ?>
			<?php single_cat_title(); ?>

		<?php } elseif ( is_search() ) { ?>
			<?php _e('Search for: ','cherry');?>"<?php the_search_query(); ?>"
		
		<?php } elseif ( is_day() ) { ?>
			<?php printf( __( 'Daily Archives: <span>%s</span>', 'cherry' ), get_the_date() ); ?>
			
		<?php } elseif ( is_month() ) { ?>
			<?php printf( __( 'Monthly Archives: <span>%s</span>', 'cherry' ), get_the_date('F Y') ); ?>
			
		<?php } elseif ( is_year() ) { ?>
			<?php printf( __( 'Yearly Archives: <span>%s</span>', 'cherry' ), get_the_date('Y') ); ?>
		
		<?php } elseif ( is_author() ) { ?>
			<?php 
				global $author;
				$userdata = get_userdata($author);
			?>
				<?php _e('by ','cherry');?><?php echo $userdata->display_name; ?>
				
		<?php } elseif ( is_tag() ) { ?>
			<?php echo single_tag_title( '', false ); ?>

		<?php } else { ?>
		
			<?php if (have_posts()) : while (have_posts()) : the_post();
				$pagetitle = get_post_custom_values("page-title");
				$pagedesc = get_post_custom_values("title-desc");
					if($pagetitle == ""){
						the_title();
					} else {
						echo $pagetitle[0];
					}
					if($pagedesc != ""){ ?>
						<span class="title-desc"><?php echo $pagedesc[0];?></span>
					<?php }
				endwhile; endif;
			wp_reset_query();
		} ?>
	</h1>
</section><!-- .title-section -->