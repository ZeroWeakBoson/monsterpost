<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>

	<?php if (!is_singular()) :
		get_template_part('includes/post-formats/post-thumb');
		get_template_part('includes/post-formats/post-meta');
	?>
	<header class="post-header">
		<h4 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'cherry');?> <?php the_title(); ?>"><?php the_title(); ?></a></h4>
	</header>

	<?php else :
		get_template_part('includes/post-formats/single-post-meta');

		if ( has_excerpt() ) {
			echo '<div class="post_excerpt">';
			the_excerpt();
			echo '</div>';
		}

		if (! get_post_gallery()) {

			$random = uniqid(); ?>
			<script type="text/javascript">
				// Can also be used with $(document).ready()
				jQuery(window).load(function() {
					jQuery('#flexslider_<?php echo $random ?>').flexslider({
						animation: "slide",
						smoothHeight: true
					});
				});
			</script>
			
			<!-- Gallery Post -->
			<div class="gallery-post">
				<!-- Slider -->
				<div id="flexslider_<?php echo $random ?>" class="flexslider thumbnail">
					<ul class="slides">
						<?php 
							$args = array(
								'orderby'        => 'menu_order',
								'order'          => 'ASC',
								'post_type'      => 'attachment',
								'post_parent'    => get_the_ID(),
								'post_mime_type' => 'image',
								'post_status'    => null,
								'numberposts'    => -1,
							);
							$attachments = get_posts($args);
						
							if ($attachments) :
								foreach ($attachments as $attachment) :
									$attachment_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
									$url            = $attachment_url['0'];
									$image          = aq_resize($url, 800, 400, true);
							?>
						<li><img src="<?php echo $image; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>"/></li>
						<?php
							endforeach;
							endif;
						?>
					</ul>
				</div>
				<!-- /Slider -->
			</div>
			<!-- /Gallery Post -->
			
			<?php } else {
				echo get_post_gallery();
			}

	endif; ?>

	<?php if (!is_singular()) :
		$post_excerpt = of_get_option('post_excerpt');

		if ($post_excerpt == 'true') {
			$excerpt       = get_the_excerpt();
			$excerpt_count = (of_get_option('excerpt_count')=='') ? 20 : of_get_option('excerpt_count');
		?>
		<!-- Post Content -->
		<div class="post_content">
			<div class="excerpt"><?php echo my_string_limit_words($excerpt, $excerpt_count); ?></div>
		</div>
		<!-- //Post Content -->
	<?php } ?>

	<?php else: ?>

		<!-- Post Content -->
		<div class="post_content">
			<?php the_content(''); ?>
			<div class="clear"></div>
		</div>
		<!-- //Post Content -->

<?php endif; ?>

</article><!--//.post__holder-->