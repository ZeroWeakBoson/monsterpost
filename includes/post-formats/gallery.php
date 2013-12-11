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
			$random = uniqid();
			if ( count($attachments) > 8 ) {
				$pagerType = 'short';
			} else {
				$pagerType = 'full';
			} ?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('#bxslider_<?php echo $random ?>').bxSlider({
						pagerType: "<?php echo $pagerType; ?>"
					});
				});
			</script>
			<!-- Slider -->
			<ul id="bxslider_<?php echo $random ?>" class="bxslider unstyled">
				<?php 
					foreach ($attachments as $attachment) :
						$attachment_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
						$url            = $attachment_url['0'];
						$image          = aq_resize($url, 800, 400, true);
					?>
				<li><img src="<?php echo $image; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>"/></li>
				<?php
					endforeach;
				?>
			</ul>
		<?php endif;

		echo '<div class="post_content">';
		if ( has_excerpt() || $full_content ) {
			the_content('');
		} else {
			echo substr($content, $pos+4);
		}
		echo '<div class="clear"></div></div>';
		
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

<?php endif; ?>

</article><!--//.post__holder-->