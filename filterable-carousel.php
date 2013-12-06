<!-- BEGIN CAROUSEL -->
<?php
	// declaration array for filter
	$filterArray = array(
			'videos'        => '',
			'books'         => '',
			'podcasts'      => '',
			'presentations' => ''
		);

	// declaration array for all tags
	$allTagsArray = array();

	// get all tags and record to array
	$tags = get_tags();
	if ( empty($tags) ) 
		return;

	foreach ($tags as $tag) {
		$allTagsArray[$tag->slug] = $tag->term_id;
	}

	// computes the intersection of arrays using keys for comparison
	$filterArray = (array_intersect_key($filterArray, $allTagsArray));

	if ( empty($filterArray) ) 
		return;

	foreach ($filterArray as $key => $value) {
		$filterArray[$key] = $allTagsArray[$key];
	}
?>
<div class="carousel-holder">
	<div class="carousel-heading clearfix">
		<div id="carousel-current-state" class="hidden-phone"><span><?php _e('Best of Web', 'cherry'); ?></span></div>
		<div id="carousel-filter">
			<?php
				foreach ($filterArray as $key => $value) {
					echo '<a href="#' . $key . '">' . str_replace('-', ' ', $key) . '</a>';
				}
			?>
		</div>
		<!-- <div id="carousel-pager" class="carousel-pager"></div> -->
	</div>
	<div class="carousel-wrapper">
		<ul id="carousel" class="unstyled">
			<?php
				//get all terms (e.g. tags or post tags), then display all posts in each term
				$taxonomy   = 'tag';
				$param_type = 'tag__in';
				$term_args  = array(
					'orderby' => 'name',
					'order'   => 'ASC'
				);
				$terms = get_terms($taxonomy, $term_args);
				if ($terms) {
					foreach( $filterArray as $key => $value ) {
					$args = array(
						"$param_type"         => $value,
						'post_type'           => 'post',
						'post_status'         => 'publish',
						'showposts'           => 10,
						'ignore_sticky_posts' => 1,
						'meta_key'            => 'tz_filter',
						'meta_value'          => 'true'
					);
					$i = 0;
					$my_query = new WP_Query($args);
					if( $my_query->have_posts() ) {
						while ($my_query->have_posts()) : $my_query->the_post();
						$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
						$url            = $attachment_url['0'];
						$image          = aq_resize($url, 180, 180, true);

						if (!$i) { ?>
							<li id="<?php echo $key; ?>" class="<?php echo $key; ?>">
						<?php } else { ?>
							<li class="<?php echo $key; ?>">
						<?php }

							if ($image) { ?>
								<figure class="thumbnail"><a class="carousel-link" href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"></a></figure>
							<?php } ?>
							<div class="desc hidden-phone">
								<time datetime="<?php the_time('Y-m-d\TH:i:s'); ?>"><?php echo get_the_date(); ?></time>
								<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo my_string_limit_words(get_the_title(), 5); ?></a></h5>
							</div>
						</li>
						<?php
						$i++;
						endwhile; ?>
						<li class="<?php echo $key; ?> view-all-item">
							<a href='<?php echo home_url("/tag/$key"); ?>' class="view-all-link" target="_blank">
								<div class="view-all-text">
									<strong><?php _e('View all', 'cherry'); ?></strong>
									<span class="view-all-tag"><?php echo $key; ?></span>
								</div>
								<div class="middle-hack"></div>
							</a>
						</li>
					<?php }
					}
					wp_reset_postdata(); // Restore global post data stomped by the_post().
				}
			?>
		</ul>
		
		<button id="carousel-prev"><span>&lsaquo;</span></button>
		<button id="carousel-next"><span>&rsaquo;</span></button>
		<script type="text/javascript">
			jQuery(window).load(function(){
				var _visible = 3,
					$filters = jQuery('#carousel-filter a'),
					_onBefore = function(){
						// jQuery(this).find('li').fadeTo(300, 1);
						jQuery(this).find('li').removeClass('disabled');
						$filters.removeClass( 'selected' );
					};

				jQuery('#carousel').carouFredSel({
					items: _visible,
					width: '100%',
					circular: false,
					infinite: false,
					auto: false,
					// responsive: true,
					// align: 'left',
					scroll: {
						duration: 600
					},
					swipe: {
						onTouch: true
					},
					prev: {
						button: '#carousel-prev',
						items: 1,
						onBefore: _onBefore
					},
					next: {
						button: '#carousel-next',
						items: 1,
						onBefore: _onBefore
					}
				}, {
					debug: false
				});

				$filters.click(function(e){
					e.preventDefault();

					var group     = jQuery(this).attr('href').slice(1),
						slides    = jQuery('#carousel li.' + group),
						deviation = Math.floor( ( _visible - slides.length ) / 2 );
					if ( deviation < 0 ) {
						deviation = 0;
					}

					jQuery('#carousel').trigger('slideTo', [jQuery('#' + group), -deviation]);
					// jQuery('#carousel li').stop().fadeTo(300, 0.4);
					// slides.stop().fadeTo(300, 1);
					jQuery('#carousel li').addClass('disabled');
					slides.removeClass('disabled');

					$filters.removeClass('selected');
					jQuery(this).addClass('selected');
				});
			});
		</script>
	</div>
</div>
<!-- END CAROUSEL -->