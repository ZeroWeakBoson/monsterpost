<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>

	<?php if ( !is_singular() ) :
		get_template_part('includes/post-formats/post-thumb');
		get_template_part('includes/post-formats/post-meta');
	?>
	<header class="post-header">
		<h4 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'cherry');?> <?php the_title(); ?>"><?php the_title(); ?></a></h4>
	</header>
	<?php endif; ?>

	<?php if ( is_singular() ) :
		get_template_part('includes/post-formats/single-post-meta');

		echo '<div class="post_excerpt">';
		if ( has_excerpt() ) {
			the_excerpt();
		} else {
			$excerpt      = get_the_content();
			$content      = apply_filters( 'the_content', $excerpt );
			$full_content = false;
			$pos          = stripos($content, '</p>'); // search close tag </p>

			if ( $pos !== false ) {
				$temp_str = substr($content, 0, $pos);
				if ( (stripos( $temp_str, 'script' ) !== false) || (stripos( $temp_str, 'http' ) !== false) ) {
					$full_content = true;
				}

				if ( stripos( $temp_str, 'script' ) === false ) { // search tag <script>
					if ( stripos( $temp_str, 'http' ) === false ) { // search iframe and others elements with source(src) on 'http' protocol
						echo wpautop( force_balance_tags( $temp_str ) );
					}
				}
			} else {
				$full_content = true;
			}
		}
		echo '</div>';

		if ( has_post_thumbnail() ):
			$lightbox = get_post_meta(get_the_ID(), 'tz_image_lightbox', TRUE);
			if ($lightbox == 'yes') 
				$lightbox = TRUE;
			else 
				$lightbox = FALSE;
			$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( '9999','9999' ), false, '' ); ?>

		<div class="post-thumb clearfix">
			<?php
				$thumb   = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
				$image   = aq_resize( $img_url, 770, 380, true ); //resize & crop img

			if ($lightbox) : ?>

				<figure class="featured-thumbnail thumbnail mfc-thumbnail large">
					<a class="image-wrap" title="<?php the_title(); ?>" href="<?php echo $src[0]; ?>">
						<img src="<?php echo $image ?>" alt="<?php the_title(); ?>" />
						<span class="zoom-icon"></span>
					</a>
				</figure>
				<div class="clear"></div>

			<?php else: ?>

				<figure class="featured-thumbnail thumbnail large">
					<img src="<?php echo $image ?>" alt="<?php the_title(); ?>" />
				</figure>
				<div class="clear"></div>
			<?php endif; ?>
		</div><!--.post-thumb-->

		<?php endif;
	
		echo '<div class="post_content">';
		if ( has_excerpt() || $full_content ) {
			the_content('');
		} else {
			echo substr($content, $pos+4);
		}
		echo '<div class="clear"></div></div>';

	else :
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
		<?php }
	endif; ?>

</article><!--//.post__holder-->