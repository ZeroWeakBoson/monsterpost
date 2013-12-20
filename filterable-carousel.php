<!-- BEGIN CAROUSEL -->
<?php
	// declaration array for filter
	$filterArray = array(
			'videos'      => '',
			'books'       => '',
			'podcasts'    => '',
			'slide-decks' => ''
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
		<input id="ajaxurl" type="hidden" value="<?php echo admin_url('admin-ajax.php'); ?>">
		<div id="carousel-current-state" class="hidden-phone"><span><?php esc_html_e('Watch &amp; Learn', 'cherry'); ?></span></div>
		<div id="carousel-filter">
			<?php
				foreach ($filterArray as $key => $value) {
					$class = '';
					if ( $key == 'videos' ) {
						$class = 'selected';
					}
					echo '<a href="#' . $key . '" class="' . $class . '" data-filter="' . $key . '">' . str_replace('-', ' ', $key) . '</a>';
				}
			?>
		</div>
		<div id="carousel-pager" class="carousel-pager"></div>
	</div>
	<div class="carousel-wrapper">
		<div id="carousel-cover"></div>
		<ul id="carousel" class="clearfix unstyled">
			<?php do_action('monster_carousel_posts'); ?>
		</ul>
		
		<button id="carousel-prev"><span>&lsaquo;</span></button>
		<button id="carousel-next"><span>&rsaquo;</span></button>
		<script type="text/javascript">
			jQuery(window).load(function(){
				var _visible = 5;

				jQuery('#carousel').carouFredSel({
					items: _visible,
					width: '100%',
					circular: true,
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
						items: 1
					},
					next: {
						button: '#carousel-next',
						items: 1
					},
					pagination: '#carousel-pager'
				}, {
					debug: false
				});

				// $filters.click(function(e){
				// 	e.preventDefault();

				// 	var group     = jQuery(this).attr('href').slice(1),
				// 		slides    = jQuery('#carousel li.' + group),
				// 		deviation = Math.floor( ( _visible - slides.length ) / 2 );
				// 	if ( deviation < 0 ) {
				// 		deviation = 0;
				// 	}

				// 	jQuery('#carousel').trigger('slideTo', [jQuery('#' + group), -deviation]);
				// 	// jQuery('#carousel li').stop().fadeTo(300, 0.4);
				// 	// slides.stop().fadeTo(300, 1);
				// 	jQuery('#carousel li').addClass('disabled');
				// 	slides.removeClass('disabled');

				// 	$filters.removeClass('selected');
				// 	jQuery(this).addClass('selected');
				// });
			});
		</script>
	</div>
</div>
<!-- END CAROUSEL -->